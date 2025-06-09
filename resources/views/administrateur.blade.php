<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin - Mobile Money</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body { background-color: #f6f8fb; font-family: 'Segoe UI', sans-serif; }
        .sidebar { background-color: #0077b6; min-height: 100vh; padding-top: 1.5rem; color: white; }
        .sidebar a { color: #fff; text-decoration: none; display: block; padding: 12px 20px; border-radius: 8px; margin-bottom: 10px; transition: background 0.3s ease; }
        .sidebar a:hover, .sidebar a.active { background-color: #00b4d8; }
        .content { padding: 2rem; }
        .card-stat { border: none; border-radius: 15px; box-shadow: 0 6px 20px rgba(0,0,0,0.05); }
        .card-stat .icon { font-size: 2rem; color: #00b4d8; }
        .card-stat .stat-value { font-size: 28px; font-weight: bold; color: #0077b6; }
        .topbar { display: flex; justify-content: space-between; align-items: center; }
        .btn-logout { background-color: #dc3545; color: white; }
        .btn-logout:hover { background-color: #c82333; }
    </style>
</head>
<body>

<div class="row g-0">
    <!-- Sidebar -->
    <div class="col-md-3 col-lg-2 sidebar">
        <h4 class="text-center mb-4"><i class="bi bi-shield-lock"></i> Admin</h4>
        <a href="#" class="active"><i class="bi bi-house-door"></i> Tableau de bord</a>
        <a href="/liste-agents"><i class="bi bi-person-lines-fill"></i> Agents</a>
        <a href="/ajout/admin"><i class="bi bi-person-badge"></i> Administrateurs</a>
        <a href="#"><i class="bi bi-wallet2"></i> Comptes</a>
        <a href="/logout" class="mt-4 btn btn-logout"><i class="bi bi-box-arrow-right"></i> Déconnexion</a>
    </div>

    <!-- Content -->
    <div class="col-md-9 col-lg-10 content">
        <div class="topbar mb-4">
            <h2>
                Bienvenue, Administrateur {{ session('nom') ?? Auth::user()->nom }} {{ session('prenoms') ?? Auth::user()->prenoms }}
            </h2>
        </div>

        <!-- Statistiques -->
        <div class="row g-4">
            <div class="col-md-3">
                <div class="card card-stat p-4 d-flex flex-row align-items-center justify-content-between">
                    <div>
                        <div class="text-muted">Client</div>
                        <div class="stat-value">{{ $nbClient }}</div>
                    </div>
                    <div class="icon"><i class="bi bi-wallet2"></i></div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card card-stat p-4 d-flex flex-row align-items-center justify-content-between">
                    <div>
                        <div class="text-muted">Agents</div>
                        <div class="stat-value">{{ $nbAgents }}</div>
                    </div>
                    <div class="icon"><i class="bi bi-person-lines-fill"></i></div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card card-stat p-4 d-flex flex-row align-items-center justify-content-between">
                    <div>
                        <div class="text-muted">Administrateurs</div>
                        <div class="stat-value">{{ $nbAdmins }}</div>
                    </div>
                    <div class="icon"><i class="bi bi-person-badge"></i></div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card card-stat p-4 d-flex flex-row align-items-center justify-content-between">
                    <div>
                        <div class="text-muted">Transactions</div>
                        <div class="stat-value">{{ $nbTransactions }}</div>
                    </div>
                    <div class="icon"><i class="bi bi-cash-coin"></i></div>
                </div>
            </div>
        </div>

        <!-- Diagramme circulaire -->
        <div class="mt-5">
            <h4>Statistiques</h4>
            <div class="col-md-6 mx-auto">
                <canvas id="pieChart" height="300"></canvas>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const chartData = @json($dataChart);

    const ctx = document.getElementById('pieChart').getContext('2d');
    const pieChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: ['Comptes', 'Agents', 'Administrateurs','Transactions'],
            datasets: [{
                data: chartData,
                backgroundColor: ['#000000', '#808080', '#007bff', '#28a745'],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        color: '#333',
                        font: { size: 14 }
                    }
                }
            }
        }
    });
</script>

</body>
</html>
