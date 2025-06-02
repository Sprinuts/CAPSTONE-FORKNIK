<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $table = 'appointment';
    protected $fillable = [
        'user_id',
        'psychometrician_id',
        'date',
        'start_time',
        'end_time',
        'payment_status'
    ];
}