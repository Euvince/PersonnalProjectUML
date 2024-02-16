<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Models\Departement;
use Illuminate\Http\Request;
use App\Models\Quartier;
use App\Models\Commune;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\SuperAdmin\QuartierFormRequest;
use App\Models\Arrondissement;

class QuartierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() : View
    {
        return view('SuperAdmin.Quartier.quartiers', [
            'quartiers' => Quartier::paginate(20)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() : View
    {
        return view('SuperAdmin.Quartier.quartier-form', [
            'quartier' => new Quartier(),
            'departements' => Departement::orderBy('nom', 'ASC')->pluck('nom', 'id'),
            'communes' => Commune::orderBy('nom', 'ASC')->pluck('nom', 'id'),
            'arrondissements' => Arrondissement::orderBy('nom', 'ASC')->pluck('nom', 'id'),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(QuartierFormRequest $request) : RedirectResponse
    {
        Quartier::create($request->validated());
        return redirect()->route('super-admin.quartiers.index')->with('success', 'Le Quartier a été crée avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Quartier $Quartier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Quartier $quartier) : View
    {
        return view('SuperAdmin.Quartier.quartier-form', [
            'quartier' => $quartier,
            'departements' => Departement::orderBy('nom', 'ASC')->pluck('nom', 'id'),
            'communes' => Commune::orderBy('nom', 'ASC')->pluck('nom', 'id'),
            'arrondissements' => Arrondissement::orderBy('nom', 'ASC')->pluck('nom', 'id'),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(QuartierFormRequest $request, Quartier $quartier) : RedirectResponse
    {
        $quartier->update($request->validated());
        return redirect()->route('super-admin.quartiers.index')->with('success', 'Le Quartier a été modifié avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Quartier $quartier)
    {
        $quartier->delete();
        return redirect()->route('super-admin.quartiers.index')->with('success', 'Le Quartier a été supprimé avec succès.');
    }
}
