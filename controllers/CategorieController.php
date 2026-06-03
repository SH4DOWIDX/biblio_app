<?php
require_once 'models/Categorie.php';

class CategorieController {
    private $categorie;
    
    public function __construct() {
        $this->categorie = new Categorie();
    }
    
    public function index() {
        $categories = $this->categorie->getAll();
        include 'views/categories/index.php';
    }
    
    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($this->categorie->create($_POST['nom'])) {
                header("Location: index.php?controller=categorie&action=index");
                exit();
            }
        }
        include 'views/categories/create.php';
    }
    
    public function edit($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($this->categorie->update($id, $_POST['nom'])) {
                header("Location: index.php?controller=categorie&action=index");
                exit();
            }
        }
        $categorie = $this->categorie->getOne($id);
        include 'views/categories/edit.php';
    }
    
    public function delete($id) {
        if ($this->categorie->delete($id)) {
            header("Location: index.php?controller=categorie&action=index");
            exit();
        }
    }
}
?>