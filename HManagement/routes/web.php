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

Route::get('/statistiques', function () {
    return view('Statistiques');
})->name('statistiques');


Route::get('update-profile/{user}', [ProfileController::class, 'edit'])
->name('profile.edit')
->where(['user' => $idRegex]);

Route::put('update-profile/{user}', [ProfileController::class, 'update'])
->name('profile.update')
->where(['user' => $idRegex]);
