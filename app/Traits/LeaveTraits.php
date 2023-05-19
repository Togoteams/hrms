<?php

namespace App\Traits;

use App\Models\LeaveApply;
use App\Models\LeaveEncashment;
use App\Models\LeaveType;

trait LeaveTraits
{
    public function balance_leave_by_type($leave_type_id, $user_id = '')
    {
        if ($user_id == '') {
            $user_id = auth()->user()->id;
        }
        $total_apply_leave = 0;
        $total_apply_leaves =  LeaveApply::where('user_id', $user_id)->where('leave_type_id', $leave_type_id)->where('status', 'approved')->get();
        if (count($total_apply_leaves) > 0) {
            foreach ($total_apply_leaves as  $value) {
                $date1 = date_create($value->start_date);
                $date2 = date_create($value->end_date);
                $no_of_days = date_diff($date1, $date2)->format("%R%a");
                $no_of_days = (int)round($no_of_days, 0);
                $total_apply_leave = $total_apply_leave + $no_of_days;
            }
            $total_apply_leave = $total_apply_leave + 1;
        }

        $total_leave = LeaveType::find($leave_type_id)->no_of_days;
        $encash_leave = LeaveEncashment::where('user_id', $user_id)->where('leave_type_id', $leave_type_id)->where('status', 'approved')->sum('no_of_days');
        $total = $total_leave - $total_apply_leave -  $encash_leave;
        return $total;
    }
    public function only_encash_leave($user_id = '')
    {
        if ($user_id == '') {
            $user_id = auth()->user()->id;
            // $total_leave = LeaveType::find($leave_type_id);
        }
    }
}
