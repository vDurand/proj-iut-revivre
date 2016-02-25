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
			echo '<form>';
			include_once("../includes/form_civil.php");
			if ($_POST["TYP_Id"] != 5 && $_POST["TYP_Id"] != 2)
				include_once("../includes/form_profesional.php");
			include_once("../includes/form_emergency.php");
			echo '</form>';
		}
		else{
			echo '<h4>Une erreur s\'est produite !</h4>';
		}
		echo '<div align="center">
				<input type="button" value="Annuler" class="buttonC">
				<input type="button" value="Valider" class="buttonC">
			  </div>'; 
	}
?>