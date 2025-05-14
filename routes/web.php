<?php

use App\Models\Louerchambre;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\LouerchambreController;
use App\Http\Controllers\HistoriquepaiementController;





require base_path('routes/seth.php');
require base_path('routes/provice.php');
require base_path('routes/sylvie.php');


// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();
Route::get('theme-toggle', function () {
    if (session('theme')) {
        session()->forget('theme');
    } else {
        session(['theme' => 'dark']);
    }
    return back();
})->name('theme-toggle');
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::redirect('/home', '/');

// Route::get('/landing', function () {
//     return view('landing.landing');
// })->name('landing');
// Route::redirect('/', '/landing')->name('home');

Route::middleware(['auth', 'update-last-login', 'permission:gerer users',])->group(function () {
    Route::resource("users", UserController::class);
    Route::post('users/{user_id}/roles', [UserController::class, 'storeRole'])->name('users.storeRole');
});
Route::middleware(['auth', 'update-last-login', 'permission:gerer roles'])->group(function () {
    Route::resource("roles", RoleController::class);
    Route::post('roles/{role}/permissions', [RoleController::class, 'storePermissions'])->name('roles.storePermissions');
});

Route::get('/profile', [ProfilController::class, 'show'])->name('profile.show');
Route::put('/profile', [ProfilController::class, 'updateProfile'])->name('profile.update');
Route::put('/profile/change-password', [ProfilController::class, 'updatePassword'])->name('profile.password.update');
Route::post('/profile/logout-other-sessions', [ProfilController::class, 'logoutOtherSessions'])->name('logout.other.sessions');
Route::delete('/profile/delete-account', [ProfilController::class, 'deleteAccount'])->name('account.delete');
Route::post('/user/update-image', [UserController::class, 'updateImage'])->name('user.updateImage');
Route::resource('historiquepaiements', HistoriquepaiementController::class);


Route::get('/paiement/{transaction_id}', [LouerchambreController::class, 'enregistrerPaiement'])->name('paiement');



