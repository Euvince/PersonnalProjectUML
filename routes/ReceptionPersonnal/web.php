<?php

use App\Http\Controllers\ReceptionPersonnal\ChambreController;
use App\Http\Controllers\ReceptionPersonnal\FactureController;
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
    Route::get('chambres', [ChambreController::class, 'index'])->name('chambres.index');
    Route::get('chambres/{chambre}', [ChambreController::class, 'show'])->name('chambres.show');

    Route::resource('reservations', ReservationController::class);

    $idRegex = '[0-9]+';
    Route::patch('confirm-reservation/{reservation}', [ReservationController::class, 'confirmReservation'])
    ->where(['id' => $idRegex])
    ->name('reservation.confirm');

    Route::get('factures', [FactureController::class, 'index'])->name('factures.index');
    Route::get('factures/{facture}', [FactureController::class, 'show'])->name('factures.show');
});

Route::group(['middleware' => ['auth', 'permission:Gérer les Réservations|Gérer les Demandes de Services'], 'prefix' => 'personnal', 'as' => 'personnal.'], function () {
    Route::get('chambres', [ChambreController::class, 'index'])->name('chambres.index');
    Route::get('chambres/{chambre}', [ChambreController::class, 'show'])->name('chambres.show');
});
