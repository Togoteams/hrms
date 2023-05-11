<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\Employee;
use App\Models\LeaveApply;
use App\Models\LeaveType;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Exception;
use Illuminate\Support\Facades\Auth;
use App\Traits\LeaveTraits;

class LeaveReportsController extends Controller
{
    use LeaveTraits;
    public $page_name = " Leave Reports ";
    /**
     * Display a listing of the resource.
     */



    public function index(Request $request)
    {

        $start_date = $request->start;
        $end_date = $request->end;

        if ($request->ajax()) {

            if (isemplooye()) {
                $data = LeaveApply::with('user', 'leave_type')->where('user_id', Auth::user()->id)->select('*');
            } else {

                $data = LeaveApply::with('user', 'leave_type')->select('*');
            }

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn = view('admin.leave_reports.buttons', ['item' => $row, "route" => 'leave_reports']);
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
        $all_users = Employee::where('status', 'active')->get();
        if (isemplooye()) {
            $leave_type = LeaveType::where('status', 'active')->where('leave_for', Employee::where('user_id', Auth::user()->id)->first()->employment_type ?? '')->get();
        } else {
            $leave_type = LeaveType::where('status', 'active')->get();
        }

        if (isemplooye()) {
            $data = LeaveApply::with('user', 'leave_type')->where('user_id', Auth::user()->id)->select('*');
        } else {
            $data = LeaveApply::with('user', 'leave_type')->select('*');
        }

        return view('admin.leave_reports.index', [
            'page' => $this->page_name,
            'all_user' => $all_users,
            'leave_type'=>$leave_type,
            'data' => $data
        ]);
    }



    public function show(string $id)
    {
        $leave_type = LeaveType::where('status', 'active')->get();

        $data = LeaveApply::find($id);
        return view('admin.leave_reports.show', ['data' => $data, 'page' => $this->page_name, 'leave_type' => $leave_type]);
    }



    public function get_balance_leave(Request $request)
    {
        return  $this->balance_leave_by_type($request->leave_type_id, $request->user_id);
    }
}
