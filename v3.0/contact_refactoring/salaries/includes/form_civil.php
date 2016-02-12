
<div class="form">
	<form>
		<div align="center">
			<label for="INS_DateEntretien"><u>Date de l'entretien* :</u></label>
			<input type="date" id="ASSOC_Date" name="ASSOC_Date" value="<?php echo date('Y-m-d', strtotime("next monday")); ?>" step="1" class="SpecialDate">
		</div>
		</br>
		<fieldset class="civilian_infos">
			<legend align="center"><h2> Coordonnées Civiles  </h2></legend>
			<p class="warning_infos" align="center"><b>/!\<i> Toutes ces informations sont nécessaires et obligatoires </i>/!\</b></p>
			<table>
				<tr>
					<td><label for="PER_Nom">Nom :</label></td>
					<td><input required="required" class="inputC" type="text" id="PER_Nom" name="PER_Nom"/></td>
					<td><label for="PER_Prenom">Prenom :</label></td>
					<td><input required="required" class="inputC" type="text" id="PER_Prenom" name="PER_Prenom"/></td>
				</tr>
				<tr>
					<td><label for="PER_DateNais">Date de Naissance :</label></td>
					<td><input required="required" class="inputC" type="date" id="PER_DateNais" name="PER_DateNais"/></td>
					<td><label for="PER_LieuNais">Lieu de Naissance :</label></td>
					<td><input required="required" class="inputC" type="text" id="PER_LieuNais" name="PER_LieuNais"/></td>
				</tr>
				<tr>
					<td><label for="PER_Nation">Nationalité :</label></td>
					<td><input required="required" class="inputC" type="date" id="PER_Nation" name="PER_Nation"/></td>
					<td><label for="PER_SitFam">Situation Familiale :</label></td>
					<td><input required="required" class="inputC" type="text" id="PER_SitFam" name="PER_SitFam"/></td>
				</tr>
				<tr>
					<td><label for="PER_Adresse">Adresse :</label></td>
					<td><textarea required="required" rows="5" class="inputC" id="PER_Adresse" name="PER_Adresse"/></td>
				</tr>
				<tr>
					<td><label for="PER_NumCaf">Numéro de CAF :</label></td>
					<td><input required="required" class="inputC" type="text" id="PER_NumCaf" name="PER_NumCaf"/></td>
					<td><label for="PER_NumPole">Numéro Pôle Emploi :</label></td>
					<td><input required="required" class="inputC" type="text" id="PER_NumPole" name="PER_NumPole"/></td>
				</tr>
				<tr>
					<td><label for="PER_NumSecu">Numéro de Sécurité Sociale :</label></td>
					<td><input required="required" class="inputC" type="text" id="PER_NumSecu" name="PER_NumSecu"/></td>
				</tr>
				<tr>
					<td><label for="PER_TelFixe">Téléphone Fixe :</label></td>
					<td><input required="required" class="inputC" type="text" id="PER_TelFixe" name="PER_TelFixe"/></td>
					<td><label for="PER_TelPort">Téléphone Portable :</label></td>
					<td><input required="required" class="inputC" type="text" id="PER_TelPort" name="PER_TelPort"/></td>
				</tr>
				<tr>
					<td><label for="PER_Mail">Adresse @mail :</label></td>
					<td><input class="inputC" type="text" id="PER_Mail" name="PER_Mail"/></td>
				</tr>
				<!--<tr>
					<td colspan="2"><p><b><u>Prevenir en cas d'urgence : </u></b></p></td>
				</tr>
				<tr>
					<td><label for="PER_PrevNom">Nom :</label></td>
					<td><input class="inputC" type="text" id="PER_PrevNom" name="PER_PrevNom"/></td>
				</tr>
				<tr>
					<td><label for="PER_PrevPrenom">Prenom :</label>
					<td><input class="inputC" type="text" id="PER_PrevPrenom" name="PER_PrevPrenom"/></td>
				</tr>
				<tr>
					<td><label for="PER_PrevTel">Numéro :</label>
					<td><input class="inputC" type="text" id="PER_PrevTel" name="PER_PrevTel"/></td>
				</tr>-->
			</table>
		</fieldset>
	</br>
	</form>
</div>