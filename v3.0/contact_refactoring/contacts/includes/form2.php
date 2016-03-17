<!-- ajout d'un client -->
<div class="repertoire-bloc">
	<fieldset class="civilian_infos">
		<legend>Coordonnées civiles<span class="required-fields-info">Champs obligatoires*</span></legend>
		<table class="form_table">
			<tbody>
			<?php
				if(isset($client_edit) && $client_edit){
			?>
						<tr>
							<td colspan="4" class="align-center">
								<input type="radio" id="CLI_structure" name="CLI_type" class="CLI_type" checked="checked" value="1"><label for="CLI_type">Structure</label>
								<input type="radio" id="CLI_particulier" name="CLI_type" class="CLI_type" value="2"><label for="CLI_type">Particulier</label>
							</td>
						</tr>
						<tr></tr>
			<?php
				}
			?>
				<tr>
					<td><label for="CLI_Nom">Nom <span id="client_type">de la structure</span>* :</label></td>
					<td><input required="required" class="inputC" type="text" id="CLI_Nom" name="CLI_Nom" <?php echo isset($client["CLI_Nom"]) ? 'value="'.stripslashes($client["CLI_Nom"]).'"' : "";?> /></td>
			<?php
				if(isset($client_edit) && $client_edit){
			?>
					<td><label for="CLI_Prenom" id="label_CLI_Prenom" style="display: none;">Prénom du particulier*:</label></td>
					<td><input class="inputC" type="text" id="CLI_Prenom" name="CLI_Prenom" style="display: none;" <?php echo isset($client["CLI_Prenom"]) ? 'value="'.stripslashes($client["CLI_Prenom"]).'"' : "";?>/></td>
			<?php
				}
				else{
					if(isset($client["CLI_Prenom"])){
			?>
						<td><label for="CLI_Prenom" id="label_CLI_Prenom">Prénom du particulier*:</label></td>
						<td><input class="inputC" type="text" id="CLI_Prenom" name="CLI_Prenom" <?php echo 'value="'.stripslashes($client["CLI_Prenom"]).'"';?>/></td>
			<?php
					}
				}
			?>
				</tr>
				<tr></tr>
				<tr>
					<td><label for="CLI_Adresse">Rue, lotissement* :</label></td>
					<td><input class="inputC" type="text" required="required" id="CLI_Adresse" name="CLI_Adresse" <?php echo isset($client["CLI_Adresse"]) ? 'value="'.stripslashes($client["CLI_Adresse"]).'"' : "";?>/></td>
					<td><label for="CLI_CodePostal">Code postal* :</label></td>
					<td><input required="required" class="inputC" type="text" id="CLI_CodePostal" name="CLI_CodePostal" <?php echo isset($client["CLI_CodePostal"]) ? 'value="'.stripslashes($client["CLI_CodePostal"]).'"' : "";?>/></td>
				</tr>
				<tr>
					<td><label for="CLI_Ville">Ville* :</label></td>
					<td><input required="required" class="inputC" type="text" id="CLI_Ville" name="CLI_Ville" <?php echo isset($client["CLI_Ville"]) ? 'value="'.stripslashes($client["CLI_Ville"]).'"' : "";?>/></td>
				</tr>
				<tr></tr>
				<tr>
					<td><label for="CLI_TelFixe">Téléphone fixe :</label></td>
					<td><input class="inputC" type="text" id="CLI_TelFixe" name="CLI_TelFixe" <?php echo isset($client["CLI_TelFixe"]) ? 'value="'.stripslashes($client["CLI_TelFixe"]).'"' : "";?>/></td>
					<td><label for="CLI_TelPort">Téléphone portable :</label></td>
					<td><input class="inputC" type="text" id="CLI_TelPort" name="CLI_TelPort" <?php echo isset($client["CLI_TelPort"]) ? 'value="'.stripslashes($client["CLI_TelPort"]).'"' : "";?>/></td>
				</tr>
				<tr>
					<td><label for="CLI_Fax">Fax :</label></td>
					<td><input class="inputC" type="text" id="CLI_Fax" name="CLI_Fax" <?php echo isset($client["CLI_Fax"]) ? 'value="'.stripslashes($client["CLI_Fax"]).'"' : "";?>/></td>
					<td><label for="CLI_Email">Adresse @ email :</label></td>
					<td><input class="inputC" type="text" id="CLI_Email" name="CLI_Email" <?php echo isset($client["CLI_Email"]) ? 'value="'.stripslashes($client["CLI_Email"]).'"' : "";?>/></td>
				</tr>
			</tbody>
		</table>
	</fieldset>
	<input type="hidden" id="Num_form" name="Num_form" value="2">
</div>
<script type="text/javascript">
	$(".CLI_type").on("change", function(){
		if($(this).prop("id") == "CLI_structure"){
			$("#label_CLI_Prenom, #CLI_Prenom").hide();
			$("#CLI_Prenom").prop("required", "");
			$("#CLI_Prenom").val("");
			$("#client_type").html("de la structure");
		}
		else{
			$("#label_CLI_Prenom, #CLI_Prenom").show();
			$("#CLI_Prenom").prop("required", "required");
			$("#client_type").html("du particulier");
		}
	});
</script>

