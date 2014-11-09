<?php  
    include('bandeau.php');
?>
    <link rel="stylesheet" href="css/jquery-ui.css">
    <script src="http://code.jquery.com/ui/1.11.1/jquery-ui.js"></script>
    <div id="corps">
<?php
// Modification d un chantier
  $id=$_POST["NumC"];		
  $nom=addslashes(mysqli_real_escape_string($db, formatLOW($_POST["Nom"])));
  $ddebut=addslashes($_POST["Debut"]);
  $montantp=addslashes($_POST["Montant_Prev"]);
  $achatp=addslashes($_POST["Achats_Prev"]);
  $heurep=addslashes($_POST["Heures_Prev"]);
  $echeance=addslashes($_POST["Fin_Max"]);
  date_default_timezone_set('Europe/Paris');
  
  $query = "UPDATE Chantiers SET CHA_Intitule = '$nom', CHA_DateDebut = '$ddebut', CHA_MontantPrev	 = '$montantp', CHA_AchatsPrev = '$achatp', CHA_HeuresPrev = '$heurep', CHA_Echeance = '$echeance' WHERE Chantiers.CHA_NumDevis = '$id'";
  
  $sql = mysqli_query($db, $query);
  $errr=mysqli_error($db);
  
  if($sql){
        echo '
		<div id="good">     
            <label>Chantier modifie avec succes</label>
            </div>
			';
  }
  else{
    echo '<div id="bad">     
          <label>Le chantier n a pas pu etre modifie</label>
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