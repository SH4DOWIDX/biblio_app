<?php
require_once 'config/Database.php';

class Statistique {
    private $conn;
    
    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }
    
    // Nombre total de livres
    public function getTotalLivres() {
        $query = "SELECT SUM(nombre_exemplaire) as total FROM livres";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'] ?? 0;
    }
    
    // Nombre total d'adhérents
    public function getTotalAdherents() {
        $query = "SELECT COUNT(*) as total FROM adherents";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'] ?? 0;
    }
    
    // Emprunts en cours
    public function getEmpruntsEnCours() {
        $query = "SELECT COUNT(*) as total FROM emprunts WHERE statut = 'en cours'";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'] ?? 0;
    }
    
    // Emprunts en retard (plus de 14 jours)
    public function getEmpruntsEnRetard() {
        $query = "SELECT COUNT(*) as total FROM emprunts 
                  WHERE statut = 'en cours' 
                  AND date_emprunt < DATE_SUB(CURDATE(), INTERVAL 14 DAY)";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'] ?? 0;
    }
    
    // Nombre de catégories
    public function getTotalCategories() {
        $query = "SELECT COUNT(*) as total FROM categories";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'] ?? 0;
    }
    
    // Top 5 des livres les plus empruntés
    public function getTopLivres() {
        $query = "SELECT l.titre, l.auteur, COUNT(e.livre_id) as nombre_emprunts
                  FROM livres l
                  LEFT JOIN emprunts e ON l.id = e.livre_id
                  GROUP BY l.id
                  ORDER BY nombre_emprunts DESC
                  LIMIT 5";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    // Top 5 des adhérents les plus actifs
    public function getTopAdherents() {
        $query = "SELECT a.nom, a.email, COUNT(e.adherent_id) as nombre_emprunts
                  FROM adherents a
                  LEFT JOIN emprunts e ON a.id = e.adherent_id
                  GROUP BY a.id
                  ORDER BY nombre_emprunts DESC
                  LIMIT 5";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    // Emprunts par mois (pour le graphique)
    public function getEmpruntsParMois() {
        $query = "SELECT 
                    DATE_FORMAT(date_emprunt, '%Y-%m') as mois,
                    COUNT(*) as total
                  FROM emprunts
                  WHERE date_emprunt >= DATE_SUB(CURDATE(), INTERVAL 6 MONTH)
                  GROUP BY DATE_FORMAT(date_emprunt, '%Y-%m')
                  ORDER BY mois ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    // Répartition des livres par catégorie
    public function getLivresParCategorie() {
        $query = "SELECT c.nom, COUNT(l.id) as total
                  FROM categories c
                  LEFT JOIN livres l ON c.id = l.categorie_id
                  GROUP BY c.id
                  ORDER BY total DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    // Derniers emprunts
    public function getDerniersEmprunts($limit = 5) {
        $query = "SELECT e.*, l.titre as livre_titre, a.nom as adherent_nom
                  FROM emprunts e
                  JOIN livres l ON e.livre_id = l.id
                  JOIN adherents a ON e.adherent_id = a.id
                  ORDER BY e.date_emprunt DESC
                  LIMIT :limit";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    // Taux de retour (pourcentage)
    public function getTauxRetour() {
        $query = "SELECT 
                    SUM(CASE WHEN statut = 'retourné' THEN 1 ELSE 0 END) as retournes,
                    COUNT(*) as total
                  FROM emprunts";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if($result['total'] > 0) {
            return round(($result['retournes'] / $result['total']) * 100);
        }
        return 0;
    }
}
?>