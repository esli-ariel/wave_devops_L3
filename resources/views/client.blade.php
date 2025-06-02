<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Agent - Mobile Money</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background-color: #f6f8fb;
            font-family: 'Segoe UI', sans-serif;
        }

        .sidebar {
            background-color: #0077b6;
            min-height: 100vh;
            padding-top: 1.5rem;
            color: white;
        }

        .sidebar a {
            color: #fff;
            text-decoration: none;
            display: block;
            padding: 12px 20px;
            border-radius: 8px;
            margin-bottom: 10px;
            transition: background 0.3s ease;
        }

        .sidebar a:hover, .sidebar a.active {
            background-color: #00b4d8;
        }

        .content {
            padding: 2rem;
        }

        .card-stat {
            border: none;
            border-radius: 15px;
            box-shadow: 0 6px 20px rgba(0,0,0,0.05);
        }

        .card-stat .icon {
            font-size: 2rem;
            color: #00b4d8;
        }

        .card-stat .stat-value {
            font-size: 28px;
            font-weight: bold;
            color: #0077b6;
        }

        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .btn-logout {
            background-color: #dc3545;
            color: white;
        }

        .btn-logout:hover {
            background-color: #c82333;
        }

        .toggle-sold {
            cursor: pointer;
            color: #0077b6;
        }

        .table-container {
            margin-top: 3rem;
        }

        .table thead {
            background-color: #0077b6;
            color: white;
        }

        .table tbody tr:hover {
            background-color: #f1f1f1;
        }
    </style>
</head>
<body>

<div class="row g-0">
    <!-- Sidebar -->
    <div class="col-md-3 col-lg-2 sidebar">
        <h4 class="text-center mb-4"><i class="bi bi-person"></i> Client</h4>
        <a href="#" class="active"><i class="bi bi-house-door"></i> Tableau de bord</a>
        <a href="/depot"><i class="bi bi-arrow-down-circle"></i> Dépôt</a>
        <a href="/contact"><i class="bi bi-telephone"></i> Contact</a>
        <a href="/connexion" class="mt-4 btn btn-logout"><i class="bi bi-box-arrow-right"></i> Déconnexion</a>
    </div>

    <!-- Content -->
    <div class="col-md-9 col-lg-10 content">
        <div class="topbar mb-4">
            <h2>Bienvenue, Client</h2>
        </div>

        <!-- Statistiques -->
        <div class="row g-4">
            <div class="col-md-6">
                <div class="card card-stat p-4 d-flex flex-row align-items-center justify-content-between">
                    <div>
                        <div class="text-muted">Transactions</div>
                        <div class="stat-value">240</div>
                    </div>
                    <div class="icon"><i class="bi bi-cash-coin"></i></div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card card-stat p-4 d-flex flex-row align-items-center justify-content-between">
                    <div>
                        <div class="text-muted">Solde</div>
                        <div class="stat-value" id="solde">**** FCFA</div>
                        <div class="toggle-sold" onclick="toggleSolde()">Afficher/Masquer</div>
                    </div>
                    <div class="icon"><i class="bi bi-wallet2"></i></div>
                </div>
            </div>
        </div>

        <!-- Tableau des transactions -->
        <div class="table-container">
            <h4 class="mb-3">Liste des transactions</h4>
            <div class="table-responsive">
                <table class="table table-bordered align-middle">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Type</th>
                            <th scope="col">Montant</th>
                            <th scope="col">Date</th>
                            <th scope="col">Heure</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Dépôt</td>
                            <td>50 000 FCFA</td>
                            <td>01/06/2025</td>
                            <td>10:15</td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Retrait</td>
                            <td>20 000 FCFA</td>
                            <td>01/06/2025</td>
                            <td>12:30</td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>Dépôt</td>
                            <td>30 000 FCFA</td>
                            <td>31/05/2025</td>
                            <td>16:45</td>
                        </tr>
                        <!-- Ajoute d'autres lignes dynamiquement ici -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- JS -->
<script>
    let soldeVisible = false;
    function toggleSolde() {
        const solde = document.getElementById('solde');
        solde.innerText = soldeVisible ? '**** FCFA' : '850 000 FCFA';
        soldeVisible = !soldeVisible;
    }
</script>

</body>
</html>
