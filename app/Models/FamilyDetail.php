<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FamilyDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'relation',
        'date_of_birth',
        'name',
        'depended',
        'marital_status',
        'gender',
        'occupations',
        'monthly_income',
        'bank_of_baroda_employee',
        'address_line1',
        'address_line2',
        'state',
        'country',
        'email',
        'std_code',
        'number',
        'nationality',
    ];
}
