<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class Users extends Model
{
    protected $table = 'users';

    protected $fillable = [
        'id', // primary key
        'name', // needed for registration
        'middle_name', // added for profile completion
        'last_name', // added for profile completion
        'password', // needed for registration
        'status', // activated or deactivated
        'role', // ITSO, associate or student
        'email', // needed for registration
        'username', // needed for registration
        'activationcode',
        'resetcode',
        'contactnumber', // needed for registration
        'address', // added for profile completion
        'gender', // added for profile completion
        'civil_status', // added for profile completion
        'birthdate', // added for profile completion
        'birthplace', // added for profile completion
        'religion', // added for profile completion
        'age', // calculated from birthdate
        'disable', // to disable the account
        'has_completed_profile', // flag to track profile completion
        'control_number', // added for profile completion
    ];

    public function schedules()
    {
        return $this->hasMany(Schedule::class, 'psychometrician_id');
    }

    // Appointments made by this user (if patient)
    public function appointment()
    {
        return $this->hasMany(Appointment::class, 'user_id');
    }

    // Appointments where the user is the psychometrician
    public function psychometricianAppointments()
    {
        return $this->hasMany(Appointment::class, 'psychometrician_id');
    }

    public function verifyPassword($password)
    {
        // Try Laravel's Hash::check first
        if (Hash::check($password, $this->password)) {
            return true;
        }
        
        // Handle React Native old format
        if (password_verify($password, $this->password)) {
            return true;
        }
        
        return false;
    }
}


