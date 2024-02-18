<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SuperAdmin\HotelController;
use App\Http\Controllers\SuperAdmin\TypeChambreController;
use App\Http\Controllers\SuperAdmin\CommuneController;
use App\Http\Controllers\SuperAdmin\QuartierController;
use App\Http\Controllers\SuperAdmin\DepartementController;
use App\Http\Controllers\SuperAdmin\ArrondissementController;

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

Route::group(['middleware' => ['auth', 'permission:Gérer les Types de chambres'], 'prefix' => 'super-admin', 'as' => 'super-admin.'], function () {
    Route::resource('type-chambre', TypeChambreController::class)->except(['show']);
});
