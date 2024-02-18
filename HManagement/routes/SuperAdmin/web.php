<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SuperAdmin\HotelController;
use App\Http\Controllers\SuperAdmin\TypeChambreController;
use App\Http\Controllers\SuperAdmin\CommuneController;
use App\Http\Controllers\SuperAdmin\QuartierController;
use App\Http\Controllers\SuperAdmin\DepartementController;
use App\Http\Controllers\SuperAdmin\ArrondissementController;
use App\Http\Controllers\SuperAdmin\MoyenPaiementController;
use App\Http\Controllers\SuperAdmin\RoleController;
use App\Http\Controllers\SuperAdmin\TypeServiceController;

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

Route::group(['middleware' => ['auth', 'permission:Gérer les Départements'], 'prefix' => 'super-admin', 'as' => 'super-admin.'], function () {
    Route::resource('departements', DepartementController::class)->except(['show']);
});

Route::group(['middleware' => ['auth', 'permission:Gérer les Communes'], 'prefix' => 'super-admin', 'as' => 'super-admin.'], function () {
    Route::resource('communes', CommuneController::class)->except(['show']);
});

Route::group(['middleware' => ['auth', 'permission:Gérer les Arrondissements'], 'prefix' => 'super-admin', 'as' => 'super-admin.'], function () {
    Route::resource('arrondissements', ArrondissementController::class)->except(['show']);
});

Route::group(['middleware' => ['auth', 'permission:Gérer les Quartiers'], 'prefix' => 'super-admin', 'as' => 'super-admin.'], function () {
    Route::resource('quartiers', QuartierController::class)->except(['show']);
});

Route::group(['middleware' => ['auth', 'permission:Gérer les Hôtels'], 'prefix' => 'super-admin', 'as' => 'super-admin.'], function () {
    Route::resource('hotels', HotelController::class);
});

Route::group(['middleware' => ['auth', 'permission:Gérer les Types de Chambres'], 'prefix' => 'super-admin', 'as' => 'super-admin.'], function () {
    Route::resource('type-chambre', TypeChambreController::class)->except(['show']);
});

Route::group(['middleware' => ['auth', 'permission:Gérer les Types de Services'], 'prefix' => 'super-admin', 'as' => 'super-admin.'], function () {
    Route::resource('type-service', TypeServiceController::class)->except(['show']);
});

Route::group(['middleware' => ['auth', 'permission:Gérer les Moyens de Paiement'], 'prefix' => 'super-admin', 'as' => 'super-admin.'], function () {
    Route::resource('moyen-paiement', MoyenPaiementController::class)->except(['show']);
});

Route::group(['middleware' => ['auth', 'permission:Gérer les Rôles'], 'prefix' => 'super-admin', 'as' => 'super-admin.'], function () {
    Route::resource('roles', RoleController::class)->except(['show']);
});
