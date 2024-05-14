<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Models\CurrentLeave;
use App\Models\EmpCurrentLeave;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\Employee;
use App\Models\LeaveApply;
use App\Models\LeaveDate;
use App\Models\LeaveSetting;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Exception;
use Illuminate\Support\Facades\Auth;
use App\Traits\LeaveTraits;
use App\Traits\NotificationTraits;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class LeaveApplyController extends BaseController
{
    use LeaveTraits;
    use NotificationTraits;
    public $page_name = "Apply Leave";
    public $overLapsLeave = "";
    /**
     * Display a listing of the resource.
     */

    public function index(Request $request)
    {
        if ($request->ajax()) {
            // if user is not equal to employee then show all data
            if (isemplooye()) {
                $data = LeaveApply::with('user', 'user.employee', 'leave_type')->where('user_id', Auth::user()->id)->select('*');
            } else {
                $data = LeaveApply::with('user', 'user.employee', 'leave_type')->select('*');
            }
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn = view('admin.leave_apply.buttons', ['item' => $row, "route" => 'leave_apply']);
                    return $actionBtn;
                })
                ->editColumn('start_date', function ($data) {
                    return \Carbon\Carbon::parse($data->start_date)->isoFormat('DD-MM-YYYY');
                })
                ->editColumn('end_date', function ($data) {
                    return \Carbon\Carbon::parse($data->end_date)->isoFormat('DD-MM-YYYY');
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        $leaveHideArr = ['maternity-leave'];

        if (isemplooye()) {
            $data = LeaveApply::with('user', 'leave_type')->where('user_id', Auth::user()->id)->select('*');
            $leave_type = LeaveSetting::where('emp_type', getEmpType(Employee::where('user_id', Auth::user()->id)->first()->employment_type))->whereNotIn('slug', $leaveHideArr)->get();
        } else {
            $data = LeaveApply::with('user', 'leave_type')->select('*');
            $leave_type = LeaveSetting::where('emp_type', 1)->whereNotIn('slug', $leaveHideArr)->get();
        }

        $all_users = Employee::getActiveEmp()->get();
        $allowedRoles = ['managing-director', 'chief-manager-ho', 'branch-head', 'branch-supervisor'];

        $approvalAuthority = Employee::getActiveEmp()->whereHas('user.roles', function ($q) use ($allowedRoles) {
            $q->whereIn('slug', $allowedRoles);
        })->get();
        // return $leave_type;
        return view('admin.leave_apply.index', [
            'page' => $this->page_name,
            'leave_type' => $leave_type,
            'all_user' => $all_users,
            'approvalAuthority' => $approvalAuthority,
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
        // return $request->all();
        /**
         * Vaidation for specail leave like, maternity-leave,bereavement-leave
         */
        if (isset($request->user_id) && $request->user_id != '') {
            $user = User::find($request->user_id);
        } else {
            $user = Auth::user();
        }
        $request->merge(['user_id'=>$user->id]);
        $leaveType = LeaveSetting::find($request->leave_type_id);
        $leaveSlug = $leaveType?->slug;
        $employee = Employee::where('user_id', $user->id)->first();
        $roleSlug = $employee?->user?->role_slug;
        Validator::extend('no_date_overlap', function ($attribute, $value, $parameters, $validator) {
            $data = $validator->getData();
            $start_date = $data['start_date'];
            $end_date = $data['end_date'];
            $userId = $data['user_id'] ?? auth()->id();
        
            // Query for overlapping leave records
            $overlappingRecord = LeaveApply::where('user_id', $userId)
                ->where(function ($query) use ($start_date, $end_date) {
                    $query->where(function ($q) use ($start_date, $end_date) {
                        $q->whereBetween('start_date', [$start_date, $end_date])
                            ->orWhereBetween('end_date', [$start_date, $end_date]);
                    })
                    ->orWhere(function ($q) use ($start_date, $end_date) {
                        $q->where('start_date', '<=', $start_date)
                            ->where('end_date', '>=', $end_date);
                    });
                })
                ->whereNotIn('status', ['reject'])
                ->orderByDesc('id')
                ->first();
        
            // Set overlapping leave name for reference
            $this->overLapsLeave = optional($overlappingRecord?->leave_type)->name;
        
            // Return validation result
            return !$overlappingRecord;
        });
        Validator::replacer('no_date_overlap', function ($message, $attribute, $rule, $parameters) {
            $value = Str::headline(Str::camel($attribute));
            $leaveName = $this->overLapsLeave;
            return " $value   overlaps with  $leaveName .";
        });

        

        Validator::extend('sick_leave_document', function ($attribute, $value, $parameters, $validator) {
            $userId = $validator->getData()['user_id'] ?? "";
            $doc1 = $validator->getData()['doc1'] ?? "";
            $leaveType = LeaveSetting::find($validator->getData()['leave_type_id'] ?? "");
            $leaveSlug = $leaveType->slug;
            if (isset($userId) && $userId != '') {
                $user = User::find($userId);
            } else {
                $user = Auth::user();
            }
            $employment_type = "";
            $employment_type = $user?->employee?->employment_type;

            $leave_applies_for = $validator->getData()['leave_applies_for'] ?? "";
            $sickDocumentNeed = false;
            if (empty($doc1) && $leaveSlug == ('bereavement-leave' || 'sick-leave')) {
                if ($employment_type == "expatriate" &&  $leave_applies_for == 2) {
                    $sickDocumentNeed = true;
                } elseif ($employment_type == "local") {
                    $sickDocumentNeed = true;
                }
            }

            return !$sickDocumentNeed;
        });

        Validator::replacer('sick_leave_document', function ($message, $attribute, $rule, $parameters) {
            $value = Str::headline(Str::camel($attribute));
            return "The $value docuement is required.";
        });

        $request->validate([
                'leave_type_id' => ['required', 'numeric', 'exists:leave_settings,id'],
                'user_id' => ['required', 'numeric', 'exists:users,id'],
                'leave_reason' => ['required', 'string'],
                'start_date' => ['required', 'date', 'no_date_overlap', 'after_or_equal:' . $employee?->start_date],
                'end_date' => ['required', 'date', 'no_date_overlap', 'after_or_equal:start_date'],
                'approval_authority' => [ Rule::when($roleSlug != ('managing-director'), 'required'),'numeric', 'exists:employees,user_id'],
                "doc1" => ["mimetypes:application/pdf", "max:10000", 'nullable', 'sick_leave_document'],
                'leave_applies_for' => ['required', 'numeric', Rule::when($leaveSlug == ('bereavement-leave'), 'max:3')],
                'remaining_leave' => ['required', 'numeric', Rule::when($leaveSlug != ('leave-without-pay' || 'bereavement-leave' || 'maternity-leave'), 'min:1')]
            ],
            [
                'start_date.after_or_equal' => 'You cannot apply for leave before the date of joining.'
            ]
        );
      
        // if ($validator->fails()) {
        //     return $validator->errors();
        // }

        if ((getAvailableLeaveCount($request->leave_type_id, $user->id) >= $request->leave_applies_for)  || $leaveSlug == "leave-without-pay" || $leaveSlug == "maternity-leave" || $leaveSlug == "bereavement-leave") {
            // if ($validator->fails()) {
            //     return $validator->errors();
            // } else {
                try {
                    // return response()->json(['error' => "Something wrong heppend"]);
                    $remainingLeave = (int)getAvailableLeaveCount($request->leave_type_id, $user->id);
                    $balanceLeaveHideArr = ['leave-without-pay', 'bereavement-leave'];

                    if (!in_array($leaveSlug, $balanceLeaveHideArr)) {
                        $remainingLeave = $remainingLeave -  $request->leave_applies_for;
                    }

                    $allDate = getAllDates($request->start_date, $request->end_date);
                    $request->request->add([
                        'doc' => $request->has('doc1') ? $this->insert_image($request->file('doc1'), 'leave_doc') : '',
                        'uuid' => $user->uuid,
                        'user_id' => $user->id,
                        'created_by' => Auth::user()->id,
                        'is_paid' => getPaidString(LeaveSetting::find($request->leave_type_id)->is_salary_deduction),
                        'is_leave_counted_on_holiday' => (LeaveSetting::find($request->leave_type_id)->is_count_holyday),
                        'remaining_leave' => $remainingLeave
                    ]);
                    $leaveId  =  LeaveApply::insertGetId($request->except(['_token', 'doc1', '_method', 'leave_id', 'description_reason']));

                    foreach ($allDate as $date) {
                        $isHoliday = isHolidayDate($date);
                        $payType = $request->pay_type ?? "";
                        $leaveDate = LeaveDate::create(['leave_id' => $leaveId, 'leave_date' => $date, 'is_holiday' => $isHoliday, 'pay_type' => $payType]);
                    }
                    return $this->responseJson(true,200,$this->page_name . " Added Successfully",$leaveDate);
                    // return response()->json(['success' => $this->page_name . " Added Successfully", 'status' => true]);
                } catch (Exception $e) {
                    return $this->responseJson(false,200,$e->getMessage());

                    // return response()->json(['error' => $e->getMessage()]);
                }
            // }
        } else {
            return $this->responseJson(false,200,"You have Applied Maximum number of leave",[]);

            // return response()->json(['error' => "You have Applied Maximum number of leave"]);
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

        $allowedRoles = ['managing-director', 'chief-manager-ho', 'branch-head', 'branch-supervisor'];

        $approvalAuthority = Employee::getActiveEmp()->whereHas('user.roles', function ($q) use ($allowedRoles) {
            $q->whereIn('slug', $allowedRoles);
        })->get();
        $data = LeaveApply::find($id);
        $leaveHideArr = ['maternity-leave'];
        $leave_type = LeaveSetting::where('emp_type', getEmpType(Employee::where('user_id', $data->user_id)->first()->employment_type) ?? '')->whereNotIn('slug', $leaveHideArr)->get();
        // ret
        return view('admin.leave_apply.edit', ['data' => $data, 'page' => $this->page_name, 'approvalAuthority' => $approvalAuthority, 'leave_type' => $leave_type]);
    }

    public function status_modal($id)
    {

        $data = LeaveApply::find($id);
        $leave_type = LeaveSetting::find($data->leave_type_id);
        // $balanceLeaveHideArr =['leave-without-pay','bereavement-leave'];
        // if(!in_array($leaveSlug,$balanceLeaveHideArr))
        // {
        //     $remainingLeave = $remainingLeave -  $request->leave_applies_for;
        // }
        $leave_emp_data = LeaveApply::where('start_date', '>=', $data->start_date)->Where('end_date', '<=', $data->end_date)
            ->where('status', 'approved')
            ->get();

        $remaining_leave =  getAvailableLeaveCount($data->leave_type_id, $data->user_id);
        // echo $data->leave_type_id."echo ";
        // echo $data->user_id."echo ";
        // return $remaining_leave;
        return view('admin.leave_apply.status', ['data' => $data, 'page' => $this->page_name, 'leave_type' => $leave_type, 'remaining_leave' => $remaining_leave, 'leave_emp_data' => $leave_emp_data]);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $leaveApplies = LeaveApply::find($id);
        $leaveType = LeaveSetting::find($leaveApplies->leave_type_id);
        $leaveSlug = $leaveType->slug;
        $request->merge(['id' => $id, 'leave_type_id' => $leaveApplies->leave_type_id, 'remaining_leave' => $leaveApplies->remaining_leave]);
        // return  $request->id;
        $user_id = $request->user_id;
        Validator::extend('no_date_overlap', function ($attribute, $value, $parameters, $validator) {
            $data = $validator->getData();
            $start_date = $data['start_date'];
            $end_date = $data['end_date'];
            $edit_id = $data['id'] ?? null;
            $userId = $data['user_id'] ?? auth()->id();
        
            // Query for overlapping leave records
            $overlappingRecord = LeaveApply::where('user_id', $userId)
                ->where(function ($query) use ($start_date, $end_date) {
                    $query->whereBetween('start_date', [$start_date, $end_date])
                        ->orWhereBetween('end_date', [$start_date, $end_date])
                        ->orWhere(function ($q) use ($start_date, $end_date) {
                            $q->where('start_date', '<=', $start_date)
                                ->where('end_date', '>=', $end_date);
                        });
                })
                ->whereNotIn('status', ['reject'])
                ->orderByDesc('id')
                ->when($edit_id, function ($query) use ($edit_id) {
                    $query->where('id', '!=', $edit_id);
                })
                ->first();
        
            // Set overlapping leave name for reference
            $this->overLapsLeave = optional($overlappingRecord->leaveSetting)->name;
        
            // Return validation result
            return !$overlappingRecord;
        });

        Validator::replacer('no_date_overlap', function ($message, $attribute, $rule, $parameters) {
            $value = Str::headline(Str::camel($attribute));
            $leaveName = $this->overLapsLeave;
            return " $value   overlaps with  $leaveName .";
        });

        $employee = Employee::where('user_id', $request->user_id)->first();
        $validator = Validator::make($request->all(), [
            'leave_type_id' => ['required', 'numeric', 'exists:leave_settings,id'],
            'start_date' => ['required', 'date', 'no_date_overlap', 'after_or_equal:' . $employee->start_date],
            'end_date' => ['required', 'date', 'no_date_overlap', 'after_or_equal:start_date'],
            "doc1" => ["mimetypes:application/pdf", "max:10000", 'nullable', 'sick_leave_document'],
            'leave_applies_for' => ['nullable', 'numeric', Rule::when($leaveSlug == ('bereavement-leave'), 'max:3')],
            'remaining_leave' => ['required', 'numeric', Rule::when($leaveSlug != ('leave-without-pay' || 'bereavement-leave' || 'maternity-leave'), 'min:1')]
        ]);

        if ($validator->fails()) {
            return $validator->errors();
        } else {
            try {
                // return "dda";
                $remainingLeave = (int)getAvailableLeaveCount($leaveApplies->leave_type_id, $user_id);
                $balanceLeaveHideArr = ['leave-without-pay', 'bereavement-leave'];
                if (!in_array($leaveSlug, $balanceLeaveHideArr)) {
                    $remainingLeave = $remainingLeave -  $request->leave_applies_for;
                }
                // return $remainingLeave;

                $request->request->add([
                    'updated_by' => Auth::user()->id,
                    'is_paid' => getPaidString(LeaveSetting::find($leaveApplies->leave_type_id)->is_salary_deduction),
                    'is_leave_counted_on_holiday' => (LeaveSetting::find($leaveApplies->leave_type_id)->is_count_holyday),
                    'remaining_leave' => $remainingLeave
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
        $leaveType = LeaveSetting::find($request->leave_type_id);
        $leaveSlug = $leaveType->slug;

        $validator = Validator::make($request->all(), [
            // 'remaining_leave' => ['numeric', Rule::when($leaveSlug != 'leave-without-pay' && $leaveSlug != 'bereavement-leave', 'required', 'min:1')],
            'status' => ['required', 'string'],
            'status_remarks' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return $validator->errors();
        }

        $leave_apply = LeaveApply::find($id);

        if ($request->status != "approved") {
            LeaveApply::where('id', $id)->update([
                'status' => $request->status,
                'status_remarks' => $request->status_remarks,
                'remaining_leave' => (int)getAvailableLeaveCount($leave_apply->leave_type_id, $leave_apply->user_id),
            ]);
            $this->saveNotification([
                'reference_id' => $id,
                'user_id' => $leave_apply->user_id,
                'reference_type' => get_class($leave_apply),
                'notification_type' => 'leave_rejected',
                'title' => "Leave Rejected",
                'description' => "Dear " . $leave_apply->user->name . " Your " . $leave_apply->leave_type->name . " is Rejected On Date " . date("d-m-Y", strtotime($leave_apply->start_date)) . " between " . date("d-m-Y", strtotime($leave_apply->end_date)),
            ]);
        }

        if ($request->status == "approved") {
            $balanceLeaveHideArr = ['leave-without-pay', 'bereavement-leave'];
            $isIgnoreBalanced = in_array($leaveSlug, $balanceLeaveHideArr) ? 1 : 0;
            
            if ((getAvailableLeaveCount($leave_apply->leave_type_id, $leave_apply->user_id, 'update_status') >= get_day($leave_apply->start_date, $leave_apply->end_date)) || $isIgnoreBalanced) {
                
                LeaveApply::where('id', $id)->update([
                    'status_remarks' => $request->status_remarks,
                    'status' => $request->status,
                    'approved_at' => now(),
                    'approved_by' => auth()->id(),
                    'is_approved' => 1,
                    'remaining_leave' => (int)getAvailableLeaveCount($leave_apply->leave_type_id, $leave_apply->user_id),
                ]);
                $currentLeave = EmpCurrentLeave::where('user_id',$leave_apply->user_id)->where('leave_type_id',$leave_apply->leave_type_id)->first();
                $currentLeaveCount = $currentLeave?->leave_count ?? 0;
                $appliedLeaveCount = $leave_apply->leaveDate()->count();
                
                if($currentLeaveCount >=$appliedLeaveCount)
                {
                    $remaining_leave = $currentLeaveCount - $appliedLeaveCount;

                    $currentLeave->update(['leave_count'=>$remaining_leave]);
                }else
                {
                    return response()->json([
                        'error' => "Leave Approval Failed: Insufficient Leave Balance. You currently have ".$currentLeaveCount." leave remaining."
                    ]);      
                }
                $this->saveNotification([
                    'reference_id' => $id,
                    'reference_type' => get_class($leave_apply),
                    'user_id' => $leave_apply->user_id,
                    'notification_type' => 'leave_approval',
                    'title' => "Leave Approved",
                    'description' => "Dear " . $leave_apply->user->name . " Your " . $leave_apply->leave_type->name . " is Approved On Date " . date("d-m-Y", strtotime($leave_apply->start_date)) . " between " . date("d-m-Y", strtotime($leave_apply->end_date)),
                ]);
            } else {
                return response()->json(['error' => "Applied leave is " . (get_day($leave_apply->start_date, $leave_apply->end_date) + 1) . " but they have only " . getAvailableLeaveCount($leave_apply->leave_type_id, $leave_apply->user_id) . " leave"]);
            }
        }

        return response()->json(['success' => $this->page_name . " Updated Successfully"]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {

            $leave =  LeaveApply::find($id);
            $leave->leaveDate()->delete();
            $leave->delete();
            // LeaveApply::destroy($id);
            // User::destroy($user->user_id);
            return "Delete";
        } catch (Exception $e) {
            return ["error" => $this->page_name . "Can't Be Delete this May having some Employee"];
        }
    }
    public function get_leave(Request $request)
    {
        $user_id = $request->user_id;
        $leaveHideArr = ['maternity-leave'];

        // echo Employee::where('user_id', $user_id)->first()->employment_type;
        $leave_type = LeaveSetting::where('emp_type', getEmpType(Employee::where('user_id', $user_id)->first()->employment_type))->whereNotIn('slug', $leaveHideArr)->get();
        // return $leave_type;
        echo '<option> -Select Leave Type - </option>';
        foreach ($leave_type as $l_type) {
            echo '  <option value="' . $l_type->id . '" data-leave-slug="' . $l_type->slug . '" >' . $l_type->name . '</option>';
        }
    }
    public function get_approval_authority(Request $request)
    {
        $user_id = $request->user_id;

        $allowedRoles = ['managing-director', 'chief-manager-ho', 'branch-head', 'branch-supervisor'];
        $employee =  Employee::where('user_id', $user_id)->first();
        if($employee->user->role_slug=="managing-director")
        {
            return response()->json(['status' => false, 'data' => []]);
        }
        $approvalAuthority = Employee::getActiveEmp()->with('user')->whereHas('user.roles', function ($q) use ($allowedRoles) {
            $q->whereIn('slug', $allowedRoles);
        })->whereNotIn('user_id', [$user_id])->get();
        // return $leave_type;
        // $data = '<option> -Select Leave Type - </option>';
        // foreach ($approvalAuthority as $l_type) {
        //     $data .= '  <option value="' . $l_type->user_id . '" >' . $l_type->user->name . '</option>';
        // }
        return response()->json(['status' => true, 'data' => $approvalAuthority]);
    }

    public function get_balance_leave(Request $request)
    {
        $remaining_leave = 0;
        $userId = $request->user_id ?? auth()->user()->id;
        $remaining_leave = EmpCurrentLeave::where('user_id', $userId)->where('leave_type_id', $request->leave_type_id)->value('leave_count') ?? 0;
        $leave_type = LeaveSetting::find($request->leave_type_id);
        $leave_type_slug = $leave_type->slug;
        $balanceLeaveHideArr = ['leave-without-pay', 'bereavement-leave'];
        $isBalanceLeaveHide = false;
        $isIboSickLeave = false;

        // return $leave_type_slug;

        if (in_array($leave_type_slug, $balanceLeaveHideArr)) {
            $isBalanceLeaveHide = true;
        }
        if (!empty($leave_type) && $leave_type->emp_type == 0 &&  $leave_type->slug == "sick-leave") {
            $isIboSickLeave = true;
        }
        return response()->json(['status' => true, 'data' => ['remaining_leave' => $remaining_leave, 'leave_type_slug' => $leave_type_slug, 'is_ibo_sick_leave' => $isIboSickLeave, 'is_balance_leave_hide' => $isBalanceLeaveHide]]);
        // return $remaining_leave;
    }


    public function balance_history(Request $request)
    {

        if ($request->ajax()) {
            // if user is not equal to employee then show all data
            if (isemplooye()) {
                $data = LeaveApply::with('user', 'user.employee', 'leave_type')->where('user_id', Auth::user()->id)->where('leave_applies.status', 'approved')->select('*');
            } else {
                $data = LeaveApply::with('user', 'user.employee', 'leave_type')->where('leave_applies.status', 'approved')->select('*');
            }
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn = view('admin.leave_apply.buttons', ['item' => $row, "route" => 'leave_apply']);
                    return $actionBtn;
                })
                ->editColumn('start_date', function ($data) {
                    return \Carbon\Carbon::parse($data->start_date)->isoFormat('DD-MM-YYYY');
                })
                ->editColumn('end_date', function ($data) {
                    return \Carbon\Carbon::parse($data->end_date)->isoFormat('DD-MM-YYYY');
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        $leave_type = LeaveSetting::get();
        $all_users = Employee::getActiveEmp()->get();
        return view('admin.leave_apply.leave_balance_history', ['page' => 'Balance Reports', 'leave_type' => $leave_type, 'all_user' => $all_users]);
    }


    public function request_history(Request $request)
    {
        if ($request->ajax()) {
            // if user is not equal to employee then show all data
            if (isemplooye()) {
                $data = LeaveApply::with('user', 'leave_type', 'user.employee')->where('user_id', Auth::user()->id)->where('status', 'pending')->get();
            } else {
                $data = LeaveApply::with('user', 'leave_type', 'user.employee')->where('status', 'pending')->get();
            }
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn = view('admin.leave_apply.buttons', ['item' => $row, "route" => 'leave_apply']);
                    return $actionBtn;
                })
                ->editColumn('start_date', function ($data) {
                    return \Carbon\Carbon::parse($data->start_date)->isoFormat('DD-MM-YYYY');
                })
                ->editColumn('end_date', function ($data) {
                    return \Carbon\Carbon::parse($data->end_date)->isoFormat('DD-MM-YYYY');
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        $leave_type = LeaveSetting::get();
        $all_users = Employee::getActiveEmp()->get();
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
                    return \Carbon\Carbon::parse($data->start_date)->isoFormat('DD-MM-YYYY');
                })
                ->editColumn('end_date', function ($data) {
                    return \Carbon\Carbon::parse($data->end_date)->isoFormat('DD-MM-YYYY');
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        $leave_type = LeaveSetting::get();
        $all_users = Employee::getActiveEmp()->get();
        return view('admin.leave_apply.leave_request_rejected', ['page' => 'Request History', 'leave_type' => $leave_type, 'all_user' => $all_users]);
    }
    public function reverseLeaveWithoutPay(Request $request)
    {
        $leaveId = $request->leave_id;
        $updateData = [
            'reversal_at' => currentDateTime(),
            'is_reversal' => 1,
            'reversal_approved_by' => auth()->user()->id
        ];
        LeaveApply::where('id', $leaveId)->update($updateData);
        $leave = LeaveApply::find($leaveId);
        return response()->json(['status' => true, 'data' => ['leave' => $leave], 'message' => "This Leave is reversed Successfully"]);
    }
}
