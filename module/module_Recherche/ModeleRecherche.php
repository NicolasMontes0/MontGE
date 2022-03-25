<?php
require_once('./Connexion.php');

class ModeleRecherche extends Connexion{

	private $arg;

	public function __construct(){
		parent::initConnexion();
		$this->arg = array();
	}

	public function triDispo(){
        $request = 'SELECT DISTINCT idPC, nom, commentaire FROM PC WHERE disponible=true';
        $requestPrepare = self::$bdd->prepare($request);
        $requestPrepare->execute($this->arg);
        $result = $requestPrepare->fetchAll();
        for($i=0 ; $i<intval(count($result)) ; $i++) {
            $request = 'SELECT DISTINCT Application.nom FROM Application RIGHT JOIN PCApplication on Application.idApplication = PCApplication.idApplication RIGHT JOIN PC on PCApplication.idPC = PC.idPC WHERE PC.idPC = "'.$result[$i][0].'"';
            $requestPrepare = self::$bdd->prepare($request);
            $requestPrepare->execute($this->arg);
            $result[$i][3] = $requestPrepare->fetchAll();
        }
        for($i=0 ; $i<intval(count($result)) ; $i++) {
            $request = 'SELECT DISTINCT System.nom FROM System RIGHT JOIN PCSystem on System.idSystem = PCSystem.idSystem RIGHT JOIN PC on PCSystem.idPC = PC.idPC WHERE PC.idPC = "' . $result[$i][0] . '"';
            $requestPrepare = self::$bdd->prepare($request);
            $requestPrepare->execute($this->arg);
            $result[$i][4] = $requestPrepare->fetchAll();
        }
        return $result;
	}
}
?>
