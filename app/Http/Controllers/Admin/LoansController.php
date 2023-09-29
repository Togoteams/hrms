<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Loans;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Exception;
use Illuminate\Support\Facades\Auth;

class LoansController extends Controller
{
    public $page_name = "Loans Type";

    public function index()
    {
        $data =  Loans::all();
        return view('admin.loans.index', ['page' => $this->page_name, 'data' => $data]);
    }


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
            'name' => 'string|required|unique:loans,name',
            // 'start_amount' => 'required|numeric|gt:0',
            // 'end_amount' => 'required|numeric|gt:0',
            // 'late_fine_amount' => 'required|numeric|gt:0',
            // 'late_fine_amount_type' => 'required|string|gt:0',
            // 'no_min_installment' => 'required|numeric',
            // 'no_max_installment' => 'required|numeric',
            // 'max_installment_amount' => 'required|numeric',
            // 'min_installment_amount' => 'required|numeric',
            // 'rate_of_interest' => 'required|numeric',
            'description' => 'string|required',
        ]);
        if ($validator->fails()) {
            return $validator->errors();
        } else {
            $request->request->add(['created_by' => Auth::user()->id]);
            Loans::insert($request->except('_token'));
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
        $data = Loans::find($id);
        return view('admin.loans.ediit', ['data' => $data, 'page' => $this->page_name]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'string|required|unique:designations,name,' . $id,
            // 'start_amount' => 'required|numeric|gt:0',
            // 'end_amount' => 'required|numeric|gt:0',
            // 'late_fine_amount' => 'required|numeric|gt:0',
            // 'late_fine_amount_type' => 'required|string|gt:0',
            // 'no_min_installment' => 'required|numeric|gt:0',
            // 'no_max_installment' => 'required|numeric|gt:0|gte:no_min_installment',
            // 'max_installment_amount' => 'required|numeric|gt:0|gte:min_installment_amount',
            // 'min_installment_amount' => 'required|numeric|gt:0',
            // 'rate_of_interest' => 'required|numeric',
            'description' => 'string|required',
        ]);
        if ($validator->fails()) {
            return $validator->errors();
        } else {
            Loans::where('id', $id)->update($request->except('_token', '_method'));
            return response()->json(['success' => $this->page_name . " Updated Successfully"]);
        }
    }
    public function status($id)
    {
        if (Loans::find($id)->status == "active") {
            Loans::where('id', $id)->update(['status' => 'inactive']);
            return "InActive";
        } else {
            Loans::where('id', $id)->update(['status' => 'active']);
            return "Active";
        }
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            Loans::destroy($id);
            return "Delete";
        } catch (Exception $e) {
            return response()->json(["error" => $this->page_name . "Can't Be Delete this May having some Employee"]);
        }
    }
}
