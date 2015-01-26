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
	if($db = MySQLi_connect("localhost","Vlad",'pfudorr', "test", 0, '/media/fd0b1/alx22/private/mysql/socket'))
		return $db;
	else
		echo 'Erreur';
}

function revivre2()
{
    if($db = MySQLi_connect("localhost","Vlad",'pfudorr', "test2", 0, '/media/fd0b1/alx22/private/mysql/socket'))
        return $db;
    else
        echo 'Erreur';
}
function revivre3()
{
    if($db = MySQLi_connect("localhost","Vlad",'pfudorr', "Revivre-Back", 0, '/media/fd0b1/alx22/private/mysql/socket'))
        return $db;
    else
        echo 'Erreur';
}

// SELECT * FROM `contacts` WHERE Categorie like 'Revi%'
$db1 = revivre(); // source
$db2 = revivre2(); // cible
$db3 = revivre3(); // contact
mysqli_set_charset($db1,"utf8");
mysqli_set_charset($db2,"utf8");
mysqli_set_charset($db3,"utf8");
$i = 1;
$j = 1;
$k = 1;

/* ---------------- INSERTION DES FOURNISSEURS
$struct = "empty";
$reponse = mysqli_query($db1, "SELECT * FROM Fournisseurs JOIN Personnes USING(PER_Num) ORDER BY PER_Nom");
while ($donnees = mysqli_fetch_assoc($reponse))
{
	$nom = allCap($donnees['PER_Nom']);
	$port = $donnees['PER_TelPort'];
	$fax = $donnees['PER_Fax'];
	$mail = $donnees['PER_Email'];
	$add = firstMaj($donnees['PER_Adresse']);
	$cp = $donnees['PER_CodePostal'];
	$ville = allCap($donnees['PER_Ville']);
	$tel = firstMaj($donnees['PER_TelFixe']);
    $nper = $donnees['PER_Num'];
    $nfou = $donnees['FOU_NumFournisseur'];
    if(empty($cp)){
        $cp = "14000";
    }
    if(empty($ville)){
        $cp = "CAEN";
    }

    $query1 = "INSERT INTO Fournisseurs VALUES ($nfou, '$nom', '$add', '$cp', '$ville', '$tel', '$port', '$fax', '$mail')";
    $sql1 = mysqli_query($db2, $query1);
    if(!$sql1){echo"<br>ERROR FOURN STRUC ".$nfou."<br>";}
    //echo "<br>STRUC | ".$ncli." | ".$struct." | ".$add." | ".$cp." | ".$ville." | ".$tel." | ".$port." | ".$fax." | ".$mail."<br>";


}
mysqli_free_result($reponse);*/

/* -------------- INSERTION DES REFERENTS
$reponse = mysqli_query($db1, "SELECT * FROM Salaries JOIN Personnes USING(PER_Num) WHERE TYP_Id=3 ORDER BY PER_Nom");
while ($donnees = mysqli_fetch_assoc($reponse))
{
    $nom = allCap($donnees['PER_Nom']);
    $prenom = firstMaj($donnees['PER_Prenom']);
    $upprenom = allCap($donnees['PER_Prenom']);
    $port = $donnees['PER_TelPort'];
    $fax = $donnees['PER_Fax'];
    $mail = $donnees['PER_Email'];
    $add = firstMaj($donnees['PER_Adresse']);
    $cp = $donnees['PER_CodePostal'];
    $ville = allCap($donnees['PER_Ville']);
    $tel = firstMaj($donnees['PER_TelFixe']);
    $fct = $donnees['SAL_Fonction'];
    $nper = $donnees['PER_Num'];
    $nsal = $donnees['SAL_NumSalarie'];
    $types = $donnees['TYP_Id'];
    if(empty($cp)){
        $cp = "14000";
    }
    if(empty($ville)){
        $cp = "CAEN";
    }

//    $query2 = "SELECT UPPER(Stucture) FROM contacts WHERE UPPER(Nom) = '$nom' AND UPPER(Prenom) = '$upprenom'";
//    $reponse2 = mysqli_query($db3, $query2);
//    $donnees2 = mysqli_fetch_assoc($reponse2);
//    $presc = $donnees2['Stucture'];
//    mysqli_free_result($reponse2);
//    echo $presc;

    $query3 = "SELECT PRE_Id FROM Prescripteurs WHERE UPPER(PRE_Nom) = UPPER('$fct')";
    $reponse3 = mysqli_query($db2, $query3);
    $donnees3 = mysqli_fetch_assoc($reponse3);
    $npresc = $donnees3['PRE_Id'];
    mysqli_free_result($reponse3);
    echo $npresc;

    $query1 = "INSERT INTO Referents VALUES ('$nsal', '$nper', '$npresc')";
    $sql1 = mysqli_query($db2, $query1);
    if(!$sql1){echo"<br>ERROR SALARIE ".$nsal." - ".$nper."<br>";}
    $errr=mysqli_error($db2);echo $errr;

//    $query2 = "INSERT INTO Personnes VALUES ($nper, '$nom', '$prenom', '$tel', '$port', '$fax', '$mail', '$add', '$cp', '$ville')";
//    $sql2 = mysqli_query($db2, $query2);
//    if(!$sql2){echo"<br>ERROR PERSONNE ".$nper."<br>";}
    echo "<br>SAL | ".$nsal." | ".$nper." | ".$type." | ".$fctt." | ".$nom." | ".$prenom." | ".$tel." | ".$port." | ".$fax." | ".$mail." | ".$add." | ".$cp." | ".$ville."<br>";
}
mysqli_free_result($reponse);*/

