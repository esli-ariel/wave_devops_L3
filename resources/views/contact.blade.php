<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des Contacts</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background-color: #f6f8fb;
            font-family: 'Segoe UI', sans-serif;
        }

        .card-table {
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

        table th, table td {
            vertical-align: middle;
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <div class="card-table">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4><i class="bi bi-telephone-fill me-2"></i> Liste des Contacts</h4>
            <a href="/ajout-contact" class="btn btn-primary">
                <i class="bi bi-plus-circle me-1"></i> Ajouter un contact
            </a>
        </div>

        <!-- Tableau des contacts -->
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Nom</th>
                        <th>Contact</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Exemple de contact -->
                    <tr>
                        <td>1</td>
                        <td>Jean Dupont</td>
                        <td>0700000000</td>
                        <td>
                            <button class="btn btn-sm btn-warning me-1">
                                <i class="bi bi-pencil"></i>
                            </button>
                            <button class="btn btn-sm btn-danger">
                                <i class="bi bi-trash"></i>
                            </button>
                        </td>
                    </tr>
                    <!-- D'autres lignes peuvent être ajoutées dynamiquement -->
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
