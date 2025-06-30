<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Transfert d'argent - Client</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background-color: #f4f6f9; font-family: Arial, sans-serif;">

<div class="container mt-5">
    <h2 class="mb-4">Transfert d'argent vers un autre client</h2>

    {{-- Affichage des messages de succès ou d'erreur --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    {{-- Affichage des erreurs de validation --}}
    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $message)
                    <li>{{ $message }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Formulaire de transfert -->
    <form action="{{ route('client.transfer') }}" method="POST" class="card p-4 shadow-sm bg-white">
        @csrf

        <div class="mb-3">
            <label for="recipient_contact" class="form-label">Numéro du destinataire</label>
            <input type="text" id="recipient_contact" name="recipient_contact" class="form-control" placeholder="Ex : 0700000000" required>
        </div>

        <div class="mb-3">
            <label for="amount" class="form-label">Montant</label>
            <input type="number" id="amount" name="amount" class="form-control" placeholder="Ex : 5000" min="1" required>
        </div>

        <button type="submit" class="btn btn-primary">Envoyer</button>
    </form>

    <div class="mt-4">
        <a href="{{ url('/client') }}" class="btn btn-secondary">Retour au tableau de bord</a>
    </div>
</div>

<!-- Bootstrap JS (optionnel) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
