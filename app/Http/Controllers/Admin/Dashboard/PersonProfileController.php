<?php

namespace App\Http\Controllers\Admin\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\EmpDrivingLicense;
use App\Models\Employee;
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
                    Session::put('success', $message);
                    return redirect()->back();
                } else {
                    return response()->json(['error' => 'Qualification not found']);
                }
            } catch (Exception $e) {
                return response()->json(['error' => $e->getMessage()]);
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
        $validator = Validator::make($request->all(), [
            'place_of_domicile' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return $validator->errors();
        } else {
            try {
                if (empty($request->id)) {
                    Employee::insertGetId($request->except(['_token', 'id']));
                    $message = "Record Created Successfully";
                } else {
                    Employee::where('id', $request->id)->update($request->except(['_token', 'id']));
                }
                $message = "Record Updated Successfully";
                Session::put('success', $message);
                return redirect()->back();
            } catch (Exception $e) {
                return response()->json(['error' => $e->getMessage()]);
            }
        }
    }

    public function viewTrainingDetails()
    {
        // $datas = Qualification::where('user_id', Auth::user()->id)->get();
        return view('admin.dashboard.person-profile.training-details');
    }

    public function viewUnionDetails()
    {
        $data = Employee::where('user_id', Auth::user()->id)->get();
        return view('admin.dashboard.person-profile.union-details', ['data' => $data[0]]);
    }

    public function viewPermanentContractual()
    {
        $data = Employee::where('user_id', Auth::user()->id)->get();
        return view('admin.dashboard.person-profile.permanent-contractual', ['data' => $data[0]]);
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
                if (empty($request->id)) {
                    EmpMedicalInsurance::insertGetId($request->except(['_token', 'id']));
                    $message = "Record Created Successfully";
                } else {
                    EmpMedicalInsurance::where('id', $request->id)->update($request->except(['_token', 'id', 'user_id']));
                    $message = "Record Updated Successfully";
                }
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
        return view('admin.dashboard.person-profile.driving-license-details', ['data' => $data]);
    }

    public function updateDrivingLicenseDetails(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'license_no' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return $validator->errors();
        } else {
            try {
                if (empty($request->id)) {
                    EmpDrivingLicense::insertGetId($request->except(['_token', 'id']));
                    $message = "Record Created Successfully";
                } else {
                    EmpDrivingLicense::where('id', $request->id)->update($request->except(['_token', 'id']));
                }
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
        return view('admin.dashboard.person-profile.previous-employment-details', ['datas' => $datas]);
    }

    public function postPreviousEmploymentDetails(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'company_name' => ['required', 'string'],
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date'],
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
                    Session::put('success', $message);
                    return redirect()->back();
                } else {
                    return response()->json(['error' => 'Qualification not found']);
                }
            } catch (Exception $e) {
                return response()->json(['error' => $e->getMessage()]);
            }
        }
    }
}
