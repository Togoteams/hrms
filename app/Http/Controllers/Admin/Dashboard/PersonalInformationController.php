<?php

namespace App\Http\Controllers\Admin\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Designation;
use App\Models\Employee;
use App\Models\EmpPassportOmang;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class PersonalInformationController extends Controller
{

    public function viewEmployeeDetails()
    {
        $page_name = "Employee";
        $data = Employee::first();
        $designation = Designation::all();
        // $data = Employee::where('user_id', Auth::user()->id)->get();
        return view('admin.dashboard.personal-information.employee-details', ['data' => $data, 'designation' => $designation, 'page' => $page_name]);
    }

    public function viewContact()
    {
        $page_name = "Contact";
        $data = Employee::first();
        return view('admin.dashboard.personal-information.contact', ['data' => $data, 'page' => $page_name]);
    }

    public function viewAddress()
    {
        $page_name = "Address";
        $data = Employee::first();
        return view('admin.dashboard.personal-information.address', ['data' => $data, 'page' => $page_name]);
    }

    public function viewDobDetails()
    {
        $page_name = "Date of Birth";
        $data = Employee::first();
        return view('admin.dashboard.personal-information.dob', ['data' => $data, 'page' => $page_name]);
    }

    public function viewPassport()
    {
        $page_name = "Passport";
        $data = EmpPassportOmang::where('user_id', Auth::user()->id)->first();
        return view('admin.dashboard.personal-information.passport', ['data' => $data, 'page' => $page_name]);
    }

    public function viewEmergencyContact()
    {
        $page_name = "Emergency Contact";
        $data = Employee::first();
        return view('admin.dashboard.personal-information.emergency-contact', ['data' => $data, 'page' => $page_name]);
    }

    public function updateEmployeeDetails(Request $request, $id)
    {
        $page_name = "Employee";
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string'],
            'user_id' => ['required', 'numeric'],
            'username' => ['required', 'string'],
            'gender' => ['required', 'string'],
            'designation_id' => ['required', 'numeric'],
            'basic_salary' => ['required', 'numeric'],
        ]);

        if ($validator->fails()) {
            return $validator->errors();
        } else {
            try {
                Employee::where('id', $id)->update($request->except(['_token', 'user_id', 'name', 'username']));
                User::where('id', $request->user_id)->update($request->except(['_token', 'user_id', 'gender', 'designation_id', 'basic_salary']));
                return response()->json(['success' => $page_name . " Updated Successfully"]);
            } catch (Exception $e) {
                return response()->json(['error' => $e->getMessage()]);
            }
        }
    }

    public function updateContact(Request $request)
    {
        $page_name = "Contact";
        $validator = Validator::make($request->all(), [
            'email' => ['string', 'email', 'max:255', 'unique:users'],
            'mobile' => ['numeric', 'min:10'],
        ]);

        if ($validator->fails()) {
            return $validator->errors();
        } else {
            try {
                User::where('id', $request->user_id)->update($request->except(['_token', 'user_id']));
                return response()->json(['success' => $page_name . " Updated Successfully"]);
            } catch (Exception $e) {
                return response()->json(['error' => $e->getMessage()]);
            }
        }
    }

    public function updateAddress(Request $request, $id)
    {
        $page_name = "Address";
        $validator = Validator::make($request->all(), [
            'gender' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return $validator->errors();
        } else {
            try {
                Employee::where('id', $id)->update($request->except(['_token']));
                return response()->json(['success' => $page_name . " Updated Successfully"]);
            } catch (Exception $e) {
                return response()->json(['error' => $e->getMessage()]);
            }
        }
    }

    public function updateDobDetails(Request $request, $id)
    {
        $page_name = "Date of Birth";
        $validator = Validator::make($request->all(), [
            'date_of_birth' => ['required', 'date'],
        ]);

        if ($validator->fails()) {
            return $validator->errors();
        } else {
            try {
                Employee::where('id', $id)->update($request->except(['_token']));
                // return response()->json(['success' => $page_name . " Updated Successfully"]);
                $message = $page_name . " Updated Successfully";
                Session::put('success', $message);
                return redirect()->back();
            } catch (Exception $e) {
                return response()->json(['error' => $e->getMessage()]);
            }
        }
    }

    public function updatePassport(Request $request)
    {
        $page_name = "Passport";
        $validator = Validator::make($request->all(), [
            'passport_no'       => ['nullable', 'numeric'],
            'passport_expiry'   => ['nullable', 'date'],
            'omang_no'          => ['nullable', 'numeric'],
            'omang_expiry'      => ['nullable', 'date'],
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

    public function updateEmergencyContact(Request $request, $id)
    {
        $page_name = "Emergency Contact";
        $validator = Validator::make($request->all(), [
            'emergency_contact' => ['required', 'numeric', 'min:10'],
        ]);

        if ($validator->fails()) {
            return $validator->errors();
        } else {
            try {
                Employee::where('id', $id)->update($request->except(['_token']));
                return response()->json(['success' => $page_name . " Updated Successfully"]);
            } catch (Exception $e) {
                return response()->json(['error' => $e->getMessage()]);
            }
        }
    }
}
