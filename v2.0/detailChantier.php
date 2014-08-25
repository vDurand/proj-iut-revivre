<?php  
    include('bandeau.php');
    ?>
    <div id="corps">
<?php
  $Workers = array(" ");
  $Ids = array(" ");

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
              <td style="text-align: center; width: 200px;"><?php echo dater($donnees['CHA_DateDebut']); ?></td>
            </tr>
            <tr>
              <th style="text-align: left; width: 150px; white-space: normal;">Echéance:</th>
              <td style="text-align: center; width: 200px;"><?php echo dater($donnees['CHA_Echeance']); ?></td>
            </tr>
<?php
	if($donnees['CHA_DateFinReel']!=NULL){
?>
            <tr>
              <th style="text-align: left; width: 150px; white-space: normal;">Fin:</th>
              <td style="text-align: center; width: 200px;"><?php echo dater($donnees['CHA_DateFinReel']); ?></td>
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
              <th style="text-align: left; width: 150px; white-space: normal;">Achats Prévus:</th>
              <td style="text-align: center; width: 200px;"><?php echo $donnees['CHA_AchatsPrev']; ?> &euro;</td>
            </tr>
			<tr>
              <th style="text-align: left; width: 150px; white-space: normal;">Heures Prévues:</th>
              <td style="text-align: center; width: 200px;"><?php echo $donnees['CHA_HeuresPrev']; $Hmax = $donnees['CHA_HeuresPrev'];?></td>
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
<!-- Buttons Line -->
      <table id="downT">
        <tr id="button-line">
          <td style="text-align: center; width: 150px;">
            <form method="post" action="editChantier.php" name="EditChantier">
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
	}
	else{
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
<!-- Ajout Responsable -->
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
  $j = 1;
  $reponseBis = mysqli_query($db, "SELECT * FROM Salaries cl JOIN Personnes pe ON cl.PER_Num=pe.PER_Num ORDER BY PER_Nom");
  while ($donneesBis = mysqli_fetch_assoc($reponseBis))
  {
?>
	          	<option value="<?php echo $donneesBis['SAL_NumSalarie']; ?>"><?php echo strtoupper($donneesBis['PER_Nom']); $temp1=strtoupper($donneesBis['PER_Nom']);?> <?php echo $donneesBis['PER_Prenom']; $temp2=$donneesBis['PER_Prenom']; ?></option>
<?php
      $Workers[$j] = "$temp1 $temp2";
      $Ids[$j] = $donneesBis['SAL_NumSalarie'];
      $j++;
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
<!-- Ajout Tps Travail -->
        <form method="post" action="chantierAdd.php" name="AddWork" id="AddWork">
        <tr id="Ajout-Tps" style="display:none;">
          <input form="AddWork" type="hidden" name="NumC" value="<?php echo $donnees['CHA_NumDevis']; ?>">
          <td style="text-align: center; padding-top: 35px;">
                <label>Membres : </label>
          </td>
          <td align="center" style="padding-top: 35px;">
            <div class="selectType">
              <select form="AddWork" name="Member[]">
              	<option></option>
<?php
  $reponseTres = mysqli_query($db, "SELECT * FROM Salaries cl JOIN Personnes pe ON cl.PER_Num=pe.PER_Num ORDER BY PER_Nom");
  while ($donneesTres = mysqli_fetch_assoc($reponseTres))
  {
?>
		          <option value="<?php echo $donneesTres['SAL_NumSalarie']; ?>"><?php echo strtoupper($donneesTres['PER_Nom']); ?> <?php echo $donneesTres['PER_Prenom']; ?></option>
<?php             
  }
  mysqli_free_result($reponseTres);
?>                  
              </select>
            </div>
          </td>
          <td align="left" style="padding-top: 35px;">
            <input form="AddWork" name="submit" type="submit" value="Ajouter">
            <input form="AddWork" name="reset" type="reset" value="Annuler">
          </td>
        </tr>
        <tr id="Ajout-Tps2" style="display:none;">
          <td style="text-align: center; padding-top: 15px;">
                <input form="AddWork" id="Date" maxlength="100" name="Date[]" type="date" class="inputC2" placeholder="Date"> 
          </td>
          <td align="center" style="padding-top: 15px;">
            <input form="AddWork" id="Debut" maxlength="100" name="Debut[]" type="time" class="inputC2" placeholder="Nombre d'heures"> 
          </td>
          <td align="left" style="padding-top: 15px;">
            <input name="plus" type="button" value="+" onclick="AddWorkingTime()">
            <input name="moins" type="button" value="-" onclick="RmWorkingTime()">  
          </td>
        </tr>
        <tr id="placeholder_row_bottom"></tr>
        </form>
<!-- Changement Etat Chantier -->
        <form method="post" action="chantierAdd.php" name="Chantier" formtype="1" colvalue="2">
        <tr id="Chang-Etat" style="display:none;">
        	<input type="hidden" name="NumC" value="<?php echo $donnees['CHA_NumDevis']; ?>">
	        <td style="text-align: center; padding-top: 35px;">
	              <label>Etat : </label>
	        </td>
	        <td align="center" style="padding-top: 35px;">
	          <div class="selectType">
	            <select name="EtatA" onchange="showFin(this)">
<?php
	$reponse4 = mysqli_query($db, "SELECT * FROM TypeEtat WHERE TYE_Id>$IdEtat ORDER BY TYE_Id");
	while ($donnees4 = mysqli_fetch_assoc($reponse4))
	{
?>
		          <option value="<?php echo $donnees4['TYE_Id']; ?>"><?php echo $donnees4['TYE_Nom']; ?></option>
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
        </tr>
	    <tr id="Chang-Etat2" style="display:none;">
	        <td style="text-align: center; padding-top: 15px;">
	              <label>Date de Fin : </label>
	        </td>
	        <td align="center" style="padding-top: 15px;">
	          <input id="DateFin" maxlength="255" name="DateFin" type="date" class="inputC"> 
	        </td>
	        <td align="left" style="padding-top: 15px;">
	          &nbsp; 
	        </td>
	      </tr>
       	  </form>
      </table>
<!-- List Tps Travail -->
<?php 
	if (mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM TempsTravail WHERE CHA_NumDevis='$num'"))) {
?>
      <div class="listeClients">
      <table cellpadding="5">
            <thead>
            <tr>
              <td class="firstCol" style="text-align: center; width: 600px;">
                <a>Membre</a>
              </td>
              <td style="text-align: center; width: 200px;">
                <a>Date</a>
              </td>
              <td style="text-align: center; width: 200px;">
                <a>Durée</a>
              </td>
            </tr>
          </thead>
          <tbody>
<?php
		$reponse3 = mysqli_query($db, "SELECT * FROM TempsTravail ttps JOIN Salaries sal ON ttps.SAL_NumSalarie=sal.SAL_NumSalarie JOIN Personnes pe ON pe.PER_Num=sal.PER_Num WHERE ttps.CHA_NumDevis='$num' ORDER BY ttps.TRA_Date ASC");
		while ($donnees3 = mysqli_fetch_assoc($reponse3))
		{
?>
	        <tr style="font-size: 14;">
                <td><?php echo strtoupper($donnees3['PER_Nom']); ?> <?php echo $donnees3['PER_Prenom']; ?></td>
                <td><?php echo dater($donnees3['TRA_Date']); ?></td>
                <td><?php echo $donnees3['TRA_Duree']; ?></td>
              </tr>
<?php
		}
		mysqli_free_result($reponse3);
		$reponse4 = mysqli_query($db, "SELECT TIME(SUM(TRA_Duree)) as total FROM TempsTravail ttps WHERE ttps.CHA_NumDevis='$num' GROUP BY CHA_NumDevis");
		$donnees4 = mysqli_fetch_assoc($reponse4)
?>
	         <tr style="font-size: 14;">
              <td></td>
              <td style="font-weight: bold;">Heures Totales : </td>
              <td style="font-weight: bold;"><?php echo $donnees4['total']; ?></td>
            </tr> 
          </tbody>
        </table>
      </div>
      <div id="HoursEvolution" style="height: 400px;"></div>
<?php
		mysqli_free_result($reponse4);
	}
	mysqli_free_result($reponse);  
?>
    </div>
<script type="text/javascript">
	Morris.Line({
	  element: 'HoursEvolution',
	  data: [
	  	<?php
	  	$reponse5 = mysqli_query($db, "SELECT * FROM TempsTravail ttps JOIN Salaries sal ON ttps.SAL_NumSalarie=sal.SAL_NumSalarie JOIN Personnes pe ON pe.PER_Num=sal.PER_Num WHERE ttps.CHA_NumDevis='$num' ORDER BY ttps.TRA_Date ASC");
	  	while ($donnees5 = mysqli_fetch_assoc($reponse5))
	  	{
	  	?>
	    { y: '<?php echo $donnees5['TRA_Date']; ?>', a: <?php $croissance = $croissance + $donnees5['TRA_Duree']; echo $croissance; ?>},
	    <?php
	    		}
	    		mysqli_free_result($reponse5);
	    ?>
	  ],
	  xkey: 'y',
	  ykeys: ['a'],
	  labels: ['Nombre d\'heures'],
	  goals: [<?php echo $Hmax; ?>],
	  goalLineColors: ['Red'],
	  goalStrokeWidth: 4,
	  lineColors: ['green']
	});
</script>
<?php
    include('footer.php');
?>
<script type="text/javascript">
	var buttonCount = 1;
// Add tps travail form ++ (detailChantier)
	function AddWorkingTime()
	{
	  // conversion php array to js array
	  	var jWorkers= <?php echo json_encode($Workers); ?>;
	  	var jIds= <?php echo json_encode($Ids); ?>;
	  
	  // structure html tr/td/div
	  	var table = document.getElementById("downT");
	  	var NewRow = table.insertRow(4);
	  		NewRow.id = "Ajout-Tps";
	  	
	  	var NewCell1 = NewRow.insertCell(0);
	  		NewCell1.setAttribute("style","text-align: center; padding-top: 35px;");
	  		NewCell1.innerHTML = "<label>Membres : </label>";
	  	
	  	var NewCell2 = NewRow.insertCell(1);
	  		NewCell2.setAttribute("style","padding-top: 35px;");
	  		NewCell2.setAttribute("align","center");
	  	
	  	var NewDiv = document.createElement("div");
	  		NewDiv.setAttribute("class","selectType");
	  
	  // insertion array in select option via tmp
		  	tmp = '<select form="AddWork" name="Member[]">';
				for (var i in jWorkers) {
					tmp += '<option value="'+jIds[i]+'">'+jWorkers[i]+"</option>\n";
				}
				tmp += "</select>";
		
			NewDiv.innerHTML = tmp;
	
	  		NewCell2.appendChild(NewDiv);
	  	
	  	var NewCell3 = NewRow.insertCell(2);
	  		NewCell3.setAttribute("style","padding-top: 35px;");
	  		NewCell3.setAttribute("align","center");
	  	
	  // next tr
	  	var NewRow2 = table.insertRow(5);
	  	NewRow2.id = "Ajout-Tps2";
	  	
	  	var NewCell4 = NewRow2.insertCell(0);
	  		NewCell4.setAttribute("style","text-align: center; padding-top: 15px;");
	  		
	  	/*var NewDiv2 = document.createElement("div");
	  		
	  	var input1 = document.createElement("input");
	  		input1.type = "date";
	  		input1.name = "Date[]";
	  	NewDiv2.appendChild(input1);
	  	NewCell4.appendChild(NewDiv2);*/
	  	
	  	NewCell4.innerHTML = '<input form="AddWork" id="Date" maxlength="100" name="Date[]" type="date" class="inputC2" placeholder="Date">';
	  	
	  	var NewCell5 = NewRow2.insertCell(1);
	  	NewCell5.setAttribute("style","text-align: center; padding-top: 15px;");
	  	NewCell5.innerHTML = '<input form="AddWork" id="Debut" maxlength="100" name="Debut[]" type="time" class="inputC2" placeholder="Nombre dheures">';
	  	
	  	var NewCell6 = NewRow2.insertCell(2);
	  	NewCell6.setAttribute("style","padding-top: 35px;");
	  	NewCell6.setAttribute("align","center");
	  	
	  	/*var AllDiv = document.createElement("div");
	  	AllDiv.appendChild(NewRow);
	  	AllDiv.appendChild(NewRow2);*/
	  	
	  	buttonCount++;
	}
// Remove tps travail form -- (detailChantier)
	function RmWorkingTime()
	{
		if (buttonCount > 1) {
			$("#placeholder_row_bottom").prev().remove();
			buttonCount--;
			$("#placeholder_row_bottom").prev().remove();
		}
	}	
</script>