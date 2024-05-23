<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Models\CurrentLeave;
use App\Models\EmpCurrentLeave;
use App\Models\Employee;
use App\Models\LeaveSetting;
use Exception;
use Illuminate\Http\Request;
use App\Traits\GlobalTraits;

class CurrentLeaveController extends BaseController
{
    public $page_name = "Employees";
    use GlobalTraits;

    public function viewCurrentLeaves($eid = null)
    {
        $employee = getEmployee($eid);
        // $result = $this->updateCurrentLeaveOfEachEmployee();
        $leaves = CurrentLeave::where('user_id', $employee->user_id)->first();
        $empLeaveTypes = LeaveSetting::where('emp_type',getEmpType($employee->employment_type))->where('salary_deduction_per','<>',100)->get(['id','name','slug']);
        // return $empLeaveType;
        foreach($empLeaveTypes as $key => $value)
        {
            $value['leave_count'] =  EmpCurrentLeave::where('user_id', $employee->user_id)->where('employee_id',$employee->id)->where('leave_type_id',$value->id)->value('leave_count') ?? 0;
        }
        return view('admin.employees.current-leave', [
            'page'          => $this->page_name,
            'employee'   => $employee,
            'empLeaveTypes'   => $empLeaveTypes,
            'leaves'   => $leaves,
        ]);
    }

    public function postCurrentLeaves(Request $request)
    {
        $request->validate([
            'user_id'           => ['required'],
            'employee_id'       => ['required'],
            'employee_type'       => ['required'],
            // 'emp_leave_component.*.leave_type_id'       => ['required'],
            // 'emp_leave_component.*.leave_count'       => ['required'],
            // 'sick_leave'        => ['required', 'integer'],
            // 'earned_leave'      => [!empty($request->is_local) ? 'required' : 'nullable', 'integer'],
            // 'maternity_leave'   => ['required', 'integer'],
            // 'bereavement_leave' => [!empty($request->is_local) ? 'required' : 'nullable', 'integer'],
            // // 'leave_without_pay' => ['required', 'integer'],
            // 'casual_leave'      => [empty($request->is_local) ? 'required' : 'nullable', 'integer'],
            // 'privileged_leave'  => [empty($request->is_local) ? 'required' : 'nullable', 'integer'],
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
                    $saveData[$key]['updated_at'] = date('Y-m-d H:i:s');
                    $saveData[$key]['created_at'] = date('Y-m-d H:i:s');
                    $saveData[$key]['updated_by'] = auth()->user()->id;
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
                ["employee" => $employee, 'redirect_url' => route('admin.employee.address.form', $employee->emp_id)]
            );
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }
}
