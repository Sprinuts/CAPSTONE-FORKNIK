<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{

    protected $table = 'appointment';
    protected $fillable = ['user_id', 'psychometrician_id', 'date', 'start_time', 'end_time'];

    public function users()
    {
        return $this->belongsTo(Users::class, 'user_id');
    }

    public function psychometrician()
    {
        return $this->belongsTo(Users::class, 'psychometrician_id');
    }
}