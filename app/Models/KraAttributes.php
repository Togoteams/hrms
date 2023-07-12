<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Webpatser\Uuid\Uuid;

class KraAttributes extends Model
{
    use HasFactory;
    protected $fillable =[
        'uuid',
        'name',
        'description',
        'max_marks',
        'min_marks',
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
}
