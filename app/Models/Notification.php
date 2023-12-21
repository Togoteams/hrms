<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'description','notification_type','notifi_from_user_id', 'reference_type', 'reference_id', 'membership_code'];

    public function leaveApply()
    {
        return $this->morphToMany(LeaveApply::class, 'reference');
    }
}
