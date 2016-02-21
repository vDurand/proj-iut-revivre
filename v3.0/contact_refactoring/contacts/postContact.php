<?php
	$pageTitle = "Ajout d'un contact";
	$pwd='../../';
	include($pwd.'bandeau.php');
?>
<div id="corps">
<?php

	if(isset($_POST["Num_form"]) && !empty($_POST["Num_form"])){
		switch($_POST["Num_form"]){

			case 1: // ajout d'un fournisseur
				ajoutFournisseur($db);
				break;

			case 2: // ajout d'un client
				ajoutClient($db);
				break;

			case 3: // ajout d'un référent
				echo "en cours";
				break;			
		}
	}
?>
</div>
<?php
  	include($pwd.'footer.php');

  	function ajoutFournisseur($db){

  		if(isset($_POST["FOU_Nom"]) && isset($_POST["FOU_Adresse"]) && isset($_POST["FOU_TelFixe"]) && isset($_POST["FOU_CodePostal"]) && isset($_POST["FOU_TelPort"]) && isset($_POST["FOU_Ville"]) && 
  			isset($_POST["FOU_Fax"]) && isset($_POST["FOU_Mail"])){

  			$query = mysqli_query($db,"INSERT INTO fournisseurs (FOU_Nom, FOU_Adresse, FOU_CodePostal, FOU_Ville, FOU_Telephone, FOU_Portable, FOU_Fax, FOU_Email) 
  				VALUES ('".$_POST['FOU_Nom']."','".$_POST['FOU_Adresse']."',".$_POST['FOU_CodePostal'].",'".$_POST['FOU_Ville']."','".$_POST['FOU_TelFixe']."',
  				'".$_POST['FOU_TelPort']."','".$_POST['FOU_Fax'].",'".$_POST['FOU_Mail']."');") ;

  			if(!$query){
				displayError("fournisseur");
				mysqli_query($db, 'ROLLBACK;');
  			}
  			else{
  				displaySuccess("fournisseur");
  				mysqli_query($db, 'COMMIT;');
  			}
  		}
  		else{
  			displayError("fournisseur");
  		}
  	}

  	function ajoutClient($db){

  		if(isset($_POST["CLI_Nom"]) && isset($_POST["CLI_Adresse"]) && isset($_POST["CLI_TelFixe"]) && isset($_POST["CLI_CodePostal"]) && isset($_POST["CLI_TelPort"]) && isset($_POST["CLI_Ville"]) && 
  			isset($_POST["CLI_Fax"]) && isset($_POST["CLI_Mail"])){

  			if(isset($_POST["CLI_Prenom"]) && !empty($_POST["CLI_Prenom"])){ // cas particulier

  				$query = mysqli_query($db,"INSERT INTO clients (CLI_Nom, CLI_Prenom, CLI_Adresse, CLI_CodePostal, CLI_Ville, CLI_Telephone, CLI_Portable, CLI_Fax, CLI_Email) VALUES ('".$_POST["CLI_Nom"]."','".$_POST["CLI_Prenom"]."','".$_POST["CLI_Adresse"]."',".$_POST["CLI_CodePostal"].",'".$_POST["CLI_Ville"]."','".$_POST["CLI_TelFixe"]."','".$_POST["CLI_TelPort"]."','".$_POST["CLI_Fax"]."','".$_POST["CLI_Mail"]."')") ;

	  			if(!$query){
					displayError("client");
					mysqli_query($db, 'ROLLBACK;');
	  			}
				else{
					displaySuccess("client");
					mysqli_query($db, 'COMMIT;');
				}
  			}
  			else{ // cas structure
  				$query = mysqli_query($db,"INSERT INTO clients (CLI_Nom, CLI_Adresse, CLI_CodePostal, CLI_Ville, CLI_Telephone, CLI_Portable, CLI_Fax, CLI_Email) VALUES ('".$_POST["CLI_Nom"]."','".$_POST["CLI_Adresse"]."',".$_POST["CLI_CodePostal"].",'".$_POST["CLI_Ville"]."','".$_POST["CLI_TelFixe"]."','".$_POST["CLI_TelPort"]."','".$_POST["CLI_Fax"]."','".$_POST["CLI_Mail"]."')") ;

	  			if(!$query){
					displayError("client");
					mysqli_query($db, 'ROLLBACK;');
	  			}
	  			else{
	  				displaySuccess("client");
	  				mysqli_query($db, 'COMMIT;');
	  			}
  			}  			
  		}
  		else{
  			displayError("client");
  		}
  	}

  	function ajoutReferent(){
  		$query = "INSERT INTO referents(REF_NumRef, PER_Num, PRE_Id) VALUES ([value-1],[value-2],[value-3])"; // ajout dans la table personnes également
  	}

  	function displayError($txt){
  		echo '<div id="bad"> 
              <label>Une erreur s\'est produite lors de l\'ajout d\'un '.$txt.' !</label>
              </div>';        
  	}

  	function displaySuccess($txt){
        echo '<div id="good">
	        <label> Le '.$txt.' a été sauvegardé avec succès !</label>
	        </div>';	    
  	}
?>