<?php

namespace App\Console\Commands;

use App\Jobs\NotifyTheUserThatTheyCanBeginTheirStayJob;
use Carbon\Carbon;
use App\Models\Reservation;
use Illuminate\Console\Command;

class NotifyTheUserThatTheyCanBeginTheirStay extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:notify-the-user-that-they-can-begin-their-stay';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "
        Cette tâche se chargera de notifier à un utilisateur qu'il peut
        passer à l'hôtel confirmer sa réservation pour démarrer son séjour
    ";

    /**
     * Execute the console command.
     */
    public function handle()
    {
        foreach (Reservation::all() as $reservation) {
            if (Carbon::parse($reservation->debut_sejour)->isPast()) {
                NotifyTheUserThatTheyCanBeginTheirStayJob::dispatch($reservation);
            }
        }
    }
}
