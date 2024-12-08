<?php

namespace App\Exports;

use App\Models\PayrollTtumSalaryReport;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

class PayrollTtumSalaryReportExport implements FromView
{
    // /**
    // * @return \Illuminate\Support\Collection
    // */
    // public function headings():array{
    //     return[
    //         'TRAN_PARTICULAR',
    //         'FORACID',
    //         'VALUE DATE',
    //         'CCY',
    //         'PTT',
    //         'TRAN_AMT' 
    //     ];
    // } 
    public $ttumMonth;
    public $branchId;

    public function __construct($ttumMonth,$branchId)
    {
        $this->ttumMonth = $ttumMonth;
        $this->branchId = $branchId;
    }
    public function view():view
    {
        $reports = PayrollTtumSalaryReport::where('ttum_month', $this->ttumMonth)->where('branch_id',$this->branchId)->get();
        return view('admin.payroll.report.export.ttum-export',['reports'=>$reports]);
    }

    // public function collection()
    // {
    //     return PayrollTtumSalaryReport::all();
    // }
}
