<?php
	$pwd = "../../";
	include($pwd.'bandeau.php');
?>
<div id="corps">
<?php
	if(isset($_POST["request_type"]) && !empty($_POST["request_type"])){

		$typeClient = null;
		$request_type = "edit";

		switch($_POST["request_type"]){
			case "Fournisseur":
				editFournisseur($db);
				break;
			case "Client":
				editClient($db);
				break;
			case "Employe":
				editEmploye($db,$request_type);
				break;
		}
	}

	function editEmploye($db,&$request_type){
		if(isset($_POST["PER_Num"]) && !empty($_POST["PER_Num"]) && isset($_POST["Type"]) && !empty($_POST["Type"]) && isset($_POST["TC_ID"]) && !empty($_POST["TC_ID"]) && isset($_POST["ConNum"]) && !empty($_POST["ConNum"])){
			echo '<form method="POST" action="postContact.php">';
			$query = mysqli_query($db, "SELECT * from personnes WHERE PER_Num = ".$_POST["PER_Num"].";");
			$employe = mysqli_fetch_assoc($query);

			if($_POST["Type"] == "Fournisseur"){
				$querybis = mysqli_query($db, "SELECT EMF_Fonction from employerfourn WHERE PER_Num = ".$_POST["PER_Num"].";");
				$colonne = "EMF_Fonction";
			}
			else{
				if($_POST["Type"] == "Client"){
					$querybis = mysqli_query($db, "SELECT EMC_Fonction from employerclient WHERE PER_Num = ".$_POST["PER_Num"].";");
					$colonne = "EMC_Fonction";
				}
				else{
			        echo '<div id="bad"> 
			            <label>Une erreur c\'est produite lors de l\'accès à la page</label>
			        </div>';
		    	}
			}

			$fonction = mysqli_fetch_assoc($query);

			!empty($employe["PER_Nom"]) ? $_POST["PER_Nom"] = $employe["PER_Nom"] : "" ;
			!empty($employe["PER_Prenom"]) ? $_POST["PER_Prenom"] = $employe["PER_Prenom"] : "" ;
			!empty($employe["PER_Adresse"]) ? $_POST["PER_Adresse"] = $employe["PER_Adresse"] : "" ;
			!empty($employe["PER_CodePostal"]) ? $_POST["PER_CodePostal"] = $employe["PER_CodePostal"] : "" ;
			!empty($employe["PER_Ville"]) ? $_POST["PER_Ville"] = $employe["PER_Ville"] : "" ;
			!empty($employe["PER_Telephone"]) ? $_POST["PER_TelFixe"] = $employe["PER_Telephone"] : "" ;
			!empty($employe["PER_Portable"]) ? $_POST["PER_TelPort"] = $employe["PER_Portable"] : "" ;
			!empty($employe["PER_Fax"]) ? $_POST["PER_Fax"] = $employe["PER_Fax"] : "" ;
			!empty($employe["PER_Email"]) ? $_POST["PER_Email"] = $employe["PER_Email"] : "" ;

			!empty($fonction[$colonne]) ? $_POST["Fonction"] = $employe[$colonne] : "" ;
	?>
			<div id="labelT">
			    <label>
			    <?php
			        echo 'Modification de '.stripslashes($employe["PER_Nom"]).', employe de l\'association';
			    ?>
			    </label>
			</div>
	<?php
			include_once("./includes/form_employe.php"); 
			$request_type = "editEmploye";

		}
    	else{
	        echo '<div id="bad"> 
	            <label>Une erreur c\'est produite lors de l\'accès à la page</label>
	        </div>';
    	}
	}

	function editFournisseur($db){
		if(isset($_POST["ConNum"]) && !empty($_POST["ConNum"]) && isset($_POST["TC_ID"]) && !empty($_POST["TC_ID"])){
			echo '<form method="POST" action="postContact.php">';
			$query = mysqli_query($db, "SELECT * from fournisseurs WHERE FOU_NumFournisseur = ".$_POST["ConNum"].";");
			$fournisseur = mysqli_fetch_assoc($query);

			!empty($fournisseur["FOU_Nom"]) ? $_POST["FOU_Nom"] = $fournisseur["FOU_Nom"] : "" ;
			!empty($fournisseur["FOU_Adresse"]) ? $_POST["FOU_Adresse"] = $fournisseur["FOU_Adresse"] : "" ;
			!empty($fournisseur["FOU_CodePostal"]) ? $_POST["FOU_CodePostal"] = $fournisseur["FOU_CodePostal"] : "" ;
			!empty($fournisseur["FOU_Ville"]) ? $_POST["FOU_Ville"] = $fournisseur["FOU_Ville"] : "" ;
			!empty($fournisseur["FOU_Telephone"]) ? $_POST["FOU_TelFixe"] = $fournisseur["FOU_Telephone"] : "" ;
			!empty($fournisseur["FOU_Portable"]) ? $_POST["FOU_TelPort"] = $fournisseur["FOU_Portable"] : "" ;
			!empty($fournisseur["FOU_Fax"]) ? $_POST["FOU_Fax"] = $fournisseur["FOU_Fax"] : "" ;
			!empty($fournisseur["FOU_Email"]) ? $_POST["FOU_Email"] = $fournisseur["FOU_Email"] : "" ;
?>
			<div id="labelT">
			    <label>
			    <?php
			        echo 'Modification de '.stripslashes($fournisseur["FOU_Nom"]).', fournisseur de l\'association';
			    ?>
			    </label>
			</div>
<?php
			include_once("./includes/form1.php"); 
		}
    	else{
	        echo '<div id="bad"> 
	            <label>Une erreur c\'est produite lors de l\'accès à la page</label>
	        </div>';
    	}
	}

	function editClient($db){
		if(isset($_POST["ConNum"]) && !empty($_POST["ConNum"]) && isset($_POST["TC_ID"]) && !empty($_POST["TC_ID"])){
			echo '<form method="POST" action="postContact.php">';
			$query = mysqli_query($db, "SELECT * from clients WHERE CLI_NumClient = ".$_POST["ConNum"].";");
			$client = mysqli_fetch_assoc($query);

			!empty($client["CLI_Nom"]) ? $_POST["CLI_Nom"] = $client["CLI_Nom"] : "" ;
			!empty($client["CLI_Adresse"]) ? $_POST["CLI_Adresse"] = $client["CLI_Adresse"] : "" ;
			!empty($client["CLI_CodePostal"]) ? $_POST["CLI_CodePostal"] = $client["CLI_CodePostal"] : "" ;
			!empty($client["CLI_Ville"]) ? $_POST["CLI_Ville"] = $client["CLI_Ville"] : "" ;
			!empty($client["CLI_Telephone"]) ? $_POST["CLI_TelFixe"] = $client["CLI_Telephone"] : "" ;
			!empty($client["CLI_Portable"]) ? $_POST["CLI_TelPort"] = $client["CLI_Portable"] : "" ;
			!empty($client["CLI_Fax"]) ? $_POST["CLI_Fax"] = $client["CLI_Fax"] : "" ;
			!empty($client["CLI_Email"]) ? $_POST["CLI_Email"] = $client["CLI_Email"] : "" ;
			$_POST["edit"]=true;
?>
			<div id="labelT">
			    <label>
			    <?php
				    if(!empty($client["CLI_Prenom"]) && $client["CLI_Prenom"]!=null){
						$_POST["CLI_Prenom"] = $client["CLI_Prenom"];
						echo 'Modification de '.stripslashes($client["CLI_Nom"]).' '.stripslashes($client["CLI_Prenom"]).', client de l\'association';
						echo '<input type="hidden" id="TypeClient" name="TypeClient" value="particulier"/>';
						$typeClient = "particulier";
					}
					else{
						echo 'Modification de '.stripslashes($client["CLI_Nom"]).', client de l\'association';
						echo '<input type="hidden" id="TypeClient" name="TypeClient" value="structure"/>';
						$typeClient = "structure";
					}			        
			    ?>
			    </label>
			</div>
<?php
			include_once("./includes/form2.php"); 			
		}
    	else{
	        echo '<div id="bad"> 
	            <label>Une erreur c\'est produite lors de l\'accès à la page</label>
	        </div>';
    	}
	}

		echo '<div align="center">
	            <input type="hidden" id="request_type" name="request_type" value="'.$request_type.'"/>
	            <input type="hidden" id="TC_ID" name="TC_ID" value="'.$_POST["TC_ID"].'"/>
	            <input type="hidden" id="ConNum" name="ConNum" value="'.$_POST["ConNum"].'"/>
				<input type="button" value="Annuler" class="buttonC" onclick="$.redirect(\'showContact.php\',{\'TC_ID\': '.$_POST["TC_ID"].', \'ConNum\' : '.$_POST["ConNum"].', \'TypeClient\' : \''.$typeClient.'\'}, \'POST\');" />
				<input type="submit" value="Valider" class="buttonC">
		  	</div>
		</form>';
?>
</div>
<?php
	include($pwd.'footer.php');
?>