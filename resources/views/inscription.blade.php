<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Créer un compte - Mobile Money</title>
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

        .toggle-password {
            cursor: pointer;
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #888;
        }

        .input-group {
            position: relative;
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
        <div class="logo mb-2"><i class="bi bi-wallet2"></i></div>
        <h3>Créer un compte</h3>
        <p class="text-muted mb-4">Wave Mobile Money</p>
    </div>

    <form method="POST" action="/connexion">
        @csrf

        <div class="mb-3">
            <label for="nom" class="form-label">Nom</label>
            <input type="text" name="nom" id="nom" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="prenoms" class="form-label">Prénoms</label>
            <input type="text" name="prenoms" id="prenoms" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Adresse e-mail</label>
            <input type="email" name="email" id="email" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="contact" class="form-label">Contact</label>
            <input type="text" name="contact" id="contact" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Mot de passe</label>
            <div class="input-group">
                <input type="password" name="password" id="password" class="form-control" required>
                <span class="toggle-password" onclick="togglePassword('password', 'icon1')">
                    <i class="bi bi-eye-slash" id="icon1"></i>
                </span>
            </div>
        </div>

        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Confirmer le mot de passe</label>
            <div class="input-group">
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
                <span class="toggle-password" onclick="togglePassword('password_confirmation', 'icon2')">
                    <i class="bi bi-eye-slash" id="icon2"></i>
                </span>
            </div>
        </div>

        <button type="submit" class="btn btn-primary w-100 mt-2">S'inscrire</button>

        <div class="text-center mt-3">
            <small class="text-muted">Déjà un compte ? <a href="/connexion" class="text-decoration-none text-primary">Se connecter</a></small>
        </div>
    </form>
</div>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function togglePassword(inputId, iconId) {
        const input = document.getElementById(inputId);
        const icon = document.getElementById(iconId);
        if (input.type === "password") {
            input.type = "text";
            icon.classList.remove("bi-eye-slash");
            icon.classList.add("bi-eye");
        } else {
            input.type = "password";
            icon.classList.remove("bi-eye");
            icon.classList.add("bi-eye-slash");
        }
    }
</script>

</body>
</html>
