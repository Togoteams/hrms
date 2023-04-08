<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Designation;
use Illuminate\Http\Request;
use Validator;

class DesignationContoller extends Controller
{
    public $page_name = "Designation";

    public function index()
    {

        return view('admin.designation.index', ['page' => $this->page_name]);
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
            'name' => 'string|max:5',
            'description' => 'string'
        ]);
        if ($validator->fails()) {
            return $validator->errors();
        } else {
            Designation::create($request->except('_token'));
            return response()->json(['success' => $this->page_name . "Added Successfully"]);
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
