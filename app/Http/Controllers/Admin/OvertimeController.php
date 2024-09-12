<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\OvertimeSetting;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use OCILob;
use Yajra\DataTables\Facades\DataTables;

class OvertimeController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public $page_name = "Overtime";

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = OvertimeSetting::with('user')->select('*');
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn = view('admin.overtime_settings.buttons', ['item' => $row, "route" => 'overtime-settings']);
                    return $actionBtn;
                })
                ->editColumn('date', function ($data) {
                    return \Carbon\Carbon::parse($data->date)->isoFormat('DD.MM.YYYY');
                })
                ->rawColumns(['action'])
                ->make(true);
            }

        // $data = OvertimeSetting::all();
        $all_users = Employee::with('user')->where('employment_type','local')->getActiveEmp()->getList()->get();
        // dd($all_users);
        return view('admin.overtime_settings.index', ['page' => $this->page_name,'all_users' => $all_users]);

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
        
        $request->validate( [
            'user_id' => 'required|numeric',
            'date' => 'required|date|before_or_equal:today',
            'working_hours' => 'required|numeric|gt:0',
            'overtime_type' => 'required|string',
        ]);

        // if ($validator->fails()) {
        //     return $validator->errors();
        // } else {
            try {
                //request user_id
                $userId = $request->user_id;

                // Check for overlap with existing entries
                $overlapDate = OvertimeSetting::where('user_id', $userId)
                ->where('date', $request->date)
                ->exists();
                if ($overlapDate) {
                       return $this->responseJson(false,200, 'Overlap with an existing record.');
                }

                //employee details based on the user_id
                $employee = Employee::where('user_id', $userId)->first();
                if ($employee) {
                    $request->merge([
                        'status' => "active",
                        'branch_id' => $employee->branch_id,
                        'created_by' => auth()->user()->id,
                    ]);

                    OvertimeSetting::create($request->except('_token'));

                    return $this->responseJson(true,200,$this->page_name . " Added Successfully");
                } else {
                     return $this->responseJson(false,200, 'Employee not found for the given user_id');
                }
            } catch (Exception $e) {
                 return $this->responseJson(false,200, $e->getMessage());
            }
        // }
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
        $item = OvertimeSetting::find($id);
        $all_users = Employee::with('user')->where('employment_type','local')->getList()->getActiveEmp()->get();
        return view('admin.overtime_settings.edit', ['item'=>$item,'all_users'=>$all_users,'page' => $this->page_name]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|numeric',
            'date' => 'required|date|before_or_equal:today',
            'working_hours' => 'required|numeric|gt:0',
            'overtime_type' => 'required|string',
        ]);

        if ($validator->fails()) {
            return $validator->errors();
        } else {
            try {
                // request user_id
                $userId = $request->user_id;
                // Check for overlap with existing entries
                $overlapExists = OvertimeSetting::where('user_id', $userId)
                ->where('date', $request->date)
                ->where('id', '!=', $id)
                ->exists();

                if ($overlapExists) {
                    return response()->json(['error' => 'Overlap with an existing record.']);
                }
                //employee details based on the user_id
                $employee = Employee::where('user_id', $userId)->first();

                if ($employee) {
                    $request->merge([
                        'updated_by' => auth()->user()->id,
                    ]);

                    OvertimeSetting::where('id', $id)->update($request->except('_token', '_method'));

                    return response()->json(['success' => $this->page_name . " Updated Successfully"]);
                } else {
                    return response()->json(['error' => 'Employee not found for the given user_id']);
                }
            } catch (Exception $e) {
                return response()->json(['error' => $e->getMessage()]);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            OvertimeSetting::destroy($id);
            return "Delete";
        } catch (Exception $e) {
            return response()->json(["error" => $this->page_name . "Can't Be Delete this May having some Employee"]);
        }
    }
}
