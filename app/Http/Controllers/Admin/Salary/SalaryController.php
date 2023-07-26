<?php

namespace App\Http\Controllers\Admin\Salary;

use App\Http\Controllers\Controller;
use App\Models\EmpSalary;
use App\Models\Membership;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class SalaryController extends Controller
{
    //
    public function listSalary(Request $request)
    {
        $pageName = "Salary";
        if ($request->ajax()) {
            $data = EmpSalary::with('user')->select('*');
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn = '<i class="bi bi-printer-fill pointer" onclick="printSalary(' . $row->id . ')" target="_blank"></i>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.salary.salary-view', ['page' => $pageName]);
    }
    public function addSalaryPage()
    {
        $pageName = "Add Salary";
        $membership = Membership::all();
        $users = User::all();
        return view('admin.salary.add-salary', ['page' => $pageName, 'users' => $users, 'membership' => $membership]);
    }
    public function storeSalary(Request $request)
    {
        // return $request;

        $validator = Validator::make($request->all(), [
            // `user_id` => ['required', 'numeric'],
            // `basic` => ['required', 'numeric'],
            // `hra` => ['required', 'numeric'],
            // `overtime` => ['required', 'numeric'],
            // `arrear` => ['required', 'numeric'],
            // `union_membership` => ['required', 'numeric'],
            // `pf_per` => ['required', 'numeric'],
            // `pf_amount` => ['required', 'numeric'],
            // `pension_per` => ['required', 'numeric'],
            // `pension_amount` => ['required', 'numeric'],
            // `loans_deduction` => ['required', 'numeric'],
            // `no_of_working_days` => ['required', 'numeric'],
            // `no_of_paid_leaves` => ['required', 'numeric'],
            // `shift` => ['required', 'string'],
            // `working_hours_start` => ['required', 'string'],
            // `working_hours_end` => ['required', 'string'],
            // `no_of_payable_days` => ['required', 'numeric'],
            // `conveyance` => ['required', 'numeric'],
            // `special` => ['required', 'numeric'],
            // `mobile` => ['required', 'numeric'],
            // `bonus` => ['required', 'numeric'],
            // `transportation` => ['required', 'numeric'],
            // `food` => ['required', 'numeric'],
            // `medical` => ['required', 'numeric'],
            // `gross_earning` => ['required', 'numeric'],
            // `esi_per` => ['required', 'numeric'],
            // `esi_amount` => ['required', 'numeric'],
            // `income_tax_deductions` => ['required', 'numeric'],
            // `penalty_deductions` => ['required', 'numeric'],
            // `fixed_deductions` => ['required', 'numeric'],
            // `other_deductions` => ['required', 'numeric'],
            // `net_take_home` => ['required', 'numeric'],
            // `ctc` => ['required', 'numeric'],
            // `total_employer_contribution` => ['required', 'numeric'],
            // `total_deduction` => ['required', 'numeric']

        ]);

        if ($validator->fails()) {
            return $validator->errors();
        } else {
            try {
                EmpSalary::insertGetId($request->except(['_token']));
                $successMessage = 'Salary Added Successfully!';
                Session::put('success', $successMessage);
                return redirect()->route('admin.salary.list');
            } catch (Exception $e) {
                return response()->json(['success' => $e->getMessage()]);
            }
        }
    }

    public function printSalary($id)
    {
        $toArray = [];
        $empSal = EmpSalary::findOrFail($id);
        $toArray = [
            'basic' => $empSal->basic,
            'hra' => $empSal->hra,
            'overtime' => $empSal->overtime,
            'arrear' => $empSal->arrear,
            'conveyance' => $empSal->conveyance,
            'special' => $empSal->special,
            'mobile' => $empSal->mobile,
            'bonus' => $empSal->bonus,
            'transportation' => $empSal->transportation,
            'food' => $empSal->food,
            'medical' => $empSal->medical,
            'pf_amount' => $empSal->pf_amount,
            'esi_amount' => $empSal->esi_amount,
            'pension_amount' => $empSal->pension_amount,
            'union_membership' => $empSal->membership->amount,
            'loans_deduction' => $empSal->loans_deduction,
            'income_tax_deductions' => $empSal->income_tax_deductions,
            'penalty_deductions' => $empSal->penalty_deductions,
            'fixed_deductions' => $empSal->fixed_deductions,
            'other_deductions' => $empSal->other_deductions,


        ];

        $total_earning = $empSal->basic + $empSal->hra +
            $empSal->overtime + $empSal->arrear +
            $empSal->conveyance + $empSal->special +
            $empSal->mobile + $empSal->bonus +
            $empSal->transportation + $empSal->food +
            $empSal->medical;
        $total_deductions = $empSal->pf_amount + $empSal->esi_amount +
            $empSal->pension_amount + $empSal->union_membership +
            $empSal->loans_deduction + $empSal->income_tax_deductions +
            $empSal->penalty_deductions + $empSal->fixed_deductions +
            $empSal->other_deductions;

        $net_pay = $total_earning - $total_deductions;

        $dataSet = [
            'total_earning' => number_format($total_earning, 2, '.', ''),
            'total_deductions' => number_format($total_deductions, 2, '.', ''),
            'net_pay' => number_format($net_pay, 2, '.', ''),
            'emp_name' => $empSal->user->name,
            'emp_code' => $empSal->employee->emp_id,
        ];

        return view('admin.salary.salary-slip', ['data' => $toArray, 'dataSet' => $dataSet]);
    }
}
