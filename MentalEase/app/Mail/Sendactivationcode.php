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

    /**
     * Get the message envelope.
     */
    public function build()
    {
        return $this->subject('Activation Code')
            ->view('email.activationcode')
            ->with([
                'code' => $this->activationcode,
            ]);
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Sendactivationcode',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'view.name',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
