<!DOCTYPE html>
<html>
<head>
    <title>Nouvel emprunt</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="../../public/asset/css/emprunt.css">
</head>
<body>
    <div class="container">
        <div class="form-card">
            <h1><i class="fas fa-hand-holding-heart"></i> Nouvel emprunt</h1>
            <form method="POST">
                <label>Livre :</label>
                <select name="livre_id" required>
                    <option value="">Sélectionner un livre</option>
                    <?php foreach($livres as $livre): ?>
                        <option value="<?= $livre['id'] ?>">
                            <?= htmlspecialchars($livre['titre']) ?> - <?= htmlspecialchars($livre['auteur']) ?> (<?= $livre['nombre_exemplaire'] ?> ex.)
                        </option>
                    <?php endforeach; ?>
                </select>
                
                <label>Adhérent :</label>
                <select name="adherent_id" required>
                    <option value="">Sélectionner un adhérent</option>
                    <?php foreach($adherents as $adherent): ?>
                        <option value="<?= $adherent['id'] ?>">
                            <?= htmlspecialchars($adherent['nom']) ?> - <?= htmlspecialchars($adherent['email']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                
                <button type="submit"><i class="fas fa-save"></i> Enregistrer l'emprunt</button>
                <a href="index.php?controller=emprunt&action=index" class="btn-cancel">Annuler</a>
            </form>
        </div>
    </div>
</body>
</html>