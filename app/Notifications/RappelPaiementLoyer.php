<?php

namespace App\Notifications;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class RappelPaiementLoyer extends Notification
{
    public $dateLimite;
    public $statut;

    public function __construct($dateLimite, $statut)
    {
        $this->dateLimite = $dateLimite;
        $this->statut = $statut;

    }

    public function via($notifiable)
    {
        return ['mail'];
    }

   public function toMail($notifiable)
{
    return (new MailMessage)
        ->subject('Rappel de paiement de loyer')
        ->greeting('Bonjour,')
        ->line($this->statut === 'RAPPEL'
            ? "Votre loyer arrive à échéance le " . $this->dateLimite->format('d/m/Y') . "."
            : "Votre loyer est en retard depuis le " . $this->dateLimite->format('d/m/Y') . ".")
        ->line('Merci de régulariser votre situation.')
        ->action('Payer maintenant', url('/payer-loyer'))
        ->salutation('Cordialement, L’équipe D-Harvest');
}

}
