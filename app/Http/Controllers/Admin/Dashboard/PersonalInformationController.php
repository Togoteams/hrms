<?php

namespace App\Http\Controllers\Admin\Dashboard;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Designation;
use App\Models\Document;
use App\Models\DocumentEmp;
use App\Models\EmpAddress;
use App\Models\Employee;
use App\Models\EmpPassportOmang;
use App\Models\FamilyDetail;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class PersonalInformationController extends BaseController
{

    public function viewEmployeeDetails()
    {
        $page_name = "Employee";
        $data = Employee::where('user_id', Auth::user()->id)->first();
        if (empty($data)) {
            return redirect('/');
        }
        $designation = Designation::getDesignation()->get();
        $countries = Country::getCountry()->get();
        // Access the user's salutation
        $salutation = $data->user->salutation;

        return view('admin.dashboard.personal-information.employee-details', ['data' => $data, 'designation' => $designation,
         'page' => $page_name, 'countries'=>$countries,'salutation' => $salutation]);
    }


    public function viewFamilyDetails()
    {
        $page_name = "Family Details";
        // $data = Employee::where('user_id', Auth::user()->id)->first();
        // $designation = Designation::all();
        $countries = Country::getCountry()->get();
        $datas = FamilyDetail::where('user_id', Auth::user()->id)->get();
        return view('admin.dashboard.personal-information.family-details', ['page' => $page_name, 'datas'=>$datas , 'countries'=>$countries]);
    }

    public function viewDocumentDetails()
    {
        $user = Auth::user();
        $datas = DocumentEmp::with('document','document.documentType')->get();
        // $datas = DB::table('document_emps')
        //     ->join('documents', 'document_emps.document_id', '=', 'documents.id')
        //     ->where('document_emps.emp_id', $user->id)
        //     ->select('documents.*')
        //     ->get();
        //  dd($datas);
        return view('admin.dashboard.personal-information.document-details', ['datas' => $datas]);
    }

    public function viewContact()
    {
        $page_name = "Contact";
        $data = Employee::where('user_id', Auth::user()->id)->first();
        return view('admin.dashboard.personal-information.contact', ['data' => $data, 'page' => $page_name]);
    }

    public function viewAddress()
    {
        $page_name = "Address";
        $countries = Country::getCountry()->get();
        $data = EmpAddress::where('user_id', Auth::user()->id)->first();
        // return $data;
        return view('admin.dashboard.personal-information.address', ['data' => $data, 'page' => $page_name,'countries'=>$countries]);
    }

    public function viewPassport()
    {
        $page_name = "Passport";
        $countries = Country::getCountry()->get();
        $data = EmpPassportOmang::where('user_id', Auth::user()->id)->first();
        return view('admin.dashboard.personal-information.passport', ['data' => $data, 'page' => $page_name, 'countries'=>$countries]);
    }

    public function updateEmployeeDetails(Request $request)
    {
        $page_name = "Employee";
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            //  'name' => ['required', 'string'],
             'user_id' => ['required', 'numeric'],
             'gender' => ['required', 'string'],
            //  'salutation' => ['required', 'string'],
             'name' => ['required', 'string','regex:/^[a-zA-Z. ]+$/'],
            //  'last_name' => ['required', 'string','regex:/^[a-zA-Z. ]+$/'],
             'birth_country' => ['required', 'string','regex:/^[a-zA-Z. ]+$/'],
             'blood_group' => ['required','string'],
             'date_of_birth' => [
                'required',
                'date',
                function ($attribute, $value, $fail) {
                    $eighteenYearsAgo = now()->subYears(18);
                    if ($value > $eighteenYearsAgo) {
                        $fail("The $attribute must be at least 18 years ago.");
                    }
                }
            ],

        ]);
        if ($validator->fails()) {
            return $validator->errors();

        } else {
            try {
                // Employee::where('id', $request->id)->update($request->except(['_token', 'user_id', 'name', 'username']));
                Employee::where('id', $request->id)->update($request->except(['_token', 'user_id', 'salutation','name']));
                // User::where('id', $request->user_id)->update($request->except(['_token', 'user_id', 'gender', 'designation_id', 'basic_salary']));
                User::where('id', $request->user_id)->update(['name'=>$request->name]);
                return response()->json(['success' => $page_name . " Updated Successfully"]);
            } catch (Exception $e) {
                return response()->json(['error' => $e->getMessage()]);
            }
        }
    }

    public function addFamilyDetails(Request $request)
    {
     $page_name = "Family Details";
     $validator = Validator::make($request->all(), [
            'user_id' => 'required|numeric',
            'relation' => 'required|string',
            'date_of_birth' => [
                'required',
                'date',
                'before:today',
                function ($attribute, $value, $fail) {
                    $date = new \DateTime($value);

                    $today = new \DateTime();
                    $age = $today->diff($date)->y;

                    if ($age < 18) {
                        $fail('The ' . $attribute . ' must be at least 18 years old.');
                    }
                },
            ],
            'name' => 'required|string',
            'depended' => 'required|string',
            'marital_status' => 'required|string',
            'gender' => 'required|string',
            'occupations' => 'required|string',
            'monthly_income' => 'required|numeric',
            'bank_of_baroda_employee' => 'required|string',
            'address_line1' =>'required|string',
            'address_line2'=>'nullable|string',
            'state' => 'required|string',
            'country' => 'required|string',
            'email' => 'nullable|email',
            'std_code' => 'required|string',
            'number' => 'required | numeric | digits_between:7,8',
            'nationality' => 'required|string',
        ]);
        if ($validator->fails()) {
            return $validator->errors();
        } else {
            // FamilyDetail::create($request->except('_token'));
            // return response()->json(['success' => $page_name . " Added Successfully"]);
            try {
                if (empty($request->id)) {
                    FamilyDetail::insertGetId($request->except(['_token', 'id']));
                    $message = "Record Created Successfully";
                } else {
                    FamilyDetail::where('id', $request->id)->update($request->except(['_token', 'user_id', 'id']));
                    $message = "Record Updated Successfully";
                }
                return response()->json(['success' => $message]);
            } catch (Exception $e) {
                return response()->json(['error' => $e->getMessage()]);
            }
        }
    }

    public function deleteFamilyDetails(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => ['required', 'numeric'],
        ]);

        if ($validator->fails()) {
            return $validator->errors();
        } else {
            try {
                $family = FamilyDetail::find($request->id);
                if ($family) {
                    $family->delete();
                    $message = "Record deleted Successfully";
                    return response()->json(['status' => true, 'message' => $message]);
                } else {
                    return response()->json(['status' => false, 'error' => 'Record not found']);
                }
            } catch (Exception $e) {
                return response()->json(['status' => false, 'error' => $e->getMessage()]);
            }
        }
    }

    public function updateContact(Request $request)
    {
        $page_name = "Contact";
        $validator = Validator::make($request->all(), [
           // 'email' => ['string', 'email', 'max:255', 'unique:users'],
            // 'email' =>'required|email|max:255|unique:users,email,'.$request->user_id,
            'mobile' => ['numeric', 'min:10'],
            'emergency_contact' => ['numeric', 'min:10'],
        ]);

        if ($validator->fails()) {
            return $validator->errors();
        } else {
            try {
                User::where('id', $request->user_id)->update($request->except(['_token', 'user_id', 'id','email', 'emergency_contact']));
                Employee::where('id', $request->id)->update($request->except(['_token', 'user_id', 'email', 'mobile']));
                return response()->json(['success' => $page_name . " Updated Successfully"]);
            } catch (Exception $e) {
                return response()->json(['error' => $e->getMessage()]);
            }
        }
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
            return $this->responseJson( true,
                200,
                $message,
                []
            );
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }


           
    }

    public function updatePassport(Request $request)
    {
        $page_name = "Passport";
            $validator = Validator::make($request->all(), [
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
                'certificate_issue_date'=> ['required', 'date','before_or_equal:' . now()->format('Y-m-d')],
                'certificate_expiry_date'=> ['required', 'date', 'after_or_equal:certificate_issue_date'],
                'country' => ['required', 'string','regex:/^[a-zA-Z. ]+$/'],
            ]);

        if ($validator->fails()) {
            return $validator->errors();
        } else {
            try {
                if ($request->id == '') {
                    EmpPassportOmang::insertGetId($request->except(['_token', 'id']));
                    return response()->json(['success' => $page_name . " Created Successfully"]);
                } else {
                    EmpPassportOmang::where('id', $request->id)->update($request->except(['_token', 'user_id', 'id']));
                    return response()->json(['success' => $page_name . " Updated Successfully"]);
                }
            } catch (Exception $e) {
                return response()->json(['error' => $e->getMessage()]);
            }
        }
    }
}
