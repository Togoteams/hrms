<?php

namespace App\Http\Controllers\Admin\payroll;

use App\Http\Controllers\BaseController;
use App\Models\CurrencySetting;
use App\Models\Employee;
use App\Models\LeaveApply;
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
        $data = Reimbursement::with('reimbursementype','user','user.employee')->orderBy('id','desc')->getList()->select('*');
        return DataTables::of($data)
                ->filter(function ($query) use ($request) {
                    if ($request->has('search') && $request->input('search')['value']) {
                        $search = $request->input('search')['value'];
                        $query->whereHas('reimbursementype', function ($q) use ($search) {
                            $q->where('type', 'like', "%{$search}%");
                        })
                        ->orWhereHas('user.employee', function ($q) use ($search) {
                            $q->where('ec_number', 'like', "%{$search}%");
                        })
                        ->orWhereHas('user', function ($q) use ($search) {
                            $q->where('name', 'like', "%{$search}%");
                        })
                        ->orWhere('financial_year', 'like', "%{$search}%")
                        ->orWhere('expenses_currency', 'like', "%{$search}%")
                        ->orWhere('expenses_amount', 'like', "%{$search}%")
                        ->orWhere('reimbursement_notes', 'like', "%{$search}%")
                        ->orWhere('status', 'like', "%{$search}%");
                    }
                })
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $actionBtn = view('admin.payroll.reimbursement.buttons', ['item' => $row, "route" => 'payroll.reimbursement']);
                return $actionBtn;
            })->addColumn('claim_details', function ($row) {
                $claimData = view('admin.payroll.reimbursement.index-claim-date', ['item' => $row]);
                return $claimData;
            })
            ->editColumn('claim_date', function ($data) {
                return \Carbon\Carbon::parse($data->claim_date)->isoFormat('DD.MM.YYYY');
            })
            ->rawColumns(['action'])
            ->make(true);
        }
        $employees = Employee::getActiveEmp()->getList()->get();
        $reimbursement = Reimbursement::with('reimbursementype')->get()->toArray();
        $reimbursementType = ReimbursementType::getReimbursementType()->get();
        $currencies = CurrencySetting::getCurrency()->get();
        $allowedCurrencies = ['pula', 'usd'];
        $allowedExpenseCurrencies = ['pula'];
        $filteredCurrencySetting = $currencies->whereIn('currency_name_from', $allowedCurrencies);
        $expenseCurrency = $currencies->whereIn('currency_name_from', $allowedExpenseCurrencies);
        $reimbursementFor = getReimbursementFor();
        return view('admin.payroll.reimbursement.index', ['page' => $this->page_name,
        'reimbursementType' => $reimbursementType,
        'currencies' => $filteredCurrencySetting,
        'reimbursement' => $reimbursement,
        'reimbursementFor' => $reimbursementFor,
        'expenseCurrency' => $expenseCurrency,
        'allowedCurrencies' => $allowedCurrencies,
         'Employees' => $employees
        ]);


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
        // $user = Auth::user();
        $request->validate([
            'type_id' => 'required|numeric',
            'reimbursement_for' => 'required|numeric',
            'user_id' => 'required|numeric|exists:users,id',
            'expenses_currency' => 'required|string',
            'expenses_amount' => 'required|numeric|gt:0',
            'financial_year' => 'required|string',
            "document_file" => ["mimetypes:application/pdf", "max:10000", 'nullable'],
            'claim_date' => 'required|date|before_or_equal:' . now()->format('Y-m-d'),
            'reimbursement_notes' => 'required|string',
        ]);
        $userId = $request->user_id;
        $employee = Employee::where('user_id', $userId)->first();

        // $validator->after(function ($validator) use ($request, $userId) {
        //     $overlapExists = Reimbursement::where('user_id', $userId)
        //         ->where(function ($query) use ($request) {
        //             $query->where(function ($query) use ($request) {
        //                 $query->where('claim_from_month', '<=', $request->claim_to_month)
        //                     ->where('claim_to_month', '>=', $request->claim_from_month);
        //             })
        //             ->orWhere(function ($query) use ($request) {
        //                 $query->where('claim_from_month', '<=', $request->claim_to_month)
        //                     ->where('claim_to_month', '>=', $request->claim_to_month);
        //             });
        //         })
        //         ->where('id', '!=', $request->id)
        //         ->exists();

        //     if ($overlapExists) {
        //         $validator->errors()->add('claim_to_month', 'The month range overlaps with an existing record.');
        //     }
        // });

        // if ($validator->fails()) {
        //     return $validator->errors();
        // } else {
            try {
                $request->merge([
                    'user_id' => $userId,
                    'branch_id' => $employee->branch_id,
                    'created_by' => auth()->user()->id,
                    'status' => "pending",
                    'document_file' => $request->has('document_file') ? $this->insert_image($request->file('document_file'), 'document_file') : '',
                ]);
                if($request->reimbursement_for==2 || $request->reimbursement_for==3)
                {
                    $request->merge([
                        'reimbursement_currency' => $request->reimbursement_currency,
                        'reimbursement_amount' => $request->reimbursement_amount,
                        'status' => "approved",
                        'approved_at' => date('Y-m-d h:i:s'),
                    ]);  
                    if($request->reimbursement_for==3)
                    {
                        $request->merge([
                            'claim_date' =>"",
                            'claim_from_month' =>"",
                            'claim_to_month' =>""
                        ]);   
                    }
                }
                Reimbursement::create($request->except(['_token', '_method']));
                return $this->responseJson(true, 200, $this->page_name . " Added Successfully","");

            } catch (Exception $e) {  
                return $this->responseJson(false, 200, $e->getMessage());
            }
        // }

    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Reimbursement::find($id);
        $employee = Employee::getActiveEmp()->where('employment_type','local')->get();
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
        $reimbursementFor = getReimbursementFor();
        $currencies = CurrencySetting::getCurrency()->get();
        // return $currencies;
        // Filter currencies to include only 'pula' and 'usd'
        $allowedCurrencies = ['pula', 'usd'];
        $allowedExpenseCurrencies = ['pula'];
        $filteredCurrencySetting = $currencies->whereIn('currency_name_from', $allowedCurrencies);
        $expenseCurrency = $currencies->whereIn('currency_name_from', $allowedExpenseCurrencies);
        $employees = Employee::getActiveEmp()->getList()->get();

         // Filter currencies to include only 'pula' and 'usd'
         $allowedCurrencies = ['pula', 'usd'];
         $filteredCurrencySetting = $currencies->whereIn('currency_name_from', $allowedCurrencies);
        return view('admin.payroll.reimbursement.edit', ['reimbursement' => $reimbursement, 'expenseCurrency' => $expenseCurrency, 'Employees' => $employees,'reimbursementFor'=>$reimbursementFor,'editData'=>$reimbursement,'reimbursementType' => $reimbursementType,'currencies'=>$filteredCurrencySetting, 'page' => $this->page_name]);
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'type_id' => 'required|numeric',
            'reimbursement_for' => 'required|numeric',
            'user_id' => 'required|numeric|exists:users,id',
            'expenses_currency' => 'required|string',
            'expenses_amount' => 'required|numeric|gt:0',
            'financial_year' => 'required|string',
            "document_file" => ["mimetypes:application/pdf", "max:10000", 'nullable'],
            'claim_date' => 'required|date|before_or_equal:' . now()->format('Y-m-d'),
            'reimbursement_notes' => 'required|string',
        ]);

        // $validator->after(function ($validator) use ($request, $user, $id) {
        //     $claim_to_month = $request->claim_to_month;
        //     $claim_from_month = $request->claim_from_month;
        //     $overlapExists = Reimbursement::where('user_id', $user->id)
        //         ->where(function ($query) use ($request,$claim_from_month,$claim_to_month) {
        //             $query->where(function ($query) use ($request,$claim_from_month,$claim_to_month) {
        //                 $query->where('claim_from_month', '<=', $claim_to_month)
        //                     ->where('claim_to_month', '>=', $claim_from_month);
        //             })
        //             ->orWhere(function ($query2) use ($request,$claim_from_month,$claim_to_month) {
        //                 $query2->where('claim_from_month', '<=', $claim_to_month)
        //                     ->where('claim_to_month', '>=', $claim_to_month);
        //             });
        //         })
        //         ->where('id', '!=', $id)
        //         ->exists();

        //     if ($overlapExists) {
        //         $validator->errors()->add('claim_to_month', 'The month range overlaps with an existing record.');
        //     }
        // });

        // if ($validator->fails()) {
        //     return $validator->errors();
        // } else { 
            try {
                $id = $request->reimbursement_id;
              
                $documentFile = $request->has('document_file') ? $this->update_images('reimbursements', $id, $request->file('document_file'), 'document_file', 'document_file') : Reimbursement::find($id)->document_file;
                Reimbursement::where('id', $id)->update([
                    'type_id' => $request->type_id,
                    'expenses_currency' => $request->expenses_currency,
                    'expenses_amount' => $request->expenses_amount,
                    'financial_year' => $request->financial_year,
                    'claim_date' => $request->claim_date,
                    'document_file' => $documentFile,
                    'claim_from_month' => $request->claim_from_month,
                    'claim_to_month' => $request->claim_to_month,
                    'reimbursement_notes' => $request->reimbursement_notes,
                    'updated_by' => $user->id,
                ]);
                return $this->responseJson(true, 200, $this->page_name . " Updated Successfully","");

            } catch (Exception $e) {
                return $this->responseJson(false, 200, $e->getMessage());
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
            'reimbursement_reason' => ['nullable','string'],
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
           $reimbursement->approved_at= date('Y-m-d h:i:s');
        }
        if($request->status=='rejected')
        {
           $reimbursement->rejected_at=date('Y-m-d h:i:s');
        }
        $reimbursement->save();
        // return redirect("admin/payroll/reimbursement")->with('status','Add Reimbursement  successfully');
        return $this->responseJson(true,200,ucfirst($request->status).' successfully',$reimbursement);

        // Reimbursement::create($request->all());

        // return response(['success' => 'status created successfully.']);
    }
}

