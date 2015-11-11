<?php
	$pwd='../';
	include($pwd."bandeau.php");

	$plannings = mysqli_query($db, "SELECT DISTINCT PL_id, ASSOC_Date FROM pl_association;");
	while($donnees = mysqli_fetch_assoc($plannings)){

		switch($donnees["PL_id"])
		{
			case 1:
				mysqli_query($db, "INSERT INTO pl_proprietees (PL_id, ASSOC_Date, ASSOC_Couleur) VALUES (1, '".$donnees["ASSOC_Date"]."', '#005fbf');");
				break;

			case 2:
				mysqli_query($db, "INSERT INTO pl_proprietees (PL_id, ASSOC_Date, ASSOC_Couleur) VALUES (2, '".$donnees["ASSOC_Date"]."', '#228B22');");
				break;

			case 3:
				mysqli_query($db, "INSERT INTO pl_proprietees (PL_id, ASSOC_Date, ASSOC_Couleur) VALUES (3, '".$donnees["ASSOC_Date"]."', '#e6c860');");
				break;
		}
	}
?>