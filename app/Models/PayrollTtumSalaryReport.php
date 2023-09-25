<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PayrollTtumSalaryReport extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function account()
    {
        return $this->belongsTo(Account::class,'account_id');
    }
    public function emp()
    {
        return $this->belongsTo(Account::class,'account_id');
    }
}
