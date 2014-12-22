<!DOCTYPE html>
<html>

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<title>Intranet association Revivre</title>
		<!-- V. Durand | A. Freret | P. Friboulet | J. Le Bas | IUT Caen - DUT Info (2013-2015) -->
	</head>

	<body>
<?php
ini_set('default_charset', 'UTF-8');

// Rm accents - http://www.weirdog.com/blog/php/supprimer-les-accents-des-caracteres-accentues.html
function noAccents($str, $charset='utf-8')
{
	$str = htmlentities($str, ENT_NOQUOTES, $charset);

	$str = preg_replace('#&([A-za-z])(?:acute|cedil|caron|circ|grave|orn|ring|slash|th|tilde|uml);#', '\1', $str);
	$str = preg_replace('#&([A-za-z]{2})(?:lig);#', '\1', $str); // pour les ligatures e.g. '&oelig;'
	$str = preg_replace('#&[^;]+;#', '', $str); // supprime les autres caractères

	return $str;
}

// Retire les accents des premieres lettre de chaque mot
function firstNoAccent($a)
{
	$b = explode (" ", $a);
	$d=" ";
	$i=0;
	foreach($b as $key => $val){
		$d = $d.noAccents(mb_substr($val, 0, 1, 'UTF-8')).mb_substr($val, 1, mb_strlen($val), 'UTF-8');
		$d = $d." ";
	}
	$b = explode ("-", trim($d));
	$d=" ";
	$i=0;
	foreach($b as $key => $val){
		$d = $d.noAccents(mb_substr($val, 0, 1, 'UTF-8')).mb_substr($val, 1, mb_strlen($val), 'UTF-8');
		$d = $d."-";
	}
	return trim($d, "- ");
}

// formatage du nom
function allCap($nom)
{
	return strtoupper(noAccents(trim($nom)));
}

// formatage du prenom
function firstMaj($prenom)
{
	return mb_convert_case(trim(firstNoAccent($prenom)), MB_CASE_TITLE, "UTF-8");
}

function revivre()
{
	if($db = MySQLi_connect("localhost","Kephaaa",'pfudorrr', "Revivre-Back", 0, '/media/fd0b1/alx22/private/mysql/socket'))
		return $db;
	else
		echo 'Erreur';
}

// SELECT * FROM `contacts` WHERE Categorie like 'Revi%'
$db = revivre();
mysqli_set_charset($db,"utf8");
$i = 213;
$j = 92;
$stuff = "Clie%";
$sorter = "Categorie";
$reponse = mysqli_query($db, "SELECT * FROM contacts WHERE $sorter like '$stuff' AND Stucture is not null");
while ($donnees = mysqli_fetch_assoc($reponse))
{
	if($donnees['TEL Standart']=="")
	{
		$tel = $donnees['TEL Bureau'];
	}
	else
	{
		$tel = $donnees['TEL Standart'];
	}
    $struct = allCap($donnees['Stucture']);
	$nom = allCap($donnees['Nom']);
	$prenom = firstMaj($donnees['Prenom']);
	$port = $donnees['TEL Portable'];
	$fax = $donnees['Fax'];
	$mail = $donnees['E-mail'];
	$add = firstMaj($donnees['Adresse']);
	$cp = $donnees['CP'];
	$ville = allCap($donnees['Ville']);
	//$fct = firstMaj($donnees['Fonction']);
	echo $nom." ".$prenom." ".$add."<br>";
	$query = "INSERT INTO Personnes (PER_Num, PER_Nom, PER_Prenom, PER_TelFixe, PER_TelPort, PER_Fax, PER_Email, PER_Adresse, PER_CodePostal, PER_Ville) VALUES ('$i', '$nom', '$prenom', '$tel', '$port', '$fax', '$mail', '$add', '$cp', '$ville')";

	$sql = mysqli_query($db, $query);
	$errr=mysqli_error($db);
	if ($sql) {
		echo "<div>";
		echo "PERSONNE INSERT ";
		echo($i);
		echo "</div>";
		$query2 = "INSERT INTO Clients (CLI_NumClient, PER_Num, CLI_Structure) VALUES ('$j', '$i', '$struct')";

		$sql2 = mysqli_query($db, $query2);
		$errr2=mysqli_error($db);
		if ($sql2) {
			echo "<div>";
			echo "CLIENT INSERT ";
			echo($i);
			echo "</div>";
			$j++;
		}
		else {
			echo "<div>";
			echo "CLIENT FAIL ";
			echo($i);
			echo "</div>";
		}
	}
	else {
		echo "<div>";
		echo "PERSONNE FAIL ";
		echo($i);
		echo "</div>";
	}
	$i++;
}
mysqli_free_result($reponse);

?>
</body>