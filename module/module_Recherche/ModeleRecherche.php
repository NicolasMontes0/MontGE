<?php
if (!defined('CONST_INCLUDE')){die('Accès direct interdit');}
require_once('./Connexion.php');

class ModeleRecherche extends Connexion{

	private $requestPrepare;
	private $request;
	private $arg;

	public function __construct(){
		parent::initConnexion();
		$this->arg = array();
	}

	public function rechercheParNom(){
		return null;
	}

}
?>