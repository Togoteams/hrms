<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Webpatser\Uuid\Uuid;

class Employee extends Model
{
    use HasFactory;

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->uuid = (string) Uuid::generate(4);
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

    public function union()
    {
        return $this->belongsTo(Membership::class, 'unique_membership_id', 'id');
    }

    public function address()
    {
        return $this->belongsTo(EmpAddress::class, 'user_id', 'user_id');
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

    public function departmentHistory()
    {
        return $this->hasMany(EmpDepartmentHistory::class, 'user_id', 'user_id');
    }
}
