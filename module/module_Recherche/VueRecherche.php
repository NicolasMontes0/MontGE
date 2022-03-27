<?php

class VueRecherche {

	public function __construct(){
        echo '<link rel="stylesheet" type="text/css" href="module/module_Recherche/VueRecherche.css"/>';
    }

	public function afficheDispo($result){
        echo '<h1 id="titre">PC disponible</h1>';
        foreach ($result as $key) {
            echo "
            <div id='PCInfo'>
                <a>
                <div>
                    <label>$key[1]</label></br>
                    <label>Commentaire : </label>$key[2]</br>
                    <label>Applications : </label>";
                    foreach ($key[3] as $k) {
                        echo "$k[0] ";
                    }
                    echo "</br><label>System d'exploitation : </label>";
                    foreach ($key[4] as $k) {
                        echo "$k[0] ";
                    }
                echo "</div>
                <div class='formulaire'>
                    <form action='index.php?action=reservation&module=Recherche' method='post'>
                        <input type='text' name='identifiant' placeholder='Identifiant' required></br>
                        <input type='password' name='mdp' placeholder='Mot de passe' required></br>
                        <input type='date' name='datefinReservation' required><label> Précisez la date de fin de la réservation </label></br>
                        <input type='submit' value='Réserver'>
                    </form>
                </div>
                </a>
            </div>";
        }
	}

    public function result($result){
        if($result){
            ?>
            <script type="text/javascript">
                alert("Opération réussite");
            </script>
            <?php
        }
        else{
            ?>
            <script type="text/javascript">
                alert("Opération échoué");
            </script>
            <?php
        }
    }
}
?>