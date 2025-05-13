<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LouerchambreController;

Route::post('/louerchambres/validate', [LouerchambreController::class, 'validateStatut'])->name('louerchambres.validate');
