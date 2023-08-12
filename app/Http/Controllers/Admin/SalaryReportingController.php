<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PayrollSalary;
use App\Models\PayrollSalaryIncrement;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use URL;

class SalaryReportingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public $page_name = "Salary Increment Reporting";

    public function index(Request $request)
    {
        $increment_percentage = @$request['increment_percentage'];
        $employment_type = @$request['employment_type'];
        $financial_year = @$request['financial_year'];
       if ($request->ajax()) {

        // $url = URL::previous();
        // dd($url);
           
        //die();
            $data = PayrollSalaryIncrement::orderBy('id','ASC');

            if ($increment_percentage) {
               $data = $data->where('increment_percentage', $increment_percentage);
            }
            if ($employment_type) {
                $data = $data->where('employment_type', $employment_type);
            }
            if ($financial_year) {
                $data = $data->where('financial_year', $financial_year);
            }
            $data = $data->get();
            echo ($increment_percentage);

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn = view('admin.payroll.salary_increment_reporting.buttons', ['item' => $row, "route" => 'payroll.salary_increment_reporting']);
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
            }
        return view('admin.payroll.salary_increment_reporting.index', ['page' => $this->page_name]);
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
