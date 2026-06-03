<!DOCTYPE html>
<html>
<head>
    <title>Détails de l'adhérent</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="../../public/asset/css/adherent.css">
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h1><i class="fas fa-user"></i> Détails de l'adhérent</h1>
            </div>
            <div class="card-body">
                <div class="info-row">
                    <div class="info-label">ID :</div>
                    <div class="info-value"><?= $adherent['id'] ?></div>
                </div>
                <div class="info-row">
                    <div class="info-label">Nom :</div>
                    <div class="info-value"><?= htmlspecialchars($adherent['nom']) ?></div>
                </div>
                <div class="info-row">
                    <div class="info-label">Adresse :</div>
                    <div class="info-value"><?= htmlspecialchars($adherent['adresse']) ?></div>
                </div>
                <div class="info-row">
                    <div class="info-label">Téléphone :</div>
                    <div class="info-value"><?= htmlspecialchars($adherent['tel']) ?></div>
                </div>
                <div class="info-row">
                    <div class="info-label">Email :</div>
                    <div class="info-value"><?= htmlspecialchars($adherent['email']) ?></div>
                </div>
                <div class="info-row">
                    <div class="info-label">Date d'inscription :</div>
                    <div class="info-value"><?= $adherent['date_insc'] ?></div>
                </div>
                <a href="index.php?controller=adherent&action=index" class="btn-back">
                    <i class="fas fa-arrow-left"></i> Retour
                </a>
            </div>
        </div>
    </div>
</body>
</html>