<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OvertimeSetting extends Model
{
    use HasFactory;
    protected $fillable = [
        'emp_id',
        'date',
        'working_hours',
        'working_min',
        'overtime_type',
        'status'];
        
        public function user()
        {
            return $this->belongsTo(User::class, 'emp_id');
        }
}
