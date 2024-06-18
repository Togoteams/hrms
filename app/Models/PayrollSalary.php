<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PayrollSalary extends Model
{
    use HasFactory;
    protected $fillable = [
        'employee_id',
        'payroll_payscales_id',
        'user_id',
        'pay_for_month_year',
        'salary_date_pay_for',
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
        'net_take_home_in_pula',
        'usd_pula_currency_amount',
        'usd_inr_currency_amount',
        'pula_inr_currency_amount',
        'emp_13_cheque_amount',
        'education_allowance_for_ind_in_pula',
        'taxable_amount_in_pula',
        'tax_amount_in_pula',
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
        'leave_encashment_amount',
        'leave_encashment_days',
        'branch_id',
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
    public function scopeFilter($q)
    {
       
        // if(!empty(request('company_id')))
        // {
        //      $q->where('company_id', request('company_id'));
        // }
        if(!empty(request('pay_for_month_year')))
        {
             $q->where('pay_for_month_year', request('pay_for_month_year'));
        }
        if(!empty(request('employee_id')))
        {
             $q->where('employee_id', request('employee_id'));
        }
       
        return $q;
    }

    public function payrollSalaryHead(){
        return $this->hasMany(PayrollSalaryHead::class,'payroll_salary_id');
    }

    public function payroll_payscale_head(){
        return $this->hasMany(PayrollPayscaleHead::class,'payroll_payscale_id');
    }
   
    public function scopeGetList($query)
    {
        if(auth()->user()->role_slug=='branch-head')
        {
            $query->whereHas('user.employee',function($q){
                $q->where('branch_id', auth()->user()->employee->branch_id);
            });
            
        }elseif(auth()->user()->role_slug=='hr_head' || auth()->user()->role_slug=='admin'){
            $query;
        }else
        {
            $query->where('user_id',auth()->user()->id);
        }
        
        return $query;
    }
     /**
     * Boot method
    **/
    protected static function boot()
    {
        parent::boot();
        self::creating(function ($model) {

        });

        self::updating(function ($model) {
        });

        self::deleted(function ($model) {
            $model->payrollSalaryHead();
        });
    }
}
