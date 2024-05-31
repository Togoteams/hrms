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
        'request_date',
        'start_date',
        'end_date',
        'document',
        'reason',
        'approval_authority',
        'description',
        'status',
        'description_reason',
        'approved_at',
        'rejected_at'];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function leaveSetting()
    {
        return $this->belongsTo(LeaveSetting::class, 'leave_type_id');
    }
}
