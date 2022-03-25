<?php
require_once('ModeleRecherche.php');
require_once('VueRecherche.php');

class ContRecherche{

	private $modele;
	private $vue;

	public function __construct(){
		$this->modele = new ModeleRecherche();
		$this->vue = new VueRecherche();
	}

    public function triDispo(){
		$this->vue->afficheDispo($this->modele->triDispo());
    }

}
?>