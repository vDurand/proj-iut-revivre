		<?php  
		include('bandeau.php');
		?>
		<div id="corps">
			<div id="labelT">     
				<label>Ajouter un Chantier</label>
			</div>
			<br>
			<form method="post" action="chantierPost.php" name="Chantier" formtype="1" colvalue="2">
				<div id="labelCat">
					<table align="center">
						<tr>
							<td style="text-align: left; width: 150px;">
								<label>Client</label>
							</td>
							<td>
								<div class="selectType">
		          					<select name="Client">
		          			<?php

	if($db = MySQLi_connect("localhost","Kepha",'pfudor', 'Revivre', 0, '/media/sds1/home/alx22/private/mysql/socket'))
		echo '';
	else
		echo 'Erreur';
	$i = 2;
	$reponse = mysqli_query($db, "SELECT * FROM Clients cl JOIN Personnes pe ON cl.PER_Num=pe.PER_Num ORDER BY PER_Nom");
	while ($donnees = mysqli_fetch_assoc($reponse))
	{
		?>
				        				<option value="<?php echo $donnees['CLI_NumClient']; ?>"><?php echo strtoupper($donnees['PER_Nom']); ?> <?php echo $donnees['PER_Prenom']; ?></option>
				        	<?php
	$i++;
	}
	mysqli_free_result($reponse);
	?>									
				    				</select>
				    			</div>
				    		</td>
						</tr>
					</table>
				</div>
				<br/>
				<div style="overflow:auto;">
					<table align="left">
						<td style="vertical-align:top;">
							<table id="leftT" colcount="0" cellpadding="10">
								<tr id="Chantier_Num">
									<td style="text-align: left; width: 150px; white-space: normal;">
										<label>Numéro de Devis :</label>
									</td>
									<td>
										<input id="Num" required maxlength="255" name="Num" type="text" class="inputC"> 
									</td>
								</tr>
								<tr id="Contact-Nom">
									<td style="text-align: left; width: 150px; white-space: normal;">
										<label>Nom du Chantier :</label>
									</td>
									<td>
										<input id="Nom" required maxlength="255" name="Nom" type="text" class="inputC" autofocus="autofocus"> 
									</td>
								</tr>
								<tr id="Contact-Prenom">
									<td style="text-align: left; width: 150px; white-space: normal;">
										<label>Date de Début :</label>
									</td>
									<td>
										<input id="Debut" required maxlength="255" name="Debut" type="date" class="inputC"> 
									</td>

								</tr>
								<tr id="Contact-Echeance">
									<td style="text-align: left; width: 150px; white-space: normal;">
										<label>Echéance :</label>
									</td>
									<td>
										<input id="Fin_Max" maxlength="255" name="Fin_Max" type="date" class="inputC"> 
									</td>
								</tr>
							</table>
						</td>
						<td style="vertical-align:top;">
							<table id="rightT" colcount="1" cellpadding="10">
								<tr id="Contact-Tel_Fixe">
									<td style="text-align: left; width: 150px; white-space: normal;">
										<label>Date de Fin Prévue :</label>
									</td>
									<td>
										<input id="Fin_Prev" maxlength="255" name="Fin_Prev" type="date" class="inputC"> 
									</td>
								</tr>
								<tr id="Contact-Portable">
									<td style="text-align: left; width: 150px; white-space: normal;">
										<label>Montant Prévu :</label>
									</td>
									<td>
										<input id="Montant_Prev" maxlength="255" name="Montant_Prev" type="text" class="inputC" placeholder="&euro;"> 
									</td>
								</tr>
								<tr id="Contact-Fax">
									<td style="text-align: left; width: 150px; white-space: normal;">
										<label>Achats Prévus :</label>
									</td>
									<td>
										<input id="Achats_Prev" maxlength="255" name="Achats_Prev" type="text" class="inputC" placeholder="&euro;"> 
									</td>
								</tr>
								<tr id="Contact-Fonction">
									<td style="text-align: left; width: 150px; white-space: normal;">
										<label>Heures Prévues :</label>
									</td>
									<td>
										<input id="Heures_Prev" maxlength="255" name="Heures_Prev" type="text" class="inputC">
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
								<input name="submit" type="submit" value="Ajouter" class="buttonC">&nbsp;&nbsp; 
								<input name="reset" type="reset" value="Annuler" class="buttonC">
							</span>
						</td>
					</tr>
				</table>
			</form>
		</div>
		<?php  
		include('footer.php');
		?>