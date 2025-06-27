<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $table = 'payment';
    
    protected $fillable = [
        'reference_number',
        'patient_id',
        'amount',
        'payment_method',
        'service_type',
        'status'
    ];

    /**
     * Get the patient associated with the payment.
     */
    public function patient()
    {
        return $this->belongsTo(Users::class, 'patient_id');
    }
}
