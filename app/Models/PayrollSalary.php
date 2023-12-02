<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PayrollSalary extends Model
{
    use HasFactory;
    protected $fillable = [
        'employee_id',
        'user_id',
        'pay_for_month_year',
        'status',
        'basic',
        'employment_type',
        'total_working_days',
        'annual_balanced_leave',
        'no_of_persent_days',
        'total_loss_of_pay',
        'no_of_payable_days',
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
        'deleted_at'
    ];
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function employee(){
        return $this->belongsTo(Employee::class);
    }
    public function department()
    {
    return $this->hasOne(EmpDepartmentHistory::class,'user_id','user_id');

    }

    public function payrollSalaryHead(){
        return $this->hasMany(PayrollSalaryHead::class,'payroll_salary_id');
    }

    public function payroll_payscale_head(){
        return $this->hasMany(PayrollPayscaleHead::class,'payroll_payscale_id');
    }
}
