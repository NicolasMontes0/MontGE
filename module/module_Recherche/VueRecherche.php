<?php

class VueRecherche {

	public function __construct(){
        //echo '<link rel="stylesheet" type="text/css" href="module/module_Recherche/VueRecherche.css"/>';
    }

	public function afficheDispo($result){
        echo '<p>PC disponible</p>';
        foreach ($result as $key ) {

            echo "<a>";
            echo "<div>";
            echo "$key[0]";
            echo "Commentaire : ".$key[1];
            echo "</div>";
            echo "</a>";
        }
	}

}
?>