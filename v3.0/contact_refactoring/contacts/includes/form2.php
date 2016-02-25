<!-- ajout d'un client -->
<div class="form">
	<form action="postContact.php" method="post">
		<!--
		<fieldset class="civilian_infos">
			<legend align="center"><h2>Type de client</h2></legend>
			<div align="center">
				<input type="radio" id="CLI_structure" name="CLI_type" checked>Structure
				<input type="radio" id="CLI_particulier" name="CLI_type">Particulier
			</div>
		</fieldset>
		</br>
		-->
		<fieldset class="civilian_infos">
			<legend align="center"><h2> Coordonnées Civiles  </h2></legend>
			<p class="warning_infos" align="center"><b>/!\<i> Toutes ces informations sont nécessaires et obligatoires </i>/!\</b></p>
			<table>
				<tr>
					<td><label for="CLI_Nom">Nom :</label></td>
					<td><input required="required" class="inputC" type="text" id="CLI_Nom" name="CLI_Nom"/></td>
				</tr>
				<tr>
					<td><label for="CLI_Prenom">Prenom (si particuler) :</label></td>
					<td><input required="required" class="inputC" type="text" id="CLI_Prenom" name="CLI_Prenom"/></td>
					<td><label for="CLI_Adresse">Adresse :</label></td>
					<td><textarea required="required" rows="5" class="inputC" id="CLI_Adresse" name="CLI_Adresse"/></td>
				</tr>
				<tr>
					<td><label for="CLI_TelFixe">Téléphone Fixe :</label></td>
					<td><input required="required" class="inputC" type="text" id="CLI_TelFixe" name="CLI_TelFixe"/></td>
					<td><label for="CLI_CodePostal">Code Postal :</label></td>
					<td><input required="required" class="inputC" type="text" id="CLI_CodePostal" name="CLI_CodePostal"/></td>
				</tr>
				<tr>
					<td><label for="CLI_TelPort">Téléphone Portable :</label></td>
					<td><input required="required" class="inputC" type="text" id="CLI_TelPort" name="CLI_TelPort"/></td>
					<td><label for="CLI_Ville">Ville :</label></td>
					<td><input required="required" class="inputC" type="text" id="CLI_Ville" name="CLI_Ville"/></td>
				</tr>
				
				<tr>
					<td><label for="CLI_Fax">Fax :</label></td>
					<td><input required="required" class="inputC" type="text" id="CLI_Fax" name="CLI_Fax"/></td>
					<td><label for="CLI_Mail">Adresse @ email:</label></td>
					<td><input class="inputC" type="text" id="CLI_Mail" name="CLI_Mail"/></td>
				</tr>
			</table>
			</br>
			<div align="center">
				<input type="reset" class="buttonC"value="Annuler">
				<input type="submit" class="buttonC" value="Ajouter">
			</div>
		</fieldset>
	</br>
	<input type="hidden" id="Num_form" name="Num_form" value="2">
	</form>
</div>

