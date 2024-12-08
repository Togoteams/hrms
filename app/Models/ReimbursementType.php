<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReimbursementType extends Model
{
    use HasFactory;
    protected $fillable = ['type', 'slug','status','is_tax_exempt'];

    public function getStatusAttribute($showStatus)
    {
        return ucfirst($showStatus);
    }
    public function scopeGetReimbursementType($query)
    {
        return $query
        ->where('status', 'active');

    }
}
