<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Exception;
use Yajra\DataTables\DataTables;
use App\Models\Membership;
use App\Models\Branch;
use App\Models\User;
use App\Models\Designation;
use App\Models\Employee;
use App\Models\EmployeePayScale;

class EmployeePayScaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public $page_name = "Employees PayScale";

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = EmployeePayScale::with(['user', 'employee'])->select('*');
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn = view('admin.employees_payscale.buttons', ['item' => $row, "route" => 'employees-payscale']);
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        $designation = Designation::all();
        $membership = Membership::all();
        $users = User::all();
        $branch = Branch::where('status', 'active')->get();
        return view('admin.employees_payscale.index', ['page' => $this->page_name, 'designation' => $designation, 'membership' => $membership, 'branch' => $branch, 'users' => $users]);
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
            'user_id' => 'required|numeric|unique:employee_pay_scales,user_id',
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
                $request->request->add(['employee_id' => Employee::where('user_id', $request->user_id)->first()->id ?? 0]);
                $request->request->add(['created_by' => auth()->user()->id]);
                EmployeePayScale::insertGetId($request->except(['_token', '_method']));
                return response()->json(['success' => $this->page_name . " Added Successfully"]);
            } catch (Exception $e) {
                return response()->json(['error' => $e->getMessage()]);
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $designation = Designation::all();
        $membership = Membership::all();
        $branch = Branch::where('status', 'active')->get();
        $data = EmployeePayScale::find($id);
        $users = User::all();

        return view('admin.employees_payscale.show', ['data' => $data,'users'=>$users, 'page' => $this->page_name, 'designation' => $designation, 'membership' => $membership, 'branch' => $branch]);
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $designation = Designation::all();
        $membership = Membership::all();
        $branch = Branch::where('status', 'active')->get();
        $data = EmployeePayScale::find($id);
        $users = User::all();

        return view('admin.employees_payscale.edit', ['data' => $data, 'page' => $this->page_name, 'designation' => $designation, 'membership' => $membership, 'branch' => $branch, 'users' => $users]);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|numeric|unique:employee_pay_scales,user_id,'.$id,
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
                EmployeePayScale::where('id', $id)->update($request->except(['_token', '_method']));
                return response()->json(['success' => $this->page_name . " Updated Successfully"]);
            } catch (Exception $e) {
                return response()->json(['error' => $e->getMessage()]);
            }
        }
    }
    public function status($id)
    {
        if (EmployeePayScale::find($id)->status == "active") {
            EmployeePayScale::where('id', $id)->update(['status' => 'inactive']);
            return "InActive";
        } else {
            EmployeePayScale::where('id', $id)->update(['status' => 'active']);
            return "Active";
        }
    }


  

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            EmployeePayScale::destroy($id);
            return "Delete";
        } catch (Exception $e) {
            return ["error" => $this->page_name . "Can't Be Delete this May having some Employee"];
        }
    }
}
