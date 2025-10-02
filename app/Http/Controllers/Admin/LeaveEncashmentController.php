<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Designation;
use App\Models\EmpCurrentLeave;
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
use App\Traits\NotificationTraits;
use Carbon\Carbon;

class LeaveEncashmentController extends Controller
{
    use LeaveTraits;
        use NotificationTraits;

    public $page_name = "Leave Encashment";
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            // if user is not equal to employee then show all data
         
            $data = LeaveEncashment::with('user', 'leave_settings', 'employee', 'employee.designation')->getList()->select('*');
            return DataTables::of($data)
                ->addIndexColumn()

                ->editColumn('employee.start_date', function ($data) {
                    return \Carbon\Carbon::parse($data->employee->start_date)->isoFormat('DD-MM-YYYY');
                })
                ->addColumn('apply_date', function ($data) {
                    return \Carbon\Carbon::parse($data->created_at)->isoFormat('DD-MM-YYYY');
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
        $allowedEmp = [];

        $all_users = Employee::getActiveEmp()->getList()->with('leaveEncashments','user')->get();
        foreach($all_users as $key => $value)
        {
                $employementType = $value->employment_type;
                $leaveEncashments = $value->leaveEncashments;
                $isApplicableForLeave = true;
                $approvalData = "";
                $newApprovalDate = "";
                foreach($leaveEncashments as $leave_encashment)
                {
                    if($leave_encashment->approval_at!=""){
                        $approvalData = $leave_encashment->approval_at;
                        if($employementType=="local")
                        {
                            $approvalDate = Carbon::parse($approvalData);
                            $newApprovalDate = $approvalDate->addYear(3);
                        }else
                        {
                            $approvalDate = Carbon::parse($approvalData);
                            $newApprovalDate = $approvalDate->addYear(2);
                        }
                    }
                    $currentDateTime = currentDateTime();
                    if($currentDateTime <= $newApprovalDate)
                    {
                        $isApplicableForLeave = false;
                    }
                }
                if($isApplicableForLeave)
                {
                    $allowedEmp[] =$value;
                }
        }
        return view('admin.leave_encashment.index', ['page' => $this->page_name, 'leave_type' => $leave_type, 'all_user' => $all_users,'allowedEmps'=>$allowedEmp]);
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
            'balance_leave' => 'required|numeric|min:1',
            'available_leave_for_encashment' => 'required|numeric|min:1',
            'request_leave_for_encashement' => 'required|numeric|lte:available_leave_for_encashment',
            'leave_type_id' => 'required|numeric|exists:leave_settings,id',
            'description' => ['nullable', 'string'],

        ], [
            'balance_leave.min' => 'Field Must Be At Least 1',
            'available_leave_for_encashment.min' => 'Field Must Be At Least 1',
            'request_leave_for_encashement.lte' => 'Field Must Be Less Than Or Equal To 0',
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
                    'requested_at' => currentDateTime(),
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
        return view('admin.leave_encashment.show', ['data' => $data, 'page' => $this->page_name, 'leave_type' => $leave_type, 'total_remaining_leave' => getAvailableLeaveCount($data->leave_type_id, $data->user_id)]);
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
            'balance_leave' => 'required|numeric|min:1',
            'available_leave_for_encashment' => 'required|numeric|min:1',
            'request_leave_for_encashement' => 'required|numeric|lte:available_leave_for_encashment',
            'description' => ['nullable', 'string'],

        ], [
            'balance_leave.min' => 'Field Must Be At Least 1',
            'available_leave_for_encashment.min' => 'Field Must Be At Least 1',
            'request_leave_for_encashement.lte' => 'Field Must Be Less Than Or Equal To 0',
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
        $validator = Validator::make($request->all(), [
            'status' => 'required',
        ]);
        try {
            $leave_encashment = LeaveEncashment::find($id);
            if ($request->status == "approved") {
                if (getAvailableLeaveCount($leave_encashment->leave_type_id, $leave_encashment->user_id) >= $leave_encashment->request_leave_for_encashement) {

                    LeaveEncashment::where('id', $id)->update([
                        'status' => $request->status,
                        'approval_at' => currentDateTime(),
                        'approved_by' =>auth()->user()->id,
                        'status_remarks' => $request->status_remarks,
                    ]);





                   
                $currentLeave = EmpCurrentLeave::where('user_id', $leave_encashment->user_id)->where('leave_type_id', $leave_encashment->leave_type_id)->first();
                $currentLeaveCount = $currentLeave?->leave_count ?? 0;
                $appliedLeaveCount = $leave_encashment->request_leave_for_encashement;
                // return $currentLeave->leave_count;
                if (!empty($currentLeave)) {
                    $remaining_leave = $currentLeaveCount - $appliedLeaveCount;
                    if ($remaining_leave >=0) {
                       
                        $remaining_leave = $currentLeaveCount - $appliedLeaveCount;
                        // return $remaining_leave;
                        $currentLeave->update(['leave_count' => $remaining_leave]);
                        // $leaveCount = count($leave_apply->leaveDate);
                     
                        $this->leaveActivityLog([
                            'user_id' => $leave_encashment->user_id,
                            'leave_type_id' => $leave_encashment->leave_type_id,
                            'is_credit' => 0,
                            'is_encash' => 1,
                            'leave_count' => $appliedLeaveCount
                        ]);
                        $this->saveNotification([
                            'reference_id' => $id,
                            'reference_type' => get_class($leave_encashment),
                            'user_id' => $leave_encashment->user_id,
                            'notification_type' => 'leave_approval',
                            'title' => "Leave Approved",
                            'description' => "Dear " . $leave_encashment->user->name . " Your " . $leave_encashment->leave_type->name . " is Encashed On Date " . date("d-m-Y", strtotime($leave_encashment->approval_at)),
                        ]);
                    } else {
                        return response()->json([
                            'error' => "Leave Approval Failed: Insufficient Leave Balance. You currently have " . $currentLeaveCount . " leave remaining."
                        ]);
                    }
                }


                } else {
                    return response()->json(['error' => " Applied leave is " . $leave_encashment->request_leave_for_encashement . " but  they have only " . getAvailableLeaveCount($leave_encashment->leave_type_id, $leave_encashment->user_id) . " leave"]);
                }
            } else if ($request->status != "approved") {
                LeaveEncashment::where('id', $id)->update([
                    'status' => $request->status,
                    'rejected_by' =>auth()->user()->id,
                    'rejected_at' => currentDateTime(),
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
            $leave_encashment =  LeaveEncashment::find($id);
            LeaveEncashment::destroy($id);
                $currentLeave = EmpCurrentLeave::where('user_id', $leave_encashment->user_id)->where('leave_type_id', $leave_encashment->leave_type_id)->first();
                $currentLeaveCount = $currentLeave?->leave_count ?? 0;
                $appliedLeaveCount = $leave_encashment->request_leave_for_encashement;
                // return $currentLeave->leave_count;
                if (!empty($currentLeave)) {
                    $remaining_leave = $currentLeaveCount + $appliedLeaveCount;
                    if ($remaining_leave >=0) {
                       
                        $remaining_leave = $currentLeaveCount - $appliedLeaveCount;
                        // return $remaining_leave;
                        $currentLeave->update(['leave_count' => $remaining_leave]);
                        // $leaveCount = count($leave_apply->leaveDate);
                     
                        $this->leaveActivityLog([
                            'user_id' => $leave_encashment->user_id,
                            'leave_type_id' => $leave_encashment->leave_type_id,
                            'is_credit' => 0,
                            'is_encash' => 1,
                            'leave_count' => $appliedLeaveCount
                        ]);
                        $this->saveNotification([
                            'reference_id' => $id,
                            'reference_type' => get_class($leave_encashment),
                            'user_id' => $leave_encashment->user_id,
                            'notification_type' => 'leave_approval',
                            'title' => "Leave Approved",
                            'description' => "Dear " . $leave_encashment->user->name . " Your " . $leave_encashment->leave_type->name . " is Encashed On Date " . date("d-m-Y", strtotime($leave_encashment->approval_at)),
                        ]);
                    } else {
                        return response()->json([
                            'error' => "Leave Approval Failed: Insufficient Leave Balance. You currently have " . $currentLeaveCount . " leave remaining."
                        ]);
                    }
                }
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
        $remaining_leave =  getAvailableLeaveCount($request->leave_type_id, $request->user_id) ;
        return response()->json(['status' =>true,'data'=>['remaining_leave'=>$remaining_leave]]);
    }
}
