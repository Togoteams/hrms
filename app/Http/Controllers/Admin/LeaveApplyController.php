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
                ->editColumn('start_date', function ($data) {
                    return \Carbon\Carbon::parse($data->start_date)->isoFormat('DD.MM.YYYY');
                })
                ->editColumn('end_date', function ($data) {
                    return \Carbon\Carbon::parse($data->end_date)->isoFormat('DD.MM.YYYY');
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        if (isemplooye()) {
            $data = LeaveApply::with('user', 'leave_type')->where('user_id', Auth::user()->id)->select('*');
            $total_upaid_leave = LeaveApply::where('user_id', Auth::user()->id)->where('status', 'approved')->where('is_paid', 'unpaid')->count('*');
            $total_pedding = LeaveApply::where('user_id', Auth::user()->id)->where('status', 'pending')->count('*');
            $total_approved = LeaveApply::where('user_id', Auth::user()->id)->where('status', 'reject')->count('*');
            $total_reject = LeaveApply::where('user_id', Auth::user()->id)->where('status', 'approved')->count('*');
        } else {
            $data = LeaveApply::with('user', 'leave_type')->select('*');
            $total_upaid_leave = LeaveApply::where('is_paid', 'unpaid')->where('status', 'approved')->count('*');
            $total_pedding = LeaveApply::where('status', 'pending')->count('*');
            $total_approved = LeaveApply::where('status', 'reject')->count('*');
            $total_reject = LeaveApply::where('status', 'approved')->count('*');
        }

        $leave_type = LeaveType::where('status', 'active')->where('leave_for', Employee::where('user_id', Auth::user()->id)->first()->employment_type ?? '')->get();
        $all_users = Employee::where('status', 'active')->get();

        return view('admin.leave_apply.index', [
            'page' => $this->page_name,
            'leave_type' => $leave_type,
            'all_user' => $all_users,
            'data' => $data,
            'total_upaid_leave' => $total_upaid_leave,
            'total_pedding' => $total_pedding,
            'total_approved' => $total_approved,
            'total_reject' => $total_reject,

        ]);
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
        if (isset($request->user_id) && $request->user_id != '') {
            $user = User::find($request->user_id);
        } else {
            $user = Auth::user();
        }

        if (total_remaining_leave($user->id) > 0) {
            if ($validator->fails()) {
                return $validator->errors();
            } else {
                try {

                    $request->request->add([
                        'doc' => $request->has('doc1') ? $this->insert_image($request->file('doc1'), 'leave_doc') : '',
                        'uuid' => $user->uuid,
                        'user_id' => $user->id,
                        'created_by' => Auth::user()->id,
                        'is_paid' => LeaveType::find($request->leave_type_id)->nature_of_leave,
                        'remaining_leave' => (int)$this->total_remaining_leave($user->id)

                    ]);
                    LeaveApply::insertGetId($request->except(['_token', 'doc1', '_method']));
                    return response()->json(['success' => $this->page_name . " Added Successfully"]);
                } catch (Exception $e) {
                    return response()->json(['error' => $e->getMessage()]);
                }
            }
        } else {
            return response()->json(['error' => "You have Applied Maximum number of leave"]);
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
                    'updated_by' => Auth::user()->id,
                    'is_paid' => LeaveType::find($request->leave_type_id)->nature_of_leave,

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
                'remaining_leave' =>  $request->status == "approved" ? (int)$this->total_remaining_leave($id) - 1 : (int)$this->total_remaining_leave($id),

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

    public function balance_history(Request $request)
    {

        if ($request->ajax()) {
            // if user is not equal to employee then show all data
            if (isemplooye()) {
                $data = LeaveApply::with('user', 'leave_type')->where('user_id', Auth::user()->id)->where('status', 'approved')->select('*');
            } else {

                $data = LeaveApply::with('user', 'leave_type')->where('status', 'approved')->select('*');
            }
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn = view('admin.leave_apply.buttons', ['item' => $row, "route" => 'leave_apply']);
                    return $actionBtn;
                })
                ->editColumn('start_date', function ($data) {
                    return \Carbon\Carbon::parse($data->start_date)->isoFormat('DD.MM.YYYY');
                })
                ->editColumn('end_date', function ($data) {
                    return \Carbon\Carbon::parse($data->end_date)->isoFormat('DD.MM.YYYY');
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        $leave_type = LeaveType::where('status', 'active')->where('leave_for', Employee::where('user_id', Auth::user()->id)->first()->employment_type ?? '')->get();
        $all_users = Employee::where('status', 'active')->get();
        return view('admin.leave_apply.leave_balance_history', ['page' => $this->page_name, 'leave_type' => $leave_type, 'all_user' => $all_users]);
    }


    public function request_history(Request $request)
    {
        if ($request->ajax()) {
            // if user is not equal to employee then show all data
            if (isemplooye()) {
                $data = LeaveApply::with('user', 'leave_type')->where('user_id', Auth::user()->id)->where('status', 'pending')->get();
            } else {
                $data = LeaveApply::with('user', 'leave_type')->where('status', 'pending')->get();
            }
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn = view('admin.leave_apply.buttons', ['item' => $row, "route" => 'leave_apply']);
                    return $actionBtn;
                })
                ->editColumn('start_date', function ($data) {
                    return \Carbon\Carbon::parse($data->start_date)->isoFormat('DD.MM.YYYY');
                })
                ->editColumn('end_date', function ($data) {
                    return \Carbon\Carbon::parse($data->end_date)->isoFormat('DD.MM.YYYY');
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        $leave_type = LeaveType::where('status', 'active')->where('leave_for', Employee::where('user_id', Auth::user()->id)->first()->employment_type ?? '')->get();
        $all_users = Employee::where('status', 'active')->get();
        return view('admin.leave_apply.leave_request_history', ['page' => $this->page_name, 'leave_type' => $leave_type, 'all_user' => $all_users]);
    }
}
