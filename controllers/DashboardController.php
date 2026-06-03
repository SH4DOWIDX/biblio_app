<?php
require_once 'models/Statistique.php';

class DashboardController {
    private $stat;
    
    public function __construct() {
        $this->stat = new Statistique();
    }
    
    public function index() {
        // Récupérer toutes les stats
        $stats = [
            'total_livres' => $this->stat->getTotalLivres(),
            'total_adherents' => $this->stat->getTotalAdherents(),
            'emprunts_en_cours' => $this->stat->getEmpruntsEnCours(),
            'emprunts_en_retard' => $this->stat->getEmpruntsEnRetard(),
            'total_categories' => $this->stat->getTotalCategories(),
            'taux_retour' => $this->stat->getTauxRetour()
        ];
        
        $top_livres = $this->stat->getTopLivres();
        $top_adherents = $this->stat->getTopAdherents();
        $emprunts_par_mois = $this->stat->getEmpruntsParMois();
        $livres_par_categorie = $this->stat->getLivresParCategorie();
        $derniers_emprunts = $this->stat->getDerniersEmprunts(5);
        
        // Inclure la vue
        include 'views/dashboard.php';
    }
}
?>