<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Designation;
use App\Models\Employee;
use App\Models\EmployeeTransfer;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class EmployeeTransferControler extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public $page_name = "Employees Transfer ";

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = EmployeeTransfer::with('user','department','branch')->select('*');
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn = view('admin.employees_transfer.buttons', ['item' => $row, "route" => 'employee-transfer']);
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
            }
        $all_users = Employee::get();
        $department = Designation::get();
        $branch = Branch::get();
        // dd($all_users);
        return view('admin.employees_transfer.index', ['page' => $this->page_name, 'all_users'=>$all_users,'department'=>$department,'branch'=>$branch]);

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
        // dd($request->input());
        $transfer_type = $request->transfer_type;
        if($transfer_type == 'department'){
            $validator = Validator::make($request->all(), [
                'emp_id' => 'required|numeric',
                'department_id' => 'required|numeric',
                'branch_id' => 'nullable|numeric',
                'transfer_type' => 'required|string',
                'transfer_reason' => 'required|string',

            ]);
      
        }else{
            $validator = Validator::make($request->all(), [
                'emp_id' =>'required|numeric',
                'branch_id' =>'nullable|numeric',
                'transfer_type' =>'required|string',
                'transfer_reason' =>'required|string',
                'department_id' => 'required|numeric',
            ]);
        }

        if ($validator->fails()) {
            return $validator->errors();
        } else {
            try {
                $request->request->add(['created_at' => date('Y-m-d h:i:s'),
                'transfer_request_at' => date('Y-m-d h:i:s')]);
                $request->request->add(['status' =>"pending"]);
                EmployeeTransfer::insertGetId($request->except(['_token', '_method']));
                return response()->json(['success' => $this->page_name . " Added Successfully"]);
            } catch (Exception $e) {

                return response()->json(['error' => $e->getMessage()]);
            }
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
        $item = EmployeeTransfer::find($id);
        $all_users = Employee::get();
        $department = Designation::get();
        $branch = Branch::get();       
        return view('admin.employees_transfer.edit', ['item'=>$item,'all_users'=>$all_users,'department'=>$department,'branch'=>$branch, 'page' => $this->page_name]);    
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $transfer_type = $request->transfer_type;
        if($transfer_type == 'department'){
            $validator = Validator::make($request->all(), [
                'emp_id' => 'required|numeric',
                'department_id' => 'required|numeric',
                'branch_id' => 'nullable|numeric',
                'transfer_type' => 'required|string',
                'transfer_reason' => 'required|string',

            ]);
      
        }else{
            $validator = Validator::make($request->all(), [
                'emp_id' =>'required|numeric',
                'branch_id' =>'nullable|numeric',
                'transfer_type' =>'required|string',
                'transfer_reason' =>'required|string',
                'department_id' => 'required|numeric',
            ]);
        }

        if ($validator->fails()) {
            return $validator->errors();
        } else {
            EmployeeTransfer::where('id', $id)->update($request->except('_token', '_method'));
            return response()->json(['success' => $this->page_name . " Updated Successfully"]);
        }
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            EmployeeTransfer::destroy($id);
            return "Delete";
        } catch (Exception $e) {
            return response()->json(["error" => $this->page_name . "Can't Be Delete this May having some Employee"]);
        }
    }

    public function status(Request $request)
    {   
        // dd($request->all());
        $request->validate([
            'status' => ['required','string'],
        ]);
        $data = EmployeeTransfer::find($request->emp_id);
        $data->status = $request['status'];
        if($request->status=='approved')
        {
           $data->approved_at=date('Y-m-d h:i:s');
        }
        if($request->status=='rejected')
        {
           $data->rejected_at=date('Y-m-d h:i:s');
        }
        $data->save();
        return $this->responseJson(true,200,'status created successfully',$data);

    }
}
