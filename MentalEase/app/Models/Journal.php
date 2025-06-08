<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Journal extends Model
{
    protected $table = 'journal';
    protected $fillable = ['user_id', 'mood', 'emotion', 'thoughts', 'created_at'];
}
