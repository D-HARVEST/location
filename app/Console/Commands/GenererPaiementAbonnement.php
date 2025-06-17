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
        $this->info("Début de la génération des paiements d’abonnement...");

        // Pourcentage par défaut depuis settings
        $pourcentageParDefaut = (float) Setting::where('key', 'pourcentage_abonnement')->value('value') ?? 4;

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

                // Appliquer pourcentage spécial si encore valide
                $pourcentage = $pourcentageParDefaut;
                if ($maison->pourcentage_special && $maison->date_fin_mois) {
                    $finSpecial = Carbon::createFromFormat('Y-m', $maison->date_fin_mois)->endOfMonth();
                    if ($fin->lessThanOrEqualTo($finSpecial)) {
                        $pourcentage = $maison->pourcentage_special;
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
        }

        $this->info("Génération terminée.");
    }
}
