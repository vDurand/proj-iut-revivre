<?php
    session_set_cookie_params(0);
	session_start();
	$pwd = "../../../";
	include($pwd.'assets.php');
	$db = revivre();
	mysqli_query($db, "SET NAMES 'utf8'");

	if(isset($_POST["request_type"]) && !empty($_POST["request_type"])){

		switch($_POST["request_type"]){
			case "form":
				getFormulaire($db);
				break;
			case "list":
				getListe($db);
				break;
			case "per_info":
				getDataPersonne($db);
				break;
		}
	}

	function getFormulaire($db){
		if(isset($_POST["TC_ID"]) && !empty($_POST["TC_ID"])){
			echo '<form method="POST" action="../contacts/postContact.php">';

			include_once(__DIR__."/../includes/form".$_POST["TC_ID"].".php");

			echo '<div align="center">
					<input type="hidden" id="request_type" name="request_type" value="add"/>
                    <input type="hidden" id="TC_ID" name="TC_ID" value="'.$_POST["TC_ID"].'"/>
					<input type="button" value="Annuler" class="buttonC" onclick="$.redirect(\'../../home.php\')">
					<input type="submit" value="Valider" class="buttonC">
			  	</div>
			</form>';							
		}
		else{
			echo '<h4>Une erreur s\'est produite !</h4>';
		}
	}

	function getListe($db){
		if(isset($_POST["TC_ID"]) && !empty($_POST["TC_ID"])){

			if($_POST["TC_ID"] == 1){ // partie fournisseur

				$prep="FOU";
				$type="Fournisseur";
				$query = mysqli_query($db, "SELECT FOU_NumFournisseur, FOU_Nom, FOU_Telephone, FOU_Portable, FOU_Email, FOU_Adresse, FOU_Ville FROM fournisseurs ;");
																
			}
			else{
				if($_POST["TC_ID"] == 2){
					$prep="CLI";
					$type="Client";

					if($_POST["TypeClient"]=="structure"){
						$query = mysqli_query($db, "SELECT CLI_NumClient, CLI_Nom, CLI_Telephone, CLI_Portable, CLI_Email, CLI_Adresse, CLI_Ville 
													FROM clients WHERE CLI_Prenom is null;");
					}
					else{
						if($_POST["TypeClient"]=="particulier"){
							$query = mysqli_query($db, "SELECT CLI_NumClient, CLI_Nom, CLI_Prenom, CLI_Telephone, CLI_Portable, CLI_Email, CLI_Adresse, CLI_Ville 
														FROM clients WHERE CLI_Prenom is not null;");
						}
					}
				}
				else{
					echo '<h4>Une erreur s\'est produite !</h4>';
				}
			}
		?>
			<div class="repertoire-show-list">
	        	<table class="sortable" cellpadding="5">
	            	<thead>
	            		<tr>
	                		<th>Nom</th>
	                		<?php
	                		if($prep=="CLI" && $_POST["TypeClient"]=="particulier"){
	                			echo "<th>Prenom</th>";
	                		}
	                		?>
		                    <th>Tél Fixe</th>
		                    <th>Tél Portable</th>
		                    <th>Email</th>
		                    <th>Rue/Lotissement</th>
		                    <th>Ville</th>
		                </tr>
	                </thead>
	                <tbody>
		<?php
					while($data = mysqli_fetch_assoc($query)){
		?>
	            		<tr data-connum="<?php echo $data[$prep."_Num".$type]; ?>">
	                		<td><?php echo (($data[$prep."_Nom"] != "") ? $data[$prep."_Nom"] : '<i class="no-data">Aucun nom</i>') ?></td>
	                		
	                	<?php
	                		if($prep=="CLI" && $_POST["TypeClient"]=="particulier"){
	                	?>
	                		<td>		
	                		 	<?php echo (($data["CLI_Prenom"] != "") ? $data["CLI_Prenom"] : '<i class="no-data">Aucun prenom</i>'); ?>
	                	<?php
	                		}
	                	?>
	                		</td>

		                    <td><?php echo (($data[$prep."_Telephone"] != "") ? convertToPhoneNumber($data[$prep."_Telephone"]) : '<i class="no-data">Aucun numéro</i>'); ?></td>
		                    <td><?php echo (($data[$prep."_Portable"] != "") ? convertToPhoneNumber($data[$prep."_Portable"]) : '<i class="no-data">Aucun numéro</i>'); ?></td>
		                    <td><?php echo (($data[$prep."_Email"] != "") ? $data[$prep."_Email"] : '<i class="no-data">Aucun e-mail</i>'); ?></td>
		                    <td><?php echo (($data[$prep."_Adresse"] != "") ? $data[$prep."_Adresse"] : '<i class="no-data">Aucune rue/lotissement</i>'); ?></td>
		                    <td><?php echo (($data[$prep."_Ville"] != "") ? $data[$prep."_Ville"] : '<i class="no-data">Aucune ville</i>'); ?></td>
		                </tr>
		<?php
					}
		?>
	                </tbody>
	          	</table>
	        </div>
	    <?php
		}
		else{
			echo '<h4>Une erreur s\'est produite !</h4>';
		}	
	}

	function getDataPersonne($db){
		if(isset($_POST["PER_Num"]) && !empty($_POST["PER_Num"]) && isset($_POST["Type"]) && !empty($_POST["Type"]) && isset($_POST["TC_ID"]) && !empty($_POST["TC_ID"]) && isset($_POST["ConNum"]) && !empty($_POST["ConNum"])){
			if($_POST["Type"] == "Fournisseur"){
				$query = mysqli_query($db, "SELECT * FROM personnes JOIN employerfourn USING(PER_Num) WHERE PER_Num = ".$_POST["PER_Num"].";");
				$fonction = "EMF_Fonction";
			}
			else{
				if($_POST["Type"] == "Client"){
					$query = mysqli_query($db, "SELECT * FROM personnes JOIN employerclient USING(PER_Num) WHERE PER_Num = ".$_POST["PER_Num"].";");
					$fonction = "EMC_Fonction";
				}
				else{
					echo '<h4>Une erreur s\'est produite !</h4>';
				}
			}

			$employe = mysqli_fetch_assoc($query);

			echo "<h4>Detail de ".$employe["PER_Nom"]." ".$employe["PER_Prenom"]."</h4>";
?>
			<div class="repertoire-bloc">
			    <fieldset>
			        <legend>Coordonnées civiles</legend>
			        <table class="showcase_table">
			            <tbody>
			                <tr>
			                    <td>Rue, lotissement :</td>
			                    <td><?php echo (!empty($employe["PER_Adresse"])) ? stripslashes($employe["PER_Adresse"]) : '<i class="no-data">Aucune adresse</i>'; ?></td>
			                    <td>Ville :</td>
			                    <td><?php echo (!empty($employe["PER_Ville"])) ? stripslashes($employe["PER_Ville"]) : '<i class="no-data">Aucune ville</i>'; ?></td>
			                </tr>
			                <tr>
			                    <td>Code postal :</td>
			                    <td><?php echo (!empty($employe["PER_CodePostal"])) ? $employe["PER_CodePostal"] : '<i class="no-data">Aucun code postal</i>'; ?></td>
			                    <td></td>
			                    <td></td>
			                </tr>
			                <tr></tr>
			                <tr>
			                    <td>Téléphone fixe :</td>
			                    <td><?php echo (!empty($employe["PER_TelFixe"])) ? convertToPhoneNumber($employe["PER_TelFixe"]) : '<i class="no-data">Aucun numéro</i>'; ?></td>
			                    <td>Téléphone Portable :</td>
			                    <td><?php echo (!empty($employe["PER_TelPort"])) ? convertToPhoneNumber($employe["PER_TelPort"]) : '<i class="no-data">Aucun numéro</i>'; ?></td>
			                </tr>
			                <tr>
			                    <td>Fax :</td>
			                    <td><?php echo (!empty($employe["PER_Fax"])) ? convertToPhoneNumber($employe["PER_Fax"]) : '<i class="no-data">Aucun numéro</i>'; ?></td>
			                    <td>Adresse @ email :</td>
			                    <td><?php echo (!empty($employe["PER_Email"])) ? '<a href="mailto:'.$employe["PER_Email"].'">'.$employe["PER_Email"].'</a>' : '<i class="no-data">Aucun e-mail</i>'; ?></td>
			                </tr>
			                <tr></tr>
			                <tr>
			                	<td>Fonction :</td>
			                    <td><?php echo (!empty($employe[$fonction])) ?  stripslashes($employe[$fonction]) : '<i class="no-data">Aucune fonction</i>'; ?></td>
			                </tr>
			            </tbody>
			        </table>
			    </fieldset>
			</div>
			<div class="align-center">
                <input name="cancelInfoEmploye" type="button" id="cancelInfoEmploye" value="Retour" class="buttonC">  
                <input type="button" value="Modifier" class="buttonC" 
                onclick="$.redirect('editContact.php',{'request_type':'Employe','PER_Num': <?php echo $employe["PER_Num"] ?> , 'Type': '<?php echo $_POST["Type"]; ?>', 'TC_ID': <?php echo $_POST["TC_ID"]; ?> ,'ConNum':<?php echo $_POST["ConNum"]; ?> }, 'POST');" />                  
            </div>
<?php                            
		}
		else{
			echo '<h4>Une erreur s\'est produite !</h4>';
		}		
	}		
			
?>