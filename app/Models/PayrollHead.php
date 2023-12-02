<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PayrollHead extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'placeholder',
        'employment_type',
        'is_ttum_component',
        'for',
        'is_dropdown',
        'head_type',
        'status',
        'created_by',
        'updated_by',
        'deleted_by',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}
