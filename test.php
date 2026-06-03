<?php
require_once 'config/Database.php';

$db = new Database();
$conn = $db->getConnection();

echo "<h2>Connexion réussie à la base de données !</h2>";

// Tester de quelque requête
$stmt = $conn->query("SELECT COUNT(*) as total FROM categories");
$result = $stmt->fetch(PDO::FETCH_ASSOC);
echo "<p>Nombre de catégories : " . $result['total'] . "</p>";

$stmt = $conn->query("SELECT COUNT(*) as total FROM livres");
$result = $stmt->fetch(PDO::FETCH_ASSOC);
echo "<p>Nombre de livres : " . $result['total'] . "</p>";

$stmt = $conn->query("SELECT COUNT(*) as total FROM adherents");
$result = $stmt->fetch(PDO::FETCH_ASSOC);
echo "<p>Nombre d'adhérents : " . $result['total'] . "</p>";

echo "<br><a href='index.php'>Accéder à l'application →</a>";
?>