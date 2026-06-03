<?php
session_start();

require_once 'models/Emprunt.php';
require_once 'models/Livre.php';
require_once 'models/Adherent.php';

class EmpruntController {
    private $emprunt;
    private $livre;
    private $adherent;
    
    public function __construct() {
        $this->emprunt = new Emprunt();
        $this->livre = new Livre();
        $this->adherent = new Adherent();
    }
    
    public function index() {
        $emprunts = $this->emprunt->getAll();
        include 'views/emprunts/index.php';
    }
    
    public function create() {
        $livres = $this->livre->getAll();
        $adherents = $this->adherent->getAll();
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $date_emprunt = date('Y-m-d');
            $statut = 'en cours';
            
            // Vérifier si l'emprunt existe déjà
            if($this->emprunt->existe($_POST['livre_id'], $_POST['adherent_id'])) {
                $_SESSION['error'] = "Cet adhérent a déjà emprunté ce livre !";
                header("Location: index.php?controller=emprunt&action=create");
                exit();
            }
            
            if ($this->emprunt->create(
                $_POST['livre_id'],
                $_POST['adherent_id'],
                $date_emprunt,
                $statut
            )) {
                header("Location: index.php?controller=emprunt&action=index");
                exit();
            } else {
                $error = $_SESSION['error'] ?? "Erreur lors de l'enregistrement";
                unset($_SESSION['error']);
            }
        }
        include 'views/emprunts/create.php';
    }
    
    public function edit($id) {
        $livre_id = isset($_GET['livre_id']) ? $_GET['livre_id'] : null;
        $adherent_id = isset($_GET['adherent_id']) ? $_GET['adherent_id'] : null;
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($this->emprunt->update(
                $livre_id,
                $adherent_id,
                $_POST['statut']
            )) {
                header("Location: index.php?controller=emprunt&action=index");
                exit();
            }
        }
        
        $emprunt = $this->emprunt->getOne($livre_id, $adherent_id);
        include 'views/emprunts/edit.php';
    }
    
    public function delete($id) {
        $livre_id = isset($_GET['livre_id']) ? $_GET['livre_id'] : null;
        $adherent_id = isset($_GET['adherent_id']) ? $_GET['adherent_id'] : null;
        
        if ($this->emprunt->delete($livre_id, $adherent_id)) {
            header("Location: index.php?controller=emprunt&action=index");
            exit();
        }
    }
    
    public function retour($livre_id, $adherent_id) {
        if ($this->emprunt->update($livre_id, $adherent_id, 'retourné')) {
            header("Location: index.php?controller=emprunt&action=index");
            exit();
        }
    }
}
?>