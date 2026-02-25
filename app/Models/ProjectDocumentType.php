<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectDocumentType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'created_by',
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function uploads()
    {
        return $this->hasMany(ProjectDocumentUpload::class, 'document_type_id');
    }
}
