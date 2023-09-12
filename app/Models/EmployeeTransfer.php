<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeTransfer extends Model
{
    use HasFactory;
    protected $fillable = [
        'emp_id',
        'department_id',
        'branch_id',
        'transfer_type',
        'transfer_reason',
        'status',
        'approved_at',
        'rejected_at',
        'transfer_request_at'
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'emp_id');
    }
    public function department()
    {
        return $this->belongsTo(Designation::class, 'department_id');
    }
    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id');
    }
}

