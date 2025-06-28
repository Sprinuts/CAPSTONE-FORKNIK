<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $table = 'invoices';
    protected $fillable = ['user_id', 'reference_number', 'payment_status', 'amount', 'payment_method', 'service_type', 'appointment_id', 'schedule_id'];

    /**
     * Get the client/user associated with this invoice.
     */
    public function client()
    {
        return $this->belongsTo(Users::class, 'user_id');
    }

    /**
     * Get the appointment associated with this invoice.
     */
    public function appointment()
    {
        return $this->belongsTo(Appointment::class, 'appointment_id');
    }
}


