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
use App\Models\PayrollSalary;
use App\Models\PayrollSalaryHead;
use App\Models\User;

class PayrollSalaryController extends Controller
{
    public  $page_name =   "Payroll Salary";
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, $year = null)
    {

        if ($year == null) {
            $year = date('Y');
        }

        if ($request->ajax()) {
            $data = PayrollSalary::with('user', 'employee')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn = view('admin.payroll.salary.buttons', ['item' => $row, "route" => 'payroll.salary']);
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.payroll.salary.index', ['page' => $this->page_name]);
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
        return view('admin.payroll.salary.create', ['page' => $this->page_name, 'all_users' => $all_users]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'user_id' => 'required|numeric',
            'basic' => 'required|numeric',
            // 'fixed_deductions' => 'required|numeric',
            // 'other_deductions' => 'required|numeric',
            'net_take_home' => 'required|numeric',
            // 'ctc' => 'required|numeric',
            // 'total_employer_contribution' => 'required|numeric',
            'total_deduction' => 'required|numeric',
            'gross_earning' => 'required|numeric',
        ]);
        if ($validator->fails()) {
            return $validator->errors();
        } else {
            try {
                $payroll = PayrollSalary::create([
                    'employee_id' => Employee::where('user_id', $request->user_id)->first()->id,
                    'user_id' => $request->user_id,
                    'basic' =>  $request->basic,
                    'fixed_deductions' =>  $request->fixed_deductions,
                    'other_deductions' =>  $request->other_deductions,
                    'net_take_home' =>  $request->net_take_home,
                    'ctc' =>  $request->ctc,
                    'total_employer_contribution' =>  $request->total_employer_contribution,
                    'total_deduction' =>  $request->total_deduction,
                    'gross_earning' =>  $request->gross_earning,
                    'created_by' => auth()->user()->id

                ]);
                // dd($payroll);
                foreach ($request->all() as $key => $value) {
                    $head =  PayrollHead::where('name', $key)->first();
                    if ($head) {
                        PayrollSalaryHead::create([
                            'payroll_head_id' => $head->id,
                            'payroll_salary_id' => $payroll->id,
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
        $data = PayrollSalary::find($id);

        return view('admin.payroll.salary.show', ['data' => $data, 'page' => $this->page_name, 'all_users' => $all_users, 'loans' => $loans]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $edit = true;
        $payscale = PayrollSalary::find($id);
        $page = $this->page_name;
        $emp = Employee::where('user_id', $payscale->user_id)->first();
        $data = PayrollSalary::where('user_id', $payscale->user_id)->first();
        $emp_head = PayrollHead::where('employment_type', $emp->employment_type)->orWhere('employment_type', 'both')->where('status', 'active')->where('for', 'payscale')->orWhere('for', 'both')->where('deleted_at', null)->get();
        return view('admin.payroll.salary.edit', ['html' => view('admin.payroll.salary.employee_head', compact('emp_head', 'page', 'data', 'edit')), 'data' => $payscale]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|numeric',
            'basic' => 'required|numeric',
            // 'fixed_deductions' => 'required|numeric',
            // 'other_deductions' => 'required|numeric',
            'net_take_home' => 'required|numeric',
            // 'ctc' => 'required|numeric',
            // 'total_employer_contribution' => 'required|numeric',
            'total_deduction' => 'required|numeric',
            'gross_earning' => 'required|numeric',
        ]);
        if ($validator->fails()) {
            return $validator->errors();
        } else {
            try {
                $payroll = PayrollSalary::where('id', $id)->update([
                    'employee_id' => Employee::where('user_id', $request->user_id)->first()->id,
                    'user_id' => $request->user_id,
                    'basic' =>  $request->basic,
                    // 'fixed_deductions' =>  $request->fixed_deductions,
                    // 'other_deductions' =>  $request->other_deductions,
                    'net_take_home' =>  $request->net_take_home,
                    // 'ctc' =>  $request->ctc,
                    // 'total_employer_contribution' =>  $request->total_employer_contribution,
                    'total_deduction' =>  $request->total_deduction,
                    'gross_earning' =>  $request->gross_earning,
                    'created_by' => auth()->user()->id

                ]);
                foreach ($request->all() as $key => $value) {
                    $head =  PayrollHead::where('name', $key)->first();
                    if ($head) {
                        PayrollSalaryHead::where('payroll_head_id', $head->id)->where('payroll_salary_id', $id)->update([
                            'payroll_head_id' => $head->id,
                            'value' => $request->$key,
                            'updated_by' => auth()->user()->id
                        ]);
                    }
                }

                return response()->json(['success' => $this->page_name . " Added Successfully"]);
            } catch (Exception $e) {
                return response()->json(['error' => $e->getMessage()]);
            }
        }
    }

    public function status($id)
    {
        if (PayrollSalary::find($id)->status == "active") {
            PayrollSalary::where('id', $id)->update(['status' => 'inactive']);
            return "InActive";
        } else {
            PayrollSalary::where('id', $id)->update(['status' => 'active']);
            return "Active";
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $user =  PayrollSalary::find($id);
            PayrollSalary::destroy($id);
            User::destroy($user->user_id);
            return "Delete";
        } catch (Exception $e) {
            return ["error" => $this->page_name . "Can't Be Delete this May having some Employee"];
        }
    } //

    public function print($user_id)
    {

        $data = PayrollSalary::with(['user', 'employee', 'employee.branch', 'employee.designation'])->where('user_id', $user_id)->get();
        return view('admin.payroll.salary.kra_print', compact('data'));
    }

    public function get_employee_data($user_id = null)
    {
        $page = $this->page_name;
        $emp = Employee::where('user_id', $user_id)->first();
        $data = PayRollPayscale::where('user_id', $user_id)->orderByDesc('id')->first();
        $emp_head = PayrollHead::where('employment_type', $emp->employment_type)->orWhere('employment_type', 'both')->where('status', 'active')->where('for', 'payscale')->orWhere('for', 'both')->where('deleted_at', null)->get();
        return view('admin.payroll.salary.employee_head', compact('emp_head', 'page', 'data','emp'));
    }
}
