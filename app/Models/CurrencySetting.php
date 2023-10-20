<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CurrencySetting extends Model
{
    use HasFactory;
    protected $fillable = [
        'currency_name_from',
        'currency_name_to',
        'currency_amount_from',
        'currency_amount_to',
        'status'
    ];

    // public function getStatusAttribute($showStatus)
    // {
    //     return ucfirst($showStatus); 
    // }

}
