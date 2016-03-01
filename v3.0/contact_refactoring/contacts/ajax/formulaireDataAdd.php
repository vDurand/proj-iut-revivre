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
		if(isset($_POST["TC_ID"]) && !empty($_POST["TC_ID"])){
			echo '<form method="POST" action="../contacts/postContact.php">';

			include_once(__DIR__."/../includes/form".$_POST["TC_ID"].".php");

			echo '<div align="center">
					<input type="button" value="Annuler" class="buttonC" onclick="$.redirect(\'../../home.php\')">
					<input type="submit" value="Valider" class="buttonC">
			  	</div>
			</form>';							
		}
		else{
			echo '<h4>Une erreur s\'est produite !</h4>';
		}
	}
?>