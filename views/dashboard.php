<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Bibliothèque Central</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="../../public/asset/css/dashboard.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="logo">
            <i class="fas fa-book-open" style="font-size: 45px; color: #667eea;"></i>
            <h2>Bibliothèque<br><span style="font-size: 12px;">Central</span></h2>
        </div>
        
        <nav>
            <a href="index.php?controller=dashboard&action=index" class="nav-item active">
                <i class="fas fa-chart-line"></i>
                <span>Dashboard</span>
            </a>
            <a href="index.php?controller=livre&action=index" class="nav-item">
                <i class="fas fa-book"></i>
                <span>Livres</span>
            </a>
            <a href="index.php?controller=adherent&action=index" class="nav-item">
                <i class="fas fa-users"></i>
                <span>Adhérents</span>
            </a>
            <a href="index.php?controller=categorie&action=index" class="nav-item">
                <i class="fas fa-tags"></i>
                <span>Catégories</span>
            </a>
            <a href="index.php?controller=emprunt&action=index" class="nav-item">
                <i class="fas fa-exchange-alt"></i>
                <span>Emprunts</span>
            </a>
        </nav>
    </div>
    
    <!-- Main Content -->
    <div class="main-content">
        <div class="welcome-header">
            <h1>Tableau de bord</h1>
            <p>Bienvenue dans votre espace de gestion • <?= date('d/m/Y') ?></p>
        </div>
        
        <!-- Stats Cards -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-book"></i>
                </div>
                <div class="stat-number"><?= number_format($stats['total_livres']) ?></div>
                <div class="stat-label">Exemplaires disponibles</div>
                <div class="stat-change positive">
                    <i class="fas fa-arrow-up"></i> +12 ce mois
                </div>
            </div>
            
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-users"></i>
                </div>
                <div class="stat-number"><?= number_format($stats['total_adherents']) ?></div>
                <div class="stat-label">Adhérents inscrits</div>
                <div class="stat-change positive">
                    <i class="fas fa-arrow-up"></i> +5 ce mois
                </div>
            </div>
            
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-hand-holding-heart"></i>
                </div>
                <div class="stat-number"><?= $stats['emprunts_en_cours'] ?></div>
                <div class="stat-label">Emprunts en cours</div>
                <div class="stat-change <?= $stats['emprunts_en_retard'] > 0 ? 'negative' : 'positive' ?>">
                    <i class="fas fa-exclamation-triangle"></i> <?= $stats['emprunts_en_retard'] ?> en retard
                </div>
            </div>
            
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-chart-line"></i>
                </div>
                <div class="stat-number"><?= $stats['taux_retour'] ?>%</div>
                <div class="stat-label">Taux de retour</div>
                <div class="stat-change positive">
                    <i class="fas fa-arrow-up"></i> Excellent
                </div>
            </div>
        </div>
        
        <!-- Charts Row -->
        <div class="charts-row">
            <div class="chart-card">
                <div class="chart-title">
                    <i class="fas fa-chart-line" style="color: #667eea;"></i>
                    Évolution des emprunts (6 mois)
                </div>
                <canvas id="loansChart"></canvas>
            </div>
            
            <div class="chart-card">
                <div class="chart-title">
                    <i class="fas fa-chart-pie" style="color: #764ba2;"></i>
                    Répartition par catégorie
                </div>
                <canvas id="categoryChart"></canvas>
            </div>
        </div>
        
        <!-- Top Lists -->
        <div class="top-row">
            <div class="top-card">
                <div class="chart-title">
                    <i class="fas fa-trophy" style="color: #ff9800;"></i>
                    Top 5 des livres les plus empruntés
                </div>
                <?php $i = 1; foreach($top_livres as $livre): ?>
                <div class="top-item">
                    <div class="top-rank">#<?= $i++ ?></div>
                    <div class="top-info">
                        <div class="top-name"><?= htmlspecialchars($livre['titre']) ?></div>
                        <div class="top-meta"><?= htmlspecialchars($livre['auteur']) ?></div>
                    </div>
                    <div class="top-count"><?= $livre['nombre_emprunts'] ?> emprunts</div>
                </div>
                <?php endforeach; ?>
                <?php if(empty($top_livres)): ?>
                <div class="top-item">Aucune donnée disponible</div>
                <?php endif; ?>
            </div>
            
            <div class="top-card">
                <div class="chart-title">
                    <i class="fas fa-star" style="color: #ff9800;"></i>
                    Top 5 des adhérents les plus actifs
                </div>
                <?php $i = 1; foreach($top_adherents as $adherent): ?>
                <div class="top-item">
                    <div class="top-rank">#<?= $i++ ?></div>
                    <div class="top-info">
                        <div class="top-name"><?= htmlspecialchars($adherent['nom']) ?></div>
                        <div class="top-meta"><?= htmlspecialchars($adherent['email']) ?></div>
                    </div>
                    <div class="top-count"><?= $adherent['nombre_emprunts'] ?> emprunts</div>
                </div>
                <?php endforeach; ?>
                <?php if(empty($top_adherents)): ?>
                <div class="top-item">Aucune donnée disponible</div>
                <?php endif; ?>
            </div>
        </div>
        
        <!-- Recent Loans -->
        <div class="recent-card">
            <div class="chart-title">
                <i class="fas fa-history"></i>
                Derniers emprunts
            </div>
            <?php foreach($derniers_emprunts as $emprunt): ?>
            <div class="loan-item">
                <div class="loan-info">
                    <h4><?= htmlspecialchars($emprunt['livre_titre']) ?></h4>
                    <p><i class="fas fa-user"></i> <?= htmlspecialchars($emprunt['adherent_nom']) ?> • <i class="fas fa-calendar"></i> <?= $emprunt['date_emprunt'] ?></p>
                </div>
                <span class="status <?= $emprunt['statut'] == 'en cours' ? 'en-cours' : 'retourne' ?>">
                    <?= $emprunt['statut'] ?>
                </span>
            </div>
            <?php endforeach; ?>
            <?php if(empty($derniers_emprunts)): ?>
            <div class="loan-item">Aucun emprunt récent</div>
            <?php endif; ?>
        </div>
    </div>
    
    <!-- <script src="../public/asset/js/app.js"></script> -->
    <script>            
        // Graphique des emprunts par mois
        const moisData = <?= json_encode($emprunts_par_mois) ?>;
        const ctx1 = document.getElementById('loansChart').getContext('2d');
        new Chart(ctx1, {
            type: 'line',
            data: {
                labels: moisData.map(item => item.mois),
                datasets: [{
                    label: 'Nombre d\'emprunts',
                    data: moisData.map(item => item.total),
                    borderColor: '#667eea',
                    backgroundColor: 'rgba(102, 126, 234, 0.1)',
                    borderWidth: 3,
                    pointBackgroundColor: '#764ba2',
                    pointBorderColor: '#fff',
                    pointRadius: 5,
                    pointHoverRadius: 7,
                    tension: 0.3,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                plugins: {
                    legend: {
                        labels: { color: '#fff' }
                    }
                },
                scales: {
                    y: {
                        grid: { color: 'rgba(255,255,255,0.1)' },
                        ticks: { color: '#fff' }
                    },
                    x: {
                        grid: { color: 'rgba(255,255,255,0.1)' },
                        ticks: { color: '#fff' }
                    }
                }
            }
        });

        // Graphique des catégories
        const categorieData = <?= json_encode($livres_par_categorie) ?>;
        const ctx2 = document.getElementById('categoryChart').getContext('2d');
        new Chart(ctx2, {
            type: 'doughnut',
            data: {
                labels: categorieData.map(item => item.nom),
                datasets: [{
                    data: categorieData.map(item => item.total),
                    backgroundColor: [
                        '#667eea', '#764ba2', '#f093fb', '#4facfe', '#43e97b', '#fa709a'
                    ],
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: { color: '#fff', font: { size: 11 } }
                    }
                }
            }
        });
    </script>
</body>
</html>