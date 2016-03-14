<?php
    $query_fonctions = mysqli_query($db, "SELECT * FROM Fonction WHERE FCT_Id <> 0 ORDER BY FCT_Nom");
?>
<div class="repertoire-bloc">
	<fieldset>
		<legend>Coordonnées civiles<span class="required-fields-info">Champs obligatoires*</span></legend>
		<table class="form_table">
			<tr>
				<td><label for="PER_Nom">Nom* :</label></td>
				<td><input required="required" class="inputC" type="text" id="PER_Nom" name="PER_Nom" <?php echo isset($_POST["PER_Nom"]) ? 'value="'.stripslashes($_POST["PER_Nom"]).'"' : "";?>/></td>
				<td><label for="PER_Prenom">Prénom* :</label></td>
				<td><input required="required" class="inputC" type="text" id="PER_Prenom" name="PER_Prenom" <?php echo isset($_POST["PER_Prenom"]) ? 'value="'.stripslashes($_POST["PER_Prenom"]).'"' : "";?>/></td>
			</tr>
			<tr>
				<td><label for="PER_Sexe">Sexe* : </label></td>
				<td>
					<input required="required" type="radio" id="PER_Sexe" name="PER_Sexe" value="1" <?php echo (isset($_POST["PER_Sexe"]) && $_POST["PER_Sexe"] == "1" ) ? 'checked="checked"' : "";?>/>
					<label>Homme</label>
                    <input type="radio" id="PER_Sexe" name="PER_Sexe" value="0" <?php echo (isset($_POST["PER_Sexe"]) && $_POST["PER_Sexe"] == "0" ) ? 'checked="checked"' : "";?>/>
					<label>Femme</label>
				</td>
				<td><label for="PER_DateN">Date de Naissance* :</label></td>
				<td><input required="required" class="inputC" type="date" id="PER_DateN" name="PER_DateN" <?php echo isset($_POST["PER_DateN"]) ? 'value="'.$_POST["PER_DateN"].'"' : "";?>/></td>
			</tr>
			<tr>
				<td><label for="PER_LieuN">Lieu de Naissance* :</label></td>
				<td><input required="required" class="inputC" type="text" id="PER_LieuN" name="PER_LieuN" <?php echo isset($_POST["PER_LieuN"]) ? 'value="'.stripslashes($_POST["PER_LieuN"]).'"' : "";?>/></td>
				<td><label for="PER_Nation">Nationalité* :</label></td>	
				<td><input required="required" class="inputC" type="text" id="PER_Nation" name="PER_Nation" <?php echo isset($_POST["PER_Nation"]) ? 'value="'.stripslashes($_POST["PER_Nation"]).'"' : "";?>/></td>
			</tr>
			<tr>
				<td><label for="PER_Adresse">Rue, lotissement :</label></td>
				<td><input class="inputC" type="text" id="PER_Adresse" name="PER_Adresse" <?php echo isset($_POST["PER_Adresse"]) ? 'value="'.stripslashes($_POST["PER_Adresse"]).'"' : "";?>/></td>
				<td><label for="PER_Ville">Ville :</label></td>
				<td><input class="inputC" type="text" id="PER_Ville" name="PER_Ville" <?php echo isset($_POST["PER_Ville"]) ? 'value="'.stripslashes($_POST["PER_Ville"]).'"' : "";?>/></td>
			</tr>
			<tr>
				<td><label for="PER_CodePostal">Code postal :</label></td>
				<td><input class="inputC" type="number" id="PER_CodePostal" name="PER_CodePostal" min="1000" max="99999" <?php echo isset($_POST["PER_CodePostal"]) ? 'value="'.$_POST["PER_CodePostal"].'"' : "";?>/></td>
			</tr>
			<tr></tr>
			<tr>
				<td><label for="PER_NCaf">Numéro de CAF :</label></td>
				<td><input class="inputC" type="number" id="PER_NCaf" name="PER_NCaf" <?php echo isset($_POST["PER_NCaf"]) ? 'value="'.$_POST["PER_NCaf"].'"' : "";?>/></td>
				<td><label for="PER_NPoleEmp">Numéro Pôle Emploi :</label></td>
				<td><input class="inputC" type="number" id="PER_NPoleEmp" name="PER_NPoleEmp" <?php echo isset($_POST["PER_NPoleEmp"]) ? 'value="'.$_POST["PER_NPoleEmp"].'"' : "";?>/></td>
			</tr>
			<tr>
				<td><label for="PER_NSecu">Numéro de Sécurité Sociale* :</label></td>
				<td><input required="required" class="inputC" type="number" id="PER_NSecu" name="PER_NSecu" <?php echo isset($_POST["PER_NSecu"]) ? 'value="'.$_POST["PER_NSecu"].'"' : "";?>/></td>
			</tr>
			<tr></tr>
			<tr>
				<td><label for="PER_TelFixe">Téléphone Fixe :</label></td>
				<td><input class="inputC" type="number" id="PER_TelFixe" name="PER_TelFixe" <?php echo isset($_POST["PER_TelFixe"]) ? 'value="'.$_POST["PER_TelFixe"].'"' : "";?>/></td>
				<td><label for="PER_TelPort">Téléphone Portable :</label></td>
				<td><input class="inputC" type="number" id="PER_TelPort" name="PER_TelPort" <?php echo isset($_POST["PER_TelPort"]) ? 'value="'.$_POST["PER_TelPort"].'"' : "";?>/></td>
			</tr>
			<tr>
				<td><label for="PER_Fax">Fax :</label></td>
				<td><input class="inputC" type="number" id="PER_Fax" name="PER_Fax" <?php echo isset($_POST["PER_Fax"]) ? 'value="'.$_POST["PER_Fax"].'"' : "";?>/></td>
				<td><label for="PER_Email">Adresse @ email :</label></td>
				<td><input class="inputC" type="text" id="PER_Email" name="PER_Email" <?php echo isset($_POST["PER_Email"]) ? 'value="'.stripslashes($_POST["PER_Email"]).'"' : "";?>/></td>
			</tr>
		<?php
			if($fonction){
		?>
			<tr>
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
                            <option value="<?php echo $data['FCT_Id']; ?>"<?php echo (isset($_POST["FCT_Id"]) && $_POST["FCT_Id"] == $data['FCT_Id']) ? ' selected="selected"' : "";?>><?php echo $data['FCT_Nom']; ?></option>
                        <?php
                        	}
                        ?>
                        </select>
                    </div>
                    <input type="button" value="+" id="addFunctionCross" class="delCross crossNextToField"/>
                </td>
			</tr>
		<?php
			}
		?>
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
			if(isset($_POST["new_FCT_Id"])){
		?>
			$("#addFunctionCross").trigger("click");
			$("#new_FCT_Id").val("<?php echo $_POST["new_FCT_Id"]; ?>");
		<?php
			}
		?>
	});
</script>
<?php
	}
?>