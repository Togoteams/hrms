<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'slug','status'];
    public function scopeGetDepartment($query)
    {
        return $query
        ->where('status', 'active');

    }


}
