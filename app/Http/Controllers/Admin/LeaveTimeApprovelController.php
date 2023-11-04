<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\LeaveSetting;
use App\Models\LeaveTimeApprovel;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class LeaveTimeApprovelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public $page_name = "Leave Type Approval";

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
            'approval_date' => 'required|date',
            'description' => 'nullable|string', 
        ]);
        if ($validator->fails()) {
            return $validator->errors();
        } else {
            $request->request->add(['status' =>"active"]);
            LeaveTimeApprovel::create($request->except('_token'));
            return response()->json(['success' => $this->page_name . " Added Successfully"]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
            'approval_date' => 'required|date',
            'description' => 'nullable|string', 
        ]);
        if ($validator->fails()) {
            return $validator->errors();
        } else {
            LeaveTimeApprovel::where('id', $id)->update($request->except('_token', '_method'));
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
}
