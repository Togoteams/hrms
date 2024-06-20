<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Webpatser\Uuid\Uuid;

class Employee extends Model
{
    use HasFactory;
    protected $guarded = [];
    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            // $model->uuid = (string) Uuid::generate(4);
        });
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function designation()
    {
        return $this->belongsTo(Designation::class);
    }

    public function leaveEncashments()
    {
        return $this->hasMany(LeaveEncashment::class,'employee_id');
    }

    public function union()
    {
        return $this->belongsTo(Membership::class, 'union_membership_id', 'id');
    }

    public function address()
    {
        return $this->belongsTo(EmpAddress::class, 'user_id', 'user_id');
    }

    public function addresses()
    {
        return $this->hasMany(EmpAddress::class, 'user_id');
    }
    public function empPayscale()
    {
        return $this->hasMany(PayRollPayscale::class, 'employee_id');
    }


    public function passportOmang()
    {
        return $this->belongsTo(EmpPassportOmang::class, 'user_id', 'user_id');
    }


    public function medicalBomaid()
    {
        return $this->belongsTo(EmpMedicalInsurance::class, 'user_id', 'user_id');
    }

    public function qualification()
    {
        return $this->hasMany(Qualification::class, 'user_id', 'user_id');
    }
    public function salaryHistory()
    {
        return $this->hasMany(SalaryHistory::class, 'user_id', 'user_id');
    }

    public function getLatestSalary()
    {
        return $this->salaryHistory()->where('date_of_current_basic','<=',currentDateTime('Y-m-d'))->orderBy('id','desc')->first();
    }

    public function departmentHistory()
    {
        return $this->hasMany(EmpDepartmentHistory::class, 'user_id', 'user_id');
    }
    public function branch(){
        return $this->belongsTo(Branch::class);
    }
    public function scopeGetList($query)
    {
        if(auth()->user()->role_slug=='managing-director' || auth()->user()->role_slug=='hr-head-ho'||auth()->user()->id==1)
        {
         return $query;
        }
        elseif(auth()->user()->role_slug=='branch-head')
        {
            $query->where('branch_id', auth()->user()->employee->branch_id);
        }else
        {
            $query->where('user_id', auth()->user()->id);
        }
        return $query;
    }
    public function scopeGetApprovalAuthority($query)
    {
        if(auth()->user()->role_slug=='branch-head')
        {
            $query->where('branch_id', auth()->user()->employee->branch_id);
        }
        return $query;
    }

    public function scopeGetActiveEmp($query)
    {
       
        return $query->where('status', 'active');
    }
}
