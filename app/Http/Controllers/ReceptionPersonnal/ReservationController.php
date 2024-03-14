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
use App\Jobs\CancelReservationJob;
use App\Jobs\ConfirmReservationJob;
use App\Jobs\EditReservationJob;

class ReservationController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(Reservation::class, 'reservation');
    }

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
            'chambres' => Auth::user()->hotel->chambres/* ->sortBy('libelle') */->pluck('libelle', 'id'),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ReservationFormRequest $request) : RedirectResponse
    {
        $chambre = Chambre::find(request()->chambre_id);
        if ($chambre->reservations
            ->where('termine', 0)
            ->where('debut_sejour', '<=', $request->fin_sejour)
            ->where('fin_sejour', '>=', $request->debut_sejour)
            ->count() > 0
        )
        return
            back()
            ->with('error', 'La chambre est déjà réservée pour la période que vous indiquez.')
            ->withInput();

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
            'reservation_id' => $reservation->id,
            'nom_client' => $reservation->nom_client,
            'prenoms_client' => $reservation->prenoms_client,
            'email_client' => $reservation->email_client,
            'telephone_client' => $reservation->telephone_client,
            'date_paiement' => Carbon::now()->format('Y-m-d'),
            'moyen_paiement_id' => MoyenPaiement::where('moyen', 'STRIPE')->first()->id
        ]);

        $chambre->markAsReserved();

        $reservation->markAsPaid();

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
     * Display the specified resource.
     */
    public function show(Reservation $reservation) : View
    {
        return view('ReceptionPersonnal.Reservation.reservation', compact('reservation'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reservation $reservation) : View
    {
        return view('ReceptionPersonnal.Reservation.reservation-form', [
            'reservation' => $reservation,
            'chambres' => Auth::user()->hotel->chambres/* ->sortBy('libelle') */->pluck('libelle', 'id'),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ReservationFormRequest $request, Reservation $reservation) : RedirectResponse
    {
        $chambre = Chambre::find(request()->chambre_id);
        if ($chambre->reservations
            ->where('id', '!=', $reservation->id)
            ->where('termine', 0)
            ->where('debut_sejour', '<=', $request->fin_sejour)
            ->where('fin_sejour', '>=', $request->debut_sejour)
            ->count() > 0
        )
        return
            back()
            ->with('error', 'La chambre est déjà réservée pour la période que vous indiquez.')
            ->withInput();

        $paiement = Paiement::find($reservation->paiement->id);
        $paiement->delete();
        foreach ($paiement->factures as $facture) {
            $facture->delete();
        }

        $reservation->update($request->validated());

        $period = Carbon::parse($request->fin_sejour)->diffInDays(Carbon::parse($request->debut_sejour));
        $montant = $chambre->TypeChambre->prix_par_nuit * $period;

        /* auth()->user()->charge($montant, $request->payment_method, User::stripeOptions()); */

        $paiement = Paiement::create([
            'montant' => $montant,
            'user_id' => Auth::user()->id,
            'reservation_id' => $reservation->id,
            'nom_client' => $reservation->nom_client,
            'prenoms_client' => $reservation->prenoms_client,
            'email_client' => $reservation->email_client,
            'telephone_client' => $reservation->telephone_client,
            'date_paiement' => Carbon::now()->format('Y-m-d'),
            'moyen_paiement_id' => MoyenPaiement::where('moyen', 'STRIPE')->first()->id
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
        EditReservationJob::dispatch($facture, $chambre, $reservation, $downloadFactureRoute);

        return
            redirect()
            ->route('reception-personnal.reservations.index')
            ->with('success', 'La réservation a été éditée avec succès.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reservation $reservation) : RedirectResponse
    {
        $reservation->delete();
        $paiement = Paiement::find($reservation->paiement->id);
        $paiement->delete();
        foreach ($paiement->factures as $facture) {
            $facture->delete();
        }
        if ($reservation->chambre->isOccupied()) {
            $reservation->chambre->markAsAvailable();
        }
        /* ÉCRIRE LE CODE POUR REMBOURSER LE CLIENT */
        CancelReservationJob::dispatch($reservation);
        return
            redirect()
            ->route('reception-personnal.reservations.index')
            ->with('success', 'La réservation a été annulée avec succès.');
    }

    public function confirmReservation(Reservation $reservation) : RedirectResponse
    {
        $this->authorize('confirmReservation', $reservation);
        if (!$reservation->canBeConfirmed()) {
            return
                redirect()
                ->route('reception-personnal.reservations.index')
                ->with('error', 'La période de réservation n\'étant pas atteinte, vous ne pouvez donc pas confirmez cette réservation.');
        }
        if (Reservation::query()
            ->where('debut_sejour', '<=', $reservation->debut_sejour)
            ->where('chambre_id', $reservation->chambre_id)
            ->where('id', '!=', $reservation->id)
            ->get()->count() > 0 && !$reservation->chambre->isOccupied()
            ) {
            return
                redirect()
                ->route('reception-personnal.reservations.index')
                ->with('error', 'Une réservation existait pour cette chambre(actuellement disponible) avant celle ci et doit être confirmée d\'abord.');
        }
        if ($reservation->isConfirmed()) {
            return
                redirect()
                ->route('reception-personnal.reservations.index')
                ->with('error', 'La réservation est déjà confirmée.');
        }
        if (!$reservation->isConfirmed() && $reservation->chambre->isOccupied()) {
            return
                redirect()
                ->route('reception-personnal.reservations.index')
                ->with('error', 'La chambre concernée par cette réservation est occupée actuellement.');
        }
        if ($reservation->chambre->isReserved() && $reservation->chambre->isAvailable()) {
            $reservation->markAsConfirmed();
            $reservation->chambre->markAsOccupied();
            ConfirmReservationJob::dispatch($reservation);
        }
        return
            redirect()
            ->route('reception-personnal.reservations.index')
            ->with('success', 'Le check-in a été éffectué avec succès.');
    }

}
