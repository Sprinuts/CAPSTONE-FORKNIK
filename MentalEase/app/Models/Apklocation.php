<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Apklocation extends Model
{
    protected $table = 'apklocation';
    protected $fillable = ['apk_path', 'created_at', 'updated_at'];
}
