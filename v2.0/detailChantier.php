<?php  
    include('bandeau.php');
    ?>
    <div id="corps">
      <script language="javascript"> 
      function addResp(){
        document.getElementById('Ajout-Resp').style.display = "";
      }
    </script>
<?php
	if($db = MySQLi_connect("localhost","Kepha",'pfudor', 'Revivre', 0, '/media/sds1/home/alx22/private/mysql/socket'))
		echo '';
	else
		echo 'Erreur';

  $num=$_POST["NumC"];

  $reponse = mysqli_query($db, "SELECT * FROM Chantiers ch JOIN ChantierClient vcl ON ch.CHA_NumDevis=vcl.CNumDevis LEFT JOIN ChantierResp vre ON ch.CHA_NumDevis=vre.RNumDevis WHERE ch.CHA_NumDevis='$num'");
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
              <td style="text-align: center; width: 250px;"><?php echo $donnees['CHA_Intitule']; ?></td>
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
          <table cellpadding="10" class="detailClients">
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
      <table id="downT">
        <tr>
          <td style="text-align: center; width: 150px;">
            <form method="post" action="editChantier.php" name="EditClient">
            <input type="hidden" name="NumC" value="<?php echo $donnees['CHA_NumDevis']; ?>">
            <span id="submitOne">
              <input name="submit" type="submit" value="Modifier" class="buttonC">
            </span>
            </form>
          </td>
          <?php
          if($donnees['Resp']==""){
          ?>
          <!--<td align="left">
            <form method="post" action="ajoutResponsable.php" name="EditClient">
            <input type="hidden" name="NumC" value="<?php echo $donnees['CHA_NumDevis']; ?>">
            <span>
              <input name="submit" type="submit" value="Responsable" class="buttonC">
            </span>
            </form>
          </td>-->
          <td style="text-align: center; width: 200px;">
            <span id="addTwo">
              <input onclick="addResp()" value="Responsable" class="buttonC">
            </span>
          </td>
          <?php
          }else{
          ?>
          <td style="text-align: center; width: 200px;">
            &nbsp;
          </td>
          <?php
          }
          ?>
          <td style="text-align: center; width: 200px;">
            &nbsp;
          </td>
        </tr>
        <tr id="Ajout-Resp" style="display:none">
          <form method="post" action="chantierPost.php" name="Chantier" formtype="1" colvalue="2">
          <td style="text-align: center;">
                <label>Responsable : </label>
          </td>
          <td style="text-align: center;">
            <div class="selectType">
              <select name="Client">
                    <?php
  $reponseBis = mysqli_query($db, "SELECT * FROM Salaries cl JOIN Personnes pe ON cl.PER_Num=pe.PER_Num ORDER BY PER_Nom");
  while ($donneesBis = mysqli_fetch_assoc($reponseBis))
  {
    ?>          <option value="<?php echo $donneesBis['SAL_NumSalarie']; ?>"><?php echo strtoupper($donneesBis['PER_Nom']); ?> <?php echo $donneesBis['PER_Prenom']; ?></option>
                  <?php
  }
  mysqli_free_result($reponse);
  ?>                  
              </select>
            </div>
          </td>
          <td style="text-align: left;">
            <input name="submit" type="submit" value="Ajouter">
          </td>
        </form>
        </tr>
      </table>
    </div>
  <?php
  

  mysqli_free_result($reponse);
  ?>
  <?php  
    include('footer.php');
    ?>