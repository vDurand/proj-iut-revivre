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

  $reponse = mysqli_query($db, "SELECT * FROM Clients WHERE CLI_NumClient='$num'");
  $donnees = mysqli_fetch_assoc($reponse);
  
	?>
  <div id="labelT">     
        <label>Detail du Client</label>
  </div>
  <br>
  <table>
  <td>
  <table cellpadding="10" class="detailClients">
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
  <table cellpadding="10" class="detailClients">
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