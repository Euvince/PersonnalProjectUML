<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Models\Commune;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use App\Http\Requests\SuperAdmin\CommuneFormRequest;
use App\Models\Departement;
use Illuminate\Http\RedirectResponse;

class CommuneController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() : View
    {
        return view('SuperAdmin.Commune.communes', [
            'communes' => Commune::paginate(20)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() : View
    {
        return view('SuperAdmin.Commune.commune-form', [
            'commune' => new Commune(),
            'departements' => Departement::orderBy('nom', 'ASC')->pluck('nom', 'id'),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CommuneFormRequest $request) : RedirectResponse
    {
        Commune::create($request->validated());
        return redirect()->route('super-admin.communes.index')->with('success', 'La Commune a été crée avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Commune $commune)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Commune $commune) : View
    {
        return view('SuperAdmin.Commune.commune-form', [
            'commune' => $commune,
            'departements' => Departement::orderBy('nom', 'ASC')->pluck('nom', 'id'),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CommuneFormRequest $request, Commune $commune) : RedirectResponse
    {
        $commune->update($request->validated());
        return redirect()->route('super-admin.communes.index')->with('success', 'La Commune a été modifié avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Commune $commune)
    {
        $commune->delete();
        return redirect()->route('super-admin.communes.index')->with('success', 'La Commune a été supprimé avec succès.');
    }
}
