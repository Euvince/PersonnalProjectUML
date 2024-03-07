<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ChambreFormRequest;
use App\Models\Chambre;
use App\Models\TypeChambre;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class ChambreController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(Chambre::class, 'chambre');
    }

    /**
     * Display a listing of the resource.
     */
    public function index() : View
    {
        return view('Admin.Chambre.chambres');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() : View
    {
        return view('Admin.Chambre.chambre-form', [
            'chambre' => new Chambre(),
            'typesChambres' => TypeChambre::orderBy('type', 'ASC')->pluck('type', 'id'),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ChambreFormRequest $request) : RedirectResponse
    {
        Chambre::create(array_merge(
            $request->validated(), [
                'hotel_id' => Auth::user()->hotel->id
            ]
        ));
        return
            redirect()
            ->route('admin.chambres.index')
            ->with('success', 'La Chambre a été crée avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Chambre $chambre) : View
    {
        return view('Admin.Chambre.chambre', compact('chambre'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Chambre $chambre) : View
    {
        return view('Admin.Chambre.chambre-form', [
            'chambre' => $chambre,
            'typesChambres' => TypeChambre::orderBy('type', 'ASC')->pluck('type', 'id'),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ChambreFormRequest $request, Chambre $chambre) : RedirectResponse
    {
        $chambre->update($request->validated());
        return
            redirect()
            ->route('admin.chambres.index')
            ->with('success', 'La Chambre a été modifié avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Chambre $chambre)
    {
        $chambre->delete();
        return
            redirect()
            ->route('admin.chambres.index')
            ->with('success', 'La Chambre a été supprimé avec succès.');
    }
}
