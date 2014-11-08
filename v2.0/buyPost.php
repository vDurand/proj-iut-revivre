<?php  
    include('bandeau.php');
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
  if (isset($_POST["Produit"])) {
  	foreach($_POST["Produit"] AS $a){
  		$produits[$j] = $a;
  		$j++;
  	}
  	$max = $j;
  }
  // Nouveau produit
  $fournProd[0] = "";
  $j = 0;
  foreach($_POST["FournProd"] AS $a){
  	$fournProd[$j] = $a;
  	$j++;
  }
  if ($fournProd[0]!="") {
  	$max += $j;
  	$max1 = $j;
  	$j=0;
  	foreach($_POST["RefProd"] AS $a){
  		$refProd[$j] = $a;
  		$j++;
  	}
  	$j=0;
  	foreach($_POST["NomProd"] AS $a){
  		$nomProd[$j] = addslashes(mysqli_real_escape_string($db, formatLOW($a)));
  		$j++;
  	}
  	$j=0;
  	foreach($_POST["CondProd"] AS $a){
  		$condProd[$j] = addslashes(mysqli_real_escape_string($db, formatLOW($a)));
  		$j++;
  	}
  	$j=0;
  	foreach($_POST["PriceProd"] AS $a){
  		$priceProd[$j] = $a;
  		$j++;
  	}
  }
  // Gestion Achat
  $date[0] = "";
  if (isset($_POST["Quantite"])&&isset($_POST["Type"])&&isset($_POST["Date"])) {
  	$j=0;
  	foreach($_POST["Quantite"] AS $a){
  		$quantite[$j] = $a;
  		$j++;
  	}
  	$j=0;
  	foreach($_POST["Type"] AS $a){
  		$type[$j] = addslashes(mysqli_real_escape_string($db, formatLOW($a)));
  		$j++;
  	}
  	$j=0;
  	foreach($_POST["Date"] AS $a){
  		$date[$j] = $a;
  		$j++;
  	}
  }
  // Ajout des nouveaux produits
  if ($fournProd[0]!="") {
  	for ($i = 0; $i < $max1; $i++) {
  		$query1 = "INSERT INTO Produits (PRO_Ref, PRO_Conditionnement, PRO_Nom, PRO_Tarif, FOU_NumFournisseur) VALUES ('$refProd[$i]', '$condProd[$i]', '$nomProd[$i]', '$priceProd[$i]', '$fournProd[$i]');";
  		
  		    $sql1 = mysqli_query($db, $query1);
  		    $errr1=mysqli_error($db);
  		
  		      if($sql1){
  		          echo '<div id="good">     
  		              <label>Produit ajouté avec succès</label>
  		              </div>';
  		          $reponseP = mysqli_query($db, "SELECT PRO_Ref FROM Produits WHERE PRO_Ref like '$refProd[$i]'");
  		          $donneesP = mysqli_fetch_assoc($reponseP);
  		          if (isset($produits)) {
  		          	array_unshift($produits , $donneesP['PRO_Ref']);
  		          }
  		          else {
  		          	$produits[0] = $donneesP['PRO_Ref'];
  		          }
  		          mysqli_free_result($reponseP);
  		      }
  		      else{
  		        echo '<div id="bad">     
  		              <label>Le produit n\'a pas pu être ajouté</label>
  		              </div>';
  		      }
  	}
  }
  // Ajout des achats
  if ($date[0]!="") {
  	for ($i = 0; $i < $max; $i++) {
  		$query = "INSERT INTO Acheter (CHA_NumDevis, ACH_TypeAchat, ACH_Date, ACH_Quantite, ACH_NumAchat, PRO_Ref) VALUES ('$num', '$type[$i]', '$date[$i]', '$quantite[$i]', NULL, '$produits[$i]');";
  		
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