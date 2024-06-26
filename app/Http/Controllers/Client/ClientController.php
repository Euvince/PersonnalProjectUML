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
use App\Jobs\CheckOutJob;
use App\Jobs\DemandeServiceJob;
use App\Models\Service;
use App\Models\TypeService;
use Illuminate\Http\Response;

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

    public function infosHotel (String $slug, Hotel $hotel) : View | RedirectResponse
    {
        if ($slug !== Str::slug($hotel->nom)) {
            return to_route('clients.hotels.infos', ['slug' => Str::slug($hotel->nom), 'hotel' => $hotel->id]);
        }
        return view('Client.Hotels.infos', [
            'hotel' => $hotel
        ]);
    }

    public function downloadInfosHotel(Hotel $hotel)
    {
        $pdf = FacadePdf::loadView('Client.Hotels.infos-download', [
            'hotel' => $hotel
        ])
        ->setOptions(['defaultFont' => 'sans-serif'])
        ->setPaper('A4', 'portrait');
        return $pdf->download("$hotel->nom.pdf");
    }

    public function showChambre (String $slug, Chambre $chambre) : View | RedirectResponse
    {
        if ($slug !== Str::slug($chambre->libelle)) {
            return to_route('clients.chambres.show', ['slug' => Str::slug($chambre->libelle), 'chambre' => $chambre->id]);
        }
        return view('Client.Chambre.chambre', [
            'chambre' => $chambre
        ]);
    }

    public function infosChambre (String $slug, Chambre $chambre) : View | RedirectResponse
    {
        if ($slug !== Str::slug($chambre->libelle)) {
            return to_route('clients.chambres.infos', ['slug' => Str::slug($chambre->libelle), 'chambre' => $chambre->id]);
        }
        return view('Client.Chambre.infos', [
            'chambre' => $chambre,
            'reservations' => $chambre->reservations->sortBy('debut_sejour')
        ]);
    }

    public function downloadInfosChambre(Chambre $chambre)
    {
        $pdf = FacadePdf::loadView('Client.Chambre.infos-download', [
            'chambre' => $chambre,
            'reservations' => $chambre->reservations->sortBy('debut_sejour')
        ])
        ->setOptions(['defaultFont' => 'sans-serif'])
        ->setPaper('A4', 'portrait');
        return $pdf->download("$chambre->numero.pdf");
    }

    public function reservations() : View
    {
        return view('Client.Reservation.reservations');
    }

    public function sendReservation (ReservationFormRequest $request, Chambre $chambre) : RedirectResponse | View
    {
        if ($chambre->reservations
            ->where('termine', 0)
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

    public function services(Reservation $reservation) : View
    {
        if (!$reservation->isFinished()) {
            return view('Client.DemandeService.demandes-services', [
                'reservation' => $reservation
            ]);
        }
        return back();
    }

    public function showFormToAskService(Chambre $chambre) : RedirectResponse | View
    {
        $demande_service = new Service();
        if ($chambre->isOccupied() &&
            $chambre->reservations
            ->where('confirme', 1)
            ->where('termine', 0)
            ->where('user_id', Auth::user()->id)
            ->count() > 0
        ) {
            return view('Client.DemandeService.demande-service-form', [
                'chambre' => $chambre,
                'demande_service' => $demande_service,
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
            'date_demande_service' => Carbon::now()
        ]));

        DemandeServiceJob::dispatch($service);
        $reservation = Reservation::where('chambre_id', $service->chambre_id)->first();
        return
            redirect()
            ->route('clients.services', ['reservation' => $reservation->id])
            ->with('success', 'Votre demande de service a été envoyé avec succès.');
    }

    public function showFormToEditService(Service $demande_service) : RedirectResponse | View
    {
        if ($demande_service->isRendered())
        return
            back()
            ->withErrors(['error' => 'La demande est déjà rendue.']);
        if (!$demande_service->chambre->isOccupied())
        return
            back()
            ->withErrors(['error' => 'La chambre n\'est plus occupée.']);
        if ($demande_service->chambre->isOccupied() &&
            $demande_service->chambre->reservations->where('confirme', 1)
            ->where('user_id', Auth::user()->id)
            ->count() > 0
        ) {
            return view('Client.DemandeService.demande-service-form', [
                'demande_service' => $demande_service,
                'chambre' => $demande_service->chambre,
                'typesServices' => TypeService::all()->pluck('type', 'id')
            ]);
        }
        return
            redirect()
            ->route('clients.hotels.index')
            ->withErrors(['error' => 'Vous ne pouvez pas éditer de demande de service dans cette chambre.']);
    }

    public function updateDemandeService(DemandeServiceFormRequest $request, Service $demande_service) : RedirectResponse
    {
        $demande_service->update($request->validated());
        $reservation = Reservation::where('chambre_id', $demande_service->chambre_id)->first();
        return
            redirect()
            ->route('clients.services', ['reservation' => $reservation->id])
            ->with('success', 'Votre demande de service a été éditée avec succès.');
    }

    public function cancelDdemandeService(Service $demande_service) : RedirectResponse
    {
        if ($demande_service->isRendered())
        return
            back()
            ->withErrors(['error' => 'La demande est déjà rendue.']);
        if (!$demande_service->chambre->isOccupied())
        return
            back()
            ->withErrors(['error' => 'La chambre n\'est plus occupée.']);
        $demande_service->delete();
        return
            back()
            ->with('success', 'La demande de service a été annulée avec succès.');
    }

    public function checkOut(Reservation $reservation) : View | RedirectResponse
    {
        if (!$reservation->isFinished()) {
            return view('Client.Reservation.chek-out-form', [
                'reservation' => $reservation,
                'total_price' => $reservation->getTotalPriceForCheckOut()
            ]);
        }
        return back();
    }

    public function checkOutSubmitted(Request $request, Reservation $reservation) : RedirectResponse | Response
    {
        if (!$reservation->isFinished()) {
            /* auth()->user()->charge($montant, $request->payment_method, User::stripeOptions()); */

            $paiement = Paiement::create([
                'montant' => $reservation->getTotalPriceForCheckOut(),
                'user_id' => Auth::user()->id,
                'reservation_id' => $reservation->id,
                'nom_client' => $reservation->nom_client,
                'prenoms_client' => $reservation->prenoms_client,
                'email_client' => $reservation->email_client,
                'telephone_client' => $reservation->telephone_client,
                'date_paiement' => Carbon::now()->format('Y-m-d'),
                'moyen_paiement_id' =>MoyenPaiement::where('moyen', 'STRIPE')->first()->id
            ]);

            $facture = Facture::create([
                'type' => 'retour',
                'paiement_id' => $paiement->id,
                'montant_total' => $paiement->montant,
                'nom_client' => $reservation->nom_client,
                'prenoms_client' => $reservation->prenoms_client,
                'email_client' => $reservation->email_client,
                'telephone_client' => $reservation->telephone_client,
            ]);

            CheckOutJob::dispatch($reservation);

            $reservation->markAsFinished();

            $pdf = FacadePdf::loadView('Client.Reservation.check-out-facture', [
                'facture' => $facture,
                'chambre' => $reservation->chambre,
            ])
            ->setOptions(['defaultFont' => 'sans-serif'])
            ->setPaper('A4', 'portrait');
            return $pdf->download('facture.pdf');
        }
        return
            redirect()
            ->route('clients.reservations');
    }

}
