<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $table = 'invoices';
    protected $fillable = ['user_id', 'reference_number', 'payment_status', 'amount', 'payment_method', 'service_type'];

    /**
     * Get the client/user associated with this invoice.
     */
    public function client()
    {
        return $this->belongsTo(Users::class, 'user_id');
    }
}

