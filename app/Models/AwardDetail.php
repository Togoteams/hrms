<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AwardDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'name',
        'event_date',
        'purpose',
        'description',
    ];
}
