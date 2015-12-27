<?php
    session_set_cookie_params(0);
	session_start();
	include('../../../assets.php');
	$db = revivre();
	mysqli_query($db, "SET lc_time_names = 'fr_FR'");
	mysqli_query($db, "SET NAMES 'utf8'");

	if(isset($_POST["request_type"]) && !empty($_POST["request_type"])){

		switch($_POST["request_type"]){
			case "sal":
				getSalList($db);
				break;
			case "mois":
				getMonthList($db);
				break;
		}
	}
?>

<?php
	function getSalList($db){
		if(isset($_POST["mois"]) && !empty($_POST["mois"]) && isset($_POST["annee"]) && !empty($_POST["annee"]))
		{
			echo '<option value="0" disabled="disabled" selected="selected">Choisissez un salarié</option>';

			$query = mysqli_query($db, "SELECT DISTINCT sa.SAL_NumSalarie, PER_Nom, PER_Prenom FROM pl_association pl
										JOIN salaries sa ON sa.SAL_NumSalarie = pl.SAL_NumSalarie
										JOIN personnes USING (PER_Num)
										WHERE date_format(pl.ASSOC_date,'%m/%Y') = '".$_POST["mois"]."/".$_POST["annee"]."' ORDER BY PER_Nom, PER_Prenom;");

			while($data = mysqli_fetch_assoc($query))
			{
				echo '<option value="'.$data["SAL_NumSalarie"].'">'.$data["PER_Nom"]." ".$data["PER_Prenom"].'</option>';
			}
		}
		else{
			echo '<option value="0" selected="selected" disabled="disabled">Aucune donnée, une erreure s\'est produite</option>';
		}	
	}

	function getMonthList($db){
		if(isset($_POST["annee"]) && !empty($_POST["annee"]))
		{
			echo '<option value="0" disabled="disabled" selected="selected">Choisissez un mois</option>';

			$query = mysqli_query($db, "SELECT DISTINCT date_format(ASSOC_date,'%m') AS mois_num, date_format(ASSOC_date,'%M') AS mois_nom FROM pl_association
										WHERE date_format(ASSOC_date,'%Y') = ".$_POST["annee"]." AND ASSOC_Archi = 0 ORDER BY mois_num");
			while($data = mysqli_fetch_assoc($query))
			{
				echo '<option value="'.$data["mois_num"].'">'.ucwords($data["mois_nom"]).'</option>';
			}
		}
		else{
			echo '<option value="0" selected="selected" disabled="disabled">Aucune donnée, une erreure s\'est produite</option>';
		}	
	}
?>