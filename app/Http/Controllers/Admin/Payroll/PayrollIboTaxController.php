<?php

namespace App\Http\Controllers\Admin\Payroll;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\PayrollIboTax;
use App\Models\PayrollSalary;
use App\Models\CurrencySetting;
use App\Models\Reimbursement;
use App\Models\User;
use App\Traits\PayrollTraits;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class PayrollIboTaxController extends Controller
{
    public $page_name = "Tax For IBO";
    use PayrollTraits;

    public function iboTaxReport(Request $request)
    {
        if ($request->ajax()) {
            $data = PayrollIboTax::with('user','user.employee')->select('*');
            return Datatables::of($data)
                ->addIndexColumn()
                ->make(true);
        }
        return view('admin.payroll.ibo-tax.index', ['page' => $this->page_name]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
      

    }

    /**
     * Store a newly created resource in storage.
     */
    public function iboTaxCalculate(Request $request)
    {
        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
                'financial_year' => 'string|required',
                'user_id' => 'string|required',
                'gross_salary' => 'string|required',
                'reimbursement_amount' => 'string|required',
                'taxable_amount' => 'string|required',
                'tax_amount' => 'string|required',
            ]);
            if ($validator->fails()) {
                return $validator->errors();
            } else {
                $request->merge([
                    'calculated_at' => date('Y-m-d H:i:s'),
                    'calculated_by' => auth()->user()->id,
                    'created_by' => auth()->user()->id
                ]);
            
                PayrollIboTax::create($request->except('_token'));
                return response()->json(['success' => $this->page_name . " Added Successfully"]);
            }
        }
        $pageName = "Calculate IBO Tax";
        $users = Employee::where('employment_type','expatriate')->getActiveEmp()->get();
        return view('admin.payroll.ibo-tax.create',['page' => $pageName, 'all_users' => $users]);
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
        $data = PayrollIboTax::find($id);
        return view('admin.payroll.ibo-tax.edit', ['data' => $data, 'page' => $this->page_name]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'string|required|unique:ibo-taxs,name,' . $id,
            'placeholder' => 'string|required',
            'employment_type' => 'string|required',
            'for' => 'string|required',
        ]);
        if ($validator->fails()) {
            return $validator->errors();
        } else {
            $request->request->add(['updated_by' => auth()->user()->id]);
            PayrollIboTax::where('id', $id)->update($request->except('_token', '_method'));
            return response()->json(['success' => $this->page_name . " Updated Successfully"]);
        }
    }
    public function status($id)
    {
        if (PayrollIboTax::find($id)->status == "active") {
            PayrollIboTax::where('id', $id)->update(['status' => 'inactive']);
            return "InActive";
        } else {
            PayrollIboTax::where('id', $id)->update(['status' => 'active']);
            return "Active";
        }
    }

    public function get_tax_head_data(Request $request)
    {
        $page = $this->page_name;
        $user_id = $request->user_id;

        $emp = Employee::where('user_id', $user_id)->first();
        $salary = PayrollSalary::where('user_id', $user_id)->get();
        $usdToPulaAmount = 1;
        $pulaToUSDAmount = 1;
        $reimbursements = Reimbursement::where('user_id', $user_id)->where('status','approved')->get();
        $currencySeeting = CurrencySetting::where('currency_name_from','usd')->where('currency_name_to','pula')->first();
        if(!empty($currencySeeting))
        {
            $usdToPulaAmount = $currencySeeting->currency_amount_to;
        }
        $currencySeetingPulaToUsd = CurrencySetting::where('currency_name_from','pula')->where('currency_name_to','usd')->first();
        if(!empty($currencySeetingPulaToUsd))
        {
            $pulaToUSDAmount = $currencySeetingPulaToUsd->currency_amount_to;
        }
        $totalPaidSalary = $salary->sum('gross_earning');
        $reimbursementAmount = 0;
        foreach($reimbursements as $reimbursement)
        {
            if($reimbursement->reimbursement_currency=="usd")
            {
                $reimbursementAmount = ($reimbursementAmount + $reimbursement->reimbursement_amount)*$usdToPulaAmount;
            }else
            {
                $reimbursementAmount = $reimbursementAmount + $reimbursement->reimbursement_amount;
            }
        }
        $totalPaidSalary = $salary->sum('gross_earning') * $usdToPulaAmount;
        $taxableAmount = $reimbursementAmount + $totalPaidSalary;
        $taxableAmountParam = $taxableAmount * 12;
        $empType = $emp->employment_type;

        $taxData = $this->getTaxAmount(['taxable_amount'=>$taxableAmountParam,'employment_type'=>$empType]);
        $tax_amount = $taxData['tax_amount'];
        return view('admin.payroll.ibo-tax.ibo_tax_head', compact('taxableAmount', 'page', 'tax_amount','totalPaidSalary','reimbursementAmount','pulaToUSDAmount'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            PayrollIboTax::destroy($id);
            return "Delete";
        } catch (Exception $e) {
            return response()->json(["error" => $this->page_name . "Can't Be Delete this May having some Employee"]);
        }
    }
}
