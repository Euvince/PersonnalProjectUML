<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Models\Hotel;
use App\Models\Departement;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\SuperAdmin\HotelFormRequest;
use App\Models\Quartier;

class HotelController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(Hotel::class, 'hotel');
    }

    /**
     * Display a listing of the resource.
     */
    public function index() : View
    {
        /* $departements = Departement::has('communes', '>=', 1)->orderBy('nom', 'ASC')->get();
        dd($departements);
        $communes = $departements->first()->communes->sortBy('nom');
        dd($communes); */
        return view('SuperAdmin.Hotel.hotels');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() : View | RedirectResponse
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

        $departements = Departement::has('communes', '>=', 1)->orderBy('nom', 'ASC')->get();
        if ($departements->isEmpty()) {
            return redirect()
            ->route('super-admin.hotels.index')
            ->with('error', 'Veuillez disposer d\'un Département contenant au moins une commune d\'abord.');
        }

        $communes = $departements->first()->communes->sortBy('nom');
        if ($communes->isEmpty()) {
            return redirect()
            ->route('super-admin.hotels.index')
            ->with('error', 'Veuillez disposer d\'une Commune contenant au moins un arrondissement d\'abord.');
        }

        $arrondissements = $communes->first()->arrondissements->sortBy('nom');
        if ($communes->isEmpty()) {
            return redirect()
            ->route('super-admin.hotels.index')
            ->with('error', 'Veuillez disposer d\'une Commune contenant au moins un arrondissement d\'abord.');
        }

        if ($arrondissements->isEmpty()) {
            return redirect()
            ->route('super-admin.hotels.index')
            ->with('error', 'Vos communes doivent disposer d\'arrondissements et ceux-ci de quartier(s).');
        }

        if (Quartier::all()->count() == 0) {
            return redirect()
            ->route('super-admin.hotels.index')
            ->with('error', 'Veuillez disposer d\'un Quartier au moins d\'abord.');
        }

        return view('SuperAdmin.Hotel.hotel-form', [
            'hotel' => $hotel,
            'departements' => $departements,
            'communes' => $communes,
            'arrondissements' => $arrondissements,
            'quartiers' => $arrondissements->first()->quartiers->sortBy('nom')
        ]);
    }


    private function withPicture(HotelFormRequest $request, Hotel $hotel): array
    {
        $data = $request->validated();
        if(array_key_exists('photo', $data))
        {
            $pictureCollection = $data['photo'];
            $data['photo'] = $pictureCollection->storeAs('Hotels', $request->file('photo')->getClientOriginalName(), 'public');
            $picturepath = 'public/' . $hotel->photo;
            if(Storage::exists($picturepath)) Storage::delete('public/' . $hotel->photo);
        }
        return $data;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(HotelFormRequest $request) : RedirectResponse
    {
        $quartier = Quartier::find($request->quartier_id);
        Hotel::create(array_merge(
            $this->withPicture($request, new Hotel()), [
                /* 'arrondissement_id' => $quartier->arrondissement->id,
                'commune_id' => $quartier->arrondissement->commune->id,
                'departement_id' => $quartier->arrondissement->commune->departement->id, */
            ]));
        return
            redirect()
            ->route('super-admin.hotels.index')
            ->with('success', 'L\'Hotel a été crée avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Hotel $hotel) : View
    {
        return view('SuperAdmin.Hotel.hotel', compact('hotel'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Hotel $hotel) : View
    {
        $departements = Departement::has('communes', '>=', 1)->orderBy('nom', 'ASC')->get();

        return view('SuperAdmin.Hotel.Hotel-form', [
            'hotel' => $hotel,
            'departements' => $departements,
            'communes' => $hotel->quartier->arrondissement->commune->departement->communes->sortBy('nom'),
            'arrondissements' => $hotel->quartier->arrondissement->commune->arrondissements->sortBy('nom'),
            'quartiers' => $hotel->quartier->arrondissement->quartiers->sortBy('nom')
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(HotelFormRequest $request, Hotel $hotel) : RedirectResponse
    {
        $quartier = Quartier::find($request->quartier_id);
        $hotel->update(array_merge(
            $this->withPicture($request, $hotel), [
                /* 'arrondissement_id' => $quartier->arrondissement->id,
                'commune_id' => $quartier->arrondissement->commune->id,
                'departement_id' => $quartier->arrondissement->commune->departement->id, */
            ]
        ));
        return
            redirect()
            ->route('super-admin.hotels.index')
            ->with('success', 'L\'Hotel a été modifié avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Hotel $hotel)
    {
        $hotel->delete();
        return
            redirect()
            ->route('super-admin.hotels.index')
            ->with('success', 'L\'Hotel a été supprimé avec succès.');
    }
}
