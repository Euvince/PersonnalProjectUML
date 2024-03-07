<?php

namespace App\Http\Controllers\ReceptionPersonnal;

use App\Http\Controllers\Controller;
use App\Models\Facture;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class FactureController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Facture::class, 'facture');
    }

    public function index() : View
    {
        return view('ReceptionPersonnal.Facture.factures');
    }

    public function show (Facture $facture) : View
    {
        return view('ReceptionPersonnal.Facture.facture', compact('facture'));
    }

}
