<?php  
    include('bandeau.php');
    ?>
    <div id="corps">
<?php
	if($db = MySQLi_connect("localhost","Kepha",'pfudor', 'Revivre', 0, '/media/sds1/home/alx22/private/mysql/socket'))
		echo '';
	else
		echo 'Erreur';

  $nom=$_POST["Nom"];
  $prenom=$_POST["Prenom"];
  $tel=$_POST["Tel_Fixe"];
  $port=$_POST["Portable"];
  $fax=$_POST["Fax"];
  $email=$_POST["Email"];
  $add=$_POST["Adresse"];
  $cp=$_POST["Code_Postal"];
  $ville=$_POST["Ville"];

	$query = "INSERT INTO Clients (CLI_NumClient, CLI_Nom, CLI_Prenom, CLI_TelFixe, CLI_TelPort, CLI_Fax, CLI_Email, CLI_Adresse, CLI_CodePostal, CLI_Ville) VALUES (NULL, '$nom', '$prenom', '$tel', '$port', '$fax', '$email', '$add', '$cp', '$ville')";

  $sql = mysqli_query($db, $query);
  $errr=mysqli_error($db);

    if($sql)                  
      {echo '<div id="good">     
            <label>Client ajoute avec succes</label>
            </div>';}
    else
      {echo '<div id="bad">     
            <label>Le client n a pas pu etre ajoute</label>
            </div>';}

  $reponse = mysqli_query($db, "SELECT * FROM Clients WHERE CLI_Nom='$nom' AND CLI_Prenom='$prenom'");
  $donnees = mysqli_fetch_assoc($reponse);
  
	?>
  <br>
  <table>
  <td>
  <table cellpadding="10" class="listeClients">
    <tr>
      <th style="text-align: left; width: 150px; white-space: normal;">Nom :</th>
      <td style="text-align: center; width: 200px;"><?php echo $donnees['CLI_Nom']; ?></td>
    </tr>
    <tr>
      <th style="text-align: left; width: 150px; white-space: normal;">Prenom :</th>
      <td style="text-align: center; width: 200px;"><?php echo $donnees['CLI_Prenom']; ?></td>
    </tr>
    <tr>
      <th style="text-align: left; width: 150px; white-space: normal;">Tel Fixe :</th>
      <td style="text-align: center; width: 200px;"><?php echo $donnees['CLI_TelFixe']; ?></td>
    </tr>
  </table>
</td>
<td>
  <table cellpadding="10" class="listeClients">
    <tr>
      <th style="text-align: left; width: 150px; white-space: normal;">Email :</th>
      <td style="text-align: center; width: 200px;"><?php echo $donnees['CLI_Email']; ?></td>
    </tr>
    <tr>
      <th style="text-align: left; width: 150px; white-space: normal;">Adresse :</th>
      <td style="text-align: center; width: 200px;"><?php echo $donnees['CLI_Adresse']; ?></td>
    </tr>
    <tr>
      <th style="text-align: left; width: 150px; white-space: normal;">Ville :</th>
      <td style="text-align: center; width: 200px;"><?php echo $donnees['CLI_Ville']; ?>, <?php echo $donnees['CLI_CodePostal']; ?></td>
    </tr>
  </table>
</td>
</table>
  </div>
  <?php
  

  mysqli_free_result($reponse);
  ?>
  <?php  
    include('footer.php');
    ?>