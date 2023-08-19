<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\OvertimeSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class OvertimeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public $page_name = "Overtime Setting";

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = OvertimeSetting::with('user')->select('*');
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn = view('admin.overtime_settings.buttons', ['item' => $row, "route" => 'overtime-settings']);
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
            }
            
        // $data = OvertimeSetting::all();
        $all_users = Employee::with('user')->get();
        return view('admin.overtime_settings.index', ['page' => $this->page_name,'all_users' => $all_users]);

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
            'emp_id' => 'required|numeric',
            'date' => 'required|date',
            'working_hours' => 'required|numeric|gt:0',
            'working_min' => 'required|numeric|gt:0|max:59',
            'overtime_type' => 'required|string',           
        ]);
        // dd($request->all());
        if ($validator->fails()) {
            return $validator->errors();
        } else {
            // $request->request->add(['created_by'=>Auth::user()->id]);
            $request->request->add(['status' =>"active"]);
            OvertimeSetting::create($request->except('_token'));
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
        $item = OvertimeSetting::find($id);
        $all_users = Employee::with('user')->get();
        return view('admin.overtime_settings.edit', ['item'=>$item,'all_users'=>$all_users,'page' => $this->page_name]);    
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
