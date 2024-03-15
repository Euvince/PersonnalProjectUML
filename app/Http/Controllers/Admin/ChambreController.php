<?php

namespace App\Http\Controllers\Admin;

use App\Models\Chambre;
use App\Models\TypeChambre;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Admin\ChambreFormRequest;

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

    private function withPicture(ChambreFormRequest $request, Chambre $chambre): array
    {
        $data = $request->validated();
        if(array_key_exists('photo', $data))
        {
            $pictureCollection = $data['photo'];
            $data['photo'] = $pictureCollection->storeAs('Chambres', $request->file('photo')->getClientOriginalName(), 'public');
            $picturepath = 'public/' . $chambre->photo;
            if(Storage::exists($picturepath)) Storage::delete('public/' . $chambre->photo);
        }
        return $data;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ChambreFormRequest $request) : RedirectResponse
    {
        Chambre::create(array_merge(
            $this->withPicture($request, new Chambre()), [
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
        $chambre->update($this->withPicture($request, $chambre));
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
