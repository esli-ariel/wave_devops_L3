<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des Agents</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <div class="mb-4 text-end">
    <a href="/ajout/admin" class="btn btn-primary">
        Ajouter un agent
    </a>
</div>
    <h2 class="text-center mb-4 text-primary">Liste des Agents</h2>

    <table class="table table-bordered table-striped">
        <thead class="table-primary">
            <tr>
                <th>Nom</th>
                <th>Prénoms</th>
                <th>Email</th>
                <th>Contact</th>
                <th>Code Agent</th>
                <th>Solde (FCFA)</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($agents as $agent)
                <tr>
<td>{{ $agent->user->nom ?? 'Non défini' }}</td>
<td>{{ $agent->user->prenoms ?? 'Non défini' }}</td>
<td>{{ $agent->user->email ?? 'Non défini' }}</td>
<td>{{ $agent->user->contact ?? 'Non défini' }}</td>
<td>{{ $agent->code }}</td>
<td>{{ number_format($agent->solde, 0, ',', ' ') }}</td>

                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">Aucun agent trouvé.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
</body>
</html>
