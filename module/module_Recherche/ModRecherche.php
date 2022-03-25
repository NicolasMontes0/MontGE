<?php
require_once('ContRecherche.php');

class ModRecherche{

	private $controleur;

	public function __construct(){
		$this->controleur = new ContRecherche();
		if( isset($_GET['action']) ){
			$choix=htmlspecialchars($_GET['action']);
			switch($choix){
				case "triDispo":
					$this->controleur->triDispo();
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