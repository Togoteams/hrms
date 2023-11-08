<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Country;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public $page_name = "country";

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Country::all();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn = view('admin.country.buttons', ['item' => $row, "route" => 'country']);
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
            }
        return view('admin.country.index', ['page' => $this->page_name]);

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
            'name' => 'required|string|unique:countries,name',
            'std_code' => 'required|string',
            'description' => 'nullable|string',
        ]);
        if ($validator->fails()) {
            return $validator->errors();
        } else {
            $request->request->add(['status' =>"active"]);
            Country::create($request->except('_token'));
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
        $country = Country::find($id);
        return view('admin.country.edit', ['country' => $country, 'page' => $this->page_name]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'std_code' => 'required|string',
            'description' => 'nullable|string',
        ]);
        if ($validator->fails()) {
            return $validator->errors();
        } else {
            Country::where('id', $id)->update($request->except('_token', '_method'));
            return response()->json(['success' => $this->page_name . " Updated Successfully"]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            Country::destroy($id);
            return "Delete";
        } catch (Exception $e) {
            return response()->json(["error" => $this->page_name . "Can't Be Delete this May having some Employee"]);
        }
    }
}
