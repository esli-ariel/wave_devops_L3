<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <title>Envoyer de l'argent - Agent</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
<div class="container mt-5">
    <h2>Envoyer de l'argent à un client</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    
    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('agent.sendMoney') }}">
        @csrf

        <div class="mb-3">
            <label for="client_contact" class="form-label">Contact du client</label>
            <input type="text" id="client_contact" name="client_contact" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="montant" class="form-label">Montant (FCFA)</label>
            <input type="number" id="montant" name="montant" class="form-control" min="1" required>
        </div>

        <button type="submit" class="btn btn-primary">Envoyer</button>
    </form>
</div>
</body>
</html>
