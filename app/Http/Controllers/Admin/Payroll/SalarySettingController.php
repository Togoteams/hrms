<?php

namespace App\Http\Controllers\Admin\Payroll;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Models\SalarySetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SalarySettingController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public $page_name = "Salary Settings";

    public function index()
    {
        $salarysetting = SalarySetting::first();

        return view('admin.payroll.salarySetting', compact('salarysetting'));

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
            // 'bank_pension_contribution' => 'required|numeric',
            // 'local_bank_bomaid_contribution' => 'required|numeric',
            // 'ibo_bank_bomaid_contribution' => 'required|numeric',
            // 'salary_date' => 'required|numeric',
            'da_per' => 'required'
        ]);
        if ($validator->fails()) {
            return $validator->errors();
        }
        else {
            $data = $request->except('_token');
            $salarysetting = SalarySetting::where('id',1)->update($data);
            return   $this->responseJson(true,200, 'Salary Setting Updated Successfully',$salarysetting);
        // return response()->json(['success' => 'Added Successfully']);

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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
