<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Models\Designation;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DesignationContoller extends BaseController
{
    public $page_name = "Designation";

    public function index()
    {
        $data =  Designation::all();
        return view('admin.designation.index', ['page' => $this->page_name, 'data' => $data]);
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
        $validator = Validator::make(
            $request->all(),
            [
                'name' => ['string', 'required', 'unique:designations,name', 'regex:/^[^\d]*$/'],
                'description' => 'string|required'
            ],
            [
                'name.string' => 'field Must Be A String.',
                'description.string' => 'field Must Be A String.',
                'name.regex' => 'field must not contain numeric values.'
            ]
        );
        if ($validator->fails()) {
            return $validator->errors();
        } else {
            // $request->merge('slug'=>"")
            Designation::create($request->except('_token'));
            return response()->json(['success' => $this->page_name . " Added Successfully"]);

            // return   $this->responseJson(true,200,$this->page_name . " Added Successfully","");

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
        $data = Designation::find($id);
        return view('admin.designation.edit', ['data' => $data, 'page' => $this->page_name]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'string|required|unique:designations,name,' . $id,
            'description' => 'string|required'
        ]);
        if ($validator->fails()) {
            return $validator->errors();
        } else {
            Designation::where('id', $id)->update($request->except('_token', '_method'));
            return response()->json(['success' => $this->page_name . " Updated Successfully"]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            Designation::destroy($id);
            return "Delete";
        } catch (Exception $e) {
            return response()->json(["error" => $this->page_name . "Can't Be Delete this May having some Employee"]);
        }
    }
}
