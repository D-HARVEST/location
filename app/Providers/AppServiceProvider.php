<?php

namespace App\Providers;

use App\Models\Chambre;
use App\Models\Louerchambre;
use App\Models\User;
use App\Observers\ChambreObserver;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Spatie\Permission\Models\Role;

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


        // Clé publique du super-admin
        View::composer('*', function ($view) {
            $clePubliqueSuperAdmin = null;

            // Ici, on suppose que le super-admin est identifié par un rôle spécifique
            $superAdmin = User::role('Super-admin')->first();

            if ($superAdmin && $superAdmin->moyenPaiement && $superAdmin->moyenPaiement->isActive == 1) {
                $clePubliqueSuperAdmin = $superAdmin->moyenPaiement->Cle_public;
            } else {
                Session::flash('errorCleSuperAdmin', "Le moyen de paiement du super-admin n'est pas actif. Veuillez le contacter.");
            }

            $view->with('clePubliqueSuperAdmin', $clePubliqueSuperAdmin);
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Chambre::observe(ChambreObserver::class);
    }
}
