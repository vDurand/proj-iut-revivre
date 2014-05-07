		<?php  
		include('bandeau.php');
		?>
		<div id="corps">
			<div id="labelT">     
				<label>Ajouter un Contact</label>
			</div>
			<br>
			<form method="post" action="contactPost.php" name="Contact" formtype="1" colvalue="2">
				<div id="labelCat">
					<table align="center">
						<tr>
							<td style="text-align: left; width: 150px;">
								<label>Categorie</label>
							</td>
							<td>
								<div class="selectType">
		          					<select name="Type">
		          						<option value="0">Client</option>
										<option value="1">Fournisseur</option>
		          			<?php

	if($db = MySQLi_connect("localhost","Kepha",'pfudor', 'Revivre', 0, '/media/sds1/home/alx22/private/mysql/socket'))
		echo '';
	else
		echo 'Erreur';
	$i = 2;
	$reponse = mysqli_query($db, "SELECT * FROM Type");
	while ($donnees = mysqli_fetch_assoc($reponse))
	{
		?>
				        				<option value="<?php echo $i; ?>"><?php echo $donnees['TYP_Nom']; ?></option>
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
								<tr id="Contact-Nom">
									<td style="text-align: left; width: 150px; white-space: normal;">
										<label>Nom :</label>
									</td>
									<td>
										<input id="Nom" required maxlength="255" name="Nom" type="text" class="inputC" pattern="^[A-Z].*" title="Majuscule en début obligatoire" autofocus="autofocus"> 
									</td>
								</tr>
								<tr id="Contact-Prenom">
									<td style="text-align: left; width: 150px; white-space: normal;">
										<label>Prenom :</label>
									</td>
									<td>
										<input id="Prenom" required maxlength="255" name="Prenom" type="text" class="inputC" pattern="^[A-Z].*" title="Majuscule en début obligatoire"> 
									</td>

								</tr>
								<tr id="Contact-Tel_Fixe">
									<td style="text-align: left; width: 150px; white-space: normal;">
										<label>Telephone Fixe :</label>
									</td>
									<td>
										<input id="Tel_Fixe" maxlength="255" name="Tel_Fixe" type="text" fieldtype="1" class="inputC" pattern="^[0-9][0-9](?:[\/_:-\s]?\d\d){4}$"> 
									</td>
								</tr>
								<tr id="Contact-Portable">
									<td style="text-align: left; width: 150px; white-space: normal;">
										<label>Telephone Portable :</label>
									</td>
									<td>
										<input id="Portable" maxlength="255" name="Portable" type="text" class="inputC" pattern="^[0-9][0-9](?:[\/_:-\s]?\d\d){4}$"> 
									</td>
								</tr>
								<tr id="Contact-Fax">
									<td style="text-align: left; width: 150px; white-space: normal;">
										<label>Fax :</label>
									</td>
									<td>
										<input id="Fax" maxlength="255" name="Fax" type="text" fieldtype="1" class="inputC" pattern="^[0-9][0-9](?:[\/_:-\s]?\d\d){4}$"> 
									</td>
								</tr>
								<tr id="Contact-Sexe">
									<td rowspan="2" style="text-align: left; width: 150px; white-space: normal;">
										<label>Sexe :</label>
									</td>
									<td style="padding-top: 0px;">
										<input checked type="radio" name="Sexe" value="1"/>
										<label>&nbsp; Homme</label>
									</td>
								</tr>
								<tr>
									<td style="padding-top: 0px;">
										<input type="radio" name="Sexe" value="0"/>
										<label>&nbsp; Femme</label>
									</td>
								</tr>
							</table>
						</td>
						<td style="vertical-align:top;">
							<table id="rightT" colcount="1" cellpadding="10">
								<tr id="Contact-Email">
									<td style="text-align: left; width: 150px; white-space: normal;">
										<label>Email :</label>
									</td>
									<td>
										<input id="Email" maxlength="255" name="Email" type="text" class="inputC" title="exemple@exemple.com" pattern="^[a-zA-Z0-9\._-]+@[a-zA-Z0-9\._-]+\.[a-z]{2,3}$"> 
									</td>
								</tr>
								<tr id="Contact-Adresse">
									<td style="text-align: left; width: 150px; white-space: normal;">
										<label>Adresse :</label>
									</td>
									<td>
										<input id="Adresse" required maxlength="255" name="Adresse" type="text" fieldtype="1" class="inputC" delugetype="STRING">
									</td>
								</tr>
								<tr id="Contact-Code_Postal">
									<td style="text-align: left; width: 150px; white-space: normal;">
										<label>Code Postal :</label>
									</td>
									<td>
										<input id="Code_Postal" required name="Code_Postal" type="text" title="" fieldtype="5" style="width:100px;background-color:#cde5f7;" delugetype="BIGINT" maxlength="5">
									</td>
								</tr>
								<tr id="Contact-Ville">
									<td style="text-align: left; width: 150px; white-space: normal;">
										<label>Ville :</label>
									</td>
									<td>
										<input id="Ville" required maxlength="255" name="Ville" type="text" fieldtype="1" class="inputC" delugetype="STRING">
									</td>
								</tr>
								<tr id="Contact-Structure">
									<td style="text-align: left; width: 150px; white-space: normal;">
										<label>Structure :</label>
									</td>
									<td>
										<input id="Struct" maxlength="255" name="Struct" type="text" fieldtype="1" class="inputC" delugetype="STRING">
									</td>
								</tr>
								<tr id="Contact-Fonction">
									<td style="text-align: left; width: 150px; white-space: normal;">
										<label>Fonction :</label>
									</td>
									<td>
										<input id="Struct" maxlength="255" name="Fonction" type="text" fieldtype="1" class="inputC" delugetype="STRING">
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
								<input name="reset" type="reset" value="RAZ" class="buttonC">
							</span>
						</td>
					</tr>
				</table>
			</form>
		</div>
		<?php  
		include('footer.php');
		?>