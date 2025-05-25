<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Facture</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
            margin: 40px;
        }
        .top-right {
            text-align: right;
            font-size: 12px;
        }
        .logo {
            text-align: center;
            margin: 20px 0;
        }
        .title {
            text-align: center;
            font-size: 20px;
            margin-bottom: 20px;
        }
        table {
            border-collapse: collapse;
            width: 100%;
        }
        .info-box {
            border: 1px solid #3fa1a9;
            padding: 10px;
            height: 140px;
            vertical-align: top;
        }
        .info-title {
            font-weight: bold;
            margin-bottom: 8px;
        }
        .info-line {
            margin-bottom: 4px;
        }
        .row-space {
            margin-top: 15px;
            margin-bottom: 15px;
        }
        .service-table th, .service-table td {
            border: 1px solid #005bab;
            padding: 8px;
            text-align: left;
        }
        .service-table th {
            background-color: #f0f8ff;
        }
        .total-box {
            width: 250px;
            border: 1px solid #005bab;
            padding: 8px;
            float: right;
            margin-top: 10px;
        }
        .footer {
            clear: both;
            font-size: 12px;
            margin-top: 30px;
            font-style: italic;
        }
    </style>
</head>
<body>

    <div class="top-right">
        Modèle mis à jour le :<br> {{ $paiement->updated_at->format('d/m/Y H:i') }}
    </div>

    {{-- <div class="logo">
        <img src="{{ asset('logo-dh.svg') }}" width="50" alt="img-fluid" />
    </div> --}}

    <div class="title">
        FACTURE N°{{ $paiement->id }}
    </div>

    <!-- Info Propriétaire & Client -->
    <table class="row-space">
        <tr>
            <td class="info-box" style="width: 50%;">
                <div class="info-title">Propriétaire</div>
                Nom : {{ $maison->user->name ?? 'N/A' }}<br>
                Email : {{ $maison->user->email ?? 'N/A' }}<br>
                Code postal : 229<br>
            </td>
            <td class="info-box" style="width: 50%;">
                <div class="info-title">Client</div>
                Nom : {{ $locataire->name }}<br>
                Email : {{ $locataire->email }}<br>
                Adresse : {{ $maison->adresse ?? 'N/A' }}<br>
                Code postal : 229
            </td>
        </tr>
    </table>

    <!-- Siren / Date -->
    <table class="row-space">
        <tr>
            <td style="width: 50%; vertical-align: top;">
                <strong> Type de paiement  :</strong>Espèce<br>
                <strong> Mois de paiement  :</strong> {{ $paiement->Mois ?? 'N/A' }}
            </td>
            <td style="width: 50%; vertical-align: top;">
                <strong>Date de facturation :</strong> {{ $paiement->created_at->format('d/m/Y') }}<br>
            </td>
        </tr>
    </table>

    <!-- Tableau des services -->
    <table class="service-table">
        <thead>
            <tr>
                <th>Service</th>

                <th>Prix Unitaire (HT)</th>
                <th>Prix Total (HT)</th>
            </tr>
        </thead>
        <tbody>
            <tr style="height: 80px;">
                <td>Loyer chambre - {{ $chambre->libelle }}</td>
                <td>{{ number_format($paiement->Montant, 0, ',', ' ') }} FCFA</td>
                <td>{{ number_format($paiement->Montant, 0, ',', ' ') }} FCFA</td>
            </tr>
        </tbody>
    </table>

    <!-- Total à régler -->
    <div class="total-box">
        <strong>Prix total à régler :</strong><br>
        {{ number_format($paiement->Montant, 0, ',', ' ') }} FCFA
    </div>

    <!-- Footer -->
    <div class="footer">
        TVA non applicable.<br>
        Paiement effectué le {{ $paiement->created_at->format('d/m/Y à H:i') }}.
    </div>

</body>
</html>
