<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Webpatser\Uuid\Uuid;

class LeaveApply extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function reversalBy()
    {
        return $this->belongsTo(User::class,'reversal_approved_by');
    }
    function leave_type(){
        return $this->belongsTo(LeaveSetting::class);
    }
    function leaveSetting(){
        return $this->belongsTo(LeaveSetting::class);
    }


    public function leaveDate(){
        return $this->hasMany(LeaveDate::class,'leave_id');
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
        
        return $query->orderBy('id','desc');
    }
    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->uuid = (string) Uuid::generate(4);
        });
        static::deleting(function($model) {
            $model->leaveDate()->delete();
        });
    }
}
