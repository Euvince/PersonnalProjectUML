<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Models\Departement;
use Illuminate\Http\Request;
use App\Models\Quartier;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\SuperAdmin\QuartierFormRequest;
use App\Models\Arrondissement;

class QuartierController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(Quartier::class, 'quartier');
    }

    /**
     * Display a listing of the resource.
     */
    public function index() : View
    {
        return view('SuperAdmin.Quartier.quartiers');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() : View | RedirectResponse
    {
        $departements = Departement::has('communes', '>=', 1)->orderBy('nom', 'ASC')->get();
        if ($departements->isEmpty()) {
            return redirect()
            ->route('super-admin.quartiers.index')
            ->with('error', 'Veuillez disposer d\'un Département contenant au moins une commune d\'abord.');
        }

        $communes = $departements->first()->communes->sortBy('nom');
        if ($communes->isEmpty()) {
            return redirect()
            ->route('super-admin.quartiers.index')
            ->with('error', 'Veuillez disposer d\'une Commune contenant au moins un arrondissement d\'abord.');
        }

        if (Arrondissement::all()->count() == 0) {
            return redirect()
            ->route('super-admin.quartiers.index')
            ->with('error', 'Veuillez disposer d\'un Arrondissement au moins d\'abord.');
        }

        return view('SuperAdmin.Quartier.quartier-form', [
            'quartier' => new Quartier(),
            'departements' => $departements,
            'communes' => $communes,
            'arrondissements' => $communes->first()->arrondissements->sortBy('nom'),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(QuartierFormRequest $request) : RedirectResponse
    {
        Quartier::create($request->validated());
        return
            redirect()
            ->route('super-admin.quartiers.index')
            ->with('success', 'Le Quartier a été crée avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Quartier $quartier) : View
    {
        return view('SuperAdmin.Quartier.quartier', compact('quartier'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Quartier $quartier) : View
    {
        $departements = Departement::has('communes', '>=', 1)->orderBy('nom', 'ASC')->get();

        return view('SuperAdmin.Quartier.quartier-form', [
            'quartier' => $quartier,
            'departements' => $departements,
            'communes' => $quartier->arrondissement->commune->departement->communes->sortBy('nom'),
            'arrondissements' => $quartier->arrondissement->commune->arrondissements->sortBy('nom'),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(QuartierFormRequest $request, Quartier $quartier) : RedirectResponse
    {
        $quartier->update($request->validated());
        return
            redirect()
            ->route('super-admin.quartiers.index')
            ->with('success', 'Le Quartier a été modifié avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Quartier $quartier)
    {
        $quartier->delete();
        return
            redirect()
            ->route('super-admin.quartiers.index')
            ->with('success', 'Le Quartier a été supprimé avec succès.');
    }
}
