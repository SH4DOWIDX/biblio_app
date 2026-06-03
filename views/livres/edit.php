<!DOCTYPE html>
<html>
<head>
    <title>Modifier un livre</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: #f5f5f5; }
        .container { max-width: 600px; margin: 50px auto; padding: 20px; }
        .form-card { background: white; padding: 30px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        h1 { margin-bottom: 20px; color: #333; }
        label { display: block; margin-bottom: 8px; font-weight: bold; color: #555; }
        input, select { width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px; margin-bottom: 20px; font-size: 16px; }
        button { background: #2196F3; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer; margin-right: 10px; }
        .btn-cancel { background: #607D8B; text-decoration: none; display: inline-block; padding: 10px 20px; border-radius: 5px; color: white; }
    </style>
</head>
<body>
    <div class="container">
        <div class="form-card">
            <h1><i class="fas fa-edit"></i> Modifier le livre</h1>
            <form method="POST">
                <label>Titre :</label>
                <input type="text" name="titre" value="<?= htmlspecialchars($livre['titre']) ?>" required>
                
                <label>Auteur :</label>
                <input type="text" name="auteur" value="<?= htmlspecialchars($livre['auteur']) ?>" required>
                
                <label>Année de publication :</label>
                <input type="number" name="annee_publication" value="<?= $livre['annee_publication'] ?>" required>
                
                <label>Nombre d'exemplaires :</label>
                <input type="number" name="nombre_exemplaire" value="<?= $livre['nombre_exemplaire'] ?>" required>
                
                <label>Catégorie :</label>
                <select name="categorie_id" required>
                    <option value="">Sélectionner une catégorie</option>
                    <?php foreach($categories as $categorie): ?>
                        <option value="<?= $categorie['id'] ?>" <?= $categorie['id'] == $livre['categorie_id'] ? 'selected' : '' ?>>
                            <?= htmlspecialchars($categorie['nom']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                
                <button type="submit"><i class="fas fa-save"></i> Mettre à jour</button>
                <a href="index.php?controller=livre&action=index" class="btn-cancel">Annuler</a>
            </form>
        </div>
    </div>
</body>
</html>