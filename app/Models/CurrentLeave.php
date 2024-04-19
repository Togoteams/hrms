<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Webpatser\Uuid\Uuid;

class CurrentLeave extends Model
{
    use HasFactory;

    protected $fillable =[
        'user_id',
        'employee_id',
        'sick_leave',
        'employee_type',
        'earned_leave',
        'maternity_leave',
        'bereavement_leave',
        'leave_without_pay',
        'casual_leave',
        'privileged_leave'
    ];

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->uuid = (string) Uuid::generate(4);
        });
    }
}
