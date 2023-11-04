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
        'approval_date',
        'description',
        'status'
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    
    public function leaveSetting()
    {
        return $this->belongsTo(LeaveSetting::class, 'leave_type_id');
    }
}
