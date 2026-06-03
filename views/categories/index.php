<!DOCTYPE html>
<html>
<head>
    <title>Gestion des Catégories</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="../../public/asset/css/categorie.css">
</head>
<body>
    <div class="container">
        <div class="header">
            <h1><i class="fas fa-folder"></i> Gestion des Catégories</h1>
            <a href="index.php?controller=categorie&action=create" class="btn btn-add">
                <i class="fas fa-plus"></i> Nouvelle Catégorie
            </a>
            <a href="index.php" class="btn btn-back">
                <i class="fas fa-home"></i> Accueil
            </a>
        </div>
        
        <?php if(isset($_GET['success'])): ?>
            <div class="success">
                <i class="fas fa-check-circle"></i> <?= htmlspecialchars($_GET['success']) ?>
            </div>
        <?php endif; ?>
        
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom de la catégorie</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if(empty($categories)): ?>
                    <tr>
                        <td colspan="3" style="text-align: center;">Aucune catégorie trouvée</td>
                    </tr>
                <?php else: ?>
                    <?php foreach($categories as $categorie): ?>
                    <tr>
                        <td><?= $categorie['id'] ?></td>
                        <td><?= htmlspecialchars($categorie['nom']) ?></td>
                        <td class="actions">
                            <a href="index.php?controller=categorie&action=edit&id=<?= $categorie['id'] ?>" class="btn btn-edit">
                                <i class="fas fa-edit"></i> Modifier
                            </a>
                            <a href="index.php?controller=categorie&action=delete&id=<?= $categorie['id'] ?>" 
                               class="btn btn-delete" 
                               onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette catégorie ?')">
                                <i class="fas fa-trash"></i> Supprimer
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>