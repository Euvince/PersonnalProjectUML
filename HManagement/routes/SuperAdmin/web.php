<?php

use App\Http\Controllers\SuperAdmin\ArrondissementController;
use App\Http\Controllers\SuperAdmin\CommuneController;
use App\Http\Controllers\SuperAdmin\DepartementController;
use App\Http\Controllers\SuperAdmin\HotelController;
use App\Http\Controllers\SuperAdmin\QuartierController;
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

Route::group(['middleware' => [], 'permission' => [], 'prefix' => 'super-admin', 'as' => 'super-admin.'], function () {
    Route::resource('departements', DepartementController::class);
    Route::resource('communes', CommuneController::class);
    Route::resource('arrondissements', ArrondissementController::class);
    Route::resource('quartiers', QuartierController::class);
    Route::resource('hotels', HotelController::class);
});
