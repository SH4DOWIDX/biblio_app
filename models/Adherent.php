<?php
require_once 'config/Database.php';

class Adherent {
    private $conn;
    private $table = "adherents";
    
    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }
    
    public function create($nom, $adresse, $tel, $email, $date_insc) {
        $query = "INSERT INTO {$this->table} (nom, adresse, tel, email, date_insc) 
                VALUES (:nom, :adresse, :tel, :email, :date_insc)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':adresse', $adresse);
        $stmt->bindParam(':tel', $tel);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':date_insc', $date_insc);
        return $stmt->execute();
    }
    
    public function getAll() {
        $query = "SELECT * FROM {$this->table} ORDER BY id DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getOne($id) {
        $query = "SELECT * FROM {$this->table} WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    public function update($id, $nom, $adresse, $tel, $email, $date_insc) {
        $query = "UPDATE {$this->table} SET nom = :nom, adresse = :adresse, 
                  tel = :tel, email = :email, date_insc = :date_insc WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':adresse', $adresse);
        $stmt->bindParam(':tel', $tel);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':date_insc', $date_insc);
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