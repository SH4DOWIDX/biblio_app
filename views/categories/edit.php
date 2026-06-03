<!DOCTYPE html>
<html>
<head>
    <title>Modifier une catégorie</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="../../public/asset/css/categorie.css">
</head>
<body>
    <div class="container">
        <div class="form-card">
            <h1><i class="fas fa-edit"></i> Modifier la catégorie</h1>
            <form method="POST">
                <div class="form-group">
                    <label for="nom">Nom de la catégorie :</label>
                    <input type="text" id="nom" name="nom" value="<?= htmlspecialchars($categorie['nom']) ?>" required>
                </div>
                <button type="submit"><i class="fas fa-save"></i> Mettre à jour</button>
                <a href="index.php?controller=categorie&action=index" class="btn-cancel btn">Annuler</a>
            </form>
        </div>
    </div>
</body>
</html>