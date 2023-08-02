<?php

namespace App\Http\Controllers;

use App\Models\PayrollSalaryIncrement;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class SalaryIncrementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public $page_name = "Salary Increment Settings";
    public function index()
    {
        $data =  PayrollSalaryIncrement::all();
        return view('admin.payroll.salary_increment_setting.index', ['page' => $this->page_name, 'data' => $data]);
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
            'increment_percentage' => 'numeric|required',
            'employment_type' => 'required|string',
            'effective_from' => 'required|date',
            'effective_to' => 'required|date|after:effective_from',
            'financial_year' => 'required|numeric'
        ]);
        if ($validator->fails()) {
            return $validator->errors();
        } else {
            $request->request->add(['created_by'=>Auth::user()->id]);
            PayrollSalaryIncrement::create($request->except('_token'));
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
        $data = PayrollSalaryIncrement::find($id);
        return view('admin.payroll.salary_increment_setting.edit', ['data' => $data, 'page' => $this->page_name]);    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
    
        $validator = Validator::make($request->all(), [
            'increment_percentage' => 'numeric|required',
            'employment_type' => 'required|string',
            'effective_from' => 'required|date',
            'effective_to' => 'required|date|after:effective_from',
            'financial_year' => 'required|numeric'
        ]);
        if ($validator->fails()) {
            return $validator->errors();
        } else {
            $request->request->add(['updated_by'=>Auth::user()->id]);
            PayrollSalaryIncrement::where('id', $id)->update($request->except('_token', '_method'));
            return response()->json(['success' => $this->page_name . " Updated Successfully"]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        
        try {
            PayrollSalaryIncrement::destroy($id);
            return "Delete";
        } catch (Exception $e) {
            return response()->json(["error" => $this->page_name . "Can't Be Delete this May having some Employee"]);
        }
    }
}
