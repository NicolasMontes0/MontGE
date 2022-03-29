<?php
require_once('./Connexion.php');

class ModeleRecherche extends Connexion{


	public function __construct(){

	}

	public function triDispo(){
        $request = self::$bdd->prepare('SELECT DISTINCT idPC, nom, commentaire FROM PC WHERE disponible=true;');
        $request->execute();
        $result = $request->fetchAll();
        for($i=0 ; $i<intval(count($result)) ; $i++) {
            $request = self::$bdd->prepare('SELECT DISTINCT Application.nom FROM Application RIGHT JOIN PCApplication on Application.idApplication = PCApplication.idApplication RIGHT JOIN PC on PCApplication.idPC = PC.idPC WHERE PC.idPC = :idPC;');
            $request->bindParam("idPC", $result[$i][0]);
            $request->execute();
            $result[$i][3] = $request->fetchAll();
        }
        for($i=0 ; $i<intval(count($result)) ; $i++) {
            $request = self::$bdd->prepare('SELECT DISTINCT System.nom FROM System RIGHT JOIN PCSystem on System.idSystem = PCSystem.idSystem RIGHT JOIN PC on PCSystem.idPC = PC.idPC WHERE PC.idPC = :idPC;');
            $request->bindParam("idPC", $result[$i][0]);
            $request->execute();
            $result[$i][4] = $request->fetchAll();
        }
        return $result;
	}

    public function reservation() {
        header('Location:index.php?module=Recherche&action=triDispo');

        $dateFinReservation = $_POST['dateFinReservation'];
        $identifiant = $_POST['identifiant'];
        $mdp = $_POST['mdp'];
        $pc = $_POST['pc'];

        //verification des données
        $bd = self::$bdd->prepare('SELECT idUtilisateur, identifiant FROM Utilisateur where identifiant like :identifiant;');
        $bd->bindParam("identifiant", $identifiant);
        $bd->execute();
        $response1 = $bd->fetch();

        $bd = self::$bdd->prepare('SELECT mdp FROM Utilisateur where identifiant like :identifiant;');
        $bd->bindParam("identifiant", $identifiant);
        $bd->execute();
        $response2 = $bd->fetch();

        $bd = self::$bdd->prepare('SELECT idPC, nom FROM PC where nom like :pc;');
        $bd->bindParam("pc", $pc);
        $bd->execute();
        $response3 = $bd->fetch();

        //la fonction password_verify() ne fonctionne pas le mot de passe n'est donc pas hasher
        if ($response1 && $mdp == $response2[0] && $response3) {
            print_r(date('Y-m-d', strtotime($dateFinReservation)));
            $dateFinReservation = date('Y-m-d', strtotime($dateFinReservation));
            $bd = self::$bdd->prepare('INSERT into Reservation values(default, :idPC, :idUtilisateur, default, :dateFin);');
            $bd->bindParam("idPC", $response3[0]);
            $bd->bindParam("idUtilisateur", $response1[0]);
            $bd->bindParam("dateFin", $dateFinReservation);
            $bd->execute();
            $bd = self::$bdd->prepare('UPDATE PC SET disponible = 0 WHERE idPC = :idPC;');
            $bd->bindParam("idPC", $response3[0]);
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