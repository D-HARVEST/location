<?php

namespace App\Console\Commands;

use App\Models\Chambre;
use App\Models\HistoriquePaiadm;
use App\Models\LouerChambre;
use App\Models\Maison;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;

class GenererPaiementAbonnement extends Command
{
    protected $signature = 'abonnement:generer';
    protected $description = 'Créer un paiement en attente pour chaque gérant chaque mois';

    public function handle()
    {


        // Exécuter uniquement le 5 de chaque mois
        if (Carbon::now()->day !== 5) {
            $this->info("Cette commande ne s’exécute que le 5 de chaque mois.");
            return;
        }

        $this->info("Début de la génération des paiements d’abonnement...");

        // Pourcentage par défaut depuis settings
        $valeur = Setting::where('key', 'pourcentage_abonnement')->value('value');
        $pourcentageParDefaut = $valeur === null ? 4 : (float) $valeur;



        $gerants = User::role('gerant')->get();

        foreach ($gerants as $gerant) {
            $debut = Carbon::now()->startOfMonth();
            $fin = Carbon::now()->endOfMonth();
            $moisPaiement = $debut->format('Y-m');

            // Ne pas dupliquer
            $dejaCree = HistoriquePaiadm::where('user_id', $gerant->id)
                ->where('moisPaiement', $moisPaiement)
                ->exists();
            if ($dejaCree) continue;

            $maisons = Maison::where('user_id', $gerant->id)->get();
            $totalMontant = 0;

            foreach ($maisons as $maison) {
                // Récupère les chambres de la maison
                $chambreIds = $maison->chambres()->pluck('id');

                // Revenu sur ces chambres pour le mois courant
                $revenusMaison = LouerChambre::whereIn('chambre_id', $chambreIds)
                    ->where('statut', 'CONFIRMER')
                    ->whereBetween('created_at', [$debut, $fin])
                    ->sum('loyer');

                if ($revenusMaison <= 0) continue;

                // Déterminer le pourcentage applicable
                $pourcentage = $maison->pourcentage_abonnement === null
                    ? 4
                    : (float) $maison->pourcentage_abonnement;

                // Gérer pourcentage spécial s’il est encore valide
                if ($maison->pourcentage_special !== null && $maison->date_fin_mois) {
                    $finSpecial = Carbon::parse($maison->date_fin_mois);
                    if (Carbon::now()->lessThanOrEqualTo($finSpecial)) {
                        $this->info("Maison ID {$maison->id} : application du pourcentage spécial de {$maison->pourcentage_special}% (valide jusqu’au {$finSpecial->toDateString()})");
                        $pourcentage = (float) $maison->pourcentage_special;
                    } else {
                        $this->info("Maison ID {$maison->id} : pourcentage spécial expiré, retour au pourcentage de base ({$pourcentage}%).");
                    }
                }




                // Calcul du montant
                $totalMontant += round($revenusMaison * ($pourcentage / 100));
            }

            if ($totalMontant <= 0) continue;

            // Créer l'enregistrement
            HistoriquePaiadm::create([
                'datePaiement' => null,
                'quittanceUrl' => null,
                'montant' => $totalMontant,
                'modePaiement' => null,
                'idTransaction' => null,
                'moisPaiement' => $moisPaiement,
                'statut' => 'EN ATTENTE',
                'user_id' => $gerant->id,
            ]);

            // Notification
            $gerant->notify(new \App\Notifications\PaiementEnAttenteNotification($totalMontant, $moisPaiement, $gerant));

            $this->info("Paiement généré pour le gérant ID {$gerant->id} - Mois : $moisPaiement - Montant : $totalMontant");

            // --- NOUVEAU : Vérifier le nombre de paiements en attente pour ce gérant
            $enAttenteCount = HistoriquePaiadm::where('user_id', $gerant->id)
                ->where('statut', 'EN ATTENTE')
                ->count();

            // Désactiver si 2 mois ou plus en attente, sinon activer
            if ($enAttenteCount >= 2) {
                $gerant->isActive = 0;
            } else {
                $gerant->isActive = 1;
            }
            $gerant->save();
        }

        $this->info("Génération terminée.");
    }
}
