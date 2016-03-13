<?php
	$query_conv = mysqli_query($db, 'SELECT CNV_Id, CNV_Nom FROM convention ORDER BY CNV_Id');
	$query_pres = mysqli_query($db, 'SELECT * FROM prescripteurs ORDER BY PRE_Id');
	$prescripteurs = mysqli_fetch_all($query_pres, MYSQLI_ASSOC);
	$query_contrat =  mysqli_query($db, "SELECT * FROM contrat ORDER BY CNT_id");
?>
<div class="repertoire-bloc">
	<fieldset>
		<legend>Informations complémentaires<span class="required-fields-info">Champs obligatoires*</span></legend>
		<table class="form_table">
			<tr>
				<td><label>Référent identifié* :</label></td>
				<td style="position:relative;">
					<div class="selectType">
						<select required="required" id="REF_NumRef" name="REF_NumRef">
							<option value="0" selected="selected" disabled="disabled">Choisir ...</option>
				    <?php
	                    for($x=0; $x<sizeof($prescripteurs); $x++)
	                    {
	                ?>
	                        <optgroup label="<?php echo $prescripteurs[$x]['PRE_Nom'] ?>">
	                    <?php
	                        $query = mysqli_query($db, "SELECT * FROM Referents 
							                        	JOIN Personnes USING (PER_NUM) 
							                        	JOIN Prescripteurs USING (PRE_Id)
							                        	WHERE PER_Nom <> '' AND PER_Prenom <> '' AND PRE_Id = ".$prescripteurs[$x]["PRE_Id"]." ORDER BY PER_Nom, PER_Prenom");
	                        while($data = mysqli_fetch_assoc($query)){
	                            echo '<option value="'.$data['REF_NumRef'].'">'.$data['PER_Nom'].' '.$data['PER_Prenom'].'</option>';
	                        }
	                	?>
	                        </optgroup>
          			<?php
	                    }
	                ?>
                    	</select>
					</div>
					<input type="button" value="+" id="addReferentCross" class="delCross crossNextToField"/>
				</td>
				<td><label for="INS_DateEntree">Date d'entrée* :</label></td>
				<td><input required="required" type="date" id="INS_DateEntree" name="INS_DateEntree" class="inputC" step="1"></td>
			</tr>
			<tr>
				<td><label>Convention* :</label></td>
				<td>
					<div class="selectType">
						<select required="required" id="CNV_Id" name="CNV_Id">	
							<option value="0" selected="selected" disabled="disabled">Choisir ...</option>
						<?php
							while($data = mysqli_fetch_assoc($query_conv)){
								echo '<option value="'.$data["CNV_Id"].'">'.$data["CNV_Nom"].'</option>';
							}
						?>
						</select>
					</div>
				</td>
			</tr>
			<tr></tr>
			<tr>
				<td>Type de contrat* :</td>
				<td>
					<div class="selectType">
						<select required="required" id="CNT_Id" name="CNT_Id">
							<option value="0" selected="selected" disabled="disabled">Choisir ...</option>
						<?php
							while($data = mysqli_fetch_assoc($query_contrat)){
								echo '<option value="'.$data["CNT_Id"].'">'.$data["CNT_Nom"].'</option>';
							}	
						?>
						</select>
					</div>
				</td>
				<td><label for="INS_NbHeures">Nombre d'heures :</label></td>
				<td><input class="inputC" type="number" id="INS_NbHeures" name="INS_NbHeures" value="0"/></td>
			</tr>
			<tr></tr>
			<tr>
				<td><label>Prescripteurs* :</label></td>
				<td style="position:relative;">
					<div class="selectType">
						<select required="required" id="PRE_Id" name="PRE_Id">	
							<option value="0" selected="selected" disabled="disabled">Choisir ...</option>
						<?php
							for($x=0; $x<sizeof($prescripteurs); $x++){
								echo '<option value="'.$prescripteurs[$x]["PRE_Id"].'">'.$prescripteurs[$x]["PRE_Nom"].'</option>';
							}
						?>
						</select>
					</div>
					<input type="button" value="+" id="addPrescripteurCross" class="delCross crossNextToField"/>
				</td>
				<td>Niveau Scolaire* :</td>
				<td>
					<div class="selectType">
						<select required="required" id="INS_NivScol" name="INS_NivScol">
							<option value="0" disabled="disabled" selected="selected"> Choisir ... </option>
	                        <option value="Non scolarisé">Non scolarisé</option>
	                        <option value="3 et +">3 et +</option>
	                        <option value="4">4</option>
	                        <option value="5">5</option>
	                        <option value="5 Bis">5 Bis</option>
	                        <option value="6">6</option>
						</select>
					</div>
				</td>
			</tr>
			<tr>
				<td>Diplôme* :</td>
				<td>
					<div class="selectType">
						<select required="required" id="INS_Diplome" name="INS_Diplome">
							<option value="0" disabled="disabled" selected="selected"> Choisir ... </option>
							<option value="Aucun">Sans</option>
							<option value="Brevet">Brevet des Colèges</option>
							<option value="CAP">CAP-BEP</option>
							<option value="BAC">BAC</option>
							<option value="MOR">BAC et plus ...</option>
						</select>
					</div>
				</td>
				<td><label for="INS_RecoTH">Reconnaissance TH : </label></td>
				<td><input type="checkbox" id="INS_RecoTH" name="INS_RecoTH" value="1"></td>
			</tr>
			<tr>
				<td><label for="INS_SituationF">Situation Familiale :</label></td>
				<td><input required="required" class="inputC" type="text" id="INS_SituationF" name="INS_SituationF"/></td>
				<td><label for="INS_Permis">Permis : </label></td>
				<td><input type="checkbox" id="INS_Permis" name="INS_Permis" value="1"></td>
			</tr>
			<tr>
				<td>Revenus* :</td>
				<td>
					<div class="selectType">
						<select required="required" id="INS_Revenu" name="INS_Revenu">
							<option value="0" disabled="disabled" selected="selected"> Choisir ... </option>
							<option value="RSA">RSA</option>
							<option value="ASS">ASS</option>
							<option value="ARE">ARE</option>
							<option value="AAH">AAH</option>
							<option value="Autre revenu">Autre revenu</option>
							<option value="Aucun">Aucun</option>
						</select>
					</div>
				</td>
				<td>Revenus depuis* :</td>
				<td>
					<div class="selectType">
						<select required="required" id="INS_RevenuDepuis" name="INS_RevenuDepuis">
							<option value="0" disabled="disabled" selected="selected"> Choisir ... </option>
							<option value="Moins de 6 mois">Moins de 6 mois</option>
							<option value="De 6 à 11 mois">De 6 à 11 mois</option>
							<option value="De 12 à 23 mois">De 12 à 23 mois</option>
							<option value="24 mois et plu">24 mois et plus</option>
						</select>
					</div>
				</td>
			</tr>
			<tr>
				<td>Inscris à Pôle Emploi depuis* : </td>
				<td>
					<div class="selectType">
						<select required="required" id="INS_PEDepuis" name="INS_PEDepuis">
							<option value="0" disabled="disabled" selected="selected"> Choisir ... </option>
							<option value="Moins de 6 mois">Moins de 6 mois</option>
							<option value="De 6 à 11 mois">De 6 à 11 mois</option>
							<option value="De 12 à 23 mois">De 12 à 23 mois</option>
							<option value="24 mois et plu">24 mois et plus</option>
							<option value="Aucun">Aucun</option>
						</select>
					</div>
				</td>
				<td>Sans emploi depuis depuis* :</td>
				<td>
					<div class="selectType">
						<select required="required" id="INS_SEDepuis" name="INS_SEDepuis">
							<option value="0" disabled="disabled" selected="selected"> Choisir ... </option>
							<option value="Moins de 6 mois">Moins de 6 mois</option>
							<option value="De 6 à 11 mois">De 6 à 11 mois</option>
							<option value="De 12 à 23 mois">De 12 à 23 mois</option>
							<option value="24 mois et plu">24 mois et plus</option>
							<option value="Aucun">Aucun</option>
						</select>
					</div>
				</td>
			</tr>
			<tr>
				<td>Position Atelier CAP* :</td>
				<td>
					<div class="selectType">
                        <select required="required" id="INS_Positionmt" name="INS_Positionmt">
                        	<option value="0" disabled="disabled" selected="selected"> Choisir ... </option>
                            <option value="GOB (ACI)">GOB (ACI)</option>
                            <option value="SOB (ACI)">SOB (ACI)</option>
                            <option value="Equipe propreté (ACI)">Equipe propreté (ACI)</option>
                            <option value="Agent de conditionnement (Filt) (ACI)">Agent de conditionnement (Filt) (ACI)</option>
                            <option value="Chauffeur-Magasinier (ACI)">Chauffeur-Magasinier (ACI)</option>
                            <option value="Agent de conditionnement (AVA)">Agent de conditionnement (AVA)</option>
                            <option value="CAP Vert (AUS)">CAP Vert (AUS)</option>
                        </select>
					</div>
				</td>
				<td>Mutuelle* :</td>
				<td>
					<div class="selectType">
						<select required="required" id="INS_Mutuelle" name="INS_Mutuelle">
							<option value="0" disabled="disabled" selected="selected"> Choisir ... </option>
							<option value="CMU">CMU</option>
							<option value="CMU_Comp">CMU Complémentaire</option>
							<option value="Autre mutuelle">Autre mutuelle</option>
							<option value="Aucune">Pas de mutuelle</option>
						</select>
					</div>
				</td>
			</tr>
			<tr>
				<td>Situation Géographique* :</td>
				<td>
					<div class="selectType">
						<select required="required" id="INS_SituGeo" name="INS_SituGeo">
							<option value="0" disabled="disabled" selected="selected"> Choisir ... </option>
							<option value="CUCS">CUCS</option>
							<option value="ZUS">ZUS</option>
						</select>
					</div>
				</td>

			</tr>
			<tr></tr>
			<tr>
				<td><label for="INS_Repas">Repas* : </label></td>
				<td>
					<input required="required" type="radio" id="INS_Repas" name="INS_Repas" value="1">
					<label>Oui</label>
                    <input type="radio" id="INS_Repas" name="INS_Repas" value="0">
					<label>Non</label>
				</td>
				<td><label for="INS_TRepas">Type de repas*: </label></td>
				<td>
					<input required="required" type="radio" id="INS_TRepas" name="INS_TRepas" value="1">
					<label>Avec porc</label>
                    <input type="radio" id="INS_TRepas" name="INS_TRepas" value="0">
					<label>Sans porc</label>
				</td>
			</tr>
			<tr></tr>
			<tr>
				<td><label for="INS_PlusDetails">Autres détails :</label></td>
				<td colspan="3"><textarea rows="2" id="INS_PlusDetails" name="INS_PlusDetails"/></td>
			</tr>
		</table>
	</fieldset>
</div>
<script type="text/javascript">
	$("#addReferentCross").on("click", function(){
		if($("#REF_NumRef").prop("disabled")){
			$(this).val("+");
			$("#REF_NumRef").parent().parent().parent().next().remove();
			$("#REF_NumRef").prop("disabled", false);
		}
		else{
			$(this).val("-");
			$("#REF_NumRef").prop("disabled", true);
			$('<tr><td><strong>&#8618;</strong></td><td><input type="text" id="NewRefNom"    name="NewReNom"     class="inputC" placeholder="Nom" required="required"/></td><td><input type="text" id="NewRefPrenom" name="NewRefPrenom" class="inputC" placeholder="Prenom" required="required"/></td></tr>').insertAfter($("#REF_NumRef").parent().parent().parent());
		}
	});

	$("#addPrescripteurCross").on("click", function(){
		if($("#PRE_Id").prop("disabled")){
			$(this).val("+");
			$("#PRE_Id").parent().parent().parent().next().remove();
			$("#PRE_Id").prop("disabled", false);
		}
		else{
			$(this).val("-");
			$("#PRE_Id").prop("disabled", true);
			$('<tr><td><strong>&#8618;</strong></td><td><input type="text" id="NewPre" name="Newpre" class="inputC" placeholder="Nouveau prescripteur" required="required"/></td></tr>').insertAfter($("#PRE_Id").parent().parent().parent());
		}
	});
</script>