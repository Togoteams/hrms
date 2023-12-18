<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentEmp extends Model
{
    use HasFactory;
    protected $fillable = [
        'document_id',
        'emp_id',
        'branch_id',
        'created_by',
        'updated_by',];

    public function document()
    {
        return $this->belongsTo(Document::class,'document_id');
    }
}
