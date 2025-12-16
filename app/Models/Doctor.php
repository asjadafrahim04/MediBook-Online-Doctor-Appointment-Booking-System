<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'specialization',
        'qualification',
        'experience_years',
        'status', // pending, approved, rejected
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'experience_years' => 'integer',
        'status' => 'string',
    ];

    /**
     * Get the user that owns the doctor profile.
     * One-to-one inverse relationship
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the availability records for the doctor.
     * One-to-many relationship
     */
    public function availability()
    {
        return $this->hasMany(DoctorAvailability::class);
    }

    /**
     * Scope a query to only include approved doctors.
     */
    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }
    public function appointments()
    {
    return $this->hasMany(Appointment::class);
    }
}