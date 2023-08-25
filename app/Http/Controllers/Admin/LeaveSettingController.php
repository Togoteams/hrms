<?php

namespace App\Http\Controllers\Admin;

use App\Models\LeaveSetting;
use Illuminate\Http\Request;
// use Dotenv\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class LeaveSettingController extends Controller
{
    public $page_name = "Leave Settings";
    public function index()
    {
        $all_leaves =  LeaveSetting::orderByDesc('id')->get();
        return view('admin.leave_setting.index', ['page' => $this->page_name, 'data' => $all_leaves]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'                      => 'required',
            'emp_type'                  => 'required',
            'total_leave_year'          => 'required',
            'max_leave_at_time'         => 'required',
            'is_accumulated'            => 'required',
            'is_accumulated_max_value'  => 'required',
            'is_pro_data'               => 'required',
            'starting_date'             => 'required',
            'is_count_holyday'          => 'required',
            'is_leave_encash'           => 'required',
            'is_certificate'            => 'required|boolean'
        ]);
        if($validator->fails()){ 
            $error = ['error'=>$validator->errors()->all()];
            return response()->json(['status'=>false, 'message'=>$validator->errors()->first()], 422);
        }
        try {
            $add = LeaveSetting::create([
                'name'                      => $request->name,
                'emp_type'                  => $request->emp_type,
                'total_leave_year'          => $request->total_leave_year,
                'max_leave_at_time'         => $request->max_leave_at_time,
                'is_accumulated'            => $request->is_accumulated,
                'is_accumulated_max_value'  => $request->is_accumulated_max_value,
                'is_pro_data'               => $request->is_pro_data,
                'starting_date'             => $request->starting_date,
                'is_count_holyday'          => $request->is_count_holyday,
                'is_leave_encash'           => $request->is_leave_encash,
                'is_certificate'            => $request->is_certificate
            ]);
            if($add){
                return response()->json(['status'=>true, 'message'=>'leave setting add successfully'], 200);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => 'Something went wrong',
                'data' => []
            ]);
        }
    }

    public function edit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id'                        => 'required',
            'name'                      => 'required',
            'emp_type'                  => 'required',
            'total_leave_year'          => 'required',
            'max_leave_at_time'         => 'required',
            'is_accumulated'            => 'required',
            'is_accumulated_max_value'  => 'required',
            'is_pro_data'               => 'required',
            'starting_date'             => 'required',
            'is_count_holyday'          => 'required',
            'is_leave_encash'           => 'required',
            'is_certificate'            => 'required|boolean'
        ]);
        if($validator->fails()){ 
            $error = ['error'=>$validator->errors()->all()];
            return response()->json(['status'=>false, 'message'=>$validator->errors()->first()], 422);
        }
        try {
            $add = LeaveSetting::where('id', $request->id)->update([
                'name'                      => $request->name,
                'emp_type'                  => $request->emp_type,
                'total_leave_year'          => $request->total_leave_year,
                'max_leave_at_time'         => $request->max_leave_at_time,
                'is_accumulated'            => $request->is_accumulated,
                'is_accumulated_max_value'  => $request->is_accumulated_max_value,
                'is_pro_data'               => $request->is_pro_data,
                'starting_date'             => $request->starting_date,
                'is_count_holyday'          => $request->is_count_holyday,
                'is_leave_encash'           => $request->is_leave_encash,
                'is_certificate'            => $request->is_certificate
            ]);
            if($add){
                return response()->json(['status'=>true, 'message'=>'leave setting update successfully'], 200);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => 'Something went wrong',
                'data' => []
            ]);
        }
    }

    public function delete(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required'
        ]);
        if($validator->fails()){ 
            $error = ['error'=>$validator->errors()->all()];
            return response()->json(['status'=>false, 'message'=>$validator->errors()->first()], 422);
        }
        try {
            $delete = LeaveSetting::where('id', $request->id)->delete();
            if($delete){
                return response()->json(['status'=>true, 'message'=>'leave setting deleted successfully'], 200);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => 'Something went wrong',
                'data' => []
            ]);
        }
    }
}
