<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KraAttributes;
use Illuminate\Support\Facades\Validator;
use Exception;
class KraAttributesController extends Controller
{
    public $page_name = "Kra Attributes";

    public function index()
    {
        $data =  KraAttributes::all();
        return view('admin.kra_attributes.index', ['page' => $this->page_name, 'data' => $data]);
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
            'description' => 'string|required',
            'max_marks'=>'required|numeric'
        ]);
        if ($validator->fails()) {
            return $validator->errors();
        } else {
            KraAttributes::create($request->except('_token'));
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
        $data = KraAttributes::find($id);
        return view('admin.kra_attributes.edit', ['data' => $data, 'page' => $this->page_name]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'string|required',
            'description' => 'string|required',
            'max_marks'=>'required|numeric'
        ]);
        if ($validator->fails()) {
            return $validator->errors();
        } else {
            KraAttributes::where('id', $id)->update($request->except('_token', '_method'));
            return response()->json(['success' => $this->page_name . " Updated Successfully"]);
        }
    }

    public function status($id)
    {
        if (KraAttributes::find($id)->status == "active") {
            KraAttributes::where('id', $id)->update(['status' => 'inactive']);
            return "InActive";
        } else {
            KraAttributes::where('id', $id)->update(['status' => 'active']);
            return "Active";
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            KraAttributes::destroy($id);
            return "Delete";
        } catch (Exception $e) {
            return response()->json(["error" => $this->page_name . "Can't Be Delete this May having some Employee"]);
        }
    }
}
