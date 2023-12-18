<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaveEncashment extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    function leave_settings(){
        return $this->belongsTo(LeaveSetting::class,'leave_type_id');
    }
    function employee(){
        return $this->belongsTo(Employee::class);
    }
}
