<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Models\PayrollTtumSalaryReport;
use Carbon\Carbon;
use Excel;
use App\Exports\PayrollTtumSalaryReportExport;
use App\Models\Branch;
use App\Models\PayrollSalary;
use App\Models\PayrollTtumReport;
use App\Traits\PayrollTraits;
use Illuminate\Support\Facades\Validator;

class PayrollReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public $page_name = "Salary TTUM Report";
    //
    private $salaryMonth;
    use PayrollTraits;

    public function ttumReport(Request $request)
    {
        if ($request->ajax()) {

            $data = PayrollTtumReport::orderBy('id', 'ASC');

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn = view('admin.payroll.report.buttons', ['item' => $row, "route" => 'payroll.salary']);
                    return $actionBtn;
                })
                ->make(true);
        }
        $branches= Branch::get();
        return view('admin.payroll.report.ttum',['page' => $this->page_name,'branches'=>$branches]);
    }
    
    public function ttumReportExport(Request $request)
    {
        ini_set('max_execution_time', 300); // Increase to 5 minutes
        $ttumMonth = $request->transaction_at;
        $branchId = $request->branch_id;

        $request->validate([
            'transaction_at' => 'required|date_format:Y-m',
        ]);
        $salaries = PayrollSalary::where('branch_id',$branchId)->where('pay_for_month_year',$ttumMonth)->get();
        $data = [
            'branch_id' => $branchId,
            'ttum_month' => $ttumMonth,
        ];
        $ttumExist = PayrollTtumReport::where([
            'branch_id' => $branchId,
            'ttum_month' => $ttumMonth,
        ])->first();
        if(empty($ttumExist))
        {
            foreach($salaries as $key => $salary){
               $ttum = $this->createTTum($salary->id);
            }
        }
        return Excel::download(new PayrollTtumSalaryReportExport($ttumMonth,$branchId), 'ttumReport'.$ttumMonth.'.xlsx');
    }
    public function reportExport(Request $request)
    {
        ini_set('max_execution_time', 300); // Increase to 5 minutes
        $ttumId = $request->ttum_id;
        $ttumReport = PayrollTtumReport::find($ttumId);
        $ttumMonth = $ttumReport->ttum_month;
        $branchId = $ttumReport->branch_id;

        return Excel::download(new PayrollTtumSalaryReportExport($ttumMonth,$branchId), 'ttumReport'.$ttumMonth.'.xlsx');
    }
    public function deleteReport(Request $request)
    {
        ini_set('max_execution_time', 300); // Increase to 5 minutes
        $ttumId = $request->ttum_id;
        $ttumReport = PayrollTtumReport::find($ttumId);
        $ttumReport->payrollTtumSalaryReport()->delete();
        $ttumReport->delete();
        return back();
    }
}
