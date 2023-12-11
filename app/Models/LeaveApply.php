<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaveApply extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    function leave_type(){
        return $this->belongsTo(LeaveSetting::class);
    }
    function leaveSetting(){
        return $this->belongsTo(LeaveSetting::class);
    }
    public function employee(){
        return $this->belongsTo(Employee::class);
    }
    
    public function leaveDate(){
        return $this->hasMany(LeaveDate::class,'leave_id');
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
