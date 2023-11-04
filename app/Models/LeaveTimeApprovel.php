<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaveTimeApprovel extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'leave_type_id', 
         'description',
        'status'
    ];
        public function leaveType()
        {
            return $this->belongsTo(LeaveSetting::class, 'leave_type_id');
        }
}
