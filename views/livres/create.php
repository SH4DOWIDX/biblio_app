<!DOCTYPE html>
<html>
<head>
    <title>Ajouter un livre</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="../views/style.css">
    <style>
        .form-container {
            max-width: 600px;
            margin: 0 auto;
        }
        .form-card {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
    </style>
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
        <div class="form-container">
            <div class="form-card">
                <h2><i class="fas fa-plus"></i> Ajouter un livre</h2>
                <form method="POST">
                    <label>Titre :</label>
                    <input type="text" name="titre" required>
                    
                    <label>Auteur :</label>
                    <input type="text" name="auteur" required>
                    
                    <label>Année :</label>
                    <input type="number" name="annee_publication" required>
                    
                    <label>Exemplaires :</label>
                    <input type="number" name="nombre_exemplaire" value="1" required>
                    
                    <label>Catégorie :</label>
                    <select name="categorie_id" required>
                        <option value="">Choisir...</option>
                        <?php foreach($categories as $categorie): ?>
                            <option value="<?= $categorie['id'] ?>"><?= htmlspecialchars($categorie['nom']) ?></option>
                        <?php endforeach; ?>
                    </select>
                    
                    <button type="submit" class="btn btn-add">Enregistrer</button>
                    <a href="index.php?controller=livre&action=index" class="btn btn-back">Annuler</a>
                </form>
            </div>
        </div>
    </div>
</body>
</html>