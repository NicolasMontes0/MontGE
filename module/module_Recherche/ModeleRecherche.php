<?php
require_once('./Connexion.php');

class ModeleRecherche extends Connexion{

	private $arg;

	public function __construct(){
		parent::initConnexion();
		$this->arg = array();
	}

	public function triDispo(){
        $request = 'SELECT DISTINCT nom, commentaire FROM PC WHERE disponible=true';
        $requestPrepare = self::$bdd->prepare($request);
        $requestPrepare->execute($this->arg);
        $result = $requestPrepare->fetchAll();
        return $result;
	}
}
?>
