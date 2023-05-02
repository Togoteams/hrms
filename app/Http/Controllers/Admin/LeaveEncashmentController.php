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
use App\Models\LeaveEncashment;

class LeaveEncashmentController extends Controller
{
    public $page_name = " Leave Encashment";
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            // if user is not equal to employee then show all data
            if (isemplooye()) {
                $data = LeaveEncashment::with('user', 'leave_type')->where('user_id', Auth::user()->id)->select('*');
            } else {

                $data = LeaveEncashment::with('user', 'leave_type')->select('*');
            }
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn = view('admin.leave_encashment.buttons', ['item' => $row, "route" => 'leave_encashment']);
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        $total_upaid_leave = LeaveApply::where('user_id', Auth::user()->id)->where('status', 'approved')->where('is_paid', 'unpaid')->count('*');
        $total_leave_days = LeaveType::where('status', 'active')->where('leave_for', Employee::where('user_id', Auth::user()->id)->first()->employment_type ?? '')->where('nature_of_leave', 'unpaid')->sum('no_of_days');
        $total_remaining_leave = $total_leave_days - $total_upaid_leave;
        $leave_type = LeaveType::where('status', 'active')->where('leave_for', Employee::where('user_id', Auth::user()->id)->first()->employment_type ?? '')->get();
        $all_users = Employee::where('status', 'active')->get();
        return view('admin.leave_encashment.index', ['page' => $this->page_name, 'leave_type' => $leave_type, 'all_user' => $all_users, 'total_remaining_leave' => $total_remaining_leave]);
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
            'no_of_days' => 'required|numeric|min:1',
            'description' => ['required', 'string'],

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
                    'uuid' => $user->uuid,
                    'user_id' => $user->id,
                    'created_by' => Auth::user()->id,
                    'employee_id' => Employee::where('user_id', $user->id)->first()->id
                ]);
                LeaveEncashment::insertGetId($request->except(['_token',  '_method']));
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
        $total_upaid_leave = LeaveApply::where('user_id', Auth::user()->id)->where('status', 'approved')->where('is_paid', 'unpaid')->count('*');
        $total_leave_days = LeaveType::where('status', 'active')->where('leave_for', Employee::where('user_id', Auth::user()->id)->first()->employment_type ?? '')->where('nature_of_leave', 'unpaid')->sum('no_of_days');
        $total_remaining_leave = $total_leave_days - $total_upaid_leave;
        $data = LeaveEncashment::find($id);
        return view('admin.leave_encashment.show', ['data' => $data, 'page' => $this->page_name, 'leave_type' => $leave_type, 'total_remaining_leave' => $total_remaining_leave]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

        $data = LeaveEncashment::find($id);
        $leave_type = LeaveType::where('status', 'active')->where('leave_for', Employee::where('user_id', $data->user_id)->first()->employment_type ?? '')->get();

        return view('admin.leave_encashment.edit', ['data' => $data, 'page' => $this->page_name, 'leave_type' => $leave_type]);
    }

    public function status_modal($id)
    {
        $leave_type = LeaveType::where('status', 'active')->get();

        $data = LeaveEncashment::find($id);
        return view('admin.leave_encashment.status', ['data' => $data, 'page' => $this->page_name, 'leave_type' => $leave_type]);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'no_of_days' => 'required|numeric|min:1',
            'description' => ['required', 'string'],

        ]);

        if ($validator->fails()) {
            return $validator->errors();
        } else {
            try {
                $request->request->add([
                    'updated_by' => Auth::user()->id
                ]);
                LeaveEncashment::where('id', $id)->update($request->except(['_token',  '_method', 'doc1']));
                return response()->json(['success' => $this->page_name . " Updated Successfully"]);
            } catch (Exception $e) {
                return response()->json(['error' => $e->getMessage()]);
            }
        }
    }

    public function status(Request $request, $id)
    {
        try {
            LeaveEncashment::where('id', $id)->update([
                'status' => $request->status,
                'status_remarks' => $request->status_remarks,
            ]);
            return response()->json(['success' => $this->page_name . " Updated Successfully"]);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $user =  LeaveEncashment::find($id);
            LeaveEncashment::destroy($id);
            User::destroy($user->user_id);
            return "Delete";
        } catch (Exception $e) {
            return ["error" => $this->page_name . "Can't Be Delete this May having some Employee"];
        }
    }
}
