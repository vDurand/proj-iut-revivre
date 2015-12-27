<?php
	$pwd='../';
	include($pwd."bandeau.php");

	$plannings = mysqli_query($db, "SELECT DISTINCT PL_id, ASSOC_Date, ENC_Num FROM pl_association JOIN typeplanning USING(PL_id) ORDER BY PL_id;");
	while($donnees = mysqli_fetch_assoc($plannings)){
		
		$query = mysqli_query($db, "INSERT INTO pl_proprietees VALUES (".$donnees["ENC_Num"].",
																		'".$donnees["ASSOC_Date"]."',
																		".$donnees["PL_id"].",
																		'".$donnees["PL_Couleur"]."',
																		'".$donnees["PL_AM"]."',
																		'".$donnees["PL_PM"]."',
																		'".$donnees["ASSOC_Date"]."');");
		
		$query = mysqli_query($db, "INSERT INTO pl_logo VALUES (1, ".$donnees["ENC_Num"].", '".$donnees["ASSOC_Date"]."', ".$donnees["PL_id"].");");
		$query = mysqli_query($db, "INSERT INTO pl_logo VALUES (2, ".$donnees["ENC_Num"].", '".$donnees["ASSOC_Date"]."', ".$donnees["PL_id"].");");
		$query = mysqli_query($db, "INSERT INTO pl_logo VALUES (3, ".$donnees["ENC_Num"].", '".$donnees["ASSOC_Date"]."', ".$donnees["PL_id"].");");

		if(!$query){
			echo mysqli_error($db)."<br/>";
		}
	}
?>