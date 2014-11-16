<?php  
    include('bandeau.php');
?>
    <div id="corps">
<?php
  $num=$_POST["NumC"];
  $reponse = mysqli_query($db, "SELECT * FROM Chantiers ch JOIN ChantierClient vcl ON ch.CHA_NumDevis=vcl.CNumDevis LEFT JOIN ChantierResp vre ON ch.CHA_NumDevis=vre.RNumDevis LEFT JOIN ChantierEtat cet ON ch.CHA_NumDevis=NumDevis WHERE ch.CHA_NumDevis='$num' limit 1");
  $donnees = mysqli_fetch_assoc($reponse);
?>
			<div id="labelT">     
				<label>Modifier Chantier</label>
			</div>
			<br>
			<form method="post" action="chantierpre.php" name="Client" formtype="1" colvalue="2">
				<input type="hidden" name="NumC" value="<?php echo $donnees['CHA_NumDevis']; ?>">
				<div style="overflow:auto;">
					<table align="left">
						<td style="vertical-align:top;">
							<table id="leftT" colcount="0" cellpadding="10">
								<tr id="Contact-Nom">
									<td style="text-align: left; width: 150px; white-space: normal;">
										<label>Nom du Chantier :</label>
									</td>
									<td>
										<input id="Nom" required maxlength="255" name="Nom" type="text" class="inputC" autofocus="autofocus" value="<?php echo formatLOW($donnees['CHA_Intitule']); ?>"> 
									</td>
								</tr>
								<tr id="Contact-Nom">
									<td style="text-align: left; width: 150px; white-space: normal;">
										<label>Adresse :</label>
									</td>
									<td>
										<input id="Adresse" required maxlength="255" name="Adresse" type="text" class="inputC" autofocus="autofocus" value="<?php echo formatLOW($donnees['CHA_Adresse']); ?>"> 
									</td>
								</tr>
								<tr id="Contact-Prenom">
									<td style="text-align: left; width: 150px; white-space: normal;">
										<label>Date de Début :</label>
									</td>
									<td>
										<input id="Debut" required maxlength="255" name="Debut" type="date" class="inputC" value="<?php echo ($donnees['CHA_DateDebut']); ?>"> 
									</td>

								</tr>
								<tr id="Contact-Echeance">
									<td style="text-align: left; width: 150px; white-space: normal;">
										<label>Echéance :</label>
									</td>
									<td>
										<input id="Fin_Max" maxlength="255" name="Fin_Max" type="date" class="inputC" value="<?php echo ($donnees['CHA_Echeance']); ?>"> 
									</td>
								</tr>
							</table>
						</td>
						<td style="vertical-align:top;">
							<table id="rightT" colcount="1" cellpadding="10">
								<tr id="Contact-Portable">
									<td style="text-align: left; width: 150px; white-space: normal;">
										<label>Montant :</label>
									</td>
									<td>
										<input id="Montant_Prev" maxlength="255" name="Montant_Prev" type="text" class="inputC" value="<?php echo $donnees['CHA_MontantPrev']; ?>"> 
									</td>
								</tr>
								<tr id="Contact-Fax">
									<td style="text-align: left; width: 150px; white-space: normal;">
										<label>Achats Prévus :</label>
									</td>
									<td>
										<input id="Achats_Prev" maxlength="255" name="Achats_Prev" type="text" class="inputC" placeholder="&euro;" value="<?php echo $donnees['CHA_AchatsPrev']; ?>"> 
									</td>
								</tr>
								<tr id="Contact-Fonction">
									<td style="text-align: left; width: 150px; white-space: normal;">
										<label>Heures Prévues :</label>
									</td>
									<td>
										<input id="Heures_Prev" maxlength="255" name="Heures_Prev" type="text" class="inputC" value="<?php echo $donnees['CHA_HeuresPrev']; ?>">
									</td>
								</tr>
							</table>
						</td>
					</table>
				</div>
				<table id="downT">
					<tr>
						<td>
							<span>
								<input name="submit" type="submit" value="Valider" class="buttonC">&nbsp;&nbsp; 
							</span>
						</td>
						<td>
							<input name="reset" type="reset" value="Annuler" class="buttonC">
							</form>
						</td>
						<td>
							<form id="return" method="get" action="detailChantier.php" name="detailClient">
								<input form="return" type="hidden" name="NumC" value="<?php echo $num; ?>">
								<input form="return" name="submit" type="submit" value="Retour" class="buttonC">
							</form>
						</td>
					</tr>
				</table>
			
		</div>
<?php  
	include('footer.php');
?>