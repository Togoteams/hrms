<?php

namespace App\Http\Controllers\Admin\Payroll;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Emp13thCheque;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
class Emp13thChequeController extends Controller
{
    //
     /**
     * Display a listing of the resource.
     */
    public $page_name = "Employee 13th Cheque";
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Emp13thCheque::with('user','user.employee');
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('cheques_month_year', function ($data) {
                    return \Carbon\Carbon::parse($data->cheques_month_year)->isoFormat('MM-YYYY');
                })
                ->make(true);
            }
        return view('admin.payroll.emp13th-cheque.index', ['page' => $this->page_name]);
    }
}
