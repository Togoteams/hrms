<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reimbursement extends Model
{
    use HasFactory;
    protected $fillable = ['type_id', 
    'bill_amount',
    'expenses_date',
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
