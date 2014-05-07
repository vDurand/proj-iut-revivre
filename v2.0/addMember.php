		<?php  
		include('bandeau.php');
		?>
		<div id="corps">
			<div id="labelT">     
				<label>Ajouter un Membre de l'Association</label>
			</div>
			<br>
			<form method="post" action="memberpst.php" name="member" formtype="1" colvalue="2">
				<div style="overflow:auto;">
					<table align="left">
						<td style="vertical-align:top;">
							<table id="leftT" colcount="0" cellpadding="10">
								<tr id="Membre-Nom">
									<td style="text-align: left; width: 150px; white-space: normal;">
										<label>Nom :</label>
									</td>
									<td>
										<input id="Nom" required maxlength="255" name="Nom" type="text" class="inputC" pattern="^[A-Z].*" title="Majuscule en début obligatoire" autofocus="autofocus"> 
									</td>
								</tr>
								<tr id="Membre-Prenom">
									<td style="text-align: left; width: 150px; white-space: normal;">
										<label>Prenom :</label>
									</td>
									<td>
										<input id="Prenom" required maxlength="255" name="Prenom" type="text" class="inputC" pattern="^[A-Z].*" title="Majuscule en début obligatoire"> 
									</td>
								</tr>
								<tr id="Membre-Tel_Fixe">
									<td style="text-align: left; width: 150px; white-space: normal;">
										<label>Telephone Fixe :</label>
									</td>
									<td>
										<input id="Tel_Fixe" maxlength="255" name="Tel_Fixe" type="text" fieldtype="1" class="inputC" pattern="^[0-9][0-9](?:[\/_:-\s]?\d\d){4}$"> 
									</td>
								</tr>
								<tr id="Membre-Portable">
									<td style="text-align: left; width: 150px; white-space: normal;">
										<label>Telephone Portable :</label>
									</td>
									<td>
										<input id="Portable" maxlength="255" name="Portable" type="text" class="inputC" pattern="^[0-9][0-9](?:[\/_:-\s]?\d\d){4}$"> 
									</td>
								</tr>
								<tr id="Membre-Sexe">
									<td rowspan="2" style="text-align: left; width: 150px; white-space: normal;">
										<label>Sexe :</label>
									</td>
									<td style="padding-top: 0px;">
										<input checked type="radio" name="sexe" value="Homme"/>
										<label>&nbsp; Homme</label>
									</td>
								</tr>
								<tr>
									<td style="padding-top: 0px;">
										<input type="radio" name="sexe" value="Femme"/>
										<label>&nbsp; Femme</label>
									</td>
								</tr>
							</table>
						</td>
						<td style="vertical-align:top;">
							<table id="rightT" colcount="1" cellpadding="10">
								<tr id="Membre-Email">
									<td style="text-align: left; width: 150px; white-space: normal;">
										<label>Email :</label>
									</td>
									<td>
										<input id="Email" maxlength="255" name="Email" type="text" class="inputC" title="exemple@exemple.com" pattern="^[a-zA-Z0-9\._-]+@[a-zA-Z0-9\._-]+\.[a-z]{2,3}$"> 
									</td>
								</tr>
								<tr id="Membre-Adresse">
									<td style="text-align: left; width: 150px; white-space: normal;">
										<label>Adresse :</label>
									</td>
									<td>
										<input id="Adresse" required maxlength="255" name="Adresse" type="text" fieldtype="1" class="inputC" delugetype="STRING">
									</td>
								</tr>
								<tr id="Membre-Code_Postal">
									<td style="text-align: left; width: 150px; white-space: normal;">
										<label>Code Postal :</label>
									</td>
									<td>
										<input id="Code_Postal" required name="Code_Postal" type="text" title="" fieldtype="5" style="width:100px;background-color:#cde5f7;" delugetype="BIGINT" maxlength="5">
									</td>
								</tr>
								<tr id="Membre-Ville">
									<td style="text-align: left; width: 150px; white-space: normal;">
										<label>Ville :</label>
									</td>
									<td>
										<input id="Ville" required maxlength="255" name="Ville" type="text" fieldtype="1" class="inputC" delugetype="STRING">
									</td>
								</tr>
								<tr id="Membre-Type">
									<td style="text-align: left; width: 150px; white-space: normal;">
										<label>Type :</label>
									</td>
									<td>
						          		<div class="selectType">
						          		<select name="type">
								        	<option value="Benevole">Benevole</option>
								        	<option value="Salarie">Salarie</option>
								        	<option value="Employer">Employer</option>
								        	<option value="Employer">Encadrant</option>
								    	</select>
								    </div>
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