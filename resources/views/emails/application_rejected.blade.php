<!DOCTYPE html>
<html>
<head>
    <title>Mise à jour de votre demande de stage</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 20px auto; padding: 20px; border: 1px solid #e1e1e1; border-radius: 8px; }
        .header { background-color: #dc2626; color: white; padding: 15px; text-align: center; border-radius: 5px 5px 0 0; }
        .content { padding: 20px; }
        .reason-box { background-color: #fef2f2; border-left: 4px solid #dc2626; padding: 15px; margin: 15px 0; }
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
            <p>Nous avons bien examiné votre demande de stage au sein de notre établissement.</p>
            <p>Malheureusement, nous ne pouvons pas donner suite à votre demande pour la raison suivante :</p>
            <div class="reason-box">
                {{ $reason }}
            </div>
            <p>Nous vous souhaitons bonne chance dans vos recherches futures.</p>
            <p>Cordialement,<br>L'administration</p>
        </div>
        <div class="footer">
            &copy; {{ date('Y') }} Service Informatique - Faculté d'Oujda.
        </div>
    </div>
</body>
</html>
