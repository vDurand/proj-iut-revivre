<?php  
    include('bandeau.php');
?>
    <div id="corps">
<?php
// Modification client
  $num=$_POST["NumC"];
  $nom=addslashes(mysqli_real_escape_string($db, formatUP($_POST["Nom"])));
  $prenom=addslashes(mysqli_real_escape_string($db, formatLOW($_POST["Prenom"])));
  $tel=addslashes(mysqli_real_escape_string($db, $_POST["Tel_Fixe"]));
  $port=addslashes(mysqli_real_escape_string($db, $_POST["Portable"]));
  $fax=addslashes(mysqli_real_escape_string($db, $_POST["Fax"]));
  $email=addslashes(mysqli_real_escape_string($db, $_POST["Email"]));
  $add=addslashes(mysqli_real_escape_string($db, formatLOW($_POST["Adresse"])));
  $cp=addslashes($_POST["Code_Postal"]);
  $ville=addslashes(mysqli_real_escape_string($db, formatUP($_POST["Ville"])));
  $struct=addslashes($_POST["Struct"]);

	$query = "UPDATE Personnes SET PER_Nom = '$nom', PER_Prenom = '$prenom', PER_TelFixe = '$tel', PER_TelPort = '$port', PER_Fax = '$fax', PER_Email = '$email', PER_Adresse = '$add', PER_CodePostal = '$cp', PER_Ville = '$ville' WHERE Personnes.PER_Num = '$num'";

  $sql = mysqli_query($db, $query);
  $errr=mysqli_error($db);

    if($sql){
      $query2 = "UPDATE Fournisseurs SET FOU_Structure = '$struct' WHERE Fournisseurs.PER_Num = '$num'";

      $sql2 = mysqli_query($db, $query2);
      $errr2 = mysqli_error($db);

      if($sql2){
        echo '<div id="good">     
            <label>Fournisseur modifie avec succes</label>
            </div>';
			$reponse = mysqli_query($db, "SELECT * FROM Fournisseurs fou JOIN Personnes pe ON fou.PER_Num=pe.PER_Num WHERE fou.PER_Num='$num'");
            $donnees = mysqli_fetch_assoc($reponse);
?>
  <div id="labelT">     
        <label>Detail du Fournisseur</label>
  </div>
  <br>
  <table id="fullTable" rules="all">
    <td>
      <table cellpadding="10" class="detailClients">
        <tr>
          <th style="text-align: left; width: 200px; white-space: normal;">Nom :</th>
          <td style="text-align: left; width: 300px;"><?php echo formatUP($donnees['PER_Nom']); ?></td>
        </tr>
        <?php if ($donnees['FOU_Structure'] != "Structure") { ?>
        <tr>
          <th style="text-align: left; width: 200px; white-space: normal;">Prenom :</th>
          <td style="text-align: left; width: 300px;"><?php echo formatLOW($donnees['PER_Prenom']); ?></td>
        </tr>
        <?php } ?>
        <tr>
          <th style="text-align: left; width: 200px; white-space: normal;">Telephone Fixe :</th>
          <td style="text-align: left; width: 300px;"><?php echo $donnees['PER_TelFixe']; ?></td>
        </tr>
        <tr>
          <th style="text-align: left; width: 200px; white-space: normal;">Telephone Portable :</th>
          <td style="text-align: left; width: 300px;"><?php echo $donnees['PER_TelPort']; ?></td>
        </tr>
        <tr>
          <th style="text-align: left; width: 200px; white-space: normal;">Fax :</th>
          <td style="text-align: left; width: 300px;"><?php echo $donnees['PER_Fax']; ?></td>
        </tr>
        <?php if ($donnees['FOU_Structure'] == "Structure") { ?>
        <tr>
          <th style="text-align: left; width: 200px; white-space: normal;">&nbsp;</th>
          <td style="text-align: left; width: 300px;">&nbsp;</td>
        </tr>
        <?php } ?>
      </table>        </td>
    <td>
      <table cellpadding="10" class="detailClients">
        <tr>
          <th style="text-align: left; width: 200px; white-space: normal;">Email :</th>
          <td style="text-align: left; width: 300px;"><A HREF="mailto:<?php echo $donnees['PER_Email'];?>"> <?php echo $donnees['PER_Email']; ?></A></td>
        </tr>
        <tr>
          <th style="text-align: left; width: 200px; white-space: normal;">Adresse :</th>
          <td style="text-align: left; width: 300px;"><?php echo formatLOW($donnees['PER_Adresse']); ?></td>
        </tr>
        <tr>
          <th style="text-align: left; width: 200px; white-space: normal;">Ville :</th>
          <td style="text-align: left; width: 300px;"><?php echo formatUP($donnees['PER_Ville']); ?></td>
        </tr>
        <tr>
          <th style="text-align: left; width: 200px; white-space: normal;">Code Postal :</th>
          <td style="text-align: left; width: 300px;"><?php echo $donnees['PER_CodePostal']; ?></td>
        </tr>
        <tr>
          <th style="text-align: left; width: 200px; white-space: normal;">Structure :</th>
          <td style="text-align: left; width: 300px;"><?php echo $donnees['FOU_Structure']; ?></td>
        </tr>
      </table>
    </td>
  </table>
  <form method="post" action="editFournisseur.php" name="EditFournisseur">
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
<?php
      }
      else{
        echo '<div id="bad">     
              <label>Le Fournisseur n a pas pu etre modifie</label>
              </div>';
            }
            mysqli_free_result($reponse);
    }
?>
  </div>
<?php  
    include('footer.php');
?>