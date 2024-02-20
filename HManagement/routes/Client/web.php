<?php

use App\Http\Controllers\Client\ClientController;
use App\Http\Controllers\API\HotelController;
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

Route::get('/', [ClientController::class, 'index'])->name('clients.hotels.index');

Route::get('/hotels/{slug}/{hotel}', [ClientController::class, 'show'])
->name('clients.hotels.show')
->where([
    'id' => $idRegex,
    'slug' => $slugRegex
]);

Route::get('/json-placeholder', [HotelController::class, 'index']);
