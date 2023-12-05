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
use App\Models\Holiday;
use App\Models\Loans;
use App\Models\PayrollHead;
use App\Models\LeaveDate;
use App\Models\PayrollSalary;
use App\Models\PayrollSalaryHead;
use App\Models\PayrollSalaryIncrement;
use App\Models\User;
use App\Traits\PayrollTraits;
use App\Traits\LeaveTraits;
use App\Models\CurrencySetting;
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
           
            $data = PayrollSalary::with('user', 'employee')->getList()->get();
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
            'net_take_home' => 'required|numeric',
            'total_deduction' => 'required|numeric',
            'gross_earning' => 'required|numeric',
        ]);
        if ($validator->fails()) {
            return $validator->errors();
        } else {
            try {
                $emp = Employee::where('user_id', $request->user_id)->first();
                $net_take_home_in_pula =  $request->net_take_home;
                $currencyValue = 1;

                if($emp->employment_type=="expatriate")
                {
                    $currencyValue = getCurrencyValue("usd","pula");
                }
                
                $net_take_home_in_pula = $request->net_take_home * $currencyValue;
                $payroll = PayrollSalary::create([
                    'employee_id' => Employee::where('user_id', $request->user_id)->first()->id,
                    'user_id' => $request->user_id,
                    'pay_for_month_year' =>  $request->pay_for_month_year,
                    'basic' =>  $request->basic,
                    'fixed_deductions' =>  $request->fixed_deductions,
                    'employment_type' =>  $emp->employment_type,
                    'other_deductions' =>  $request->other_deductions,
                    'no_of_payable_days' =>  $request->no_of_payable_days,
                    'no_of_persent_days' =>  $request->no_of_persent_days,
                    'annual_balanced_leave' =>  $request->annual_balanced_leave,
                    'total_loss_of_pay' =>  $request->total_loss_of_pay,
                    'total_working_days' =>  $request->total_working_days,
                    'net_take_home' =>  $request->net_take_home,
                    'net_take_home_in_pula' =>  $net_take_home_in_pula,
                    'usd_pula_currency_amount' =>  $currencyValue,
                    'ctc' =>  $request->ctc,
                    'total_employer_contribution' =>  $request->total_employer_contribution,
                    'total_deduction' =>  $request->total_deduction,
                    'gross_earning' =>  $request->gross_earning,
                    'created_by' => auth()->user()->id
                ]);
                // echo $payroll;
                    
                    $data['account_id'] = $this->getTTUMAccount($emp->user->name)->id;
                    $data['transaction_number'] =rand(1111111,9999999);
                    $data['transaction_type'] = "credit";
                    $data['transaction_amount'] = $payroll->net_take_home * $currencyValue;
                    $data['transaction_currency'] = "BWP";
                    $data['user_id'] = $payroll->user_id;
                    $data['transaction_at'] = date('Y-m-d H:i:s');
                    $data['refrence_id'] = $payroll->id;
                    $data['refrence_table_type'] = get_class($payroll);
                    $this->saveTtumData($data);

                    $data['account_id'] = $this->getTTUMAccount("basic")->id;
                    $data['transaction_number'] =rand(1111111,9999999);
                    $data['transaction_type'] = "debit";
                    $data['transaction_amount'] = $request->basic * $currencyValue;
                    $data['transaction_currency'] = "BWP";
                    $data['user_id'] = $payroll->user_id;
                    $data['transaction_at'] = date('Y-m-d H:i:s');
                    $data['refrence_id'] = $payroll->id;
                    $data['refrence_table_type'] = get_class($payroll);
                    $this->saveTtumData($data);

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
                        if($request->$key >0)
                        {
                            $empAccounts = Account::where('name',$head->name)->first();
                            if(empty($empAccounts))
                            {
                                $empAccounts = Account::create(['name'=>$head->name,'account_type'=>"office"]);
                            }
                            $data['account_id'] = $empAccounts->id;
                            $data['transaction_number'] =rand(1111111,9999999);
                            $transaction_type  = "credit";
                            if($head->head_type=="income")
                            {
                                $transaction_type  = "debit";
                            }
                            $data['transaction_type'] = $transaction_type;
                            $data['transaction_amount'] = $request->$key * $currencyValue;
                            $data['transaction_currency'] ="BWP";
                            $data['transaction_at'] = date('Y-m-d H:i:s');
                            $data['refrence_id'] = $payroll->id;
                            $data['refrence_table_type'] =get_class($payroll);
                            $this->saveTtumData($data);
                        }
                        
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
        $emp = Employee::where('user_id', $payscale->user_id)->orderByDesc('id')->first();
        $data = PayrollSalary::where('user_id', $payscale->user_id)->first();
        // $emp_head = PayrollHead::where('employment_type', $emp->employment_type)->orWhere('employment_type', 'both')->where('status', 'active')->where('for', 'payscale')->orWhere('for', 'both')->where('deleted_at', null)->get();

        $salaryMonth = $payscale->pay_for_month_year;
        $salaryStartDate = date("Y-m-d", strtotime("-1 months",strtotime($salaryMonth."-20")));
        $salaryEndDate = date("Y-m-d", strtotime($salaryMonth."-20"));
        $user_id = $payscale->user_id;
        // while($holidayFound!=false)
        // {
            if(!isHolidayDate($salaryEndDate))
            {
                $holidayFound = false;
            }
            $salaryEndDate =  date('Y-m-d',(strtotime ( '-1 day' , strtotime ( $salaryEndDate) ) ));
        // }
        if(empty($data))
        {
             return response()->json("Pay Scale not defined");
        }
        $emp_head = PayrollHead::where('employment_type', $emp->employment_type)->orWhere('employment_type', 'both')->where('status', 'active')->where('deleted_at', null)->get();
        // return $emp_head;
        $arrears = PayrollSalaryIncrement::where('financial_year',date('Y'))->where('employment_type',$emp->employment_type)->where('effective_from','<=',date('Y-m-d h:i:s'))->where('effective_to','>=',date('Y-m-d h:i:s'))->first();
        $currentData = date('Y-m-d H:i:s');
        // return $currentData;
        $arrearsNoOfMonth=0;
        if($arrears){
            $effectiveFromData = $arrears->effective_from;
            $arrearsNoOfMonth = diffInMonths($effectiveFromData,today());
        }

        $totalBalancedLeave = $this->getTotalBalancedLeave($user_id);
        // return $totalBalancedLeave;
        $noOfPayableDays = 0;
        $noOfAvailedLeaves = 0;
        $totalMonthDays = date('t');
        if($emp->employment_type=="local")
        {
            $totalMonthDays = 24;
        }

        $noOfHoliday = Holiday::where('date','<=',$salaryStartDate)->where('date','>=',$salaryEndDate)
        ->where('status','active')->count();


        /**
         * This is no of paid  leave who take unpaid , approved and pending leave
         */

        $noOfUnPaidLeave = LeaveDate::with('leaveApply')->where(function ($query) use ($salaryStartDate, $salaryEndDate) {
            $query->where(function ($q1) use ($salaryStartDate, $salaryEndDate) {
                $q1->whereBetween('leave_date', array($salaryStartDate, $salaryEndDate))->where('pay_type',"");
            });
        })->whereHas('leaveApply', function($q) use ($user_id) {
            $q->where('user_id',$user_id)->where('is_paid','unpaid')->whereNotIn('status',['reject']);
        })->count();
        // return $noOfUnPaidLeave;
        /**
         * This is no of paid  leave who take paid and approved leave
         */

        $noOfPaidLeave = LeaveDate::with('leaveApply')->where(function ($query) use ($salaryStartDate, $salaryEndDate) {
            $query->where(function ($q1) use ($salaryStartDate, $salaryEndDate) {
                $q1->whereBetween('leave_date', array($salaryStartDate, $salaryEndDate))->where('pay_type',"");
            });
        })->whereHas('leaveApply', function($q) use ($user_id) {
            $q->where('user_id',$user_id)->where('is_paid','paid')
            ->where('status','approved');
        })->count();
        // return $noOfPaidLeave;

        $fullPaySickLeave = LeaveDate::with('leaveApply')->where(function ($query) use ($salaryStartDate, $salaryEndDate) {
            $query->where(function ($q1) use ($salaryStartDate, $salaryEndDate) {
                $q1->whereBetween('leave_date', array($salaryStartDate, $salaryEndDate))->where('pay_type','full_pay');
            });
        })->whereHas('leaveApply', function($q) use ($user_id) {
            $q->where('user_id',$user_id)->where('is_paid','paid')
            ->where('status','approved');
        })->count();

        $halfPayLeave = LeaveDate::with('leaveApply')->where(function ($query) use ($salaryStartDate, $salaryEndDate) {
            $query->where(function ($q1) use ($salaryStartDate, $salaryEndDate) {
                $q1->whereBetween('leave_date', array($salaryStartDate, $salaryEndDate))->where('pay_type','half_pay');
            });
        })->whereHas('leaveApply', function($q) use ($user_id) {
            $q->where('user_id',$user_id)
            ->where('status','approved');
        })->count();

        $quarterPayLeave = LeaveDate::with('leaveApply')->where(function ($query) use ($salaryStartDate, $salaryEndDate) {
            $query->where(function ($q1) use ($salaryStartDate, $salaryEndDate) {
                $q1->whereBetween('leave_date', array($salaryStartDate, $salaryEndDate))->where('pay_type','quarter_pay');
            });
        })->whereHas('leaveApply', function($q) use ($user_id) {
            $q->where('user_id',$user_id)
            ->where('status','approved');
        })->count();
        // return

        $noOfUnapprovedLeave = LeaveDate::with('leaveApply')->where(function ($query) use ($salaryStartDate, $salaryEndDate) {
            $query->where(function ($q1) use ($salaryStartDate, $salaryEndDate) {
                $q1->whereBetween('leave_date', array($salaryStartDate, $salaryEndDate))->where('pay_type',"");
            });
        })->whereHas('leaveApply', function($q) use ($user_id) {
            $q->where('user_id',$user_id)->where('is_paid','paid')->whereNotIn('status',['approved','reject']);
        })->count();

        $noOfDay = 0;

        $noOfAvailedLeaves = $noOfPaidLeave + ($fullPaySickLeave*2) + $halfPayLeave + $quarterPayLeave;

        $currencySeeting = CurrencySetting::where('currency_name_from','pula')->where('currency_name_to','usd')->first();
        $pulaToUSDAmount = 1;
        if(!empty($currencySeeting))
        {
            $pulaToUSDAmount = $currencySeeting->currency_amount_to;
        }
        
        $currencySeetingInrUsd = CurrencySetting::where('currency_name_from','inr')->where('currency_name_to','usd')->first();
        $inrToUSDAmount = 1;
        if(!empty($currencySeetingInrUsd))
        {
            $inrToUSDAmount = $currencySeetingInrUsd->currency_amount_to;
        }

        $totalLosOfPayLeave =  $noOfUnapprovedLeave + $noOfUnPaidLeave + ($halfPayLeave/2) + ($quarterPayLeave * 0.75);
        // echo $noOfUnPaidLeave;
        // return $noOfUnapprovedLeave;
        // $noOfPayableDays
        $presentDay = intval($totalMonthDays - $noOfHoliday - ($noOfAvailedLeaves + $noOfUnPaidLeave + $noOfUnapprovedLeave + $quarterPayLeave));
        if( $presentDay<0)
        {
            $presentDay =0;
        }
        // return $presentDay;
        $noOfPayableDays = $totalMonthDays  - ($noOfHoliday+$noOfUnPaidLeave + $noOfUnapprovedLeave + ($halfPayLeave/2)+($quarterPayLeave * 0.25));
        $salary_month = $salaryMonth;
        if($emp->employment_type=="expatriate")
        {
            $viewComponent = view('admin.payroll.salary.employee_head_for_ibo', compact('emp_head','edit','salary_month','totalLosOfPayLeave' ,'noOfAvailedLeaves','page','noOfPayableDays','totalBalancedLeave', 'arrearsNoOfMonth','presentDay','noOfHoliday','totalMonthDays','data','emp','pulaToUSDAmount','inrToUSDAmount'));
        }else{
            $viewComponent =  view('admin.payroll.salary.employee_head', compact('emp_head','edit','salary_month','totalLosOfPayLeave' ,'noOfAvailedLeaves','page','noOfPayableDays','totalBalancedLeave', 'arrearsNoOfMonth','presentDay','noOfHoliday','totalMonthDays','data','emp'));
        }
       
        return view('admin.payroll.salary.edit', ['html' => $viewComponent, 'data' => $payscale,'salary_month'=>$salaryMonth]);
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
            'net_take_home' => 'required|numeric',
            'total_deduction' => 'required|numeric',
            'gross_earning' => 'required|numeric',
        ]);
        if ($validator->fails()) {
            return $validator->errors();
        } else {
            try {
                $emp = Employee::where('user_id', $request->user_id)->first();
                $payroll = PayrollSalary::where('id',$id)->update([
                    'employee_id' => Employee::where('user_id', $request->user_id)->first()->id,
                    'user_id' => $request->user_id,
                    'pay_for_month_year' =>  $request->pay_for_month_year,
                    'basic' =>  $request->basic,
                    'fixed_deductions' =>  $request->fixed_deductions,
                    'employment_type' =>  $emp->employment_type,
                    'other_deductions' =>  $request->other_deductions,
                    'no_of_payable_days' =>  $request->no_of_payable_days,
                    'no_of_persent_days' =>  $request->no_of_persent_days,
                    'annual_balanced_leave' =>  $request->annual_balanced_leave,
                    'total_loss_of_pay' =>  $request->total_loss_of_pay,
                    'total_working_days' =>  $request->total_working_days,
                    'net_take_home' =>  $request->net_take_home,
                    'ctc' =>  $request->ctc,
                    'total_employer_contribution' =>  $request->total_employer_contribution,
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

                return response()->json(['success' => $this->page_name . " Update Successfully"]);
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

    public function print($salaryId)
    {

        $data = PayrollSalary::with(['user', 'employee', 'employee.branch', 'employee.designation','department','payrollSalaryHead','payrollSalaryHead.payroll_head'])->where('id', $salaryId)->first();
        $currencySeeting = CurrencySetting::where('currency_name_from','pula')->where('currency_name_to','usd')->first();
        $pulaToUSDAmount=1;
        if(!empty($currencySeeting))
        {
            $pulaToUSDAmount = $currencySeeting->currency_amount_to;
        }

        $currencySeetingInrUsd = CurrencySetting::where('currency_name_from','inr')->where('currency_name_to','usd')->first();
        $inrToUSDAmount = 1;
        if(!empty($currencySeetingInrUsd))
        {
            $inrToUSDAmount = $currencySeetingInrUsd->currency_amount_to;
        }
        $currencySeetingUsdToPula = CurrencySetting::where('currency_name_from','usd')->where('currency_name_to','pula')->first();
        $usdToPullAmount = 1;
        if(!empty($currencySeetingUsdToPula))
        {
            $usdToPullAmount = $currencySeetingUsdToPula->currency_amount_to;
        }
        if($data->employee->employment_type=="local")
        {
            return view('admin.payroll.salary.salary-slip-local', compact('data'));
        }else
        {
            return view('admin.payroll.salary.salary-slip-ibo', compact('data','pulaToUSDAmount','inrToUSDAmount','usdToPullAmount'));
        }
    }

    public function get_employee_data($user_id = null,$salary_month = null)
    {
        $page = $this->page_name;
        $salaryMonth = $salary_month;
        $salaryStartDate = date("Y-m-d", strtotime("-1 months",strtotime($salaryMonth."-20")));
        $salaryEndDate = date("Y-m-d", strtotime($salaryMonth."-20"));
        $holidayFound = false;
        do{
            if(isHolidayDate($salaryEndDate))
            {
                $holidayFound = true;
                $salaryEndDate =  date('Y-m-d',(strtotime ( '-1 day' , strtotime ( $salaryEndDate) ) ));
            }else{
                $holidayFound = false;
            }
        }while($holidayFound);

        $emp = Employee::where('user_id', $user_id)->first();
        $data = PayRollPayscale::where('user_id', $user_id)->orderByDesc('id')->first();
        if(empty($data))
        {
             return response()->json("Pay Scale not defined");
        }
        $emp_head = PayrollHead::where('employment_type', $emp->employment_type)->orWhere('employment_type', 'both')->where('status', 'active')->where('deleted_at', null)->get();
        // return $emp_head;
        $arrears = PayrollSalaryIncrement::where('financial_year',date('Y'))->where('employment_type',$emp->employment_type)->where('effective_from','<=',date('Y-m-d h:i:s'))->where('effective_to','>=',date('Y-m-d h:i:s'))->first();
        $currentData = date('Y-m-d H:i:s');
        // return $currentData;
        $arrearsNoOfMonth=0;
        if($arrears){
            $effectiveFromData = $arrears->effective_from;
            $arrearsNoOfMonth = diffInMonths($effectiveFromData,today());
        }

        $totalBalancedLeave = $this->getTotalBalancedLeave($user_id);
        // return $totalBalancedLeave;
        $noOfPayableDays = 0;
        $noOfAvailedLeaves = 0;
        $totalMonthDays = date('t');
        if($emp->employment_type=="local")
        {
            $totalMonthDays = 24;
        }

        $noOfHoliday = Holiday::where('date','<=',$salaryStartDate)->where('date','>=',$salaryEndDate)
        ->where('status','active')->count();


        /**
         * This is no of paid  leave who take unpaid , approved and pending leave
         */

        $noOfUnPaidLeave = LeaveDate::with('leaveApply')->where(function ($query) use ($salaryStartDate, $salaryEndDate) {
            $query->where(function ($q1) use ($salaryStartDate, $salaryEndDate) {
                $q1->whereBetween('leave_date', array($salaryStartDate, $salaryEndDate))->where('pay_type',"");
            });
        })->whereHas('leaveApply', function($q) use ($user_id) {
            $q->where('user_id',$user_id)->where('is_paid','unpaid')->whereNotIn('status',['reject']);
        })->count();
        // return $noOfUnPaidLeave;
        /**
         * This is no of paid  leave who take paid and approved leave
         */

        $noOfPaidLeave = LeaveDate::with('leaveApply')->where(function ($query) use ($salaryStartDate, $salaryEndDate) {
            $query->where(function ($q1) use ($salaryStartDate, $salaryEndDate) {
                $q1->whereBetween('leave_date', array($salaryStartDate, $salaryEndDate))->where('pay_type',"");
            });
        })->whereHas('leaveApply', function($q) use ($user_id) {
            $q->where('user_id',$user_id)->where('is_paid','paid')
            ->where('status','approved');
        })->count();
        // return $noOfPaidLeave;

        $fullPaySickLeave = LeaveDate::with('leaveApply')->where(function ($query) use ($salaryStartDate, $salaryEndDate) {
            $query->where(function ($q1) use ($salaryStartDate, $salaryEndDate) {
                $q1->whereBetween('leave_date', array($salaryStartDate, $salaryEndDate))->where('pay_type','full_pay');
            });
        })->whereHas('leaveApply', function($q) use ($user_id) {
            $q->where('user_id',$user_id)->where('is_paid','paid')
            ->where('status','approved');
        })->count();

        $halfPayLeave = LeaveDate::with('leaveApply')->where(function ($query) use ($salaryStartDate, $salaryEndDate) {
            $query->where(function ($q1) use ($salaryStartDate, $salaryEndDate) {
                $q1->whereBetween('leave_date', array($salaryStartDate, $salaryEndDate))->where('pay_type','half_pay');
            });
        })->whereHas('leaveApply', function($q) use ($user_id) {
            $q->where('user_id',$user_id)
            ->where('status','approved');
        })->count();

        $quarterPayLeave = LeaveDate::with('leaveApply')->where(function ($query) use ($salaryStartDate, $salaryEndDate) {
            $query->where(function ($q1) use ($salaryStartDate, $salaryEndDate) {
                $q1->whereBetween('leave_date', array($salaryStartDate, $salaryEndDate))->where('pay_type','quarter_pay');
            });
        })->whereHas('leaveApply', function($q) use ($user_id) {
            $q->where('user_id',$user_id)
            ->where('status','approved');
        })->count();
        // return

        $noOfUnapprovedLeave = LeaveDate::with('leaveApply')->where(function ($query) use ($salaryStartDate, $salaryEndDate) {
            $query->where(function ($q1) use ($salaryStartDate, $salaryEndDate) {
                $q1->whereBetween('leave_date', array($salaryStartDate, $salaryEndDate))->where('pay_type',"");
            });
        })->whereHas('leaveApply', function($q) use ($user_id) {
            $q->where('user_id',$user_id)->where('is_paid','paid')->whereNotIn('status',['approved','reject']);
        })->count();

        $noOfDay = 0;

        $noOfAvailedLeaves = $noOfPaidLeave + ($fullPaySickLeave*2) + $halfPayLeave + $quarterPayLeave;

        $currencySeeting = CurrencySetting::where('currency_name_from','pula')->where('currency_name_to','usd')->first();
        $pulaToUSDAmount = 1;
        if(!empty($currencySeeting))
        {
            $pulaToUSDAmount = $currencySeeting->currency_amount_to;
        }
        
        $currencySeetingInrUsd = CurrencySetting::where('currency_name_from','inr')->where('currency_name_to','usd')->first();
        $inrToUSDAmount = 1;
        if(!empty($currencySeetingInrUsd))
        {
            $inrToUSDAmount = $currencySeetingInrUsd->currency_amount_to;
        }

        $totalLosOfPayLeave =  $noOfUnapprovedLeave + $noOfUnPaidLeave + ($halfPayLeave/2) + ($quarterPayLeave * 0.75);
        // echo $noOfUnPaidLeave;
        // return $noOfUnapprovedLeave;
        // $noOfPayableDays
        $presentDay = intval($totalMonthDays - $noOfHoliday - ($noOfAvailedLeaves + $noOfUnPaidLeave + $noOfUnapprovedLeave + $quarterPayLeave));
        if( $presentDay<0)
        {
            $presentDay =0;
        }
        // return $presentDay;
        $noOfPayableDays = $totalMonthDays  - ($noOfHoliday+$noOfUnPaidLeave + $noOfUnapprovedLeave + ($halfPayLeave/2)+($quarterPayLeave * 0.25));

        if($emp->employment_type=="expatriate")
        {
            return view('admin.payroll.salary.employee_head_for_ibo', compact('emp_head','salary_month','totalLosOfPayLeave' ,'noOfAvailedLeaves','page','noOfPayableDays','totalBalancedLeave', 'arrearsNoOfMonth','presentDay','noOfHoliday','totalMonthDays','data','emp','pulaToUSDAmount','inrToUSDAmount'));
        }else{
            return view('admin.payroll.salary.employee_head', compact('emp_head','salary_month','totalLosOfPayLeave' ,'noOfAvailedLeaves','page','noOfPayableDays','totalBalancedLeave', 'arrearsNoOfMonth','presentDay','noOfHoliday','totalMonthDays','data','emp'));

        }
    }
}
