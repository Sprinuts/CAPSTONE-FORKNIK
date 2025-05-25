<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $fillable = ['psychometrician_id', 'date', 'start_time', 'end_time'];

    public function psychometrician()
    {
        return $this->belongsTo(Users::class, 'psychometrician_id');
    }
}
