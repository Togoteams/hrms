<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PayrollTtumReport extends Model
{
    use HasFactory;
    protected $guarded = [];

     /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'branch_name' // role -> name
    ];
   
    
    public function payrollTtumSalaryReport(){
        return $this->hasMany(PayrollTtumSalaryReport::class,'payroll_ttum_report_id');
    }


    public function branch()
    {
        return $this->belongsTo(Branch::class,'branch_id');
    }
    public function getBranchNameAttribute()
    {
        return $this->branch?->name;
    }
    public function scopeGetList($query)
    {
        if(auth()->user()->role_slug=='branch-head')
        {
            $query->where('branch_id', auth()->user()->employee->branch_id);
        }elseif(auth()->user()->role_slug=='hr_head' || auth()->user()->role_slug=='managing-director' ||   auth()->user()->id==1){
            $query;
        }else
        {
            $query->where('branch_id',auth()->user()->employee->branch_id);
        }
        
        return $query;
    }
}
