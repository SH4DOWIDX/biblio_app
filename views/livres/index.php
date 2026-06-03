<!DOCTYPE html>
<html>
<head>
    <title>Livres - Bibliothèque</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="../views/style.css">
    <style>
        .books-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }
        
        .book-card {
            background: white;
            border-radius: 10px;
            padding: 15px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        
        .book-title {
            font-size: 18px;
            font-weight: bold;
            margin: 10px 0;
        }
        
        .book-author {
            color: #666;
            margin-bottom: 10px;
        }
        
        .book-meta {
            display: flex;
            justify-content: space-between;
            margin: 10px 0;
            font-size: 14px;
        }
        
        .category {
            background: #e9ecef;
            padding: 3px 8px;
            border-radius: 3px;
        }
        
        .actions {
            margin-top: 15px;
            display: flex;
            gap: 5px;
        }
        
        .search-bar {
            margin-bottom: 20px;
        }
        
        .search-bar input {
            width: 300px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
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
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <h1><i class="fas fa-book"></i> Catalogue des livres</h1>
            <a href="index.php?controller=livre&action=create" class="btn btn-add">
                <i class="fas fa-plus"></i> Nouveau livre
            </a>
        </div>
        
        <div class="search-bar">
            <input type="text" id="search" placeholder="🔍 Rechercher un livre..." onkeyup="searchBooks()">
        </div>
        
        <div class="books-grid" id="booksGrid">
            <?php foreach($livres as $livre): ?>
            <div class="book-card">
                <i class="fas fa-book" style="font-size: 30px; color: #1a1a2e;"></i>
                <div class="book-title"><?= htmlspecialchars($livre['titre']) ?></div>
                <div class="book-author">par <?= htmlspecialchars($livre['auteur']) ?></div>
                <div class="book-meta">
                    <span><i class="far fa-calendar"></i> <?= $livre['annee_publication'] ?></span>
                    <span class="category"><?= htmlspecialchars($livre['categorie_nom']) ?></span>
                </div>
                <div class="book-meta">
                    <span><i class="fas fa-copy"></i> <?= $livre['nombre_exemplaire'] ?> exemplaires</span>
                </div>
                <div class="actions">
                    <a href="index.php?controller=livre&action=view&id=<?= $livre['id'] ?>" class="btn btn-view">Voir</a>
                    <a href="index.php?controller=livre&action=edit&id=<?= $livre['id'] ?>" class="btn btn-edit">Modifier</a>
                    <a href="index.php?controller=livre&action=delete&id=<?= $livre['id'] ?>" class="btn btn-delete" onclick="return confirm('Supprimer ?')">Supprimer</a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
    
    <script>
        function searchBooks() {
            let input = document.getElementById('search').value.toLowerCase();
            let cards = document.querySelectorAll('.book-card');
            cards.forEach(card => {
                let title = card.querySelector('.book-title').innerText.toLowerCase();
                let author = card.querySelector('.book-author').innerText.toLowerCase();
                card.style.display = title.includes(input) || author.includes(input) ? 'block' : 'none';
            });
        }
    </script>
</body>
</html>