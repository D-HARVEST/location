<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Str;


class PaiementEnAttenteNotification extends Notification
{
    use Queueable;

    public $id, $montant, $mois;

    public function __construct($montant, $mois)
    {
        $this->montant = $montant;
        $this->mois = $mois;
        $this->id = Str::uuid(); // Génère un ID unique pour la notification
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Paiement en attente')
            ->greeting("Bonjour {$notifiable->name},")
            ->line("Un paiement d'abonnement d'un montant de {$this->montant} FCFA est en attente pour le mois de {$this->mois}.")
            ->line('Merci de le régler dès que possible.')
            ->salutation('Cordialement, L’équipe de gestion');
    }
}
