<?php

namespace App\Mail;

use App\Models\Attestation;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class AttestationReadyMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public Attestation $attestation
    ) {}

    public function envelope(): Envelope
    {
        $name = trim($this->attestation->stagiaire->prenom . ' ' . $this->attestation->stagiaire->nom);

        return new Envelope(
            subject: 'Votre attestation de stage est prête',
            replyTo: [],
        );
    }

    public function content(): Content
    {
        $stagiaire = $this->attestation->stagiaire;
        $name = trim($stagiaire->prenom . ' ' . $stagiaire->nom);

        return new Content(
            view: 'emails.attestation-ready',
            with: [
                'name' => $name,
                'numero' => $this->attestation->numero_attestation,
            ]
        );
    }

    /**
     * Attach the generated PDF.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        $path = Storage::disk('public')->path($this->attestation->pdf_path);
        $filename = 'attestation_stage_' . $this->attestation->stagiaire->nom . '_' . $this->attestation->stagiaire->prenom . '.pdf';

        if (!is_file($path)) {
            return [];
        }

        return [
            Attachment::fromPath($path)
                ->as($filename)
                ->withMime('application/pdf'),
        ];
    }
}
