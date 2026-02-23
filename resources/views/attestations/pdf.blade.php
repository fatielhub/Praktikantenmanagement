<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Attestation {{ $attestation->numero_attestation }}</title>
    <style>
        @page { margin: 0; size: A4; }
        body { font-family: 'DejaVu Sans', serif; margin: 0; padding: 40px; color: #000; font-size: 12px; }
        .header { text-align: center; margin-bottom: 30px; border-bottom: 3px solid #6b3e1c; padding-bottom: 15px; }
        .header-line { font-size: 18px; font-weight: bold; color: #6b3e1c; margin: 0 0 6px 0; }
        .header-sub { font-size: 12px; margin: 2px 0; }
        .logo { max-height: 70px; margin-bottom: 10px; }
        .content { margin: 25px 0; line-height: 1.7; text-align: justify; }
        .content p { margin: 12px 0; }
        .numero { text-align: right; font-size: 11px; color: #555; margin-bottom: 20px; }
        .title { text-align: center; font-size: 16px; font-weight: bold; margin-bottom: 25px; }
        .highlight { font-weight: bold; }
        .signature-section { margin-top: 50px; }
        .signature-box { width: 45%; display: inline-block; text-align: center; vertical-align: top; }
        .signature-line { border-top: 1px solid #000; margin-top: 50px; padding-top: 5px; font-size: 11px; }
        .footer-date { text-align: right; margin-top: 30px; font-size: 12px; }
    </style>
</head>
<body>
    {{-- Header: FACULTÉ DES SCIENCES, Université Mohammed Premier, Oujda, Maroc --}}
    <div class="header">
        @if(!empty($logoPath) && file_exists($logoPath))
            <img src="{{ $logoPath }}" alt="Logo" class="logo">
        @endif
        <p class="header-line">FACULTÉ DES SCIENCES</p>
        <p class="header-sub">Université Mohammed Premier</p>
        <p class="header-sub">Oujda, Maroc</p>
    </div>

    <div class="numero">N° attestation : {{ $attestation->numero_attestation }}</div>

    <div class="content">
        {{-- Title: ATTESTATION DE STAGE --}}
        <p class="title">ATTESTATION DE STAGE</p>

        <p>Je soussigné(e), Directeur de la Faculté des Sciences d'Oujda, certifie que :</p>

        {{-- Stagiaire: Name, CIN, Date of Birth, Niveau, Filière --}}
        <p style="margin-left: 25px;">
            <span class="highlight">{{ $stagiaire->prenom }} {{ $stagiaire->nom }}</span><br>
            CIN : <span class="highlight">{{ $stagiaire->cin }}</span><br>
            Né(e) le : <span class="highlight">{{ \Carbon\Carbon::parse($stagiaire->date_naissance)->format('d/m/Y') }}</span><br>
            Niveau : <span class="highlight">{{ $stagiaire->niveau_etude }}</span><br>
            Filière : <span class="highlight">{{ $stagiaire->filiere ?? '—' }}</span>
        </p>

        {{-- Stage period: start date – end date --}}
        <p>
            a effectué un stage au sein de notre établissement du
            <span class="highlight">{{ \Carbon\Carbon::parse($attestation->date_debut)->format('d/m/Y') }}</span>
            au
            <span class="highlight">{{ \Carbon\Carbon::parse($attestation->date_fin)->format('d/m/Y') }}</span>.
        </p>

        {{-- Sujet du stage --}}
        @if($stagiaire->sujet_rapport)
            <p>Sujet du stage : <span class="highlight">{{ $stagiaire->sujet_rapport }}</span></p>
        @endif

        <p>Cette attestation est délivrée pour servir et valoir ce que de droit.</p>
    </div>

    {{-- Footer: Oujda, [current date], Le Directeur, Le Stagiaire --}}
    <p class="footer-date">Oujda, le {{ now()->format('d/m/Y') }}</p>

    <div class="signature-section">
        <div class="signature-box">
            <div class="signature-line">Le Directeur</div>
        </div>
        <div class="signature-box">
            <div class="signature-line">Le Stagiaire</div>
        </div>
    </div>
</body>
</html>
