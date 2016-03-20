<?php
	$pageTitle = "Table Adapter 2";
	$pwd='../';
	include($pwd."bandeau.php");
?>
<div id="corps">
<?php
	//mysqli_query($db, 'SET autocommit=0;');
	//mysqli_query($db, 'START TRANSACTION;');

	$query = mysqli_query($db, "SELECT CLI_NumClient, PER_Num, PER_Nom, PER_Prenom, PER_TelFixe, PER_TelPort, PER_Fax, PER_Email, PER_Adresse, PER_CodePostal, PER_Ville, PER_DateN, PER_LieuN, PER_Nation, PER_NPoleEmp, PER_NSecu, PER_NCaf FROM Clients JOIN EmployerClient USING(CLI_NumClient) JOIN personnes USING(PER_Num) WHERE CLI_Nom IS NULL;");
	$d = mysqli_fetch_all($query, MYSQLI_ASSOC);

	echo mysqli_num_rows($query);


	for($x=0; $x<sizeof($d); $x++){
		$query2 = mysqli_query($db, "UPDATE clients SET CLI_Nom = '".$d[$x]["PER_Nom"]."',
														CLI_Prenom = '".$d[$x]["PER_Prenom"]."',
														CLI_Adresse = '".$d[$x]["PER_Adresse"]."',
														CLI_CodePostal = ".$d[$x]["PER_CodePostal"].",
														CLI_Ville = '".$d[$x]["PER_Ville"]."',
														CLI_Telephone = '".$d[$x]["PER_TelFixe"]."',
														CLI_Portable = '".$d[$x]["PER_TelPort"]."',
														CLI_Fax = '".$d[$x]["PER_Fax"]."'
														WHERE CLI_NumClient = ".$d[$x]["CLI_NumClient"].";");
		if(!$query2){
			echo "<br/>".mysqli_error($db);
		}
	}

	for($x=0; $x<sizeof($d); $x++){
		$query3 = mysqli_query($db, "DELETE FROM EmployerClient WHERE CLI_NumClient = ".$d[$x]["CLI_NumClient"].";");
		if(!$query3){
			echo "<br/>".mysqli_error($db);
		}
	}

	for($x=0; $x<sizeof($d); $x++){
		$query4 = mysqli_query($db, "DELETE FROM personnes WHERE PER_Num = ".$d[$x]["PER_Num"].";");
		if(!$query4){
			echo "<br/>".mysqli_error($db);
		}
	}

?>
</div>
<?php
	include($pwd."footer.php");
?>