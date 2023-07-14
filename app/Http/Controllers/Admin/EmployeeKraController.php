<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\EmployeeKra;
use App\Models\KraAttributes;
use App\Models\Loans;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Exception;
use Illuminate\Support\Facades\Auth;

class EmployeeKraController extends Controller
{
    public $page_name = "Employee Kra";
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = EmployeeKra::with('user')->select('*');
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn = view('admin.employees_kra.buttons', ['item' => $row, "route" => 'employees-kra']);
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.employees_kra.index', ['page' => $this->page_name]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $page = $this->page_name;

        $all_users = Employee::where('status', 'active')->get();
        $kra_attributes = KraAttributes::where('deleted_at', null)->get();
        return view('admin.employees_kra.create', compact('all_users', 'kra_attributes', 'page'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'user_id' => 'required|numeric',


        ]);
        dd($request);
        if ($validator->fails()) {
            return $validator->errors();
        } else {
            try {
                $request->request->add(['employee_id' => Employee::where('user_id', $request->user_id)->first()->id]);
                $request->request->add(['created_by' => Auth::user()->id]);
                $request->request->add(['uuid' => Auth::user()->uuid]);
                EmployeeKra::insertGetId($request->except(['_token', '_method']));
                return response()->json(['success' => $this->page_name . " Added Successfully"]);
            } catch (Exception $e) {

                return response()->json(['error' => $e->getMessage()]);
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $all_users = Employee::get();
        $loans = Loans::where('status', 'active')->get();
        $data = EmployeeKra::find($id);
        return view('admin.employees_kra.show', ['data' => $data, 'page' => $this->page_name, 'all_users' => $all_users, 'loans' => $loans]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $all_users = Employee::get();
        $loans = Loans::where('status', 'active')->get();
        $data = EmployeeKra::find($id);
        return view('admin.employees_kra.edit', ['data' => $data, 'page' => $this->page_name, 'all_users' => $all_users, 'loans' => $loans]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|numeric',
            'loan_id' => 'required|numeric',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'principal_amount' => 'required|numeric',
            'maturity_amount' => 'required|numeric',
            'tenure' => 'required|numeric',
            'sanctioned' => 'required|numeric',
            'sanctioned_amount' => 'required|numeric',
            'description' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return $validator->errors();
        } else {
            try {
                EmployeeKra::where('id', $id)->update($request->except(['_token',  '_method']));
                return response()->json(['success' => $this->page_name . " Updated Successfully"]);
            } catch (Exception $e) {
                return response()->json(['success' => $e->getMessage()]);
            }
        }
    }

    public function status($id)
    {
        if (EmployeeKra::find($id)->status == "active") {
            EmployeeKra::where('id', $id)->update(['status' => 'inactive']);
            return "InActive";
        } else {
            EmployeeKra::where('id', $id)->update(['status' => 'active']);
            return "Active";
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $user =  EmployeeKra::find($id);
            EmployeeKra::destroy($id);
            User::destroy($user->user_id);
            return "Delete";
        } catch (Exception $e) {
            return ["error" => $this->page_name . "Can't Be Delete this May having some Employee"];
        }
    } //
}
