<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AttestationReadyNotification extends Notification
{
    use Queueable;

    public function __construct(
        public \App\Models\Attestation $attestation
    ) {}

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        $stagiaire = $this->attestation->stagiaire;
        $name = trim($stagiaire->prenom . ' ' . $stagiaire->nom);

        return (new MailMessage)
            ->subject('Votre attestation de stage est prête')
            ->greeting('Bonjour ' . $name . ',')
            ->line('Votre attestation de stage a été générée.')
            ->line('Vous pouvez la télécharger depuis votre tableau de bord.')
            ->action('Accéder au tableau de bord', url('/stagiaire/dashboard'));
    }

    public function toArray(object $notifiable): array
    {
        return [];
    }
}
