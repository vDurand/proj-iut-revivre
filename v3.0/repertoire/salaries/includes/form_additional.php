<?php
	$query_conv = mysqli_query($db, 'SELECT CNV_Id, CNV_Nom FROM convention ORDER BY CNV_Id');
	$query_pres = mysqli_query($db, 'SELECT * FROM prescripteurs ORDER BY PRE_Nom');
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
	                            echo '<option value="'.$data['REF_NumRef'].'"'.((isset($personne["REF_NumRef"]) && $personne["REF_NumRef"] == $data['REF_NumRef']) ? ' selected="selected"' : "").'>'
	                            		.$data['PER_Nom'].' '.$data['PER_Prenom'].'</option>';
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
				<td><input required="required" type="date" id="INS_DateEntree" name="INS_DateEntree" class="inputC" step="1" <?php echo isset($personne["INS_DateEntree"]) ? 'value="'.$personne["INS_DateEntree"].'"' : "";?>></td>
			</tr>
			<tr>
				<td><label>Convention* :</label></td>
				<td>
					<div class="selectType">
						<select required="required" id="CNV_Id" name="CNV_Id">	
							<option value="0" selected="selected" disabled="disabled">Choisir ...</option>
						<?php
							while($data = mysqli_fetch_assoc($query_conv)){
								echo '<option value="'.$data["CNV_Id"].'"'.((isset($personne["CNV_Id"]) && $personne["CNV_Id"] == $data['CNV_Id']) ? ' selected="selected"' : "").'>'.$data["CNV_Nom"].'</option>';
							}
						?>
						</select>
					</div>
				</td>
				<td><label for="INS_SituationF">Situation Familiale :</label></td>
				<td><input class="inputC" type="text" id="INS_SituationF" name="INS_SituationF" <?php echo isset($personne["INS_SituationF"]) ? 'value="'.stripslashes($personne["INS_SituationF"]).'"' : "";?>/></td>
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
								echo '<option value="'.$data["CNT_Id"].'"'.((isset($personne["CNT_Id"]) && $personne["CNT_Id"] == $data['CNT_Id']) ? ' selected="selected"' : "").'>'.$data["CNT_Nom"].'</option>';
							}	
						?>
						</select>
					</div>
				</td>
				<td><label for="INS_NbHeures">Nombre d'heures :</label></td>
				<td><input class="inputC" type="number" id="INS_NbHeures" name="INS_NbHeures" <?php echo isset($personne["INS_NbHeures"]) ? 'value="'.$personne["INS_NbHeures"].'"' : 'value="0"';?>/></td>
			</tr>
			<tr></tr>
			<tr>
				<td>Niveau Scolaire* :</td>
				<td>
					<div class="selectType">
						<select required="required" id="INS_NivScol" name="INS_NivScol">
							<option value="0" disabled="disabled" selected="selected">Choisir ...</option>
	                        <option value="Non scolarisé"<?php echo (isset($personne["INS_NivScol"]) && $personne["INS_NivScol"] == "Non scolarisé") ? ' selected="selected"' : "";?>>Non scolarisé</option>
	                        <option value="3 et +"<?php echo (isset($personne["INS_NivScol"]) && $personne["INS_NivScol"] == "3 et +") ? ' selected="selected"' : "";?>>3 et +</option>
	                        <option value="4"<?php echo (isset($personne["INS_NivScol"]) && $personne["INS_NivScol"] == "4") ? ' selected="selected"' : "";?>>4</option>
	                        <option value="5"<?php echo (isset($personne["INS_NivScol"]) && $personne["INS_NivScol"] == "5") ? ' selected="selected"' : "";?>>5</option>
	                        <option value="5 Bis"<?php echo (isset($personne["INS_NivScol"]) && $personne["INS_NivScol"] == "5 Bis") ? ' selected="selected"' : "";?>>5 Bis</option>
	                        <option value="6"<?php echo (isset($personne["INS_NivScol"]) && $personne["INS_NivScol"] == "6") ? ' selected="selected"' : "";?>>6</option>
						</select>
					</div>
				</td>
				<td>Diplôme* :</td>
				<td>
					<div class="selectType">
						<select required="required" id="INS_Diplome" name="INS_Diplome">
							<option value="0" disabled="disabled" selected="selected">Choisir ...</option>
							<option value="Sans"<?php echo (isset($personne["INS_Diplome"]) && $personne["INS_Diplome"] == "Sans") ? ' selected="selected"' : "";?>>Sans</option>
							<option value="Brevet des collèges"<?php echo (isset($personne["INS_Diplome"]) && $personne["INS_Diplome"] == "Brevet des collèges") ? ' selected="selected"' : "";?>>Brevet des Colèges</option>
							<option value="CAP - BEP"<?php echo (isset($personne["INS_Diplome"]) && $personne["INS_Diplome"] == "CAP - BEP") ? ' selected="selected"' : "";?>>CAP-BEP</option>
							<option value="BAC"<?php echo (isset($personne["INS_Diplome"]) && $personne["INS_Diplome"] == "BAC") ? ' selected="selected"' : "";?>>BAC</option>
							<option value="Et plus"<?php echo (isset($personne["INS_Diplome"]) && $personne["INS_Diplome"] == "Et plus") ? ' selected="selected"' : "";?>>BAC et plus ...</option>
						</select>
					</div>
				</td>
			</tr>
			<tr>
				<td><label for="INS_RecoTH">Reconnaissance TH :</label></td>
				<td><input type="checkbox" id="INS_RecoTH" name="INS_RecoTH" value="1" <?php echo (isset($personne["INS_RecoTH"]) && $personne["INS_RecoTH"] == "1") ? 'checked="checked"' : "";?>></td>
				<td><label for="INS_Permis">Permis : </label></td>
				<td><input type="checkbox" id="INS_Permis" name="INS_Permis" value="1" <?php echo (isset($personne["INS_Permis"]) && $personne["INS_Permis"] == "1") ? 'checked="checked"' : "";?>></td>
			</tr>
			<tr>
				<td>Revenus* :</td>
				<td>
					<div class="selectType">
						<select required="required" id="INS_Revenu" name="INS_Revenu">
							<option value="0" disabled="disabled" selected="selected">Choisir ...</option>
							<option value="RSA"<?php echo (isset($personne["INS_Revenu"]) && $personne["INS_Revenu"] == "RSA") ? ' selected="selected"' : "";?>>RSA</option>
							<option value="ASS"<?php echo (isset($personne["INS_Revenu"]) && $personne["INS_Revenu"] == "ASS") ? ' selected="selected"' : "";?>>ASS</option>
							<option value="ARE"<?php echo (isset($personne["INS_Revenu"]) && $personne["INS_Revenu"] == "ARE") ? ' selected="selected"' : "";?>>ARE</option>
							<option value="AAH"<?php echo (isset($personne["INS_Revenu"]) && $personne["INS_Revenu"] == "AAH") ? ' selected="selected"' : "";?>>AAH</option>
							<option value="Autre revenu"<?php echo (isset($personne["INS_Revenu"]) && $personne["INS_Revenu"] == "Autre revenu") ? ' selected="selected"' : "";?>>Autre revenu</option>
							<option value="Aucun"<?php echo (isset($personne["INS_Revenu"]) && $personne["INS_Revenu"] == "Aucun") ? ' selected="selected"' : "";?>>Aucun</option>
						</select>
					</div>
				</td>
				<td>Revenus depuis* :</td>
				<td>
					<div class="selectType">
						<select required="required" id="INS_RevenuDepuis" name="INS_RevenuDepuis">
							<option value="0" disabled="disabled" selected="selected">Choisir ...</option>
							<option value="Moins de 6 mois"<?php echo (isset($personne["INS_RevenuDepuis"]) && $personne["INS_RevenuDepuis"] == "Moins de 6 mois") ? ' selected="selected"' : "";?>>Moins de 6 mois</option>
							<option value="De 6 à 11 mois"<?php echo (isset($personne["INS_RevenuDepuis"]) && $personne["INS_RevenuDepuis"] == "De 6 à 11 mois") ? ' selected="selected"' : "";?>>De 6 à 11 mois</option>
							<option value="De 12 à 23 mois"<?php echo (isset($personne["INS_RevenuDepuis"]) && $personne["INS_RevenuDepuis"] == "De 12 à 23 mois") ? ' selected="selected"' : "";?>>De 12 à 23 mois</option>
							<option value="De 24 mois et plus"<?php echo (isset($personne["INS_RevenuDepuis"]) && $personne["INS_RevenuDepuis"] == "De 24 mois et plus") ? ' selected="selected"' : "";?>>24 mois et plus</option>
						</select>
					</div>
				</td>
			</tr>
			<tr>
				<td>Inscris à Pôle Emploi depuis* : </td>
				<td>
					<div class="selectType">
						<select required="required" id="INS_PEDepuis" name="INS_PEDepuis">
							<option value="0" disabled="disabled" selected="selected">Choisir ...</option>
							<option value="Non inscrit"<?php echo (isset($personne["INS_PEDepuis"]) && $personne["INS_PEDepuis"] == "Non inscrit") ? ' selected="selected"' : "";?>>Non inscrit</option>
							<option value="Moins de 6 mois"<?php echo (isset($personne["INS_PEDepuis"]) && $personne["INS_PEDepuis"] == "Moins de 6 mois") ? ' selected="selected"' : "";?>>Moins de 6 mois</option>
							<option value="De 6 à 11 mois"<?php echo (isset($personne["INS_PEDepuis"]) && $personne["INS_PEDepuis"] == "De 6 à 11 mois") ? ' selected="selected"' : "";?>>De 6 à 11 mois</option>
							<option value="De 12 à 23 mois"<?php echo (isset($personne["INS_PEDepuis"]) && $personne["INS_PEDepuis"] == "De 12 à 23 mois") ? ' selected="selected"' : "";?>>De 12 à 23 mois</option>
							<option value="De 24 mois et plus"<?php echo (isset($personne["INS_PEDepuis"]) && $personne["INS_PEDepuis"] == "De 24 mois et plus") ? ' selected="selected"' : "";?>>24 mois et plus</option>
						</select>
					</div>
				</td>
				<td>Sans emploi depuis* :</td>
				<td>
					<div class="selectType">
						<select required="required" id="INS_SEDepuis" name="INS_SEDepuis">
							<option value="0" disabled="disabled" selected="selected">Choisir ...</option>
							<option value="Moins de 6 mois"<?php echo (isset($personne["INS_SEDepuis"]) && $personne["INS_SEDepuis"] == "Moins de 6 mois") ? ' selected="selected"' : "";?>>Moins de 6 mois</option>
							<option value="De 6 à 11 mois"<?php echo (isset($personne["INS_SEDepuis"]) && $personne["INS_SEDepuis"] == "De 6 à 11 mois") ? ' selected="selected"' : "";?>>De 6 à 11 mois</option>
							<option value="De 12 à 23 mois"<?php echo (isset($personne["INS_SEDepuis"]) && $personne["INS_SEDepuis"] == "De 12 à 23 mois") ? ' selected="selected"' : "";?>>De 12 à 23 mois</option>
							<option value="De 24 mois et plus"<?php echo (isset($personne["INS_SEDepuis"]) && $personne["INS_SEDepuis"] == "De 24 mois et plus") ? ' selected="selected"' : "";?>>24 mois et plus</option>
							<option value="Primo demandeur"<?php echo (isset($personne["INS_SEDepuis"]) && $personne["INS_SEDepuis"] == "Primo demandeur") ? ' selected="selected"' : "";?>>Primo demandeur</option>
						</select>
					</div>
				</td>
			</tr>
			<tr>
				<td>Position Atelier CAP* :</td>
				<td>
					<div class="selectType">
                        <select required="required" id="INS_Positionmt" name="INS_Positionmt">
                        	<option value="0" disabled="disabled" selected="selected">Choisir ...</option>
                            <option value="GOB (ACI)"<?php echo (isset($personne["INS_Positionmt"]) && $personne["INS_Positionmt"] == "GOB (ACI)") ? ' selected="selected"' : "";?>>GOB (ACI)</option>
                            <option value="SOB (ACI)"<?php echo (isset($personne["INS_Positionmt"]) && $personne["INS_Positionmt"] == "SOB (ACI)") ? ' selected="selected"' : "";?>>SOB (ACI)</option>
                            
                            <option 
                            	value="Equipe propreté (ACI)"<?php echo (isset($personne["INS_Positionmt"]) && $personne["INS_Positionmt"] == "Equipe propreté (ACI)") ? ' selected="selected"' : "";?>
                            >Equipe propreté (ACI)</option>
                            
                            <option 
                            	value="Agent de conditionnement (Filt) (ACI)"<?php echo (isset($personne["INS_Positionmt"]) && $personne["INS_Positionmt"] == "Agent de conditionnement (Filt) (ACI)") ? ' selected="selected"' : "";?>
                            >Agent de conditionnement (Filt) (ACI)</option>

                            <option
                            	value="Chauffeur-Magasinier (ACI)"<?php echo (isset($personne["INS_Positionmt"]) && $personne["INS_Positionmt"] == "Chauffeur-Magasinier (ACI)") ? ' selected="selected"' : "";?>
                            >Chauffeur-Magasinier (ACI)</option>
                            <option
                            	value="Agent de conditionnement (AVA)"<?php echo (isset($personne["INS_Positionmt"]) && $personne["INS_Positionmt"] == "Agent de conditionnement (AVA)") ? ' selected="selected"' : "";?>
                            >Agent de conditionnement (AVA)</option>

                            <option value="CAP Vert (AUS)"<?php echo (isset($personne["INS_Positionmt"]) && $personne["INS_Positionmt"] == "CAP Vert (AUS)") ? ' selected="selected"' : "";?>
                            >CAP Vert (AUS)</option>
                        </select>
					</div>
				</td>
				<td>Mutuelle* :</td>
				<td>
					<div class="selectType">
						<select required="required" id="INS_Mutuelle" name="INS_Mutuelle">
							<option value="0" disabled="disabled" selected="selected">Choisir ...</option>
	                        <option value="CMU"<?php echo (isset($personne["INS_Mutuelle"]) && $personne["INS_Mutuelle"] == "CMU") ? ' selected="selected"' : "";?>>CMU</option>
	                        <option value="CMU Complémentaire"<?php echo (isset($personne["INS_Mutuelle"]) && $personne["INS_Mutuelle"] == "CMU Complémentaire") ? ' selected="selected"' : "";?>>CMU Complémentaire</option>
	                        <option value="CMU et Complémentaire"<?php echo (isset($personne["INS_Mutuelle"]) && $personne["INS_Mutuelle"] == "CMU et Complémentaire") ? ' selected="selected"' : "";?>>CMU et Complémentaire</option>
	                        <option value="Autre mutuelle"<?php echo (isset($personne["INS_Mutuelle"]) && $personne["INS_Mutuelle"] == "Autre mutuelle") ? ' selected="selected"' : "";?>>Autre mutuelle</option>
	                        <option value="Pas de mutuelle"<?php echo (isset($personne["INS_Mutuelle"]) && $personne["INS_Mutuelle"] == "Pas de mutuelle") ? ' selected="selected"' : "";?>>Pas de mutuelle</option>
						</select>
					</div>
				</td>
			</tr>
			<tr>
				<td>Situation Géographique* :</td>
				<td>
					<div class="selectType">
						<select required="required" id="INS_SituGeo" name="INS_SituGeo">
							<option value="0" disabled="disabled" selected="selected">Choisir ...</option>
							<option value="Autre"<?php echo (isset($personne["INS_SituGeo"]) && $personne["INS_SituGeo"] == "Autre") ? ' selected="selected"' : "";?>>Autre</option>
							<option value="CUCS"<?php echo (isset($personne["INS_SituGeo"]) && $personne["INS_SituGeo"] == "CUCS") ? ' selected="selected"' : "";?>>CUCS</option>
							<option value="ZUS"<?php echo (isset($personne["INS_SituGeo"]) && $personne["INS_SituGeo"] == "ZUS") ? ' selected="selected"' : "";?>>ZUS</option>
						</select>
					</div>
				</td>

			</tr>
			<tr></tr>
			<tr>
				<td><label for="INS_Repas">Repas* :</label></td>
				<td>
					<input required="required" type="radio" id="INS_Repas" name="INS_Repas" value="true" <?php echo (isset($personne["INS_Repas"]) && $personne["INS_Repas"] == "true") ? ' checked="checked"' : "";?>>
					<label>Oui</label>
                    <input type="radio" id="INS_Repas" name="INS_Repas" value="false" <?php echo (isset($personne["INS_Repas"]) && $personne["INS_Repas"] == "false") ? ' checked="checked"' : "";?>>
					<label>Non</label>
				</td>
				<td><label for="INS_TRepas">Type de repas* :</label></td>
				<td>
					<input required="required" type="radio" id="INS_TRepas" name="INS_TRepas" value="true" <?php echo (isset($personne["INS_TRepas"]) && $personne["INS_TRepas"] == "true") ? ' checked="checked"' : "";?>>
					<label>Avec porc</label>
                    <input type="radio" id="INS_TRepas" name="INS_TRepas" value="false" <?php echo (isset($personne["INS_TRepas"]) && $personne["INS_TRepas"] == "false") ? ' checked="checked"' : "";?>>
					<label>Sans porc</label>
				</td>
			</tr>
			<?php if ($_POST["request_type"] == "edit"){?>
			<tr>
				<td><label for="TYS_ID">Type de sortie :</label></td>
				<td>
					<?php
						$query_sorties = mysqli_query($db, 'SELECT * FROM typesortie ORDER BY TYS_Numero');
						$sorties = mysqli_fetch_all($query_sorties, MYSQLI_ASSOC);
					?>
					<div class="selectType">
						<select id="TYS_ID" name="TYS_ID">	
						<?php
							for($x=0; $x<sizeof($sorties); $x++){
								echo '<option value="'.$sorties[$x]["TYS_ID"].'"'.((isset($personne["TYS_ID"]) && $personne["TYS_ID"] == $sorties[$x]["TYS_ID"]) ? ' selected="selected"' : "").'>'
										.$sorties[$x]["TYS_Numero"]." - ".$sorties[$x]["TYS_Libelle"].'</option>';
							}
						?>
						</select>
					</div>
				</td>
				<td></td>
				<td></td>
			</tr>
			<?php
				}
			?>
			<tr></tr>
			<tr>
				<td><label for="INS_PlusDetails">Autres détails :</label></td>
				<td colspan="3">
					<textarea rows="2" id="INS_PlusDetails" name="INS_PlusDetails"><?php echo (isset($personne["INS_PlusDetails"])) ? stripslashes($personne["INS_PlusDetails"]) : ""; ?></textarea>
				</td>
			</tr>
		</table>
	</fieldset>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		$("#addReferentCross").on("click", function(){
			if($("#REF_NumRef").prop("disabled")){
				$(this).val("+");
				$("#REF_NumRef").parent().parent().parent().next().remove();
				$("#REF_NumRef").prop("disabled", false);
			}
			else{
				$(this).val("-");
				$("#REF_NumRef").prop("disabled", true);

				<?php
					echo '$(\'<tr>\
						<td><strong>&#8618;</strong></td>\
						<td><input type="text" class="inputC" placeholder="NOM Prénom" required="required" id="new_REF_NumRef" name="new_REF_NumRef"/></td>\
						<td><strong>Prescripteur :</strong></td><td><div class="selectType"><select required="required" id="PRE_Id" name="PRE_Id">\
							<option value="0" selected="selected" disabled="disabled">Choisir ...</option>';
					for($x=0; $x<sizeof($prescripteurs); $x++){
						echo '<option value="'.$prescripteurs[$x]["PRE_Id"].'"'.((isset($personne["PRE_Id"]) && $personne["PRE_Id"] == $prescripteurs[$x]["PRE_Id"]) ? ' selected="selected"' : "").'>'
								.$prescripteurs[$x]["PRE_Nom"].'</option>';
					}
					echo '</select></div></td></tr>\').insertAfter($("#REF_NumRef").parent().parent().parent());'
				?>
			}
		});

		<?php
		if(isset($personne["new_REF_NumRef"])){
		?>
			$("#addReferentCross").trigger("click");
			$("#new_REF_NumRef").val("<?php echo $personne["new_REF_NumRef"];?>");
			
			if(inputErrorList.new_REF_NumRef != null){
				$("#new_REF_NumRef").addClass("value-error");
			}
			if(inputErrorList.PRE_Id != null){
				$("#PRE_Id").parent().addClass("value-error");
			}
		<?php
		}
		?>
	});
</script>