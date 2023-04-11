<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Webpatser\Uuid\Uuid;

class Leave extends Model
{
    use HasFactory;
    protected $fillable =[
        'leave_applies_for',
        'start_date',
        'end_date',
        'is_approved',
        'approved_by',
        'approved_date',
        'is_paid',
        'leave_reason',
        'apply_date',
        'remark',
        'status'
    ];
    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->uuid = (string) Uuid::generate(4);
        });
    }
}
