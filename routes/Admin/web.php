<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\ChambreController;
use App\Http\Controllers\Admin\UserController;

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

Route::group(['middleware' => ['auth', 'verified', 'permission:Gérer les Utilisateurs'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::resource('users', UserController::class)->except(['create', 'store']);
});

Route::group(['middleware' => ['auth', 'verified', 'permission:Gérer les Chambres'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::resource('chambres', ChambreController::class);
});

Route::group(['middleware' => ['auth', 'verified', 'permission:Gérer les Utilisateurs'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('clients', [ClientController::class, 'index'])->name('clients.index');
    Route::get('clients/{user}', [ClientController::class, 'show'])->name('clients.show');

    $idRegex = '[0-9]+';
    Route::patch('clients/{user}/recrutement', [ClientController::class, 'recruter'])
    ->name('clients.recrutement')
    ->where([
        'user' => $idRegex
    ]);

    Route::patch('clients/{user}/licenciement', [ClientController::class, 'licencier'])
    ->name('clients.licenciement')
    ->where([
        'user' => $idRegex
    ]);
});
