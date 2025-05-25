<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    protected $table = 'users';

    protected $fillable = [
        'name', // needed for registration
        'password', // needed for registration
        'status', // activated or deactivated
        'role', // ITSO, associate or student
        'email', // needed for registration
        'username', // needed for registration
        'activationcode',
        'resetcode',
    ];

    public function schedules()
    {
        return $this->hasMany(Schedule::class, 'psychometrician_id');
    }

    // Appointments made by this user (if patient)
    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'user_id');
    }

    // Appointments where the user is the psychometrician
    public function psychometricianAppointments()
    {
        return $this->hasMany(Appointment::class, 'psychometrician_id');
    }
}
