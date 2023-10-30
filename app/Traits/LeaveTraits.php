<?php

namespace App\Traits;

use App\Models\Employee;
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
        $emp = Employee::where('user_id',$user_id)->first();

        $totalNoOfLeaveInBucket = 0;
        $leaveSetting = LeaveSetting::find($leave_type_id);
        $perYearLeave = $leaveSetting->total_leave_year;
        $isProRata = $leaveSetting->is_pro_data;
        $dateOfJoining = date("Y-m-d",strtotime($emp->start_date));
        $currentDate = date("Y-m-d");

        $diff = abs(strtotime($dateOfJoining) - strtotime($currentDate));

        $years = floor($diff / (365*60*60*24));

        $months = floor(($diff-$years  * 365*60*60*24) / (30*60*60*24));
        $total_leave = 0;

        echo $leaveSetting->slug;
        // echo $totalWorkingMonths."----";
        switch ($leaveSetting->slug) {
            case 'sick-leave':
              if($isProRata)
              {
                $totalWorkingMonths  = date('m');
                echo $totalWorkingMonths;
                $perMonthLeave = ($perYearLeave/12);
                $total_leave = ($totalWorkingMonths/12* $perYearLeave);
              }
              break;
            case "earned-leave":
                if($isProRata)
                {
                  $totalWorkingMonths  = $years*12+$months;
                  $perMonthLeave = ($perYearLeave/12);
                  $total_leave = ($perMonthLeave * $totalWorkingMonths);
                }
              break;
         
            
            default:
             $total_leave =9;
          }
       
        $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
        
        $total_apply_leaves =  LeaveApply::where('user_id', $user_id)->where('leave_type_id', $leave_type_id)->whereNotIn('status', ['reject'])->get();
        if (count($total_apply_leaves) > 0) {
            foreach ($total_apply_leaves as  $value) {
             
                $no_of_days =get_day($value->start_date,$value->end_date);
                $total_apply_leave = $total_apply_leave + $no_of_days ;

            }
            $total_apply_leave = $total_apply_leave + 1;
        }
        // echo $total_apply_leave;
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
