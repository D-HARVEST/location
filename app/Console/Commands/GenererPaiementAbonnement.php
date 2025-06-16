<?php

namespace App\Console\Commands;

use App\Models\Chambre;
use App\Models\HistoriquePaiadm;
use App\Models\LouerChambre;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;

class GenererPaiementAbonnement extends Command
{
    protected $signature = 'abonnement:generer';
    protected $description = 'Créer un paiement en attente pour chaque gérant à chaque 5 du mois';

    public function handle()
    {
        $this->info("Début de la génération des paiements d’abonnement...");

        $gerants = User::role('gerant')->get();

        foreach ($gerants as $gerant) {
            // Mois précédent
            // $debut = Carbon::now()->subMonth()->startOfMonth();
            // $fin = Carbon::now()->subMonth()->endOfMonth();

            $debut = Carbon::now()->startOfMonth();
            $fin = Carbon::now()->endOfMonth();


            // Toutes les chambres de ses maisons
            $chambreIds = Chambre::whereHas('maison', fn($q) => $q->where('user_id', $gerant->id))->pluck('id');

            // Revenus du mois précédent
            $revenus = LouerChambre::whereIn('chambre_id', $chambreIds)
                ->where('statut', 'CONFIRMER')
                ->whereBetween('created_at', [$debut, $fin])
                ->sum('loyer');

            $montant = round($revenus * 0.05);


            // Sauter si aucun revenu
            if ($montant <= 0) continue;

            // Vérifier doublon
            $moisPaiement = $debut->format('Y-m');
            $dejaCree = HistoriquePaiadm::where('user_id', $gerant->id)
                ->where('moisPaiement', $moisPaiement)
                ->exists();

            if ($dejaCree) continue;

            // Création
            HistoriquePaiadm::create([
                'datePaiement' => null,
                'quittanceUrl' => null,
                'montant' => $montant,
                'modePaiement' => null,
                'idTransaction' => null,
                'moisPaiement' => $moisPaiement,
                'statut' => 'EN ATTENTE',
                'user_id' => $gerant->id,
            ]);

            // Envoyer la notification par e-mail
            $gerant->notify(new \App\Notifications\PaiementEnAttenteNotification($montant, $moisPaiement, $gerant));

            $this->info("Paiement en attente créé pour le gérant ID {$gerant->id} - Mois : $moisPaiement - Montant : $montant");
        }

        $this->info("Génération terminée.");
    }
}
