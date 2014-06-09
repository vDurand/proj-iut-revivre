<?php  
    include('bandeau.php');
    ?>
    <div id="corps">
<?php
	if($db = MySQLi_connect("localhost","Kepha",'pfudor', 'Revivre', 0, '/media/sds1/home/alx22/private/mysql/socket'))
		echo '';
	else
		echo 'Erreur';

  $client=strtoupper(addslashes($_POST["Client"]));
  $nom=strtoupper(addslashes($_POST["Nom"]));
  $num=strtoupper(addslashes($_POST["Num"]));
  $ddebut=strtoupper(addslashes($_POST["Debut"]));
  $dfinp=strtoupper(addslashes($_POST["Fin_Prev"]));
  $montantp=strtoupper(addslashes($_POST["Montant_Prev"]));
  $achatp=strtoupper(addslashes($_POST["Achats_Prev"]));
  $heurep=strtoupper(addslashes($_POST["Heures_Prev"]));
  $echeance=strtoupper(addslashes($_POST["Fin_Max"]));

	$query = "INSERT INTO Chantiers (CHA_DateDebut, CHA_DateFinPrevue, CHA_Intitule, CHA_Echeance, CHA_MontantPrev, CHA_AchatsPrev, CHA_HeuresPrev, CHA_Id) VALUES ('$ddebut', '$dfinp', '$nom', '$echeance', '$montantp', '$achatp', '$heurep', '$num')";

  $sql = mysqli_query($db, $query);
  $errr=mysqli_error($db);

    if($sql){
      $numberQuery = mysqli_query($db, "SELECT * FROM Chantiers WHERE CHA_Id='$num'");
      $numberRep = mysqli_fetch_assoc($numberQuery);
      $realNumber = $numberRep['CHA_NumDevis'];

      $query2 = "INSERT INTO Commanditer (CLI_NumClient, CHA_NumDevis) VALUES ('$client', '$realNumber')";
      
      $sql2 = mysqli_query($db, $query2);
      $errr2 = mysqli_error($db);

      if($sql2){
        echo '<div id="good">     
            <label>Chantier ajouté avec succès</label>
            </div>';
            $reponse = mysqli_query($db, "SELECT * FROM Chantiers ch JOIN Commanditer co ON co.CHA_NumDevis=ch.CHA_NumDevis JOIN Clients cl ON cl.CLI_NumClient=co.CLI_NumClient JOIN Personnes pe ON cl.PER_Num=pe.PER_Num WHERE ch.CHA_NumDevis='$realNumber'");
            
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
  </table>
</td>
<td>
  <table cellpadding="10" class="submitClients">
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
  <?php
      }
      else{
        echo '<div id="bad">     
              <label>Le chantier n\'a pas pu être ajouté</label>
              </div>';
            }
            mysqli_free_result($reponse);
    }
  ?>
  </div>
  <?php  
    include('footer.php');
    ?>