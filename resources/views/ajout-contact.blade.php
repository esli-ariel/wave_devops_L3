<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Formulaire Ajout Contact</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background-color: #f6f8fb;
            font-family: 'Segoe UI', sans-serif;
        }

        .card-form {
            border: none;
            border-radius: 15px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.05);
            padding: 2rem;
            background-color: #fff;
        }

        .btn-primary {
            background-color: #0077b6;
            border: none;
        }

        .btn-primary:hover {
            background-color: #005f87;
        }

        @media (max-width: 576px) {
            .card-form {
                padding: 1.5rem;
            }
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card-form">
                <h4 class="mb-4 text-center"><i class="bi bi-person-plus-fill"></i> Ajouter un Contact</h4>

                <form id="contactForm">
                    <div class="mb-3">
                        <label for="nom" class="form-label">Nom </label>
                        <input type="text" class="form-control" id="nom" placeholder="Ex : Jean Dupont" required>
                    </div>
                    <div class="mb-4">
                        <label for="contact" class="form-label">Numéro de téléphone</label>
                        <input type="text" class="form-control" id="contact" placeholder="Ex : 0700000000" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="bi bi-check-circle me-1"></i> Enregistrer le contact
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
