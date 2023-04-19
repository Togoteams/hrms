<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LeaveType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Exception;

class LeaveTypeCobntroller extends Controller
{
    public $page_name = "LeaveType";

    public function index()
    {
        $data =  LeaveType::all();
        return view('admin.leave_type.index', ['page' => $this->page_name, 'data' => $data]);
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
            'name' => 'string|required|unique:leave_types,name',
            'description' => 'string|required'
        ]);
        if ($validator->fails()) {
            return $validator->errors();
        } else {
            LeaveType::create($request->except('_token'));
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
        $data = LeaveType::find($id);
        return view('admin.leave_type.ediit', ['data' => $data, 'page' => $this->page_name]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'string|required|unique:leave_types,name,' . $id,
            'description' => 'string|required'
        ]);
        if ($validator->fails()) {
            return $validator->errors();
        } else {
            LeaveType::where('id', $id)->update($request->except('_token', '_method'));
            return response()->json(['success' => $this->page_name . " Updated Successfully"]);
        }
    }

    public function status($id)
    {
        if (LeaveType::find($id)->status == "active") {
            LeaveType::where('id', $id)->update(['status' => 'inactive']);
            return "InActive";
        } else {
            LeaveType::where('id', $id)->update(['status' => 'active']);
            return "Active";
        }
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            LeaveType::destroy($id);
            return "Delete";
        } catch (Exception $e) {
            return response()->json(["error" => $this->page_name . "Can't Be Delete this May having some Employee"]);
        }
    }
}
