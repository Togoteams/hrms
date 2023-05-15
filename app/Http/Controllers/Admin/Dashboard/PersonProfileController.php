<?php

namespace App\Http\Controllers\Admin\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Qualification;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PersonProfileController extends Controller
{
    public function viewQualifications()
    {
        $datas = Qualification::where('user_id', Auth::user()->id)->get();
        // return $datas;
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
                Qualification::insertGetId($request->except(['_token','id']));
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
}
