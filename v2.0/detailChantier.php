<?php  
    include('bandeau.php');
    ?>
    <div id="corps">
      <script language="javascript"> 
      function addResp(){
        if(document.getElementById('Ajout-Resp').style.display == "none")
          document.getElementById('Ajout-Resp').style.display = "";
        else
          document.getElementById('Ajout-Resp').style.display = "none";
      }
      function addTps(){
        if(document.getElementById('Ajout-Tps').style.display == "none"){
          document.getElementById('Ajout-Tps').style.display = "";
          document.getElementById('Ajout-Tps2').style.display = "";
        }
        
        else{
          document.getElementById('Ajout-Tps').style.display = "none";
          document.getElementById('Ajout-Tps2').style.display = "none";
        }
      }
      function changeEtat(){
      	if(document.getElementById('Chang-Etat').style.display == "none")
      	  document.getElementById('Chang-Etat').style.display = "";
      	else
      	  document.getElementById('Chang-Etat').style.display = "none";
      }
    </script>
<?php
	if($db = MySQLi_connect("localhost","Kepha",'pfudor', 'Revivre', 0, '/media/sds1/home/alx22/private/mysql/socket'))
		echo '';
	else
		echo 'Erreur';

  $num=$_POST["NumC"];
	//CREATE OR REPLACE VIEW ChantierEtat AS SELECT CHA_NumDevis as NumDevis, TYE_Nom as Etat, TYE_Id as Id FROM Chantiers JOIN Etat USING (CHA_NumDevis) JOIN TypeEtat USING (TYE_Id) ORDER BY TYE_Id DESC LIMIT 1;
  $reponse = mysqli_query($db, "SELECT * FROM Chantiers ch JOIN ChantierClient vcl ON ch.CHA_NumDevis=vcl.CNumDevis LEFT JOIN ChantierResp vre ON ch.CHA_NumDevis=vre.RNumDevis LEFT JOIN ChantierEtat cet ON ch.CHA_NumDevis=NumDevis WHERE ch.CHA_NumDevis='$num' limit 1");
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
            <?php
            if($donnees['CHA_DateFinReel']!=NULL){
            ?>
            <tr>
              <th style="text-align: left; width: 150px; white-space: normal;">Fin:</th>
              <td style="text-align: center; width: 200px;"><?php echo $donnees['CHA_DateFinReel']; ?></td>
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
      <table id="downT">
        <tr id="button-line">
          <td style="text-align: center; width: 150px;">
            <form method="post" action="editChantier.php" name="EditClient">
            <input type="hidden" name="NumC" value="<?php echo $donnees['CHA_NumDevis']; ?>">
            <span>
              <input name="submit" type="submit" value="Modifier" class="buttonC">
            </span>
            </form>
          </td>
          <?php
          $IdEtat=$donnees['Id'];
          if($donnees['Resp']==""){
          ?>
          <td style="text-align: center; width: 200px;">
            <span>
              <input  name="submit" type="submit" onclick="addResp()" value="Responsable" class="buttonC">
            </span>
          </td>
          <?php
          }else{
          ?>
          <td style="text-align: center; width: 200px;">
            <span>
              <input  name="submit" type="submit" onclick="addTps()" value="Travail" class="buttonC">
            </span>
          </td>
          <?php
          }
          ?>
          <td style="text-align: center; width: 200px;">
            <span>
              <input  name="submit" type="submit" onclick="changeEtat()" value="Etat" class="buttonC">
            </span>
          </td>
        </tr>
        <tr id="Ajout-Resp" style="display:none;">
          <form method="post" action="chantierAdd.php" name="Chantier" formtype="1" colvalue="2">
            <input type="hidden" name="NumC" value="<?php echo $donnees['CHA_NumDevis']; ?>">
          <td style="text-align: center; padding-top: 35px;">
                <label>Responsable : </label>
          </td>
          <td align="center" style="padding-top: 35px;">
            <div class="selectType">
              <select name="Resp">
                    <?php
  $reponseBis = mysqli_query($db, "SELECT * FROM Salaries cl JOIN Personnes pe ON cl.PER_Num=pe.PER_Num ORDER BY PER_Nom");
  while ($donneesBis = mysqli_fetch_assoc($reponseBis))
  {
    ?>          <option value="<?php echo $donneesBis['SAL_NumSalarie']; ?>"><?php echo strtoupper($donneesBis['PER_Nom']); ?> <?php echo $donneesBis['PER_Prenom']; ?></option>
                  <?php
  }
  mysqli_free_result($reponseBis);
  ?>                  
              </select>
            </div>
          </td>
          <td align="left" style="padding-top: 35px;">
            <input name="submit" type="submit" value="Ajouter">
          </td>
        </form>
        </tr>
        <form method="post" action="chantierAdd.php" name="Chantier" formtype="1" colvalue="2">
        <tr id="Ajout-Tps" style="display:none;">
          <input type="hidden" name="NumC" value="<?php echo $donnees['CHA_NumDevis']; ?>">
          <td style="text-align: center; padding-top: 35px;">
                <label>Membres : </label>
          </td>
          <td align="center" style="padding-top: 35px;">
            <div class="selectType">
              <select name="Member">
                    <?php
  $reponseTres = mysqli_query($db, "SELECT * FROM Salaries cl JOIN Personnes pe ON cl.PER_Num=pe.PER_Num ORDER BY PER_Nom");
  while ($donneesTres = mysqli_fetch_assoc($reponseTres))
  {
    ?>          <option value="<?php echo $donneesTres['SAL_NumSalarie']; ?>"><?php echo strtoupper($donneesTres['PER_Nom']); ?> <?php echo $donneesTres['PER_Prenom']; ?></option>
                  <?php
  }
  mysqli_free_result($reponseTres);
  ?>                  
              </select>
            </div>
          </td>
          <td align="left" style="padding-top: 35px;">
            <input name="submit" type="submit" value="Ajouter">
          </td>
        </tr>
        <tr id="Ajout-Tps2" style="display:none;">
          <td style="text-align: center; padding-top: 15px;">
                <label>Date : </label>
          </td>
          <td align="center" style="padding-top: 15px;">
            <input id="DebutTps" maxlength="255" name="DebutTps" type="datetime-local" class="inputC" placeholder="Debut"> 
          </td>
          <td align="left" style="padding-top: 15px;">
            <input id="FinTps" maxlength="255" name="FinTps" type="datetime-local" class="inputC" placeholder="Fin"> 
          </td>
        </tr>
        </form>
        <tr id="Chang-Etat" style="display:none;">
                <form method="post" action="chantierAdd.php" name="Chantier" formtype="1" colvalue="2">
                  <input type="hidden" name="NumC" value="<?php echo $donnees['CHA_NumDevis']; ?>">
                <td style="text-align: center; padding-top: 35px;">
                      <label>Etat : </label>
                </td>
                <td align="center" style="padding-top: 35px;">
                  <div class="selectType">
                    <select name="EtatA">
                          <?php
        $reponse4 = mysqli_query($db, "SELECT * FROM TypeEtat WHERE TYE_Id>$IdEtat ORDER BY TYE_Id");
        while ($donnees4 = mysqli_fetch_assoc($reponse4))
        {
          ?>          <option value="<?php echo $donnees4['TYE_Id']; ?>"><?php echo $donnees4['TYE_Nom']; ?></option>
                        <?php
        }
        mysqli_free_result($reponse4);
        ?>                  
                    </select>
                  </div>
                </td>
                <td align="left" style="padding-top: 35px;">
                  <input name="submit" type="submit" value="Changer">
                </td>
              </form>
              </tr>
      </table>
      <?php 
      if (mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM TempsTravail WHERE CHA_NumDevis='$num'"))) {
       ?>
      <div class="listeClients">
      <table cellpadding="5">
            <thead>
            <tr>
              <td class="firstCol" style="text-align: center; width: 200px;">
                <a>Membre</a>
              </td>
              <td style="text-align: center; width: 200px;">
                <a>Debut</a>
              </td>
              <td style="text-align: center; width: 200px;">
                <a>Fin</a>
              </td>
              <td style="text-align: center; width: 155px;">
                <a>Duree</a>
              </td>
            </tr>
          </thead>
          <tbody>
            <?php
  $reponse3 = mysqli_query($db, "SELECT *, TIME(TRA_DateFin-TRA_DateDebut) as duree FROM TempsTravail ttps JOIN Salaries sal ON ttps.SAL_NumSalarie=sal.SAL_NumSalarie JOIN Personnes pe ON pe.PER_Num=sal.PER_Num WHERE ttps.CHA_NumDevis='$num' ORDER BY ttps.TRA_NumTravail DESC");
  while ($donnees3 = mysqli_fetch_assoc($reponse3))
  {
    ?>        <tr style="font-size: 14;">
                <td><?php echo strtoupper($donnees3['PER_Nom']); ?> <?php echo $donnees3['PER_Prenom']; ?></td>
                <td><?php echo $donnees3['TRA_DateDebut']; ?></td>
                <td><?php echo $donnees3['TRA_DateFin']; ?></td>
                <td><?php echo $donnees3['duree']; ?></td>
              </tr>
            </form>
            <?php
  }
  mysqli_free_result($reponse3);
  ?>          
          </tbody>
        </table>
      </div>
      <?php } ?>
    </div>
  <?php
  mysqli_free_result($reponse);
  ?>
  <?php  
    include('footer.php');
    ?>