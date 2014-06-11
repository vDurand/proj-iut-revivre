<?php  
    include('bandeau.php');
    ?>
    <div id="corps">
<?php
	if($db = MySQLi_connect("localhost","Kepha",'pfudor', 'Revivre', 0, '/media/sds1/home/alx22/private/mysql/socket'))
		echo '';
	else
		echo 'Erreur';

  $resp=strtoupper(addslashes($_POST["Resp"]));
  $num=strtoupper(addslashes($_POST["NumC"]));

	$query = "INSERT INTO Encadrer (CHA_NumDevis, SAL_NumSalarie) VALUES ('$num', '$resp')";

  $sql = mysqli_query($db, $query);
  $errr=mysqli_error($db);

    if($sql){
        echo '<div id="good">     
            <label>Responsable ajouté avec succès</label>
            </div>';
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
      }
      else{
        echo '<div id="bad">     
              <label>Le Responsable n\'a pas pu être ajouté</label>
              </div>';
            }
            mysqli_free_result($reponse);
    
  ?>
  </div>
  <?php  
    include('footer.php');
    ?>