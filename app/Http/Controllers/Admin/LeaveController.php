<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Leave\LeaveService;
use Illuminate\Support\Facades\DB;
class LeaveController extends BaseController
{
    // i have added somthing here
    protected $leaveService;
    public function __construct(LeaveService $leaveService)
    {
        $this->leaveService= $leaveService;
    }
    public function viewleave()
    {
        $filterConditions = [];
        $leaves= $this->leaveService->listleaves($filterConditions, 'id', 'asc');
        return view('admin.leave.leaves', compact('leaves'));
    }

    public function addleave(Request $request)
    {
        $leaveId = $request->leave_id ?? NULL;
        if (!empty($leaveId)) {
            $message = "leave  Updated Successfully";
        } else {
            $message = "leave Created Successfully";
        }

        $request->validate([
            'leave_applies_for'     =>  'required|string',
            'start_date' => 'required',
            'end_date' => 'required',
            'leave_reason' => 'required'
        ]);

       
        $isleaveCreated= $this->leaveService->createOrUpdateleave($request->except('_token'),$leaveId);
        if ($isleaveCreated) {
            return   $this->responseJson($isleaveCreated, $message);
        }
    }

    public function deleteleave(Request $request, $leaveId)
    {
        DB::beginTransaction();
        try {
            $isleaveCreated= $this->leaveService->findLeave($leaveId);
            if (!empty($leave)) {
                $isleaveDeleted = $leave->delete();
                if ($isleaveDeleted) {
                    DB::commit();
                    $message = 'leave  deleted successfully';
                    return $this->responseJson('admin.leaves.list', $message);
                }
            } else {
                $message = 'leave  not found';
                return $this->responseJson('admin.leaves.list', $message);
            }
        } catch (\Exception $e) {
            DB::rollback();
            return   $this->sendError($e->getMessage());
            logger($e->getMessage() . ' -- ' . $e->getLine() . ' -- ' . $e->getFile());
        }
    }
}
