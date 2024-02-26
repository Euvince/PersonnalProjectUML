<?php

namespace App\Jobs;

use App\Mail\ReservationPaymentMail;
use App\Models\Chambre;
use App\Models\Facture;
use App\Models\Reservation;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

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
