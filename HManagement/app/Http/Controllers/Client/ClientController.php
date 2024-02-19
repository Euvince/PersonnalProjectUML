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
        return view('Client.Hotels.hotels', ['hotels' => Hotel::paginate(30)]);
    }

    public function show (String $slug, Hotel $hotel) : View | RedirectResponse
    {
        $hotelSlug = Str::slug($$hotel->nom);
        if ($slug !== $hotelSlug) {
            return to_route('clients.hotels.show', ['slug' => $hotelSlug, 'university' => $hotel->id]);
        }
        return view('Client.Hotels.hotel', ['hotel' => $hotel]);
    }

}
