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

    public function scopeGetList($query)
    {
        if(auth()->user()->role_slug=='branch-head')
        {
            $query->whereHas('user.employee',function($q){
                $q->where('branch_id', auth()->user()->employee->branch_id);
            })
            ->orWhere(function ($q) {
                $q->where('approval_authority',auth()->user()->id)->orWhere('user_id',auth()->user()->id);
            });
        }elseif(auth()->user()->role_slug=='hr_head' || auth()->user()->role_slug=='managing-director' ||   auth()->user()->id==1){
            $query;
        }else
        {
            $query->where('user_id',auth()->user()->id);
        }
        
        return $query;
    }
    public function leaveSetting()
    {
        return $this->belongsTo(LeaveSetting::class, 'leave_type_id');
    }
}
