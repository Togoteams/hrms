<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Models\CurrentLeave;
use App\Models\EmpCurrentLeave;
use App\Models\Employee;
use App\Models\LeaveActivityLog;
use App\Models\LeaveSetting;
use Exception;
use Illuminate\Http\Request;
use App\Traits\GlobalTraits;
use Yajra\DataTables\Facades\DataTables;

class CurrentLeaveController extends BaseController
{
    public $page_name = "Employees";
    use GlobalTraits;

    public function viewCurrentLeaves(Request $request, $eid = null)
    {
        $employee = getEmployee($eid);
        // return $request;
        if($employee->gender!="female")
        {
            $empLeaveTypes = LeaveSetting::where('emp_type',getEmpType($employee->employment_type))->whereNotIn('slug',['maternity-leave'])->where('salary_deduction_per','<>',100)->get(['id','name','slug']);        }else
        {
            $empLeaveTypes = LeaveSetting::where('emp_type',getEmpType($employee->employment_type))->where('salary_deduction_per','<>',100)->get(['id','name','slug']);
        }
        // return $empLeaveType;
        $isCurrentLeaveFound = 0 ;
        foreach($empLeaveTypes as $key => $value)
        {
            $value['leave_count'] =  EmpCurrentLeave::where('user_id', $employee->user_id)->where('employee_id',$employee->id)->where('leave_type_id',$value->id)->value('leave_count') ?? 0;
        }
        $isCurrentLeaveFound= EmpCurrentLeave::where('user_id', $employee->user_id)->where('employee_id',$employee->id)->exists();
        if ($request->ajax()) {
            $data = LeaveActivityLog::where('user_id', $employee->user_id)->where('employee_id',$employee->id)->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->make(true);
            }
        return view('admin.employees.current-leave', [
            'page'          => $this->page_name,
            'employee'   => $employee,
            'isCurrentLeaveFound'   => $isCurrentLeaveFound,
            'empLeaveTypes'   => $empLeaveTypes,
        ]);
    }
    public function leaveActivityLogList(Request $request)
    {
        $employee = getEmployee($request->employee_id);

        if ($request->ajax()) {
            $data = LeaveActivityLog::with('user','leave_type')->where('user_id', $request->user_id)->get();
            return DataTables::of($data)
                ->addColumn('leave_transaction_type', function ($row) {
                  if($row->is_credit)
                  {
                    return "Leave credited";
                  }elseif($row->is_adjustment)
                  {
                    return "Leave adjusted";
                  }else
                  {
                    return "Leave Availed";
                  }
                })
                ->editColumn('activity_at', function ($data) {
                    return \Carbon\Carbon::parse($data->activity_at)->isoFormat('DD-MM-YYYY');
                })
                ->rawColumns(['leave_transaction_type'])
                ->make(true);
            }
    }
    public function creditCurrentLeaves(Request $request){
       
        // return $isAdjustment;
        $request->validate([
            'user_id'           => ['required'],
            'employee_id'       => ['required'],
            'employee_type'       => ['required'],
            'leave_credit_type'       => ['required'],
        ]);
   
        try {
            $saveData = [];
            $userId = $request->user_id;
            $employeeId = $request->employee_id;
            $leaveTypeId = $request->leave_type_id;
            $employee = Employee::where('user_id', $request->user_id)->first();
            $currentLeave = EmpCurrentLeave::where('user_id', $userId)->where('employee_id',$employeeId)->where('leave_type_id',$leaveTypeId)->first();
            if(!empty($currentLeave))
            {
            
                if($request->leave_credit_type=='adjustment')
                { 
                    if( $currentLeave->leave_count >= $request->leave_count)
                    {
                    $currentLeave->leave_count = $currentLeave->leave_count - $request->leave_count;
                    $isAdjustment =1;
                    $isCredit =0;
                    }else{
                        return response()->json(['status'=>false,'message' => "You don't have available balance for adjustment."]);
                    }

                }else
                {
                    $isCredit =1;
                    $isAdjustment =0;
                    $currentLeave->leave_count = $currentLeave->leave_count + $request->leave_count;
                }
                  $currentLeave->action_date = date('Y-m-d');
                $currentLeave->save();
                $this->leaveActivityLog([
                    'user_id'=>$request->user_id,
                    'leave_type_id'=>$leaveTypeId,
                    'is_credit'=>$isCredit,
                    'is_adjustment'=>$isAdjustment,
                    'leave_count'=>  $request->leave_count,
                    'leave_update_reason'=>  $request->credit_reason,
                  ]);
            }
            $message = "Current Leave Updated Successfully";
            return $this->responseJson(
                true,
                200,
                $message,
                ["employee" => $employee, 'redirect_url' => route('admin.employee.current-leaves.list', $employee->ec_number)]
            );
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }   

    public function postCurrentLeaves(Request $request)
    {
        $request->validate([
            'user_id'           => ['required'],
            'employee_id'       => ['required'],
            'employee_type'       => ['required'],
          
        ]);
        // return $request->all();
       
        // return $saveData;
        try {
            $saveData = [];
            $userId = $request->user_id;
            $employeeId = $request->employee_id;
            EmpCurrentLeave::where('user_id', $userId)->where('employee_id',$employeeId)->delete();
            foreach($request->emp_leave_component as $key => $value) {
                    $saveData[$key]['user_id'] = $request->user_id;
                    $saveData[$key]['employee_id'] = $request->employee_id;
                    $saveData[$key]['employee_type'] = $request->employee_type;
                    $saveData[$key]['leave_type_id'] = $value['leave_type_id'];
                    $saveData[$key]['leave_count'] = $value['leave_count'];
                    $saveData[$key]['leave_count_decimal'] = $value['leave_count'];
                    $saveData[$key]['created_by'] = auth()->user()->id;
                    $saveData[$key]['updated_at'] = currentDateTime();
                    $saveData[$key]['created_at'] = currentDateTime();
                    $saveData[$key]['action_date'] = currentDateTime('Y-m-d');
                    $saveData[$key]['updated_by'] = auth()->user()->id;
                    $this->leaveActivityLog([
                        'user_id'=>$request->user_id,
                        'leave_type_id'=>$value['leave_type_id'],
                        'is_credit'=>1,
                        'leave_count'=> $value['leave_count'],
                      ]);
            }
            $empCurrentLeave = EmpCurrentLeave::insert($saveData);
            $message = "Current Leave Updated Successfully";
            // if ($request->id == '') {
            //     CurrentLeave::insertGetId($request->except(['_token', 'is_local', 'id']));
            //     $message = "Current Leave Created Successfully";
            // } else {
            //     CurrentLeave::where('id', $request->id)->update($request->except(['_token', 'user_id', 'employee_id', 'is_local', 'id']));
            //     $message = "Current Leave Updated Successfully";
            // }
            $employee = Employee::where('user_id', $request->user_id)->first();

            return $this->responseJson(
                true,
                200,
                $message,
                ["employee" => $employee, 'redirect_url' => route('admin.employee.address.form', $employee->ec_number)]
            );
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }
}
