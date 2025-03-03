<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaveEncashment extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    function leave_settings(){
        return $this->belongsTo(LeaveSetting::class,'leave_type_id');
    }
    function employee(){
        return $this->belongsTo(Employee::class);
    }
    public function scopeGetList($query)
    {
        if(auth()->user()->role_slug=='branch-head')
        {
            $query->whereHas('user.employee',function($q){
                $q->where('branch_id', auth()->user()->employee->branch_id);
            });
        }elseif(auth()->user()->role_slug=='hr_head' || auth()->user()->role_slug=='managing-director' ||   auth()->user()->id==1){
            $query;
        }else
        {
            $query->where('user_id',auth()->user()->id);
        }
        
        return $query;
    }
}
