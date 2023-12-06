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
        'is_credit',
        'description',
        'status'
    ];

    // public function getStatusAttribute($showStatus)
    // {
    //     return ucfirst($showStatus);
    // }
    public function scopeGetList($query)
    {
        return $query->where('status','active');
    }
}
