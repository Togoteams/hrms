<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeTransfer extends Model
{
    use HasFactory;
    protected $fillable =[
        'emp_id',
        'transfer_type',
        'transfer_reason',
    ];
}
