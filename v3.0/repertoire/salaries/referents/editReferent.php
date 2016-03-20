<?php
    $pageTitle = "Édition d'un référent";
    $pwd='../../../';
    include($pwd.'bandeau.php');

    if(isset($_POST["REF_NumRef"]) && !empty($_POST["REF_NumRef"])){

	    $query_pres = mysqli_query($db, 'SELECT * FROM prescripteurs ORDER BY PRE_Nom');
	    if(!isset($_POST["Post_Errors"])){
	    	$reponse1 = mysqli_query($db, "SELECT * FROM referents JOIN personnes USING(PER_Num) JOIN prescripteurs PRE_Id WHERE REF_NumRef = '".$_POST["REF_NumRef"]."'");
	    	$personne = mysqli_fetch_assoc($reponse1);	
	    }
	    else{
	    	foreach ($_POST as $key => $value){
           		$personne[$key] = $value;
        	}
	    }

        if($personne["PER_Sexe"] == 1 || $personne["PER_Sexe"] == "true"){
            $sexe = 'M.';
            $personne["PER_Sexe"] = "true";
        }
        else{
            $sexe = 'Mme';
            $personne["PER_Sexe"] = "false";
        }
?>
<div id="corps">
	<div id="labelT">
		<label>Édition du référent <?php echo $sexe." ".stripslashes($personne["PER_Nom"])." ".stripslashes($personne["PER_Prenom"]) ?></label>
	</div>
	<?php
		if(isset($_POST["Post_Errors"]) && !empty($_POST["Post_Errors"])){
	        include_once("includes/form_errors.php");
	    }
	?>
	<form method="POST" action="postReferent.php">
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
				<tr></tr>
				<tr>
					<td>Prescripteur lié :</td>
					<td>
						<div class="selectType">
							<select required="required" id="PRE_Id" name="PRE_Id">
								<option value="0" selected="selected" disabled="disabled">Choisir ...</option>
								<?php
									while($prescripteurs = mysqli_fetch_assoc($query_pres)){
										echo '<option value="'.$prescripteurs["PRE_Id"].'"'.((isset($personne["PRE_Id"]) && $personne["PRE_Id"] == $prescripteurs["PRE_Id"]) ? ' selected="selected"' : "").'>'
												.$prescripteurs["PRE_Nom"].'</option>';
									}
								?>
							</select>
						</div>
					</td>
				</tr>
			</table>
		</fieldset>
	</div>
		<input type="hidden" id="REF_NumRef" name="REF_NumRef" value="<?php echo $_POST["REF_NumRef"]; ?>"/>
		<input type="hidden" id="PER_Num" name="PER_Num" value="<?php echo $personne["PER_Num"]; ?>"/>
		<div class="repertoire-manage-buttons">
			<input type="button" value="Annuler" class="buttonC" onclick="$.redirect('./showReferent.php', {'RefNum':'<?php echo $_POST["REF_NumRef"]; ?>'}, 'get');"/>
			<input type="submit" value="Valider" class="buttonC"/>
		</div>
	</form>
</div>
<?php
	}
?>