<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Branch;
use Illuminate\Support\Facades\Validator;
use Exception;

class BranchController extends Controller
{
    public $page_name = "Branch";

    public function index()
    {
        $data =  Branch::all();
        return view('admin.branch.index', ['page' => $this->page_name, 'data' => $data]);
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
            'name' => 'string|required',
            'description' => 'string|required'
        ]);
        if ($validator->fails()) {
            return $validator->errors();
        } else {
            Branch::create($request->except('_token'));
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
        $data = Branch::find($id);
        return view('admin.branch.ediit', ['data' => $data, 'page' => $this->page_name]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'string|required',
            'description' => 'string|required'
        ]);
        if ($validator->fails()) {
            return $validator->errors();
        } else {
            Branch::where('id', $id)->update($request->except('_token', '_method'));
            return response()->json(['success' => $this->page_name . " Updated Successfully"]);
        }
    }

    public function status($id)
    {
        if (Branch::find($id)->status == "active") {
            Branch::where('id', $id)->update(['status' => 'inactive']);
            return "InActive";
        } else {
            Branch::where('id', $id)->update(['status' => 'active']);
            return "Active";
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            Branch::destroy($id);
            return "Delete";
        } catch (Exception $e) {
            return response()->json(["error" => $this->page_name . "Can't Be Delete this May having some Employee"]);
        }
    }
}
