<?php

namespace App\Http\Controllers\Admin\Payroll;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PayscaleController extends Controller
{
    //
    public function listPayscale(Request $request)
    {
        $pageName = "Payscale";
        return view('admin.payroll.pay-scale',['page' => $pageName]);
    }
    public function addPayscale(Request $request)
    {
        return view('admin.payroll.add-pay-scale');
    }
}
