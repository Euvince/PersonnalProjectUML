<?php

namespace App\Http\Controllers\SuperAdmin;

use Illuminate\Http\Request;
use App\Models\MoyenPaiement;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\SuperAdmin\MoyenPaiementFormRequest;

class MoyenPaiementController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(MoyenPaiement::class, 'moyen_paiement');
    }

    /**
     * Display a listing of the resource.
     */
    public function index() : View
    {
        return view('SuperAdmin.MoyenPaiement.moyens-paiments');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() : View
    {
        return view('SuperAdmin.MoyenPaiement.moyen-paiment-form', [
            'moyenPaiement' => new MoyenPaiement(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MoyenPaiementFormRequest $request) : RedirectResponse
    {
        MoyenPaiement::create($request->validated());
        return
            redirect()
            ->route('super-admin.moyen-paiement.index')
            ->with('success', 'Le Moyen de Paiement a été crée avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(MoyenPaiement $moyenPaiement) : View
    {
        return view('SuperAdmin.MoyenPaiement.moyen', compact('moyenPaiement'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MoyenPaiement $moyenPaiement) : View
    {
        return view('SuperAdmin.MoyenPaiement.moyen-paiment-form', [
            'moyenPaiement' => $moyenPaiement,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MoyenPaiementFormRequest $request, MoyenPaiement $moyenPaiement) : RedirectResponse
    {
        $moyenPaiement->update($request->validated());
        return
            redirect()
            ->route('super-admin.moyen-paiement.index')
            ->with('success', 'Le Moyen de Paiement a été modifié avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MoyenPaiement $moyenPaiement)
    {
        $moyenPaiement->delete();
        return
            redirect()
            ->route('super-admin.moyen-paiement.index')
            ->with('success', 'Le Moyen de Paiement a été modifié avec succès.');
    }
}
