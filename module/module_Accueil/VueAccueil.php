<?php

class VueAccueil {

    public function __construct() {
        echo '<link rel="stylesheet" type="text/css" href="module/module_Accueil/VueAccueil.css"/>';
    }

    public function afficheAccueil() {
        ?>
        <div id="cadre">
            <h1>Bonjour,</h1>
            <p>MontGE existe également sur Android et IOS avec la possibilité de scanner les QRCode des pcs de l'iut !</p>
        </div>
        <?php
    }

}
?>