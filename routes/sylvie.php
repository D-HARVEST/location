<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SuiviController;
use App\Http\Controllers\ChambreController;

Route::post('/louerchambres/validate', [ChambreController::class, 'validateStatut'])->name('louerchambres.validate');

Route::resource('suivi_mensuel', SuiviController::class);
