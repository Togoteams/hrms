<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'code', 'address', 'city', 'state', 'country', 'landmark', 'status', 'description', 'is_main_branch'];
    public function scopeGetBranch($query)
    {
        return $query
            ->where('status', 'active');
    }
    public function scopeGetFilter($query)
    {
        if(auth()->user()->role_slug=='branch-head')
        {
            $query->where('id', auth()->user()->employee->branch_id);
        }
        return $query;
    }
}
