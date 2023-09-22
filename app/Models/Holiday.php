<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Webpatser\Uuid\Uuid;

class Holiday extends Model
{
    use HasFactory;
    protected $fillable =[
        'name',
        'is_optional',
        'date',
        'description',
        'status'
    ];
    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->uuid = (string) Uuid::generate(4);
        });
    }

    public function getStatusAttribute($showStatus)
    {
        return ucfirst($showStatus); 
    }

}
