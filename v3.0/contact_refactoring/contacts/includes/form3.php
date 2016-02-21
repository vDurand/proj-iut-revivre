<!-- ajout d'un référent -->
<div class="form">
	<form action="postContact.php" method="post">
		<fieldset class="civilian_infos">
			<legend align="center"><h2> Coordonnées Civiles  </h2></legend>
			<p class="warning_infos" align="center"><b>/!\<i> Toutes ces informations sont nécessaires et obligatoires </i>/!\</b></p>
			<table>
				<tr>
					<td><label for="REF_Nom">Nom :</label></td>
					<td><input required="required" class="inputC" type="text" id="REF_Nom" name="REF_Nom"/></td>
				</tr>
				<tr>
					<td><label for="REF_Prenom">Prenom :</label></td>
					<td><input required="required" class="inputC" type="text" id="REF_Prenom" name="REF_Prenom"/></td>
					<td><label for="REF_Adresse">Adresse :</label></td>
					<td><textarea required="required" rows="5" class="inputC" id="REF_Adresse" name="REF_Adresse"/></td>
				</tr>
				<tr>
					<td><label for="REF_TelFixe">Téléphone Fixe :</label></td>
					<td><input required="required" class="inputC" type="text" id="REF_TelFixe" name="REF_TelFixe"/></td>
					<td><label for="REF_CodePostal">Code Postal :</label></td>
					<td><input required="required" class="inputC" type="text" id="REF_CodePostal" name="REF_CodePostal"/></td>
				</tr>
				<tr>
					<td><label for="REF_TelPort">Téléphone Portable :</label></td>
					<td><input required="required" class="inputC" type="text" id="REF_TelPort" name="REF_TelPort"/></td>
					<td><label for="REF_Ville">Ville :</label></td>
					<td><input required="required" class="inputC" type="text" id="REF_Ville" name="REF_Ville"/></td>
				</tr>
				
				<tr>
					<td><label for="REF_Fax">Fax :</label></td>
					<td><input required="required" class="inputC" type="text" id="REF_Fax" name="REF_Fax"/></td>
					<td><label for="REF_Mail">Adresse @mail :</label></td>
					<td><input class="inputC" type="text" id="REF_Mail" name="REF_Mail"/></td>
				</tr>
			</table>
			</br>
			<div align="center">
				<input type="reset" class="buttonC"value="Annuler">
				<input type="submit" class="buttonC" value="Ajouter">
			</div>
		</fieldset>
	</br><!-- ajouter une liste des prescipteurs-->
	<input type="hidden" id="Num_form" name="Num_form" value="3">
	</form>
</div>