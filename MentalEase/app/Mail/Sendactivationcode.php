<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class Sendactivationcode extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public $activationcode;

    public function __construct($activationcode)
    {
        $this->activationcode = $activationcode;
    }

    public function build()
    {
        return $this->subject('Activation Code')
            ->view('email.activationcode')
            ->with([
                'code' => $this->activationcode,
            ]);
    }
}
