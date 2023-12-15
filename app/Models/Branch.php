<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;
    protected $fillable=['name','code','address','city','state','country','landmark','status','description','is_main_branch'];
    public function scopeGetBranch($query)
         {
             return $query
             ->where('status', 'active');

         }
}
