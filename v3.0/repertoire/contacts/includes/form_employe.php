<!-- ajout d'un fournisseur -->
<h4>Ajout d'un employé :</h4>
<div class="repertoire-bloc">
	<fieldset class="civilian_infos">
		<legend>Coordonnées civiles<span class="required-fields-info">Champs obligatoires*</span></legend>
		<table class="form_table">
			<tbody>
				<tr>
					<td><label for="PER_Nom">Nom de l'employé* :</label></td>
					<td><input required="required" class="inputC" type="text" id="PER_Nom" name="PER_Nom" <?php echo isset($_POST["PER_Nom"]) ? 'value="'.stripslashes($_POST["PER_Nom"]).'"' : "";?>/></td>
					<td><label for="PER_Prenom">Prénom de l'employé* :</label></td>
					<td><input required="required" class="inputC" type="text" id="PER_Prenom" name="PER_Prenom" <?php echo isset($_POST["PER_Prenom"]) ? 'value="'.stripslashes($_POST["PER_Prenom"]).'"' : "";?>/></td>
				</tr>
				<tr></tr>
				<tr>
					<td><label for="PER_Adresse">Rue, lotissement* :</label></td>
					<td><input class="inputC" type="text" required="required" id="PER_Adresse" name="PER_Adresse" <?php echo isset($_POST["PER_Adresse"]) ? 'value="'.stripslashes($_POST["PER_Adresse"]).'"' : "";?>/></td>
					<td><label for="PER_CodePostal">Code postal* :</label></td>
					<td><input required="required" class="inputC" type="text" id="PER_CodePostal" name="PER_CodePostal" <?php echo isset($_POST["PER_CodePostal"]) ? 'value="'.stripslashes($_POST["PER_CodePostal"]).'"' : "";?>/></td>
				</tr>
				<tr>
					<td><label for="PER_Ville">Ville* :</label></td>
					<td><input required="required" class="inputC" type="text" id="PER_Ville" name="PER_Ville" <?php echo isset($_POST["PER_Ville"]) ? 'value="'.stripslashes($_POST["PER_Ville"]).'"' : "";?>/></td>
				</tr>
				<tr></tr>
				<tr>
					<td><label for="PER_TelFixe">Téléphone fixe :</label></td> 
					<td><input class="inputC" type="text" id="PER_TelFixe" name="PER_TelFixe" <?php echo isset($_POST["PER_TelFixe"]) ? 'value="'.stripslashes($_POST["PER_TelFixe"]).'"' : "";?>/></td>
					<td><label for="PER_TelPort">Téléphone portable :</label></td>
					<td><input class="inputC" type="text" id="PER_TelPort" name="PER_TelPort" <?php echo isset($_POST["PER_TelPort"]) ? 'value="'.stripslashes($_POST["PER_TelPort"]).'"' : "";?>/></td>
				</tr>
				<tr>
					<td><label for="PER_Fax">Fax :</label></td>
					<td><input class="inputC" type="text" id="PER_Fax" name="PER_Fax" <?php echo isset($_POST["PER_Fax"]) ? 'value="'.stripslashes($_POST["PER_Fax"]).'"' : "";?>/></td>
					<td><label for="PER_Email">Adresse @ email :</label></td>
					<td><input class="inputC" type="text" id="PER_Email" name="PER_Email" <?php echo isset($_POST["PER_Email"]) ? 'value="'.stripslashes($_POST["PER_Email"]).'"' : "";?>/></td>
				</tr>
				<tr></tr>
				<tr>
					<td><label for="Fonction">Fonction :</label></td>
					<td><input class="inputC" type="text" id="Fonction" name="Fonction" maxlength="40" <?php echo isset($_POST["Fonction"]) ? 'value="'.stripslashes($_POST["Fonction"]).'"' : "";?>/></td>
				</tr>
			</tbody>
		</table>
	</fieldset>
	<input type="hidden" id="Num_form" name="Num_form" value="3">
</div>