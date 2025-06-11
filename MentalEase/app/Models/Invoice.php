<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{

    protected $table = 'invoices';
    protected $fillable = ['user_id', 'reference_number', 'payment_status', 'amount'];
}
