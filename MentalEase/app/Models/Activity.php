<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'description',
        'type',
        'icon',
        'color'
    ];

    // Relationship with user
    public function user()
    {
        return $this->belongsTo(Users::class, 'user_id');
    }
}