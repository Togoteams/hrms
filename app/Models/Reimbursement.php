<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reimbursement extends Model
{
    use HasFactory;
    protected $fillable = [
    'user_id',
    'type_id',
    'expenses_currency',
    'financial_year',
    'expenses_amount',
    'claim_date',
    'user_id',
    'claim_from_month',
    'claim_to_month',
    'reimbursement_currency',
    'reimbursement_amount',
    'reimbursement_notes',
    'reimbursement_reason',
    'status',
    'approved_at',
    'rejected_at',
    'branch_id',
    'created_by',
    'updated_by',
];

    public function scopeGetReimbursement($query)
    {
        return $query
        ->where('status', 'active');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function reimbursementype()
    {
        return $this->belongsTo(ReimbursementType::class, 'type_id');
    }

    public function currency()
    {
        return $this->belongsTo(CurrencySetting::class);
    }
    
    public function scopeGetList($query)
    {
        if(isemplooye())
        {
            return $query->where('user_id', auth()->user()->id);
        }else
        {
            return $query;
        }
    }

}
