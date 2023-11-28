<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaveType extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'description','leave_for','no_of_days','nature_of_leave','created_by'];

    public function scopeGetLeaveType($query)
    {
        return $query
        ->where('status', 'active');

    }

}
