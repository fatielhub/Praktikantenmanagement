<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class StagiaireAcceptedNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(
        public $stagiaire
    ) {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Votre candidature de stage a été acceptée')
            ->greeting('Bonjour ' . $this->stagiaire->prenom . ' ' . $this->stagiaire->nom . ',')
            ->line('Nous sommes heureux de vous informer que votre candidature de stage a été acceptée.')
            ->line('Détails du stage :')
            ->line('- Début : ' . \Carbon\Carbon::parse($this->stagiaire->debut_stage)->format('d/m/Y'))
            ->line('- Fin : ' . \Carbon\Carbon::parse($this->stagiaire->fin_stage)->format('d/m/Y'))
            ->line('- Filière : ' . $this->stagiaire->filiere)
            ->line('Vous pouvez maintenant accéder à votre tableau de bord pour télécharger votre attestation de stage une fois qu\'elle sera générée.')
            ->line('Merci de votre confiance !');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
