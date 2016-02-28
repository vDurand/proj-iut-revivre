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

	function in_assoc_array_by_key($value, $array, $key){
		for($x=0; $x<sizeof($array); $x++){
			if($array[$x][$key] == $value){
				return true;
			}
		}
		return false;
	}
?>