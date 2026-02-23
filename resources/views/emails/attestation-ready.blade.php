<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attestation de stage</title>
    <style>
        body { font-family: sans-serif; line-height: 1.6; color: #1f2937; max-width: 600px; margin: 0 auto; padding: 24px; }
        .header { border-bottom: 2px solid #b45309; padding-bottom: 16px; margin-bottom: 24px; }
        .header h1 { margin: 0; font-size: 20px; color: #92400e; }
        .content { margin-bottom: 24px; }
        .button { display: inline-block; padding: 12px 24px; background: #b45309; color: #fff !important; text-decoration: none; border-radius: 8px; font-weight: 600; margin-top: 16px; }
        .button:hover { background: #92400e; }
        .footer { margin-top: 32px; padding-top: 16px; border-top: 1px solid #e5e7eb; font-size: 14px; color: #6b7280; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Faculté des Sciences – Oujda</h1>
    </div>

    <div class="content">
        <p>Bonjour {{ $name }},</p>
        <p>Votre attestation de stage a été générée (N° <strong>{{ $numero }}</strong>).</p>
        <p>Vous pouvez la télécharger depuis votre dashboard. Le fichier PDF est également joint à cet email.</p>
        <p>
            <a href="{{ url('/stagiaire/dashboard') }}" class="button">Accéder à mon dashboard</a>
        </p>
    </div>

    <div class="footer">
        <p>Cet email a été envoyé automatiquement par le système de gestion des stagiaires.</p>
    </div>
</body>
</html>
