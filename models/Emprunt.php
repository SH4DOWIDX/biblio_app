<?php
require_once 'config/Database.php';

class Emprunt {
    private $conn;
    private $table = "emprunts";
    
    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }
    
    // CREATE avec vérification d'existence
    public function create($livre_id, $adherent_id, $date_emprunt, $statut) {
        // Vérifier si l'emprunt existe déjà
        $checkQuery = "SELECT COUNT(*) as count FROM {$this->table} 
                       WHERE livre_id = :livre_id AND adherent_id = :adherent_id";
        $checkStmt = $this->conn->prepare($checkQuery);
        $checkStmt->bindParam(':livre_id', $livre_id);
        $checkStmt->bindParam(':adherent_id', $adherent_id);
        $checkStmt->execute();
        $result = $checkStmt->fetch(PDO::FETCH_ASSOC);
        
        if($result['count'] > 0) {
            // L'emprunt existe déjà, on retourne false avec un message
            $_SESSION['error'] = "Cet adhérent a déjà emprunté ce livre !";
            return false;
        }
        
        // Vérifier si le livre a des exemplaires disponibles
        $livreQuery = "SELECT nombre_exemplaire FROM livres WHERE id = :livre_id";
        $livreStmt = $this->conn->prepare($livreQuery);
        $livreStmt->bindParam(':livre_id', $livre_id);
        $livreStmt->execute();
        $livre = $livreStmt->fetch(PDO::FETCH_ASSOC);
        
        // Compter les emprunts en cours pour ce livre
        $empruntQuery = "SELECT COUNT(*) as count FROM {$this->table} 
                        WHERE livre_id = :livre_id AND statut = 'en cours'";
        $empruntStmt = $this->conn->prepare($empruntQuery);
        $empruntStmt->bindParam(':livre_id', $livre_id);
        $empruntStmt->execute();
        $empruntsEnCours = $empruntStmt->fetch(PDO::FETCH_ASSOC);
        
        if($empruntsEnCours['count'] >= $livre['nombre_exemplaire']) {
            $_SESSION['error'] = "Plus d'exemplaires disponibles pour ce livre !";
            return false;
        }
        
        // Créer l'emprunt
        $query = "INSERT INTO {$this->table} (livre_id, adherent_id, date_emprunt, statut) 
                  VALUES (:livre_id, :adherent_id, :date_emprunt, :statut)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':livre_id', $livre_id);
        $stmt->bindParam(':adherent_id', $adherent_id);
        $stmt->bindParam(':date_emprunt', $date_emprunt);
        $stmt->bindParam(':statut', $statut);
        
        if($stmt->execute()) {
            $_SESSION['success'] = "Emprunt enregistré avec succès !";
            return true;
        }
        
        return false;
    }
    
    public function getAll() {
        $query = "SELECT e.*, l.titre as livre_titre, a.nom as adherent_nom 
                  FROM {$this->table} e 
                  LEFT JOIN livres l ON e.livre_id = l.id 
                  LEFT JOIN adherents a ON e.adherent_id = a.id 
                  ORDER BY e.date_emprunt DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getOne($livre_id, $adherent_id) {
        $query = "SELECT e.*, l.titre as livre_titre, a.nom as adherent_nom 
                  FROM {$this->table} e 
                  LEFT JOIN livres l ON e.livre_id = l.id 
                  LEFT JOIN adherents a ON e.adherent_id = a.id 
                  WHERE e.livre_id = :livre_id AND e.adherent_id = :adherent_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':livre_id', $livre_id);
        $stmt->bindParam(':adherent_id', $adherent_id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    public function update($livre_id, $adherent_id, $statut) {
        $query = "UPDATE {$this->table} SET statut = :statut 
                  WHERE livre_id = :livre_id AND adherent_id = :adherent_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':livre_id', $livre_id);
        $stmt->bindParam(':adherent_id', $adherent_id);
        $stmt->bindParam(':statut', $statut);
        return $stmt->execute();
    }
    
    public function delete($livre_id, $adherent_id) {
        $query = "DELETE FROM {$this->table} WHERE livre_id = :livre_id AND adherent_id = :adherent_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':livre_id', $livre_id);
        $stmt->bindParam(':adherent_id', $adherent_id);
        return $stmt->execute();
    }
    
    // Vérifier si un emprunt existe
    public function existe($livre_id, $adherent_id) {
        $query = "SELECT COUNT(*) as count FROM {$this->table} 
                  WHERE livre_id = :livre_id AND adherent_id = :adherent_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':livre_id', $livre_id);
        $stmt->bindParam(':adherent_id', $adherent_id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['count'] > 0;
    }
}
?>