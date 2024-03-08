<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StatistiquesController;

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


$idRegex = '[0-9]+';
$slugRegex = '[0-9a-z\-]+';
$mailRegex = '[^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$]';

Route::get('/parametres', function () {
    return view ('parametres');
})/* ->middleware(['auth', 'verified']) */
->name('parametres');

Route::group(['middleware' => ['auth', 'permission:Gérer les Départements|Gérer les Communes|Gérer les Arrondissements|Gérer les Quartiers|Gérer les Hôtels|Gérer les Types de Chambres|Gérer les Types de Services|Gérer les Rôles|Gestion des Utilisateurs|Gérer les Utilisateurs|Gérer les Chambres|Gérer les Réservations|Gérer les Demandes de Services']], function () {
    Route::get('statistiques', [StatistiquesController::class, 'index'])->name('statistiques');
});

Route::get('client-show-profile/{user}', [ProfileController::class, 'show'])
->name('client-profile.show')
->where(['user' => $idRegex]);

Route::get('client-update-profile/{user}', [ProfileController::class, 'edit'])
->name('client-profile.edit')
->where(['user' => $idRegex]);

Route::put('client-update-profile/{user}', [ProfileController::class, 'update'])
->name('client-profile.update')
->where(['user' => $idRegex]);

Route::get('personnal-show-profile/{user}', [ProfileController::class, 'show'])
->name('personnal-profile.show')
->where(['user' => $idRegex]);

Route::get('personnal-update-profile/{user}', [ProfileController::class, 'edit'])
->name('personnal-profile.edit')
->where(['user' => $idRegex]);

Route::put('personnal-update-profile/{user}', [ProfileController::class, 'update'])
->name('personnal-profile.update')
->where(['user' => $idRegex]);
