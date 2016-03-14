<div class="repertoire-bloc">
	<fieldset>
		<legend>Personne à contacter en cas d'urgence</legend>
		<table class="form_table">
			<tr>
				<td><label for="INS_UrgNom">Nom :</label></td>
				<td><input class="inputC" type="text" id="INS_UrgNom" name="INS_UrgNom" <?php echo isset($_POST["INS_UrgNom"]) ? 'value="'.stripslashes($_POST["INS_UrgNom"]).'"' : "";?>/></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td><label for="INS_UrgPrenom">Prénom :</label></td>
				<td><input class="inputC" type="text" id="INS_UrgPrenom" name="INS_UrgPrenom" <?php echo isset($_POST["INS_UrgPrenom"]) ? 'value="'.stripslashes($_POST["INS_UrgPrenom"]).'"' : "";?>/></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td><label for="INS_UrgTel">Téléphone :</label></td>
				<td><input class="inputC" type="number" id="INS_UrgTel" name="INS_UrgTel" <?php echo isset($_POST["INS_UrgTel"]) ? 'value="'.$_POST["INS_UrgTel"].'"' : "";?>/></td>
				<td></td>
				<td></td>
			</tr>
		</table>
	</fieldset>
</div>