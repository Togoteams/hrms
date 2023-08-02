<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PayrollSalaryIncrement extends Model
{
    use HasFactory;

    protected $fillable =[
        'increment_percentage',
        'employment_type',
        'effective_from',
        'effective_to',
        'financial_year',
        'status'
    ];
}

