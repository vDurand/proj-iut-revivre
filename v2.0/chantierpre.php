<?php  
    include('bandeau.php');
    ?>
    <div id="corps">
<?php
	if($db = MySQLi_connect("localhost","Kepha",'pfudor', 'Revivre', 0, '/media/sds1/home/alx22/private/mysql/socket'))
		echo '';
	else
		echo 'Erreur';

  $id=$_POST["NumC"];		
  $nom=strtoupper(addslashes($_POST["Nom"]));
  $num=strtoupper(addslashes($_POST["Num"]));
  $ddebut=strtoupper(addslashes($_POST["Debut"]));
  $montantp=strtoupper(addslashes($_POST["Montant_Prev"]));
  $achatp=strtoupper(addslashes($_POST["Achats_Prev"]));
  $heurep=strtoupper(addslashes($_POST["Heures_Prev"]));
  $echeance=strtoupper(addslashes($_POST["Fin_Max"]));
  date_default_timezone_set('France/Paris');
  
  $query = "UPDATE Chantiers SET CHA_Id = '$num', CHA_Intitule = '$nom', CHA_DateDebut = '$ddebut', CHA_MontantPrev	 = '$montantp', CHA_AchatsPrev = '$achatp', CHA_HeuresPrev = '$heurep', CHA_Echeance = '$echeance' WHERE Chantiers.CHA_NumDevis = '$id'";
  
  $sql = mysqli_query($db, $query);
  $errr=mysqli_error($db);
  
  if($sql){
        echo '
		<div id="good">     
            <label>Chantier modifie avec succes</label>
            </div>
			';
            $reponse = mysqli_query($db, "SELECT * FROM Chantiers ch JOIN ChantierClient vcl ON ch.CHA_NumDevis=vcl.CNumDevis LEFT JOIN ChantierResp vre ON ch.CHA_NumDevis=vre.RNumDevis LEFT JOIN ChantierEtat cet ON ch.CHA_NumDevis=NumDevis WHERE ch.CHA_NumDevis='$id' limit 1");
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
              <td style="text-align: center; width: 250px;"><?php echo $donnees['CHA_Intitule']; ?></td>
            </tr>
            <tr>
              <th style="text-align: left; width: 150px; white-space: normal;">Date de Début:</th>
              <td style="text-align: center; width: 200px;"><?php echo dater($donnees['CHA_DateDebut']); ?></td>
            </tr>
            <tr>
              <th style="text-align: left; width: 150px; white-space: normal;">Echéance:</th>
              <td style="text-align: center; width: 200px;"><?php echo dater($donnees['CHA_Echeance']); ?></td>
            </tr>
            <?php
            if($donnees['CHA_DateFinReel']!=NULL){
            ?>
            <tr>
              <th style="text-align: left; width: 150px; white-space: normal;">Fin:</th>
              <td style="text-align: center; width: 200px;"><?php echo dater($donnees['CHA_DateFinReel']); ?></td>
            </tr>
            <?php
            }
            ?>
            <tr>
              <th style="text-align: left; width: 150px; white-space: normal;">Etat du Devis:</th>
              <td style="text-align: center; width: 200px;"><?php echo $donnees['Etat']; ?></td>
            </tr>
            <tr>
              <th style="text-align: left; width: 150px; white-space: normal;">Montant Prévu:</th>
              <td style="text-align: center; width: 200px;"><?php echo $donnees['CHA_MontantPrev']; ?> &euro;</td>
            </tr>
			<tr>
              <th style="text-align: left; width: 150px; white-space: normal;">Achats Prévus:</th>
              <td style="text-align: center; width: 200px;"><?php echo $donnees['CHA_AchatsPrev']; ?> &euro;</td>
            </tr>
			<tr>
              <th style="text-align: left; width: 150px; white-space: normal;">Heures Prévues:</th>
              <td style="text-align: center; width: 200px;"><?php echo $donnees['CHA_HeuresPrev']; ?></td>
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
              <td style="text-align: center; width: 200px;"><A HREF="mailto:<?php echo $donnees['ClientEmail'];?>"> <?php echo $donnees['ClientEmail']; ?></A></td>
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
      }
      else{
        echo '<div id="bad">     
              <label>Le chantier n a pas pu etre modifie</label>
              </div>';
            }
            mysqli_free_result($reponse);
  ?>
  </div>
  <?php  
    include('footer.php');
    ?>