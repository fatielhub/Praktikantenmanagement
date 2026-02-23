<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Stagiaire extends Model
{
    use HasFactory;

    protected $fillable = [
        'dossier_number',
        'user_id',
        'nom',
        'prenom',
        'cin',
        'telephone',
        'email',
        'date_naissance',
        'niveau_etude',
        'filiere',
        'universite',
        'message',
        'cv_path',
        'motivation_letter_path',
        'cni_copy_path',
        'insurance_certificate_path',
        'signed_convention_path',
        'sujet_rapport',
        'encadrant_faculte_id',
        'encadrant_secondaire',
        'encadrant_ofppt_id',
        'service_id',
        'debut_stage',
        'fin_stage',
        'attestation_status',
        'status',
        'refusal_reason',
    ];

    public function attestations(): HasMany
    {
        return $this->hasMany(Attestation::class);
    }

    public function latestAttestation(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Attestation::class)->latestOfMany();
    }
}
