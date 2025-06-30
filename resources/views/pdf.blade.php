<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>PDF Transactions</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 6px; text-align: left; }
        th { background-color: #0077b6; color: white; }
    </style>
</head>
<body>
    <h2>Historique des Transactions</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Numéro</th>
                <th>Utilisateur</th>
                <th>Catégorie</th>
                <th>Type</th>
                <th>Montant</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transactions as $transaction)
                <tr>
                    <td>{{ $transaction->id }}</td>
                    <td>{{ $transaction->numero }}</td>
                    <td>{{ $transaction->user->nom ?? 'N/A' }} {{ $transaction->user->prenoms ?? '' }}</td>
                    <td>{{ ucfirst($transaction->user->type ?? '') }}</td>
                    <td>{{ ucfirst($transaction->type) }}</td>
                    <td>{{ number_format($transaction->montant, 0, ',', ' ') }} FCFA</td>
                    <td>{{ $transaction->created_at->format('d/m/Y H:i') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
