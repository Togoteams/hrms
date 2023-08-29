<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmpMedicalInsurance extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];

    public function medicalCard()
    {
        return $this->belongsTo(MedicalCard::class, 'medical_card_id', 'id');
    }
}