/* ------------------ INSERTION DES SALARIES*/
$reponse = mysqli_query($db1, "SELECT * FROM Salaries JOIN Personnes USING(PER_Num) WHERE TYP_Id<>3 ORDER BY PER_Nom");
while ($donnees = mysqli_fetch_assoc($reponse))
{
    $nom = allCap($donnees['PER_Nom']);
    $prenom = firstMaj($donnees['PER_Prenom']);
    $port = $donnees['PER_TelPort'];
    $fax = $donnees['PER_Fax'];
    $mail = $donnees['PER_Email'];
    $add = firstMaj($donnees['PER_Adresse']);
    $cp = $donnees['PER_CodePostal'];
    $ville = allCap($donnees['PER_Ville']);
    $tel = firstMaj($donnees['PER_TelFixe']);
    $fct = $donnees['SAL_Fonction'];
    $nper = $donnees['PER_Num'];
    $nsal = $donnees['SAL_NumSalarie'];
    $types = $donnees['TYP_Id'];
    if(empty($cp)){
        $cp = "14000";
    }
    if(empty($ville)){
        $cp = "CAEN";
    }
    $query2 = "SELECT FCT_Id FROM Fonction WHERE UPPER(FCT_Nom) = UPPER('$fct')";
    $reponse2 = mysqli_query($db2, $query2);
    $donnees2 = mysqli_fetch_assoc($reponse2);
    $fctt = $donnees2['FCT_Id'];
    if(empty($fctt)){$fctt=29;}
    if($types > 6){$fctt=0;}
    mysqli_free_result($reponse2);
    //echo "sal : ".$nsal." | per : ".$nper." | type : ".$types." | fct : ".$fctt."<br>";
    $query1 = "INSERT INTO Salaries VALUES ('$nsal', '$nper', '$types', '1', '$fctt')";
    $sql1 = mysqli_query($db2, $query1);
    if(!$sql1){echo"<br>ERROR SALARIE ".$nsal." - ".$nper."<br>";}
    $errr=mysqli_error($db2);echo $errr;

    if($types > 6){
//        $query3 = "INSERT INTO Insertion VALUES ('$nsal', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1')";
//        $sql3 = mysqli_query($db2, $query3);
//        if(!$sql3){echo"<br>ERROR INSERTION ".$nsal."<br>";}
//        $errr=mysqli_error($db2);echo $errr;
    }

//    $query2 = "INSERT INTO Personnes VALUES ($nper, '$nom', '$prenom', '$tel', '$port', '$fax', '$mail', '$add', '$cp', '$ville')";
//    $sql2 = mysqli_query($db2, $query2);
//    if(!$sql2){echo"<br>ERROR PERSONNE ".$nper."<br>";}
//    echo "<br>SAL | ".$nsal." | ".$nper." | ".$type." | ".$fctt." | ".$nom." | ".$prenom." | ".$tel." | ".$port." | ".$fax." | ".$mail." | ".$add." | ".$cp." | ".$ville."<br>";
}
mysqli_free_result($reponse);

