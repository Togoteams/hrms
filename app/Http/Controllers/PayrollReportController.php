<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Models\PayrollTtumSalaryReport;
use Carbon\Carbon;
use Excel;
use App\Exports\PayrollTtumSalaryReportExport;
use App\Models\Branch;
use Illuminate\Support\Facades\Validator;

class PayrollReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public $page_name = "Salary TTUM Report";
    //
    private $salaryMonth;

    public function ttumReport(Request $request)
    {
        if ($request->ajax()) {

            $data = PayrollTtumSalaryReport::with('account')->orderBy('id', 'ASC');

            return DataTables::of($data)
                ->addIndexColumn()
                ->make(true);
        }
        $branches= Branch::get();
        return view('admin.payroll.report.ttum',['page' => $this->page_name,'branches'=>$branches]);
    }
    
    public function ttumReportExport(Request $request)
    {
        $ttumMonth = $request->transaction_at;
        $branchId = $request->branch_id;
       
        $request->validate([
            'transaction_at' => 'required|date_format:Y-m',
        ]);
        return Excel::download(new PayrollTtumSalaryReportExport($ttumMonth,$branchId), 'ttumReport'.$ttumMonth.'.xlsx');
    }
}
