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
            $data = Emp13thCheque::all();
            return DataTables::of($data)
                ->addIndexColumn()
                ->make(true);
            }
        return view('admin.payroll.emp13th-cheque.index', ['page' => $this->page_name]);
    }
}
