<?php

namespace App\Http\Controllers\Client;

use App\Models\Hotel;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use App\Http\Requests\Client\ReservationFormRequest;
use App\Models\Chambre;
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
        if ($slug !== Str::slug($chambre->libelle)) {
            return to_route('clients.chambres.show', ['slug' => Str::slug($chambre->nom), 'chambre' => $chambre->id]);
        }
        return view('Client.Chambre.Chambre', [
            'chambre' => $chambre
        ]);
    }

    public function sendReservation (ReservationFormRequest $request, Chambre $chambre)/*  : RedirectResponse | View */
    {
        dd($request->validated());
        Reservation::create(array_merge(
            $request->validated(),
            [
                'chambre_id' => $chambre->id,
                'user_id' => Auth::user()->id,
                'date_reservation' => Carbon::now()->format('d-m-Y'),
                'prix_par_nuit' => $chambre->TypeChambre->prix_par_nuit,
            ]
        ));
        /* return
            redirect()
            ->route('personnal-profile.edit', ['user' => $user])
            ->with('success', 'Votre profile a été modifié avec succès.'); */
    }

}
