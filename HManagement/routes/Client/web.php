<?php

use App\Http\Controllers\Client\ClientController;
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

$idRegex = '[0-9]+';
$slugRegex = '[0-9a-z\-]+';
$mailRegex = '[^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$]';

/* Route::group(['middleware' => ['auth', 'permission' => 'Consulter une Chambre|Réserver une Chambre|Demnander un Service']], function () {

}); */

Route::get('/', [ClientController::class, 'index'])->name('clients.hotels.index');
Route::get('/hotels/{slug}/{id}', [ClientController::class, 'show'])
->name('clients.hotels.show')
->where([
    'id' => $idRegex,
    'slug' => $slugRegex
]);
