<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectDocumentUpload extends Model
{
    use HasFactory;

    protected $table = 'project_document_uploads';

    /**
     * Mass assignable attributes
     */
    protected $fillable = [
        'company_id',
        'period_id',
        'project_id',
        'document_type_id',
        'attachment',
        'created_by',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function period()
    {
        return $this->belongsTo(Period::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function documentType()
    {
        return $this->belongsTo(ProjectDocumentType::class, 'document_type_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
