<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OvertimeSetting extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'date',
        'working_hours',
        'working_min',
        'overtime_type',
        'status',
        'branch_id',
        'created_by',
        'updated_by',];

        public function user()
        {
            return $this->belongsTo(User::class, 'user_id');
        }
        public function scopeGetList($query)
        {
            if(auth()->user()->role_slug=='branch-head')
            {
                $query->whereHas('user.employee',function($q){
                    $q->where('branch_id', auth()->user()->employee->branch_id);
                });
            }elseif(auth()->user()->role_slug=='hr_head' || auth()->user()->role_slug=='managing-director' ||   auth()->user()->id==1){
                $query;
            }else
            {
                $query->where('user_id',auth()->user()->id);
            }
            
            return $query->orderBy('id','desc');
        }
}
