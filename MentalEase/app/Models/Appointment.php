<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $fillable = ['user_id', 'psychometrician_id', 'date', 'start_time', 'end_time', 'payment_status'];

    public function user()
    {
        return $this->belongsTo(Users::class, 'user_id');
    }

    public function psychometrician()
    {
        return $this->belongsTo(Users::class, 'psychometrician_id');
    }
}