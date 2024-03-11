<?php

namespace App\Http\Controllers\Client;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Hotel;
use App\Models\Chambre;
use App\Models\Facture;
use App\Models\Paiement;
use Barryvdh\DomPDF\PDF;
use App\Models\Reservation;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\MoyenPaiement;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use App\Http\Requests\Client\DemandeServiceFormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Jobs\ReservationPaymentJob;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use App\Http\Requests\Client\ReservationFormRequest;
use App\Jobs\DemandeServiceJob;
use App\Models\Service;
use App\Models\TypeService;

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
            ->withErrors(['error' => 'La chambre est déjà réservée pour la période que vous indiquez.'])
            ->withInput();

        $newTable = array_diff($request->validated(),
            ['nom_client', 'prenoms_client', 'email_client', 'telephone_client']
        );

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
            'reservation_id' => $reservation->id,
            'nom_client' => $reservation->nom_client,
            'prenoms_client' => $reservation->prenoms_client,
            'email_client' => $reservation->email_client,
            'telephone_client' => $reservation->telephone_client,
            'date_paiement' => Carbon::now()->format('Y-m-d'),
            'moyen_paiement_id' =>MoyenPaiement::where('moyen', 'STRIPE')->first()->id
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
            ->route('clients.chambres.show', ['slug' => Str::slug($chambre->libelle), 'chambre' => $chambre->id])
            ->with('success', 'Votre réservation est confirmée.');
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
        $pdf = FacadePdf::loadView('Client.Reservation.facture', [
            'facture' => $facture,
            'chambre' => $chambre
        ])
        ->setOptions(['defaultFont' => 'sans-serif'])
        ->setPaper('A4', 'portrait');
        /* $pdf->save(public_path("storage/factures/")); */
        return $pdf->download('facture.pdf');
    }

    public function showFormToAskService(Chambre $chambre) : RedirectResponse | View
    {
        if ($chambre->isOccupied() &&
            $chambre->reservations->where('confirme', 1)
            ->where('user_id', Auth::user()->id)
            ->count() > 0
        ) {
            return view('Client.DemandeService.demande-service-form', [
                'chambre' => $chambre,
                'typesServices' => TypeService::all()->pluck('type', 'id')
            ]);
        }
        return
            redirect()
            ->route('clients.hotels.index')
            ->withErrors(['error' => 'Vous ne pouvez pas éffectuer de demande de service dans cette chambre.']);
    }

    public function sendDemandeService(DemandeServiceFormRequest $request, Chambre $chambre) : RedirectResponse
    {
        $service = Service::create(array_merge($request->validated(), [
            'user_id' => Auth::user()->id,
            'chambre_id' => $chambre->id,
            'nom_client' => Auth::user()->nom,
            'email_client' => Auth::user()->email,
            'prenoms_client' => Auth::user()->prenoms,
            'telephone_client' => Auth::user()->telephone,
        ]));

        DemandeServiceJob::dispatch($service);
        return
            back()
            ->with('success', 'Votre demande de service a été envoyé avec succès.');
    }

}
