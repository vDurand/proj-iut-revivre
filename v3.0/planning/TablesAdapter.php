<?php
	$pwd='../';
	include($pwd."bandeau.php");

	$plannings = mysqli_query($db, "SELECT DISTINCT PL_id, ASSOC_Date, ENC_Num FROM pl_association ORDER BY PL_id;");
	while($donnees = mysqli_fetch_assoc($plannings)){

		switch($donnees["PL_id"])
		{
			case 1:
				$query = mysqli_query($db, "INSERT INTO pl_proprietees VALUES (".$donnees["ENC_Num"].", '".$donnees["ASSOC_Date"]."', 1, '#005fbf', '08h00 - 12h00', '13h00 - 18h00', '".$donnees["ASSOC_Date"]."');");
				break;

			case 2:
				$query = mysqli_query($db, "INSERT INTO pl_proprietees VALUES (".$donnees["ENC_Num"].", '".$donnees["ASSOC_Date"]."', 2, '#228B22', '08h30 - 12h00', '13h00 - 16h30', '".$donnees["ASSOC_Date"]."');");
				break;

			case 3:
				$query = mysqli_query($db, "INSERT INTO pl_proprietees VALUES (".$donnees["ENC_Num"].", '".$donnees["ASSOC_Date"]."', 3, '#ddbc4b', '09h00 - 12h00', '13h00 - 15h00', '".$donnees["ASSOC_Date"]."');");
				break;
		}

		$query = mysqli_query($db, "INSERT INTO pl_logo VALUES (1, ".$donnees["ENC_Num"].", '".$donnees["ASSOC_Date"]."', ".$donnees["PL_id"].");");
		$query = mysqli_query($db, "INSERT INTO pl_logo VALUES (2, ".$donnees["ENC_Num"].", '".$donnees["ASSOC_Date"]."', ".$donnees["PL_id"].");");
		$query = mysqli_query($db, "INSERT INTO pl_logo VALUES (3, ".$donnees["ENC_Num"].", '".$donnees["ASSOC_Date"]."', ".$donnees["PL_id"].");");

		if(!$query){
			echo mysqli_error($db)."<br/>";
		}
	}
?>