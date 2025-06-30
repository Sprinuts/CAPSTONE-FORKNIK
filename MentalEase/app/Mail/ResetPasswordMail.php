<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ResetPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public $resetcode;

    public function __construct($resetcode)
    {
        $this->resetcode = $resetcode; 
    }

    public function build()
    {
        return $this->subject('Activation Code')
            ->view('email.resetcode')
            ->with([
                'code' => $this->resetcode,
            ]);
    }
}
