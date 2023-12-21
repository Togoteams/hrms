<?php

namespace App\Traits;

use App\Models\Employee;
use App\Models\LeaveApply;
use App\Models\Notification;
use PHPUnit\Framework\MockObject\Stub\ReturnReference;

trait NotificationTraits
{
  
  
  public function saveNotification($data =[])
  {
      $data['notifi_from_user_id']=auth()->user()->id;
      $data['notify_at'] = currentDateTime();
      $data['is_view'] = 0;
      $notification = Notification::create($data);
      return $notification;
  }
}
