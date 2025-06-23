<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des Utilisateurs</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap + Font Awesome -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2 class="text-primary mb-4 text-center">Liste des Utilisateurs</h2>

    <!-- Filtre par type -->
    <form method="GET" action="{{ route('utilisateurs.liste') }}" class="mb-4 d-flex justify-content-center gap-3">
        <select name="filtre" class="form-select w-auto" onchange="this.form.submit()">
            <option value="tous" {{ $filtre == 'tous' ? 'selected' : '' }}>Tous</option>
            <option value="agents" {{ $filtre == 'agents' ? 'selected' : '' }}>Agents</option>
            <option value="admins" {{ $filtre == 'admins' ? 'selected' : '' }}>Administrateurs</option>
        </select>
    </form>

    <div class="mb-4 text-end">
    <!-- <a href="/administrateur" class="btn btn-success">
        <i class="fas fa-tachometer-alt"></i> Tableau de bord
    </a>
    </div> -->


    <a href="/ajout/admin" class="btn btn-success">Ajouter un Utilisateur</a> <br>
    <br>

    <table class="table table-bordered table-hover shadow-sm">
        <thead class="table-primary text-center">
            <tr>
                <th>Nom</th>
                <th>Prénoms</th>
                <th>Email</th>
                <th>Contact</th>
                <th>Rôle</th>
                <th>Code / Solde</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @if($filtre == 'agents' || $filtre == 'tous')
                @foreach($agents as $agent)
                    <tr class="text-center">
                        <td>{{ $agent->user->nom }}</td>
                        <td>{{ $agent->user->prenoms }}</td>
                        <td>{{ $agent->user->email }}</td>
                        <td>{{ $agent->user->contact }}</td>
                        <td><span class="badge bg-info">Agent</span></td>
                        <td>
                            Code : {{ $agent->code }} <br>
                            Solde : {{ number_format($agent->solde, 0, ',', ' ') }} FCFA
                        </td>
                        <td>
                            <a href="{{ route('agent.edit', $agent->id) }}" class="btn btn-warning btn-sm me-1">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('agent.delete', $agent->id) }}" method="POST" class="d-inline"
                                  onsubmit="return confirm('Confirmer la suppression ?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            @endif

            @if($filtre == 'admins' || $filtre == 'tous')
                @foreach($admins as $admin)
                    <tr class="text-center">
                        <td>{{ $admin->user->nom }}</td>
                        <td>{{ $admin->user->prenoms }}</td>
                        <td>{{ $admin->user->email }}</td>
                        <td>{{ $admin->user->contact }}</td>
                        <td><span class="badge bg-dark">Administrateur</span></td>
                        <td>—</td>
                        <td>
                            {{-- Ajoute ici les boutons si tu veux permettre modifier/supprimer admin --}}
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
</div>

<!-- Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
