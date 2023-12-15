<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Designation;
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
use App\Models\LeaveSetting;
use App\Traits\LeaveTraits;

class LeaveEncashmentController extends Controller
{
    use LeaveTraits;
    public $page_name = "Leave Encashment";
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            // if user is not equal to employee then show all data
            if (isemplooye()) {
                $data = LeaveEncashment::with('user', 'leave_type', 'employee', 'employee.designation')->where('user_id', Auth::user()->id)->select('*');
            } else {
                $data = LeaveEncashment::with('user', 'leave_type', 'employee', 'employee.designation')->select('*');
            }
            return Datatables::of($data)
                ->addIndexColumn()

                ->editColumn('employee.start_date', function ($data) {
                    return \Carbon\Carbon::parse($data->employee->start_date)->isoFormat('DD-MM-YYYY');
                })
                ->addColumn('apply_date', function ($data) {
                    return \Carbon\Carbon::parse($data->created_at)->isoFormat('DD-MM-YYY');
                })
                ->addColumn('action', function ($row) {
                    $actionBtn = view('admin.leave_encashment.buttons', ['item' => $row, "route" => 'leave_encashment']);
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        $leaveHideArr = ['privileged-leave','earned-leave'];
        $leave_type = LeaveSetting::where('emp_type',0)->whereIn('slug',$leaveHideArr)->get();
        $all_users = Employee::getActiveEmp()->get();

        return view('admin.leave_encashment.index', ['page' => $this->page_name, 'leave_type' => $leave_type, 'all_user' => $all_users]);
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
                    'employee_id' => Employee::where('user_id', $user->id)->first()->id,

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
        $leaveHideArr = ['privileged-leave'];

        $leave_type = LeaveSetting::where('emp_type',0)->whereIn('slug',$leaveHideArr)->get();

        $data = LeaveEncashment::find($id);
        return view('admin.leave_encashment.show', ['data' => $data, 'page' => $this->page_name, 'leave_type' => $leave_type, 'total_remaining_leave' => $this->balance_leave_by_type($data->leave_type_id, $data->user_id)]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

        $data = LeaveEncashment::find($id);
        $leaveHideArr = ['privileged-leave'];

        $leave_type = LeaveSetting::where('emp_type',0)->whereIn('slug',$leaveHideArr)->get();

        return view('admin.leave_encashment.edit', ['data' => $data, 'page' => $this->page_name, 'leave_type' => $leave_type]);
    }

    public function status_modal($id)
    {
        $leaveHideArr = ['privileged-leave'];

        $leave_type = LeaveSetting::where('emp_type',0)->whereIn('slug',$leaveHideArr)->get();

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
            $leave_encashment = LeaveEncashment::find($id);
            if ($request->status == "approved") {
                if ($this->balance_leave_by_type($leave_encashment->leave_type_id, $leave_encashment->user_id) >= $leave_encashment->no_of_days) {

                    LeaveEncashment::where('id', $id)->update([
                        'status' => $request->status,
                        'status_remarks' => $request->status_remarks,
                    ]);
                } else {
                    return response()->json(['error' => " Applied leave is " . $leave_encashment->no_of_days . " but  they have only " . $this->balance_leave_by_type($leave_encashment->leave_type_id, $leave_encashment->user_id) . " leave"]);
                }
            } else if ($request->status != "approved") {
                LeaveEncashment::where('id', $id)->update([
                    'status' => $request->status,
                    'status_remarks' => $request->status_remarks,
                ]);
            }
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

    public function get_encash_leave(Request $request)
    {
        $user_id = $request->user_id;
        $emploment_type = Employee::where('user_id', $user_id)->first()->employment_type ?? '';
        echo '<option> -Select Leave Type - </option>';
        $leaveHideArr = ['privileged-leave','earned-leave'];
        $leave_type = LeaveSetting::where('emp_type',getEmpType($emploment_type))->whereIn('slug',$leaveHideArr)->first();
        echo '  <option value="' . $leave_type->id . '">' . $leave_type->name . '</option>';
    }


    public function get_balance_leave(Request $request)
    {
        $remaining_leave = 0;

        $remaining_leave =  $this->balance_leave_by_type($request->leave_type_id, $request->user_id) ;

        return $remaining_leave;
    }
}
