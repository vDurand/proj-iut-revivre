<?php
    $query_fonctions = mysqli_query($db, "SELECT * FROM Fonction WHERE FCT_Id <> 0 ORDER BY FCT_Nom");
?>
<div class="repertoire-bloc">
	<fieldset>
		<legend>Coordonnées civiles<span class="required-fields-info">Champs obligatoires*</span></legend>
		<table class="form_table">
			<tr>
				<td><label for="PER_Nom">Nom* :</label></td>
				<td><input required="required" class="inputC" type="text" id="PER_Nom" name="PER_Nom" <?php echo isset($personne["PER_Nom"]) ? 'value="'.stripslashes($personne["PER_Nom"]).'"' : "";?>/></td>
				<td><label for="PER_Prenom">Prénom* :</label></td>
				<td><input required="required" class="inputC" type="text" id="PER_Prenom" name="PER_Prenom" <?php echo isset($personne["PER_Prenom"]) ? 'value="'.stripslashes($personne["PER_Prenom"]).'"' : "";?>/></td>
			</tr>
			<tr>
				<td><label for="PER_Sexe">Sexe* :</label></td>
				<td>
					<input required="required" type="radio" id="PER_Sexe" name="PER_Sexe" value="true" <?php echo (isset($personne["PER_Sexe"]) && $personne["PER_Sexe"] == "true") ? 'checked="checked"' : "";?>/>
					<label>Homme</label>
                    <input type="radio" id="PER_Sexe" name="PER_Sexe" value="false" <?php echo (isset($personne["PER_Sexe"]) && $personne["PER_Sexe"] == "false" ) ? 'checked="checked"' : "";?>/>
					<label>Femme</label>
				</td>
				<td><label for="PER_DateN">Date de Naissance* :</label></td>
				<td><input required="required" class="inputC" type="date" id="PER_DateN" name="PER_DateN" <?php echo isset($personne["PER_DateN"]) ? 'value="'.$personne["PER_DateN"].'"' : "";?>/></td>
			</tr>
			<tr>
				<td><label for="PER_LieuN">Lieu de Naissance* :</label></td>
				<td><input required="required" class="inputC" type="text" id="PER_LieuN" name="PER_LieuN" <?php echo isset($personne["PER_LieuN"]) ? 'value="'.stripslashes($personne["PER_LieuN"]).'"' : "";?>/></td>
				<td><label for="PER_Nation">Nationalité* :</label></td>	
				<td><input required="required" class="inputC" type="text" id="PER_Nation" name="PER_Nation" <?php echo isset($personne["PER_Nation"]) ? 'value="'.stripslashes($personne["PER_Nation"]).'"' : "";?>/></td>
			</tr>
			<tr>
				<td><label for="PER_Adresse">Rue, lotissement :</label></td>
				<td><input class="inputC" type="text" id="PER_Adresse" name="PER_Adresse" <?php echo isset($personne["PER_Adresse"]) ? 'value="'.stripslashes($personne["PER_Adresse"]).'"' : "";?>/></td>
				<td><label for="PER_Ville">Ville :</label></td>
				<td><input class="inputC" type="text" id="PER_Ville" name="PER_Ville" <?php echo isset($personne["PER_Ville"]) ? 'value="'.stripslashes($personne["PER_Ville"]).'"' : "";?>/></td>
			</tr>
			<tr>
				<td><label for="PER_CodePostal">Code postal :</label></td>
				<td><input class="inputC" type="number" id="PER_CodePostal" name="PER_CodePostal" min="1000" max="99999" 
					<?php echo (isset($personne["PER_CodePostal"]) && $personne["PER_CodePostal"] > 999) ? 'value="'.$personne["PER_CodePostal"].'"' : "";?>/></td>
			</tr>
			<tr></tr>
			<tr>
				<td><label for="PER_NCaf">Numéro de CAF :</label></td>
				<td><input class="inputC" type="text" id="PER_NCaf" name="PER_NCaf" <?php echo isset($personne["PER_NCaf"]) ? 'value="'.$personne["PER_NCaf"].'"' : "";?>/></td>
				<td><label for="PER_NPoleEmp">Numéro Pôle Emploi :</label></td>
				<td><input class="inputC" type="text" id="PER_NPoleEmp" name="PER_NPoleEmp" <?php echo isset($personne["PER_NPoleEmp"]) ? 'value="'.$personne["PER_NPoleEmp"].'"' : "";?>/></td>
			</tr>
			<tr>
				<td><label for="PER_NSecu">Numéro de Sécurité Sociale* :</label></td>
				<td><input required="required" class="inputC" type="text" id="PER_NSecu" name="PER_NSecu" <?php echo isset($personne["PER_NSecu"]) ? 'value="'.$personne["PER_NSecu"].'"' : "";?>/></td>
			</tr>
			<tr></tr>
			<tr>
				<td><label for="PER_TelFixe">Téléphone Fixe :</label></td>
				<td><input class="inputC" type="text" id="PER_TelFixe" name="PER_TelFixe" maxlength="10" <?php echo isset($personne["PER_TelFixe"]) ? 'value="'.$personne["PER_TelFixe"].'"' : "";?>/></td>
				<td><label for="PER_TelPort">Téléphone Portable :</label></td>
				<td><input class="inputC" type="text" id="PER_TelPort" name="PER_TelPort" maxlength="10" <?php echo isset($personne["PER_TelPort"]) ? 'value="'.$personne["PER_TelPort"].'"' : "";?>/></td>
			</tr>
			<tr>
				<td><label for="PER_Fax">Fax :</label></td>
				<td><input class="inputC" type="text" id="PER_Fax" name="PER_Fax" maxlength="10" <?php echo isset($personne["PER_Fax"]) ? 'value="'.$personne["PER_Fax"].'"' : "";?>/></td>
				<td><label for="PER_Email">Adresse @ email :</label></td>
				<td><input class="inputC" type="text" id="PER_Email" name="PER_Email" <?php echo isset($personne["PER_Email"]) ? 'value="'.stripslashes($personne["PER_Email"]).'"' : "";?>/></td>
			</tr>

			<tr>
				<?php
					if($fonction && $_POST["TYP_Id"] <= 5){
				?>
				<td>
                    <label for="FCT_Id">Fonction* :</label>
                </td>
                <td style="position: relative;">
                    <div class="selectType">
                        <select id="FCT_Id" name="FCT_Id">
                            <option value="null" disabled="disabled" selected="selected">Choisir ...</option>
                        <?php
                        	while($data = mysqli_fetch_assoc($query_fonctions)){
                        ?>
                            <option value="<?php echo $data['FCT_Id']; ?>"<?php echo (isset($personne["FCT_Id"]) && $personne["FCT_Id"] == $data['FCT_Id']) ? ' selected="selected"' : "";?>><?php echo $data['FCT_Nom']; ?></option>
                        <?php
                        	}
                        ?>
                        </select>
                    </div>
                    <input type="button" value="+" id="addFunctionCross" class="delCross crossNextToField"/>
                </td>
                <?php
					}
					
					if($_POST["request_type"] == "edit"){
				?>
					<td><label for="SAL_DateSortie">Date de sortie :</label></td>
					<td><input type="date" id="SAL_DateSortie" name="SAL_DateSortie" class="inputC" step="1" <?php echo isset($personne["SAL_DateSortie"]) ? 'value="'.$personne["SAL_DateSortie"].'"' : "";?>></td>
				<?php
					}
				?>
			</tr>
		</table>
	</fieldset>
</div>
<?php
	if($fonction){
?>
<script type="text/javascript">
	$(document).ready(function(){
		$("#addFunctionCross").on("click", function(){
			if($("#FCT_Id").prop("disabled")){
				$(this).val("+");
				$("table.form_table tr").last().remove();
				$("#FCT_Id").prop("disabled", false);
			}
			else{
				$(this).val("-");
				$("#FCT_Id").prop("disabled", true);
				$('<tr><td><strong>&#8618;</strong></td><td><input type="text" class="inputC" placeholder="Nouvelle fonction" required="required" id="new_FCT_Id" name="new_FCT_Id"/></td></tr>')
					.insertAfter($("#addFunctionCross").parent().parent());
			}
		});
		<?php
			if(isset($personne["new_FCT_Id"])){
		?>
			$("#addFunctionCross").trigger("click");
			$("#new_FCT_Id").val("<?php echo $personne["new_FCT_Id"]; ?>");
			if(inputErrorList.new_FCT_Id != null){
				$("#new_FCT_Id").addClass("value-error");
			}
		<?php
			}
		?>
	});
</script>
<?php
	}
?>