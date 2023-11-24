<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\LeaveSetting;
use App\Models\LeaveApply;
use App\Models\LeaveTimeApprovel;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
class LeaveTimeApprovelController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public $page_name = "Maternity leave Request";

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = LeaveTimeApprovel::with('leaveSetting','user')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn = view('admin.leave_time_approvel.buttons', ['item' => $row, "route" => 'leave_time_approved']);
                    return $actionBtn;
                })
                ->editColumn('request_date', function ($data) {
                    return \Carbon\Carbon::parse($data->request_date)->isoFormat('DD.MM.YYYY');
                })
                ->editColumn('start_date', function ($data) {
                    return \Carbon\Carbon::parse($data->start_date)->isoFormat('DD.MM.YYYY');
                })
                ->editColumn('end_date', function ($data) {
                    return \Carbon\Carbon::parse($data->end_date)->isoFormat('DD.MM.YYYY');
                })
                ->rawColumns(['action'])
                ->make(true);
            }
        $Employees = Employee::whereHas('user', function ($query) {
            $query->where('gender', 'female');
        })->get();
        $maternityLeaveTypes = LeaveSetting::where('name', 'MATERNITY LEAVE')->get();
        return view('admin.leave_time_approvel.index', ['page' => $this->page_name, 'leave_setting' => $maternityLeaveTypes,'Employees'=> $Employees]);

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
            'user_id' => 'required|numeric',
            'leave_type_id' => 'required|numeric',
            'request_date' => 'required|date',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'reason' => 'required|string',
            'document' => 'required|file|mimes:jpeg,jpg,png,pdf',
            'description' => 'nullable|string',
        ]);
        if ($validator->fails()) {
            return $validator->errors();
        } else {

            $leaveData = $request->except('_token');

            if ($request->hasFile('document')) {
                $file = $request->file('document');
                $extension = $file->getClientOriginalExtension();
                $filename = $file->getClientOriginalName();
                $file->move('assets/leave_document', $filename);
                $leaveData['document'] = $filename;
            }
         


            $request->request->add(['status' =>"pending"]);
            LeaveTimeApprovel::create($leaveData);
            return response()->json(['success' => $this->page_name . " Added Successfully"]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $Employees = Employee::whereHas('user', function ($query) {
            $query->where('gender', 'female');
        })->get();
        $maternityLeaveTypes = LeaveSetting::where('name', 'MATERNITY LEAVE')->get();
        $data = LeaveTimeApprovel::find($id);
        return view('admin.leave_time_approvel.show', ['data' => $data,'leave_setting' => $maternityLeaveTypes,'Employees'=> $Employees, 'page' => $this->page_name]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $Employees = Employee::whereHas('user', function ($query) {
            $query->where('gender', 'female');
        })->get();
        $maternityLeaveTypes = LeaveSetting::where('name', 'MATERNITY LEAVE')->get();
        $leave = LeaveTimeApprovel::find($id);
        return view('admin.leave_time_approvel.edit', ['leave' => $leave,'leave_setting' => $maternityLeaveTypes,'Employees'=> $Employees, 'page' => $this->page_name]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|numeric',
            'leave_type_id' => 'required|numeric',
            'request_date' => 'nullable|date',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'reason' => 'required|string',
            'document' => 'nullable|file|mimes:jpeg,jpg,png,pdf',
            'description' => 'nullable|string',
        ]);
        if ($validator->fails()) {
            return $validator->errors();
        } else {
            $leaveData = $request->except('_token', '_method');

            if ($request->hasFile('document')) {
                $file = $request->file('document');
                $extension = $file->getClientOriginalExtension();
                $filename = $file->getClientOriginalName();
                $file->move('assets/leave_document', $filename);
                $leaveData['document'] = $filename;
            }
            LeaveTimeApprovel::where('id', $id)->update($leaveData);
            return response()->json(['success' => $this->page_name . " Updated Successfully"]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            LeaveTimeApprovel::destroy($id);
            return "Delete";
        } catch (Exception $e) {
            return response()->json(["error" => $this->page_name . "Can't Be Delete this May having some Employee"]);
        }
    }


    public function status(Request $request)
    {
      
        $request->validate([
            'status' => ['required','string'],
            'description_reason' => ['nullable','string'],
        ]);
        $leave = LeaveTimeApprovel::find($request->leave_id);
       
        $leave->description_reason = $request['description_reason'];
        $leave->status = $request['status'];
        if($request->status=='approved')
        {   
            $request->merge(['leave_type_id'=>$leave->leave_type_id,'start_date'=>$leave->start_date,'end_date'=>$leave->end_date,'user_id'=>$leave->user_id]);

            $leave->approved_at = date('Y-m-d h:i:s');
            $leaveType = LeaveSetting::find($request->leave_type_id);
            $leaveSlug = $leaveType->slug;

           Validator::extend('no_date_overlap', function ($attribute, $value, $parameters, $validator) {
               $start_date = $validator->getData()['start_date'];
               $end_date = $validator->getData()['end_date'];
               $userId = $validator->getData()['user_id'] ?? "";
               $overlappingRecord =true;
               
               $overlappingRecord = LeaveApply::where(function ($query) use ($start_date, $end_date) {
                   $query->where(function ($q1) use ($start_date, $end_date) {
                       $q1->whereBetween('start_date', array($start_date, $end_date));
                   })
                   ->orWhere(function ($q2) use ($start_date, $end_date) {
                       $q2->where('start_date', '<=', $start_date)
                       ->where('end_date', '>=', $end_date);
                   })
                   ->orWhere(function ($q3) use ($start_date, $end_date) {
                       $q3->whereBetween('end_date', array($start_date, $end_date));
                   });
               })->where('user_id',$userId)->first();
               return !$overlappingRecord;
           });
   
           Validator::replacer('no_date_overlap', function ($message, $attribute, $rule, $parameters) {
               $value = Str::headline(Str::camel($attribute));
               return "The $value date range overlaps with an existing record.";
           });
           $request->validate([
               'leave_type_id' => ['required', 'numeric', 'exists:leave_types,id'],
               'start_date' => ['required', 'date','after_or_equal:'.date('Y-m-d'),'no_date_overlap','after:today'],
               'end_date' => ['required', 'date', 'after_or_equal:'.date('Y-m-d'),'no_date_overlap'],
               "doc1" => ["mimetypes:application/pdf", "max:10000",'nullable'],
               'remaining_leave' =>['required','numeric', Rule::when($leaveSlug != ('leave-without-pay' || 'bereavement-leave' || 'maternity-leave') , 'min:1','nullable')]
           ]);
           return app('App\Http\Controllers\Admin\LeaveApplyController')->store($request);
        }
        if($request->status=='rejected')
        {
           $leave->rejected_at=date('Y-m-d h:i:s');
        }
        $leave->save();
        // return $this->responseJson(true,200,'status created successfully',$leave);
        // return response()->json(['success' => $this->page_name . " status created successfully"]);
        return redirect()->back()->with('success', $this->page_name . ' status created successfully');


    }

}
