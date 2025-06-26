<?php

use App\Http\Controllers\Auth\GoogleAuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ChambreController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InterventionController;
use App\Http\Controllers\LouerchambreController;
use App\Http\Controllers\MaisonController;
use App\Http\Controllers\OccupantchambreController;
use App\Http\Controllers\PaiementenattenteController;
use App\Http\Controllers\PaiementespeceController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;


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
        Route::get('/maison', [MaisonController::class, 'index'])->name('maison.index');
        Route::resource('paiementenattentes', PaiementenattenteController::class);
        Route::resource('interventions', InterventionController::class);

        Route::patch('/interventions/{id}/confirmer', [InterventionController::class, 'confirmer'])->name('interventions.confirmer');
        Route::patch('/interventions/{id}/rejeter', [InterventionController::class, 'rejeter'])->name('interventions.rejeter');
        Route::post('/paiement/initialiser', [LouerchambreController::class, 'initialiserPaiement'])->name('paiement.initialiser');
        Route::get('/paiements/nettoyage', [LouerchambreController::class, 'apresPaiement'])->name('paiements.nettoyage');
        Route::delete('/paiement/annuler/{id}', [LouerchambreController::class, 'annulerPaiement'])->name('paiement.annuler');
        Route::get('/paiementespeces/{id}/facture', [PaiementespeceController::class, 'telechargerFacture'])->name('paiementespeces.facture');
        Route::post('/louer_chambre/valider', [LouerChambreController::class, 'valider'])->name('louer_chambre.valider');
        Route::get('/louer_chambre', function () {
            return view('louerchambre.forch');
        })->name('louerchambre.forch');
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::get('/paiementa/{transaction_id}', [DashboardController::class, 'enregistrerPaiement'])->name('paiementa');

        Route::get('/contrat/{location}', [LouerchambreController::class, 'showContrat'])->name('contrat.show');

        Route::put('/louerchambres/{id}/statut', [App\Http\Controllers\LouerChambreController::class, 'updateStatut'])->name('louerchambres.updateStatut');

        Route::patch('/users/{id}/toggle-activation', [UserController::class, 'toggleActivation'])->name('users.toggleActivation');

        Route::put('/maisons/{id}', [MaisonController::class, 'updatee'])->name('maisons.updatee');


    });
});


// Route::get('/contrat', function () {
//     return view('landing.partials.contrat');
// })->name('contrat');
