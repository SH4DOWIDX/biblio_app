<?php
// Router simple
$controller = isset($_GET['controller']) ? $_GET['controller'] : 'dashboard';
$action = isset($_GET['action']) ? $_GET['action'] : 'index';
$id = isset($_GET['id']) ? $_GET['id'] : null;

// Pour les emprunts
$livre_id = isset($_GET['livre_id']) ? $_GET['livre_id'] : null;
$adherent_id = isset($_GET['adherent_id']) ? $_GET['adherent_id'] : null;

// Charger le contrôleur approprié
switch($controller) {
    case 'dashboard':
    require_once 'controllers/DashboardController.php';
    $ctrl = new DashboardController();
    $ctrl->index();
    break;
        
    case 'categorie':
        // ✅ Vérifie le chemin - utilise require_once avec chemin complet
        if(file_exists('controllers/CategorieController.php')) {
            require_once 'controllers/CategorieController.php';
            $ctrl = new CategorieController();
            if ($action === 'index') $ctrl->index();
            elseif ($action === 'create') $ctrl->create();
            elseif ($action === 'edit') $ctrl->edit($id);
            elseif ($action === 'delete') $ctrl->delete($id);
        } else {
            die("Fichier controllers/CategorieController.php introuvable !");
        }
        break;
        
    case 'adherent':
        if(file_exists('controllers/AdherentController.php')) {
            require_once 'controllers/AdherentController.php';
            $ctrl = new AdherentController();
            if ($action === 'index') $ctrl->index();
            elseif ($action === 'create') $ctrl->create();
            elseif ($action === 'edit') $ctrl->edit($id);
            elseif ($action === 'delete') $ctrl->delete($id);
            elseif ($action === 'view') $ctrl->view($id);
        } else {
            die("Fichier controllers/AdherentController.php introuvable !");
        }
        break;
        
    case 'livre':
        if(file_exists('controllers/LivreController.php')) {
            require_once 'controllers/LivreController.php';
            $ctrl = new LivreController();
            if ($action === 'index') $ctrl->index();
            elseif ($action === 'create') $ctrl->create();
            elseif ($action === 'edit') $ctrl->edit($id);
            elseif ($action === 'delete') $ctrl->delete($id);
            elseif ($action === 'view') $ctrl->view($id);
        } else {
            die("Fichier controllers/LivreController.php introuvable !");
        }
        break;
        
    case 'emprunt':
        if(file_exists('controllers/EmpruntController.php')) {
            require_once 'controllers/EmpruntController.php';
            $ctrl = new EmpruntController();
            if ($action === 'index') $ctrl->index();
            elseif ($action === 'create') $ctrl->create();
            elseif ($action === 'edit') $ctrl->edit($id);
            elseif ($action === 'delete') $ctrl->delete($id);
            elseif ($action === 'retour') $ctrl->retour($livre_id, $adherent_id);
        } else {
            die("Fichier controllers/EmpruntController.php introuvable !");
        }
        break;
        
    default:
        include 'views/404.php';
        break;
}
?>