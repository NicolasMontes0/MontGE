<?php
if (!defined('CONST_INCLUDE')){die('Accès direct interdit');}
include_once('./VueIndex.php');

echo "<meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">";

class VueRecherche extends VueIndex{

	public function __construct(){
        echo '<link rel="stylesheet" type="text/css" href="module/module_Recherche/VueRecherche.css"/>';
    }

	public function afficheParNom(){
		echo "Bonjour !";
	}

}
?>