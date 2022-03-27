<?php
require_once('./Connexion.php');

class ModeleRecherche extends Connexion{


	public function __construct(){
		parent::initConnexion();
	}

	public function triDispo(){
        $request = 'SELECT DISTINCT idPC, nom, commentaire FROM PC WHERE disponible=true';
        $requestPrepare = self::$bdd->prepare($request);
        $requestPrepare->execute();
        $result = $requestPrepare->fetchAll();
        for($i=0 ; $i<intval(count($result)) ; $i++) {
            $request = 'SELECT DISTINCT Application.nom FROM Application RIGHT JOIN PCApplication on Application.idApplication = PCApplication.idApplication RIGHT JOIN PC on PCApplication.idPC = PC.idPC WHERE PC.idPC = "'.$result[$i][0].'"';
            $requestPrepare = self::$bdd->prepare($request);
            $requestPrepare->execute();
            $result[$i][3] = $requestPrepare->fetchAll();
        }
        for($i=0 ; $i<intval(count($result)) ; $i++) {
            $request = 'SELECT DISTINCT System.nom FROM System RIGHT JOIN PCSystem on System.idSystem = PCSystem.idSystem RIGHT JOIN PC on PCSystem.idPC = PC.idPC WHERE PC.idPC = "'. $result[$i][0] .'"';
            $requestPrepare = self::$bdd->prepare($request);
            $requestPrepare->execute();
            $result[$i][4] = $requestPrepare->fetchAll();
        }
        return $result;
	}

    public function reservation() {
        $dateFinReservation = $_POST['dateFinReservation'];
        $identifiant = $_POST['identifiant'];
        $mdp = $_POST['mdp'];
        $pc = $_POST['pc'];

        //verification des données
        $bd = self::$bdd->prepare('SELECT idUtilisateur, identifiant FROM Utilisateur where identifiant like "'.$identifiant.'"');
        $bd->execute();
        $response1 = $bd->fetch();

        $bd = self::$bdd->prepare('SELECT mdp FROM Utilisateur where identifiant like "'.$identifiant.'"');
        $bd->execute();
        $response2 = $bd->fetch();

        $bd = self::$bdd->prepare('SELECT idPC, nom FROM PC where nom like "'.$pc.'"');
        $bd->execute();
        $response3 = $bd->fetch();

        //la fonction password_verify() ne fonctionne pas le mot de passe n'est donc pas hasher
        if ($response1 && $mdp == $response2[0] && $response3) {
            $bd = self::$bdd->prepare('INSERT into Reservation values('.$response3[0].','.$response1[0].','.date('d-m-y').','.$dateFinReservation.')');
            $bd->execute();
            $bd = self::$bdd->prepare('UPDATE PC SET disponible = 0 WHERE idPC = '.$response3[0]);
            $bd->execute();
        }
        else {
        ?>
            <script type="text/javascript">
                alert("Données non valide");
            </script>
        <?php
        }
    }
}
?>