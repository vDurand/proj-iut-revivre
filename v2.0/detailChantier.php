<?php  
    include('bandeau.php');
    ?>
    <div id="corps">
<?php
	if($db = MySQLi_connect("localhost","Kepha",'pfudor', 'Revivre', 0, '/media/sds1/home/alx22/private/mysql/socket'))
		echo '';
	else
		echo 'Erreur';

  $num=$_POST["NumC"];

  $reponse = mysqli_query($db, "SELECT * FROM Chantiers ch JOIN Commanditer co ON co.CHA_NumDevis=ch.CHA_NumDevis JOIN Clients cl ON cl.CLI_NumClient=co.CLI_NumClient JOIN Personnes pe ON cl.PER_Num=pe.PER_Num WHERE ch.CHA_NumDevis='$num'");
  $donnees = mysqli_fetch_assoc($reponse);
  
	?>
      <div id="labelT">     
            <label>Detail du Chantier</label>
      </div>
      <br>
      <table id="fullTable" rules="all">
        <td>
          <table cellpadding="10" class="detailClients">
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
          </table>
        </td>
        <td>
          <table cellpadding="10" class="detailClients">
            <tr>
              <th style="text-align: left; width: 150px; white-space: normal;">Nom Client:</th>
              <td style="text-align: center; width: 200px;"><?php echo $donnees['PER_Nom']; ?></td>
            </tr>
            <tr>
              <th style="text-align: left; width: 150px; white-space: normal;">Tél Fixe :</th>
              <td style="text-align: center; width: 200px;"><?php echo $donnees['PER_TelFixe']; ?></td>
            </tr>
            <tr>
              <th style="text-align: left; width: 150px; white-space: normal;">Email :</th>
              <td style="text-align: center; width: 200px;"><?php echo $donnees['PER_Email']; ?></td>
            </tr>
            <tr>
              <th style="text-align: left; width: 150px; white-space: normal;">Adresse :</th>
              <td style="text-align: center; width: 200px;"><?php echo $donnees['PER_Adresse']; ?></td>
            </tr>
            <tr>
              <th style="text-align: left; width: 150px; white-space: normal;">Ville :</th>
              <td style="text-align: center; width: 200px;"><?php echo $donnees['PER_Ville']; ?>, <?php echo $donnees['PER_CodePostal']; ?></td>
            </tr>
          </table>
        </td>
      </table>
      <form method="post" action="editClient.php" name="EditClient">
        <input type="hidden" name="NumC" value="<?php echo $donnees['FOU_NumFournisseur']; ?>">
        <table id="downT">
          <tr>
            <td>
              <span>
                <input name="submit" type="submit" value="Modifier" class="buttonC">
              </span>
            </td>
          </tr>
        </table>
      </form>
    </div>
  <?php
  

  mysqli_free_result($reponse);
  ?>
  <?php  
    include('footer.php');
    ?>