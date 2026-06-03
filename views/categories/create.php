<!DOCTYPE html>
<html>
<head>
    <title>Ajouter une catégorie</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="../../public/asset/css/categorie.css">
</head>
<body>
    <div class="container">
        <div class="form-card">
            <h1><i class="fas fa-plus-circle"></i> Ajouter une catégorie</h1>
            <form method="POST">
                <div class="form-group">
                    <label for="nom">Nom de la catégorie :</label>
                    <input type="text" id="nom" name="nom" required placeholder="Ex: Roman, Science, Histoire...">
                </div>
                <button type="submit"><i class="fas fa-save"></i> Enregistrer</button>
                <a href="index.php?controller=categorie&action=index" class="btn-cancel btn">Annuler</a>
            </form>
        </div>
    </div>
</body>
</html>