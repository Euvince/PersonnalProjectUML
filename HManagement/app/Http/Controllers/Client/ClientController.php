<?php

namespace App\Http\Controllers\Client;

use App\Models\Hotel;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;

class ClientController extends Controller
{
    public function index() : View
    {
        /* dd(Hotel::whereHas('departement', function ($query) {
            $query->where('nom', 'LIKE', "%cole inc%");
        })->get()); */
        return view('Client.Hotels.hotels');
    }

    public function show (String $slug, Hotel $hotel) : View | RedirectResponse
    {
        if ($slug !== Str::slug($hotel->nom)) {
            return to_route('clients.hotels.show', ['slug' => Str::slug($hotel->nom), 'hotel' => $hotel->id]);
        }
        return view('Client.Hotels.hotel', [
            'hotel' => $hotel
        ]);
    }

}
