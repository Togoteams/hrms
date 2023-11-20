<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaveDate extends Model
{
    use HasFactory; 
    protected $guarded = [];

    function leaveApply(){
        return $this->belongsTo(LeaveApply::class,'leave_id');
    }
}
