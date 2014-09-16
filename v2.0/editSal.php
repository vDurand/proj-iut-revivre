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
				<label>Modifier Membre</label>
			</div>
			<br>
			<form method="post" action="salpre.php" name="Sal" formtype="1" colvalue="2">
				<input type="hidden" name="NumC" value="<?php echo $donnees['PER_Num']; ?>">
				<div style="overflow:auto;">
					<table align="left">
						<td style="vertical-align:top;">
							<table id="leftT" colcount="0" cellpadding="10">
								<tr id="Client-Nom">
									<td style="text-align: left; width: 150px; white-space: normal;">
										<label>Nom :</label>
									</td>
									<td>
										<input id="Nom" required maxlength="255" name="Nom" type="text" class="inputC" pattern="^[A-Z].*" title="Majuscule en début obligatoire" value="<?php echo $donnees['PER_Nom']; ?>"> 
									</td>
								</tr>
								<tr id="Client-Prenom">
									<td style="text-align: left; width: 150px; white-space: normal;">
										<label>Prenom :</label>
									</td>
									<td>
										<input id="Prenom" required maxlength="255" name="Prenom" type="text" class="inputC" pattern="^[A-Z].*" title="Majuscule en début obligatoire" value="<?php echo $donnees['PER_Prenom']; ?>"> 
									</td>

								</tr>
								<tr id="Client-Tel_Fixe">
									<td style="text-align: left; width: 150px; white-space: normal;">
										<label>Telephone Fixe :</label>
									</td>
									<td>
										<input id="Tel_Fixe" maxlength="255" name="Tel_Fixe" type="text" fieldtype="1" class="inputC" pattern="^[0-9][0-9](?:[\/_:-\s]?\d\d){4}$" value="<?php echo $donnees['PER_TelFixe']; ?>"> 
									</td>
								</tr>
								<tr id="Client-Portable">
									<td style="text-align: left; width: 150px; white-space: normal;">
										<label>Telephone Portable :</label>
									</td>
									<td>
										<input id="Portable" maxlength="255" name="Portable" type="text" class="inputC" pattern="^[0-9][0-9](?:[\/_:-\s]?\d\d){4}$" value="<?php echo $donnees['PER_TelPort']; ?>"> 
									</td>
								</tr>
								<tr id="Client-Fax">
									<td style="text-align: left; width: 150px; white-space: normal;">
										<label>Fax :</label>
									</td>
									<td>
										<input id="Fax" maxlength="255" name="Fax" type="text" fieldtype="1" class="inputC" pattern="^[0-9][0-9](?:[\/_:-\s]?\d\d){4}$" value="<?php echo $donnees['PER_Fax']; ?>"> 
									</td>
								</tr>
							</table>
						</td>
						<td style="vertical-align:top;">
							<table id="rightT" colcount="1" cellpadding="10">
								<tr id="Client-Email">
									<td style="text-align: left; width: 150px; white-space: normal;">
										<label>Email :</label>
									</td>
									<td>
										<input id="Email" maxlength="255" name="Email" type="text" class="inputC" title="exemple@exemple.com" pattern="^[a-zA-Z0-9\._-]+@[a-zA-Z0-9\._-]+\.[a-z]{2,3}$" value="<?php echo $donnees['PER_Email']; ?>"> 
									</td>
								</tr>
								<tr id="Client-Adresse">
									<td style="text-align: left; width: 150px; white-space: normal;">
										<label>Adresse :</label>
									</td>
									<td>
										<input id="Adresse" required maxlength="255" name="Adresse" type="text" fieldtype="1" class="inputC" delugetype="STRING" value="<?php echo $donnees['PER_Adresse']; ?>">
									</td>
								</tr>
								<tr id="Client-Code_Postal">
									<td style="text-align: left; width: 150px; white-space: normal;">
										<label>Code Postal :</label>
									</td>
									<td>
										<input id="Code_Postal" required name="Code_Postal" type="text" title="" fieldtype="5" style="width:100px;background-color:#cde5f7;" delugetype="BIGINT" maxlength="5" value="<?php echo $donnees['PER_CodePostal']; ?>">
									</td>
								</tr>
								<tr id="Client-Ville">
									<td style="text-align: left; width: 150px; white-space: normal;">
										<label>Ville :</label>
									</td>
									<td>
										<input id="Ville" required maxlength="255" name="Ville" type="text" fieldtype="1" class="inputC" delugetype="STRING" value="<?php echo $donnees['PER_Ville']; ?>">
									</td>
								</tr>
								<tr id="Client-Structure">
									<td style="text-align: left; width: 150px; white-space: normal;">
										<label>Fonction :</label>
									</td>
									<td>
										<input id="Fonction" maxlength="255" name="Fonction" type="text" fieldtype="1" class="inputC" delugetype="STRING" value="<?php echo $donnees['SAL_Fonction']; ?>">
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