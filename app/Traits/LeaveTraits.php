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

        $total_apply_leave =  LeaveApply::where('user_id', $user_id)->where('leave_type_id', $leave_type_id)->where('status', 'approved')->count('*');
        $total_leave = LeaveType::find($leave_type_id)->no_of_days;
        $encash_leave = LeaveEncashment::where('user_id', $user_id)->where('leave_type_id', $leave_type_id)->where('status', 'approved')->sum('no_of_days');
        return $total_leave - $total_apply_leave -  $encash_leave ;
    }
    public function only_encash_leave($user_id = '')
    {
        if ($user_id == '') {
            $user_id = auth()->user()->id;
            // $total_leave = LeaveType::find($leave_type_id);
        }
    }
}
