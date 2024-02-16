<?php

use App\Http\Controllers\ServicePersonnal\ServiceController;
use App\Http\Controllers\ServicePersonnal\TypeServiceController;
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

Route::group(['middleware' => [], 'permission' => [], 'prefix' => 'service-personnal', 'as' => 'service-personnal.'], function () {
    Route::resource('type-service', TypeServiceController::class);
    Route::resource('services', ServiceController::class);
});
