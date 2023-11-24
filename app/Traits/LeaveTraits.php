<?php

namespace App\Traits;

use App\Models\Employee;
use App\Models\LeaveApply;
use App\Models\LeaveEncashment;
use App\Models\LeaveSetting;
use App\Models\LeaveDate;
use App\Models\LeaveTimeApprovel;

trait LeaveTraits
{
  public function getTotalBalancedLeave($user_id)
  {
    if ($user_id == '') {
      $user_id = auth()->user()->id;
    }
    $total_apply_leave = 0;
    $emp = Employee::where('user_id', $user_id)->first();

    $totalNoOfLeaveInBucket = 0;
    $leaveSettings = LeaveSetting::where('emp_type', getEmpType($emp->employment_type))->get();
    foreach ($leaveSettings as $key => $leaveSetting) {
      $totalNoOfLeaveInBucket = $totalNoOfLeaveInBucket + $this->balance_leave_by_type($leaveSetting->id,$user_id);
      // echo $totalNoOfLeaveInBucket."</br>";
    }
    return $totalNoOfLeaveInBucket;
  }
  // Get total leave apply by user id for per leave type
  public function balance_leave_by_type($leave_type_id, $user_id = '', $action = "")
  {
    if ($user_id == '') {
      $user_id = auth()->user()->id;
    }
    $total_apply_leave = 0;
    $emp = Employee::where('user_id', $user_id)->first();

    $totalNoOfLeaveInBucket = 0;
    $leaveSetting = LeaveSetting::find($leave_type_id);
    $perYearLeave = $leaveSetting->total_leave_year;
    $isProRata = $leaveSetting->is_pro_data;
    $dateOfJoining = date("Y-m-d", strtotime($emp->start_date));
    $currentDate = date("Y-m-d");

    $diff = abs(strtotime($dateOfJoining) - strtotime($currentDate));

    $years = floor($diff / (365 * 60 * 60 * 24));

    $months = floor(($diff - $years  * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
    $total_leave = 0;

    switch ($leaveSetting->slug) {
      case 'sick-leave':

        if($emp->employment_type=="expatriate")
        {
          $total_leave = $perYearLeave;
          if($years>=1)
          {
            $total_leave = $years * $perYearLeave;
          }
        }else
        {
          if($years>1)
          {
            $totalWorkingMonths = (date('m') -1);
          }else
          {
            $totalWorkingMonths = ($months -1);
          }
          $total_leave = ceil(($perYearLeave / 12) * $totalWorkingMonths);
        }
        break;
      case "earned-leave":
        if($years>=1)
        {
          $totalWorkingMonths  = $years * 12 + $months;
          if ($emp->designation->slug == "tea_lady" || $emp->designation->slug == "messenger_driver") {
            $maxEarnedLeave = 45;
            $perYearLeave = 15; // if any change in default leave 
          } else {
            $maxEarnedLeave = 54;
          }
          $total_leave = ceil(($perYearLeave / 12) * $totalWorkingMonths);
          if ($total_leave >= $maxEarnedLeave) {
            $total_leave = $maxEarnedLeave;
          }
        }
        break;
      case "maternity-leave":
        $isMaternityLeave = LeaveTimeApprovel::where('leave_type_id',$leave_type_id)->where('user_id',$user_id)->where('status','approved')->first();
        if(!empty($isMaternityLeave))
        {
          $total_leave = $perYearLeave;
        }
        break;
      case "casual-leave":
        $totalWorkingMonths =( date('m') -1);
        $total_leave = ceil(($perYearLeave / 12) * $totalWorkingMonths);
        break;
      case "privileged-leave":
        $maxEarnedLeave = 90;
        
        if($years>=1)
        {
          $totalWorkingMonths  = ($years-1) * 12 + $months;
          // echo $totalWorkingMonths/12;
          $total_leave = ceil(($perYearLeave / 12) * $totalWorkingMonths);
          if ($total_leave >= $maxEarnedLeave) {
            $total_leave = $maxEarnedLeave;
          }
        }
       
        break;
      default:  
      
        $total_leave = $perYearLeave;
    }

    $days = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24) / (60 * 60 * 24));
    $balanceLeaveHideArr = ['leave-without-pay','bereavement-leave'];

    $ignoreLeaveIds = LeaveSetting::whereIn('slug',$balanceLeaveHideArr)->pluck('id')->toArray();

    if ($action == "update_status") {

      $noOfHalfPayLeave  = LeaveDate::with('leaveApply')->whereHas('leaveApply', function($q) use ($user_id,$leave_type_id,$ignoreLeaveIds) {
        $q->where('user_id',$user_id)->where('leave_type_id', $leave_type_id)->whereNotIn('leave_type_id',$ignoreLeaveIds)->whereNotIn('status',['reject','pending']);
      })->where('pay_type','half_pay')->count();

      $noOfFullPayLeave  = LeaveDate::with('leaveApply')->whereHas('leaveApply', function($q) use ($user_id,$leave_type_id,$ignoreLeaveIds) {
        $q->where('user_id',$user_id)->where('leave_type_id', $leave_type_id)->whereNotIn('leave_type_id',$ignoreLeaveIds)->whereNotIn('status',['reject','pending']);
      })->where('pay_type','full_pay')->count();

      $total_apply_leave = LeaveDate::with('leaveApply')->whereHas('leaveApply', function($q) use ($user_id,$leave_type_id,$ignoreLeaveIds) {
        $q->where('user_id',$user_id)->where('leave_type_id', $leave_type_id)->whereNotIn('leave_type_id',$ignoreLeaveIds)->whereNotIn('status',['reject','pending']);
      })->where('pay_type','')->count();

    } else {

      $noOfHalfPayLeave  = LeaveDate::with('leaveApply')->whereHas('leaveApply', function($q) use ($user_id,$leave_type_id,$ignoreLeaveIds) {
        $q->where('user_id',$user_id)->where('leave_type_id', $leave_type_id)->whereNotIn('leave_type_id',$ignoreLeaveIds)->whereNotIn('status',['reject','pending']);
      })->where('pay_type','half_pay')->count();

      $noOfFullPayLeave  = LeaveDate::with('leaveApply')->whereHas('leaveApply', function($q) use ($user_id,$leave_type_id,$ignoreLeaveIds) {
        $q->where('user_id',$user_id)->where('leave_type_id', $leave_type_id)->whereNotIn('leave_type_id',$ignoreLeaveIds)->whereNotIn('status',['reject','pending']);
      })->where('pay_type','full_pay')->count();

      $total_apply_leave = LeaveDate::with('leaveApply')->whereHas('leaveApply', function($q) use ($user_id,$leave_type_id,$ignoreLeaveIds) {
        $q->where('user_id',$user_id)->where('leave_type_id', $leave_type_id)->whereNotIn('leave_type_id',$ignoreLeaveIds)->whereNotIn('status',['reject']);
      })->where('pay_type','')->count();

    }

    // if (count($total_apply_leaves) > 0) {
    //   foreach ($total_apply_leaves as  $value) {

    //     $no_of_days = get_day($value->start_date, $value->end_date);
    //     $total_apply_leave = $total_apply_leave + $no_of_days;
    //   }
    //   $total_apply_leave = $total_apply_leave + 1;
    // }
    $total_apply_leave = $total_apply_leave + $noOfHalfPayLeave + ($noOfFullPayLeave *2);

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
