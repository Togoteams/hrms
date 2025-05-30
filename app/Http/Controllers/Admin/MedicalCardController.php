<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MedicalCard;
use Exception;
use Faker\Provider\Medical;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;


class MedicalCardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public $page_name = "Bomaid Card Type";

    public function index(Request $request)
    { 
        if ($request->ajax()) {
            $data = MedicalCard::all();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn = view('admin.medical_cart.buttons', ['item' => $row, "route" => 'medical-card']);
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
            }
            $currencies =[['slug'=>"pula",'name'=>"Pula",'Symbol'=>"BWP"]];
        return view('admin.medical_cart.index', ['page' => $this->page_name,'currencies'=>$currencies]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|unique:medical_cards,name',
            'amount'=>'required|numeric|gt:0',
            'currency'=>'required',
            'description' => 'required|string',

           
        ]);
        if ($validator->fails()) {
            return $validator->errors();
        } else {
            // $request->request->add(['created_by'=>Auth::user()->id]);
            $request->request->add(['status' =>"active"]);
            MedicalCard::create($request->except('_token'));
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
        $medical = MedicalCard::find($id);
        $currencies =[['slug'=>"pula",'name'=>"Pula",'Symbol'=>"BWP"]];
        return view('admin.medical_cart.edit', ['medical' => $medical, 'page' => $this->page_name,'currencies'=>$currencies]);   
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'amount'=>'required|numeric|gt:0',
            'description' => 'required|string',  
            'currency'=>'required',         
        ]);
        if ($validator->fails()) {
            return $validator->errors();
        } else {
            // $request->request->add(['updated_by'=>Auth::user()->id]);
            MedicalCard::where('id', $id)->update($request->except('_token', '_method'));
            return response()->json(['success' => $this->page_name . " Updated Successfully"]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $medicalCard = MedicalCard::find($id);
           $emp = $medicalCard->empMedical()->delete();
            $medicalCard->delete();
            return "Delete";
        } catch (Exception $e) {
            return response()->json(["error" => $this->page_name . "Can't Be Delete this May having some Employee"]);
        }
    }
}
