<?php

class VueRecherche {

	public function __construct(){
        //echo '<link rel="stylesheet" type="text/css" href="module/module_Recherche/VueRecherche.css"/>';
    }

	public function afficheDispo($result){
        echo '<p>PC disponible</p>';
        foreach ($result as $key) {

            echo "<a>";
            echo "<div>";
            echo "$key[1]</br>";
            echo "Commentaire : ".$key[2]."</br>";
            echo "Applications : ";
            foreach ($key[3] as $k) {
                echo "$k[0] ";
            }
            echo "</br>System d'exploitation : ";
            foreach ($key[4] as $k) {
                echo "$k[0] ";
            }
            echo "</div>";
            echo "</a>";
        }
	}

}
?>