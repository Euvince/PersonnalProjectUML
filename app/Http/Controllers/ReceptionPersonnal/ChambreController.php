<?php

namespace App\Http\Controllers\ReceptionPersonnal;

use App\Models\Chambre;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;

class ChambreController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index () : View
    {
        return view('ReceptionPersonnal.Chambre.chambres');
    }

    /**
     * Display the specified resource.
     */
    public function show(Chambre $chambre) : View
    {
        return view('ReceptionPersonnal.Chambre.chambre', compact('chambre'));
    }

}
