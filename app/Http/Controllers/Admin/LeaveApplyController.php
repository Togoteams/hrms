<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\Employee;
use App\Models\LeaveApply;
use App\Models\LeaveSetting;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Exception;
use Illuminate\Support\Facades\Auth;
use App\Traits\LeaveTraits;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class LeaveApplyController extends Controller
{
    use LeaveTraits;
    public $page_name = "Apply Leave";
    /**
     * Display a listing of the resource.
     */



    public function index(Request $request)
    {
        if ($request->ajax()) {
            // if user is not equal to employee then show all data
            if (isemplooye()) {
                $data = LeaveApply::with('user','user.employee' ,'leave_type')->where('user_id', Auth::user()->id)->select('*');
            } else {
                $data = LeaveApply::with('user','user.employee', 'leave_type')->select('*');
            }
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn = view('admin.leave_apply.buttons', ['item' => $row, "route" => 'leave_apply']);
                    return $actionBtn;
                })
                ->editColumn('start_date', function ($data) {
                    return \Carbon\Carbon::parse($data->start_date)->isoFormat('DD.MM.YYYY');
                })
                ->editColumn('end_date', function ($data) {
                    return \Carbon\Carbon::parse($data->end_date)->isoFormat('DD.MM.YYYY');
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        if (isemplooye()) {
            $data = LeaveApply::with('user', 'leave_type')->where('user_id', Auth::user()->id)->select('*');
        } else {
            $data = LeaveApply::with('user', 'leave_type')->select('*');
        }
        
        $leave_type = LeaveSetting::where('emp_type',1)->get();
        $all_users = Employee::where('status', 'active')->get();
        // return $leave_type;
        return view('admin.leave_apply.index', [
            'page' => $this->page_name,
            'leave_type' => $leave_type,
            'all_user' => $all_users,
            'data' => $data,


        ]);
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
        $leavSlug = LeaveSetting::find($request->leave_type_id)->slug;

        Validator::extend('no_date_overlap', function ($attribute, $value, $parameters, $validator) {
            $start_date = $validator->getData()['start_date'];
            $end_date = $validator->getData()['end_date'] ?? date('Y-m-d');
            $userId = $validator->getData()['user_id'] ?? "";
            $overlappingRecord =true;
            

            $overlappingRecord = LeaveApply::where(function ($query) use ($start_date, $end_date) {
                $query->where('start_date', '<=', $start_date)
                ->where('end_date', '>=', $end_date);
            })->where('user_id',$userId)->first();
            return !$overlappingRecord;
        });

        Validator::replacer('no_date_overlap', function ($message, $attribute, $rule, $parameters) {
            $value = Str::headline(Str::camel($attribute));
            return "The $value date range overlaps with an existing record.";
        });


        $validator = Validator::make($request->all(), [
            'leave_type_id' => ['required', 'numeric', 'exists:leave_types,id'],
            'start_date' => ['required', 'date','after_or_equal:'.date('Y-m-d'),'no_date_overlap','after:today'],
            'end_date' => ['required', 'date', 'after_or_equal:'.date('Y-m-d'),'no_date_overlap'],
            "doc1" => ["mimetypes:application/pdf", "max:10000"],
            'remaining_leave' =>['required','numeric', Rule::when($leavSlug != 'leave-without-pay', 'min:1')]
        ]);
        if (isset($request->user_id) && $request->user_id != '') {
            $user = User::find($request->user_id);
        } else {
            $user = Auth::user();
        }
        if (($this->balance_leave_by_type($request->leave_type_id, $user->id) >= $request->leave_applies_for)  || $leavSlug=="leave-without-pay" ) {
            if ($validator->fails()) {
                return $validator->errors();
            } else {
                try {
                    // return response()->json(['error' => "Something wrong heppend"]);

                    $request->request->add([
                        'doc' => $request->has('doc1') ? $this->insert_image($request->file('doc1'), 'leave_doc') : '',
                        'uuid' => $user->uuid,
                        'user_id' => $user->id,
                        'created_by' => Auth::user()->id,
                        'is_paid' => getPaidString(LeaveSetting::find($request->leave_type_id)->is_salary_deduction),
                        'is_leave_counted_on_holiday' => (LeaveSetting::find($request->leave_type_id)->is_count_holyday),
                        'remaining_leave' => (int)$this->balance_leave_by_type($request->leave_type_id, $user->id) - $request->leave_applies_for

                    ]);
                    LeaveApply::insertGetId($request->except(['_token', 'doc1', '_method']));
                    return response()->json(['success' => $this->page_name . " Added Successfully"]);
                } catch (Exception $e) {
                    return response()->json(['error' => $e->getMessage()]);
                }
            }
        } else {
            return response()->json(['error' => "You have Applied Maximum number of leave"]);
        }
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $leave_type = LeaveSetting::get();

        $data = LeaveApply::find($id);
        return view('admin.leave_apply.show', ['data' => $data, 'page' => $this->page_name, 'leave_type' => $leave_type]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

        $data = LeaveApply::find($id);
        $leave_type = LeaveSetting::where('emp_type', getEmpType(Employee::where('user_id', $data->user_id)->first()->employment_type) ?? '')->get();
        // ret
        return view('admin.leave_apply.edit', ['data' => $data, 'page' => $this->page_name, 'leave_type' => $leave_type]);
    }

    public function status_modal($id)
    {
        $leave_type = LeaveSetting::get();

        $data = LeaveApply::find($id);
        $leave_emp_data=LeaveApply::where('start_date','>=',$data->start_date)->Where('end_date','<=',$data->end_date)->where('status','approved')->get();
       
        $remaining_leave =  $this->balance_leave_by_type($data->leave_type_id, $data->user_id );
        // echo $data->leave_type_id."echo ";
        // echo $data->user_id."echo ";
        // return $remaining_leave;
        return view('admin.leave_apply.status', ['data' => $data, 'page' => $this->page_name, 'leave_type' => $leave_type, 'remaining_leave' => $remaining_leave,'leave_emp_data'=>$leave_emp_data]);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'leave_type_id' => ['required', 'numeric'],
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date'],
            "doc1" => ["mimetypes:application/pdf", "max:10000"]

        ]);

        if ($validator->fails()) {
            return $validator->errors();
        } else {
            try {
                $request->request->add([
                    'updated_by' => Auth::user()->id,
                    'is_paid' => LeaveSetting::find($request->leave_type_id)->nature_of_leave,

                ]);
                LeaveApply::where('id', $id)->update($request->except(['_token',  '_method', 'doc1']));
                $request->has('doc1') ? $this->update_images('leave_applies', $id, $request->file('doc1'), 'leave_doc', 'doc') : LeaveApply::find($id)->doc;
                return response()->json(['success' => $this->page_name . " Updated Successfully"]);
            } catch (Exception $e) {
                return response()->json(['error' => $e->getMessage()]);
            }
        }
    }

    public function status(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'remaining_leave' => ['required', 'numeric', 'min:1'],
            'status' => ['required', 'string'],
            'status_remarks' => ['required', 'string'],

        ]);

        if ($validator->fails()) {
            return $validator->errors();
        } else {
            $leave_apply = LeaveApply::find($id);


            try {
                if ($request->status != "approved") {
                   
                    LeaveApply::where('id', $id)->update([
                        'status' => $request->status,

                        'status_remarks' => $request->status_remarks,
                        'remaining_leave' =>   (int)$this->balance_leave_by_type($leave_apply->leave_type_id, $leave_apply->user_id),

                    ]);
                }
                if ($request->status == "approved") {

                    // checking how many leave is remaining for a particular user

                    if ($this->balance_leave_by_type($leave_apply->leave_type_id, $leave_apply->user_id,'update_status') >= get_day($leave_apply->start_date, $leave_apply->end_date)) {
                       

                        LeaveApply::where('id', $id)->update([
                            'status_remarks' => $request->status_remarks,
                            'status' => $request->status,
                            'remaining_leave' =>   (int)$this->balance_leave_by_type($leave_apply->leave_type_id, $leave_apply->user_id),
                        ]);
                    } else {
                        return response()->json(['error' => " Applied leave is " . get_day($leave_apply->start_date, $leave_apply->end_date)+1 . " but  they have only " . $this->balance_leave_by_type($leave_apply->leave_type_id, $leave_apply->user_id) . " leave"]);
                    }
                }
                return response()->json(['success' => $this->page_name . " Updated Successfully"]);
            } catch (Exception $e) {
                return response()->json(['errors' => "Somthing wen Wrong"]);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $user =  LeaveApply::find($id);
            LeaveApply::destroy($id);
            User::destroy($user->user_id);
            return "Delete";
        } catch (Exception $e) {
            return ["error" => $this->page_name . "Can't Be Delete this May having some Employee"];
        }
    }
    public function get_leave(Request $request)
    {
        $user_id = $request->user_id;
        // echo Employee::where('user_id', $user_id)->first()->employment_type;
        $leave_type = LeaveSetting::where('emp_type',getEmpType(Employee::where('user_id', $user_id)->first()->employment_type))->get();
        // return $leave_type;
        echo '<option> -Select Leave Type - </option>';
        foreach ($leave_type as $l_type) {
            echo '  <option value="' . $l_type->id . '">' . $l_type->name . '</option>';
        }
    }

    public function get_balance_leave(Request $request)
    {
        $remaining_leave = 0;

        $remaining_leave = $this->balance_leave_by_type($request->leave_type_id, $request->user_id);

        return $remaining_leave;
    }


    public function balance_history(Request $request)
    {

        if ($request->ajax()) {
            // if user is not equal to employee then show all data
            if (isemplooye()) {
                $data = LeaveApply::with('user', 'user.employee','leave_type')->where('user_id', Auth::user()->id)->where('leave_applies.status', 'approved')->select('*');
            } else {
                $data = LeaveApply::with('user','user.employee', 'leave_type')->where('leave_applies.status', 'approved')->select('*');
            }
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn = view('admin.leave_apply.buttons', ['item' => $row, "route" => 'leave_apply']);
                    return $actionBtn;
                })
                ->editColumn('start_date', function ($data) {
                    return \Carbon\Carbon::parse($data->start_date)->isoFormat('DD.MM.YYYY');
                })
                ->editColumn('end_date', function ($data) {
                    return \Carbon\Carbon::parse($data->end_date)->isoFormat('DD.MM.YYYY');
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        $leave_type = LeaveSetting::get();
        $all_users = Employee::where('status', 'active')->get();
        return view('admin.leave_apply.leave_balance_history', ['page' => 'Balance Reports', 'leave_type' => $leave_type, 'all_user' => $all_users]);
    }


    public function request_history(Request $request)
    {
        if ($request->ajax()) {
            // if user is not equal to employee then show all data
            if (isemplooye()) {
                $data = LeaveApply::with('user', 'leave_type','user.employee')->where('user_id', Auth::user()->id)->where('status', 'pending')->get();
            } else {
                $data = LeaveApply::with('user', 'leave_type','user.employee')->where('status', 'pending')->get();
            }
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn = view('admin.leave_apply.buttons', ['item' => $row, "route" => 'leave_apply']);
                    return $actionBtn;
                })
                ->editColumn('start_date', function ($data) {
                    return \Carbon\Carbon::parse($data->start_date)->isoFormat('DD.MM.YYYY');
                })
                ->editColumn('end_date', function ($data) {
                    return \Carbon\Carbon::parse($data->end_date)->isoFormat('DD.MM.YYYY');
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        $leave_type = LeaveSetting::get();
        $all_users = Employee::where('status', 'active')->get();
        return view('admin.leave_apply.leave_request_history', ['page' => 'Request History', 'leave_type' => $leave_type, 'all_user' => $all_users]);
    }

    public function get_rejected_leave(Request $request)
    {
        if ($request->ajax()) {
            // if user is not equal to employee then show all data
            if (isemplooye()) {
                $data = LeaveApply::with('user', 'leave_type')->where('user_id', Auth::user()->id)->where('status', 'reject')->get();
            } else {
                $data = LeaveApply::with('user', 'leave_type')->where('status', 'reject')->get();
            }
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn = view('admin.leave_apply.buttons', ['item' => $row, "route" => 'leave_apply']);
                    return $actionBtn;
                })
                ->editColumn('start_date', function ($data) {
                    return \Carbon\Carbon::parse($data->start_date)->isoFormat('DD.MM.YYYY');
                })
                ->editColumn('end_date', function ($data) {
                    return \Carbon\Carbon::parse($data->end_date)->isoFormat('DD.MM.YYYY');
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        $leave_type = LeaveSetting::get();
        $all_users = Employee::where('status', 'active')->get();
        return view('admin.leave_apply.leave_request_rejected', ['page' => 'Request History', 'leave_type' => $leave_type, 'all_user' => $all_users]);
    }
}
