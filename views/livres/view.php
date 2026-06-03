<!DOCTYPE html>
<html>
<head>
    <title>Détails du livre</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: #f5f5f5; }
        .container { max-width: 800px; margin: 50px auto; padding: 20px; }
        .card { background: white; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); overflow: hidden; }
        .card-header { background: #FF9800; color: white; padding: 20px; }
        .card-body { padding: 30px; }
        .info-row { display: flex; padding: 10px 0; border-bottom: 1px solid #eee; }
        .info-label { font-weight: bold; width: 150px; color: #555; }
        .info-value { flex: 1; }
        .btn-back { background: #607D8B; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px; display: inline-block; margin-top: 20px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h1><i class="fas fa-book"></i> Détails du livre</h1>
            </div>
            <div class="card-body">
                <div class="info-row">
                    <div class="info-label">ID :</div>
                    <div class="info-value"><?= $livre['id'] ?></div>
                </div>
                <div class="info-row">
                    <div class="info-label">Titre :</div>
                    <div class="info-value"><?= htmlspecialchars($livre['titre']) ?></div>
                </div>
                <div class="info-row">
                    <div class="info-label">Auteur :</div>
                    <div class="info-value"><?= htmlspecialchars($livre['auteur']) ?></div>
                </div>
                <div class="info-row">
                    <div class="info-label">Année :</div>
                    <div class="info-value"><?= $livre['annee_publication'] ?></div>
                </div>
                <div class="info-row">
                    <div class="info-label">Exemplaires :</div>
                    <div class="info-value"><?= $livre['nombre_exemplaire'] ?></div>
                </div>
                <div class="info-row">
                    <div class="info-label">Catégorie :</div>
                    <div class="info-value"><?= htmlspecialchars($livre['categorie_nom']) ?></div>
                </div>
                <a href="index.php?controller=livre&action=index" class="btn-back">
                    <i class="fas fa-arrow-left"></i> Retour
                </a>
            </div>
        </div>
    </div>
</body>
</html>