<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Concerns extends Model
{
    protected $table = 'concerns';
    protected $fillable = ['name', 'email', 'subject', 'message', 'created_at', 'updated_at'];
}
