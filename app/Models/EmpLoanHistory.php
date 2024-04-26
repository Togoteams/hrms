<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Webpatser\Uuid\Uuid;

class EmpLoanHistory extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
   
    
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
    public function account()
    {
        return $this->belongsTo(Account::class);
    }
    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->uuid = (string) Uuid::generate(4);
        });
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
        // ->where('status', 'active');
    }
}
