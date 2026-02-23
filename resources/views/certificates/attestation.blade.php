<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Attestation de Stage</title>

    <style>
        @page {
            size: A4;
            margin: 40px;
        }

        body {
            font-family: "Times New Roman", serif;
            color: #000;
            font-size: 14px;
            line-height: 1.8;
        }

        .top-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            text-align: center;
        }

        .header-block {
            width: 35%;
            font-size: 13px;
        }

        .header-block p {
            margin: 3px 0;
        }

        .logo {
            width: 120px;
        }

        .title {
            text-align: center;
            margin: 50px 0 30px 0;
            font-size: 22px;
            font-weight: bold;
            text-decoration: underline;
        }

        .content {
            text-align: justify;
            margin-top: 20px;
        }

        .content p {
            margin: 15px 0;
        }

        .date {
            text-align: right;
            margin-top: 40px;
        }

        .footer {
            text-align: center;
            margin-top: 70px;
            font-size: 12px;
            border-top: 1px solid #000;
            padding-top: 10px;
        }

        .bold {
            font-weight: bold;
        }
    </style>
</head>

<body>

    <!-- HEADER -->
    <div class="top-header">

        <!-- LEFT (FR) -->
        <div class="header-block">
            <p>Royaume du Maroc</p>
            <p>*</p>
            <p>Université Mohammed Premier</p>
            <p>*</p>
            <p>Faculté des Sciences</p>
            <p>*</p>
            <p>Oujda</p>
        </div>

        <!-- LOGO -->
        <div>
            <img src="{{ public_path('images/logo.png') }}" class="logo">
        </div>

        <!-- RIGHT (AR) -->
        <div class="header-block" dir="rtl">
            <p>المملكة المغربية</p>
            <p>*</p>
            <p>جامعة محمد الأول</p>
            <p>*</p>
            <p>كلية العلوم</p>
            <p>*</p>
            <p>وجدة</p>
        </div>

    </div>

    <!-- TITLE -->
    <div class="title">
        ATTESTATION DE STAGE
    </div>

    <!-- CONTENT -->
    <div class="content">

        <p>
            Le Doyen de la Faculté des Sciences d'Oujda,
            atteste par la présente que :
        </p>

        <p>
            Le stagiaire 
            <span class="bold">{{ $stagiaire->prenom }} {{ $stagiaire->nom }}</span>,
        </p>

        <p>
            CIN : <span class="bold">{{ $stagiaire->cin }}</span>, 
            <span class="bold">{{ $stagiaire->niveau_etude }}</span> 
            en filière 
            <span class="bold">{{ $stagiaire->filiere }}</span>
            à 
            <span class="bold">{{ $stagiaire->universite ?? 'Oujda' }}</span>,
        </p>

        <p>
            a suivi un stage de 
            <span class="bold">
                {{ \Carbon\Carbon::parse($stagiaire->debut_stage)->diffInDays(\Carbon\Carbon::parse($stagiaire->fin_stage)) }}
                jours
            </span>
            au sein du service informatique de la faculté
            du 
            <span class="bold">
                {{ \Carbon\Carbon::parse($stagiaire->debut_stage)->format('d/m/Y') }}
            </span>
            au 
            <span class="bold">
                {{ \Carbon\Carbon::parse($stagiaire->fin_stage)->format('d/m/Y') }}
            </span>.
        </p>

        <p>
            Cette attestation est délivrée à l’intéressé pour servir et valoir ce que de droit.
        </p>

    </div>

    <!-- DATE -->
    <div class="date">
        Oujda, le {{ \Carbon\Carbon::now()->format('d/m/Y') }}
    </div>

    <!-- FOOTER -->
    <div class="footer">
        Faculté des Sciences – Université Mohammed Premier <br>
        BV Mohammed VI BP 717 Oujda Maroc <br>
        Phone : +212 539890 – Fax : +212 6666666666
    </div>

</body>
</html>