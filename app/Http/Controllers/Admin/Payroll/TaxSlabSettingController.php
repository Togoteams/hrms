<?php

namespace App\Http\Controllers\Admin\Payroll;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TaxSlabSetting;
use Illuminate\Support\Facades\Validator;
use Exception;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class TaxSlabSettingController extends Controller
{
    public $page_name = "Tax Slab Setting";

    public function index(Request $request)
    {
        // if ($request->ajax()) {
        //     $data = TaxSlabSetting::all();
        //     return DataTables::of($data)
        //         ->addIndexColumn()
        //         ->addColumn('action', function ($row) {
        //             $actionBtn = view('admin.payroll.taxs_slab_setting.buttons', ['item' => $row, "route" => 'payroll.taxs_slab_setting']);
        //             return $actionBtn;
        //         })
        //         ->rawColumns(['action'])
        //         ->make(true);
        //     }
         $data =  TaxSlabSetting::all();
        return view('admin.payroll.taxs_slab_setting.index', ['page' => $this->page_name,'data' => $data]);
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
            'from' => 'numeric|required|unique:taxes,name',
            'to' => 'required|numeric',
            'additional_local_amount' => 'required|numeric',
            'local_tax_per' => 'required|numeric',
            'ibo_tax_per' => 'required|numeric',
            'additional_ibo_amount' => 'required|numeric',
            'description' => 'string|required'
        ]);
        if ($validator->fails()) {
            return $validator->errors();
        } else {
            $request->request->add(['created_by'=>Auth::user()->id]);
            TaxSlabSetting::create($request->except('_token'));
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
        $data = TaxSlabSetting::find($id);
        return view('admin.payroll.taxs_slab_setting.edit', ['data' => $data, 'page' => $this->page_name]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'from' => 'numeric|required|unique:taxes,name',
            'to' => 'required|numeric',
            'additional_local_amount' => 'required|numeric',
            'local_tax_per' => 'required|numeric',
            'ibo_tax_per' => 'required|numeric',
            'additional_ibo_amount' => 'required|numeric',
            'description' => 'string|required'
        ]);
        if ($validator->fails()) {
            return $validator->errors();
        } else {
            $request->request->add(['updated_by'=>Auth::user()->id]);
            TaxSlabSetting::where('id', $id)->update($request->except('_token', '_method'));
            return response()->json(['success' => $this->page_name . " Updated Successfully"]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            TaxSlabSetting::destroy($id);
            return "Delete";
        } catch (Exception $e) {
            return response()->json(["error" => $this->page_name . "Can't Be Delete this May having some Employee"]);
        }
    }
}
