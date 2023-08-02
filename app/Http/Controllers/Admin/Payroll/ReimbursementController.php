<?php

namespace App\Http\Controllers\Admin\payroll;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Models\Reimbursement;
use App\Models\ReimbursementType;
use Illuminate\Http\Request;

class ReimbursementController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $page = "Reimbursement";
        $reimbursement = Reimbursement::with('reimbursementype')->get()->toArray();
        // dd($reimbursement)->all();
        return view('admin.payroll.reimbursement.index', compact('page','reimbursement'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $page = "Reimbursement";
        $reimbursementType = ReimbursementType::where('status','0')->get();
        return view('admin.payroll.reimbursement.create',compact('page','reimbursementType'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'type_id' => ['required','numeric'],
            'bill_amount' => ['required','numeric','gt:0'],
            'expenses_date' => ['required', 'date', 'before_or_equal:today'],
            'reimbursement_amount' => ['required','numeric','gt:0'],           
            'reimbursement_notes' => ['required','string'],                      
            // 'status' => ['required','numeric'],
        ]);
        // dd($request->all());
        $reimbursement = new Reimbursement();
        $reimbursement->type_id = $request['type_id'];
        $reimbursement->bill_amount = $request['bill_amount'];
        $reimbursement->expenses_date = $request['expenses_date'];
        $reimbursement->reimbursement_amount = $request['reimbursement_amount'];
        $reimbursement->reimbursement_notes = $request['reimbursement_notes'];
        // $reimbursement->status = $request['status'];
        $reimbursement->save();
        return redirect("admin/payroll/reimbursement")->with('status','Add Reimbursement  successfully');

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
        $page = "Reimbursement";
        $reimbursementType = ReimbursementType::where('status','0')->get();
        $reimbursement = Reimbursement::find($id);
        return view('admin.payroll.reimbursement.edit', compact('page','reimbursement','reimbursementType'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'type_id' => ['required','numeric'],
            'bill_amount' => ['required','numeric'],
            'expenses_date' => ['required','date'],           
            'reimbursement_amount' => ['required','numeric'],           
            'reimbursement_notes' => ['required','string'],                      
            // 'status' => ['required','numeric'],
        ]);
        // dd($request->all());
        $reimbursement = Reimbursement::find($id);
        $reimbursement->type_id = $request['type_id'];
        $reimbursement->bill_amount = $request['bill_amount'];
        $reimbursement->expenses_date = $request['expenses_date'];
        $reimbursement->reimbursement_amount = $request['reimbursement_amount'];
        $reimbursement->reimbursement_notes = $request['reimbursement_notes'];
        // $reimbursement->status = $request['status'];
        $reimbursement->update();
        return redirect("admin/payroll/reimbursement")->with('status','Update Reimbursement  successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $reimbursement = Reimbursement::find($id);
        $reimbursement->delete();
        return redirect()->back()->with('status','Delete successfully');
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

