<?php
$pageTitle = "Detail Chantier";
$pwd = '../';
include('../bandeau.php');
?>
    <link rel="stylesheet" href="../css/jquery-ui.css">
    <script src="http://code.jquery.com/ui/1.11.1/jquery-ui.js"></script>
    <div id="corps">
<?php
  $num = $_POST["NumC"];
  $fourn = addslashes($_POST['fourn']);
  $type = addslashes($_POST['type']);
  $montant = addslashes($_POST['montant']);
  $date = addslashes($_POST['date']);

  $query = "UPDATE Acheter SET ACH_Date='$date', FOU_NumFournisseur='$fourn', ACH_Montant='$montant', TAC_Id='$type'
            WHERE ACH_NumAchat='$num'";
  $sql = mysqli_query($db, $query);
  $errr = mysqli_error($db);

      if ($sql) {
          echo '<div id="good">
  		        <label>Achat édité avec succès</label>
  		        </div>';
      } else {
          echo '<div id="bad">
  		         <label>L\'achat n\'a pas pu être édité</label>
  		         </div>';
      }
  $sql2 = mysqli_query($db, "SELECT CHA_NumDevis FROM Acheter WHERE ACH_NumAchat ='$num'");
  $donnees = mysqli_fetch_assoc($sql2);
  $num = $donnees['CHA_NumDevis'];

  //CREATE OR REPLACE VIEW ChantierEtat AS SELECT CHA_NumDevis as NumDevis, TYE_Nom as Etat, TYE_Id as Id FROM Chantiers JOIN Etat USING (CHA_NumDevis) JOIN TypeEtat USING (TYE_Id) ORDER BY TYE_Id DESC LIMIT 1;
  $reponse = mysqli_query($db, "SELECT * FROM Chantiers ch JOIN ChantierClient vcl ON ch.CHA_NumDevis=vcl.CNumDevis LEFT JOIN ChantierResp vre ON ch.CHA_NumDevis=vre.RNumDevis LEFT JOIN ChantierEtat cet ON ch.CHA_NumDevis=NumDevis WHERE ch.CHA_NumDevis='$num' limit 1");
  $donnees = mysqli_fetch_assoc($reponse);
  include("formChantier.php");
?>