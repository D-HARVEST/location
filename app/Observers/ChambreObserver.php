<?php

namespace App\Observers;

use App\Models\Chambre;

class ChambreObserver
{
    /**
     * Handle the Chambre "created" event.
     */
    public function created(Chambre $chambre): void
    {
        //
    }

    /**
     * Handle the Chambre "updated" event.
     */
    public function updated(Chambre $chambre)
    {
        if ($chambre->isDirty('jourpaiementLoyer')) {
            foreach ($chambre->louerchambres as $louerchambre) {
                $aujourdhui = now();
                $jourPaiement = $chambre->jourpaiementLoyer;

                $dateLimite = \Carbon\Carbon::create($aujourdhui->year, $aujourdhui->month, $jourPaiement);

                $paiementExistant = \App\Models\Paiementenattente::where('louerchambre_id', $louerchambre->id)
                    ->whereMonth('dateLimite', $dateLimite->month)
                    ->whereYear('dateLimite', $dateLimite->year)
                    ->exists();

                $debut = $louerchambre->created_at; // ou $louerchambre->date_debut si tu as un champ de début

                if (!$paiementExistant && $dateLimite >= $debut) {
                    \App\Models\Paiementenattente::create([
                        'louerchambre_id' => $louerchambre->id,
                        'dateLimite' => $dateLimite,
                        'montant' => $louerchambre->loyer,
                        'statut' => 'EN ATTENTE'
                    ]);
                }
            }
        }
    }


    /**
     * Handle the Chambre "deleted" event.
     */
    public function deleted(Chambre $chambre): void
    {
        //
    }

    /**
     * Handle the Chambre "restored" event.
     */
    public function restored(Chambre $chambre): void
    {
        //
    }

    /**
     * Handle the Chambre "force deleted" event.
     */
    public function forceDeleted(Chambre $chambre): void
    {
        //
    }
}
