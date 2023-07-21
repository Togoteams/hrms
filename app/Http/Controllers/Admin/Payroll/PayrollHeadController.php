<?php

namespace App\Http\Controllers\Admin\Payroll;

use App\Http\Controllers\Controller;
use App\Models\PayrollHead;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Exception;

class PayrollHeadController extends Controller
{
    public $page_name = "Pay Roll Head";

    public function index()
    {
        $data =  PayrollHead::all();
        return view('admin.payroll.payroll_head.index', ['page' => $this->page_name, 'data' => $data]);
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
            'name' => 'string|required|unique:payroll_heads,name',
            'placeholder' => 'string|required',
            'employment_type' => 'string|required',
            'for' => 'string|required',
        ]);
        if ($validator->fails()) {
            return $validator->errors();
        } else {
            $request->request->add(['created_by' => auth()->user()->id]);
            PayrollHead::create($request->except('_token'));
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
        $data = PayrollHead::find($id);
        return view('admin.payroll.payroll_head.edit', ['data' => $data, 'page' => $this->page_name]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'string|required|unique:payroll_heads,name,' . $id,
            'placeholder' => 'string|required',
            'employment_type' => 'string|required',
            'for' => 'string|required',
        ]);
        if ($validator->fails()) {
            return $validator->errors();
        } else {
            $request->request->add(['updated_by' => auth()->user()->id]);
            PayrollHead::where('id', $id)->update($request->except('_token', '_method'));
            return response()->json(['success' => $this->page_name . " Updated Successfully"]);
        }
    }
    public function status($id)
    {
        if (PayrollHead::find($id)->status == "active") {
            PayrollHead::where('id', $id)->update(['status' => 'inactive']);
            return "InActive";
        } else {
            PayrollHead::where('id', $id)->update(['status' => 'active']);
            return "Active";
        }
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            PayrollHead::destroy($id);
            return "Delete";
        } catch (Exception $e) {
            return response()->json(["error" => $this->page_name . "Can't Be Delete this May having some Employee"]);
        }
    }
}
