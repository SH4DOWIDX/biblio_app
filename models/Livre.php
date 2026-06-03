<?php
require_once 'config/Database.php';

class Livre {
    private $conn;
    private $table = "livres";
    
    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }
    
    public function create($titre, $auteur, $annee_publication, $nombre_exemplaire, $categorie_id) {
        $query = "INSERT INTO {$this->table} (titre, auteur, annee_publication, nombre_exemplaire, categorie_id) 
                  VALUES (:titre, :auteur, :annee_publication, :nombre_exemplaire, :categorie_id)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':titre', $titre);
        $stmt->bindParam(':auteur', $auteur);
        $stmt->bindParam(':annee_publication', $annee_publication);
        $stmt->bindParam(':nombre_exemplaire', $nombre_exemplaire);
        $stmt->bindParam(':categorie_id', $categorie_id);
        return $stmt->execute();
    }
    
    public function getAll() {
        $query = "SELECT l.*, c.nom as categorie_nom 
                  FROM {$this->table} l 
                  LEFT JOIN categories c ON l.categorie_id = c.id 
                  ORDER BY l.id DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getOne($id) {
        $query = "SELECT l.*, c.nom as categorie_nom 
                  FROM {$this->table} l 
                  LEFT JOIN categories c ON l.categorie_id = c.id 
                  WHERE l.id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    public function update($id, $titre, $auteur, $annee_publication, $nombre_exemplaire, $categorie_id) {
        $query = "UPDATE {$this->table} SET titre = :titre, auteur = :auteur, 
                  annee_publication = :annee_publication, nombre_exemplaire = :nombre_exemplaire, 
                  categorie_id = :categorie_id WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':titre', $titre);
        $stmt->bindParam(':auteur', $auteur);
        $stmt->bindParam(':annee_publication', $annee_publication);
        $stmt->bindParam(':nombre_exemplaire', $nombre_exemplaire);
        $stmt->bindParam(':categorie_id', $categorie_id);
        return $stmt->execute();
    }
    
    public function delete($id) {
        $query = "DELETE FROM {$this->table} WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
?>