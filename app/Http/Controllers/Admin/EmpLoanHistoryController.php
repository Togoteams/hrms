<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Models\Account;
use App\Models\EmpLoanHistory;
use App\Models\Employee;
use App\Models\User;
use Exception;
use Illuminate\Support\Str;

class EmpLoanHistoryController extends BaseController
{
    //

    public function viewEmpLoanHistory($eid = null)
    {
        $employee = getEmployee($eid);
        $empLoanHistories = EmpLoanHistory::where('user_id', $employee->user_id)->get();
        $loanAccounts = Account::whereIn('slug', ['personal_loan', 'mortgage_loan', 'car_loan', 'salary_advance'])->get();
        // return $empLoanHistories;
        $currencies = ['pula'];
        if ($employee->employment_type == "expatriate") {
            $currencies = ['usd'];
        }

        return view('admin.employees.emp-loan-histories', ['employee' => $employee, 'currencies' => $currencies, 'empLoanHistories' => $empLoanHistories, 'loanAccounts' => $loanAccounts]);
    }

    public function postEmpLoanHistory(Request $request)
    {
        $employee = Employee::firstWhere('user_id', $request->user_id);
        $request->validate([
            'user_id' => 'required|numeric',
            'employee_id' => 'required|numeric',
            'loan_types' => 'string|required',
            'loan_account_no' => 'required|numeric|digits:14',
            'loan_amount' => 'required|numeric',
            'emi_amount' => 'required|numeric',
            'description' => 'nullable|string',
        ]);




        try {
            if ($request->id == '') {
                $request->merge(['created_by' => auth()->user()->id, 'updated_by' => auth()->user()->id]);
                EmpLoanHistory::create($request->except(['_token', 'id']));
                $user = User::find($request->user_id);
                $accountData = ['account_number'=>$request->loan_account_no,'branch_id'=>$user->employee->branch_id,'user_id'=>$request->user_id,"account_type"=>"employee",'name'=>Str::title(str_replace('-', ' ',$request->loan_types))." of ".$user->name,'slug'=>$request->loan_types,'is_credit'=>1,'description'=>ucfirst($request->loan_types)." of ".$user->name];
                $account = Account::updateOrCreate(['account_number'=>$request->loan_account_no],$accountData);
                $message = "Loan History Created Successfully";
            } else {
                EmpLoanHistory::where('id', $request->id)->update($request->except(['_token', 'user_id', 'id']));
                $user = User::find($request->user_id);
                $accountData = ['account_number'=>$request->loan_account_no,'branch_id'=>$user->employee->branch_id,'user_id'=>$request->user_id,"account_type"=>"employee",'name'=>Str::title(str_replace('-', ' ',$request->loan_types))." of ".$user->name,'slug'=>$request->loan_types,'is_credit'=>1,'description'=>ucfirst($request->loan_types)." of ".$user->name];
                $account =Account::updateOrCreate(['account_number'=>$request->loan_account_no],$accountData);
                $message = "Loan History Updated Successfully";
            }

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
