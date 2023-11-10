<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Account;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public $page_name = "Account";

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Account::all();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn = view('admin.account.buttons', ['item' => $row, "route" => 'account']);
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
            }
        return view('admin.account.index', ['page' => $this->page_name]);
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
            'account_number' => 'required|string|digits_between:12,16',
            'name' => 'required|string|regex:/^[a-zA-Z. ]+$/',
            'opening_amount' => 'required|numeric|digits_between:3,7',
            'closing_amount' => 'required|numeric|digits_between:3,7',
            'account_type' => 'required|string',
            'description' => 'required|string',

        ]);
        if ($validator->fails()) {
            return $validator->errors();
        } else {
            Account::create($request->except('_token'));
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
        $account = Account::find($id);
        return view('admin.account.edit', ['account' => $account, 'page' => $this->page_name]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'account_number' => 'required|string|digits_between:12,16',
            'name' => 'required|string',
            'opening_amount' => 'required|numeric|digits_between:3,7',
            'closing_amount' => 'required|numeric|digits_between:3,7',
            'account_type' => 'required|string',
            'description' => 'required|string',
        ]);
        if ($validator->fails()) {
            return $validator->errors();
        } else {
            Account::where('id', $id)->update($request->except('_token', '_method'));
            return response()->json(['success' => $this->page_name . " Updated Successfully"]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            Account::destroy($id);
            return "Delete";
        } catch (Exception $e) {
            return response()->json(["error" => $this->page_name . "Can't Be Delete this May having some Employee"]);
        }
    }
}
