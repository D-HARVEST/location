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
        return ['mail']; // ou ['database', 'mail'] si vous avez les notifications en base
    }

    public function toMail($notifiable)
    {
        $message = new MailMessage();
        $message->subject('Rappel de paiement de loyer');

        if ($this->statut === 'RAPPEL') {
            $message->line("Votre loyer arrive à échéance le " . $this->dateLimite->format('d/m/Y') . ".");
        } elseif ($this->statut === 'EN RETARD') {
            $message->line("Votre loyer est en retard depuis le " . $this->dateLimite->format('d/m/Y') . ".");
        }

        return $message->line('Merci de régulariser votre situation.')
                       ->action('Payer maintenant', url('/payer-loyer'));
    }
}
