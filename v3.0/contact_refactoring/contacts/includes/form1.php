<!-- ajout d'un fournisseur -->
<div class="repertoire-bloc">
	<fieldset class="civilian_infos">
		<legend>Coordonnées civiles<span class="required-fields-info">Champs obligatoires*</span></legend>
		<table class="form_table">
			<tbody>
				<tr>
					<td><label for="FOU_Nom">Nom du fournisseur* :</label></td>
					<td><input required="required" class="inputC" type="text" id="FOU_Nom" name="FOU_Nom"/></td>
				</tr>
				<tr></tr>
				<tr>
					<td><label for="FOU_Adresse">Rue, lotissement* :</label></td>
					<td><input class="inputC" type="text" required="required" id="FOU_Adresse" name="FOU_Adresse"/></td>
					<td><label for="FOU_CodePostal">Code postal* :</label></td>
					<td><input required="required" class="inputC" type="text" id="FOU_CodePostal" name="FOU_CodePostal"/></td>
				</tr>
				<tr>
					<td><label for="FOU_Ville">Ville* :</label></td>
					<td><input required="required" class="inputC" type="text" id="FOU_Ville" name="FOU_Ville"/></td>
				</tr>
				<tr></tr>
				<tr>
					<td><label for="FOU_TelFixe">Téléphone fixe* :</label></td>
					<td><input required="required" class="inputC" type="text" id="FOU_TelFixe" name="FOU_TelFixe"/></td>
					<td><label for="FOU_TelPort">Téléphone portable :</label></td>
					<td><input class="inputC" type="text" id="FOU_TelPort" name="FOU_TelPort"/></td>
				</tr>
				<tr>
					<td><label for="FOU_Fax">Fax :</label></td>
					<td><input class="inputC" type="text" id="FOU_Fax" name="FOU_Fax"/></td>
					<td><label for="FOU_Mail">Adresse @ email :</label></td>
					<td><input class="inputC" type="text" id="FOU_Mail" name="FOU_Mail"/></td>
				</tr>
			</tbody>
		</table>
	</fieldset>
	<input type="hidden" id="Num_form" name="Num_form" value="1">
</div>