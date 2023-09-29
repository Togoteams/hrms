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
class PayRollPayscaleCotroller extends BaseController
{
    public  $page_name =   "Payroll PayScale";
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
            $all_users = Employee::where('status', 'active')->where('user_id', $user_id)->get();
        } else {
            $all_users = Employee::where('status', 'active')->get();
        }
        $page = $this->page_name;
        $taxSlabs = TaxSlabSetting::where('status', 'active')->get();
        return view('admin.payroll.payscale.create', ['page' => $this->page_name,'tax_slabs'=>$taxSlabs, 'all_users' => $all_users]);
    }

    public function payscaleTaxCal(Request $request){

        $taxableAmount = $request->taxable_amount * 12;
        // echo $taxableAmount;
        $taxSlab = TaxSlabSetting::where('from','<=',$taxableAmount)->where('to','>=',$taxableAmount)->where('status', 'active')->first();
        // echo $taxSlab;
        $empType = $request->employment_type;

        if($empType=="expatriate")
        {
            $extraAmount = ((($taxableAmount - $taxSlab->from)/100)*$taxSlab->ibo_tax_per);
            $taxAmount = ($taxSlab->additional_ibo_amount + $extraAmount)/12 ;

        }else{
            $extraAmount = ((($taxableAmount - $taxSlab->from)/100)*$taxSlab->local_tax_per);
            $taxAmount = ($taxSlab->additional_local_amount + $extraAmount)/12;
        }
        return $this->responseJson(true,200,"",["tax_amount"=>round($taxAmount),'taxable_amount'=>$taxableAmount]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|numeric|unique:payroll_payscales,user_id',
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
                $payroll = PayRollPayscale::create([
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
        $edit = true;
        $payscale = PayRollPayscale::find($id);
        $page = $this->page_name;
        $emp = Employee::where('user_id', $payscale->user_id)->first();
        $data = PayRollPayscale::where('user_id', $payscale->user_id)->first();
        $emp_head = PayrollHead::where('employment_type', $emp->employment_type)->orWhere('employment_type', 'both')->where('status', 'active')->where('for', 'payscale')->orWhere('for', 'both')->where('deleted_at', null)->get();
        return view('admin.payroll.payscale.edit', ['html' => view('admin.payroll.payscale.employee_head', compact('emp_head','emp', 'page', 'data', 'edit')), 'data' => $payscale]);
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
                    'created_by' => auth()->user()->id

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
        $emp = Employee::where('user_id', $user_id)->first();
        $data = PayRollPayscale::where('user_id', $user_id)->first();
        $emp_head = PayrollHead::whereIn('employment_type', [$emp->employment_type,'both'])->where('status', 'active')->whereIn('for', ['payscale','both'])->where('deleted_at', null)->get();
        return view('admin.payroll.payscale.employee_head', compact('emp_head', 'page', 'data','emp'));
    }
}
