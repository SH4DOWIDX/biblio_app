<!DOCTYPE html>
<html>
<head>
    <title>Emprunts - Bibliothèque</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="../views/style.css">
</head>
<body>
    <div class="sidebar">
        <div class="logo"><h2><i class="fas fa-book"></i> BiblioTech</h2></div>
        <a href="index.php?controller=dashboard&action=index" class="nav-item"><i class="fas fa-home"></i> Dashboard</a>
        <a href="index.php?controller=livre&action=index" class="nav-item"><i class="fas fa-book"></i> Livres</a>
        <a href="index.php?controller=adherent&action=index" class="nav-item"><i class="fas fa-users"></i> Adhérents</a>
        <a href="index.php?controller=categorie&action=index" class="nav-item"><i class="fas fa-tags"></i> Catégories</a>
        <a href="index.php?controller=emprunt&action=index" class="nav-item"><i class="fas fa-exchange-alt"></i> Emprunts</a>
    </div>
    
    <div class="main-content">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <h1><i class="fas fa-exchange-alt"></i> Gestion des emprunts</h1>
            <a href="index.php?controller=emprunt&action=create" class="btn btn-add">
                <i class="fas fa-plus"></i> Nouvel emprunt
            </a>
        </div>
        
        <?php foreach($emprunts as $emprunt): ?>
        <div class="emprunt-row">
            <div>
                <h3><?= htmlspecialchars($emprunt['livre_titre']) ?></h3>
                <p><i class="fas fa-user"></i> <?= htmlspecialchars($emprunt['adherent_nom']) ?></p>
                <p><i class="fas fa-calendar"></i> Emprunté le : <?= $emprunt['date_emprunt'] ?></p>
            </div>
            <div style="text-align: right;">
                <span class="status status-<?= $emprunt['statut'] == 'en cours' ? 'en-cours' : 'retourne' ?>">
                    <?= $emprunt['statut'] ?>
                </span>
                <div style="margin-top: 10px;">
                    <?php if($emprunt['statut'] == 'en cours'): ?>
                        <a href="index.php?controller=emprunt&action=retour&livre_id=<?= $emprunt['livre_id'] ?>&adherent_id=<?= $emprunt['adherent_id'] ?>" 
                           class="btn btn-view" onclick="return confirm('Retourner ce livre ?')">
                            <i class="fas fa-undo"></i> Retour
                        </a>
                    <?php endif; ?>
                    <a href="index.php?controller=emprunt&action=delete&livre_id=<?= $emprunt['livre_id'] ?>&adherent_id=<?= $emprunt['adherent_id'] ?>" 
                       class="btn btn-delete" onclick="return confirm('Supprimer ?')">
                        <i class="fas fa-trash"></i>
                    </a>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</body>
</html>