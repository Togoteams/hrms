<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Tax;
use Illuminate\Support\Facades\Auth;
class TaxController extends Controller
{
    public $page_name = "Tax";

    public function index()
    {
        $data =  Tax::all();
        return view('admin.tax.index', ['page' => $this->page_name, 'data' => $data]);
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
            'name' => 'string|required|unique:taxes,name',
            'type' => 'required|string',
            'value' => 'required|numeric',
            'description' => 'string|required'
        ]);
        if ($validator->fails()) {
            return $validator->errors();
        } else {
            $request->request->add(['created_by'=>Auth::user()->id]);
            Tax::create($request->except('_token'));
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
        $data = Tax::find($id);
        return view('admin.tax.edit', ['data' => $data, 'page' => $this->page_name]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'string|required|unique:taxes,name,' . $id,
            'type' => 'required|string',
            'value' => 'required|numeric',
            'description' => 'string|required'
        ]);
        if ($validator->fails()) {
            return $validator->errors();
        } else {
            $request->request->add(['updated_by'=>Auth::user()->id]);
            Tax::where('id', $id)->update($request->except('_token', '_method'));
            return response()->json(['success' => $this->page_name . " Updated Successfully"]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            Tax::destroy($id);
            return "Delete";
        } catch (Exception $e) {
            return response()->json(["error" => $this->page_name . "Can't Be Delete this May having some Employee"]);
        }
    }
}
