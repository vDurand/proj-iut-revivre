<?php  
	include('bandeau.php');
?>
    <div id="corps">
<?php
// Ajout responsable
  $resp=$_POST["Resp"];
  $num=$_POST["NumC"];
  $mem=$_POST["Member"];
  $date=$_POST["Date"];
  $deb=$_POST["Debut"];
  $fin=$_POST["Fin"];
  date_default_timezone_set('France/Paris');
  $dateNow = date('Y-m-d H:i:s', time());
  $etat=$_POST["EtatA"];
  $dfin=$_POST["DateFin"];

  if($resp!=""){

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
  $reponse = mysqli_query($db, "SELECT * FROM Chantiers ch JOIN ChantierClient vcl ON ch.CHA_NumDevis=vcl.CNumDevis LEFT JOIN ChantierResp vre ON ch.CHA_NumDevis=vre.RNumDevis WHERE ch.CHA_NumDevis='$num'");
    
  $donnees = mysqli_fetch_assoc($reponse);
?>
  <br>
  <table>
  <td>
  <table cellpadding="10" class="submitClients">
    <tr>
      <th style="text-align: left; width: 150px; white-space: normal;">Numéro de Devis:</th>
      <td style="text-align: center; width: 200px;"><?php echo $donnees['CHA_Id']; ?></td>
    </tr>
    <tr>
      <th style="text-align: left; width: 150px; white-space: normal;">Nom du Chantier:</th>
      <td style="text-align: center; width: 200px;"><?php echo $donnees['CHA_Intitule']; ?></td>
    </tr>
    <tr>
      <th style="text-align: left; width: 150px; white-space: normal;">Date de Début:</th>
      <td style="text-align: center; width: 200px;"><?php echo $donnees['CHA_DateDebut']; ?></td>
    </tr>
    <tr>
      <th style="text-align: left; width: 150px; white-space: normal;">Echéance:</th>
      <td style="text-align: center; width: 200px;"><?php echo $donnees['CHA_Echeance']; ?></td>
    </tr>
    <tr>
      <th style="text-align: left; width: 150px; white-space: normal;">Montant Prévu:</th>
      <td style="text-align: center; width: 200px;"><?php echo $donnees['CHA_MontantPrev']; ?> &euro;</td>
    </tr>
    <tr>
      <th style="text-align: left; width: 150px; white-space: normal;">Responsable:</th>
      <td style="text-align: center; width: 200px;"><?php echo $donnees['Resp']; ?> <?php echo $donnees['RespP']; ?></td>
    </tr>
  </table>
</td>
<td>
  <table cellpadding="10" class="submitClients">
    <tr>
      <th style="text-align: left; width: 150px; white-space: normal;">Nom Client:</th>
      <td style="text-align: center; width: 200px;"><?php echo $donnees['Client']; ?></td>
    </tr>
    <tr>
      <th style="text-align: left; width: 150px; white-space: normal;">Prénom Client:</th>
      <td style="text-align: center; width: 200px;"><?php echo $donnees['ClientP']; ?></td>
    </tr>
    <tr>
      <th style="text-align: left; width: 150px; white-space: normal;">Tél Fixe :</th>
      <td style="text-align: center; width: 200px;"><?php echo $donnees['ClientTel']; ?></td>
    </tr>
    <tr>
      <th style="text-align: left; width: 150px; white-space: normal;">Email :</th>
      <td style="text-align: center; width: 200px;"><?php echo $donnees['ClientEmail']; ?></td>
    </tr>
    <tr>
      <th style="text-align: left; width: 150px; white-space: normal;">Adresse :</th>
      <td style="text-align: center; width: 200px;"><?php echo $donnees['ClientAd']; ?></td>
    </tr>
    <tr>
      <th style="text-align: left; width: 150px; white-space: normal;">Ville :</th>
      <td style="text-align: center; width: 200px;"><?php echo $donnees['ClientV']; ?>, <?php echo $donnees['ClientCP']; ?></td>
    </tr>
  </table>
</td>
</table>
<?php
    mysqli_free_result($reponse);
// Ajout tps de travail
    if($mem!=""){

    $query2 = "INSERT INTO TempsTravail (TRA_Date, TRA_Debut, TRA_Fin, CHA_NumDevis, SAL_NumSalarie) VALUES ('$date','$deb', '$fin', '$num', '$mem')";

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
    }
// Changement d etat
    if ($etat!="") {
    	$query3 = "INSERT INTO Etat (ETA_Date, CHA_NumDevis, TYE_Id) VALUES ('$dateNow', '$num', '$etat')";
    	
    	$sql3 = mysqli_query($db, $query3);
    	$errr3 = mysqli_error($db);
    	
    	if ($dfin!="") {
    		$query4 = "UPDATE Chantiers SET CHA_DateFinReel = '$dfin' WHERE CHA_NumDevis = '$num'";
    		
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
  </div>
 <?php  
	include('footer.php');
?>