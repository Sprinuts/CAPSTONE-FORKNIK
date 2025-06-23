<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class Sendrefund extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public $referencecode;

    public function __construct($referencecode)
    {
        $this->referencecode = $referencecode; 
    }

    public function build()
    {
        return $this->subject('Appointment Refund')
            ->view('email.appointmentrefund')
            ->with([
                'reference' => $this->referencecode,
            ]);
    }
}
