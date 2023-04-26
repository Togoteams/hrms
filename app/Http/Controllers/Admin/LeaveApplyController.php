<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\Employee;
use App\Models\LeaveApply;
use App\Models\LeaveType;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Exception;
use Illuminate\Support\Facades\Auth;

class LeaveApplyController extends Controller
{
    public $page_name = " Apply Leave";
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            // if user is not equal to employee then show all data
            if (isemplooye()) {
                $data = LeaveApply::with('user', 'leave_type')->where('user_id', Auth::user()->id)->select('*');
            } else {

                $data = LeaveApply::with('user', 'leave_type')->select('*');
            }
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn = view('admin.leave_apply.buttons', ['item' => $row, "route" => 'leave_apply']);
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        $leave_type = LeaveType::where('status', 'active')->where('leave_for', Employee::where('user_id', Auth::user()->id)->first()->employment_type ?? '')->get();
        $all_users = Employee::where('status', 'active')->get();
        return view('admin.leave_apply.index', ['page' => $this->page_name, 'leave_type' => $leave_type, 'all_user' => $all_users]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'leave_type_id' => ['required', 'numeric', 'exists:leave_types,id'],
            'leave_applies_for' => ['required', 'string'],
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date'],
            "doc1" => ["mimetypes:application/pdf", "max:10000"]
        ]);

        if ($validator->fails()) {
            return $validator->errors();
        } else {
            try {
                if (isset($request->user_id) && $request->user_id != '') {
                    $user = User::find($request->user_id);
                } else {
                    $user = Auth::user();
                }

                $request->request->add([
                    'doc' => $request->has('doc1') ? $this->insert_image($request->file('doc1'), 'leave_doc') : '',
                    'uuid' => $user->uuid,
                    'user_id' => $user->id,
                    'created_by' => Auth::user()->id,
                ]);
                LeaveApply::insertGetId($request->except(['_token', 'doc1', '_method']));
                return response()->json(['success' => $this->page_name . " Added Successfully"]);
            } catch (Exception $e) {
                return response()->json(['error' => $e->getMessage()]);
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $leave_type = LeaveType::where('status', 'active')->get();

        $data = LeaveApply::find($id);
        return view('admin.leave_apply.show', ['data' => $data, 'page' => $this->page_name, 'leave_type' => $leave_type]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
     
        $data = LeaveApply::find($id);
            $leave_type = LeaveType::where('status', 'active')->where('leave_for', Employee::where('user_id', $data->user_id)->first()->employment_type ?? '')->get();
     
        return view('admin.leave_apply.edit', ['data' => $data, 'page' => $this->page_name, 'leave_type' => $leave_type]);
    }

    public function status_modal($id)
    {
        $leave_type = LeaveType::where('status', 'active')->get();

        $data = LeaveApply::find($id);
        return view('admin.leave_apply.status', ['data' => $data, 'page' => $this->page_name, 'leave_type' => $leave_type]);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'leave_type_id' => ['required', 'numeric'],
            'leave_applies_for' => ['required', 'string'],
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date'],
            "doc1" => ["mimetypes:application/pdf", "max:10000"]

        ]);

        if ($validator->fails()) {
            return $validator->errors();
        } else {
            try {
                $request->request->add([
                    'updated_by' => Auth::user()->id
                ]);
                LeaveApply::where('id', $id)->update($request->except(['_token',  '_method', 'doc1']));
                $request->has('doc1') ? $this->update_images('leave_applies', $id, $request->file('doc1'), 'leave_doc', 'doc') : LeaveApply::find($id)->doc;
                return response()->json(['success' => $this->page_name . " Updated Successfully"]);
            } catch (Exception $e) {
                return response()->json(['error' => $e->getMessage()]);
            }
        }
    }

    public function status(Request $request, $id)
    {
        try {
            LeaveApply::where('id', $id)->update([
                'status' => $request->status,
                'status_remarks' => $request->status_remarks,
            ]);
            return response()->json(['success' => $this->page_name . " Updated Successfully"]);
        } catch (Exception $e) {
            return response()->json(['errors' => "Somthing wen Wrong"]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $user =  LeaveApply::find($id);
            LeaveApply::destroy($id);
            User::destroy($user->user_id);
            return "Delete";
        } catch (Exception $e) {
            return ["error" => $this->page_name . "Can't Be Delete this May having some Employee"];
        }
    }
    public function get_leave(Request $request)
    {
        $user_id = $request->user_id;
        $leave_type = LeaveType::where('status', 'active')->where('leave_for', Employee::where('user_id', $user_id)->first()->employment_type ?? '')->get();
        echo '<option> -Select Leave Type - </option>';
        foreach ($leave_type as $l_type) {
            echo '  <option value="' . $l_type->id . '">' . $l_type->name . '</option>';
        }
    }
}
