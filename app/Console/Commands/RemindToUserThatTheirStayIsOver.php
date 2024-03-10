<?php

namespace App\Console\Commands;

use App\Jobs\RemindToUserThatTheirStayIsOverJob;
use App\Models\Reservation;
use Carbon\Carbon;
use Illuminate\Console\Command;

class RemindToUserThatTheirStayIsOver extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:remind-to-user-that-their-stay-is-over';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "
        Cette tâche se chargera de notifier à l'tilisateur
        via un mail que la durée de son séjour est écoulée
    ";

    /**
     * Execute the console command.
     */
    public function handle()
    {
        foreach (Reservation::all() as $reservation) {
            if (Carbon::parse($reservation->fin_sejour)->isPast()) {
                RemindToUserThatTheirStayIsOverJob::dispatch($reservation);
            }
        }
    }
}
