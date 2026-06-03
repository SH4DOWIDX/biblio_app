<!DOCTYPE html>
<html>
<head>
    <title>Modifier un adhérent</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="../../public/asset/css/adherent.css">
</head>
<body>
    <div class="container">
        <div class="form-card">
            <h1><i class="fas fa-edit"></i> Modifier l'adhérent</h1>
            <form method="POST">
                <label>Nom complet :</label>
                <input type="text" name="nom" value="<?= htmlspecialchars($adherent['nom']) ?>">
                
                <label>Adresse :</label>
                <textarea name="adresse" rows="2"><?= htmlspecialchars($adherent['adresse']) ?></textarea>
                
                <label>Téléphone :</label>
                <input type="tel" name="tel" value="<?= htmlspecialchars($adherent['tel']) ?>">
                
                <label>Email :</label>
                <input type="email" name="email" value="<?= htmlspecialchars($adherent['email']) ?>">
                
                <label>Date d'inscription :</label>
                <input type="date" name="date_insc" value="<?= $adherent['date_insc'] ?>">
                
                <button type="submit"><i class="fas fa-save"></i> Mettre à jour</button>
                <a href="index.php?controller=adherent&action=index" class="btn-cancel">Annuler</a>
            </form>
        </div>
    </div>
</body>
</html>