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
use App\Http\Controllers\SuperAdmin\UserController;

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

Route::group(['middleware' => ['auth', 'verified', 'permission:Gérer les Départements'], 'prefix' => 'super-admin', 'as' => 'super-admin.'], function () {
    Route::resource('departements', DepartementController::class);
});

Route::group(['middleware' => ['auth', 'verified', 'permission:Gérer les Communes'], 'prefix' => 'super-admin', 'as' => 'super-admin.'], function () {
    Route::resource('communes', CommuneController::class);
});

Route::group(['middleware' => ['auth', 'verified', 'permission:Gérer les Arrondissements'], 'prefix' => 'super-admin', 'as' => 'super-admin.'], function () {
    Route::resource('arrondissements', ArrondissementController::class);
});

Route::group(['middleware' => ['auth', 'verified', 'permission:Gérer les Quartiers'], 'prefix' => 'super-admin', 'as' => 'super-admin.'], function () {
    Route::resource('quartiers', QuartierController::class);
});

Route::group(['middleware' => ['auth', 'verified', 'permission:Gérer les Hôtels'], 'prefix' => 'super-admin', 'as' => 'super-admin.'], function () {
    Route::resource('hotels', HotelController::class);
});

Route::group(['middleware' => ['auth', 'permission:Gérer les Types de Chambres'], 'prefix' => 'super-admin', 'as' => 'super-admin.'], function () {
    Route::resource('type-chambre', TypeChambreController::class);
});

Route::group(['middleware' => ['auth', 'verified', 'permission:Gérer les Types de Services'], 'prefix' => 'super-admin', 'as' => 'super-admin.'], function () {
    Route::resource('type-service', TypeServiceController::class);
});

Route::group(['middleware' => ['auth', 'verified', 'permission:Gérer les Moyens de Paiement'], 'prefix' => 'super-admin', 'as' => 'super-admin.'], function () {
    Route::resource('moyen-paiement', MoyenPaiementController::class);
});

Route::group(['middleware' => ['auth', 'verified', 'permission:Gérer les Rôles'], 'prefix' => 'super-admin', 'as' => 'super-admin.'], function () {
    Route::resource('roles', RoleController::class);
});

Route::group(['middleware' => ['auth', 'verified', 'permission:Gérer les Rôles'], 'prefix' => 'super-admin', 'as' => 'super-admin.'], function () {
    Route::get('users', [UserController::class, 'index'])->name('users.index');
    Route::get('users/{user}', [UserController::class, 'show'])->name('users.show');

    $idRegex = '[0-9]+';
    Route::get('users/{user}/edit', [UserController::class, 'edit'])
    ->where(['user' => $idRegex])
    ->name('users.edit');

    Route::put('users/{user}', [UserController::class, 'update'])
    ->where(['user' => $idRegex])
    ->name('users.update');

    Route::delete('users/{user}', [UserController::class, 'destroy'])
    ->where(['user' => $idRegex])
    ->name('users.destroy');

    Route::patch('users/{user}/licenciement', [UserController::class, 'licencier'])
    ->name('users.licenciement')
    ->where([
        'user' => $idRegex
    ]);
});
