<!DOCTYPE html>
<html>
<head>
    <title>Demande de stage acceptée</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 20px auto; padding: 20px; border: 1px solid #e1e1e1; border-radius: 8px; }
        .header { background-color: #1e40af; color: white; padding: 15px; text-align: center; border-radius: 5px 5px 0 0; }
        .content { padding: 20px; }
        .footer { font-size: 0.8em; color: #666; text-align: center; margin-top: 20px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Faculté des Sciences d'Oujda</h2>
        </div>
        <div class="content">
            <p>Bonjour <strong>{{ $stagiaire->prenom }} {{ $stagiaire->nom }}</strong>,</p>
            <p>Nous avons le plaisir de vous informer que votre demande de stage au sein du <strong>Service Informatique</strong> a été <strong>acceptée</strong>.</p>
            <p><strong>Détails du stage :</strong></p>
            <ul>
                <li>Période : Du {{ \Carbon\Carbon::parse($stagiaire->debut_stage)->format('d/m/Y') }} au {{ \Carbon\Carbon::parse($stagiaire->fin_stage)->format('d/m/Y') }}</li>
            </ul>
            <p>Vous pouvez maintenant télécharger votre attestation de stage et suivre votre dossier sur notre portail dédié à l'aide de votre adresse email et de votre numéro de dossier ({{ $stagiaire->dossier_number }}).</p>
            <p style="text-align: center;">
                <a href="{{ route('public.track') }}" style="background-color: #1e40af; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px; display: inline-block;">Suivre mon dossier</a>
            </p>
            <p>Cordialement,<br>L'administration</p>
        </div>
        <div class="footer">
            &copy; {{ date('Y') }} Service Informatique - Faculté d'Oujda.
        </div>
    </div>
</body>
</html>
