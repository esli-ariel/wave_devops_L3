<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion - Wave Mobile Money</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #00b4d8, #0077b6);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', sans-serif;
        }

        .card {
            border-radius: 20px;
            padding: 2rem;
            box-shadow: 0 10px 25px rgba(0,0,0,0.15);
            background-color: #ffffff;
        }

        .btn-wave {
            background-color: #00b4d8;
            border: none;
        }

        .btn-wave:hover {
            background-color: #0077b6;
        }

        .form-control:focus {
            border-color: #00b4d8;
            box-shadow: 0 0 0 0.2rem rgba(0,180,216,0.25);
        }

        .toggle-password {
            position: absolute;
            right: 1rem;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #aaa;
        }

        .input-group {
            position: relative;
        }

        .logo-icon {
            font-size: 3rem;
            color: #00b4d8;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card">
                <div class="text-center mb-4">
                    <i class="bi bi-wallet2 logo-icon"></i>
                    <h4 class="mt-2">Connexion à votre compte</h4>
                    <p class="text-muted">Wave Mobile Money</p>
                </div>

                @if(session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif

                <form method="POST" action="/login">
                    @csrf

                    <div class="mb-3">
                        <label for="contact" class="form-label">Contact</label>
                        <input type="text" name="contact" id="contact" class="form-control" placeholder="Ex: 0700000000" required>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Mot de passe</label>
                        <div class="input-group">
                            <input type="password" name="password" id="password" class="form-control" placeholder="••••••••" required>
                            <span class="toggle-password" onclick="togglePassword()">
                                <i class="bi bi-eye-slash" id="toggleIcon"></i>
                            </span>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-wave w-100 text-white mt-2">Se connecter</button>

                    <div class="text-center mt-3">
                        <small>Pas encore de compte ? <a href="/inscription" class="text-decoration-none text-primary">S’inscrire</a></small>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function togglePassword() {
        const passwordInput = document.getElementById("password");
        const toggleIcon = document.getElementById("toggleIcon");

        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            toggleIcon.classList.remove("bi-eye-slash");
            toggleIcon.classList.add("bi-eye");
        } else {
            passwordInput.type = "password";
            toggleIcon.classList.remove("bi-eye");
            toggleIcon.classList.add("bi-eye-slash");
        }
    }
</script>
</body>
</html>
