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
			include_once("../includes/form_civil.php");
			include_once("../includes/form".$_POST["TYP_Id"].".php");
		}
		else{
			echo '<h4>Une erreur s\'est produite !</h4>';
		}
	}
?>