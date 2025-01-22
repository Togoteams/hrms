<?php

namespace App\Http\Controllers\Admin\Payroll;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use App\Models\PayRollPayscale;
use Illuminate\Support\Facades\Validator;
use Exception;
use Yajra\DataTables\DataTables;
use App\Models\Employee;
use Illuminate\Support\Facades\Auth;
use App\Models\Loans;
use App\Models\PayrollHead;
use App\Models\TaxSlabSetting;
use App\Models\PayrollPayscaleHead;
use App\Models\User;
use App\Traits\PayrollTraits;
use App\Models\CurrencySetting;
use App\Models\SalaryHistory;
use Carbon\Carbon;

class PayRollPayscaleCotroller extends BaseController
{
    public  $page_name =   "Payscale";
    use PayrollTraits;

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, $year = null)
    {

        if ($year == null) {
            $year = date('Y');
        }

        if ($request->ajax()) {
            $data = PayRollPayscale::with('user', 'employee')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn = view('admin.payroll.payscale.buttons', ['item' => $row, "route" => 'payroll.payscale']);
                    return $actionBtn;
                    })->editColumn('payscale_date', function ($data) {
                        return \Carbon\Carbon::parse($data->payscale_date)->isoFormat('DD.MM.YYYY');
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
            $all_users = Employee::getActiveEmp()->getList()->where('user_id', $user_id)->get();
        } else {
            $all_users = Employee::getActiveEmp()->getList()->get();
        }
        $page = $this->page_name;
        $taxSlabs = TaxSlabSetting::where('status', 'active')->get();
        return view('admin.payroll.payscale.create', ['page' => $this->page_name,'tax_slabs'=>$taxSlabs, 'all_users' => $all_users]);
    }

    public function payscaleTaxCal(Request $request){

        $taxableAmount = 0;
        $salary_head = $request->salary_head;
        // return $salary_head['basicAmount'];
        $employment_type = $request->employment_type;
        $user_id = $salary_head['employee_id'];
        $net_take_home = $request->net_take_home;
        $emp = Employee::where('user_id', $user_id)->first();
        $totalDays =0;
        // return $user_id;
        if ($emp && $emp->start_date) {
            $startDate = Carbon::parse($emp->start_date);
            $today = Carbon::today();
            $totalDays = $startDate->diffInDays($today);
        } else {
            $totalDays =0;
        }
        if($employment_type!="expatriate")
        {
            $monthlyAmount = ($salary_head['basicAmount'] +$salary_head['allowance'] - ($salary_head['pension_own']-$salary_head['pension_bank'])) * 12;
            $taxableAmount = $monthlyAmount + $salary_head['others_arrears'] + $salary_head['over_time'];
        }else
        {
            $usdToPulaAmount = getCurrencyValue("usd", "pula");
            $usdToInrAmount = getCurrencyValue("usd", "inr");
            $totalMonthlySalary = $request->net_take_home * $usdToPulaAmount;
            $monthlyAmountInPula = (($salary_head['basicAmount'] +$salary_head['house_up_keep_allow']) * 12)* $usdToPulaAmount;
            $extraAmount =  ($salary_head['others_arrears'] + $salary_head['entertainment_expenses'])*$usdToPulaAmount;
            $education_allowance =  (($salary_head['education_allowance'])/$usdToInrAmount) * $usdToPulaAmount;
            $taxableAmount = $monthlyAmountInPula + $extraAmount + $education_allowance;
        }
        $taxData = $this->getTaxAmount(['taxable_amount'=>$taxableAmount,'employment_type'=>$employment_type,'no_of_joining_days'=>$totalDays,'total_monthly_salary'=>$totalMonthlySalary]);

        return $this->responseJson(true,200,"",$taxData);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $salaryHistory = SalaryHistory::where('user_id', $request?->user_id)->orderBy('id','desc')->first();
        // return $salaryHistory?->date_of_current_basic;
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
            'payscale_date' => 'required|date|after_or_equal:'.$salaryHistory?->date_of_current_basic,
        ]);
        if ($validator->fails()) {
            return $validator->errors();
        } else {
            try {
                $employee = Employee::where('user_id', $request->user_id)->first();

            if (!$employee) {
                return response()->json(['error' => 'Employee not found for the given user']);
            }
                if(PayRollPayscale::where('payscale_date',$request->payscale_date)->where('user_id',$request->user_id)->exists())
                {
                    return response()->json(['error' => 'Payscale has been already created of '.date('d-M-Y',strtotime($request->payscale_date))]);
                }
                $payroll = PayRollPayscale::create([
                    'employee_id' => $employee->id,
                    'user_id' => $request->user_id,
                    'basic' => $request->basic,
                    'payscale_date' => $request->payscale_date,
                    'fixed_deductions' => $request->fixed_deductions ?? 0,
                    'other_deductions' => $request->other_deductions ?? 0,
                    'net_take_home' => $request->net_take_home,
                    'ctc' => $request->ctc ?? 0,
                    'total_employer_contribution' => $request->total_employer_contribution ?? 0,
                    'total_deduction' => $request->total_deduction,
                    'gross_earning' => $request->gross_earning,
                    'branch_id' => $employee->branch_id,
                    'created_by' => auth()->user()->id,
                ]);
                foreach ($request->all() as $key => $value) {
                    $head =  PayrollHead::where('slug', $key)->first();
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
        $all_users = Employee::getActiveEmp()->getList()->get();
        $loans = Loans::where('status', 'active')->get();
        $data = PayRollPayscale::find($id);

        return view('admin.payroll.payscale.show', ['data' => $data, 'page' => $this->page_name, 'all_users' => $all_users, 'loans' => $loans]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $edit = true;
        $payscale = PayRollPayscale::find($id);
        $page = $this->page_name;
        $emp = Employee::where('user_id', $payscale->user_id)->getActiveEmp()->first();
        $data = PayRollPayscale::where('user_id', $payscale->user_id)->first();
        $empSalary = SalaryHistory::where('user_id',$payscale->user_id)->where('date_of_current_basic','<=',date('Y-m-d'))->first();

        $usdToPulaAmount = getCurrencyValue("usd", "pula");
        $usdToInrAmount = getCurrencyValue("usd", "inr");

        $emp_head = PayrollHead::where('employment_type', $emp->employment_type)
        ->orWhere('employment_type', 'both')->where('status', 'active')
        ->where('for', 'payscale')
        ->where('deleted_at', null)->get();
        if($emp->employment_type=="expatriate")
        {
            return view('admin.payroll.payscale.edit', ['html' => view('admin.payroll.payscale.employee_head_for_ibo', compact('emp_head','emp','empSalary', 'page', 'data', 'edit','usdToPulaAmount','usdToInrAmount')), 'data' => $payscale]);
        }
        else{
            return view('admin.payroll.payscale.edit', ['html' => view('admin.payroll.payscale.employee_head', compact('emp_head','emp', 'page','empSalary', 'data', 'edit')), 'data' => $payscale]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|numeric|unique:payroll_payscales,user_id,' . $id,
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
                $payroll = PayRollPayscale::where('id', $id)->update([
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
                    // 'created_by' => auth()->user()->id,
                    'updated_by' => auth()->user()->id,


                ]);
                foreach ($request->all() as $key => $value) {
                    $head =  PayrollHead::where('slug', $key)->first();
                    if ($head) {
                        PayrollPayscaleHead::updateOrCreate(['payroll_payscale_id'=>$id,'payroll_head_id'=> $head->id],[
                            'payroll_head_id' => $head->id,
                            'value' => $request->$key,
                            'updated_by' => auth()->user()->id,
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
            $payscale =  PayRollPayscale::find($id);
            $payscale->payroll_payscale_head()->delete();
            $payscale->delete();
            return "Delete";
        } catch (Exception $e) {
            return ["error" => $this->page_name . "Can't Be Delete this May having some Employee"];
        }
    } 

    public function print($user_id)
    {

        $data = PayRollPayscale::with(['user', 'employee', 'employee.branch', 'employee.designation'])->where('user_id', $user_id)->get();
        return view('admin.payroll.payscale.kra_print', compact('data'));
    }

    public function get_employee_data($user_id = null, $payscale_date = null)
    {
        $page = $this->page_name;
        $emp = Employee::where('user_id', $user_id)->first();
        $data = PayRollPayscale::where('user_id', $user_id)->first();

        $empSalary = SalaryHistory::where('user_id',$user_id)->where('date_of_current_basic',"<=",$payscale_date)->orderBy('id','desc')->first();
        // return $empSalary;
        if(empty($empSalary))
        {
             return response()->json("Employee Salary is  not defined");
        }
        $usdToPulaAmount = getCurrencyValue("usd", "pula");
        $usdToInrAmount = getCurrencyValue("usd", "inr");

        $emp_head = PayrollHead::whereIn('employment_type', [$emp->employment_type,'both'])->where('status', 'active')->whereIn('for', ['payscale','both'])->where('deleted_at', null)->get();
        if($emp->employment_type=="expatriate")
        {
            return view('admin.payroll.payscale.employee_head_for_ibo', compact('emp_head', 'page', 'data','empSalary','emp','usdToPulaAmount','usdToInrAmount'));
        }else
        {
            return view('admin.payroll.payscale.employee_head', compact('emp_head', 'page', 'data','emp','empSalary'));
        }
    }
}
