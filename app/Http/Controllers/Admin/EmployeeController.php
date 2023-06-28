<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Models\Designation;
use App\Models\Employee;
use App\Models\Membership;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\Branch;
use App\Models\EmpAddress;
use App\Models\EmpDepartmentHistory;
use App\Models\EmpMedicalInsurance;
use App\Models\EmpPassportOmang;
use App\Models\Qualification;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Exception;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class EmployeeController extends BaseController
{
    public $page_name = "Employees";

    public function getEmployee($emp_id = null)
    {
        if (!empty($emp_id)) {
            return Employee::firstWhere('emp_id', $emp_id);
        } else {
            return '';
        }
    }
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

    public function viewUserDetails($eid = null)
    {
        return view('admin.employees.user-details', ['employee' => $this->getEmployee($eid)]);
    }

    public function postUserDetails(Request $request)
    {
        if (empty($request->user_id)) {
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'mobile' => ['required', 'numeric', 'min:10'],
                'gender' => ['required'],
                'marital_status' => ['required'],
                'date_of_birth' => ['required', 'date'],
                'emergency_contact' => ['nullable', 'numeric', 'min:10'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'username' => ['required', 'string', 'min:5', 'unique:users'],
                'password' => ['required', 'confirmed', Password::defaults()]
            ]);
        } else {
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'mobile' => ['required', 'numeric', 'min:10'],
                'gender' => ['required'],
                'marital_status' => ['required'],
                'date_of_birth' => ['required', 'date'],
                'emergency_contact' => ['nullable', 'numeric', 'min:10'],
            ]);
        }
        if ($request->user_id == '') {
            $user = new User();
            $user->username = $request->username;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
        } else {
            $user = User::find($request->user_id);
        }
        $user->name = $request->name;
        $user->mobile = $request->mobile;
        $user->save();

        try {
            if (empty($request->id)) {
                $request->request->add(['user_id' => $user->id]);
                $request->request->add(['emp_id' => 'emp-' . date('Y') . "-" . Employee::count('emp_id') + 1]);
                $employee = Employee::insertGetId($request->except(['_token', 'name', 'email', 'mobile', 'username', 'password', 'password_confirmation', 'id']));
                $role_id = Role::where('short_code', 'employee')->value('id');
                $user->roles()->sync($role_id);
            } else {
                $employee = Employee::where('id', $request->id)->update($request->except(['_token', 'name', 'email', 'mobile', 'username', 'password', 'password_confirmation', 'id', 'user_id']));
            }

            $employee = Employee::firstWhere('user_id', $user->id);
            if (!empty($user) && !empty($employee)) {
                $message = "User Details Added Successfully";

                return $this->responseJson(
                    true,
                    200,
                    $message,
                    [
                        "employee" => $employee,
                        'redirect_url' => route('admin.employee.userDetails.form', $employee->emp_id)
                    ]
                );
            }
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function viewEmployeeDetails($eid = null)
    {
        $designation = Designation::all();
        $membership = Membership::all();
        $branch = Branch::where('status', 'active')->get();
        return view(
            'admin.employees.employee-details',
            [
                'page'          => $this->page_name,
                'designation'   => $designation,
                'membership'    => $membership,
                'branch'        => $branch,
                'employee'      => $this->getEmployee($eid)
            ]
        );
    }

    public function postEmployeeDetails(Request $request)
    {
        // $request;
        $request->validate([

            'branch_id'             => ['required', 'numeric'],
            'designation_id'        => ['required', 'numeric'],
            'ec_number'             => ['required', 'numeric'],
            'id_number'             => ['required', 'numeric'],
            'start_date'            => ['required', 'date'],
            'currency'              => ['required', 'string'],
            'basic_salary'          => ['required', 'numeric'],
            'date_of_current_basic' => ['required', 'date'],
            'employment_type'       => ['required', 'string'],
            'pension_opt'           => ['required', 'numeric'],
            'union_membership_id'   => ['required', 'numeric'],
            'bank_account_number'   => ['required', 'numeric'],
            'amount_payable_to_bomaind_each_year' => ['required', 'numeric'],

        ]);

        if ($request->employment_type == 'local-contractual') {
            $request->validate([
                'contract_duration' => ['required', 'numeric'],
            ]);
        }

        try {
            if ($request->pension_opt == 1) {
                $request->request->add(['pension_contribution' => ($request->basic_salary) / 100]);
            } else {
                $request->request->add(['pension_contribution' => 0]);
            }
            Employee::where('id', $request->id)->update($request->except(['_token', 'id', 'user_id', 'pension_opt']));
            $employee = Employee::find($request->id);

            if (!empty($employee)) {
                $message = "Employee Details Added Successfully";

                return $this->responseJson(
                    true,
                    200,
                    $message,
                    ["employee" => $employee],
                    ['redirect_url' => route('admin.employee.employeeDetails.form', $employee->emp_id)]
                );
            }
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function viewAddress($eid = null)
    {
        return view('admin.employees.emp-address', ['employee' => $this->getEmployee($eid)]);
    }

    public function postAddress(Request $request)
    {
        $request->validate([
            'address'   => ['required', 'string'],
            'zip'       => ['required', 'string'],
            'city'      => ['required', 'string'],
            'state'     => ['required', 'string'],
            'country'   => ['required', 'string'],
        ]);

        try {
            if ($request->id == '') {
                EmpAddress::insertGetId($request->except(['_token', 'id']));
                $message = "Address Created Successfully";
            } else {
                EmpAddress::where('id', $request->id)->update($request->except(['_token', 'user_id', 'id']));
                $message = "Address Updated Successfully";
            }
            $employee = Employee::firstWhere('user_id', $request->user_id);

            return $this->responseJson(
                true,
                200,
                $message,
                ["employee" => $employee],
                ['redirect_url' => route('admin.employee.address.form', $employee->emp_id)]
            );
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function viewPassportOmang($eid = null)
    {
        return view('admin.employees.emp-passport-omang', ['employee' => $this->getEmployee($eid)]);
    }

    public function postPassportOmang(Request $request)
    {
        $request->validate([
            'passport_no'       => ['nullable', 'numeric'],
            'passport_expiry'   => ['nullable', 'date'],
            'omang_no'          => ['nullable', 'numeric'],
            'omang_expiry'      => ['nullable', 'date'],
        ]);

        try {
            if ($request->id == '') {
                EmpPassportOmang::insertGetId($request->except(['_token', 'id']));
            } else {
                EmpPassportOmang::where('id', $request->id)->update($request->except(['_token', 'user_id', 'id']));
            }
            $message = "Saved Successfully";
            $employee = Employee::firstWhere('user_id', $request->user_id);

            return $this->responseJson(
                true,
                200,
                $message,
                ["employee" => $employee],
                ['redirect_url' => route('admin.employee.passportOmang.form', $employee->emp_id)]
            );
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function viewQualification($eid = null)
    {
        return view('admin.employees.emp-qualification', ['employee' => $this->getEmployee($eid)]);
    }

    public function postQualification(Request $request)
    {
        $request->validate([
            'exam_name' => ['string', 'required'],
            'specialization' => ['string', 'required'],
            'institute_name' => ['string', 'required'],
            'university' => ['string', 'required'],
            'year_of_passing' => ['numeric', 'required'],
            'marks' => ['numeric', 'required'],
        ]);

        try {
            if ($request->id == '') {
                Qualification::insertGetId($request->except(['_token', 'id']));
                $message = "Qualification added successfully";
            } else {
                Qualification::where('id', $request->id)->update($request->except(['_token', 'id', 'user_id']));
                $message = "Qualification updated successfully";
            }
            $employee = Employee::firstWhere('user_id', $request->user_id);

            return $this->responseJson(
                true,
                200,
                $message,
                ["employee" => $employee],
                ['redirect_url' => route('admin.employee.qualification.form', $employee->emp_id)]
            );
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }
    public function deleteQualification(Request $request)
    {
        $request->validate([
            'id' => ['required', 'numeric'],
        ]);

        try {
            $qualification = Qualification::find($request->id);
            if ($qualification) {
                $qualification->delete();
                $message = "Record deleted Successfully";
                Session::put('success', $message);
                return redirect()->back();
            } else {
                return response()->json(['error' => 'Qualification not found']);
            }
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function viewMedicalInsuaranceBomaid($eid = null)
    {
        return view('admin.employees.emp-medical-insuarance-bomaid', ['employee' => $this->getEmployee($eid)]);
    }


    public function postMedicalInsuaranceBomaid(Request $request)
    {
        $request->validate([
            'company_name' => ['required', 'string'],
            'insurance_id' => ['required', 'numeric'],
        ]);

        try {
            if ($request->id == '') {
                EmpMedicalInsurance::insertGetId($request->except(['_token', 'id']));
                $message = "Record Created Successfully";
            } else {
                EmpMedicalInsurance::where('id', $request->id)->update($request->except(['_token', 'user_id', 'id']));
                $message = "Record Updated Successfully";
            }
            $employee = Employee::firstWhere('user_id', $request->user_id);

            return $this->responseJson(
                true,
                200,
                $message,
                ["employee" => $employee],
                ['redirect_url' => route('admin.employee.medicalInsuaranceBomaid.form', $employee->emp_id)]
            );
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function viewDomicile($eid = null)
    {
        return view('admin.employees.emp-domicile', ['employee' => $this->getEmployee($eid)]);
    }

    public function postDomicile(Request $request)
    {
        $request->validate([

            'place_of_domicile' => ['required', 'string'],

        ]);

        try {
            Employee::where('id', $request->id)->update($request->except(['_token', 'id', 'user_id']));
            $employee = Employee::firstWhere('user_id', $request->user_id);

            if (!empty($employee)) {
                $message = "Place of Domicile Saved Successfully";

                return $this->responseJson(
                    true,
                    200,
                    $message,
                    ["employee" => $employee],
                    ['redirect_url' => route('admin.employee.domicile.form', $employee->emp_id)]
                );
            }
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function viewDepartmentHistory($eid = null)
    {
        return view('admin.employees.emp-department-history', ['employee' => $this->getEmployee($eid)]);
    }

    public function postDepartmentHistory(Request $request)
    {
        $request->validate([
            'department_name' => ['string', 'required'],
        ]);

        try {
            if ($request->id == '') {
                EmpDepartmentHistory::insertGetId($request->except(['_token', 'id']));
                $message = "Department added successfully";
            } else {
                EmpDepartmentHistory::where('id', $request->id)->update($request->except(['_token', 'id', 'user_id']));
                $message = "Department updated successfully";
            }
            $employee = Employee::firstWhere('user_id', $request->user_id);

            return $this->responseJson(
                true,
                200,
                $message,
                ["employee" => $employee],
                ['redirect_url' => route('admin.employee.departmentHistory.form', $employee->emp_id)]
            );
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }
    public function deleteDepartmentHistory(Request $request)
    {
        $request->validate([
            'id' => ['required', 'numeric'],
        ]);

        try {
            $qualification = EmpDepartmentHistory::find($request->id);
            if ($qualification) {
                $qualification->delete();
                $message = "Record deleted Successfully";
                Session::put('success', $message);
                return redirect()->back();
            } else {
                return response()->json(['error' => 'Department not found']);
            }
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
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

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'mobile' => ['required', 'numeric', 'min:10'],
            'username' => ['required', 'string', 'min:5', 'unique:users'],
            'password' => ['required', 'confirmed', Password::defaults()],
            'designation_id' => ['required', 'numeric'],
            'ec_number' => ['required', 'numeric'],
            'ec_number' => ['required', 'numeric'],
            'id_number' => ['required', 'numeric'],
            'employment_type' => ['required', 'string'],
            'contract_duration' => [
                Rule::requiredIf(function () {
                    return $this->input('employment_type') === 'local-contractual';
                }),
                'numeric',
            ],
            'basic_salary' => ['required', 'numeric'],
            'date_of_current_basic' => ['required', 'date'],
            'date_of_birth' => ['required', 'date'],
            'start_date' => ['required', 'date'],
            'branch_id' => ['required', 'numeric'],
            'pension_contribution' => ['required', 'numeric'],
            'unique_membership_id' => ['required', 'numeric'],
            'amount_payable_to_bomaind_each_year' => ['required', 'numeric'],
            'currency' => ['required', 'string'],
            'bank_account_number' => ['required', 'numeric'],
            // 'bank_name' => ['required', 'string'],
            // 'bank_holder_name' => ['required', 'string'],
            // 'ifsc' => ['required', 'string', 'min:11'],

        ]);


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
            $role_id = Role::where('short_code', 'employee')->value('id');
            $user->roles()->sync($role_id);
            return response()->json(['success' => $this->page_name . " Added Successfully"]);
        } catch (Exception $e) {
            User::destroy($user->id);
            return response()->json(['error' => $e->getMessage()]);
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
        $request->validate([
            'designation_id' => ['required', 'numeric'],
            'ec_number' => ['required', 'numeric'],
            'ec_number' => ['required', 'numeric'],
            'id_number' => ['required', 'numeric'],
            'employment_type' => ['required', 'string'],
            'contract_duration' => [
                Rule::requiredIf(function () {
                    return $this->input('employment_type') === 'local-contractual';
                }),
                'numeric',
            ],
            'basic_salary' => ['required', 'numeric'],
            'date_of_current_basic' => ['required', 'date'],
            'date_of_birth' => ['required', 'date'],
            'start_date' => ['required', 'date'],
            'branch_id' => ['required', 'numeric'],
            'pension_contribution' => ['required', 'numeric'],
            'unique_membership_id' => ['required', 'numeric'],
            'amount_payable_to_bomaind_each_year' => ['required', 'numeric'],
            'currency' => ['required', 'string'],
            'bank_account_number' => ['required', 'numeric'],
            // 'bank_name' => ['required', 'string'],
            // 'bank_holder_name' => ['required', 'string'],
            // 'ifsc' => ['required', 'string'],

        ]);

        try {
            Employee::where('id', $id)->update($request->except(['_token', 'name', 'email', 'mobile', 'username', 'password', 'password_confirmation', '_method']));
            return response()->json(['success' => $this->page_name . " Updated Successfully"]);
        } catch (Exception $e) {
            return response()->json(['success' => $e->getMessage()]);
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
