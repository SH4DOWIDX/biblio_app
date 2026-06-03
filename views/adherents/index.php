<!DOCTYPE html>
<html>
<head>
    <title>Adhérents - Bibliothèque</title>
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
            <h1><i class="fas fa-users"></i> Nos adhérents</h1>
            <a href="index.php?controller=adherent&action=create" class="btn btn-add">
                <i class="fas fa-plus"></i> Nouvel adhérent
            </a>
        </div>
        
        <?php foreach($adherents as $adherent): ?>
        <div class="adherent-card">
            <div class="adherent-left">
                <div class="avatar">
                    <?= strtoupper(substr($adherent['nom'], 0, 1)) ?>
                </div>
                <div class="adherent-info">
                    <h3><?= htmlspecialchars($adherent['nom']) ?></h3>
                    <p><i class="fas fa-envelope"></i> <?= htmlspecialchars($adherent['email']) ?></p>
                    <p><i class="fas fa-phone"></i> <?= htmlspecialchars($adherent['tel']) ?></p>
                    <p><i class="fas fa-map-marker-alt"></i> <?= htmlspecialchars($adherent['adresse']) ?></p>
                </div>
            </div>
            <div>
                <span class="badge" style="background:#e9ecef; padding:5px 10px; border-radius:5px;">
                    <i class="far fa-calendar"></i> Inscrit le <?= $adherent['date_insc'] ?>
                </span>
                <div style="margin-top: 10px;">
                    <a href="index.php?controller=adherent&action=view&id=<?= $adherent['id'] ?>" class="btn btn-view">Voir</a>
                    <a href="index.php?controller=adherent&action=edit&id=<?= $adherent['id'] ?>" class="btn btn-edit">Modifier</a>
                    <a href="index.php?controller=adherent&action=delete&id=<?= $adherent['id'] ?>" class="btn btn-delete" onclick="return confirm('Supprimer ?')">Supprimer</a>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</body>
</html>