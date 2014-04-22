<?php

	if($db = MySQLi_connect("localhost","Kepha",'pfudor', 'Revivre', 0, '/media/sds1/home/alx22/private/mysql/socket'))
		echo 'Reussi';
	else
		echo 'Erreur';

  $nom=$_POST["Nom"];
  $prenom=$_POST["Prenom"];
  $tel=$_POST["Tel_Fixe"];
  $port=$_POST["Portable"];
  $fax=$_POST["Fax"];
  $email=$_POST["Email"];
  $add=$_POST["Adresse"];
  $cp=$_POST["Code_Postal"];
  $ville=$_POST["Ville"];

	$query = "INSERT INTO Clients (CLI_NumClient, CLI_Nom, CLI_Prenom, CLI_TelFixe, CLI_TelPort, CLI_Fax, CLI_Email, CLI_Adresse, CLI_CodePostal, CLI_Ville) VALUES (NULL, '$nom', '$prenom', '$tel', '$port', '$fax', '$email', '$add', '$cp', '$ville')";

  $sql = mysqli_query($db, $query);
  $errr=mysqli_error($db);

    if($sql)                  
      {echo 'ajoute';}
    else
      {echo 'Erreur dans la requête SQL<br/>';
  echo $errr;}

	?>