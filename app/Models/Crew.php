<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Crew extends Model
{
    use HasFactory;

    protected $table = 'crews';

    /**
     * Mass assignable attributes
     */
    protected $fillable = [
        'company_id',
        'vessel_id',
        'name',
        'gender',
        'date_of_birth',
        'nationality',
        'seafarer_code',
        'seafarer_book_number',
        'seafarer_book_expired_at',
        'position',
        'certificate',
        'certificate_number',
        'is_active',
        'created_by',
    ];

    /**
     * Attribute casting
     */
    protected $casts = [
        'date_of_birth' => 'date',
        'seafarer_book_expired_at' => 'date',
        'is_active' => 'boolean',
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

    public function vessel()
    {
        return $this->belongsTo(Vessel::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
