<?php

namespace App\Providers;

use App\Models\Louerchambre;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Session;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        View::composer('*', function ($view) {
        $clePublic = null;

        if (Auth::check()) {
            $louer = Louerchambre::where('user_id', Auth::id())
                ->with('chambre.maison.moyenPaiement')
                ->latest()
                ->first();

            if ($louer && $louer->chambre && $louer->chambre->maison) {
                $moyen = $louer->chambre->maison->moyenPaiement;

                if ($moyen && $moyen->isActive == 1) {
                    $clePublic = $moyen->Cle_public;
                } else {
                    // Clé absente ou inactive => message d'erreur
                    Session::flash('errorCle', "Le moyen de paiement du propriétaire n'est pas actif. Veuillez le contacter.");
                }
            } else {
                Session::flash('errorCle', "Impossible de récupérer les informations de paiement. Contactez votre propriétaire.");
            }
        }

        $view->with('clePublic', $clePublic);
    });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        // App::setLocale('fr');
    }
}
