<?php
    session_set_cookie_params(0);
	session_start();
	include('../../assets.php');
	$db = revivre();
	mysqli_query($db, "SET NAMES 'utf8'");

	if(isset($_POST["request_type"])){

		switch($_POST["request_type"]){
			case "enc":
				getEncList($db);
				break;
			case "sal":
				getSalList($db);
				break;

			case "ferie":
				checkJourFerie();
				break;
		}
	}

	function getEncList($db){
		if(isset($_POST["ASSOC_Date"]) && !empty($_POST["ASSOC_Date"]))
		{
			echo '<option value="0" selected="selected" disabled="disabled">Choisissez un encadrant</option>';
			$query = mysqli_query($db, "SELECT PER_Nom, PER_Prenom, SAL_NumSalarie
										FROM salaries
										JOIN personnes USING(PER_Num)
										WHERE FCT_id = 4 AND SAL_Actif = 1 AND SAL_NumSalarie NOT IN
										(
											SELECT DISTINCT ENC_Num FROM pl_association WHERE ASSOC_Date = '".$_POST["ASSOC_Date"]."'
										)
										ORDER BY PER_Nom, PER_Prenom;");

			while($data = mysqli_fetch_assoc($query))
			{
				echo '<option value="'.$data["SAL_NumSalarie"].'">'.$data["PER_Nom"].' '.$data["PER_Prenom"].'</option>';
			}
		}
		else{
			echo '<option value="0" selected="selected" disabled="disabled">Aucune donnée, une erreure s\'est produite</option>';
		}
	}

	function getSalList($db){
		if(isset($_POST["ASSOC_Date"]) && !empty($_POST["ASSOC_Date"]) && isset($_POST["PL_id"]) && !empty($_POST["PL_id"]))
		{
			$typeSalarie = [8,7,9];
			echo '<option value="0" selected="selected" disabled="disabled">Choisissez un salarié</option>';

			$query = mysqli_query($db, "SELECT PER_Nom, PER_Prenom, SAL_NumSalarie
										FROM insertion
										JOIN salaries USING(SAL_NumSalarie) 
										JOIN personnes USING(PER_Num) 
										WHERE TYS_ID = 0 AND TYP_Id = ".$typeSalarie[$_POST["PL_id"]-1]." AND SAL_Actif = 1 AND SAL_NumSalarie NOT IN
										(
											SELECT DISTINCT SAL_NumSalarie FROM pl_association WHERE ASSOC_Date = '".$_POST["ASSOC_Date"]."'
										)
										ORDER BY PER_Nom, PER_Prenom;");

			while($data = mysqli_fetch_assoc($query))
			{
				echo '<option value="'.$data["SAL_NumSalarie"].'">'.$data["PER_Nom"].' '.$data["PER_Prenom"].'</option>';
			}
		}
		else{
			echo '<option value="0" selected="selected" disabled="disabled">Aucune donnée, une erreure s\'est produite</option>';
		}
	}

	function checkJourFerie(){
		if(isset($_POST["MondayDate"]) && !empty($_POST["MondayDate"]))
		{
			$tabJoursFeries = [];
			for($x=0; $x<5; $x++){
				$tabJoursFeries[$x] = isJourFerie(date("d/m/Y", strtotime($_POST["MondayDate"]." + ".$x." day")));
			}

			$jsonTab = json_encode($tabJoursFeries);
			echo $jsonTab;
		}
		else{
			$jsonTab = json_encode([false, false, false, false, false]);
			echo $jsonTab;
		}
	}
?>