<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Models\CurrentLeave;
use App\Models\Employee;
use Exception;
use Illuminate\Http\Request;

class CurrentLeaveController extends BaseController
{
    public $page_name = "Employees";

    public function viewCurrentLeaves($eid = null)
    {
        $employee = getEmployee($eid);
        $leaves = CurrentLeave::where('user_id', $employee->user_id)->first();

        return view('admin.employees.current-leave', [
            'page'          => $this->page_name,
            'employee'   => $employee,
            'leaves'   => $leaves,
        ]);
    }

    public function postCurrentLeaves(Request $request)
    {
        $request->validate([
            'user_id'           => ['required'],
            'employee_id'       => ['required'],
            'sick_leave'        => ['required', 'integer'],
            'earned_leave'      => [!empty($request->is_local) ? 'required' : 'nullable', 'integer'],
            'maternity_leave'   => ['required', 'integer'],
            'bereavement_leave' => [!empty($request->is_local) ? 'required' : 'nullable', 'integer'],
            'leave_without_pay' => ['required', 'integer'],
            'casual_leave'      => [empty($request->is_local) ? 'required' : 'nullable', 'integer'],
            'privileged_leave'  => [empty($request->is_local) ? 'required' : 'nullable', 'integer'],
        ]);

        try {
            if ($request->id == '') {
                CurrentLeave::insertGetId($request->except(['_token', 'is_local', 'id']));
                $message = "Current Leave Created Successfully";
            } else {
                CurrentLeave::where('id', $request->id)->update($request->except(['_token', 'user_id', 'employee_id', 'is_local', 'id']));
                $message = "Current Leave Updated Successfully";
            }
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
