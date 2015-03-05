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
  $num = $_POST["NumTemps"];
  $membre = addslashes($_POST['membre']);
  $temps = addslashes($_POST['temps']);
  $date = addslashes($_POST['date']);

if (isset($_POST["submit"])) {
    $query = "UPDATE TempsTravail SET SAL_NumSalarie='$membre', TRA_Duree='$temps',TRA_Date='$date'
            WHERE TRA_NumTravail='$num'";
    $sql = mysqli_query($db, $query);
    $errr = mysqli_error($db);

    if ($sql) {
        echo '<div id="good">
  		        <label>Temps édité avec succès</label>
  		        </div>';
    } else {
        echo '<div id="bad">
  		         <label>Le temps n\'a pas pu être édité</label>
  		         </div>';
    }
}

if (isset($_POST["delete"])) {
    $query = "DELETE FROM TempsTravail WHERE TRA_NumTravail='$num'";
    $sql = mysqli_query($db, $query);
    $errr = mysqli_error($db);

    if ($sql) {
        echo '<div id="good">
  		        <label>Temps supprimé avec succès</label>
  		        </div>';
    } else {
        echo '<div id="bad">
  		         <label>Le temps n\'a pas pu être supprimé</label>
  		         </div>';
    }
}

  //CREATE OR REPLACE VIEW ChantierEtat AS SELECT CHA_NumDevis as NumDevis, TYE_Nom as Etat, TYE_Id as Id FROM Chantiers JOIN Etat USING (CHA_NumDevis) JOIN TypeEtat USING (TYE_Id) ORDER BY TYE_Id DESC LIMIT 1;
  $reponse = mysqli_query($db, "SELECT * FROM Chantiers ch JOIN ChantierClient vcl ON ch.CHA_NumDevis=vcl.CNumDevis LEFT JOIN ChantierResp vre ON ch.CHA_NumDevis=vre.RNumDevis LEFT JOIN ChantierEtat cet ON ch.CHA_NumDevis=NumDevis WHERE ch.CHA_NumDevis='$num' limit 1");
  $donnees = mysqli_fetch_assoc($reponse);
  include("formChantier.php");
?>