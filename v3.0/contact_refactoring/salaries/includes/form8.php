<?php
	$query_ref = mysqli_query($db, 'SELECT DISTINCT PER_Num, PER_Prenom, PER_Nom FROM personnes	ORDER BY PER_Nom');
	$query_conv = mysqli_query($db, 'SELECT DISTINCT CNV_Id, CNV_Nom FROM convention ORDER BY CNV_Id');
	$query_pres = mysqli_query($db, 'SELECT DISTINCT PRE_Id, PRE_Nom FROM prescripteurs ORDER BY PRE_Id');
?>
<div class="form">
	<form>
		<fieldset class="civilian_infos">
			<legend align="center"><h2> Coordonnées Professionelles  </h2></legend>
			<div align="center">
				<label for="INS_DateEntrée"><u>Date d'entrée dans l'association :</u></label>
				<input type="date" id="ASSOC_Date" name="ASSOC_Date" value="<?php echo date('Y-m-d', strtotime("next monday")); ?>" step="1" class="SpecialDate">
			</div>
			<table>
				<tr>
					<td><label> Référent identifié : </label></td>
					<td colspan="2">
						<div class="selectType" style="width:200px">
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
				</tr>
				<tr>
					<td><label> Convention : </label></td>
					<td colspan="2">
						<div class="selectType" style="width:200px">
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
					<td colspan="2">
						<div class="selectType" style="width:200px">
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
				</tr>
				<tr>
					<td><label> Remarques / Commentaires : </label></td>
					<td><textarea rows="5" class="inputCom" id="PRO_Comms" name="PRO_Comms"/></td>
				</tr>
			</table>
		</fieldset>
	</form>
</div>