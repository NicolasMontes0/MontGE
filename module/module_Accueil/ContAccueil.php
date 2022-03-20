<?php
require_once('ModeleAccueil.php');
require_once('VueAccueil.php');

class ContAccueil {

    private $modele;
    private $vue;

    public function __construct(){
        $this->modele = new ModeleAccueil();
        $this->vue = new VueAccueil();
    }

    public function afficheAccueil() {
        $this->vue->afficheAccueil();
    }
}
?>