<?php

namespace App\Http\Controllers\Client;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Hotel;
use App\Models\Chambre;
use App\Models\Facture;
use App\Models\Paiement;
use App\Models\Reservation;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Client\ReservationFormRequest;
use App\Jobs\ReservationPaymentJob;
use App\Models\MoyenPaiement;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Barryvdh\DomPDF\PDF;

class ClientController extends Controller
{

    public function index() : View
    {
        /* dd(Hotel::whereHas('departement', function ($query) {
            $query->where('nom', 'LIKE', "%cole inc%");
        })->get()); */
        return view('Client.Hotels.hotels');
    }

    public function showHotel (String $slug, Hotel $hotel) : View | RedirectResponse
    {
        if ($slug !== Str::slug($hotel->nom)) {
            return to_route('clients.hotels.show', ['slug' => Str::slug($hotel->nom), 'hotel' => $hotel->id]);
        }
        /* dd(Hotel::find(5)->chambres->paginate(1)); */
        return view('Client.Hotels.hotel', [
            'hotel' => $hotel
        ]);
    }

    public function showChambre (String $slug, Chambre $chambre) : View | RedirectResponse
    {
        if ($slug !== Str::slug($chambre->libelle)) {
            return to_route('clients.chambres.show', ['slug' => Str::slug($chambre->libelle), 'chambre' => $chambre->id]);
        }
        return view('Client.Chambre.Chambre', [
            'chambre' => $chambre
        ]);
    }

    public function sendReservation (ReservationFormRequest $request, Chambre $chambre) : RedirectResponse | View
    {
        if ($chambre->reservations
            ->where('debut_sejour', '<=', $request->fin_sejour)
            ->where('fin_sejour', '>=', $request->debut_sejour)
            ->count() > 0
        )
        return
            redirect()
            ->route('clients.chambres.show', ['slug' => Str::slug($chambre->libelle), 'chambre' => $chambre->id])
            ->with('error', 'La chambre est déjà réservée pour la période que vous indiquez.');

        $reservation = Reservation::create(array_merge(
            $request->validated(),
            [
                'chambre_id' => $chambre->id,
                'user_id' => Auth::user()->id,
                'date_reservation' => Carbon::now()->format('Y-m-d'),
                'prix_par_nuit' => $chambre->TypeChambre->prix_par_nuit,
            ]
        ));

        $period = Carbon::parse($request->fin_sejour)->diffInDays(Carbon::parse($request->debut_sejour));
        $montant = $chambre->TypeChambre->prix_par_nuit * $period;

        /* auth()->user()->charge($montant, $request->payment_method, User::stripeOptions()); */

        $paiement = Paiement::create([
            'montant' => $montant,
            'user_id' => Auth::user()->id,
            'date_paiement' => Carbon::now()->format('Y-m-d'),
            'moyen_paiement_id' =>MoyenPaiement::where('moyen', 'STRIPE')->first()->id
        ]);

        $chambre->update([
            'statut' => 'Réservé'
        ]);
        $reservation->update([
            'statut' => 'Payé'
        ]);

        $facture = Facture::create([
            'type' => 'départ',
            'paiement_id' => $paiement->id,
            'montant_total' => $paiement->montant
        ]);

        $downloadFactureRoute = route('clients.facture-download', ['facture' => $facture, 'chambre' => $chambre]);
        ReservationPaymentJob::dispatch($facture, $chambre, $reservation, $downloadFactureRoute);

        return
            redirect()
            ->route('clients.chambres.show', ['slug' => Str::slug($chambre->libelle), 'chambre' => $chambre->id])
            ->with('success', 'Votre réservation est confirmée,.');
    }

    public function showFacture (Facture $facture, Chambre $chambre) : View
    {
        return view('Client.Reservation.facture', [
            'chambre' => $chambre,
            'facture' => $facture,
        ]);
    }

    public function downloadFacture (Facture $facture, Chambre $chambre)
    {
        /* $pdf = PDF::loadView()->setPaper('A4', 'portrait'); */
        $pdf = FacadePdf::loadView('Client.Reservation.facture', [
            'facture' => $facture,
            'chambre' => $chambre
        ])->setPaper('A4', 'portrait');
        /* $pdf->save(public_path("storage/factures/")); */
        return $pdf->download('facture' . "pdf");
    }

}