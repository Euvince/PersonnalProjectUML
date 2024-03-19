<?php

use App\Http\Controllers\ServicePersonnal\DemandeServiceController;
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

Route::group(['middleware' => ['auth', 'verified', 'permission:Gérer les Demandes de Services'], 'prefix' => 'service-personnal', 'as' => 'service-personnal.'], function () {
    Route::resource('demande-service', DemandeServiceController::class);

    $idRegex = '[0-9]+';
    Route::patch('confirm-demande-service/{demande_service}', [DemandeServiceController::class, 'confirmDemandeService'])
    ->where(['demande_service' => $idRegex])
    ->name('demande.confirm');

    Route::patch('cannot-rendered-demande-service/{demande_service}', [DemandeServiceController::class, 'cannotRenderedService'])
    ->where(['demande_service' => $idRegex])
    ->name('demande.cannotrendered');
});
