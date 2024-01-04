<?php

namespace App\Http\Controllers\Admin\Payroll;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Models\CurrencySetting;
use Illuminate\Http\Request;
use App\Models\SalaryHistory;
use App\Models\Employee;
use Exception;

class SalaryHistoryController extends BaseController
{
   
   
    public function viewSalaryHistory($eid = null)
    {
        $employee = getEmployee($eid);
        $salaryHistories= SalaryHistory::where('user_id',$employee->user_id)->get();
        $currencies = ['pula'];
        $isExpatriate = 0 ;
        if($employee->employment_type=="expatriate")
        {
            $currencies =['usd'];   
            $isExpatriate = 1;
        }

        return view('admin.employees.emp-salary-histories', ['employee' => $employee,'is_expatriate'=>$isExpatriate,'currencies'=>$currencies,'salaryHistories'=>$salaryHistories]);
    }

    public function postSalaryHistory(Request $request)
    {
        $request->validate([
            'user_id'   => ['required', 'string'],
            'currency_salary'   => ['required', 'string'],
            'basic_salary'   => ['required', 'string'],
            'date_of_current_basic'   => ['required', 'date'],
            // 'salary_type'   => ['required', 'string'],
            // 'da'   => ['required', 'string'],
            // 'basic_salary_for_india'      => ['required', 'string'],
            // 'currency_salary_for_india'     => ['required', 'string'],
            // 'date_of_current_basic'   => ['required', 'string'],
            'pension_contribution'   => ['required', 'string'],
            'pension_opt'   => ['nullable','string','required_if:pension_contribution,yes',],
            // 'status'   => ['required', 'string'],
            'union_membership_id'   => ['required', 'string'],
        ]);

        try {
            if ($request->id == '') {
                SalaryHistory::insertGetId($request->except(['_token', 'id']));
                $message = "Salary History Created Successfully";
            } else {
                SalaryHistory::where('id', $request->id)->update($request->except(['_token', 'user_id', 'id']));
                $message = "Salary History Updated Successfully";
            }
            $employee = Employee::firstWhere('user_id', $request->user_id);
            return $this->responseJson(
                true,
                200,
                $message,
                ["employee" => $employee,'redirect_url' => route('admin.employee.address.form', $employee->emp_id)]
            );
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }
    public function deleteSalaryHistory(Request $request)
    {
        $request->validate([
            'id' => ['required', 'numeric'],
        ]);

        try {
            $SalaryHistory = SalaryHistory::find($request->id);
            if ($SalaryHistory) {
                $SalaryHistory->delete();
                $message = "Record deleted Successfully";
                return response()->json(['status' => true, 'message' => $message]);
            } else {
                return response()->json(['status' => false, 'error' => 'Record not found']);
            }
        } catch (Exception $e) {
            return response()->json(['status' => false, 'error' => $e->getMessage()]);
        }
    }

}
