<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PayrollSalaryHead extends Model
{
    use HasFactory;
    protected $fillable =[
        'payroll_salary_id',
        'payroll_head_id',
        'value',
        'status',
        'created_by',
        'updated_by',
        'deleted_by',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function payroll_head(){
        return $this->belongsTo(PayrollHead::class,'payroll_head_id');
    }
}
