<?php
if (!defined('CONST_INCLUDE')){die('Accès direct interdit');}
require_once('ContRecherche.php');

class ModRecherche{

	private $controleur;

	public function __construct(){
		$this->controleur = new ContAccueil();
		if( isset($_GET['action']) ){
			$choix=htmlspecialchars($_GET['action']);
			switch($choix){
				case "parNom":
					$this->controleur->rechercheParNom();
					break;
				default:
					?>
						<script type="text/javascript"> 
        					alert("Action Inexistante"); 
 		 				</script>
 		 			<?php
				break;
			}
		}
	}
}

?>