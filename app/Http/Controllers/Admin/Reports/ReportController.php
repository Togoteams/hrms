<?php

namespace App\Http\Controllers\Admin\Reports;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;
use App\Models\PayrollSalary;
use App\Models\LeaveApply;
use App\Models\LeaveType;
use Exception;
use Yajra\DataTables\DataTables;
class ReportController extends Controller
{
    //
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
            return Datatables::of($data)
                ->addIndexColumn()
                ->make(true);
        }
        return view('admin.reports.salary-report',compact('employees','employee_id','search_type','pay_for_month_year','to_date','search_text'));  
    }
    public function leaveReport(Request $request)
    {
        $employees = Employee::getList()->get();
        return view('admin.reports.leave-report',compact('employees'));
    }
}
