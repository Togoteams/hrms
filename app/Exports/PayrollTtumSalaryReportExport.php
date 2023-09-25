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
    public function view():view
    {
        // return view('exports.invoices', [
        //     'invoices' => Invoice::all()
        // ]);
        return view('admin.payroll.report.export.ttum-export',['reports'=>PayrollTtumSalaryReport::all()]);
    }

    // public function collection()
    // {
    //     return PayrollTtumSalaryReport::all();
    // }
}
