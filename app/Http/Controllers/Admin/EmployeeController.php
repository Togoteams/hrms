<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Designation;
use App\Models\Employee;
use App\Models\Membership;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\Branch;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Validator;
use Exception;

class EmployeeController extends Controller
{
    public $page_name = "Employees";
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Employee::with('user')->select('*');
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn = view('admin.employees.buttons', ['item' => $row, "route" => 'employees']);
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        $designation = Designation::all();
        $membership = Membership::all();
        $branch = Branch::where('status', 'active')->get();
        return view('admin.employees.index', ['page' => $this->page_name, 'designation' => $designation, 'membership' => $membership, 'branch' => $branch]);
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'mobile' => ['required', 'numeric', 'min:10'],
            'username' => ['required', 'string', 'min:5', 'unique:users'],
            'password' => ['required', 'confirmed', Password::defaults()],
            'designatin_id' => ['required', 'numeric'],
            'ec_number' => ['required', 'numeric'],
            'ec_number' => ['required', 'numeric'],
            'id_number' => ['required', 'numeric'],
            'contract_duration' => ['required', 'numeric'],
            'basic_salary' => ['required', 'numeric'],
            'date_of_current_basic' => ['required', 'date'],
            'date_of_birth' => ['required', 'date'],
            'start_date' => ['required', 'date'],
            'branch_id' => ['required', 'numeric'],
            'pension_contribution' => ['required', 'numeric'],
            'unique_membership_id' => ['required', 'numeric'],
            'amount_payable_to_bomaind_each_year' => ['required', 'numeric'],
            'currency' => ['required', 'string'],
            'bank_name' => ['required', 'string'],
            'bank_account_number' => ['required', 'numeric'],
            'bank_holder_name' => ['required', 'string'],
            'ifsc' => ['required', 'string'],

        ]);

        if ($validator->fails()) {
            return $validator->errors();
        } else {

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'username' => $request->username,
                'mobile' => $request->mobile,
                'password' => Hash::make($request->password),
            ]);
            try {
                $request->request->add(['user_id' => $user->id]);
                $request->request->add(['emp_id' => 'emp-' . date('Y') . "-" . Employee::count('emp_id') + 1]);
                Employee::insertGetId($request->except(['_token', 'name', 'email', 'mobile', 'username', 'password', 'password_confirmation', '_method']));
                return response()->json(['success' => $this->page_name . " Added Successfully"]);
            } catch (Exception $e) {
                User::destroy($user->id);
                return response()->json(['success' => $e->getMessage()]);
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
        $data = Employee::find($id);
        return view('admin.employees.show', ['data' => $data, 'page' => $this->page_name, 'designation' => $designation, 'membership' => $membership, 'branch' => $branch]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $designation = Designation::all();
        $membership = Membership::all();
        $branch = Branch::where('status', 'active')->get();
        $data = Employee::find($id);
        return view('admin.employees.edit', ['data' => $data, 'page' => $this->page_name, 'designation' => $designation, 'membership' => $membership, 'branch' => $branch]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'designatin_id' => ['required', 'numeric'],
            'ec_number' => ['required', 'numeric'],
            'ec_number' => ['required', 'numeric'],
            'id_number' => ['required', 'numeric'],
            'contract_duration' => ['required', 'numeric'],
            'basic_salary' => ['required', 'numeric'],
            'date_of_current_basic' => ['required', 'date'],
            'date_of_birth' => ['required', 'date'],
            'start_date' => ['required', 'date'],
            'branch_id' => ['required', 'numeric'],
            'pension_contribution' => ['required', 'numeric'],
            'unique_membership_id' => ['required', 'numeric'],
            'amount_payable_to_bomaind_each_year' => ['required', 'numeric'],
            'currency' => ['required', 'string'],
            'bank_name' => ['required', 'string'],
            'bank_account_number' => ['required', 'numeric'],
            'bank_holder_name' => ['required', 'string'],
            'ifsc' => ['required', 'string'],

        ]);

        if ($validator->fails()) {
            return $validator->errors();
        } else {
            try {
                Employee::where('id', $id)->update($request->except(['_token', 'name', 'email', 'mobile', 'username', 'password', 'password_confirmation', '_method']));
                return response()->json(['success' => $this->page_name . " Updated Successfully"]);
            } catch (Exception $e) {
                return response()->json(['success' => $e->getMessage()]);
            }
        }
    }

    public function status($id)
    {
        if (Employee::find($id)->status == "active") {
            Employee::where('id', $id)->update(['status' => 'inactive']);
            return "InActive";
        } else {
            Employee::where('id', $id)->update(['status' => 'active']);
            return "Active";
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $user =  Employee::find($id);
            Employee::destroy($id);
            User::destroy($user->user_id);
            return "Delete";
        } catch (Exception $e) {
            return ["error" => $this->page_name . "Can't Be Delete this May having some Employee"];
        }
    }
}
