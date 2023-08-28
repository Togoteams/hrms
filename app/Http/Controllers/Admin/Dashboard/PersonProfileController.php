<?php

namespace App\Http\Controllers\Admin\Dashboard;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Models\Designation;
use App\Models\EmpDrivingLicense;
use App\Models\Employee;
use App\Models\EmploymentHistory;
use App\Models\EmpMedicalCart;
use App\Models\EmpMedicalInsurance;
use App\Models\MedicalCart;
use App\Models\Qualification;
use App\Models\TrainingDetails;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Date;

class PersonProfileController extends BaseController
{
    public function viewQualifications()
    {
        $datas = Qualification::where('user_id', Auth::user()->id)->get();
        return view('admin.dashboard.person-profile.qualification', ['datas' => $datas]);
    }

    public function postQualification(Request $request)
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
                if (empty($request->id)) {
                    Qualification::insertGetId($request->except(['_token', 'id']));
                    $message = "Qualification added successfully";
                } else {
                    Qualification::where('id', $request->id)->update($request->except(['_token', 'id', 'user_id', 'id']));
                    $message = "Qualification updated successfully";
                }
                return response()->json(['success' => $message]);
            } catch (Exception $e) {
                return response()->json(['error' => $e->getMessage()]);
            }
        }
    }

    public function deleteQualification(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => ['required', 'numeric'],
        ]);

        if ($validator->fails()) {
            return $validator->errors();
        } else {
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
    }


    public function viewPlaceOfDomicile()
    {
        $data = Employee::where('user_id', Auth::user()->id)->get();
        return view('admin.dashboard.person-profile.place-of-domicile', ['data' => $data[0]]);
    }

    public function postPlaceOfDomicile(Request $request)
    {
        $request->validate([
            'place_of_domicile' => ['required', 'string'],
        ]);
        try {
            if (empty($request->id)) {
                Employee::insertGetId($request->except(['_token', 'id']));
                $message = "Record Created Successfully";
            } else {
                Employee::where('id', $request->id)->update($request->except(['_token', 'id']));
                $message = "Record Updated Successfully";
            }
            return $this->responseJson(
                true,
                200,
                $message
            );
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function viewTrainingDetails()
    {
        $datas = TrainingDetails::where('user_id', Auth::user()->id)->get();
        return view('admin.dashboard.person-profile.training-details',['datas' => $datas]);
    }

    public function postTrainingDetails(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => ['required', 'numeric'],
            'name' => ['required', 'string'],
            'start_date' => ['required', 'date'],
            'grade' => ['required','string'],
            'end_date' => ['required', 'date', 'after:start_date'],
            'skill' => ['required'],
            'description' => ['required','string'],

        ]);

        if ($validator->fails()) {
            return $validator->errors();
        } else {
            try {
                if (empty($request->id)) {
                    $skills = implode(',', $request->input('skill'));
                    TrainingDetails::insertGetId(array_merge($request->except(['_token', 'id', 'skill']), ['skill' => $skills]));
                    $message = "Record Created Successfully";
                } else {
                    TrainingDetails::where('id', $request->id)->update($request->except(['_token', 'user_id', 'id']));
                    $message = "Record Updated Successfully";
                }
                return response()->json(['success' => $message]);
                // Session::put('success', $message);
                // return redirect()->back();
            } catch (Exception $e) {
                return response()->json(['error' => $e->getMessage()]);
            }
        }
    }

    public function deleteTrainingDetails(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => ['required', 'numeric'],
        ]);

        if ($validator->fails()) {
            return $validator->errors();
        } else {
            try {
                $training = TrainingDetails::find($request->id);
                if ($training) {
                    $training->delete();
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

    public function viewUnionDetails()
    {
        $data = Employee::firstWhere('user_id', Auth::user()->id);
        return view('admin.dashboard.person-profile.union-details', ['data' => $data]);
    }

    public function viewPermanentContractual()
    {
        $data = Employee::where('user_id', Auth::user()->id)->get();
        return view('admin.dashboard.person-profile.permanent-contractual', ['data' => $data[0]]);
    }


    public function viewMedicalInsuranceBomaidDetails()
    {
        $data = EmpMedicalInsurance::where('user_id', Auth::user()->id)->first();
        $card = MedicalCart::get();
        // return $data;
        return view('admin.dashboard.person-profile.medical-insurance-bomaid-details', ['data' => $data,'card'=>$card]);
    }

    public function updateMedicalInsuranceBomaidDetails(Request $request)
    {
        $request->validate([
            'company_name' => ['required', 'string'],
            'insurance_id' => ['required', 'numeric'],
            
        ]);
        try {
            if (empty($request->id)) {
                EmpMedicalInsurance::insertGetId($request->except(['_token', 'id']));
                $message = "Record Created Successfully";
            } else {
                EmpMedicalInsurance::where('id', $request->id)->update($request->except(['_token', 'id', 'user_id']));
                $message = "Record Updated Successfully";
            }
            return $this->responseJson(
                true,
                200,
                $message
            );
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function viewDrivingLicenseDetails()
    {
        $data = EmpDrivingLicense::where('user_id', Auth::user()->id)->first();
        return view('admin.dashboard.person-profile.driving-license-details', ['data' => $data]);
    }

    public function updateDrivingLicenseDetails(Request $request)
    {
        $request->validate([
            'license_no' => ['required', 'string'],
        ]);
        try {
            if (empty($request->id)) {
                EmpDrivingLicense::insertGetId($request->except(['_token', 'id']));
                $message = "Record Created Successfully";
            } else {
                EmpDrivingLicense::where('id', $request->id)->update($request->except(['_token', 'id']));
                $message = "Record Updated Successfully";
            }
            return $this->responseJson(
                true,
                200,
                $message
            );
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function viewPreviousEmploymentDetails()
    {
        $designation = Designation::get();
        $datas = EmploymentHistory::where('user_id', Auth::user()->id)->get();
        // dd($designation);
        return view('admin.dashboard.person-profile.previous-employment-details', ['datas' => $datas, 'designation' =>$designation]);
    }

    public function postPreviousEmploymentDetails(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'company_name' => ['required', 'string'],
            'start_date' => ['required', 'date'],
            'reason' => ['required', 'string'],
            'designation_id' => ['required','numeric'],
            'end_date' => ['required', 'date', 'after:start_date', 'before_or_equal:' . now()->format('Y-m-d')],
        ]);

        if ($validator->fails()) {
            return $validator->errors();
        } else {
            try {
                if (empty($request->id)) {
                    EmploymentHistory::insertGetId($request->except(['_token', 'id']));
                    $message = "Record Created Successfully";
                } else {
                    EmploymentHistory::where('id', $request->id)->update($request->except(['_token', 'user_id', 'id']));
                    $message = "Record Updated Successfully";
                }
                return response()->json(['success' => $message]);
                // Session::put('success', $message);
                // return redirect()->back();
            } catch (Exception $e) {
                return response()->json(['error' => $e->getMessage()]);
            }
        }
    }

    public function deletePreviousEmploymentDetails(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => ['required', 'numeric'],
        ]);

        if ($validator->fails()) {
            return $validator->errors();
        } else {
            try {
                $qualification = EmploymentHistory::find($request->id);
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
    }
}
