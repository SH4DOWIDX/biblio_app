<?php
require_once 'config/Database.php';

class Categorie {
    private $conn;
    private $table = "categories";
    
    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }
    
    // CREATE
    public function create($nom) {
        $query = "INSERT INTO {$this->table} (nom) VALUES (:nom)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':nom', $nom);
        return $stmt->execute();
    }
    
    // READ (all)
    public function getAll() {
        $query = "SELECT * FROM {$this->table} ORDER BY id DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    // READ (one)
    public function getOne($id) {
        $query = "SELECT * FROM {$this->table} WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    // UPDATE
    public function update($id, $nom) {
        $query = "UPDATE {$this->table} SET nom = :nom WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':nom', $nom);
        return $stmt->execute();
    }
    
    // DELETE
    public function delete($id) {
        $query = "DELETE FROM {$this->table} WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
?>