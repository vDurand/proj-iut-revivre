<?php
$pwd='../';
	include('../bandeau.php');
?>
    <div id="corps">
<?php
// Creation d un chantier
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

	$query = "INSERT INTO Chantiers (CHA_DateDebut, CHA_Intitule, CHA_Echeance, CHA_MontantPrev, CHA_AchatsPrev, CHA_HeuresPrev, CHA_Adresse, CHA_TVA, CHA_TxHoraire) VALUES ('$ddebut', '$nom', '$echeance', '$montantp', '$achatp', '$heurep', '$add', '$tva', '$txh')";

  $sql = mysqli_query($db, $query);
  $errr=mysqli_error($db);

    if($sql){
      $numberQuery = mysqli_query($db, "SELECT * FROM Chantiers WHERE CHA_DateDebut='$ddebut' AND CHA_Intitule = '$nom' AND CHA_Echeance = '$echeance' AND CHA_MontantPrev = '$montantp'");
      $numberRep = mysqli_fetch_assoc($numberQuery);
      $realNumber = $numberRep['CHA_NumDevis'];

      $query2 = "INSERT INTO Commanditer (CLI_NumClient, CHA_NumDevis) VALUES ('$client', '$realNumber')";
      
      $sql2 = mysqli_query($db, $query2);
      $errr2 = mysqli_error($db);

      if($sql2){
      	$query3 = "INSERT INTO Etat (ETA_Date, CHA_NumDevis, TYE_Id) VALUES ('$dateNow', '$realNumber', 1)";
      	
      	$sql3 = mysqli_query($db, $query3);
      	$errr3 = mysqli_error($db);
      	
      	$query4 = "INSERT INTO Encadrer (CHA_NumDevis, SAL_NumSalarie) VALUES ('$realNumber', '$resp')";
      	
      	$sql4 = mysqli_query($db, $query4);
      	$errr4=mysqli_error($db);
      	
      	if($sql3){
	        echo '<div id="good">     
	            <label>Chantier ajouté avec succès</label>
	            </div>';
?>
  <br>
<?php
	      echo '<script language="Javascript">
	      <!--
	      document.location.replace("detailChantier.php?NumC='.$realNumber.'");
	      // -->
	      </script>';
	      }
	      else{
	        echo '<div id="bad">     
	              <label>Le chantier n\'a pas pu être ajouté</label>
	              </div>';
	      }
	            mysqli_free_result($reponse);
	    }
	    else{
	      echo '<div id="bad">     
	            <label>Le chantier n\'a pas pu être ajouté</label>
	            </div>';
	    }
	    
    }
    else{
      echo '<div id="bad">     
            <label>Le chantier n\'a pas pu être ajouté</label>
            </div>';
    }
?>
  </div>
<?php  
	include('../footer.php');
?>