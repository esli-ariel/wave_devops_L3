<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Historique des Transactions</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f7f9fb;
            font-family: 'Segoe UI', sans-serif;
        }
        .btn-custom {
            background-color: #0077b6;
            color: white;
        }
        .btn-custom:hover {
            background-color: #023e8a;
        }
        .card {
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        .table th {
            background-color: #0077b6;
            color: white;
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold"> Historique des Transactions</h2>
        <div>
            <a href="{{ route('transactions.pdf') }}" class="btn btn-success me-2">
                <i class="bi bi-file-earmark-pdf"></i> Télécharger PDF
            </a>
            <!-- <a href="/login#" class="btn btn-danger">
                <i class="bi bi-arrow-left-circle"></i> Retour Admin
            </a> -->
        </div>
    </div>

    <div class="card p-4">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
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
                    @forelse ($transactions as $transaction)
                        <tr>
                            <td>{{ $transaction->id }}</td>
                            <td>{{ $transaction->numero }}</td>
                            <td>{{ $transaction->user->nom ?? 'N/A' }} {{ $transaction->user->prenoms ?? '' }}</td>
                            <td>{{ ucfirst($transaction->user->type ?? 'N/A') }}</td>
                            <td>{{ ucfirst($transaction->type) }}</td>
                            <td>{{ number_format($transaction->montant, 0, ',', ' ') }} FCFA</td>
                            <td>{{ $transaction->created_at->format('d/m/Y H:i') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted">Aucune transaction trouvée.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</body>
</html>
