<?php

namespace App\Http\Controllers\Admin\payroll;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Models\CurrencySetting;
use App\Models\Employee;
use App\Models\Reimbursement;
use App\Models\ReimbursementType;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Yajra\DataTables\Facades\DataTables;

class ReimbursementController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public $page_name = "Reimbursement";
    public function index(Request $request)
    {
            if ($request->ajax()) {
            $data = Reimbursement::with('reimbursementype')->select('*');
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn = view('admin.payroll.reimbursement.buttons', ['item' => $row, "route" => 'payroll.reimbursement']);
                    return $actionBtn;
                })
                ->editColumn('claim_date', function ($data) {
                    return \Carbon\Carbon::parse($data->claim_date)->isoFormat('DD.MM.YYYY');
                })
                ->rawColumns(['action'])
                ->make(true);
            }
        $Employees = Employee::all();
        $reimbursement = Reimbursement::with('reimbursementype')->get()->toArray();
        $reimbursementType = ReimbursementType::getReimbursementType()->get();
        $currencies = CurrencySetting::getCurrency()->get();
        // Filter currencies to include only 'pula' and 'usd'
        $allowedCurrencies = ['pula', 'usd'];
        $filteredCurrencySetting = $currencies->whereIn('currency_name_from', $allowedCurrencies);

        return view('admin.payroll.reimbursement.index', ['page' => $this->page_name,
        'reimbursementType' => $reimbursementType,
        'currencies' => $filteredCurrencySetting,
        'reimbursement' => $reimbursement,
         'Employees' => $Employees]);


    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // $page = "Reimbursement";
        // $reimbursementType = ReimbursementType::where('status','active')->get();
        // return view('admin.payroll.reimbursement.create',compact('page','reimbursementType'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        $validator = Validator::make($request->all(), [
            'type_id' => 'required|numeric',
            'expenses_currency' => 'required|string',
            'expenses_amount' => 'required|numeric|gt:0',
            'financial_year' => 'required|numeric',
            'claim_date' => 'required|date|before_or_equal:' . now()->format('Y-m-d'),
            'claim_from_month' => [
                'required',
                'numeric',
            ],
            'claim_to_month' => [
                'required',
                'numeric',
            ],
            'reimbursement_notes' => 'required|string',

        ]);

        $validator->after(function ($validator) use ($request, $user) {
            $overlapExists = Reimbursement::where('user_id', $user->id)
                ->where(function ($query) use ($request) {
                    $query->where(function ($query) use ($request) {
                        $query->where('claim_from_month', '<=', $request->claim_to_month)
                            ->where('claim_to_month', '>=', $request->claim_from_month);
                    })
                    ->orWhere(function ($query) use ($request) {
                        $query->where('claim_from_month', '<=', $request->claim_to_month)
                            ->where('claim_to_month', '>=', $request->claim_to_month);
                    });
                })
                ->where('id', '!=', $request->id)
                ->exists();

            if ($overlapExists) {
                $validator->errors()->add('claim_to_month', 'The month range overlaps with an existing record.');
            }
        });

        if ($validator->fails()) {
            return $validator->errors();
        } else {
            try {
                $request->merge([
                    'user_id' => $user->id,
                    'status' => "pending",
                ]);
                Reimbursement::create($request->except(['_token', '_method']));
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
        $data = Reimbursement::find($id);
        $employee = Employee::where('status','active')->get();
        $reimbursementType = ReimbursementType::getReimbursementType()->get();
        $currencies = CurrencySetting::getCurrency()->get();

        // Filter currencies to include only 'pula' and 'usd'
        $allowedCurrencies = ['pula', 'usd'];
        $filteredCurrencySetting = $currencies->whereIn('currency_name_from', $allowedCurrencies);

        return view('admin.payroll.reimbursement.show', ['data' => $data,
        'reimbursementType' => $reimbursementType,
        'currencies'=>$filteredCurrencySetting,
        'employee' => $employee,
         'page' => $this->page_name]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

        $reimbursement = Reimbursement::find($id);
        $reimbursementType = ReimbursementType::getReimbursementType()->get();
        $currencies = CurrencySetting::getCurrency()->get();

         // Filter currencies to include only 'pula' and 'usd'
         $allowedCurrencies = ['pula', 'usd'];
         $filteredCurrencySetting = $currencies->whereIn('currency_name_from', $allowedCurrencies);

        return view('admin.payroll.reimbursement.edit', ['reimbursement' => $reimbursement, 'reimbursementType' => $reimbursementType,'currencies'=>$filteredCurrencySetting, 'page' => $this->page_name]);
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = Auth::user();

        $validator = Validator::make($request->all(), [
            'type_id' => 'required|numeric',
            'expenses_currency' => 'required|string',
            'expenses_amount' => 'required|numeric|gt:0',
            'financial_year' => 'required|numeric',
            'claim_date' => 'required|date|before_or_equal:' . now()->format('Y-m-d'),
            'claim_from_month' => [
                'required',
                'numeric',
            ],
            'claim_to_month' => [
                'required',
                'numeric',
            ],
            'reimbursement_notes' => 'required|string',
        ]);

        $validator->after(function ($validator) use ($request, $user, $id) {
            $overlapExists = Reimbursement::where('user_id', $user->id)
                ->where(function ($query) use ($request) {
                    $query->where(function ($query) use ($request) {
                        $query->where('claim_from_month', '<=', $request->claim_to_month)
                            ->where('claim_to_month', '>=', $request->claim_from_month);
                    })
                    ->orWhere(function ($query) use ($request) {
                        $query->where('claim_from_month', '<=', $request->claim_to_month)
                            ->where('claim_to_month', '>=', $request->claim_to_month);
                    });
                })
                ->where('id', '!=', $id)
                ->exists();

            if ($overlapExists) {
                $validator->errors()->add('claim_to_month', 'The month range overlaps with an existing record.');
            }
        });

        if ($validator->fails()) {
            return $validator->errors();
        } else {
            Reimbursement::where('id', $id)->update($request->except(['_token', '_method']));
            return response()->json(['success' => $this->page_name . " Updated Successfully"]);
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            Reimbursement::destroy($id);
            return "Delete";
        } catch (Exception $e) {
            return response()->json(["error" => $this->page_name . "Can't Be Delete this May having some Employee"]);
        }
    }

    public function status(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'status' => ['required','string'],
            'reimbursement_reason' => ['required','string'],
            'reimbursement_currency' => 'required|string',
            'reimbursement_amount' => 'required|numeric|gt:0',
        ]);
                // dd($request->all());
        $reimbursement = Reimbursement::find($request->payroll_id);
        $reimbursement->reimbursement_reason = $request['reimbursement_reason'];
        $reimbursement->reimbursement_currency = $request['reimbursement_currency'];
        $reimbursement->reimbursement_amount = $request['reimbursement_amount'];
        $reimbursement->status = $request['status'];
        if($request->status=='approved')
        {
           $reimbursement->approved_at=date('Y-m-d h:i:s');
        }
        if($request->status=='rejected')
        {
           $reimbursement->rejected_at=date('Y-m-d h:i:s');
        }
        $reimbursement->save();
        // return redirect("admin/payroll/reimbursement")->with('status','Add Reimbursement  successfully');
        return $this->responseJson(true,200,'status created successfully',$reimbursement);

        // Reimbursement::create($request->all());

        // return response(['success' => 'status created successfully.']);
    }
}

