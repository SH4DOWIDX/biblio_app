<!DOCTYPE html>
<html>
<head>
    <title>Ajouter un adhérent</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="../../public/asset/css/adherent.css">
</head>
<body>
    <div class="container">
        <div class="form-card">
            <h1><i class="fas fa-user-plus"></i> Ajouter un adhérent</h1>
            <form method="POST">
                <label>Nom complet :</label>
                <input type="text" name="nom" required>
                
                <label>Adresse :</label>
                <textarea name="adresse" rows="2"></textarea>
                
                <label>Téléphone :</label>
                <input type="tel" name="tel">
                
                <label>Email :</label>
                <input type="email" name="email" required>
                
                <button type="submit"><i class="fas fa-save"></i> Enregistrer</button>
                <a href="index.php?controller=adherent&action=index" class="btn-cancel">Annuler</a>
            </form>
        </div>
    </div>
</body>
</html>