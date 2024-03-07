<?php

namespace App\Mail;

use App\Models\Chambre;
use App\Models\Facture;
use App\Models\Reservation;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Contracts\Queue\ShouldQueue;

class EditReservationMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(
        public Facture $facture,
        public Chambre $chambre,
        public Reservation $reservation,
        public String $downloadFactureRoute
    )
    {
        //
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            to: $this->facture->email_client,
            subject: 'Modification de réservation de chambre',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'mail.edit-reservation-mail',
            with: [
                'facture' => $this->facture,
                'chambre' => $this->chambre,
                'reservation' => $this->reservation,
                'url' => $this->downloadFactureRoute,
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
        return [];
    }
}
