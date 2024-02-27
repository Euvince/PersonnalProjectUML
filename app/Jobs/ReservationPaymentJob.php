<?php

namespace App\Jobs;

use App\Models\Chambre;
use App\Models\Facture;
use App\Models\Reservation;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use App\Mail\ReservationPaymentMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class ReservationPaymentJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
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
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::send(new ReservationPaymentMail(
            $this->facture,
            $this->chambre,
            $this->reservation,
            $this->downloadFactureRoute
        ));
    }
}
