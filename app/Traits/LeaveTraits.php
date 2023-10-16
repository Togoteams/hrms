<?php

namespace App\Traits;

use App\Models\LeaveApply;
use App\Models\LeaveEncashment;
use App\Models\LeaveSetting;
use App\Models\LeaveType;

trait LeaveTraits
{
    public function balance_leave_by_type($leave_type_id, $user_id = '')
    {
        if ($user_id == '') {
            $user_id = auth()->user()->id;
        }
        $total_apply_leave = 0;
        $total_apply_leaves =  LeaveApply::where('user_id', $user_id)->where('leave_type_id', $leave_type_id)->whereNotIn('status', ['reject'])->get();
        if (count($total_apply_leaves) > 0) {
            foreach ($total_apply_leaves as  $value) {
             
                $no_of_days =get_day($value->start_date,$value->end_date);
                $total_apply_leave = $total_apply_leave + $no_of_days ;

            }
            $total_apply_leave = $total_apply_leave + 1;
        }

        $total_leave = LeaveSetting::find($leave_type_id)->total_leave_year;
        $encash_leave = LeaveEncashment::where('user_id', $user_id)->where('leave_type_id', $leave_type_id)->whereNotIn('status', ['reject'])->sum('no_of_days');
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
