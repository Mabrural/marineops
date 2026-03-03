<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Asset extends Model
{
    use HasFactory;

    protected $fillable = ['company_id', 'vessel_id', 'asset_group_id', 'name', 'model', 'qty', 'remarks', 'created_by'];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function vessel()
    {
        return $this->belongsTo(Vessel::class);
    }

    public function group()
    {
        return $this->belongsTo(AssetGroup::class, 'asset_group_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function maintenanceLogs()
    {
        return $this->hasMany(AssetMaintenanceLog::class);
    }
}
