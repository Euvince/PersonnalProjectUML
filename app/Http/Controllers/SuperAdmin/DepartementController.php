<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Models\Departement;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\SuperAdmin\DepartementFormRequest;

class DepartementController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(Departement::class, 'departement');
    }

    /**
     * Display a listing of the resource.
     */
    public function index() : View
    {
        return view('SuperAdmin.Departement.departements');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() : View
    {
        return view('SuperAdmin.Departement.departement-form', [
            'departement' => new Departement()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DepartementFormRequest $request) : RedirectResponse
    {
        Departement::create($request->validated());
        return
            redirect()
            ->route('super-admin.departements.index')
            ->with('success', 'Le département a été crée avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Departement $departement) : View
    {
        return view('SuperAdmin.Departement.departement', compact('departement'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Departement $departement) : View
    {
        return view('SuperAdmin.Departement.departement-form', [
            'departement' => $departement
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DepartementFormRequest $request, Departement $departement) : RedirectResponse
    {
        $departement->update($request->validated());
        return
            redirect()
            ->route('super-admin.departements.index')
            ->with('success', 'Le département a été modifié avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Departement $departement)
    {
        $departement->delete();
        return
            redirect()
            ->route('super-admin.departements.index')
            ->with('success', 'Le département a été supprimé avec succès.');
    }
}
