<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

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
        'phone',   // Optional but good to have
        'role',    // Already there — perfect!
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
        'role' => 'string', // Good to cast role
    ];

    /**
     * Get the doctor record associated with the user.
     * One-to-one relationship: one user → one doctor record
     */
    public function doctor()
    {
        return $this->hasOne(Doctor::class);
    }

    public function appointments()
    {
    return $this->hasMany(Appointment::class, 'patient_id');
    }
}