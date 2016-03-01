<?php
	$query_ref = mysqli_query($db, 'SELECT DISTINCT PER_Prenom, PER_Nom, PER_Num from personnes where PER_Nom != " " and PER_Prenom != " " and ASCII(PER_Nom) between 65 and 90 and ASCII(PER_Prenom) BETWEEN 65 and 90 order by PER_Nom');
	$query_conv = mysqli_query($db, 'SELECT DISTINCT CNV_Id, CNV_Nom FROM convention ORDER BY CNV_Id');
	$query_pres = mysqli_query($db, 'SELECT DISTINCT PRE_Id, PRE_Nom FROM prescripteurs ORDER BY PRE_Id');
	$query_contrat =  mysqli_query($db, "SELECT PL_id, PL_Libelle FROM typeplanning ORDER BY PL_id");
	// obligé car la table contrat n'est pas à jour //
?>
<div class="form">
	<form>
		<fieldset class="civilian_infos">
			<legend align="center"><h2> Coordonnées Professionelles  </h2></legend>
			<div align="center">
				<label for="PRO_DateEntrée"><u>Date d'entrée dans l'association :</u></label>
				<input type="date" id="ASSOC_Date" name="ASSOC_Date" value="<?php echo date('Y-m-d', strtotime("next monday")); ?>" step="1" class="SpecialDate">
			</div>
			<table class="form_table">
				<tr>
					<td><label> Référent identifié : </label></td>
					<td>
						<div class="selectType">
							<select id="REF_NumRef">
								<option value="0" selected="selected" disabled="disabled">Choisir ...</option>
							<?php
								while($data = mysqli_fetch_assoc($query_ref)){
									echo '<option value="'.$data["PER_Num"].'">'.$data["PER_Nom"].' '.$data["PER_Prenom"].'</option>';
								}
							?>
							</select>
						</div>
					</td>
					<td colspan="2" rowspan="2">
						<!-- Tableau d'infos du contrat -->
						<table class="tab_contrat">
							<tr>
								<td>Type de contrat : </td>
								<td>
									<div class="selectType">
										<select id="CNT_Id">
											<option value="0" selected="selected" disabled="disabled">Choisir ...</option>
										<?php
											while($data = mysqli_fetch_assoc($query_contrat)){
												echo '<option value="'.$data["PL_id"].'">'.$data["PL_Libelle"].'</option>';
											}	
										?>
										</select>
									</div>
								</td>
							</tr>
							<tr>
								<td>Nombre d'heures :</td>
								<td><input class="inputC" type="number" id="PRO_NbHeure" name="PRO_NbHeure"/></td>
							</tr>
							<tr>
								<td>Nombre de jours :</td>
								<td><input class="inputC" type="number" id="PRO_NbJours" name="PRO_NbJours"/></td>
							</tr>
						</table>
						<!-- ---- -->
					</td>
				</tr>
				<tr>
					<td><label> Convention : </label></td>
					<td>
						<div class="selectType">
							<select id="CNV_Id">	
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
				<tr>
					<td><label> Prescripteurs : </label></td>
					<td>
						<div class="selectType">
							<select id="PRE_Id">	
								<option value="0" selected="selected" disabled="disabled">Choisir ...</option>
							<?php
								while($data = mysqli_fetch_assoc($query_pres)){
									echo '<option value="'.$data["PRE_Id"].'">'.$data["PRE_Nom"].'</option>';
								}
							?>
							</select>
						</div>
					</td>
					<td colspan="2" style="text-align:left">
						<input name="nouvPres" id="nouvPres" type="button" class="delCross newPresCross" value="+">
						<input type="text" id="PRE_Nom" disabled="disabled" placeholder="Nouveau Prescripteur ..." class="inputC">
					</td>
				</tr>
				<tr>
					<td>Niveau Scolaire :</td>
					<td>
						<div class="selectType">
							<select id="PRO_Niveau">
								<option value="x"> Choisir ... </option>
								<option value="6">6</option>
								<option value="5bis">5bis</option>
								<option value="5">5</option>
								<option value="5">4</option>
								<option value="3">3 et plus</option>
								<option value="Non scolarisé">Non scolarisé</option>
							</select>
						</div>
					</td>
					<td>Diplôme :</td>
					<td>
						<div class="selectType">
							<select id="PRO_Diplome">
								<option value="x"> Choisir ... </option>
								<option value="Aucun">Sans</option>
								<option value="Brevet">Brevet des Colèges</option>
								<option value="CAP">CAP-BEP</option>
								<option value="BAC">BAC</option>
								<option value="MOR">Plus ...</option>
							</select>
						</div>
					</td>
				</tr>
				<tr>
					<td>Reconnaissance TH : </td>
					<td><input type="checkbox" id="PER_Reconnaissance"></td>
					<td>Permis : </td>
					<td><input type="checkbox" id="PER_Permis"></td>
				</tr>
				<tr>
					<td>Revenus :</td>
					<td>
						<div class="selectType">
							<select id="PRO_REvenus">
								<option value="x"> Choisir ... </option>
								<option value="RSA">RSA</option>
								<option value="ASS">ASS</option>
								<option value="ARE">ARE</option>
								<option value="AAH">AAH</option>
								<option value="Moins de 6 mois">Moins de 6 mois</option>
								<option value="De 6 à 11 mois">De 6 à 11 mois</option>
								<option value="De 12 à 23 mois">De 12 à 23 mois</option>
								<option value="24 mois et plu">24 mois et plus</option>
								<option value="Aucun">Aucun</option>
							</select>
						</div>
					</td>
					<td><label>Autre, Précisez : </label></td>
					<td><input id="PRO_REvenus_Autre" type="text" class="inputC"></td>
				</tr>
				<tr>
					<td>Inscris à Pôle Emploi depuis : </td>
					<td>
						<div class="selectType">
							<select id="PRO_PoleEmploi">
								<option value="x"> Choisir ... </option>
								<option value="Moins de 6 mois">Moins de 6 mois</option>
								<option value="De 6 à 11 mois">De 6 à 11 mois</option>
								<option value="De 12 à 23 mois">De 12 à 23 mois</option>
								<option value="24 mois et plu">24 mois et plus</option>
								<option value="Aucun">Aucun</option>
							</select>
						</div>
					</td>
					<td>Sans emploi depuis depuis :</td>
					<td>
						<div class="selectType">
							<select id="PRO_SansEmp">
								<option value="x"> Choisir ... </option>
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
					<td>Position Atelier CAP :</td>
					<td>
						<div class="selectType">
							<select id="PRO_CAP">
								<option value="x"> Choisir ... </option>
								<option value="GOB">(ACI) GOB</option>
								<option value="SOB">(ACI) SOB</option>
								<option value="Propreté">(ACI) Propreté</option>
								<option value="Agent de conditionnement FILT">(ACI) Agent de conditionnement - FILT</option>
								<option value="Chauffeur Magasinier">(ACI) Chauffeur-Magasinier</option>
								<option value="Agent de conditionnement">(AVA) Agent de conditionnement</option>
								<option value="CAP VERT">(AUS) Cap Vert</option>
							</select>
						</div>
					</td>
				</tr>
				<tr>
					<td> Mutuelle : </td>
					<td>
						<div class="selectType">
							<select id="PRO_Mutuelle">
								<option value="x"> Choisir ... </option>
								<option value="CMU">CMU</option>
								<option value="CMU_Comp">CMU Complémentaire</option>
								<option value="Aucune">Pas de mutuelle</option>
							</select>
						</div>
					</td>
					<td><label>Autre, Précisez : </label></td>
					<td><input id="PRO_Mutuelle_Autre" type="text" class="inputC"></td>
				</tr>
				<tr>
					<td> Situation Géographique : </td>
					<td>
						<div class="selectType">
							<select id="PRO_SitGeo">
								<option value="x"> Choisir ... </option>
								<option value="CUCS">CUCS</option>
								<option value="ZUS">ZUS</option>
							</select>
						</div>
					</td>
				</tr>
				<!--
				<tr>
					Içi, normalement une case avec les repas, mais à définir en fonction de la suite.
				</tr>
				-->
				<!-- Commentaires -->	
				<tr>
					<td colspan="2"><label> Informations Complémentaires : </label></td>
					<td colspan="2"><textarea rows="5" class="inputCom" id="PRO_Comms" name="PRO_Comms"/></td>
				</tr>
			</table>
		</fieldset>
	</form>
</div>

<script type="text/javascript">
	$(".newPresCross").on("click",function(){
		if($("#PRE_Nom").prop("disabled")){
			$(this).val("-");
			$("#PRE_Nom").prop("disabled", false);
			$("#PRE_Id").prop("disabled", true);
		}
		else{
			$(this).val("+");
			$("#PRE_Id").prop("disabled", false);
			$("#PRE_Nom").prop("disabled", true);
		}
	});
</script>