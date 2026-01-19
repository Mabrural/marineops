<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = ['name', 'email', 'password', 'is_platform_admin', 'is_active'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function companies()
    {
        return $this->belongsToMany(Company::class, 'user_companies')->withPivot('is_active')->withTimestamps();
    }

    public function userCompany()
    {
        return $this->hasOne(UserCompany::class);
    }

    public function company()
    {
        return $this->hasOneThrough(
            Company::class,
            UserCompany::class,
            'user_id',     // FK di user_companies
            'id',          // PK di companies
            'id',          // PK di users
            'company_id'   // FK di user_companies ke companies
        );
    }
}
