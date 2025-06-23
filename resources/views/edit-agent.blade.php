<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier un Agent - Mobile Money</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap + Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #0077b6, #00b4d8);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', sans-serif;
            color: #333;
        }

        .auth-card {
            background: #ffffff;
            border-radius: 20px;
            padding: 2rem 2.5rem;
            box-shadow: 0 10px 30px rgba(0,0,0,0.15);
            width: 100%;
            max-width: 550px;
        }

        .auth-card h3 {
            font-weight: bold;
            margin-bottom: 1rem;
            color: #0077b6;
        }

        .form-label {
            font-weight: 500;
        }

        .btn-primary {
            background-color: #00b4d8;
            border: none;
        }

        .btn-primary:hover {
            background-color: #0077b6;
        }

        .logo {
            font-size: 2.5rem;
            color: #00b4d8;
            text-align: center;
        }

        .form-control:focus {
            border-color: #00b4d8;
            box-shadow: 0 0 0 0.15rem rgba(0, 180, 216, 0.25);
        }
    </style>
</head>
<body>

<div class="auth-card">
    <div class="text-center">
        <div class="logo mb-2"><i class="bi bi-pencil-square"></i></div>
        <h3>Modifier l'Agent</h3>
        <p class="text-muted mb-4">Wave Mobile Money</p>
    </div>

    <form method="POST" action="{{ route('agent.update', $agent->id) }}">
        @csrf

        <div class="mb-3">
            <label for="nom" class="form-label">Nom</label>
            <input type="text" name="nom" id="nom" class="form-control" value="{{ $agent->user->nom }}" required>
        </div>

        <div class="mb-3">
            <label for="prenoms" class="form-label">Prénoms</label>
            <input type="text" name="prenoms" id="prenoms" class="form-control" value="{{ $agent->user->prenoms }}" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Adresse e-mail</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ $agent->user->email }}" required>
        </div>

        <div class="mb-3">
            <label for="contact" class="form-label">Contact</label>
            <input type="text" name="contact" id="contact" class="form-control" value="{{ $agent->user->contact }}" required>
        </div>

        <div class="mb-3">
            <label for="code" class="form-label">Code Agent</label>
            <input type="text" name="code" id="code" class="form-control" value="{{ $agent->code }}" required>
        </div>

        <div class="mb-3">
            <label for="solde" class="form-label">Solde (FCFA)</label>
        <input type="number" name="solde" id="solde" class="form-control" value="{{ $agent->solde }}" min="0" required>
</div>


        <button type="submit" class="btn btn-primary w-100 mt-2">Enregistrer les modifications</button>
    </form>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
