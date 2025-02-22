<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Enums\UserRole;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'role' => UserRole::class,
    ];

    function hasRole($role)
    {
        return $this->role == UserRole::from($role);
    }

    /**
     * Get all of the penanggungJawab for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function penanggungJawab(): HasMany
    {
        return $this->hasMany(ProgramKerja::class);
    }
    /**
     * Get all of the detailIuran for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function detailIuran(): HasMany
    {
        return $this->hasMany(DetailIuran::class);
    }
}
