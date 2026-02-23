<!DOCTYPE html>
<html>
<head>
    <title>Confirmation de demande de stage</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 20px auto; padding: 20px; border: 1px solid #e1e1e1; border-radius: 8px; }
        .header { background-color: #1e40af; color: white; padding: 15px; text-align: center; border-radius: 5px 5px 0 0; }
        .content { padding: 20px; }
        .dossier-box { background-color: #f3f4f6; border: 2px dashed #1e40af; padding: 15px; text-align: center; margin: 20px 0; border-radius: 8px; }
        .dossier-number { font-size: 24px; font-weight: bold; color: #1e40af; }
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
            <p>Nous avons bien reçu votre demande de stage au sein du <strong>Service Informatique</strong>.</p>
            <p>Votre dossier a été enregistré avec succès. Vous pouvez suivre l'état de votre demande en utilisant les informations suivantes :</p>
            
            <div class="dossier-box">
                <p>Numéro de Dossier :</p>
                <div class="dossier-number">{{ $stagiaire->dossier_number }}</div>
            </div>

            <p>Pour suivre votre demande, rendez-vous sur notre plateforme de suivi public :</p>
            <p style="text-align: center;">
                <a href="{{ route('public.track') }}" style="background-color: #1e40af; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px; display: inline-block;">Suivre ma demande</a>
            </p>
            
            <p>Veuillez conserver ce numéro précieusement.</p>
            <p>Cordialement,<br>L'administration</p>
        </div>
        <div class="footer">
            &copy; {{ date('Y') }} Service Informatique - Faculté d'Oujda.
        </div>
    </div>
</body>
</html>
