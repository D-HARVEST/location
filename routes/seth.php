<?php

use App\Http\Controllers\Auth\GoogleAuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ChambreController;
use App\Http\Controllers\InterventionController;
use App\Http\Controllers\LouerchambreController;
use App\Http\Controllers\MaisonController;
use App\Http\Controllers\OccupantchambreController;
use App\Http\Controllers\PaiementenattenteController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\TypeController;
use Illuminate\Support\Facades\Route;






Route::get('/login/google', [GoogleAuthController::class, 'redirectToGoogle'])->name('login.google');
Route::get('/login/google/callback', [GoogleAuthController::class, 'handleGoogleCallback'])->name('login.google.callback');


Route::middleware(['auth'])->group(function () {

    Route::middleware(['auth'])->group(function () {
        Route::resource('types', TypeController::class);
        Route::resource('categories', CategoryController::class);
        Route::resource('maisons', MaisonController::class);
        Route::resource('chambres', ChambreController::class);
        Route::resource('photos', PhotoController::class);
        Route::resource('louerchambres', LouerchambreController::class);


        // Route GET pour afficher le formulaire
        Route::get('louerchambre/{louerchambre}/editee', [LouerchambreController::class, 'editee'])->name('louerchambre.editee');

        // Route POST pour mettre à jour (comme tu as déjà)
        Route::post('updatee/{louerchambre}', [LouerchambreController::class, 'updatee'])->name('louerchambre.modiflocation');
        Route::get('/maison/{id}', [MaisonController::class, 'show'])->name('maison.show');
        Route::resource('paiementenattentes', PaiementenattenteController::class);
        Route::resource('interventions', InterventionController::class);

        Route::patch('/interventions/{id}/confirmer', [InterventionController::class, 'confirmer'])->name('interventions.confirmer');
        Route::patch('/interventions/{id}/rejeter', [InterventionController::class, 'rejeter'])->name('interventions.rejeter');
        Route::post('/paiement/initialiser', [LouerchambreController::class, 'initialiserPaiement'])->name('paiement.initialiser');

    });
});
