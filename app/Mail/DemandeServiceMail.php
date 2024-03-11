<?php

namespace App\Mail;

use App\Models\User;
use App\Models\Service;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Contracts\Queue\ShouldQueue;

class DemandeServiceMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(
        public Service $service
    )
    {
        //
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        /* $personnalServiceEmail = User::query()
            ->where('hotel_id', $this->service->chambre->hotel_id)
            ->whereHas('roles', function ($query) {
                $query->where('name', 'Personnel de Service');
            })
        ->get()->first()->email; */

        return new Envelope(
            to: $this->service->chambre->hotel->email,
            replyTo: $this->service->email_client,
            subject: 'Demande de Service',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'mail.demande-service-mail',
            with: ['service' => $this->service]
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
