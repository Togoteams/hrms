<?php

namespace App\Http\Controllers\Admin\Payroll;


use App\Http\Controllers\Controller;
use App\Models\Account;
use Illuminate\Http\Request;
use App\Models\PayRollPayscale;
use Illuminate\Support\Facades\Validator;
use Exception;
use Yajra\DataTables\DataTables;
use App\Models\Employee;
use App\Models\EmpSalary;
use App\Models\Holiday;
use Illuminate\Support\Facades\Auth;
use App\Models\Loans;
use App\Models\PayrollHead;
use App\Models\PayrollPayscaleHead;
use App\Models\LeaveApply;
use App\Models\PayrollSalary;
use App\Models\PayrollSalaryHead;
use App\Models\PayrollSalaryIncrement;
use App\Models\User;
use App\Traits\PayrollTraits;
use App\Traits\LeaveTraits;
class PayrollSalaryController extends Controller
{
    public  $page_name = "Payroll Salary";
    use PayrollTraits;
    use LeaveTraits;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, $year = null)
    {

        if ($year == null) {
            $year = date('Y');
        }

        if ($request->ajax()) {
            if(isemplooye())
            {
                $data = PayrollSalary::with('user', 'employee')
                ->where('user_id',auth()->user()->id)->get();

            }
            else{
                $data = PayrollSalary::with('user', 'employee')->get();

            }
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn = view('admin.payroll.salary.buttons', ['item' => $row, "route" => 'payroll.salary']);
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.payroll.salary.index', ['page' => $this->page_name]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create($user_id = null)
    {
        if ($user_id != null) {
            $all_users = Employee::where('status', 'active')->where('id', $user_id)->get();
        } else {
            $all_users = Employee::where('status', 'active')->get();
        }
        $page = $this->page_name;
        return view('admin.payroll.salary.create', ['page' => $this->page_name, 'all_users' => $all_users]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'user_id' => 'required|numeric',
            'pay_for_month_year' => 'required|string',
            'basic' => 'required|numeric',
            // 'fixed_deductions' => 'required|numeric',
            // 'other_deductions' => 'required|numeric',
            'net_take_home' => 'required|numeric',
            // 'ctc' => 'required|numeric',
            // 'total_employer_contribution' => 'required|numeric',
            'total_deduction' => 'required|numeric',
            'gross_earning' => 'required|numeric',
        ]);
        if ($validator->fails()) {
            return $validator->errors();
        } else {
            try {
                $emp = Employee::where('user_id', $request->user_id)->first();
                $payroll = PayrollSalary::create([
                    'employee_id' => Employee::where('user_id', $request->user_id)->first()->id,
                    'user_id' => $request->user_id,
                    'pay_for_month_year' =>  $request->pay_for_month_year,
                    'basic' =>  $request->basic,
                    'fixed_deductions' =>  $request->fixed_deductions,
                    'other_deductions' =>  $request->other_deductions,
                    'no_of_payable_days' =>  $request->no_of_payable_days,
                    'no_of_persent_days' =>  $request->no_of_persent_days,
                    'annual_balanced_leave' =>  $request->annual_balanced_leave,
                    'total_working_days' =>  $request->total_working_days,
                    'net_take_home' =>  $request->net_take_home,
                    'ctc' =>  $request->ctc,
                    'total_employer_contribution' =>  $request->total_employer_contribution,
                    'total_deduction' =>  $request->total_deduction,
                    'gross_earning' =>  $request->gross_earning,
                    'created_by' => auth()->user()->id
                ]);
                // echo $payroll;
                if($accountId = Account::where('name','Salaries')->value('id'))
                {
                    $data['account_id'] = $accountId;
                    $data['transaction_number'] =rand(1111111,9999999);
                    $data['transaction_type'] = "debit";
                    $data['transaction_amount'] = $payroll->total_deduction+$payroll->gross_earning;
                    $data['transaction_currency'] ="BWP";
                    $data['transaction_at'] = date('Y-m-d H:i:s');
                    $data['refrence_id'] =$payroll->id;
                    $data['refrence_table_type'] =get_class($payroll);
                    $this->saveTtumData($data);
                }
                $empAccounts = Account::where('name',$emp->user->name)->first();
                if(empty($empAccounts))
                {   
                    $empAccounts = Account::create(['name'=>$emp->user->name,'opening_amount'=>0,'closing_amount'=>0]);
                }
                if($empAccounts)
                {
                    $data['account_id'] = $empAccounts->id;
                    $data['transaction_number'] =rand(1111111,9999999);
                    $data['transaction_type'] = "credit";
                    $data['transaction_amount'] = $payroll->total_deduction+$payroll->gross_earning;
                    $data['transaction_currency'] ="BWP";
                    $data['user_id'] =$payroll->user_id;
                    $data['transaction_at'] = date('Y-m-d H:i:s');
                    $data['refrence_id'] =$payroll->id;
                    $data['refrence_table_type'] =get_class($payroll);
                    $this->saveTtumData($data);
                }

                // dd($payroll);
                foreach ($request->all() as $key => $value) {
                    $head =  PayrollHead::where('slug', $key)->first();
                    if ($head) {
                        PayrollSalaryHead::create([
                            'payroll_head_id' => $head->id,
                            'payroll_salary_id' => $payroll->id,
                            'value' => $request->$key,
                            'created_by' => auth()->user()->id
                        ]);
                    }
                }


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
        $all_users = Employee::get();
        $loans = Loans::where('status', 'active')->get();
        $data = PayrollSalary::find($id);

        return view('admin.payroll.salary.show', ['data' => $data, 'page' => $this->page_name, 'all_users' => $all_users, 'loans' => $loans]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $edit = true;
        $payscale = PayrollSalary::find($id);
        $page = $this->page_name;
        $emp = Employee::where('user_id', $payscale->user_id)->first();
        $data = PayrollSalary::where('user_id', $payscale->user_id)->first();
        $emp_head = PayrollHead::where('employment_type', $emp->employment_type)->orWhere('employment_type', 'both')->where('status', 'active')->where('for', 'payscale')->orWhere('for', 'both')->where('deleted_at', null)->get();
        return view('admin.payroll.salary.edit', ['html' => view('admin.payroll.salary.employee_head', compact('emp_head', 'page', 'data', 'edit')), 'data' => $payscale]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|numeric',
            'pay_for_month_year' => 'required|string',
            'basic' => 'required|numeric',
            // 'fixed_deductions' => 'required|numeric',
            // 'other_deductions' => 'required|numeric',
            'net_take_home' => 'required|numeric',
            // 'ctc' => 'required|numeric',
            // 'total_employer_contribution' => 'required|numeric',
            'total_deduction' => 'required|numeric',
            'gross_earning' => 'required|numeric',
        ]);
        if ($validator->fails()) {
            return $validator->errors();
        } else {
            try {
                $payroll = PayrollSalary::where('id', $id)->update([
                    'employee_id' => Employee::where('user_id', $request->user_id)->first()->id,
                    'user_id' => $request->user_id,
                    'pay_for_month_year' =>  $request->pay_for_month_year,
                    'basic' =>  $request->basic,
                    // 'fixed_deductions' =>  $request->fixed_deductions,
                    // 'other_deductions' =>  $request->other_deductions,
                    'net_take_home' =>  $request->net_take_home,
                    // 'ctc' =>  $request->ctc,
                    // 'total_employer_contribution' =>  $request->total_employer_contribution,
                    'total_deduction' =>  $request->total_deduction,
                    'gross_earning' =>  $request->gross_earning,
                    'created_by' => auth()->user()->id

                ]);
                foreach ($request->all() as $key => $value) {
                    $head =  PayrollHead::where('slug', $key)->first();
                    if ($head) {
                        PayrollSalaryHead::where('payroll_head_id', $head->id)->where('payroll_salary_id', $id)->update([
                            'payroll_head_id' => $head->id,
                            'value' => $request->$key,
                            'updated_by' => auth()->user()->id
                        ]);
                    }
                }

                return response()->json(['success' => $this->page_name . " Added Successfully"]);
            } catch (Exception $e) {
                return response()->json(['error' => $e->getMessage()]);
            }
        }
    }

    public function status($id)
    {
        if (PayrollSalary::find($id)->status == "active") {
            PayrollSalary::where('id', $id)->update(['status' => 'inactive']);
            return "InActive";
        } else {
            PayrollSalary::where('id', $id)->update(['status' => 'active']);
            return "Active";
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $user =  PayrollSalary::find($id);
            PayrollSalary::destroy($id);
            User::destroy($user->user_id);
            return "Delete";
        } catch (Exception $e) {
            return ["error" => $this->page_name . "Can't Be Delete this May having some Employee"];
        }
    } //

    public function print($user_id)
    {

        $data = PayrollSalary::with(['user', 'employee', 'employee.branch', 'employee.designation','department','payrollSalaryHead','payrollSalaryHead.payroll_head'])->where('user_id', $user_id)->first();
        $salary = EmpSalary::where('user_id', $user_id)->first();
     
        // if($data->employee->employment_type=="local")
        // {
            return view('admin.payroll.salary.salary-slip-local', compact('data', 'salary'));
        // }else
        // {
        //     return view('admin.payroll.salary.salary-slip-ibo', compact('data', 'salary'));
        // }
    }

    public function get_employee_data($user_id = null,$salary_month = null)
    {
        $page = $this->page_name;
        $salaryMonth = $salary_month;
        $salaryStartDate = date("Y-m-d", strtotime("-1 months",strtotime($salaryMonth."-20")));
        $salaryEndDate = $salaryMonth;
        // echo $salaryStartDate."---";
        // echo $salaryEndDate;
        $emp = Employee::where('user_id', $user_id)->first();
        $data = PayRollPayscale::where('user_id', $user_id)->orderByDesc('id')->first();
        if(empty($data))
        {
             return response()->json("Pay Scale not defined");
        }
        $emp_head = PayrollHead::where('employment_type', $emp->employment_type)->orWhere('employment_type', 'both')->where('status', 'active')->orWhere('for', 'both')->where('deleted_at', null)->get();
        
        $arrears = PayrollSalaryIncrement::where('financial_year',date('Y'))->where('employment_type',$emp->employment_type)->where('effective_from','<=',date('Y-m-d h:i:s'))->where('effective_to','>=',date('Y-m-d h:i:s'))->first();
        $currentData = date('Y-m-d H:i:s');
        // return $currentData;
        $arrearsNoOfMonth=0;
        if($arrears){
            $effectiveFromData = $arrears->effective_from;
            $arrearsNoOfMonth = diffInMonths($effectiveFromData,today());
        }

        $totalBalancedLeave = $this->getTotalBalancedLeave($user_id);
        $noOfPayableDays = 0;
        $noOfAvailedLeaves = 0;
        $totalMonthDays = date('t');
        if($emp->employment_type=="local")
        {
            $totalMonthDays = 24;
        }

        $noOfHoliday = Holiday::where('date','<=',date('Y-m-d'))->where('date','>',date('Y-m-d'))->where('status','active')->count();
        // return $noOfHoliday;
        $noOfAvailedLeaves = LeaveApply::where('user_id',$user_id)
        ->where('start_date','>',date('Y-m-'."01"))->where('end_date','>',date('Y-m-'."31"))
        ->where('is_approved',0)
        ->sum('leave_applies_for');

        $noOfPaidLeave = LeaveApply::where('user_id',$user_id)
        ->where('start_date','>',date('Y-m-'."01"))->where('end_date','>',date('Y-m-'."31"))
        ->where('is_paid','paid')
        ->sum('leave_applies_for');

        $noOfUnPaidLeave = LeaveApply::where('user_id',$user_id)
        ->where('start_date','>',date('Y-m-'."01"))->where('end_date','>',date('Y-m-'."31"))
        ->where('is_paid','paid')
        ->sum('leave_applies_for');
        
        $noOfUnapprovedLeave = LeaveApply::where('user_id',$user_id)
        ->where('start_date','>',date('Y-m-'."01"))->where('end_date','>',date('Y-m-'."31"))
        ->whereNotIn('status',['approved','rejected'])
        ->sum('leave_applies_for');
        
        // return $noOfempLeave;
        $presentDay = $totalMonthDays - $noOfHoliday - $noOfAvailedLeaves;
        $noOfPayableDays =$totalMonthDays - $noOfHoliday- $noOfUnPaidLeave;

        return view('admin.payroll.salary.employee_head', compact('emp_head', 'noOfAvailedLeaves','page','noOfPayableDays','totalBalancedLeave', 'arrearsNoOfMonth','presentDay','noOfHoliday','totalMonthDays','data','emp'));
    }
}
