<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Designation;
use App\Models\Employee;
use App\Models\Membership;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\Branch;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Validator;
use Exception;

class EmployeeController extends Controller
{
    public $page_name = "Employees";
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Employee::select('*');
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn = view('layouts.buttons', ['item' => $row, "route" => 'employees']);
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        $designation = Designation::all();
        $membership = Membership::all();
        $branch = Branch::where('status', 'active')->get();
        return view('admin.employees.index', ['page' => $this->page_name, 'designation' => $designation, 'membership' => $membership, 'branch' => $branch]);
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'mobile' => ['required', 'numeric', 'min:10'],
            'username' => ['required', 'string', 'min:5', 'unique:users'],
            'password' => ['required', 'confirmed', Password::defaults()],
            
        ]);

        if ($validator->fails()) {
            return $validator->errors();
        } else {

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'username' => $request->username,
                'mobile' => $request->mobile,
                'password' => Hash::make($request->password),
            ]);

            Employee::insertGetId($request->except('_token', 'name', 'email', 'mobile', 'username', 'password', 'password_confirmation'));
            return response()->json(['success' => $this->page_name . " Added Successfully"]);
        }




        dd($request);
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

    public function status($id)
    {
        if (Employee::find($id)->status == "active") {
            Employee::where('id', $id)->update(['status' => 'inactive']);
            return "InActive";
        } else {
            Employee::where('id', $id)->update(['status' => 'active']);
            return "Active";
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            Employee::destroy($id);
            return "Delete";
        } catch (Exception $e) {
            return response()->json(["error" => $this->page_name . "Can't Be Delete this May having some Employee"]);
        }
    }
}
