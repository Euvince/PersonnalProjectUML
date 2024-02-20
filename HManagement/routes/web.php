<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;

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

Route::get('/home', function () {
    return view ('home');
})/* ->middleware(['auth', 'verified']) */;

Route::group(['middleware' => ['auth'], 'as' => 'statistiques'], function (){
    Route::get('/statistiques', function () {return view('Statistiques'); });
});

/* Route::group(['middleware' => ['auth', 'permission:Gestion des Rôles|Gestion des Services|Gestion des Fonctions|Gestion des Divisions|Gestion des Documents|Gestion des Directions|Gestion des Catégories|Gestion des Classements|Gestion des Utilisateurs|Gestion des Boîtes Archives|Gestion des Rayons Rangements|Gestion des Chemises Dossiers|Gestion des Demandes de Prêts|Gestion des Natures de Documents|Gestion des Demandes de Transferts|Gestion des Demandes de Transferts du MISP'], 'as' => 'admin.statistique'], function () {
    Route::get('admin/statistiques', [StatistiquesController::class, 'stat']);
}); */



Route::get('client-update-profile/{user}', [ProfileController::class, 'edit'])
->name('client-profile.edit')
->where(['user' => $idRegex]);

Route::put('client-update-profile/{user}', [ProfileController::class, 'update'])
->name('client-profile.update')
->where(['user' => $idRegex]);

Route::get('personnal-update-profile/{user}', [ProfileController::class, 'edit'])
->name('personnal-profile.edit')
->where(['user' => $idRegex]);

Route::put('personnal-update-profile/{user}', [ProfileController::class, 'update'])
->name('personnal-profile.update')
->where(['user' => $idRegex]);
