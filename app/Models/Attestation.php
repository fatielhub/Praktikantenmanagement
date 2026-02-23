<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Attestation extends Model
{
    protected $fillable = [
        'stagiaire_id',
        'numero_attestation',
        'date_debut',
        'date_fin',
        'pdf_path',
    ];

    protected function casts(): array
    {
        return [
            'date_debut' => 'date',
            'date_fin' => 'date',
        ];
    }

    public function stagiaire(): BelongsTo
    {
        return $this->belongsTo(Stagiaire::class);
    }

    /**
     * Generate a unique attestation number (e.g. ATT-2026-00001).
     */
    public static function generateNumero(): string
    {
        $year = now()->format('Y');
        $last = static::whereYear('created_at', $year)->orderByDesc('id')->first();
        $seq = $last ? (int) substr($last->numero_attestation, -5) + 1 : 1;

        return 'ATT-' . $year . '-' . str_pad((string) $seq, 5, '0', STR_PAD_LEFT);
    }
}
