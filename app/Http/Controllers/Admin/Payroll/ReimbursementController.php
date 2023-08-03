<?php

namespace App\Http\Controllers\Admin\payroll;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Models\Reimbursement;
use App\Models\ReimbursementType;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ReimbursementController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public $page_name = "Reimbursement";
    public function index()
    {
        $page = "Reimbursement";
        $reimbursement = Reimbursement::with('reimbursementype')->get()->toArray();
        $reimbursementType = ReimbursementType::where('status','active')->get();
        // dd($reimbursement)->all();
        return view('admin.payroll.reimbursement.index', compact('page','reimbursement','reimbursementType'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // $page = "Reimbursement";
        // $reimbursementType = ReimbursementType::where('status','0')->get();
        // return view('admin.payroll.reimbursement.create',compact('page','reimbursementType'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'type_id' => 'required|numeric',
            'bill_amount' => 'required|numeric|gt:0',
            'expenses_date' => 'required|date|before_or_equal:today',
            'reimbursement_amount' => 'required|numeric|gt:0',
            'reimbursement_notes' => 'required|string',

        ]);

        if ($validator->fails()) {
            return $validator->errors();
        } else {
            try {
                $request->request->add(['created_at' => Auth::user()->id]);
                Reimbursement::insertGetId($request->except(['_token', '_method']));
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // $reimbursementType = ReimbursementType::where('status','0')->get();
        // $reimbursement = Reimbursement::find($id);
        // return view('admin.payroll.reimbursement.edit', compact('page','reimbursement','reimbursementType'));
        
        $reimbursementType = ReimbursementType::where('status','active')->get();
        $reimbursement = Reimbursement::find($id);
        return view('admin.payroll.reimbursement.edit', ['reimbursement' => $reimbursement, 'reimbursementType' => $reimbursementType, 'page' => $this->page_name]);    
    }

    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'type_id' => 'required|numeric',
            'bill_amount' => 'required|numeric|gt:0',
            'expenses_date' => 'required|date|before_or_equal:today',
            'reimbursement_amount' => 'required|numeric|gt:0',
            'reimbursement_notes' => 'required|string',
        ]);
        if ($validator->fails()) {
            return $validator->errors();
        } else {
            // $request->request->add(['updated_by'=>Auth::user()->id]);
            Reimbursement::where('id', $id)->update($request->except('_token', '_method'));
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
        ]);
                // dd($request->all());
        $reimbursement = Reimbursement::find($request->payroll_id);
        $reimbursement->reimbursement_reason = $request['reimbursement_reason'];
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

