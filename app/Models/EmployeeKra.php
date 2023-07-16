<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Webpatser\Uuid\Uuid;

class EmployeeKra extends Model
{
    use HasFactory;

    protected $fillable=[
        'uuid',
        'user_id',
        'employee_id',
        'attribute_name',
        'attribute_description',
        'commects',
        'max_marks',
        'min_marks',
        'marks_by_reporting_autheority',
        'marks_by_review_autheority',
        'status',
        'created_by',
        'updated_by',
        'deleted_by',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->uuid = (string) Uuid::generate(4);
            $model->created_by=auth()->user()->id;
        });
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
