<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ConfimacionMascota extends Mailable
{
    use Queueable, SerializesModels;
    private $qr;
    /**
     * Create a new message instance.
     */
    public function __construct($qr)
    {
        //
        $this->qr = $qr;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Confimacion Mascota',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown:'email.MascotaConfimarcion',
            with:[
                'QR'=> $this->qr,
            ]

        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [
            \Illuminate\Mail\Mailables\Attachment::fromData(
                fn () => $this->qr,
                'qr_mascota.png'
            )->withMime('image/png'),
        ];
    }
}
