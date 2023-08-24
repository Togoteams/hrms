<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaveSetting extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'emp_type','total_leave_year','max_leave_at_time','is_accumulated','is_accumulated_max_value','is_pro_data','starting_date','is_count_holyday','is_leave_encash','is_certificate'];
}
