<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Amprahan extends Model
{
    protected $fillable = [
        'company_id',
        'vessel_id',
        'supply_date',
        'item',
        'specification',
        'qty',
        'unit',
        'vendor_name',
        'unit_price',
        'total_price',
        'created_by',
    ];

    protected $casts = [
        'supply_date' => 'date',
        'unit_price' => 'decimal:2',
        'total_price' => 'decimal:2',
    ];

    // Relasi
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function vessel()
    {
        return $this->belongsTo(Vessel::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}