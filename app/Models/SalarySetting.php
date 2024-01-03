<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalarySetting extends Model
{
    use HasFactory;
    protected $fillable = [
        'bank_pension_contribution',
        'ibo_bank_bomaid_contribution',
        'local_bank_bomaid_contribution',
        'salary_date',
    ];

}
