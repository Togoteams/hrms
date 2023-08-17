<?php

namespace App\Http\Controllers\Admin\payroll;

use App\Http\Controllers\Controller;
use App\Models\ReimbursementType;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Yajra\DataTables\Contracts\DataTable;
use Yajra\DataTables\Facades\DataTables;

class ReimbursementTypeController extends Controller
{
    // public  $page_name =   "Reimbursement Type";

    /**
     * Display a listing of the resource.
     */
    public $page_name = "Reimbursement Type";

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = ReimbursementType::all();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn = view('admin.payroll.reimbursement_type.buttons', ['item' => $row, "route" => 'payroll.reimbursement_type']);
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
            }
        return view('admin.payroll.reimbursement_type.index', ['page' => $this->page_name]);

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
        $validator = Validator::make($request->all(), [
            'type' => 'required|string|unique:reimbursement_types,type',
           
        ]);
        if ($validator->fails()) {
            return $validator->errors();
        } else {
            $request->request->add(['created_by'=>Auth::user()->id]);
            $request->request->add(['status' =>"active"]);
            $request->request->add(['slug' =>Str::slug($request->type,"_")]);
            ReimbursementType::create($request->except('_token'));
            return response()->json(['success' => $this->page_name . " Added Successfully"]);
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
        // $page = "Reimbursement Type";
        // $reimbursement = ReimbursementType::find($id);
        // return view('admin.payroll.reimbursement_type.edit', compact('page','reimbursement'));

        $reimbursement = ReimbursementType::find($id);
        return view('admin.payroll.reimbursement_type.edit', ['reimbursement' => $reimbursement, 'page' => $this->page_name]);   
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'type' => 'required|string|unique:reimbursement_types,type,'.$id,
           
        ]);
        if ($validator->fails()) {
            return $validator->errors();
        } else {
            $request->request->add(['slug' =>Str::slug($request->type,"_")]);
            // $request->request->add(['updated_by'=>Auth::user()->id]);
            ReimbursementType::where('id', $id)->update($request->except('_token', '_method'));
            return response()->json(['success' => $this->page_name . " Updated Successfully"]);
        }
       
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            ReimbursementType::destroy($id);
            return "Delete";
        } catch (Exception $e) {
            return response()->json(["error" => $this->page_name . "Can't Be Delete this May having some Employee"]);
        }
    }

}
