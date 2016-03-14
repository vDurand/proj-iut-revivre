<!-- ajout d'un client -->
<div class="repertoire-bloc">
	<fieldset class="civilian_infos">
		<legend>Coordonnées civiles<span class="required-fields-info">Champs obligatoires*</span></legend>
		<table class="form_table">
			<tbody>
				<tr>
					<td colspan="4" class="align-center">
						<input type="radio" id="CLI_structure" name="CLI_type" class="CLI_type" checked="checked" value="1"><label for="CLI_type">Structure</label>
						<input type="radio" id="CLI_particulier" name="CLI_type" class="CLI_type" value="2"><label for="CLI_type">Particulier</label>
					</td>
				</tr>
				<tr></tr>
				<tr>
					<td><label for="CLI_Nom">Nom <span id="client_type">de la structure</span>* :</label></td>
					<td><input required="required" class="inputC" type="text" id="CLI_Nom" name="CLI_Nom"/></td>
					<td><label for="CLI_Prenom" id="label_CLI_Prenom" style="display: none;">Prénom du particulier:</label></td>
					<td><input class="inputC" type="text" id="CLI_Prenom" name="CLI_Prenom" style="display: none;"/></td>
				</tr>
				<tr></tr>
				<tr>
					<td><label for="CLI_Adresse">Rue, lotissement* :</label></td>
					<td><input class="inputC" type="text" required="required" id="CLI_Adresse" name="CLI_Adresse"/></td>
					<td><label for="CLI_CodePostal">Code postal* :</label></td>
					<td><input required="required" class="inputC" type="text" id="CLI_CodePostal" name="CLI_CodePostal"/></td>
				</tr>
				<tr>
					<td><label for="CLI_Ville">Ville* :</label></td>
					<td><input required="required" class="inputC" type="text" id="CLI_Ville" name="CLI_Ville"/></td>
				</tr>
				<tr></tr>
				<tr>
					<td><label for="CLI_TelFixe">Téléphone fixe* :</label></td>
					<td><input required="required" class="inputC" type="text" id="CLI_TelFixe" name="CLI_TelFixe"/></td>
					<td><label for="CLI_TelPort">Téléphone portable :</label></td>
					<td><input class="inputC" type="text" id="CLI_TelPort" name="CLI_TelPort"/></td>
				</tr>
				<tr>
					<td><label for="CLI_Fax">Fax :</label></td>
					<td><input class="inputC" type="text" id="CLI_Fax" name="CLI_Fax"/></td>
					<td><label for="CLI_Mail">Adresse @ email :</label></td>
					<td><input class="inputC" type="text" id="CLI_Mail" name="CLI_Mail"/></td>
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

