<?php

namespace App\Http\Controllers\Admin\Payroll;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PayRollPayscale;
use Illuminate\Support\Facades\Validator;
use Exception;
use Yajra\DataTables\DataTables;
use App\Models\Employee;
use Illuminate\Support\Facades\Auth;
use App\Models\Loans;
use App\Models\PayrollHead;
use App\Models\PayrollPayscaleHead;
use App\Models\User;

class PayRollPayscaleCotroller extends Controller
{
    public  $page_name =   "Payroll PayScale";
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, $year = null)
    {

        if ($year == null) {
            $year = date('Y');
        }

        if ($request->ajax()) {
            $data = PayRollPayscale::with('user','employee','payroll_payscale_head','payroll_payscale_head.payroll_head')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn = view('admin.payroll.payscale.buttons', ['item' => $row, "route" => 'payroll.payscale']);
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.payroll.payscale.index', ['page' => $this->page_name]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create($user_id = null)
    {
        if ($user_id != null) {
            $all_users = Employee::where('status', 'active')->where('id', $user_id)->get();
        } else {
            $all_users = Employee::where('status', 'active')->get();
        }
        $page = $this->page_name;
        return view('admin.payroll.payscale.create', ['page' => $this->page_name, 'all_users' => $all_users]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        // generating the validation
        //         $validation = array();

        //         // dd($request->all());
        //         foreach ($request->all() as $key => $value) {
        //             array_push($validation, [$value => "required"]);
        //         }
        // dd($validation);

        $validator = Validator::make($request->all(), [
            'user_id'=> 'required|numeric|unique:payroll_payscales,user_id'
        ]);
        if ($validator->fails()) {
            return $validator->errors();
        } else {
        try {
            $payroll = PayRollPayscale::create([
                'employee_id' => Employee::where('user_id', $request->user_id)->first()->id,
                'user_id' => $request->user_id,
                'created_by' => auth()->user()->id

            ]);
            foreach ($request->all() as $key => $value) {
                $head =  PayrollHead::where('name', $key)->first();
                if ($head) {
                    PayrollPayscaleHead::create([
                        'payroll_head_id' => $head->id,
                        'payroll_payscale_id' => $payroll->id,
                        'value' => $request->$key,
                        'created_by' => auth()->user()->id
                    ]);
                }
            }

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
        $data = PayRollPayscale::find($id);

        return view('admin.payroll.payscale.show', ['data' => $data, 'page' => $this->page_name, 'all_users' => $all_users, 'loans' => $loans]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = PayRollPayscale::where('user_id', PayRollPayscale::find($id)->user_id)->get();
        $page = $this->page_name;
        return view('admin.payroll.payscale.edit', compact('data', 'page'));
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
                PayRollPayscale::where('id', $id)->update($request->except(['_token',  '_method']));
                return response()->json(['success' => $this->page_name . " Updated Successfully"]);
            } catch (Exception $e) {
                return response()->json(['success' => $e->getMessage()]);
            }
        }
    }

    public function status($id)
    {
        if (PayRollPayscale::find($id)->status == "active") {
            PayRollPayscale::where('id', $id)->update(['status' => 'inactive']);
            return "InActive";
        } else {
            PayRollPayscale::where('id', $id)->update(['status' => 'active']);
            return "Active";
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $user =  PayRollPayscale::find($id);
            PayRollPayscale::destroy($id);
            User::destroy($user->user_id);
            return "Delete";
        } catch (Exception $e) {
            return ["error" => $this->page_name . "Can't Be Delete this May having some Employee"];
        }
    } //

    public function print($user_id)
    {

        $data = PayRollPayscale::with(['user', 'employee', 'employee.branch', 'employee.designation'])->where('user_id', $user_id)->get();
        return view('admin.payroll.payscale.kra_print', compact('data'));
    }

    public function get_employee_data($user_id = null)
    {
        $page = $this->page_name;
        $data = Employee::where('user_id', $user_id)->first();
        $emp_head = PayrollHead::where('employment_type', $data->employment_type)->orWhere('employment_type', 'both')->where('status', 'active')->where('for', 'payscale')->orWhere('for', 'both')->where('deleted_at', null)->get();
        return view('admin.payroll.payscale.employee_head', compact('emp_head', 'page'));
    }
}
