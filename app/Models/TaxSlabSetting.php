<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaxSlabSetting extends Model
{
    use HasFactory;
    protected $fillable = [
        'from',
        'to',
        'additional_local_amount',
        'local_tax_per',
        'additional_ibo_amount',
        'ibo_tax_per',
        'description',
        'status',
       
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}
