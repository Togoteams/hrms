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
        $employee = Employee::firstWhere('user_id', $request->user_id);
        $request->validate([
            'user_id'   => ['required', 'string'],
            'basic_salary'          => ['nullable', 'numeric', 'min:2000', 'max:1000000'],
            'basic_salary_for_india' => ['nullable', 'numeric', 'min:2000', 'max:1000000'],
            'currency_salary_for_india'  => ['nullable', 'string'],
            'salary_type'  => ['nullable', 'string'],
            'da' => ['nullable', 'numeric','between:1,100'],
            'date_of_current_basic' => ['nullable', 'date'],
            'currency_salary'       => ['required', 'string'],
            'pension_opt'           => ['nullable', 'numeric'],
            'pension_contribution'  => ['nullable', 'string'],
            'amount_payable_to_bomaind_each_year' => ['nullable', 'numeric'],
        ]);

        try {
            if ($request->id == '') {
                SalaryHistory::insertGetId($request->except(['_token', 'id']));
                $message = "Salary History Created Successfully";
            } else {
                SalaryHistory::where('id', $request->id)->update($request->except(['_token', 'user_id', 'id']));
                $message = "Salary History Updated Successfully";
            }
            
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
