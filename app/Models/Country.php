<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'std_code',
         'description',
         'status'];
    public function scopeGetCountry($query)
    {
        return $query
        ->where('status', 'active');

    }
}
