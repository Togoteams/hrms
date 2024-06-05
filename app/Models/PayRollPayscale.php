<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PayRollPayscale extends Model
{
    use HasFactory;
    protected $table = "payroll_payscales";
    protected $fillable = [
        'employee_id',
        'user_id',
        'status',
        'basic',
        'payscale_date',
        // 'fixed_deductions',
        // 'other_deductions',
        'net_take_home',
        // 'ctc',
        // 'total_employer_contribution',
        'total_deduction',
        'gross_earning',
        'updated_by',
        'deleted_by',
        'created_by',
        'created_at',
        'updated_at',
        'deleted_at',
        'branch_id',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function employee(){
        return $this->belongsTo(Employee::class);
    }

    public function payroll_payscale_head(){
        return $this->hasMany(PayrollPayscaleHead::class,'payroll_payscale_id');
    }
}
