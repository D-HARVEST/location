<?php
namespace App\Notifications;

use App\Models\Intervention;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class InterventionSoumise extends Notification
{
    use Queueable;

    public $intervention;

    public function __construct(Intervention $intervention)
    {
        $this->intervention = $intervention;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('Nouvelle intervention soumise')
                    ->line("Une nouvelle intervention a été soumise par le locataire.")
                    ->action('Voir l\'intervention', route('interventions.show', $this->intervention->id))
                    ->line('Merci d’utiliser notre plateforme.');
    }
}
