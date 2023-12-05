<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class EmplooyeLoans extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function loan()
    {
        return $this->belongsTo(Loans::class);
    }
    
    public function employee()
    {
        return $this->belongsTo(Employee::class);
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
