<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\Chambre;
use App\Models\LouerChambre;
use App\Models\HistoriquePaiAdm;
use Carbon\Carbon;

class GenererPaiementAbonnement extends Command
{
    protected $signature = 'abonnement:generer';
    protected $description = 'Générer les paiements de 5% pour chaque propriétaire le 5 du mois';

    public function handle()
    {
        $today = Carbon::now();
        if ($today->day != 5) {
            return 0;
        }

        $proprietaires = User::whereHas('roles', fn($q) => $q->where('name', 'gerant'))->get();

        foreach ($proprietaires as $user) {
            $moisPaiement = $today->format('Y-m');
            $existe = HistoriquePaiAdm::where('user_id', $user->id)
                ->where('moisPaiement', $moisPaiement)
                ->exists();

            if ($existe) continue;

            $chambreIds = Chambre::whereHas('maison', fn($q) => $q->where('user_id', $user->id))->pluck('id');
            $revenus = LouerChambre::whereIn('chambre_id', $chambreIds)
                ->where('statut', 'CONFIRMER')
                ->sum('loyer');

            $montant = $revenus * 5 / 100;

            if ($montant > 0) {
                HistoriquePaiAdm::create([
                    'montant' => $montant,
                    'moisPaiement' => $moisPaiement,
                    'statut' => 'EN ATTENTE',
                    'user_id' => $user->id
                ]);
            }
        }

        return 0;
    }
}
