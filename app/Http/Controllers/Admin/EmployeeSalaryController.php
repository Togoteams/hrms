<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EmployeeSalary;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Validator;
use Exception;
use Yajra\DataTables\DataTables;
use App\Models\Membership;
use App\Models\Branch;
use App\Models\User;
use App\Models\Designation;
use App\Models\Employee;
use App\Models\EmployeePayScale;

class EmployeeSalaryController extends Controller
{
    public $page_name = "Employees Salary";
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = EmployeeSalary::with('user')->select('*');
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn = view('admin.employees_salary.buttons', ['item' => $row, "route" => 'employees']);
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        $designation = Designation::getDesignation()->get();
        $membership = Membership::all();
        $users = User::where('status', 'active')->get();
        $branch = Branch::getBranch()->get();
        return view('admin.employees_salary.index', ['page' => $this->page_name, 'designation' => $designation, 'membership' => $membership, 'branch' => $branch, 'users' => $users]);
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

        $validator = Validator::make($request->all(), [
            'user_id' => ['required', 'numeric'],
            'basic' => ['required', 'numeric'],
            'hra' => ['required', 'numeric'],
            'overtime' => ['required', 'numeric'],
            'arrear' => ['required', 'numeric'],
            'union_membership' => ['required', 'numeric'],
            'pf_per' => ['required', 'numeric'],
            'pf_amount' => ['required', 'numeric'],
            'pension_per' => ['required', 'numeric'],
            'pension_amount' => ['required', 'numeric'],
            'loans_deduction' => ['required', 'numeric'],
            'no_of_working_days' => ['required', 'numeric'],
            'no_of_paid_leaves' => ['required', 'numeric'],
            'shift' => ['required', 'string'],
            'no_of_payable_days' => ['required', 'numeric'],
            'conveyance' => ['required', 'numeric'],
            'special' => ['required', 'numeric'],
            'mobile' => ['required', 'numeric'],
            'bonus' => ['required', 'numeric'],
            'transportation' => ['required', 'numeric'],
            'food' => ['required', 'numeric'],
            'medical' => ['required', 'numeric'],
            'gross_earning' => ['required', 'numeric'],
            'esi_per' => ['required', 'numeric'],
            'esi_amount' => ['required', 'numeric'],
            'income_tax_deductions' => ['required', 'numeric'],
            'penalty_deductions' => ['required', 'numeric'],
            'fixed_deductions' => ['required', 'numeric'],
            'other_deductions' => ['required', 'numeric'],
            'net_take_home' => ['required', 'numeric'],
            'ctc' => ['required', 'numeric'],
            'total_employer_contribution' => ['required', 'numeric'],
            'total_deduction' => ['required', 'numeric']
        ]);
        if ($validator->fails()) {
            return $validator->errors();
        } else {
            // try {
            $request->request->add(['employee_id' => Employee::where('user_id', $request->user_id)->first()->id ?? 0]);
            EmployeeSalary::insertGetId($request->except(['_token', '_method']));
            return response()->json(['success' => $this->page_name . " Added Successfully"]);
            // } catch (Exception $e) {

            //     return response()->json(['success' => $e->getMessage()]);
            // }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $designation = Designation::getDesignation()->get();
        $membership = Membership::all();
        $branch = Branch::getBranch()->get();
        $data = EmployeeSalary::find($id);
        return view('admin.employees_salary.show', ['data' => $data, 'page' => $this->page_name, 'designation' => $designation, 'membership' => $membership, 'branch' => $branch]);
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $designation = Designation::getDesignation()->get();
        $membership = Membership::all();
        $branch = Branch::getBranch()->get();
        $data = EmployeeSalary::find($id);
        return view('admin.employees_salary.edit', ['data' => $data, 'page' => $this->page_name, 'designation' => $designation, 'membership' => $membership, 'branch' => $branch]);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => ['required', 'numeric'],
            'basic' => ['required', 'numeric'],
            'hra' => ['required', 'numeric'],
            'overtime' => ['required', 'numeric'],
            'arrear' => ['required', 'numeric'],
            'union_membership' => ['required', 'numeric'],
            'pf_per' => ['required', 'numeric'],
            'pf_amount' => ['required', 'numeric'],
            'pension_per' => ['required', 'numeric'],
            'pension_amount' => ['required', 'numeric'],
            'loans_deduction' => ['required', 'numeric'],
            'no_of_working_days' => ['required', 'numeric'],
            'no_of_paid_leaves' => ['required', 'numeric'],
            'shift' => ['required', 'string'],
            'no_of_payable_days' => ['required', 'numeric'],
            'conveyance' => ['required', 'numeric'],
            'special' => ['required', 'numeric'],
            'mobile' => ['required', 'numeric'],
            'bonus' => ['required', 'numeric'],
            'transportation' => ['required', 'numeric'],
            'food' => ['required', 'numeric'],
            'medical' => ['required', 'numeric'],
            'gross_earning' => ['required', 'numeric'],
            'esi_per' => ['required', 'numeric'],
            'esi_amount' => ['required', 'numeric'],
            'income_tax_deductions' => ['required', 'numeric'],
            'penalty_deductions' => ['required', 'numeric'],
            'fixed_deductions' => ['required', 'numeric'],
            'other_deductions' => ['required', 'numeric'],
            'net_take_home' => ['required', 'numeric'],
            'ctc' => ['required', 'numeric'],
            'total_employer_contribution' => ['required', 'numeric'],
            'total_deduction' => ['required', 'numeric']
        ]);

        if ($validator->fails()) {
            return $validator->errors();
        } else {
            try {
                EmployeeSalary::where('id', $id)->update($request->except(['_token', 'name', 'email', 'mobile', 'username', 'password', 'password_confirmation', '_method']));
                return response()->json(['success' => $this->page_name . " Updated Successfully"]);
            } catch (Exception $e) {
                return response()->json(['success' => $e->getMessage()]);
            }
        }
    }
    public function status($id)
    {
        if (EmployeeSalary::find($id)->status == "active") {
            EmployeeSalary::where('id', $id)->update(['status' => 'inactive']);
            return "InActive";
        } else {
            EmployeeSalary::where('id', $id)->update(['status' => 'active']);
            return "Active";
        }
    }

    public function getPayscale(Request $request)
    {
        $data =  EmployeePayScale::where('user_id', $request->user_id)->first();
        return response()->json(['data' => $data]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            EmployeeSalary::destroy($id);
            return "Delete";
        } catch (Exception $e) {
            return ["error" => $this->page_name . "Can't Be Delete this May having some Employee"];
        }
    }
}
