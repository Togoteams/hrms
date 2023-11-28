<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentType extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
         'description',
         'status'];

    public function scopeGetDocumentType($query)
    {
        return $query
        ->where('status', 'active');

    }
}
