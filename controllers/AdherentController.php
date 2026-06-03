<?php
require_once 'models/Adherent.php';

class AdherentController {
    private $adherent;
    
    public function __construct() {
        $this->adherent = new Adherent();
    }
    
    // Afficher la liste des adhérents
    public function index() {
        $adherents = $this->adherent->getAll();
        include 'views/adherents/index.php';
    }
    
    // Afficher le formulaire d'ajout ou traiter l'ajout
    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $date_insc = date('Y-m-d'); // Date du jour
            if ($this->adherent->create(
                $_POST['nom'],
                $_POST['adresse'],
                $_POST['tel'],
                $_POST['email'],
                $date_insc
            )) {
                header("Location: index.php?controller=adherent&action=index&success=Ajouté avec succès");
                exit();
            } else {
                $error = "Erreur lors de l'ajout";
            }
        }
        include 'views/adherents/create.php';
    }
    
    // Afficher le formulaire de modification ou traiter la modification
    public function edit($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($this->adherent->update(
                $id,
                $_POST['nom'],
                $_POST['adresse'],
                $_POST['tel'],
                $_POST['email'],
                $_POST['date_insc']
            )) {
                header("Location: index.php?controller=adherent&action=index&success=Modifié avec succès");
                exit();
            }
        }
        $adherent = $this->adherent->getOne($id);
        include 'views/adherents/edit.php';
    }
    
    // Supprimer un adhérent
    public function delete($id) {
        if ($this->adherent->delete($id)) {
            header("Location: index.php?controller=adherent&action=index&success=Supprimé avec succès");
            exit();
        }
    }
    
    // Voir les détails d'un adhérent
    public function view($id) {
        $adherent = $this->adherent->getOne($id);
        include 'views/adherents/view.php';
    }
}
?>