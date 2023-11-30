<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;
    protected $fillable = [
        'account_number',
        'name',
        'account_type',
        'description',
        'status'
    ];

    // public function getStatusAttribute($showStatus)
    // {
    //     return ucfirst($showStatus);
    // }

}
