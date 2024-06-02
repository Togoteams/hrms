<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Models\Account;
use App\Models\EmpLoanHistory;
use App\Models\Employee;
use Exception;

class EmpLoanHistoryController extends BaseController
{
    //

    public function viewEmpLoanHistory($eid = null)
    {
        $employee = getEmployee($eid);
        $empLoanHistories= EmpLoanHistory::where('user_id',$employee->user_id)->get();
        $loanAccounts = Account::whereIn('slug',['personal_loan','mortgage_loan','car_loan','salary_advance'])->get();
        // return $empLoanHistories;
        $currencies = ['pula'];
        $isExpatriate = 0 ;
        if($employee->employment_type=="expatriate")
        {
            $currencies =['usd'];
            $isExpatriate = 1;
        }

        return view('admin.employees.emp-loan-histories', ['employee' => $employee,'currencies'=>$currencies,'empLoanHistories'=>$empLoanHistories,'loanAccounts'=>$loanAccounts]);
    }

    public function postEmpLoanHistory(Request $request)
    {
        $employee = Employee::firstWhere('user_id', $request->user_id);
        // return $request->all();
        $request->validate([
            'user_id' => 'required|numeric',
            'employee_id' => 'required|numeric',
            'loan_types' => 'string|required',
            'loan_account_no' => 'required|numeric',
            'loan_amount' => 'required|numeric',
            'loan_amount' => 'required|numeric',
            'emi_amount' => 'required|numeric',
            // 'emi_start_date' => 'required|date',
            // 'emi_end_date' => 'required|date|after_or_equal:emi_start_date|date_range_not_overlap',
            // 'tenure' => 'required|numeric',
            // 'last_emi_amount' => 'required|numeric',
            'description' => 'nullable|string',
        ]);


     

        try {
            if ($request->id == '') {
                $request->merge(['created_by'=>auth()->user()->id,'updated_by'=>auth()->user()->id]);
                // if(Account)
                EmpLoanHistory::create($request->except(['_token', 'id']));
                $message = "Loan History Created Successfully";
            } else {
                EmpLoanHistory::where('id', $request->id)->update($request->except(['_token', 'user_id', 'id']));
                $message = "Loan History Updated Successfully";
            }

            return $this->responseJson(
                true,
                200,
                $message,
                ["employee" => $employee,'redirect_url' => route('admin.employee.current-leaves.list', $employee->emp_id)]
            );
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }
    public function deleteEmpLoanHistory(Request $request)
    {
        $request->validate([
            'id' => ['required', 'numeric'],
        ]);

        try {
            $empLoanHistories = EmpLoanHistory::find($request->id);
            if ($empLoanHistories) {
                $empLoanHistories->delete();
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
