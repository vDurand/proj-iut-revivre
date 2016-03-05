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
		}
	}

	function getFormulaire($db){
		if(isset($_POST["TYP_Id"]) && !empty($_POST["TYP_Id"])){
			$query_type = mysqli_query($db, "SELECT TYP_Id, TYP_Nom FROM type WHERE TYP_Nom IN ('Stagiaire', 'Salarié en Insertion', 'Atelier Occupationnel');");
			$typeSalarie = mysqli_fetch_all($query_type, MYSQLI_ASSOC);
			$specialSalarie = in_assoc_array_by_key($_POST["TYP_Id"], $typeSalarie, "TYP_Id");
			$fonction = false;

			echo '<form method="POST" action="'.__DIR__.'/../postSalarie.php">';


			if($specialSalarie){
				include_once(__DIR__."/../includes/form_date.php");
			}
			else{
				$fonction = true;
			}

			include_once(__DIR__."/../includes/form_civil.php");

			if($specialSalarie){
				include_once(__DIR__."/../includes/form_emergency.php");
				include_once(__DIR__."/../includes/form_additional.php");
			}

			echo '<div align="center">
					<input type="button" value="Annuler" class="buttonC" onclick="$.redirect(\'../../home.php\')";>
					<input type="button" value="Valider" class="buttonC">
			  	</div>
			</form>';
		}
		else{
			echo '<h4>Une erreur s\'est produite !</h4>';
		}
	}

	function getListe($db){
		if(isset($_POST["TYP_Id"]) && !empty($_POST["TYP_Id"])){
			$query_salaries = mysqli_query($db, "SELECT SAL_NumSalarie, PER_Prenom, PER_Nom, PER_TelFixe, PER_TelPort, PER_Email, PER_Adresse, PER_Ville, SAL_DateSortie FROM personnes 
											JOIN salaries USING(PER_Num) WHERE TYP_Id = ".$_POST["TYP_Id"]." AND SAL_Actif = ".$_POST["SAL_Actif"]." ORDER BY PER_Nom, PER_Prenom;");
	?>
		<div class="repertoire-show-list">
        	<table class="sortable" cellpadding="5">
            	<thead>
            		<tr>
                		<th>Nom</th>
                		<th>Prénom</th>
	                    <th>Tél Fixe</th>
	                    <th>Tél Portable</th>
	                    <th>Email</th>
	                    <th>Rue/Lotissement</th>
	                    <th>Ville</th>
	                </tr>
                </thead>
                <tbody>
	<?php
				while($data = mysqli_fetch_assoc($query_salaries)){
	?>
            		<tr data-salnum="<?php echo $data["SAL_NumSalarie"]; ?>">
                		<td><?php echo (($data["PER_Nom"] != "") ? $data["PER_Nom"] : '<i class="no-data">Aucun nom</i>') ?></td>
                		<td><?php echo (($data["PER_Prenom"] != "") ? $data["PER_Prenom"] : '<i class="no-data">Aucun nom</i>') ?></td>
	                    <td><?php echo (($data["PER_TelFixe"] != "") ? convertToPhoneNumber($data["PER_TelFixe"]) : '<i class="no-data">Aucun numéro</i>'); ?></td>
	                    <td><?php echo (($data["PER_TelPort"] != "") ? convertToPhoneNumber($data["PER_TelPort"]) : '<i class="no-data">Aucun numéro</i>'); ?></td>
	                    <td><?php echo (($data["PER_Email"] != "") ? $data["PER_Email"] : '<i class="no-data">Aucun e-mail</i>'); ?></td>
	                    <td><?php echo (($data["PER_Adresse"] != "") ? $data["PER_Adresse"] : '<i class="no-data">Aucune rue/lotissement</i>'); ?></td>
	                    <td><?php echo (($data["PER_Ville"] != "") ? $data["PER_Ville"] : '<i class="no-data">Aucune ville</i>'); ?></td>
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
?>