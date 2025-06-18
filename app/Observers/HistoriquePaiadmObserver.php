<?php

namespace App\Observers;

use App\Models\HistoriquePaiadm;

class HistoriquePaiadmObserver
{
    public function updated(HistoriquePaiadm $paiement)
    {
        // Si le statut a été modifié
        if ($paiement->isDirty('statut')) {
            $user = $paiement->user;

            // Compter les paiements EN ATTENTE de ce gérant
            $enAttenteCount = $user->paiementsAbonnements()
                ->where('statut', 'EN ATTENTE')
                ->count();

            // Mettre à jour isActive
            $user->isActive = $enAttenteCount >= 2 ? 0 : 1;
            $user->save();
        }
    }
}
