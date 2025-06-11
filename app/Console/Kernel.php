<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Définir les tâches planifiées.
     */
    protected function schedule(Schedule $schedule): void
    {
        // Exécute la commande le 5 de chaque mois à minuit
        $schedule->command('abonnement:generer')->monthlyOn(5, '00:00');
    }

    /**
     * Enregistrer les commandes Artisan personnalisées.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
