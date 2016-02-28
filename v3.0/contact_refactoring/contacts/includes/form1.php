<!-- ajout d'un fournisseur -->
<div class="form-repertoire">
	<fieldset class="civilian_infos">
		<legend>Coordonnées Civiles<span class="required-fields-info">Champs obligatoires*</span></legend>
		<table>
			<tr>
				<td><label for="FOU_Nom">Nom* :</label></td>
				<td><input required="required" class="inputC" type="text" id="FOU_Nom" name="FOU_Nom"/></td>
				<td><label for="FOU_Adresse">Adresse* :</label></td>
				<td><textarea required="required" rows="5" class="inputC" id="FOU_Adresse" name="FOU_Adresse"/></td>
			</tr>
			<tr>
				<td><label for="FOU_TelFixe">Téléphone Fixe* :</label></td>
				<td><input required="required" class="inputC" type="text" id="FOU_TelFixe" name="FOU_TelFixe"/></td>
				<td><label for="FOU_CodePostal">Code Postal* :</label></td>
				<td><input required="required" class="inputC" type="text" id="FOU_CodePostal" name="FOU_CodePostal"/></td>
			</tr>
			<tr>
				<td><label for="FOU_TelPort">Téléphone Portable :</label></td>
				<td><input class="inputC" type="text" id="FOU_TelPort" name="FOU_TelPort"/></td>
				<td><label for="FOU_Ville">Ville* :</label></td>
				<td><input required="required" class="inputC" type="text" id="FOU_Ville" name="FOU_Ville"/></td>
			</tr>
			
			<tr>
				<td><label for="FOU_Fax">Fax :</label></td>
				<td><input class="inputC" type="text" id="FOU_Fax" name="FOU_Fax"/></td>
				<td><label for="FOU_Mail">Adresse @ email :</label></td>
				<td><input class="inputC" type="text" id="FOU_Mail" name="FOU_Mail"/></td>
			</tr>
		</table>
	</fieldset>
	<input type="hidden" id="Num_form" name="Num_form" value="1">
</div>