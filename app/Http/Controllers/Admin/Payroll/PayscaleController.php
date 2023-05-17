<?php

namespace App\Http\Controllers\Admin\Payroll;

use App\Http\Controllers\Controller;
use App\Models\EmpPayscale;
use App\Models\EmpSalary;
use App\Models\Membership;
use App\Models\User;
use Exception;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class PayscaleController extends Controller
{
    //
    public function listPayscale(Request $request)
    {
        $pageName = "Payscale";
        if ($request->ajax()) {
            $data = EmpPayscale::with('user')->select('*');
            return Datatables::of($data)
                ->addIndexColumn()
                ->make(true);
        }
        return view('admin.payroll.pay-scale',['page' => $pageName]);
    }
    public function addPayscalePage()
    {
        $pageName = "Add Pay Scale";
        $membership = Membership::all();
        $users = User::all();
        return view('admin.payroll.add-pay-scale',['page' => $pageName, 'users' => $users, 'membership' => $membership]);
    }

    public function storePayscale(Request $request)
    {
        // return $request;

        $validator = Validator::make($request->all(), [
        //     `user_id` => ['required', 'numeric'],
        //     `basic` => ['required', 'numeric'],
        //     `hra` => ['required', 'numeric'],
        //     `overtime` => ['required', 'numeric'],
        //     `arrear` => ['required', 'numeric'],
        //     `union_membership` => ['required', 'numeric'],
        //     `pf_per` => ['required', 'numeric'],
        //     `pf_amount` => ['required', 'numeric'],
        //     `pension_per` => ['required', 'numeric'],
        //     `pension_amount` => ['required', 'numeric'],
        //     `loans_deduction` => ['required', 'numeric'],
        //     `no_of_working_days` => ['required', 'numeric'],
        //     `no_of_paid_leaves` => ['required', 'numeric'],
        //     `shift` => ['required', 'string'],
        //     `working_hours_start` => ['required', 'string'],
        //     `working_hours_end` => ['required', 'string'],
        //     `no_of_payable_days` => ['required', 'numeric'],
        //     `conveyance` => ['required', 'numeric'],
        //     `special` => ['required', 'numeric'],
        //     `mobile` => ['required', 'numeric'],
        //     `bonus` => ['required', 'numeric'],
        //     `bonus` => ['required', 'numeric'],
        //     `transportation` => ['required', 'numeric'],
        //     `food` => ['required', 'numeric'],
        //     `medical` => ['required', 'numeric'],
        //     `gross_earning` => ['required', 'numeric'],
        //     `esi_per` => ['required', 'numeric'],
        //     `esi_amount` => ['required', 'numeric'],
        //     `income_tax_deductions` => ['required', 'numeric'],
        //     `penalty_deductions` => ['required', 'numeric'],
        //     `fixed_deductions` => ['required', 'numeric'],
        //     `other_deductions` => ['required', 'numeric'],
        //     `net_take_home` => ['required', 'numeric'],
        //     `ctc` => ['required', 'numeric'],
        //     `total_employer_contribution` => ['required', 'numeric'],
        //     `total_deduction` => ['required', 'numeric']

        ]);

        if ($validator->fails()) {
            return $validator->errors();
        } else {
            try {
                EmpPayscale::insertGetId($request->except(['_token']));
                $successMessage = 'Payscale Added Successfully!';
                Session::put('success', $successMessage);
                return redirect()->route('admin.payroll.pay-scale.list');
            } catch (Exception $e) {
                return response()->json(['success' => $e->getMessage()]);
            }
        }
    }

    public function getPayscale($id){
        $pay=EmpPayscale::where('user_id', $id)->latest()->first();
        return response()->json(["status" => true, "data" => $pay]);
    }
}
