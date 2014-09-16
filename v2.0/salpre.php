<?php  
    include('bandeau.php');
?>
    <div id="corps">
<?php
// Modification client
  $num=$_POST["NumC"];
  $nom=addslashes(mysqli_real_escape_string($db, $_POST["Nom"]));
  $prenom=addslashes(mysqli_real_escape_string($db, $_POST["Prenom"]));
  $tel=addslashes(mysqli_real_escape_string($db, $_POST["Tel_Fixe"]));
  $port=addslashes(mysqli_real_escape_string($db, $_POST["Portable"]));
  $fax=addslashes(mysqli_real_escape_string($db, $_POST["Fax"]));
  $email=addslashes(mysqli_real_escape_string($db, $_POST["Email"]));
  $add=addslashes(mysqli_real_escape_string($db, $_POST["Adresse"]));
  $cp=addslashes($_POST["Code_Postal"]);
  $ville=addslashes(mysqli_real_escape_string($db, $_POST["Ville"]));
  $fonction=addslashes($_POST["Fonction"]);

	$query = "UPDATE Personnes SET PER_Nom = '$nom', PER_Prenom = '$prenom', PER_TelFixe = '$tel', PER_TelPort = '$port', PER_Fax = '$fax', PER_Email = '$email', PER_Adresse = '$add', PER_CodePostal = '$cp', PER_Ville = '$ville' WHERE Personnes.PER_Num = '$num'";

  $sql = mysqli_query($db, $query);
  $errr=mysqli_error($db);

    if($sql){
      $query2 = "UPDATE Salaries SET SAL_Fonction = '$fonction' WHERE Salaries.PER_Num = '$num'";

      $sql2 = mysqli_query($db, $query2);
      $errr2 = mysqli_error($db);

      if($sql2){
        echo '<div id="good">     
            <label>Membre modifie avec succes</label>
            </div>';
			$reponse = mysqli_query($db, "SELECT * FROM Salaries sal JOIN Personnes pe ON sal.PER_Num=pe.PER_Num JOIN Type ty ON sal.TYP_Id=ty.TYP_Id WHERE sal.PER_Num='$num' ORDER BY PER_Nom");
            $donnees = mysqli_fetch_assoc($reponse);
?>
  <br>
  <table>
  <td>
  <table cellpadding="10" class="submitClients">
    <tr>
      <th style="text-align: left; width: 200px; white-space: normal;">Nom :</th>
      <td style="text-align: center; width: 200px;"><?php echo $donnees['PER_Nom']; ?></td>
    </tr>
    <tr>
      <th style="text-align: left; width: 200px; white-space: normal;">Prenom :</th>
      <td style="text-align: center; width: 200px;"><?php echo $donnees['PER_Prenom']; ?></td>
    </tr>
    <tr>
      <th style="text-align: left; width: 200px; white-space: normal;">Tel Fixe :</th>
      <td style="text-align: center; width: 200px;"><?php echo $donnees['PER_TelFixe']; ?></td>
    </tr>
	<tr>
	  <th style="text-align: left; width: 200px; white-space: normal;">Telephone Portable :</th>
	  <td style="text-align: center; width: 200px;"><?php echo $donnees['PER_TelPort']; ?></td>
	</tr>
    <tr>
	  <th style="text-align: left; width: 200px; white-space: normal;">Fax :</th>
	  <td style="text-align: center; width: 200px;"><?php echo $donnees['PER_Fax']; ?></td>
    </tr>
  </table>
</td>
<td>
  <table cellpadding="10" class="submitClients">
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
	<tr>
      <th style="text-align: left; width: 150px; white-space: normal;">Fonction :</th>
      <td style="text-align: center; width: 200px;"><?php echo $donnees['SAL_Fonction']; ?></td>
    </tr>
  </table>
</td>
</table>
<?php
      }
      else{
        echo '<div id="bad">     
              <label>Le membre n a pas pu etre modifie</label>
              </div>';
            }
            mysqli_free_result($reponse);
    }
?>
  </div>
<?php  
    include('footer.php');
?>