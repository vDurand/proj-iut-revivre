<div class="required-top-date">
	<label for="INS_DateEntretien">Date de l'entretien :</label>
	<input type="date" required="required" id="INS_DateEntretien" name="INS_DateEntretien" value="<?php echo date('Y-m-d', strtotime("next monday")); ?>" step="1"<?php echo isset($_POST["INS_DateEntretien"]) ? 'value="'.$_POST["INS_DateEntretien"].'"' : "";?>>
</div>