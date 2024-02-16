<?php

use App\Http\Controllers\ReceptionPersonnal\ClientController;
use App\Http\Controllers\ReceptionPersonnal\MoyenPaiementController;
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

Route::group(['middleware' => [], 'permission' => [], 'prefix' => 'service-reception', 'as' => 'service-reception.'], function () {
    Route::resource('clients', ClientController::class);
    Route::resource('moyen-paiement', MoyenPaiementController::class);
});
