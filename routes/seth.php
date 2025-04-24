<?php

use App\Http\Controllers\Auth\GoogleAuthController;
use Illuminate\Support\Facades\Route;




Route::get('/login/google', [GoogleAuthController::class, 'redirectToGoogle'])->name('login.google');
Route::get('/login/google/callback', [GoogleAuthController::class, 'handleGoogleCallback'])->name('login.google.callback');
