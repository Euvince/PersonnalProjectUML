<?php

namespace App\Http\Controllers\Client;

use App\Models\Hotel;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use App\Http\Requests\Client\ReservationFormRequest;
use App\Models\Chambre;
use App\Models\Facture;
use App\Models\Paiement;
use App\Models\Reservation;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

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
        dd('2024-02-20' <= '2024-02-15');
        if ($slug !== Str::slug($chambre->libelle)) {
            return to_route('clients.chambres.show', ['slug' => Str::slug($chambre->nom), 'chambre' => $chambre->id]);
        }
        return view('Client.Chambre.Chambre', [
            'chambre' => $chambre
        ]);
    }

    public function sendReservation (ReservationFormRequest $request, Chambre $chambre) : RedirectResponse | View
    {
        dd($request->validated());
        if ($chambre->reservations
            ->where('debut_sejour', '<=', $request->fin_sejour)
            ->where('fin_sejour', '>=', $request->debut_sejour)
            ->count() > 0
        )
        return
            redirect()
            ->route('clients.chambres.show', ['slug' => Str::slug($chambre->libelle), 'chambre' => $chambre->id])
            ->with('error', 'Cette chambre est déjà réservée pour cette période.');

        Reservation::create(array_merge(
            $request->validated(),
            [
                'chambre_id' => $chambre->id,
                'user_id' => Auth::user()->id,
                'date_reservation' => Carbon::now()->format('d-m-Y'),
                'prix_par_nuit' => $chambre->TypeChambre->prix_par_nuit,
            ]
        ));
        $chambre->update([
            'statut' => 'réservé'
        ]);

        $period = Carbon::parse($request->fin_sejour)->diffInDays(Carbon::parse($request->debut_sejour));
        $montant = $chambre->TypeChambre->prix_par_nuit * $period;

        /* auth()->user()->charge($montant, $request->payment_method); */

        $paiement = Paiement::create([
            'montant' => $montant,
            'date_paiement' => Carbon::now()->format('d-m-Y'),
            'user_id' => Auth::user()->id
        ]);

        $facture = Facture::create([
            'type' => 'départ',
            'paiement_id' => $paiement->id,
            'montant_total' => $paiement->montant_total
        ]);

        return
            redirect()
            ->route('clients.chambres.show', ['slug' => Str::slug($chambre->libelle), 'chambre' => $chambre->id])
            ->with('success', 'Votre réservation a été éffectuée avec succès.');
    }

}
