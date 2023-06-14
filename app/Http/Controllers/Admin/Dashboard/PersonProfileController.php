<?php

namespace App\Http\Controllers\Admin\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\EmpDrivingLicense;
use App\Models\EmploymentHistory;
use App\Models\EmpMedicalInsurance;
use App\Models\Qualification;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class PersonProfileController extends Controller
{
    public function viewQualifications()
    {
        $datas = Qualification::where('user_id', Auth::user()->id)->get();
        return view('admin.dashboard.person-profile.qualification', ['datas' => $datas]);
    }

    public function addQualification(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'exam_name' => ['string', 'required'],
            'specialization' => ['string', 'required'],
            'institute_name' => ['string', 'required'],
            'university' => ['string', 'required'],
            'year_of_passing' => ['numeric', 'required'],
            'marks' => ['numeric', 'required'],
        ]);

        if ($validator->fails()) {
            return $validator->errors();
        } else {
            try {
                Qualification::insertGetId($request->except(['_token', 'id']));
                return response()->json(['success' => "Qualification added successfully"]);
            } catch (Exception $e) {
                return response()->json(['error' => $e->getMessage()]);
            }
        }
    }

    public function updateQualification(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => ['required'],
            'exam_name' => ['string', 'required'],
            'specialization' => ['string', 'required'],
            'institute_name' => ['string', 'required'],
            'university' => ['string', 'required'],
            'year_of_passing' => ['numeric', 'required'],
            'marks' => ['numeric', 'required'],
        ]);

        if ($validator->fails()) {
            return $validator->errors();
        } else {
            try {
                Qualification::where('id', $request->id)->update($request->except(['_token', 'id', 'user_id']));
                return response()->json(['success' => "Qualification added successfully"]);
            } catch (Exception $e) {
                return response()->json(['error' => $e->getMessage()]);
            }
        }
    }

    public function editQualification(string $id)
    {
        $data = Qualification::find($id);
        return response()->json(["status" => true, "data" => $data]);
    }


    public function viewPlaceOfDomicile()
    {
        // $datas = Qualification::where('user_id', Auth::user()->id)->get();
        return view('admin.dashboard.person-profile.place-of-domicile');
    }

    public function viewTrainingDetails()
    {
        // $datas = Qualification::where('user_id', Auth::user()->id)->get();
        return view('admin.dashboard.person-profile.training-details');
    }

    public function viewUnionDetails()
    {
        // $datas = Qualification::where('user_id', Auth::user()->id)->get();
        return view('admin.dashboard.person-profile.union-details');
    }

    public function viewPermanentContractual()
    {
        // $datas = Qualification::where('user_id', Auth::user()->id)->get();
        return view('admin.dashboard.person-profile.permanent-contractual');
    }


    public function viewMedicalInsuranceBomaidDetails()
    {
        $data = EmpMedicalInsurance::where('user_id', Auth::user()->id)->first();
        // return $data;
        return view('admin.dashboard.person-profile.medical-insurance-bomaid-details', ['data' => $data]);
    }

    public function updateMedicalInsuranceBomaidDetails(Request $request)
    {
        // return $request;
        $validator = Validator::make($request->all(), [
            'company_name' => ['required', 'string'],
            'insurance_id' => ['required', 'numeric'],
        ]);

        if ($validator->fails()) {
            return $validator->errors();
        } else {
            try {
                EmpMedicalInsurance::where('id', $request->id)->update($request->except(['_token', 'id']));
                // return response()->json(['success' => $page_name . " Updated Successfully"]);
                $message = "Record Updated Successfully";
                Session::put('success', $message);
                return redirect()->back();
            } catch (Exception $e) {
                return response()->json(['error' => $e->getMessage()]);
            }
        }
    }

    public function viewDrivingLicenseDetails()
    {
        $data = EmpDrivingLicense::where('user_id', Auth::user()->id)->first();
        // return $data;
        return view('admin.dashboard.person-profile.driving-license-details', ['data' => $data]);
    }

    public function updateDrivingLicenseDetails(Request $request)
    {
        // return $request;
        $validator = Validator::make($request->all(), [
            'license_no' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return $validator->errors();
        } else {
            try {
                EmpDrivingLicense::where('id', $request->id)->update($request->except(['_token', 'id']));
                // return response()->json(['success' => $page_name . " Updated Successfully"]);
                $message = "Record Updated Successfully";
                Session::put('success', $message);
                return redirect()->back();
            } catch (Exception $e) {
                return response()->json(['error' => $e->getMessage()]);
            }
        }
    }

    public function viewPreviousEmploymentDetails()
    {
        $datas = EmploymentHistory::where('user_id', Auth::user()->id)->get();
        // return $datas;
        return view('admin.dashboard.person-profile.previous-employment-details', ['datas' => $datas]);
    }

    public function addPreviousEmploymentDetails(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'user_id'       => ['required', 'numeric'],
            'company_name'  => ['required', 'string'],
            'start_date'    => ['required', 'date'],
            'end_date'      => ['required', 'date'],

        ]);

        if ($validator->fails()) {
            return $validator->errors();
        } else {
            try {
                EmploymentHistory::insertGetId($request->except(['_token', 'id']));
                $message = "Record Created Successfully";
                return response()->json(['success' => $message]);
            } catch (Exception $e) {
                return response()->json(['error' => $e->getMessage()]);
            }
        }
    }

    public function updatePreviousEmploymentDetails(Request $request)
    {
        // return $request;
        $validator = Validator::make($request->all(), [
            'company_name' => ['required', 'string'],
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date'],
        ]);

        if ($validator->fails()) {
            return $validator->errors();
        } else {
            try {
                EmploymentHistory::where('id', $request->id)->update($request->except(['_token', 'user_id', 'id']));
                $message = "Record Updated Successfully";

                Session::put('success', $message);
                return redirect()->back();
            } catch (Exception $e) {
                return response()->json(['error' => $e->getMessage()]);
            }
        }
    }
}
