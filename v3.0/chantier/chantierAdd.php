<?php
$pageTitle = "Detail Chantier";
$pwd='../';
	include('../bandeau.php');
?>
    <link rel="stylesheet" href="../css/jquery-ui.css">
    <script src="http://code.jquery.com/ui/1.11.1/jquery-ui.js"></script>
    <div id="corps">
<?php

  $j=0;
  if (isset($_POST["Member"])&&isset($_POST["Date"])&&isset($_POST["Debut"])) {
  	foreach($_POST["Member"] AS $numMb){
  		$mem[$j] = $numMb;
  		$j++;
  	}
  	$max = $j;
  	$j=0;
  	foreach($_POST["Date"] AS $numJr){
  		$date[$j] = $numJr;
  		$j++;
  	}
  	$j=0;
  	foreach($_POST["Debut"] AS $numHr){
  		$heure[$j] = $numHr;
  		$j++;
  	}
  }
  
  
  if (isset($_POST["Resp"])) {
  	$resp=$_POST["Resp"];
  }
  $num=intval($_POST["NumC"]);
  //$mem=$_POST["Member"];
  //$date=$_POST["Date"];
  //$deb=$_POST["Debut"];
  date_default_timezone_set('Europe/Paris');
  $dateNow = date('Y-m-d H:i:s', time());
  if (isset($_POST["EtatA"])) {
  	$etat=$_POST["EtatA"];
  } 
  if (isset($_POST["DateFin"])) {
  	$dfin=$_POST["DateFin"];
  }

// Ajout responsable
  if(isset($resp)){

  	$query = "INSERT INTO Encadrer (CHA_NumDevis, SAL_NumSalarie) VALUES ('$num', '$resp')";

    $sql = mysqli_query($db, $query);
    $errr=mysqli_error($db);

      if($sql){
          echo '<div id="good">     
              <label>Responsable ajouté avec succès</label>
              </div>';
      }
      else{
        echo '<div id="bad">     
              <label>Le Responsable n\'a pas pu être ajouté</label>
              </div>';
      }
  }

// Ajout tps de travail
    if(isset($mem[0])){
	//$i = 0;
		for($i = 0; $i < $max; $i++){
			$query2 = "INSERT INTO TempsTravail (TRA_Date, TRA_Duree, CHA_NumDevis, SAL_NumSalarie) VALUES ('$date[$i]','$heure[$i]', '$num', '$mem[$i]')";
			
			    $sql2 = mysqli_query($db, $query2);
			    $errr2=mysqli_error($db);
			
			      if($sql2){
			          echo '<div id="good">     
			              <label>Travail ajouté avec succès</label>
			              </div>';
			      }
			      else{
			        echo '<div id="bad">     
			              <label>Le temps de travail n\'a pas pu être ajouté</label>
			              </div>';
			      }
			//$i++;
		}
    }
// Changement d etat
    if (isset($etat)) {
    	$query3 = "INSERT INTO Etat (ETA_Date, CHA_NumDevis, TYE_Id) VALUES ('$dateNow', '$num', '$etat')";
    	
    	$sql3 = mysqli_query($db, $query3);
    	$errr3 = mysqli_error($db);
    	
    	if ($dfin!="") {
    		$query4 = "UPDATE Chantiers SET CHA_DateFinReel = '$dfin' WHERE CHA_NumDevis = '$num'";
    		
    		$sql4 = mysqli_query($db, $query4);
    		$errr4 = mysqli_error($db);
    	}
      else if($etat==5){
        $query4 ="UPDATE Chantiers SET CHA_DateFinReel = CHA_DateDebut WHERE CHA_NumDevis = '$num'";
        $sql4 = mysqli_query($db, $query4);
        $errr4 = mysqli_error($db);
      }
    	
    	if($sql3){
    	    echo '<div id="good">     
    	        <label>Etat changé avec succès</label>
    	        </div>';
    	}
    	else{
    	  echo '<div id="bad">     
    	        <label>L\'état n\'a pas pu être changé</label>
    	        </div>';
    	}
    }
?>
<?php
  $Workers = array(" ");
  $Ids = array(" ");
	//CREATE OR REPLACE VIEW ChantierEtat AS SELECT CHA_NumDevis as NumDevis, TYE_Nom as Etat, TYE_Id as Id FROM Chantiers JOIN Etat USING (CHA_NumDevis) JOIN TypeEtat USING (TYE_Id) ORDER BY TYE_Id DESC LIMIT 1;
  $reponse = mysqli_query($db, "SELECT * FROM Chantiers ch JOIN ChantierClient vcl ON ch.CHA_NumDevis=vcl.CNumDevis LEFT JOIN ChantierResp vre ON ch.CHA_NumDevis=vre.RNumDevis LEFT JOIN ChantierEtat cet ON ch.CHA_NumDevis=NumDevis WHERE ch.CHA_NumDevis='$num' limit 1");
  $donnees = mysqli_fetch_assoc($reponse);
  include("formChantier.php");
?>