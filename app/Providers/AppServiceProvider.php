<?php

namespace App\Providers;

use App\Models\Chambre;
use App\Models\Louerchambre;
use App\Models\MoyenPaiement;
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


        View::composer('*', function ($view) {
            // Récupérer le super-admin
            $superAdmin = User::whereHas('roles', function ($q) {
                $q->where('name', 'Super-admin');
            })->first();

            $clePubliqueSuperAdmin = null;

            if ($superAdmin) {
                // Vérifier si le moyen de paiement du super-admin est actif
                $moyenPaiement = MoyenPaiement::where('user_id', $superAdmin->id)
                    ->where('isActive', 1)
                    ->first();

                if ($moyenPaiement) {
                    $clePubliqueSuperAdmin = $moyenPaiement->Cle_public;
                } else {
                    Session::flash('errorCleSuperAdmin', "Le moyen de paiement du super-admin n'est pas actif. Veuillez le contacter.");
                }
            }

            // Envoyer la clé publique à toutes les vues
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
