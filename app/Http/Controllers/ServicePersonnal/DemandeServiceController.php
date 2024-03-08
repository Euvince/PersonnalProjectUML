<?php

namespace App\Http\Controllers\ServicePersonnal;

use App\Http\Controllers\Controller;
use App\Http\Requests\ServicePersonnal\DemandeServiceFormRequest;
use App\Models\Service;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class DemandeServiceController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(Service::class, 'demande_service');
    }

    /**
     * Display a listing of the resource.
     */
    public function index() : View
    {
        return view();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() : View
    {
        return view();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DemandeServiceFormRequest $request) : RedirectResponse
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Service $demandeService) : View
    {
        return view();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DemandeServiceFormRequest $request, Service $demandeService) : RedirectResponse
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Service $demandeService) : RedirectResponse
    {
        //
    }
}
