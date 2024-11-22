<?php

namespace App\Http\Controllers\Admin\Reports;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\CurrencySetting;
use App\Models\EmpCurrentLeave;
use App\Models\Employee;
use App\Models\LeaveActivityLog;
use Illuminate\Http\Request;
use App\Models\PayrollSalary;
use App\Models\LeaveApply;
use App\Models\LeaveDate;
use App\Models\LeaveSetting;
use App\Models\LeaveType;
use App\Models\PayrollHead;
use App\Models\PayrollSalaryHead;
use App\Models\PayrollSalaryIncrement;
use App\Models\Reimbursement;
use Exception;
use Yajra\DataTables\DataTables;
use App\Traits\PayrollTraits;
class ReportController extends Controller
{
    //
    use PayrollTraits;
    public $search_text,$employee_id,$search_type,$from_date,$pay_for_month_year,$to_date;
    public function reportsType()
    {
        return view('admin.reports.report-type');
    }
    public function salaryReport(Request $request)
    {
        $employees = Employee::getList()->getActiveEmp->get();
        $search_text = $request->search_text;
        $employee_id = $request->employee_id;
        $search_type = $request->search_type;
        $from_date = $request->from_date;
        $pay_for_month_year = $request->pay_for_month_year;
        $to_date = $request->to_date;
        if ($request->ajax()) {
            $data = PayrollSalary::filter()->with('user', 'employee')->getList()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->make(true);
        }
        return view('admin.reports.salary-report',compact('employees','employee_id','search_type','pay_for_month_year','to_date','search_text'));  
    }
    public function employeeArrearReport(Request $request)
    {
        $employees = Employee::getList()->getActiveEmp()->get();
        $search_text = $request->search_text;
        $employee_id = $request->employee_id;
        $financial_year = $request->financial_year;

        $search_type = $request->search_type;
        $from_date = $request->from_date;
        $pay_for_month_year = $request->pay_for_month_year;
        $to_date = $request->to_date;
        $reportArray = [];
        $deductionHead = "";
        $earningHead = "";
    
        $empData = Employee::find($employee_id);
        if($employee_id && $financial_year)
        {
            $salaryIncrementSetting = PayrollSalaryIncrement::where('employment_type',$empData->employment_type)->where('financial_year',$financial_year)->first();
            if(!empty($salaryIncrementSetting))
            {
                $monthArray = generateMonthArray($salaryIncrementSetting->effective_from,$salaryIncrementSetting->effective_to);
                foreach($monthArray as $key => $month)
                {
                    $reportArray[$key]['month']=$month;
                    $reportArray[$key]['increament_per'] = $salaryIncrementSetting->increment_percentage;
                    $reportArray[$key]['data'] = PayrollSalary::with('payrollSalaryHead','payrollSalaryHead.payroll_head')->where('employee_id',$employee_id)->where('pay_for_month_year',date("Y-m",strtotime($month)))->first();;
                    // $reportArray[$key]['month']=$month;
                }   
            }
         
                $deductionHead= PayrollHead::whereIn('employment_type',[$empData->employment_type,'both'])->where('head_type','deduction')->get();
                $earningHead = PayrollHead::whereIn('employment_type',[$empData->employment_type,'both'])->where('head_type','income')->get();
        }
        // return  $salaryIncrementSetting;
        return view('admin.reports.employee-arrear-report',compact('employees','deductionHead','earningHead','reportArray','financial_year','empData','employee_id','search_type','pay_for_month_year','to_date','search_text'));
    }
    public function leaveReport(Request $request)
    {
        $search_text = $request->search_text;
        $employee_id = $request->employee_id;
        $search_type = $request->search_type;
        $financial_year = $request->financial_year;
        $from_date = $request->from_date;
        $pay_for_month_year = $request->pay_for_month_year;
        $to_date = $request->to_date;
        $employee_data="";
        $leaveReportArr = [];
        $employees = Employee::getList()->getActiveEmp()->get();
        if($employee_id && $financial_year)
        {
            $employee_data = Employee::find($employee_id);
            $excludeArray = [];
            if($employee_data->gender=="male")
            {
                $excludeArray = ['maternity-leave'];
            }
            $user_id = $employee_data->user_id;
            $financialYears = explode("-",$financial_year);
            $from_date = date("Y-m-d",strtotime($financialYears[0]."-01-01"));
            $to_date = date("Y-m-d",strtotime($financialYears[0]."-12-31"));
            $leave_data = LeaveSetting::where('emp_type',getEmpType($employee_data->employment_type))->whereNotIn('slug',$excludeArray)->get();
            foreach($leave_data as $key => $leave)
            {
                $leave_type_id = $leave->id;
                $leaveReportArr[$key]['leave_type_name'] = $leave->name;
                $leaveReportArr[$key]['opening_balance'] = EmpCurrentLeave::where('leave_type_id',$leave_type_id)->where('created_at',"<=",$from_date)->where('employee_id',$employee_data->id)->value('leave_count') ?? 0;;
                $leaveReportArr[$key]['accural'] = LeaveActivityLog::where('activity_at',">=",$from_date)->where('activity_at',"<=",$to_date)->where('is_credit',1)->where('leave_type_id',$leave_type_id)->where('user_id',$user_id)->sum('leave_count') ?? 0;
                $leaveReportArr[$key]['adjustment'] = LeaveActivityLog::where('activity_at',">=",$from_date)->where('activity_at',"<=",$to_date)->where('is_adjustment',1)->where('leave_type_id',$leave_type_id)->where('user_id',$user_id)->sum('leave_count') ?? 0;;


                $leaveReportArr[$key]['leave_availed'] = LeaveDate::where('leave_date',">=",$from_date)->where('leave_date',"<=",$to_date)->whereHas('leaveApply',function($q) use ($user_id,$leave_type_id){
                    $q->where('user_id',$user_id)->where('leave_type_id',$leave_type_id);
                })->count();
                $leaveReportArr[$key]['leave_balance'] = EmpCurrentLeave::where('leave_type_id',$leave_type_id)->where('employee_id',$employee_data->id)->value('leave_count') ?? 0;
                $leaveReportArr[$key]['expiry_date_message'] = $leave?->expiry_date_message;
            }
        }
        // return $leaveReportArr;
       
        return view('admin.reports.leave-report',[
            'employees' => $employees,
            'employee_id' => $employee_id,
            'search_type' => $search_type,
            'financial_year' => $financial_year,
            'employee_data' => $employee_data,
            'leaveReportArr' => $leaveReportArr,
            'pay_for_month_year' => $pay_for_month_year,
            'to_date' => $to_date,
            'from_date' => $from_date,
            'search_text' => $search_text
        ]);
    }
    public function annualPayReport(Request $request)
    {
        $search_text = $request->search_text;
        $employee_id = $request->employee_id;
        $search_type = $request->search_type;
        $financial_year = $request->financial_year;
        $from_date = $request->from_date;
        $pay_for_month_year = $request->pay_for_month_year;
        $empAnnualPayReport =[];
        $employee_data ="";
        if($financial_year)
        {
            $financialYears = explode("-",$financial_year);
            $months =[
                ["month"=>["key"=>"4","lable"=>"April"],"year"=>$financialYears[0],'pay_for_month_year'=>$financialYears[0].'-04'],
                ["month"=>["key"=>"5","lable"=>"May"],"year"=>$financialYears[0],'pay_for_month_year'=>$financialYears[0].'-05'],
                ["month"=>["key"=>"6","lable"=>"June"],"year"=>$financialYears[0],'pay_for_month_year'=>$financialYears[0].'-06'],
                ["month"=>["key"=>"7","lable"=>"July"],"year"=>$financialYears[0],'pay_for_month_year'=>$financialYears[0].'-07'],
                ["month"=>["key"=>"8","lable"=>"August"],"year"=>$financialYears[0],'pay_for_month_year'=>$financialYears[0].'-08'],
                ["month"=>["key"=>"9","lable"=>"September"],"year"=>$financialYears[0],'pay_for_month_year'=>$financialYears[0].'-09'],
                ["month"=>["key"=>"10","lable"=>"October"],"year"=>$financialYears[0],'pay_for_month_year'=>$financialYears[0].'-10'],
                ["month"=>["key"=>"11","lable"=>"November"],"year"=>$financialYears[0],'pay_for_month_year'=>$financialYears[0].'-11'],
                ["month"=>["key"=>"12","lable"=>"December"],"year"=>$financialYears[0],'pay_for_month_year'=>$financialYears[0].'-12'],
                ["month"=>["key"=>"01","lable"=>"January"],"year"=>$financialYears[1],'pay_for_month_year'=>$financialYears[1].'-01'],
                ["month"=>["key"=>"02","lable"=>"February"],"year"=>$financialYears[1],'pay_for_month_year'=>$financialYears[1].'-02'],
                ["month"=>["key"=>"03","lable"=>"March"],"year"=>$financialYears[1],'pay_for_month_year'=>$financialYears[1].'-03'],
            ];
            
            foreach($months as $key => $month)
            {
                $empAnnualPayReport[$key]['data'] = PayrollSalary::with('payrollSalaryHead','payrollSalaryHead.payroll_head')->where('employee_id',$employee_id)->where('pay_for_month_year',$month['pay_for_month_year'])->first();
                $empAnnualPayReport[$key]['month_lable'] = $month['month']['lable'];
            }
        }
        $deductionHead = "";
        $earningHead = "";
        if($employee_id)
        {
            $employee_data = Employee::find($employee_id);
            $deductionHead= PayrollHead::whereIn('employment_type',[$employee_data->employment_type,'both'])->where('head_type','deduction')->get();
            $earningHead = PayrollHead::whereIn('employment_type',[$employee_data->employment_type,'both'])->where('head_type','income')->get();
        }
        // return $empAnnualPayReport;
        $to_date = $request->to_date;
        $employees = Employee::getList()->getActiveEmp()->get();
        // $empSalary = PayrollSalary::where('employee_id',$employee_id)->
        return view('admin.reports.annual-pay-report',[
            'employees' => $employees,
            'employee_data' => $employee_data,
            'employee_id' => $employee_id,
            'deductionHead' => $deductionHead,
            'earningHead' => $earningHead,
            'search_type' => $search_type,
            'pay_for_month_year' => $pay_for_month_year,
            'to_date' => $to_date,
            'emp_annual_pay_report' => $empAnnualPayReport,
            'from_date' => $from_date,
            'financial_year' => $financial_year,
            'search_text' => $search_text
        ]);
    }
    public function annulaTaxDeduction(Request $request)
    {
        $search_text = $request->search_text;
        $employee_id = $request->employee_id;
        $search_type = $request->search_type;
        $from_date = $request->from_date;
        $financial_year = $request->financial_year;
        $pay_for_month_year = $request->pay_for_month_year;
        $to_date = $request->to_date;
        $employees = Employee::getActiveEmp()->getList()->get();
        $empAnnualTaxReport =[];
        if($financial_year)
        {
            $financialYears = explode("-",$financial_year);
            $fromDate = date("Y-m-d",strtotime($financialYears[0]."-07-01"));
            $toDate = date("Y-m-d",strtotime($financialYears[1]."-06-30"));
            foreach($employees as $key => $value)
            {
                $empAnnualTaxReport[$key]['emp_name']=$value->user->name;
                $empAnnualTaxReport[$key]['ec_number']=$value->ec_number;
                $empAnnualTaxReport[$key]['name_of_branch']=$value?->branch?->name;
                $totalGrossEarning =  PayrollSalary::where('employee_id',$value->id)->whereBetween('salary_date_pay_for',[$fromDate,$toDate])->sum('gross_earning');
                $empAnnualTaxReport[$key]['gross_earning'] = $totalGrossEarning;
                $empAnnualTaxReport[$key]['gross_earning_in_pula'] =$totalGrossEarning;

                if($value->employment_type=="expatriate")
                {
                    $usdToPulaAmount = getCurrencyValue("usd", "pula");
                    $empAnnualTaxReport[$key]['gross_earning_in_pula'] = $totalGrossEarning * $usdToPulaAmount ;
                }
                // Employee Id
                $emplooyeId = $value->id;
                $taxAmount=0;
                if($value->employment_type=="expatriate")
                {
                    $taxAmount =$this->calulateIBOTax(['user_id'=>$value->user_id,'financial_year'=>$financial_year,'from_date'=>$fromDate,'to_date'=>$toDate]);
                }else
                {
                   $taxAmount= PayrollSalaryHead::whereHas('payroll_head',function($q){ $q->where('slug','tax');
                    })->whereHas('payrollSalary',function($q)use($emplooyeId,$fromDate,$toDate){
                        $q->where('employee_id',$emplooyeId)->whereBetween('salary_date_pay_for',[$fromDate,$toDate]);
                    })->sum('value');
                }

                $empAnnualTaxReport[$key]['tax_deduction'] =PayrollSalary::where('employee_id',$value->id)->whereBetween('salary_date_pay_for',[$fromDate,$toDate])->sum('tax_amount_in_pula');
                $empAnnualTaxReport[$key]['net_earning'] = PayrollSalary::where('employee_id',$value->id)->whereBetween('salary_date_pay_for',[$fromDate,$toDate])->sum('net_take_home');;
                $empAnnualTaxReport[$key]['net_earning_in_pula'] = PayrollSalary::where('employee_id',$value->id)->whereBetween('salary_date_pay_for',[$fromDate,$toDate])->sum('net_take_home_in_pula');;
            }   
        }
        // return $empAnnualTaxReport;
        return view('admin.reports.annula-tax-deduction',[
            'employees' => $employees,
            'employee_id' => $employee_id,
            'search_type' => $search_type,
            'pay_for_month_year' => $pay_for_month_year,
            'to_date' => $to_date,
            'from_date' => $from_date,
            'financial_year' => $financial_year,
            'emp_annual_tax_report' => $empAnnualTaxReport,
            'search_text' => $search_text
        ]);
    }
    public function calulateIBOTax($data)
    {
        $user_id = $data['user_id'];
        $financialYear = $data['financial_year'];
        $fromDate = $data['from_date'];
        $toDate = $data['to_date'];
        $salary = PayrollSalary::where('user_id', $user_id)->whereBetween('salary_date_pay_for',[$fromDate,$toDate])->get();
        $usdToPulaAmount = 1;
        $usdToPulaAmount = 1;
        $reimbursements = Reimbursement::where('user_id', $user_id)->where('financial_year',$financialYear)->where('status','approved')->get();
        $currencySeeting = CurrencySetting::where('currency_name_from','usd')->where('currency_name_to','pula')->first();
        if(!empty($currencySeeting))
        {
            $usdToPulaAmount = $currencySeeting->currency_amount_to;
        }
        $currencySeetingPulaToUsd = CurrencySetting::where('currency_name_from','pula')->where('currency_name_to','usd')->first();
        if(!empty($currencySeetingPulaToUsd))
        {
            $usdToPulaAmount = $currencySeetingPulaToUsd->currency_amount_to;
        }
        $totalPaidSalary = $salary->sum('gross_earning');
        $reimbursementAmount = 0;
        foreach($reimbursements as $reimbursement)
        {
            if($reimbursement->reimbursement_currency=="usd")
            {
                $reimbursementAmount = ($reimbursementAmount + $reimbursement->reimbursement_amount)*$usdToPulaAmount;
            }else
            {
                $reimbursementAmount = $reimbursementAmount + $reimbursement->reimbursement_amount;
            }
        }
        $totalPaidSalary = $salary->sum('gross_earning') * $usdToPulaAmount;
        $taxableAmount = $reimbursementAmount + $totalPaidSalary;
        $taxableAmountParam = $taxableAmount;
        $taxData = $this->getTaxAmount(['taxable_amount'=>$taxableAmountParam,'employment_type'=>'expatriate']);
        $tax_amount = $taxData['tax_amount'];
        return $tax_amount;
    }
    public function thirteenChequeReport(Request $request)
    {
        $search_text = $request->search_text;
        $employee_id = $request->employee_id;
        $search_type = $request->search_type;
        $from_date = $request->from_date;
        $financial_year = $request->financial_year;

        $to_date = $request->to_date;
        $employees = Employee::getList()->getActiveEmp()->get();
        $emp13ChequeReport =[];
        $financial_year_text ="";
        $months =[];
        $employee_data ="";
        if($financial_year)
        {
            $financialYears = explode("-",$financial_year);
            $financial_year_text = "Dec- ".$financialYears[0]." to Nov- ".$financialYears[1];
            $months =[
                ["month"=>["key"=>"12","lable"=>"December"],"year"=>$financialYears[0],'pay_for_month_year'=>$financialYears[0].'-12'],
                ["month"=>["key"=>"01","lable"=>"January"],"year"=>$financialYears[1],'pay_for_month_year'=>$financialYears[1].'-01'],
                ["month"=>["key"=>"02","lable"=>"February"],"year"=>$financialYears[1],'pay_for_month_year'=>$financialYears[1].'-02'],
                ["month"=>["key"=>"03","lable"=>"March"],"year"=>$financialYears[1],'pay_for_month_year'=>$financialYears[1].'-03'],
                ["month"=>["key"=>"04","lable"=>"April"],"year"=>$financialYears[1],'pay_for_month_year'=>$financialYears[1].'-04'],
                ["month"=>["key"=>"05","lable"=>"May"],"year"=>$financialYears[1],'pay_for_month_year'=>$financialYears[1].'-05'],
                ["month"=>["key"=>"06","lable"=>"June"],"year"=>$financialYears[1],'pay_for_month_year'=>$financialYears[1].'-06'],
                ["month"=>["key"=>"07","lable"=>"July"],"year"=>$financialYears[1],'pay_for_month_year'=>$financialYears[1].'-07'],
                ["month"=>["key"=>"08","lable"=>"August"],"year"=>$financialYears[1],'pay_for_month_year'=>$financialYears[1].'-08'],
                ["month"=>["key"=>"09","lable"=>"September"],"year"=>$financialYears[1],'pay_for_month_year'=>$financialYears[1].'-09'],
                ["month"=>["key"=>"10","lable"=>"October"],"year"=>$financialYears[1],'pay_for_month_year'=>$financialYears[1].'-10'],
                ["month"=>["key"=>"11","lable"=>"November"],"year"=>$financialYears[1],'pay_for_month_year'=>$financialYears[1].'-11'],
            ];
            
            foreach($employees as $ekey => $employe){
                $emp13ChequeReport[$ekey]['name_of_employee'] = $employe->user?->name;
                $emp13ChequeReport[$ekey]['ec_number'] = $employe->ec_number;
                $emp13ChequeReport[$ekey]['branch_name'] = $employe->branch?->name;
                $emp13ChequeReport[$ekey]['bank_account_number'] = $employe->bank_account_number;
                $totalBasicAmount = 0;
                $totalITaxAmount = 0;
                foreach($months as $key => $month)
                {   $basicAmount =0;
                    $basicAmount = PayrollSalary::where('pay_for_month_year',$month['year']."-".$month['month']['key'])->where('employee_id',$employe->id)->value('basic') ?? 0;
                    $taxAmount = PayrollSalary::where('pay_for_month_year',$month['year']."-".$month['month']['key'])->where('employee_id',$employe->id)->value('tax_amount_in_pula') ?? 0;
                    $totalBasicAmount +=$basicAmount;
                    $totalITaxAmount +=$taxAmount;
                    // $year = $month['year']; 
                    // $month = $month['month']['key']; 
                    // $emplooyeId = $employe->id; 
                    // $taxAmount= PayrollSalaryHead::whereHas('payroll_head',function($q){ $q->where('slug','tax');
                    // })->whereHas('payrollSalary',function($q)use($emplooyeId,$year,$month){
                    //     $q->where('employee_id',$emplooyeId)->where('pay_for_month_year',$year."-".$month);
                    // })->value('value');
                    // $totalITaxAmount +=$taxAmount;

                    $emp13ChequeReport[$ekey]['months'][$key]['basic'] = $basicAmount;
                }
                $emp13ChequeReport[$ekey]['total_amount'] = $totalBasicAmount;
                $emp13ChequeReport[$ekey]['average_amount'] = number_format($totalBasicAmount/12,2);
                // $totalITaxAmount = $this->getTaxAmount(['taxable_amount'=>$totalBasicAmount,'employment_type'=>$employe->employment_type])['tax_amount'];
                $emp13ChequeReport[$ekey]['total_i_tax_amount'] = $totalITaxAmount;
                $emp13ChequeReport[$ekey]['net_payable_amount'] = number_format($totalBasicAmount/12-$totalITaxAmount);
            }
        }
        return view('admin.reports.thirteen-cheque-report',[
            'employees' => $employees,
            'employee_id' => $employee_id,
            'search_type' => $search_type,
            'to_date' => $to_date,
            'months' => $months,
            'emp13ChequeReport' => $emp13ChequeReport,
            'financial_year' => $financial_year,
            'financial_year_text' =>$financial_year_text ,
            'from_date' => $from_date,
            'search_text' => $search_text
        ]);
    }
    public function branchWiseEmployeeReport(Request $request)
    {
        $search_text = $request->search_text;
        $employee_id = $request->employee_id;
        $branch_id = $request->branch_id;
        $from_date = $request->from_date;
        $branches = Branch::getBranch()->get();
        $pay_for_month_year = $request->pay_for_month_year;
        $to_date = $request->to_date;
        $employees = "";
        if(!empty($branch_id)){
            $employees = Employee::getList()->whereHas('branch',function($q) use($branch_id){
                $q->where('id',$branch_id);
            })->get();
        }
        // return $employees;
        return view('admin.reports.branch-wise-employee-report',[
            'employees' => $employees,
            'employee_id' => $employee_id,
            'branches' => $branches,
            'branch_id' => $branch_id,
            'pay_for_month_year' => $pay_for_month_year,
            'to_date' => $to_date,
            'from_date' => $from_date,
            'search_text' => $search_text
        ]);
    }
}
