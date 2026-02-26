<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectVoyage extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'period_id',
        'project_id',
        'spal_number',
        'cargo_id',
        'loading_port_id',
        'discharge_port_id',
        'quantity',
        'unit',
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

    public function cargo()
    {
        return $this->belongsTo(Cargo::class);
    }

    public function loadingPort()
    {
        return $this->belongsTo(Port::class, 'loading_port_id');
    }

    public function dischargePort()
    {
        return $this->belongsTo(Port::class, 'discharge_port_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}