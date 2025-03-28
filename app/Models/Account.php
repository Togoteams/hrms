<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;
    const DEBIT = 0;
    const CREDIT = 1;
    const TYPE_ARR = [
        self::DEBIT    => 'Debit',
        self::CREDIT   => 'Credit',
    ];
   
    protected $fillable = [
        'account_number',
        'name',
        'branch_id',
        'slug',
        'account_type',
        'is_credit',
        'user_id',
        'description',
        'status'
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'type_label','branch_name' // role -> name
    ];
   

    // public function getStatusAttribute($showStatus)
    // {
    //     return ucfirst($showStatus);
    // }
    public function scopeGetList($query)
    {
        return $query->where('status','active');
    }
    public function getTypeLabelAttribute()
    {
        return ($this->is_credit == 1) ? self::TYPE_ARR[self::CREDIT] : self::TYPE_ARR[self::DEBIT];
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
