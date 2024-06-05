<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Webpatser\Uuid\Uuid;

class LeaveActivityLog extends Model
{
    protected $fillable =[
        'user_id',
        'leave_type_id',
        'is_credit',
        'leave_count',
        'adjustment',
        'leave_update_reason',
        'activity_at',
        'description'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    function leave_type(){
        return $this->belongsTo(LeaveSetting::class);
    }

   
}
