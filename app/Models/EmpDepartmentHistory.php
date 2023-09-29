<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmpDepartmentHistory extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];

    public function getStartDateAttribute($value)
    {
        return date("d-M-y", strtotime($value));
    }

    public function getEndDateAttribute($value)
    {
        if($value)
        {
            return date("d-M-y", strtotime($value)); 
        }else{
            return "Till Now"; 

        }
    }
}
