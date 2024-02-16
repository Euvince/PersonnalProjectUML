<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Models\Departement;
use Illuminate\Http\Request;
use App\Models\Arrondissement;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\SuperAdmin\ArrondissementFormRequest;
use App\Models\Commune;

class ArrondissementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() : View
    {
        return view('SuperAdmin.Arrondissement.arrondissements', [
            'arrondissements' => Arrondissement::paginate(20)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() : View
    {
        return view('SuperAdmin.Arrondissement.arrondissement-form', [
            'arrondissement' => new Arrondissement(),
            'departements' => Departement::orderBy('nom', 'ASC')->pluck('nom', 'id'),
            'communes' => Commune::orderBy('nom', 'ASC')->pluck('nom', 'id'),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ArrondissementFormRequest $request) : RedirectResponse
    {
        Arrondissement::create($request->validated());
        return redirect()->route('super-admin.arrondissements.index')->with('success', 'L\'Arrondissement a été crée avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Arrondissement $arrondissement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Arrondissement $arrondissement) : View
    {
        return view('SuperAdmin.Arrondissement.arrondissement-form', [
            'arrondissement' => $arrondissement,
            'departements' => Departement::orderBy('nom', 'ASC')->pluck('nom', 'id'),
            'communes' => Commune::orderBy('nom', 'ASC')->pluck('nom', 'id'),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ArrondissementFormRequest $request, Arrondissement $arrondissement) : RedirectResponse
    {
        $arrondissement->update($request->validated());
        return redirect()->route('super-admin.arrondissements.index')->with('success', 'L\'Arrondissement a été modifié avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Arrondissement $arrondissement)
    {
        $arrondissement->delete();
        return redirect()->route('super-admin.arrondissements.index')->with('success', 'L\'Arrondissement a été supprimé avec succès.');
    }
}
