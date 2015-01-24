<?php
$pageTitle = "Detail Chantier";
$pwd='../';
    include('../bandeau.php');
    ?>
    <link rel="stylesheet" href="css/jquery-ui.css">
    <script src="http://code.jquery.com/ui/1.11.1/jquery-ui.js"></script>
    <div id="corps">
<?php
  $Workers = array(" ");
  $Ids = array(" ");

  $num=$_POST["NumC"];
  $max = 0;
  $max1 = 0;
  
  $j=0;
  // Produit existant
  if (isset($_POST["Fourn"])) {
  	foreach($_POST["Fourn"] AS $a){
        $Fourns[$j] = $a;
  		$j++;
  	}
  	$max = $j;
  }

  // Gestion Achat
  $date[0] = "";
  if (isset($_POST["Montant"])&&isset($_POST["Type"])&&isset($_POST["Date"])) {
  	$j=0;
  	foreach($_POST["Montant"] AS $a){
  		$montant[$j] = $a;
  		$j++;
  	}
  	$j=0;
  	foreach($_POST["Type"] AS $a){
  		$type[$j] = $a;
  		$j++;
  	}
  	$j=0;
  	foreach($_POST["Date"] AS $a){
  		$date[$j] = $a;
  		$j++;
  	}
  }

  // Ajout des achats
  if ($date[0]!="") {
  	for ($i = 0; $i < $max; $i++) {
  		$query = "INSERT INTO Acheter (CHA_NumDevis, TAC_Id, ACH_Date, ACH_Montant, ACH_NumAchat, FOU_NumFournisseur) VALUES ('$num', '$type[$i]', '$date[$i]', '$montant[$i]', NULL, '$Fourns[$i]');";
  		
  		    $sql = mysqli_query($db, $query);
  		    $errr=mysqli_error($db);
  		
  		      if($sql){
  		          echo '<div id="good">     
  		              <label>Achat ajouté avec succès</label>
  		              </div>';
  		      }
  		      else{
  		        echo '<div id="bad">     
  		              <label>L\'achat n\'a pas pu être ajouté</label>
  		              </div>';
  		      }
  	}
  }
  
  
	//CREATE OR REPLACE VIEW ChantierEtat AS SELECT CHA_NumDevis as NumDevis, TYE_Nom as Etat, TYE_Id as Id FROM Chantiers JOIN Etat USING (CHA_NumDevis) JOIN TypeEtat USING (TYE_Id) ORDER BY TYE_Id DESC LIMIT 1;
  $reponse = mysqli_query($db, "SELECT * FROM Chantiers ch JOIN ChantierClient vcl ON ch.CHA_NumDevis=vcl.CNumDevis LEFT JOIN ChantierResp vre ON ch.CHA_NumDevis=vre.RNumDevis LEFT JOIN ChantierEtat cet ON ch.CHA_NumDevis=NumDevis WHERE ch.CHA_NumDevis='$num' limit 1");
  $donnees = mysqli_fetch_assoc($reponse);
  include("formChantier.php");
?>