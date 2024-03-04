<?php

use App\Http\Controllers\ReceptionPersonnal\ReservationController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::group(['middleware' => ['auth', 'permission:Gérer les Réservations'], 'prefix' => 'reception-personnal', 'as' => 'reception-personnal.'], function () {
    Route::resource('reservations', ReservationController::class)->except(['show']);

    $idRegex = '[0-9]+';
    Route::patch('confirm-reservation/{reservation}', [ReservationController::class, 'confirmReservation'])
    ->where(['id' => $idRegex])
    ->name('reservation.confirm');
});
