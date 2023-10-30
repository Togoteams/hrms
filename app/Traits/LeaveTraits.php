<?php

namespace App\Traits;

use App\Models\Employee;
use App\Models\LeaveApply;
use App\Models\LeaveEncashment;
use App\Models\LeaveSetting;
use App\Models\LeaveType;

trait LeaveTraits
{
    public function balance_leave_by_type($leave_type_id, $user_id = '',$action="")
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

        switch ($leaveSetting->slug) {
            case 'sick-leave':
                $totalWorkingMonths  = date('m');
                $total_leave = ceil(($totalWorkingMonths/12 )* $perYearLeave);
              break;
            case "earned-leave":
                  $totalWorkingMonths  = $years*12+$months;
                  if($emp->designation->slug=="tea_lady" || $emp->designation->slug=="messenger_driver")
                  {
                    $maxEarnedLeave = 45;
                    $perYearLeave = 15;
                  }else
                  {
                    $maxEarnedLeave = 54;
                  }
                  $total_leave = ceil(($totalWorkingMonths/12 )* $perYearLeave);
                  if($total_leave>=$maxEarnedLeave)
                  {
                    $total_leave = $maxEarnedLeave;
                  }
              break;
              case "maternity-leave":
                  $total_leave = $perYearLeave;
            break;
            default:
             $total_leave = $perYearLeave;
          }
       
        $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
        
        if($action=="update_status")
        {
          $total_apply_leaves =  LeaveApply::where('user_id', $user_id)->where('leave_type_id', $leave_type_id)->whereNotIn('status', ['reject','pending'])->get();

        }else
        {
          $total_apply_leaves =  LeaveApply::where('user_id', $user_id)->where('leave_type_id', $leave_type_id)->whereNotIn('status', ['reject'])->get();

        }
        
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
