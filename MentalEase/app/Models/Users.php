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

    public $timestamps = true;
}
