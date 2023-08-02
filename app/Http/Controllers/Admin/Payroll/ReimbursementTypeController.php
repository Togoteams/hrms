<?php

namespace App\Http\Controllers\Admin\payroll;

use App\Http\Controllers\Controller;
use App\Models\ReimbursementType;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class ReimbursementTypeController extends Controller
{
    // public  $page_name =   "Reimbursement Type";

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $page = "Reimbursement Type";
        $reimbursement = ReimbursementType::all();
        return view('admin.payroll.reimbursement_type.index', compact('page','reimbursement'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $page = "Reimbursement Type";
        return view('admin.payroll.reimbursement_type.create',compact('page'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'type' => ['required','string','unique:reimbursement_types,type'],
            // 'slug' => ['required','string'],           
            'status' => ['required','numeric'],
        ]);
        // dd($request->all());
        $reimbursement = new ReimbursementType();
        $reimbursement->type = strtolower($request['type']);
        // $reimbursement->slug = $request['slug'];
        $reimbursement->slug = str::slug($request['type']);
        $reimbursement->status = $request['status'];
        $reimbursement->save();
        return redirect("admin/payroll/reimbursement_type")->with('status','Add Reimbursement Type successfully');


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
        $page = "Reimbursement Type";
        $reimbursement = ReimbursementType::find($id);
        return view('admin.payroll.reimbursement_type.edit', compact('page','reimbursement'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'type' => ['required','string'],
            'status' => ['required','numeric'],
        ]);
        // dd($request->all());
        $reimbursement = ReimbursementType::find($id);
        $reimbursement->type = strtolower($request['type']);
        $reimbursement->slug = str::slug($request['type']);
        $reimbursement->status = $request['status'];
        $reimbursement->update();
        return redirect("admin/payroll/reimbursement_type")->with('status','Update Reimbursement Type successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $reimbursement = ReimbursementType::find($id);
        $reimbursement->delete();
        return redirect()->back()->with('status','Delete successfully');
    }
}
