<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reimbursement extends Model
{
    use HasFactory;
    protected $fillable = ['type_id', 
    'expenses_currency',
    'expenses_amount',
    'claim_date',
    'claim_from_month',
    'claim_to_month',
    'reimbursement_currency',
    'reimbursement_amount',
    'reimbursement_notes',
    'reimbursement_reason',
    'status',
    'approved_at',
    'rejected_at'];

    public function reimbursementype()
    {
        return $this->belongsTo(ReimbursementType::class, 'type_id');
    }

}
