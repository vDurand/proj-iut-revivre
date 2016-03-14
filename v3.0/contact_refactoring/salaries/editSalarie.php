<?php
	$pwd = "../../";
	include($pwd.'bandeau.php');
?>
<div id="corps">
	<div id="labelT">
		<label><?php echo $_POST["Head_Title"]; ?></label>
	</div>
<?php
	$query_type = mysqli_query($db, "SELECT TYP_Id, TYP_Nom FROM type WHERE TYP_Nom IN ('Stagiaire', 'Salarié en Insertion', 'Atelier Occupationnel');");
	$typeSalarie = mysqli_fetch_all($query_type, MYSQLI_ASSOC);
	$specialSalarie = in_assoc_array_by_key($_POST["TYP_Id"], $typeSalarie, "TYP_Id");
	$fonction = false;

	if(isset($_POST["Post_Errors"]) && !empty($_POST["Post_Errors"])){
		include_once("includes/form_errors.php");
	}

	echo '<form method="POST" action="postSalarie.php">';

	if($specialSalarie){
		include_once("includes/form_date.php");
	}
	else{
		$fonction = true;
	}

	include_once("includes/form_civil.php");

	if($specialSalarie){
		include_once("includes/form_emergency.php");
		include_once("includes/form_additional.php");
	}

	echo '<div align="center">
            <input type="hidden" id="request_type" name="request_type" value="'.$_POST["request_type"].'"/>
            <input type="hidden" id="TYP_Id" name="TYP_Id" value="'.$_POST["TYP_Id"].'"/>
			<input type="button" value="Annuler" class="buttonC" onclick="$.redirect(\''.$pwd.'home.php\')";>
			<input type="submit" value="Valider" class="buttonC">
	  	</div>
	</form>';
?>
</div>
<?php
	include($pwd.'footer.php');
?>