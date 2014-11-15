<?php  
    include('bandeau.php');
    ?>
    <link rel="stylesheet" href="css/jquery-ui.css">
    <script src="http://code.jquery.com/ui/1.11.1/jquery-ui.js"></script>
    <div id="corps">
<?php
  $Workers = array(" ");
  $Ids = array(" ");

  $num=intval($_GET["NumC"]);
  if (is_numeric($_GET["NumC"]))
  {
  $reponse = mysqli_query($db, "SELECT * FROM Chantiers ch JOIN ChantierClient vcl ON ch.CHA_NumDevis=vcl.CNumDevis LEFT JOIN ChantierResp vre ON ch.CHA_NumDevis=vre.RNumDevis LEFT JOIN ChantierEtat cet ON ch.CHA_NumDevis=NumDevis WHERE ch.CHA_NumDevis='$num' limit 1");
  $donnees = mysqli_fetch_assoc($reponse);
  if ($donnees) {
    include("formChantier.php");
  } else {
    	echo "<div id='error'>ERROR : WRONG NUMBER</div>";
    }
    } else {
    	echo "<div id='error'>ERROR : NUMBER ONLY</div>";
    } ?>