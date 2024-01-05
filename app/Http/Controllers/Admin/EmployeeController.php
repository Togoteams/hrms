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
use Illuminate\Support\Str;

use App\Models\Country;
use App\Models\CurrencySetting;
use App\Models\Department;
use App\Models\EmpAddress;
use App\Models\EmpDepartmentHistory;
use App\Models\EmpMedicalInsurance;
use App\Models\EmpPassportOmang;
use App\Models\MedicalCard;
use App\Models\Qualification;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Date;
use Illuminate\Validation\Rule;
use Exception;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat\Wizard\Currency;


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
        $roles = Role::getRoles()->whereNotIn('slug',['managing-director'])->where('status','active')->get();
        $countries = Country::getCountry()->get();
        return view('admin.employees.user-details', ['employee' => $this->getEmployee($eid),'roles'=>$roles,'countries'=>$countries]);
    }

    public function postUserDetails(Request $request)
    {
        if (empty($request->user_id)) {
            $request->validate([
                'name' => ['required', 'string', 'max:255', 'regex:/^[a-zA-Z. ]+$/'],
                'mobile' => ['required', 'numeric', 'digits_between:7,8'],
                'role_id' => ['required', 'numeric'],
                'gender' => ['required'],
                'marital_status' => ['required'],
                'date_of_birth' => ['required', 'date', 'before:today',
                    function ($attribute, $value, $fail) {
                        $date = new \DateTime($value);

                        $today = new \DateTime();
                        $age = $today->diff($date)->y;

                        if ($age < 18 || $age > 60) {
                            $fail('The ' . $attribute . ' must be between 18 and 60 years old.');
                        }
                    },
                ],
                'std_code' => ['required'],
                'emergency_contact' => ['nullable', 'numeric'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'confirmed', Password::defaults()]
            ]);
        } else {
            $request->validate([
                'name' => ['required', 'string', 'max:255', 'regex:/^[a-zA-Z. ]+$/'],
                'mobile' => ['required', 'numeric', 'digits_between:7,8'],
                'gender' => ['required'],
                'role_id' => ['required', 'numeric'],
                'marital_status' => ['required'],
                'date_of_birth' => ['required','date','before:today',
                    function ($attribute, $value, $fail) {
                        $date = new \DateTime($value);

                        $today = new \DateTime();
                        $age = $today->diff($date)->y;

                        if ($age < 18 || $age > 60) {
                            $fail('The ' . $attribute . ' must be between 18 and 60 years old.');
                        }
                    },
                ],
            'std_code' => ['required'],
            'emergency_contact' => ['nullable', 'numeric'],
            ]);
        }
        if ($request->user_id == '') {
            $user = new User();
            // $user->username = $request->username;
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
                $employee = Employee::insertGetId($request->except(['_token', 'name', 'role_id','email', 'mobile', 'password', 'password_confirmation', 'id']));
                $role_id =$request->role_id;
                $user->roles()->sync($role_id);
            } else {
                $employee = Employee::where('id', $request->id)->update($request->except(['_token', 'name', 'email','role_id', 'mobile',  'password', 'password_confirmation', 'id', 'user_id']));

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
                        'redirect_url' => route('admin.employee.employeeDetails.form', $employee->emp_id)
                    ]
                );
            }
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function viewEmployeeDetails($eid = null)
    {
        $designation = Designation::getDesignation()->get();
        $membership = Membership::get();
        $bomaind = MedicalCard::getMedicalCard()->get();
        $currencySetting = CurrencySetting::getCurrency()->get();

        // Filter currencies to include only 'pula' and 'usd'
        $allowedCurrencies = ['pula', 'usd'];
        $filteredCurrencySetting = $currencySetting->whereIn('currency_name_from', $allowedCurrencies);

        $branch = Branch::getBranch()->get();
        $allowedRoles = ['managing-director','chief-manager-ho','branch-head'];
        $reportingAuthority = Employee::whereHas('user.roles',function($q)use ($allowedRoles){
            $q->whereIn('slug',$allowedRoles);
        })->get();
        $allowedRoles = ['managing-director','chief-manager-ho','branch-head','branch-supervisor'];
        $reviewAuthority = Employee::whereHas('user.roles',function($q)use ($allowedRoles){
            $q->whereIn('slug',$allowedRoles);
        })->get();

        return view('admin.employees.employee-details',[
                'page'          => $this->page_name,
                'designation'   => $designation,
                'membership'    => $membership,
                'branch'        => $branch,
                'bomaind'       => $bomaind,
                'currency_setting' =>$filteredCurrencySetting,
                'employee'      => $this->getEmployee($eid),
                'reportingAuthority'      => $reportingAuthority,
                'reviewAuthority'      => $reviewAuthority,
            ]
        );
    }

    public function postEmployeeDetails(Request $request)
    {
        // $request;
        $employee = Employee::find($request->id);
        $forWork = date("Y-m-d", strtotime("+18 years",strtotime($employee->date_of_birth)));
        $request->validate([
            'branch_id'             => ['required', 'numeric'],
            'designation_id'        => ['required', 'numeric'],
            'ec_number'             => ['required', 'string', 'unique:employees,ec_number,'.$employee->id],
            'id_number'             => ['nullable', 'numeric'],
            'start_date'            => ['required','date','after_or_equal:' . $forWork,
            ],
            'currency'              => ['nullable', 'string'],
            'basic_salary'          => ['nullable', 'numeric', 'min:2000', 'max:1000000'],
            'basic_salary_for_india' => ['nullable', 'numeric', 'min:2000', 'max:1000000'],
            'currency_salary_for_india'  => ['nullable', 'string'],
            'salary_type'  => ['nullable', 'string'],
            'da' => ['nullable', 'numeric','between:1,100'],
            'date_of_current_basic' => ['nullable', 'date'],
            'employment_type'       => ['required', 'string'],
            'pension_opt'           => ['nullable', 'numeric'],
            'pension_contribution'  => ['nullable', 'string'],
            'bank_account_number'   => ['required', 'numeric','digits_between:12,16'],
            'amount_payable_to_bomaind_each_year' => ['nullable', 'numeric'],
            'currency_salary'       => ['required', 'string'],
            'review_authority'              => ['nullable', 'string'],
            'reporting_authority'              => ['nullable', 'string'],



        ]);

        if ($request->employment_type == 'local-contractual') {
            $request->validate([
                'contract_duration' => ['required', 'numeric', 'gt:0'],
            ]);
        }

        try {
            if ($request->pension_contribution == "no") {
                $request->merge(['pension_opt' => NULL]);
            }
            Employee::where('id', $request->id)->update($request->except(['_token', 'id', 'user_id']));
            $employee = Employee::find($request->id);

            if (!empty($employee)) {
                $message = "Employee Details Added Successfully";
                // return route('admin.employee.address.form', $employee->emp_id);
                return $this->responseJson(
                    true,
                    200,
                    $message,
                    ["employee" => $employee,'redirect_url' => route('admin.employee.address.form', $employee->emp_id)]
                );
            }
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function viewAddress($eid = null)
    {
        $countries = Country::getCountry()->get();
        $employee = $this->getEmployee($eid);
        $empAddresses =EmpAddress::where('user_id',$employee->user_id)->get();
        // return $empAddresses;
        return view('admin.employees.emp-address', ['employee' => $this->getEmployee($eid),'empAddresses'=>$empAddresses, 'countries'=>$countries]);
    }

    public function postAddress(Request $request)
    {
        $request->validate([
            'address'   => ['required', 'string'],
            'post_box'       => ['nullable'],
            'city'      => ['required', 'string', 'regex:/^[a-zA-Z. ]+$/'],
            'state'     => ['required', 'string','regex:/^[a-zA-Z. ]+$/'],
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
                ["employee" => $employee,'redirect_url' => route('admin.employee.domicile.form', $employee->emp_id)]
            );
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }
    public function deleteAddress(Request $request)
    {
        $request->validate([
            'id' => ['required', 'numeric'],
        ]);

        try {
            $empAddress = EmpAddress::find($request->id);
            if ($empAddress) {
                $empAddress->delete();
                $message = "Record deleted Successfully";
                return response()->json(['status' => true, 'message' => $message]);
            } else {
                return response()->json(['status' => false, 'error' => 'Record not found']);
            }
        } catch (Exception $e) {
            return response()->json(['status' => false, 'error' => $e->getMessage()]);
        }
    }

    public function viewPassportOmang($eid = null)
    {
        $countries = Country::getCountry()->get();
        return view('admin.employees.emp-passport-omang', ['employee' => $this->getEmployee($eid), 'countries'=>$countries]);
    }

    public function postPassportOmang(Request $request)
    {
        $employee = Employee::firstWhere('user_id', $request->user_id);

        $request->validate([
            'type'       => ['required', 'string'],
            'certificate_no' => [
                'required',
                'string',
                function ($attribute, $value, $fail) use ($request) {
                    if ($request->type === 'passport') {
                        if (!preg_match('/^[a-zA-Z0-9.]{8,12}$/', $value)) {
                            $fail("The certificate no format is invalid for a passport. It should be between 8 and 12 characters, including letters, numbers, and dots.");
                        }
                    } elseif ($request->type === 'omang' && !preg_match('/^[0-9]{9}$/', $value)) {
                        $fail("The certificate no format is invalid for an omang. It should be a 9-digit number.");
                    }
                },
            ],
            'certificate_issue_date'       => ['required', 'date','before_or_equal:' . now()->format('Y-m-d'),'after_or_equal:'.$employee->date_of_birth],
            'certificate_expiry_date'       => ['required', 'date', 'after_or_equal:certificate_issue_date'],
            'country'       => ['required', 'string'],

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
                ["employee" => $employee,'redirect_url' => route('admin.employee.qualification.form', $employee->emp_id)]
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
            'year_of_passing' => ['numeric', 'required', 'digits:4', 'gt:1950', 'max:' . Date::now()->year],
            'marks' => ['string', 'required'],
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
                ["employee" => $employee,'redirect_url' => route('admin.employee.medicalInsuaranceBomaid.form', $employee->emp_id)]
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
                return response()->json(['status' => true, 'message' => $message]);
            } else {
                return response()->json(['status' => false, 'error' => 'Record not found']);
            }
        } catch (Exception $e) {
            return response()->json(['status' => false, 'error' => $e->getMessage()]);
        }
    }

    public function viewMedicalInsuaranceBomaid($eid = null)
    {
        $cardType = MedicalCard::getMedicalCard()->get();
        $emp= $this->getEmployee($eid);
        $medicalInsuarances = EmpMedicalInsurance::where('user_id',$emp->user_id)->orderBy('id','desc')->get();
        return view('admin.employees.emp-medical-insuarance-bomaid', ['employee' => $emp,'medicalInsuarances'=>$medicalInsuarances,'cardType'=>$cardType]);
    }


    public function postMedicalInsuaranceBomaid(Request $request)
    {
        $request->validate([
            'amount' => ['required', 'numeric','gt:0'],
            'company_name' => ['required', 'string'],
            'medical_insurances_date' => ['required', 'date'],
            'insurance_id' => ['required', 'regex:/^[a-zA-Z0-9]+$/'],
        ]);

        try {
            $emp_insurance_id = $request->id;
            if ($request->id == '') {
               $emp_insurance_id = EmpMedicalInsurance::insertGetId($request->except(['_token', 'id']));
                $message = "Record Created Successfully";
                EmpMedicalInsurance::where('id','<>',$emp_insurance_id)->where('user_id',$request->user_id)->update(['status'=>'inactive']);
            } else {
                EmpMedicalInsurance::where('id', $request->id)->update($request->except(['_token', 'user_id', 'id']));
                $message = "Record Updated Successfully";
            }
            $employee = Employee::firstWhere('user_id', $request->user_id);

            return $this->responseJson(
                true,
                200,
                $message,
                ["employee" => $employee,'redirect_url' => route('admin.employee.departmentHistory.form', $employee->emp_id)]
            );
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function deleteMedicalInsuarance(Request $request)
    {
        $request->validate([
            'id' => ['required', 'numeric'],
        ]);

        try {
            $medicalInsurance = EmpMedicalInsurance::find($request->id);
            if ($medicalInsurance) {
                $medicalInsurance->delete();
                $message = "Record deleted Successfully";
                return response()->json(['status' => true, 'message' => $message]);
            } else {
                return response()->json(['status' => false, 'error' => 'Record not found']);
            }
        } catch (Exception $e) {
            return response()->json(['status' => false, 'error' => $e->getMessage()]);
        }
    }


    public function viewDomicile($eid = null)
    {
        return view('admin.employees.emp-domicile', ['employee' => $this->getEmployee($eid)]);
    }

    public function postDomicile(Request $request)
    {
        $request->validate([

            'place_of_domicile' => ['required', 'string','regex:/^[a-zA-Z. ]+$/'],

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
                    ["employee" => $employee,'redirect_url' => route('admin.employee.passportOmang.form', $employee->emp_id)]
                );
            }
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function viewDepartmentHistory($eid = null)
    {
        $departments = Department::getDepartment()->get();
        return view('admin.employees.emp-department-history', ['employee' => $this->getEmployee($eid),'departments'=>$departments]);
    }

    public function postDepartmentHistory(Request $request)
    {
        Validator::extend('no_date_overlap', function ($attribute, $value, $parameters, $validator) {
            $start_date = $validator->getData()['start_date'];
            $end_date = $validator->getData()['end_date'] ?? date('Y-m-d');
            $id = $validator->getData()['id'] ?? "";
            $userId = $validator->getData()['user_id'] ?? "";
            $overlappingRecord =  true;

            $overlappingRecord = EmpDepartmentHistory::where(function ($query) use ($start_date, $end_date,$id,$userId) {
                $query->where('start_date', '<=', $end_date)->where('user_id',$userId);
                if(!empty($end_date))
                {
                    $query->where('end_date', '>=', $start_date);
                }
                if(!empty($id))
                {
                    $query->whereNotIn('id', [$id]);
                }
            })->first();
            return !$overlappingRecord;
        });

        Validator::replacer('no_date_overlap', function ($message, $attribute, $rule, $parameters) {
            $value = Str::headline(Str::camel($attribute));
            return "The $value  range overlaps with an existing record.";
        });
        $employee = Employee::where('user_id', $request->user_id)->first();

        $request->validate([
            'department_name' => [
                'string',
                'required',
                Rule::unique('emp_department_histories')
                    ->where(function ($query) use ($request) {
                        return $query->where('user_id', $request->user_id);
                    })
                    ->ignore($request->id),
            ],
            'start_date' => [
                'required',
                'date','no_date_overlap',
                'after:' . $employee->start_date,
            ],
            'end_date' => ['sometimes','nullable', 'date', 'after:start_date','no_date_overlap', 'before_or_equal:' . now()->format('Y-m-d')],            // 'end_date' => ['nullable', 'date', 'after:start_date', 'before_or_equal:' . now()->format('Y-m-d')],
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
                ["employee" => $employee,'redirect_url' => route('admin.employee.departmentHistory.form', $employee->emp_id)]
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
                return response()->json(['status' => true, 'message' => $message]);
            } else {
                return response()->json(['status' => false, 'error' => 'Department not found']);
            }
        } catch (Exception $e) {
            return response()->json(['status' => false, 'error' => $e->getMessage()]);
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
            // 'username' => ['required', 'string', 'min:5', 'unique:users'],
            'password' => ['required', 'confirmed', Password::defaults()],
            'designation_id' => ['required', 'numeric'],
            'ec_number' => ['required', 'string', 'unique:employees'],
            'id_number' => ['required', 'numeric'],
            'employment_type' => ['required', 'string'],
            'contract_duration' => ['numeric'],
            'basic_salary' => ['required', 'numeric'],
            'date_of_current_basic' => ['required', 'date'],
            'date_of_birth' => ['required', 'date'],
            'start_date' => ['required', 'date'],
            'branch_id' => ['required', 'numeric'],
            'pension_contribution' => ['required', 'numeric'],
            'unique_membership_id' => ['required', 'numeric'],
            'amount_payable_to_bomaind_each_year' => ['nullable', 'numeric'],
            'currency' => ['required', 'string'],
            'bank_account_number' => ['required', 'numeric'],
            'bank_name' => ['required', 'string'],
            'bank_holder_name' => ['required', 'string'],
            'ifsc' => ['required', 'string', 'min:11'],

        ]);


        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            // 'username' => $request->username,
            'mobile' => $request->mobile,
            'password' => Hash::make($request->password),
        ]);
        try {
            $request->request->add(['user_id' => $user->id]);
            $request->request->add(['emp_id' => 'emp-' . date('Y') . "-" . Employee::count('emp_id') + 1]);
            Employee::insertGetId($request->except(['_token', 'name', 'email', 'mobile', 'password', 'password_confirmation', '_method']));
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
            'ec_number' => ['required', 'string', 'unique:employees'],
            'id_number' => ['required', 'numeric'],
            'employment_type' => ['required', 'string'],
            'contract_duration' => ['numeric'],
            'basic_salary' => ['required', 'numeric'],
            'date_of_current_basic' => ['required', 'date'],
            'date_of_birth' => ['required', 'date'],
            'start_date' => ['required', 'date'],
            'branch_id' => ['required', 'numeric'],
            'pension_contribution' => ['required', 'numeric'],
            'unique_membership_id' => ['required', 'numeric'],
            'amount_payable_to_bomaind_each_year' => ['nullable', 'numeric'],
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
