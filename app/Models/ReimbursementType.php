<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReimbursementType extends Model
{
    use HasFactory;
    protected $fillable = ['type', 'slug','status'];

    public function getStatusAttribute($showStatus)
    {
        return ucfirst($showStatus); 
    }
}
