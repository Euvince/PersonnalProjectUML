<?php

namespace App\Http\Controllers\ReceptionPersonnal;

use Carbon\Carbon;
use App\Models\Chambre;
use App\Models\Facture;
use App\Models\Paiement;
use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Models\MoyenPaiement;
use App\Jobs\ReservationPaymentJob;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\ReceptionPersonnal\ReservationFormRequest;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() : View
    {
        return view('ReceptionPersonnal.Reservation.reservations');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() : View
    {
        $reservation = new Reservation();

        $reservation->fill([
            'nom_client' => "AGOSSOU",
            'prenoms_client' => "Gilles",
            'email_client' => "gilles@gmail.com",
            'telephone_client' => "+229 65141420",
            'debut_sejour' => "12/12/2024",
            'fin_sejour' => "12/12/2025",
        ]);

        return view('ReceptionPersonnal.Reservation.reservation-form', [
            'reservation' => $reservation,
            'chambres' => Auth::user()->hotel->chambres->sortBy('libelle')->pluck('libelle', 'id'),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ReservationFormRequest $request) : RedirectResponse
    {
        $chambre = Chambre::find(request()->chambre_id);
        if ($chambre->reservations
            ->where('debut_sejour', '<=', $request->fin_sejour)
            ->where('fin_sejour', '>=', $request->debut_sejour)
            ->count() > 0
        )
        return
            back()
            ->with('error', 'La chambre est déjà réservée pour la période que vous indiquez.');

        $reservation = Reservation::create(array_merge(
            $request->validated(),
            [
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
            'nom_client' => $reservation->nom_client,
            'prenoms_client' => $reservation->prenoms_client,
            'email_client' => $reservation->email_client,
            'telephone_client' => $reservation->telephone_client,
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
            'montant_total' => $paiement->montant,
            'nom_client' => $reservation->nom_client,
            'prenoms_client' => $reservation->prenoms_client,
            'email_client' => $reservation->email_client,
            'telephone_client' => $reservation->telephone_client,
        ]);

        $downloadFactureRoute = route('clients.facture-download', ['facture' => $facture, 'chambre' => $chambre]);
        ReservationPaymentJob::dispatch($facture, $chambre, $reservation, $downloadFactureRoute);

        return
            redirect()
            ->route('reception-personnal.reservations.index')
            ->with('success', 'La réservation a été faite avec succès.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reservation $reservation) /* : View */
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ReservationFormRequest $request, Reservation $reservation) /* : RedirectResponse */
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reservation $reservation) /* : RedirectResponse */
    {
        //
    }
}
