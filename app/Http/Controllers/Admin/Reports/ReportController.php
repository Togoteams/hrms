<?php

namespace App\Http\Controllers\Admin\Reports;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\EmpCurrentLeave;
use App\Models\Employee;
use Illuminate\Http\Request;
use App\Models\PayrollSalary;
use App\Models\LeaveApply;
use App\Models\LeaveDate;
use App\Models\LeaveSetting;
use App\Models\LeaveType;
use App\Models\PayrollHead;
use Exception;
use Yajra\DataTables\DataTables;
class ReportController extends Controller
{
    //
    public $search_text,$employee_id,$search_type,$from_date,$pay_for_month_year,$to_date;
    public function reportsType()
    {
        return view('admin.reports.report-type');
    }
    public function salaryReport(Request $request)
    {
        $employees = Employee::getList()->get();
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
    public function leaveReport(Request $request)
    {
        $search_text = $request->search_text;
        $employee_id = $request->employee_id;
        $search_type = $request->search_type;
        $from_date = $request->from_date;
        $pay_for_month_year = $request->pay_for_month_year;
        $to_date = $request->to_date;
        $employee_data="";
        $leaveReportArr = [];
        $employees = Employee::getList()->get();
        if($employee_id && $from_date && $to_date)
        {
            $employee_data = Employee::find($employee_id);
            $excludeArray = [];
            if($employee_data->gender=="male")
            {
                $excludeArray = ['maternity-leave'];
            }
            $user_id = $employee_data->user_id;
            $leave_data = LeaveSetting::where('emp_type',getEmpType($employee_data->employment_type))->whereNotIn('slug',$excludeArray)->get();
            foreach($leave_data as $key => $leave)
            {
                $leave_type_id = $leave->id;
                $leaveReportArr[$key]['leave_type_name'] = $leave->name;
                $leaveReportArr[$key]['opening_balance'] = 0;
                $leaveReportArr[$key]['accural'] = 0;
                $leaveReportArr[$key]['adjustment'] = 0;
                $leaveReportArr[$key]['leave_availed'] = LeaveDate::where('leave_date',"<=",$from_date)->where('leave_date',">=",$to_date)->whereHas('leaveApply',function($q) use ($user_id,$leave_type_id){
                    $q->where('user_id',$user_id)->where('leave_type_id',$leave_type_id);
                })->count();
                $leaveReportArr[$key]['leave_balance'] = EmpCurrentLeave::where('leave_type_id',$leave_type_id)->where('employee_id',$employee_data->id)->value('leave_count') ?? 0;
                $leaveReportArr[$key]['expiry_date_message'] = $leave?->expiry_date_message;
            }
        }
       
        return view('admin.reports.leave-report',[
            'employees' => $employees,
            'employee_id' => $employee_id,
            'search_type' => $search_type,
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
            
            // return $months;
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
        // return $empAnnualPayReport[];
        $to_date = $request->to_date;
        $employees = Employee::getList()->get();
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
        $employees = Employee::getActiveEmp()->get();
        $empAnnualTaxReport =[];
        if($financial_year)
        {
            $financialYears = explode("-",$financial_year);
            foreach($employees as $key => $value)
            {
                $empAnnualTaxReport[$key]['emp_name']=$value->user->name;
                $empAnnualTaxReport[$key]['ec_number']=$value->ec_number;
                $empAnnualTaxReport[$key]['name_of_branch']=$value?->branch?->name;
                $empAnnualTaxReport[$key]['gross_earning']=PayrollSalary::where('employee_id',$value->id)->sum('gross_earning');
                $empAnnualTaxReport[$key]['tax_deduction']=0;
                $empAnnualTaxReport[$key]['net_earning']=PayrollSalary::where('employee_id',$value->id)->sum('net_take_home');;
            }   
        }
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
    public function thirteenChequeReport(Request $request)
    {
        $search_text = $request->search_text;
        $employee_id = $request->employee_id;
        $search_type = $request->search_type;
        $from_date = $request->from_date;
        $financial_year = $request->financial_year;

        $to_date = $request->to_date;
        $employees = Employee::getList()->get();
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
                ["month"=>["key"=>"4","lable"=>"April"],"year"=>$financialYears[1],'pay_for_month_year'=>$financialYears[1].'-04'],
                ["month"=>["key"=>"5","lable"=>"May"],"year"=>$financialYears[1],'pay_for_month_year'=>$financialYears[1].'-05'],
                ["month"=>["key"=>"6","lable"=>"June"],"year"=>$financialYears[1],'pay_for_month_year'=>$financialYears[1].'-06'],
                ["month"=>["key"=>"7","lable"=>"July"],"year"=>$financialYears[1],'pay_for_month_year'=>$financialYears[1].'-07'],
                ["month"=>["key"=>"8","lable"=>"August"],"year"=>$financialYears[1],'pay_for_month_year'=>$financialYears[1].'-08'],
                ["month"=>["key"=>"9","lable"=>"September"],"year"=>$financialYears[1],'pay_for_month_year'=>$financialYears[1].'-09'],
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
                {
                    $basicAmount = PayrollSalary::with('payrollSalaryHead','payrollSalaryHead.payroll_head')->where('pay_for_month_year',$month['year']."-".$month['month']['key'])->where('employee_id',$employe->id)->value('basic') ?? 0;
                    $totalBasicAmount +=$basicAmount; 
                    $emp13ChequeReport[$ekey]['months'][$key]['basic'] = $basicAmount;
                }
                $emp13ChequeReport[$ekey]['total_amount'] = $totalBasicAmount;
                $emp13ChequeReport[$ekey]['average_amount'] = number_format($totalBasicAmount/12,2);
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
