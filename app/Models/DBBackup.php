<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DBBackup extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'date_time',
        'file',
        'backup_by'
    ];

    public function user(){
        return $this->belongsTo(User::class, 'backup_by');
    }
}
