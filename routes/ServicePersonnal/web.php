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

Route::group(['middleware' => ['auth', 'permission:Gérer les Demandes de Services'], 'prefix' => 'service-personnal', 'as' => 'service-personnal.'], function () {
    Route::resource('demande-service', DemandeServiceController::class);
});
