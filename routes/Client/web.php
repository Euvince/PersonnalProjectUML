<?php

use App\Http\Controllers\Client\ClientController;
use App\Http\Controllers\API\HotelController;
use App\Http\Controllers\ContactUsController;
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

/* LES HÔTELS******************************************************************************* */

Route::get('/', [ClientController::class, 'index'])->name('clients.hotels.index');

Route::get('hotels/{slug}/{hotel}/chambres', [ClientController::class, 'showHotel'])
->name('clients.hotels.show')
->where([
    'hotel' => $idRegex,
    'slug' => $slugRegex
]);

Route::get('hotels/{slug}/{hotel}/infos', [ClientController::class, 'infosHotel'])
->name('clients.hotels.infos')
->where([
    'hotel' => $idRegex,
    'slug' => $slugRegex
]);

Route::get('hotels-infos-download/{hotel}', [ClientController::class, 'downloadInfosHotel'])
->name('clients.hotels-infos-download')
->where([
    'hotel' => $idRegex
]);


/* LES CHAMBRES******************************************************************************* */

Route::get('chambres/{slug}/{chambre}', [ClientController::class, 'showChambre'])
->name('clients.chambres.show')
->where([
    'chambre' => $idRegex,
    'slug' => $slugRegex
]);

Route::get('chambres/{slug}/{chambre}/infos', [ClientController::class, 'infosChambre'])
->name('clients.chambres.infos')
->where([
    'chambre' => $idRegex,
    'slug' => $slugRegex
]);

Route::get('chambres-infos-download/{chambre}', [ClientController::class, 'downloadInfosChambre'])
->name('clients.chambres-infos-download')
->where([
    'chambre' => $idRegex
]);


/* LES RÉSERVATIONS******************************************************************************* */

Route::get('reservations', [ClientController::class, 'reservations'])
->name('clients.reservations')
->middleware(['auth', 'verified', 'permission:Réserver une Chambre']);

Route::post('chambres/{chambre}/reservation', [ClientController::class, 'sendReservation'])
->name('clients.chambres.reservation-send')
->where(['chambre' => $idRegex])
->middleware(['auth', 'verified', 'permission:Réserver une Chambre']);

/* Route::get('facture-show/{facture}/{chambre}', [ClientController::class, 'showFacture'])
->name('clients.facture-show')
->where([
    'facture' => $idRegex,
    'chambre' => $idRegex
])
->middleware(['auth', 'verified', 'permission:Réserver une Chambre']); */

Route::get('facture-download/{facture}/{chambre}', [ClientController::class, 'downloadFacture'])
->name('clients.facture-download')
->where([
    'facture' => $idRegex,
    'chambre' => $idRegex
]);


/* LES SERVIVES******************************************************************************* */

Route::get('services/{reservation}', [ClientController::class, 'services'])
->name('clients.services')
->where([
    'reservation' => $idRegex,
])
->middleware(['auth', 'verified', 'permission:Demander un Service']);

Route::get('chambres/{chambre}/demander-service', [ClientController::class, 'showFormToAskService'])
->name('clients.chambres.ask-service')
->where(['chambre' => $idRegex])
->middleware(['auth', 'verified', 'permission:Demander un Service']);

Route::post('chambres/{chambre}/demander-service', [ClientController::class, 'sendDemandeService'])
->name('clients.chambres.service-send')
->where(['chambre' => $idRegex])
->middleware(['auth', 'verified', 'permission:Demander un Service']);

Route::get('chambres/{demande_service}/edit', [ClientController::class, 'showFormToEditService'])
->name('clients.chambres.edit-service')
->where(['chambre' => $idRegex])
->middleware(['auth', 'verified', 'permission:Demander un Service']);

Route::put('chambres/{demande_service}', [ClientController::class, 'updateDemandeService'])
->name('clients.chambres.service-update')
->where(['chambre' => $idRegex])
->middleware(['auth', 'verified', 'permission:Demander un Service']);

Route::delete('chambres/{demande_service}', [ClientController::class, 'cancelDdemandeService'])
->name('clients.chambres.service-cancel')
->where(['chambre' => $idRegex])
->middleware(['auth', 'verified', 'permission:Demander un Service']);


/* LE CHECK-OUT********************************************************************************* */

Route::get('check-out/{reservation}', [ClientController::class, 'checkOut'])
->name('clients.check-out')
->middleware(['auth', 'verified', 'permission:Demander un Service']);

Route::patch('check-out{reservation}', [ClientController::class, 'checkOutSubmitted'])
->name('clients.check-out-submitted')
->middleware(['auth', 'verified', 'permission:Demander un Service']);


/* NOUS-CONTACTER******************************************************************************* */

Route::get('nous-contacter-form', [ContactUsController::class, 'showContactForm'])->name('contact.us.form');
Route::post('nous-contacter', [ContactUsController::class, 'contactUs'])->name('contact.us');

/* LES APIs******************************************************************************* */

Route::get('api', [HotelController::class, 'index']);
