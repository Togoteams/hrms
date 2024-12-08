<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PayrollTtumSalaryReport extends Model
{
    use HasFactory;
    protected $guarded = [];

     /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'branch_name' // role -> name
    ];
   
    public function account()
    {
        return $this->belongsTo(Account::class,'account_id');
    }
    public function emp()
    {
        return $this->belongsTo(Account::class,'account_id');
    }



    public function branch()
    {
        return $this->belongsTo(Branch::class,'branch_id');
    }
    public function getBranchNameAttribute()
    {
        return $this->branch?->name;
    }
}
