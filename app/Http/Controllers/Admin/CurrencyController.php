<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CurrencySetting;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class CurrencyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public $page_name = "Currency Settings";

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = CurrencySetting::all();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn = view('admin.currency_settings.buttons', ['item' => $row, "route" => 'currency_settings']);
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
            }
        return view('admin.currency_settings.index', ['page' => $this->page_name]);

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
            'currency_name_from' => 'required|string',
            'currency_amount_from' => 'required|numeric',
            'currency_name_to' => 'required|string',
            'currency_amount_to' => 'required|numeric',
           
        ]);
        if ($validator->fails()) {
            return $validator->errors();
        } else {
            CurrencySetting::create($request->except('_token'));
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
        $currency = CurrencySetting::find($id);
        return view('admin.currency_settings.edit', ['currency' => $currency, 'page' => $this->page_name]);   
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'currency_name_from' => 'required|string',
            'currency_amount_from' => 'required|numeric',
            'currency_name_to' => 'required|string',
            'currency_amount_to' => 'required|numeric',      
        ]);
        if ($validator->fails()) {
            return $validator->errors();
        } else {
            CurrencySetting::where('id', $id)->update($request->except('_token', '_method'));
            return response()->json(['success' => $this->page_name . " Updated Successfully"]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            CurrencySetting::destroy($id);
            return "Delete";
        } catch (Exception $e) {
            return response()->json(["error" => $this->page_name . "Can't Be Delete this May having some Employee"]);
        }
    }
}
