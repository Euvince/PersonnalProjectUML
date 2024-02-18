<?php

use App\Http\Controllers\Admin\ChambreController;
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

Route::group(['middleware' => [], 'permission' => [], 'prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::resource('chambres', ChambreController::class);
});
