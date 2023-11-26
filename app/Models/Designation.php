<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Designation extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'description'];

    public function scopeGetDesignation($query)
    {
        return $query
        ->where('status', 'active');

    }

}
