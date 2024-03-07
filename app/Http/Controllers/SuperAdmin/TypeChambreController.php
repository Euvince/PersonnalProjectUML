<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Models\TypeChambre;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\SuperAdmin\TypeChambreFormRequest;

class TypeChambreController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(TypeChambre::class, 'type_chambre');
    }

    /**
     * Display a listing of the resource.
     */
    public function index() : View
    {
        return view('SuperAdmin.TypeChambre.types-chambres');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() : View
    {
        return view('SuperAdmin.TypeChambre.type-chambre-form', [
            'typeChambre' => new TypeChambre(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TypeChambreFormRequest $request) : RedirectResponse
    {
        TypeChambre::create($request->validated());
        return
            redirect()
            ->route('super-admin.type-chambre.index')
            ->with('success', 'Le Type de Chambre a été crée avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(TypeChambre $typeChambre) : View
    {
        return view('SuperAdmin.TypeChambre.type-chambre', compact('typeChambre'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TypeChambre $typeChambre) : View
    {
        return view('SuperAdmin.TypeChambre.type-chambre-form', [
            'typeChambre' => $typeChambre,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TypeChambreFormRequest $request, TypeChambre $typeChambre) : RedirectResponse
    {
        $typeChambre->update($request->validated());
        return
            redirect()
            ->route('super-admin.type-chambre.index')
            ->with('success', 'Le Type de Chambre a été modifié avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TypeChambre $typeChambre)
    {
        $typeChambre->delete();
        return
            redirect()
            ->route('super-admin.type-chambre.index')
            ->with('success', 'Le Type de Chambre a été supprimé avec succès.');
    }
}
