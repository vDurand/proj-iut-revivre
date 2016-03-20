<div class="required-top-date">
	<label for="INS_DateEntretien">Date de l'entretien :</label>
	<input type="date" required="required" id="INS_DateEntretien" name="INS_DateEntretien" step="1" <?php echo isset($personne["INS_DateEntretien"]) ? 'value="'.$personne["INS_DateEntretien"].'"' : "";?>>
</div>