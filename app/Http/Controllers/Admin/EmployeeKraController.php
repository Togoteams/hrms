<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\EmployeeKra;
use App\Models\KraAttributes;
use App\Models\Loans;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Exception;
use Illuminate\Support\Facades\Auth;

class EmployeeKraController extends Controller
{
    public $page_name = "Employee Performance";
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, $year = null)
    {

        if ($year == null) {
            $year = date('Y');
        }

        if ($request->ajax()) {
            if(isemplooye())
            {
                $data = EmployeeKra::with('user')->where('user_id',auth()->user()->id)
                ->get();
            }else
            {
                $data = EmployeeKra::with('user')
                ->where('created_at', 'LIKE', '%' . $year . '%')->groupBy('user_id')
                ->get();
            }

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn = view('admin.employees_kra.buttons', ['item' => $row, "route" => 'employee-kra']);
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.employees_kra.index', ['page' => $this->page_name]);
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
        $kra_attributes = KraAttributes::where('deleted_at', null)->get();
        return view('admin.employees_kra.create', compact('all_users', 'kra_attributes', 'page'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'user_id' => 'required|numeric',
            'attribute_name' => 'required|array|min:1',
            'attribute_description' => 'required|array|min:1',
            'commects' => 'required|array|min:1',
            'max_marks' => 'required|array|min:1',
            // 'min_marks' => 'required|array|min:1',
            'marks_by_reporting_autheority' => 'required|array|min:1',
            'marks_by_review_autheority' => 'required|array|min:1',
        ]);
        if ($validator->fails()) {
            return $validator->errors();
        } else {
            try {
                if (isset($request->marks_by_reporting_autheority) && count($request->marks_by_reporting_autheority) > 0) {

                    $is_exits = EmployeeKra::where('user_id', $request->user_id)->where('created_at', date('Y'))->first();
                    if (!$is_exits) {
                        EmployeeKra::where('user_id', $request->user_id)->delete();
                    }


                    for ($i = 0; $i < count($request->marks_by_reporting_autheority); $i++) {

                        $data = [
                            'user_id' => $request->user_id,
                            'employee_id' => Employee::where('user_id', $request->user_id)->first()->id,
                            'attribute_name' => $request->attribute_name[$i],
                            'attribute_description' => $request->attribute_description[$i],
                            'commects' => $request->commects[$i],
                            'max_marks' => $request->max_marks[$i],
                            'min_marks' => $request->min_marks[$i] ?? 0,
                            'marks_by_reporting_autheority' => $request->marks_by_reporting_autheority[$i],
                            'marks_by_review_autheority' => $request->marks_by_review_autheority[$i],
                            'created_by' => Auth::user()->id
                        ];
                        // dd($request);

                        EmployeeKra::create($data);
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
        // $data = EmployeeKra::find($id);
        $data = EmployeeKra::with(['user','employee','employee.branch','employee.designation'])->where('id', $id)->get();

        return view('admin.employees_kra.show', ['data' => $data, 'page' => $this->page_name, 'all_users' => $all_users, 'loans' => $loans]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = EmployeeKra::where('user_id', EmployeeKra::find($id)->user_id)->get();
        $page = $this->page_name;
        return view('admin.employees_kra.edit', compact('data', 'page'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|numeric',
            'loan_id' => 'required|numeric',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'principal_amount' => 'required|numeric',
            'maturity_amount' => 'required|numeric',
            'tenure' => 'required|numeric',
            'sanctioned' => 'required|numeric',
            'sanctioned_amount' => 'required|numeric',
            'description' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return $validator->errors();
        } else {
            try {
                EmployeeKra::where('id', $id)->update($request->except(['_token',  '_method']));
                return response()->json(['success' => $this->page_name . " Updated Successfully"]);
            } catch (Exception $e) {
                return response()->json(['success' => $e->getMessage()]);
            }
        }
    }

    public function status($id)
    {
        if (EmployeeKra::find($id)->status == "active") {
            EmployeeKra::where('id', $id)->update(['status' => 'inactive']);
            return "InActive";
        } else {
            EmployeeKra::where('id', $id)->update(['status' => 'active']);
            return "Active";
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $user =  EmployeeKra::find($id);
            EmployeeKra::destroy($id);
            User::destroy($user->user_id);
            return "Delete";
        } catch (Exception $e) {
            return ["error" => $this->page_name . "Can't Be Delete this May having some Employee"];
        }
    } //

    public function print($user_id)
    {

        $data = EmployeeKra::with(['user','employee','employee.branch','employee.designation'])->where('user_id', $user_id)->get();
        return view('admin.employees_kra.kra_print', compact('data'));
    }
}
