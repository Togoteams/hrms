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
use App\Models\SalaryHistory;
use App\Traits\LeaveTraits;
use App\Models\CurrencySetting;
use App\Models\LeaveEncashment;

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
            // try {
            $emp = Employee::where('user_id', $request->user_id)->first();
            $net_take_home_in_pula =  $request->net_take_home;
            $currencyValue = 1;

            if ($emp->employment_type == "expatriate") {
                $currencyValue = getCurrencyValue("usd", "pula");
            }
            $usdToInr = getCurrencyValue("usd", "inr");
            $pulaToInr = getCurrencyValue("pula", "inr");

            $net_take_home_in_pula = number_format($request->net_take_home * $currencyValue, 2, '.', '');
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
                'leave_encashment_amount' =>  $request->leave_encashment_amount,
                'leave_encashment_days' =>  $request->leave_encashment_days,
                'net_take_home' =>  $request->net_take_home,
                'net_take_home_in_pula' =>  $net_take_home_in_pula,
                'usd_pula_currency_amount' =>  $currencyValue,
                'usd_inr_currency_amount' =>  $usdToInr,
                'pula_inr_currency_amount' =>  $pulaToInr,
                'ctc' =>  $request->ctc,
                'total_employer_contribution' =>  $request->total_employer_contribution,
                'total_deduction' =>  $request->total_deduction,
                'gross_earning' =>  $request->gross_earning,
                'created_by' => auth()->user()->id,
                'branch_id' => $emp->branch_id,
            ]);

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
            /**
             * This Creating TTUM Report of Each Account
             */
             $this->createTTum($payroll->id);

            return response()->json(['success' => $this->page_name . " Added Successfully"]);
            // } catch (Exception $e) {
            //     return response()->json(['error' => $e->getMessage()]);
            // }
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
        $salaryStartDate = date("Y-m-d", strtotime("-1 months", strtotime($salaryMonth . "-20")));
        $salaryEndDate = date("Y-m-d", strtotime($salaryMonth . "-20"));
        $user_id = $payscale->user_id;
        // while($holidayFound!=false)
        // {
        if (!isHolidayDate($salaryEndDate)) {
            $holidayFound = false;
        }
        $salaryEndDate =  date('Y-m-d', (strtotime('-1 day', strtotime($salaryEndDate))));
        // }
        if (empty($data)) {
            return response()->json("Pay Scale not defined");
        }
        $emp_head = PayrollHead::where('employment_type', $emp->employment_type)->orWhere('employment_type', 'both')->where('status', 'active')->where('deleted_at', null)->get();
        // return $emp_head;
        $arrears = PayrollSalaryIncrement::where('financial_year', date('Y'))->where('employment_type', $emp->employment_type)->where('effective_from', '<=', date('Y-m-d h:i:s'))->where('effective_to', '>=', date('Y-m-d h:i:s'))->first();
        $currentData = date('Y-m-d H:i:s');
        // return $currentData;
        $arrearsNoOfMonth = 0;
        if ($arrears) {
            $effectiveFromData = $arrears->effective_from;
            $arrearsNoOfMonth = diffInMonths($effectiveFromData, today());
        }

        $totalBalancedLeave = $this->getTotalBalancedLeave($user_id);
        // return $totalBalancedLeave;
        $noOfPayableDays = 0;
        $noOfAvailedLeaves = 0;
        $totalMonthDays = date('t');
        if ($emp->employment_type == "local") {
            $totalMonthDays = 24;
        }

        $noOfHoliday = Holiday::where('date', '<=', $salaryStartDate)->where('date', '>=', $salaryEndDate)
            ->where('status', 'active')->count();


        /**
         * This is no of paid  leave who take unpaid , approved and pending leave
         */


        $noOfUnPaidLeave = LeaveDate::with('leaveApply')->where(function ($query) use ($salaryStartDate, $salaryEndDate) {
            $query->where(function ($q1) use ($salaryStartDate, $salaryEndDate) {
                $q1->whereBetween('leave_date', array($salaryStartDate, $salaryEndDate))->where('pay_type', "");
            });
        })->whereHas('leaveApply', function ($q) use ($user_id) {
            $q->where('user_id', $user_id)->where('is_paid', 'unpaid')->whereNotIn('status', ['reject']);
        })->count();
        // return $noOfUnPaidLeave;
        /**
         * This is no of paid  leave who take paid and approved leave
         */

        $noOfPaidLeave = LeaveDate::with('leaveApply')->where(function ($query) use ($salaryStartDate, $salaryEndDate) {
            $query->where(function ($q1) use ($salaryStartDate, $salaryEndDate) {
                $q1->whereBetween('leave_date', array($salaryStartDate, $salaryEndDate))->where('pay_type', "");
            });
        })->whereHas('leaveApply', function ($q) use ($user_id) {
            $q->where('user_id', $user_id)->where('is_paid', 'paid')
                ->where('status', 'approved');
        })->count();
        // return $noOfPaidLeave;

        $fullPaySickLeave = LeaveDate::with('leaveApply')->where(function ($query) use ($salaryStartDate, $salaryEndDate) {
            $query->where(function ($q1) use ($salaryStartDate, $salaryEndDate) {
                $q1->whereBetween('leave_date', array($salaryStartDate, $salaryEndDate))->where('pay_type', 'full_pay');
            });
        })->whereHas('leaveApply', function ($q) use ($user_id) {
            $q->where('user_id', $user_id)->where('is_paid', 'paid')
                ->where('status', 'approved');
        })->count();

        $halfPayLeave = LeaveDate::with('leaveApply')->where(function ($query) use ($salaryStartDate, $salaryEndDate) {
            $query->where(function ($q1) use ($salaryStartDate, $salaryEndDate) {
                $q1->whereBetween('leave_date', array($salaryStartDate, $salaryEndDate))->where('pay_type', 'half_pay');
            });
        })->whereHas('leaveApply', function ($q) use ($user_id) {
            $q->where('user_id', $user_id)
                ->where('status', 'approved');
        })->count();

        $quarterPayLeave = LeaveDate::with('leaveApply')->where(function ($query) use ($salaryStartDate, $salaryEndDate) {
            $query->where(function ($q1) use ($salaryStartDate, $salaryEndDate) {
                $q1->whereBetween('leave_date', array($salaryStartDate, $salaryEndDate))->where('pay_type', 'quarter_pay');
            });
        })->whereHas('leaveApply', function ($q) use ($user_id) {
            $q->where('user_id', $user_id)
                ->where('status', 'approved');
        })->count();
        // return

        $noOfUnapprovedLeave = LeaveDate::with('leaveApply')->where(function ($query) use ($salaryStartDate, $salaryEndDate) {
            $query->where(function ($q1) use ($salaryStartDate, $salaryEndDate) {
                $q1->whereBetween('leave_date', array($salaryStartDate, $salaryEndDate))->where('pay_type', "");
            });
        })->whereHas('leaveApply', function ($q) use ($user_id) {
            $q->where('user_id', $user_id)->where('is_paid', 'paid')->whereNotIn('status', ['approved', 'reject']);
        })->count();

        $noOfDay = 0;

        $noOfAvailedLeaves = $noOfPaidLeave + ($fullPaySickLeave * 2) + $halfPayLeave + $quarterPayLeave;


        $usdToPulaAmount = getCurrencyValue("usd", "pula");
        $usdToInrAmount = getCurrencyValue("usd", "inr");

        $totalLosOfPayLeave =  $noOfUnapprovedLeave + $noOfUnPaidLeave + ($halfPayLeave / 2) + ($quarterPayLeave * 0.75);
        // echo $noOfUnPaidLeave;
        // return $noOfUnapprovedLeave;
        // $noOfPayableDays
        $presentDay = intval($totalMonthDays - $noOfHoliday - ($noOfAvailedLeaves + $noOfUnPaidLeave + $noOfUnapprovedLeave + $quarterPayLeave));
        if ($presentDay < 0) {
            $presentDay = 0;
        }
        // return $presentDay;
        $noOfPayableDays = $totalMonthDays  - ($noOfHoliday + $noOfUnPaidLeave + $noOfUnapprovedLeave + ($halfPayLeave / 2) + ($quarterPayLeave * 0.25));
        $salary_month = $salaryMonth;

        $noOfEncashLeave = LeaveEncashment::whereBetween('approval_at', array($salaryStartDate, $salaryEndDate))->where('user_id', $user_id)->whereIn('status', ['approved'])->sum('available_leave_for_encashment');

        if ($emp->employment_type == "expatriate") {
            $viewComponent = view('admin.payroll.salary.employee_head_for_ibo', compact('emp_head', 'edit', 'noOfEncashLeave', 'salary_month', 'totalLosOfPayLeave', 'noOfAvailedLeaves', 'page', 'noOfPayableDays', 'totalBalancedLeave', 'arrearsNoOfMonth', 'presentDay', 'noOfHoliday', 'totalMonthDays', 'data', 'emp', 'usdToPulaAmount', 'usdToInrAmount'));
        } else {
            $viewComponent =  view('admin.payroll.salary.employee_head', compact('emp_head', 'edit', 'noOfEncashLeave', 'salary_month', 'totalLosOfPayLeave', 'noOfAvailedLeaves', 'page', 'noOfPayableDays', 'totalBalancedLeave', 'arrearsNoOfMonth', 'presentDay', 'noOfHoliday', 'totalMonthDays', 'data', 'emp'));
        }

        return view('admin.payroll.salary.edit', ['html' => $viewComponent, 'data' => $payscale, 'salary_month' => $salaryMonth]);
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
                $payroll = PayrollSalary::where('id', $id)->update([
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
                    'updated_by' => auth()->user()->id
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

        $data = PayrollSalary::with(['user', 'employee', 'employee.branch', 'employee.designation', 'department', 'payrollSalaryHead', 'payrollSalaryHead.payroll_head'])->where('id', $salaryId)->first();

        $usdToPulaAmount = getCurrencyValue("usd", "pula");
        $usdToInrAmount = getCurrencyValue("usd", "inr");
        // $usdToPullAmount = getCurrencyValue("usd", "pula");

        if ($data->employee->employment_type == "local") {
            return view('admin.payroll.salary.salary-slip-local', compact('data'));
        } else {
            return view('admin.payroll.salary.salary-slip-ibo', compact('data', 'usdToPulaAmount', 'usdToInrAmount'));
        }
    }

    public function get_employee_data($user_id = null, $salary_month = null)
    {
        $page = $this->page_name;
        $salaryMonth = $salary_month;
        $salaryStartDate = date("Y-m-d", strtotime("-1 months", strtotime($salaryMonth . "-20")));
        $salaryEndDate = date("Y-m-d", strtotime($salaryMonth . "-20"));
        $holidayFound = false;
        do {
            if (isHolidayDate($salaryEndDate)) {
                $holidayFound = true;
                $salaryEndDate =  date('Y-m-d', (strtotime('-1 day', strtotime($salaryEndDate))));
            } else {
                $holidayFound = false;
            }
        } while ($holidayFound);

        $emp = Employee::where('user_id', $user_id)->first();
        $data = PayRollPayscale::where('user_id', $user_id)->orderByDesc('id')->first();
        if (empty($data)) {
            return response()->json("Pay Scale not defined");
        }
        $emp_head = PayrollHead::where('employment_type', $emp->employment_type)->orWhere('employment_type', 'both')->where('status', 'active')->where('deleted_at', null)->get();
        // return $emp_head;
        $arrears = PayrollSalaryIncrement::where('financial_year', date('Y'))->where('employment_type', $emp->employment_type)->where('effective_from', '<=', date('Y-m-d h:i:s'))->where('effective_to', '>=', date('Y-m-d h:i:s'))->first();
        $currentData = date('Y-m-d H:i:s');
        // return $currentData;
        $arrearsNoOfMonth = 0;
        if ($arrears) {
            $effectiveFromData = $arrears->effective_from;
            $arrearsNoOfMonth = diffInMonths($effectiveFromData, today());
        }

        $totalBalancedLeave = $this->getTotalBalancedLeave($user_id);
        // return $totalBalancedLeave;
        $noOfPayableDays = 0;
        $noOfAvailedLeaves = 0;
        $totalMonthDays = date('t');
        if ($emp->employment_type == "local") {
            $totalMonthDays = 24;
        }

        $noOfHoliday = Holiday::where('date', '<=', $salaryStartDate)->where('date', '>=', $salaryEndDate)
            ->where('status', 'active')->count();


        /**
         * This is no of paid  leave who take unpaid , approved and pending leave
         */

        $noOfUnPaidLeave = LeaveDate::with('leaveApply')->where(function ($query) use ($salaryStartDate, $salaryEndDate) {
            $query->where(function ($q1) use ($salaryStartDate, $salaryEndDate) {
                $q1->whereBetween('leave_date', array($salaryStartDate, $salaryEndDate))->where('pay_type', "");
            });
        })->whereHas('leaveApply', function ($q) use ($user_id) {
            $q->where('user_id', $user_id)->where('is_paid', 'unpaid')->whereNotIn('status', ['reject']);
        })->count();


        $reversalLeave = LeaveDate::with('leaveApply')->whereHas('leaveApply', function ($q) use ($user_id, $salaryStartDate, $salaryEndDate) {
            $q->where('user_id', $user_id)->where('is_reversal', 1)->whereBetween('reversal_at', array($salaryStartDate, $salaryEndDate))->whereIn('status', ['approved']);
        })->get();
        $totalReversalAmount = 0;
        foreach ($reversalLeave as $leaveDate) {
            $leaveStartDate = $leaveDate->leaveApply->start_date;
            $leaveEndDate = $leaveDate->leaveApply->end_date;
            $salaryHistory = SalaryHistory::where('date_of_current_basic', '<=', ($leaveStartDate))->orderBy('id', 'desc')->first();
            if ($salaryHistory) {
                $basicSalary = $salaryHistory->basic_salary;
                $totalReversalAmount += $salaryHistory->basic_salary / $totalMonthDays;
            }
        }
        // return  $totalReversalAmount;
        $noOfReversalLeave = count($reversalLeave);
        // return $noOfUnPaidLeave;
        /**
         * This is no of paid  leave who take paid and approved leave
         */

        $noOfPaidLeave = LeaveDate::with('leaveApply')->where(function ($query) use ($salaryStartDate, $salaryEndDate) {
            $query->where(function ($q1) use ($salaryStartDate, $salaryEndDate) {
                $q1->whereBetween('leave_date', array($salaryStartDate, $salaryEndDate))->where('pay_type', "");
            });
        })->whereHas('leaveApply', function ($q) use ($user_id) {
            $q->where('user_id', $user_id)->where('is_paid', 'paid')
                ->where('status', 'approved');
        })->count();
        // return $noOfPaidLeave;

        $fullPaySickLeave = LeaveDate::with('leaveApply')->where(function ($query) use ($salaryStartDate, $salaryEndDate) {
            $query->where(function ($q1) use ($salaryStartDate, $salaryEndDate) {
                $q1->whereBetween('leave_date', array($salaryStartDate, $salaryEndDate))->where('pay_type', 'full_pay');
            });
        })->whereHas('leaveApply', function ($q) use ($user_id) {
            $q->where('user_id', $user_id)->where('is_paid', 'paid')
                ->where('status', 'approved');
        })->count();

        $halfPayLeave = LeaveDate::with('leaveApply')->where(function ($query) use ($salaryStartDate, $salaryEndDate) {
            $query->where(function ($q1) use ($salaryStartDate, $salaryEndDate) {
                $q1->whereBetween('leave_date', array($salaryStartDate, $salaryEndDate))->where('pay_type', 'half_pay');
            });
        })->whereHas('leaveApply', function ($q) use ($user_id) {
            $q->where('user_id', $user_id)
                ->where('status', 'approved');
        })->count();

        $quarterPayLeave = LeaveDate::with('leaveApply')->where(function ($query) use ($salaryStartDate, $salaryEndDate) {
            $query->where(function ($q1) use ($salaryStartDate, $salaryEndDate) {
                $q1->whereBetween('leave_date', array($salaryStartDate, $salaryEndDate))->where('pay_type', 'quarter_pay');
            });
        })->whereHas('leaveApply', function ($q) use ($user_id) {
            $q->where('user_id', $user_id)
                ->where('status', 'approved');
        })->count();
        // return

        $noOfUnapprovedLeave = LeaveDate::with('leaveApply')->where(function ($query) use ($salaryStartDate, $salaryEndDate) {
            $query->where(function ($q1) use ($salaryStartDate, $salaryEndDate) {
                $q1->whereBetween('leave_date', array($salaryStartDate, $salaryEndDate))->where('pay_type', "");
            });
        })->whereHas('leaveApply', function ($q) use ($user_id) {
            $q->where('user_id', $user_id)->where('is_paid', 'paid')->whereNotIn('status', ['approved', 'reject']);
        })->count();

        $noOfDay = 0;

        $noOfAvailedLeaves = $noOfPaidLeave + ($fullPaySickLeave * 2) + $halfPayLeave + $quarterPayLeave;

        $usdToPulaAmount = getCurrencyValue("usd", "pula");
        $usdToInrAmount = getCurrencyValue("usd", "inr");

        $totalLosOfPayLeave =  $noOfUnapprovedLeave + $noOfUnPaidLeave + ($halfPayLeave / 2) + ($quarterPayLeave * 0.75);
        // echo $noOfUnPaidLeave;
        // return $noOfUnapprovedLeave;
        // $noOfPayableDays
        $presentDay = intval($totalMonthDays - $noOfHoliday - ($noOfAvailedLeaves + $noOfUnPaidLeave + $noOfUnapprovedLeave + $quarterPayLeave));
        if ($presentDay < 0) {
            $presentDay = 0;
        }
        // return $noOfReversalLeave;
        $noOfPayableDays = $totalMonthDays  - ($noOfHoliday + $noOfUnPaidLeave + $noOfUnapprovedLeave + ($halfPayLeave / 2) + ($quarterPayLeave * 0.25));
        $noOfEncashLeave = LeaveEncashment::whereBetween('approval_at', array($salaryStartDate, $salaryEndDate))->where('user_id', $user_id)->whereIn('status', ['approved'])->sum('available_leave_for_encashment');

        if ($emp->employment_type == "expatriate") {
            return view('admin.payroll.salary.employee_head_for_ibo', compact('emp_head', 'noOfReversalLeave', 'totalReversalAmount', 'noOfEncashLeave', 'salary_month', 'totalLosOfPayLeave', 'noOfAvailedLeaves', 'page', 'noOfPayableDays', 'totalBalancedLeave', 'arrearsNoOfMonth', 'presentDay', 'noOfHoliday', 'totalMonthDays', 'data', 'emp', 'usdToPulaAmount', 'usdToInrAmount'));
        } else {
            return view('admin.payroll.salary.employee_head', compact('emp_head', 'noOfEncashLeave', 'noOfReversalLeave', 'totalReversalAmount', 'salary_month', 'totalLosOfPayLeave', 'noOfAvailedLeaves', 'page', 'noOfPayableDays', 'totalBalancedLeave', 'arrearsNoOfMonth', 'presentDay', 'noOfHoliday', 'totalMonthDays', 'data', 'emp'));
        }
    }
}
