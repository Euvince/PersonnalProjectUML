<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Models\Hotel;
use App\Models\Commune;
use App\Models\Quartier;
use App\Models\Departement;
use Illuminate\Http\Request;
use App\Models\Arrondissement;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\SuperAdmin\HotelFormRequest;

class HotelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() : View
    {
        return view('SuperAdmin.Hotel.hotels', [
            'hotels' => Hotel::paginate(20)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() : View
    {
        $hotel = new Hotel();

        $hotel->fill([
            'nom' => 'Hôtel La marina',
            'longitude' => '1255',
            'lattitude' => '230',
            'adresse_postale' => '127 rue de flor',
            'email' => 'la@marina.fr',
            'telephone' => '+33 45 65 15 32 4',
            'directeur' => 'Jonh Doe',
        ]);

        return view('SuperAdmin.Hotel.hotel-form', [
            'hotel' => $hotel,
            'departements' => Departement::orderBy('nom', 'ASC')->pluck('nom', 'id'),
            'communes' => Commune::orderBy('nom', 'ASC')->pluck('nom', 'id'),
            'arrondissements' => Arrondissement::orderBy('nom', 'ASC')->pluck('nom', 'id'),
            'quartiers' => Quartier::orderBy('nom', 'ASC')->pluck('nom', 'id'),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(HotelFormRequest $request) : RedirectResponse
    {
        Hotel::create($request->validated());
        return redirect()->route('super-admin.hotels.index')->with('success', 'L\'Hotel a été crée avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Hotel $Hotel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Hotel $hotel) : View
    {
        return view('SuperAdmin.Hotel.Hotel-form', [
            'hotel' => $hotel,
            'departements' => Departement::orderBy('nom', 'ASC')->pluck('nom', 'id'),
            'communes' => Commune::orderBy('nom', 'ASC')->pluck('nom', 'id'),
            'arrondissements' => Arrondissement::orderBy('nom', 'ASC')->pluck('nom', 'id'),
            'quartiers' => Quartier::orderBy('nom', 'ASC')->pluck('nom', 'id'),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(HotelFormRequest $request, Hotel $hotel) : RedirectResponse
    {
        $hotel->update($request->validated());
        return redirect()->route('super-admin.hotels.index')->with('success', 'L\'Hotel a été modifié avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Hotel $hotel)
    {
        $hotel->delete();
        return redirect()->route('super-admin.hotels.index')->with('success', 'L\'Hotel a été supprimé avec succès.');
    }
}
