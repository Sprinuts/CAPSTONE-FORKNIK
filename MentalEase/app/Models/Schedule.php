<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $table = 'schedules';
    protected $fillable = ['psychometrician_id', 'date', 'start_time', 'end_time', 'day_of_week', 'scheduled'];

    public function psychometrician()
    {
        return $this->belongsTo(Users::class, 'psychometrician_id');
    }
}