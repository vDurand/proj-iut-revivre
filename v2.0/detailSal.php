<?php  
    include('bandeau.php');
?>
    <div id="corps">
<?php
  $num=$_POST["NumC"];

  $reponse = mysqli_query($db, "SELECT * FROM Salaries cl JOIN Personnes pe ON cl.PER_Num=pe.PER_Num JOIN Type ty ON cl.TYP_Id=ty.TYP_Id WHERE SAL_NumSalarie='$num' ORDER BY PER_Nom");
  $donnees = mysqli_fetch_assoc($reponse);
?>
      <div id="labelT">     
            <label>Detail du Membre</label>
      </div>
      <br>
      <table id="fullTable" rules="all">
        <td>
          <table cellpadding="10" class="detailClients">
            <tr>
              <th style="text-align: left; width: 200px; white-space: normal;">Nom :</th>
              <td style="text-align: left; width: 300px;"><?php echo $donnees['PER_Nom']; ?></td>
            </tr>
            <tr>
              <th style="text-align: left; width: 200px; white-space: normal;">Prénom :</th>
              <td style="text-align: left; width: 300px;"><?php echo $donnees['PER_Prenom']; ?></td>
            </tr>
            <tr>
              <th style="text-align: left; width: 200px; white-space: normal;">Téléphone Fixe :</th>
              <td style="text-align: left; width: 300px;"><?php echo $donnees['PER_TelFixe']; ?></td>
            </tr>
            <tr>
              <th style="text-align: left; width: 200px; white-space: normal;">Téléphone Portable :</th>
              <td style="text-align: left; width: 300px;"><?php echo $donnees['PER_TelPort']; ?></td>
            </tr>
            <tr>
              <th style="text-align: left; width: 200px; white-space: normal;">Fax :</th>
              <td style="text-align: left; width: 300px;"><?php echo $donnees['PER_Fax']; ?></td>
            </tr>
          </table>
        </td>
        <td>
          <table cellpadding="10" class="detailClients">
            <tr>
              <th style="text-align: left; width: 200px; white-space: normal;">Email :</th>
              <td style="text-align: left; width: 300px;"><A HREF="mailto:<?php echo $donnees['PER_Email'];?>"> <?php echo $donnees['PER_Email']; ?></A></td>
            </tr>
            <tr>
              <th style="text-align: left; width: 200px; white-space: normal;">Adresse :</th>
              <td style="text-align: left; width: 300px;"><?php echo $donnees['PER_Adresse']; ?></td>
            </tr>
            <tr>
              <th style="text-align: left; width: 200px; white-space: normal;">Ville :</th>
              <td style="text-align: left; width: 300px;"><?php echo $donnees['PER_Ville']; ?></td>
            </tr>
            <tr>
              <th style="text-align: left; width: 200px; white-space: normal;">Code Postal :</th>
              <td style="text-align: left; width: 300px;"><?php echo $donnees['PER_CodePostal']; ?></td>
            </tr>
            <tr>
              <th style="text-align: left; width: 200px; white-space: normal;">Type :</th>
              <td style="text-align: left; width: 300px;"><?php echo $donnees['TYP_Nom']; ?></td>
            </tr>
			<tr>
              <th style="text-align: left; width: 200px; white-space: normal;">Fonction :</th>
              <td style="text-align: left; width: 300px;"><?php echo $donnees['SAL_Fonction']; ?></td>
            </tr>
          </table>
        </td>
      </table>
      <form method="post" action="editSal.php" name="EditSal">
        <input type="hidden" name="NumC" value="<?php echo $donnees['SAL_NumSalarie']; ?>">
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