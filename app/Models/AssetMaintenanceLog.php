<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssetMaintenanceLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'asset_id',
        'maintenance_date',
        'type',
        'description',
        'performed_by',
        'cost',
        'result_status',
        'estimate_next_maintenance',
        'created_by',
    ];

    protected $casts = [
        'maintenance_date' => 'date',
        'estimate_next_maintenance' => 'date',
        'cost' => 'decimal:2',
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

    public function asset()
    {
        return $this->belongsTo(Asset::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}