<?php

namespace App\Http\Controllers\ReceptionPersonnal;

use App\Http\Controllers\Controller;
use App\Http\Requests\ReceptionPersonnal\ReservationFormRequest;
use App\Models\Reservation;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() : View
    {
        return view('ReceptionPersonnal.Reservation.reservations');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() : View
    {
        return view('ReceptionPersonnal.Reservation.reservation-form', [
            'reservation' => new Reservation(),
            'chambres' => Auth::user()->hotel->chambres,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ReservationFormRequest $request) : RedirectResponse
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reservation $reservation) : View
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ReservationFormRequest $request, Reservation $reservation) : RedirectResponse
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reservation $reservation) : RedirectResponse
    {
        //
    }
}