/* ---------------- INSERTION DES CLIENTS
$struct = "empty";
$reponse = mysqli_query($db1, "SELECT * FROM Clients JOIN Personnes USING(PER_Num) ORDER BY CLI_Structure");
while ($donnees = mysqli_fetch_assoc($reponse))
{
    $previous = $struct;
    $struct = addslashes(mysqli_real_escape_string($db1, allCap($donnees['CLI_Structure'])));
	$nom = allCap($donnees['PER_Nom']);
    $upprenom = allCap($donnees['PER_Prenom']);
	$prenom = firstMaj($donnees['PER_Prenom']);
	$port = $donnees['PER_TelPort'];
	$fax = $donnees['PER_Fax'];
	$mail = $donnees['PER_Email'];
	$add = firstMaj($donnees['PER_Adresse']);
	$cp = $donnees['PER_CodePostal'];
	$ville = allCap($donnees['PER_Ville']);
	$tel = firstMaj($donnees['PER_TelFixe']);
    $ncli = $donnees['CLI_NumClient'];
    $nper = $donnees['PER_Num'];
    if(empty($cp)){
        $cp = "14000";
    }
    if(empty($ville)){
        $cp = "CAEN";
    }

    if(!empty($struct)){
        if($struct != $previous){
            $query1 = "INSERT INTO Clients VALUES ($ncli, '$struct', '$add', '$cp', '$ville', '$tel', '$port', '$fax', '$mail')";
            $sql1 = mysqli_query($db2, $query1);
            if(!$sql1){echo"<br>ERROR CLIENT STRUC ".$ncli."<br>";}
            //echo "<br>STRUC | ".$ncli." | ".$struct." | ".$add." | ".$cp." | ".$ville." | ".$tel." | ".$port." | ".$fax." | ".$mail."<br>";
            $nstruc = $ncli;
        }
        if(!empty($nom)){
            $query2 = "SELECT Fonction FROM Contacts WHERE UPPER(Nom) = '$nom' AND UPPER(Prenom) = '$upprenom'";
            $reponse2 = mysqli_query($db3, $query2);
            $donnees2 = mysqli_fetch_assoc($reponse2);
            $fct = firstMaj($donnees2['Fonction']);
            mysqli_free_result($reponse2);

            $query3 = "INSERT INTO EmployerClient VALUES ($nstruc, $nper, '$fct')";
            $sql2 = mysqli_query($db2, $query3);
            if(!$sql2){echo"<br>ERROR EMPLOYE CLI ".$nstruc." - ".$nper."<br>";}
            //echo $nstruc." | ".$nper." | ".$fct." | ".$nom." | ".$prenom." | ".$tel." | ".$port." | ".$fax." | ".$mail." | ".$add." | ".$cp." | ".$ville."<br>";

            $query4 = "INSERT INTO Personnes VALUES ($nper, '$nom', '$prenom', '$tel', '$port', '$fax', '$mail', '$add', '$cp', '$ville')";
            $sql3 = mysqli_query($db2, $query4);
            if(!$sql3){echo"<br>ERROR EMPOYE PER ".$nper."<br>";}
        }
    }
    else{
        $query5 = "INSERT INTO Clients VALUES ($ncli, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL)";
        $sql5 = mysqli_query($db2, $query5);
        if(!$sql5){echo"<br>ERROR CLIENT PART ".$ncli."<br>";}

        $query6 = "INSERT INTO EmployerClient VALUES ($ncli, $nper, NULL)";
        $sql6 = mysqli_query($db2, $query6);
        if(!$sql6){echo"<br>ERROR PART CLI ".$ncli." - ".$nper."<br>";}

        $query7 = "INSERT INTO Personnes VALUES ($nper, '$nom', '$prenom', '$tel', '$port', '$fax', '$mail', '$add', '$cp', '$ville')";
        $sql7 = mysqli_query($db2, $query7);
        if(!$sql7){echo"<br>ERROR PART PER ".$nper."<br>";}

        //echo "<br>PART | ".$ncli." | ".$nper." | ".$nom." | ".$prenom." | ".$tel." | ".$port." | ".$fax." | ".$mail." | ".$add." | ".$cp." | ".$ville."<br>";
    }

}
mysqli_free_result($reponse);*/

?>
</body>