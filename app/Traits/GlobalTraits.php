<?php

namespace App\Traits;

use App\Models\EmpCurrentLeave;
use App\Models\Employee;
use App\Models\LeaveApply;
use Carbon\Carbon;
use App\Models\LeaveEncashment;
use App\Models\LeaveSetting;
use App\Models\LeaveDate;
use App\Models\LeaveTimeApprovel;
use App\Models\User;
use App\Traits\LeaveTraits;
trait GlobalTraits
{
    use LeaveTraits;
    public function updateCurrentLeaveOfEachEmployee()
    {
        $employees = Employee::get();
        foreach ($employees as $key => $employee) {
            $employeeLeave = EmpCurrentLeave::where('employee_id', $employee->id)->where('employee_type', $employee->employment_type)->where('status', 'active')->get();
            foreach ($employeeLeave as $key => $leave) {
                $currentLeaveCount = $leave->leave_count;
                $leaveSetting = LeaveSetting::find($leave->leave_type_id);
                $perYearLeave = $leaveSetting?->total_leave_year;
                $isProRata = $leaveSetting?->is_pro_data;
                $dateOfJoining = date("Y-m-d", strtotime($employee->start_date));
                $currentDate = Carbon::now();

                $diff = abs(strtotime($dateOfJoining) - strtotime($currentDate));

                $years = floor($diff / (365 * 60 * 60 * 24));
                $leaveCountWithDecimalValue = $leave->leave_count_decimal;
                switch ($leaveSetting?->slug) {
                    case 'sick-leave':
                        // if ($currentDate->isStartOfMonth()) {
                            $leaveCountWithDecimalValue = $leaveCountWithDecimalValue + round($perYearLeave / 12, 2);
                            $currentLeaveCount = ceil($leaveCountWithDecimalValue);
                        // }
                        break;
                    case "earned-leave":
                        // if ($currentDate->isStartOfMonth()) {
                            if ($years >= 1) {
                                if ($employee->designation->slug == "tea_lady" || $employee->designation->slug == "messenger_driver") {
                                    $maxEarnedLeave = 45;
                                    $perYearLeave = 15; // if any change in default leave 
                                } else {
                                    $maxEarnedLeave = 54;
                                }
                                if ($currentLeaveCount >= $maxEarnedLeave) {
                                    $currentLeaveCount = $maxEarnedLeave;
                                } else {
                                    $leaveCountWithDecimalValue = $leaveCountWithDecimalValue + round($perYearLeave / 12, 2);
                                    $currentLeaveCount = ceil($leaveCountWithDecimalValue);
                                }
                            }
                        // }
                        break;
                    case "casual-leave":
                        // if ($currentDate->isStartOfMonth()) {
                            if (($currentDate->dayOfYear === 1)) {
                                $currentLeaveCount = 1;
                            } else {
                                $leaveCountWithDecimalValue = $leaveCountWithDecimalValue + round($perYearLeave / 12, 2);
                                $currentLeaveCount = ceil($leaveCountWithDecimalValue);
                            }
                        // }
                        break;
                    case "privileged-leave":
                        $maxEarnedLeave = 90;
                        // if ($currentDate->isStartOfMonth()) {
                            if ($years >= 1) {
                                if ($currentLeaveCount >= $maxEarnedLeave) {
                                    $currentLeaveCount = $maxEarnedLeave;
                                } else {
                                    $leaveCountWithDecimalValue = $leaveCountWithDecimalValue + round($perYearLeave / 12, 2);
                                    $currentLeaveCount = ceil($leaveCountWithDecimalValue);
                                }
                            }
                        // }

                        break;
                    default:

                        $currentLeaveCount = $currentLeaveCount;
                }
                // if ($currentDate->isStartOfMonth()) {
                //     if (date('Y-m-d', strtotime($leave->updated_at)) != date('Y-m-d')) {
                        $leave->leave_count = $currentLeaveCount;
                        $leave->leave_count_decimal = $leaveCountWithDecimalValue;
                        $leave->save();
                //     }
                // }
                $this->leaveActivityLog([
                    'user_id'=>$employee->user_id,
                    'leave_type_id'=>$leave->leave_type_id,
                    'is_credit'=>1,
                    'leave_count'=>$currentLeaveCount,
                  ]);
            }
        }
    }
}
