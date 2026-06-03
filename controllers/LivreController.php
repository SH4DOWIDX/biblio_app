<?php
require_once 'models/Livre.php';
require_once 'models/Categorie.php';

class LivreController {
    private $livre;
    private $categorie;
    
    public function __construct() {
        $this->livre = new Livre();
        $this->categorie = new Categorie();
    }
    
    // Afficher la liste des livres
    public function index() {
        $livres = $this->livre->getAll();
        include 'views/livres/index.php';
    }
    
    // Afficher le formulaire d'ajout ou traiter l'ajout
    public function create() {
        $categories = $this->categorie->getAll(); // Pour le select des catégories
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($this->livre->create(
                $_POST['titre'],
                $_POST['auteur'],
                $_POST['annee_publication'],
                $_POST['nombre_exemplaire'],
                $_POST['categorie_id']
            )) {
                header("Location: index.php?controller=livre&action=index&success=Ajouté avec succès");
                exit();
            } else {
                $error = "Erreur lors de l'ajout";
            }
        }
        include 'views/livres/create.php';
    }
    
    // Afficher le formulaire de modification ou traiter la modification
    public function edit($id) {
        $categories = $this->categorie->getAll();
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($this->livre->update(
                $id,
                $_POST['titre'],
                $_POST['auteur'],
                $_POST['annee_publication'],
                $_POST['nombre_exemplaire'],
                $_POST['categorie_id']
            )) {
                header("Location: index.php?controller=livre&action=index&success=Modifié avec succès");
                exit();
            }
        }
        $livre = $this->livre->getOne($id);
        include 'views/livres/edit.php';
    }
    
    // Supprimer un livre
    public function delete($id) {
        if ($this->livre->delete($id)) {
            header("Location: index.php?controller=livre&action=index&success=Supprimé avec succès");
            exit();
        }
    }
    
    // Voir les détails d'un livre
    public function view($id) {
        $livre = $this->livre->getOne($id);
        include 'views/livres/view.php';
    }
    
    // Rechercher des livres
    public function search() {
        // À implémenter si besoin
        $livres = $this->livre->getAll();
        include 'views/livres/index.php';
    }
}
?>