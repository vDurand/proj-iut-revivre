<?php
$pageTitle = "Detail Chantier";
$pwd='../';
    include('../bandeau.php');
?>
    <link rel="stylesheet" href="../css/jquery-ui.css">
	<link rel="stylesheet" href="../css/print.css">
    <script src="http://code.jquery.com/ui/1.11.1/jquery-ui.js"></script>
    <div id="corps">
<?php
// Modification d un chantier
  $id=$_POST["NumC"];
  $client=$_POST["Client"];
  $nom=addslashes(mysqli_real_escape_string($db, formatLOW($_POST["Nom"])));
  $add=addslashes(mysqli_real_escape_string($db, formatLOW($_POST["Add"])));
  $ddebut=addslashes($_POST["Debut"]);
  $montantp=addslashes($_POST["Montant_Prev"]);
  $achatp=addslashes($_POST["Achats_Prev"]);
  $heurep=addslashes($_POST["Heures_Prev"]);
  $echeance=addslashes($_POST["Fin_Max"]);
  $resp=addslashes($_POST["Resp"]);
  $tva=addslashes($_POST["tva"]);
  $txh=addslashes($_POST["TxH"]);
  date_default_timezone_set('Europe/Paris');
  $dateNow = date('Y-m-d H:i:s', time());
  
  $query = "UPDATE Chantiers SET CHA_Intitule = '$nom', CHA_Adresse = '$add', CHA_DateDebut = '$ddebut', CHA_Echeance = '$echeance', CHA_MontantPrev = '$montantp', CHA_AchatsPrev = '$achatp', CHA_HeuresPrev = '$heurep', CHA_TVA = '$tva', CHA_TxHoraire = '$txh' WHERE CHA_NumDevis = '$id'";
  
  $sql = mysqli_query($db, $query);
  $errr= mysqli_error($db);
  
  if($sql){
	$query2 = "UPDATE Commanditer SET 
	CLI_NumClient = '$client'
	WHERE CHA_NumDevis = '$id'";
	  
	$sql2 = mysqli_query($db, $query2);
	$errr = mysqli_error($db);
	
		if($sql2){
		
			$query3 = "UPDATE Encadrer SET 
			SAL_NumSalarie = '$resp'
			WHERE CHA_NumDevis = '$id'";
	  
			$sql3 = mysqli_query($db, $query3);
			$errr = mysqli_error($db);
			
			if($sql3){
				echo '
				<div id="good">     
				<label>Chantier modifie avec succes</label>
				</div>
				';
			}
			else{
				echo '<div id="bad">     
				<label>Le chantier n a pas pu etre modifie3</label>
				</div>';
			}
			
		}
		else{
			echo '<div id="bad">     
			<label>Le chantier n a pas pu etre modifie2</label>
			</div>';
		}	
	}
	else{
		echo '<div id="bad">     
		<label>Le chantier n a pas pu etre modifie1</label>
        </div>';
	}
?>
<?php
  $Workers = array(" ");
  $Ids = array(" ");

  $num=$_POST["NumC"];
  $reponse = mysqli_query($db, "SELECT * FROM Chantiers ch JOIN ChantierClient vcl ON ch.CHA_NumDevis=vcl.CNumDevis LEFT JOIN ChantierResp vre ON ch.CHA_NumDevis=vre.RNumDevis LEFT JOIN ChantierEtat cet ON ch.CHA_NumDevis=NumDevis WHERE ch.CHA_NumDevis='$num' limit 1");
  $donnees = mysqli_fetch_assoc($reponse);
  include("formChantier.php");
?>