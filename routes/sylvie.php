<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SuiviController;
use App\Http\Controllers\ChambreController;
use App\Http\Controllers\MoyenPaiementController;
use App\Http\Controllers\PaiementespeceController;

Route::post('/louerchambres/validate', [ChambreController::class, 'validateStatut'])->name('louerchambres.validate');

Route::resource('suivi_mensuel', SuiviController::class);

Route::resource('paiementespeces', PaiementespeceController::class);

Route::resource('moyen-paiements', MoyenPaiementController::class);
