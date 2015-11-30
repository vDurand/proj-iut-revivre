<?php
	$pageTitle = "Émargements";
	$pwd='../../';
	include($pwd."bandeau.php");
?>
<div id="corps">
	<div id="res"></div>
	<div id="labelT">     
		<label>Gestion des feuilles d'émargement hebdomadaires et mensuelles</label>
	</div>
	<br/>
	<div class="emargement-bloc">
		<h4>Feuilles d'émargement hebdomadaires</h4>
		<form method="POST" action="./printerHebdo.php" target="_blank">
			<table>
				<td>
					<div class="selectType" style="width:200px">
						<select id="date_select_hebdo" name="date_select_hebdo">
							<option style="font-style:italic" value="0">-- Choisissez une date --</option>
							<?php
								$query = mysqli_query($db, "SELECT DISTINCT date_format(ASSOC_date,'%d/%m/%Y') AS 'date' FROM pl_association WHERE PL_id = 1 AND ASSOC_Archi = 0 ORDER BY ASSOC_date DESC;");
								while($data = mysqli_fetch_assoc($query))
								{
									echo '<option value="'.$data["date"].'">'.$data["date"].'</option>';
								}
							?>
						</select>
					</div>
				</td>
				<td>
					<div class="selectType" style="width:300px">
						<select id="encadrant_select_hebdo" name="encadrant_select_hebdo" disabled="disabled">
							<option value="null">Aucun encadrant</option>
						</select>
					</div>
				</td>
				<td>
					<input name="printHebdo" id="printHebdo" type="submit" value="Générer" class="printButton" disabled="disabled">
				</td>
			</table>
		</form>
	</div>

<!-- ---------------------------------------- -->
<!-- ---------------------------------------- -->
<!-- ---------------------------------------- -->
<!-- ---------------------------------------- -->

	<div class="emargement-bloc">
		<h4>Feuilles d'émargement mensuelles</h4>
		<form method="POST" action="printerMensuel.php" target="_blank">
			<table>
				<td>
					<div class="selectType" style="width:140px">
						<select id="mois_select_mensuel" name="mois_select_mensuel">
							<option value="0" style="font-style:italic">-- Mois --</option>
							<option value="01">	JANVIER 	</option>
	 						<option value="02">	FEVRIER		</option>
				 			<option value="03">	MARS		</option>
	 						<option value="04">	AVRIL		</option>
			 				<option value="05">	MAI			</option>
					 		<option value="06"> JUIN		</option>
				 			<option value="07">	JUILLET		</option>
	 						<option value="08"> AOUT		</option>
				 			<option value="09">	SEPTEMBRE 	</option>	
							<option value="10"> OCTOBRE		</option>
	 						<option value="11"> NOVEMBRE	</option>
 							<option value="12"> DECEMBRE	</option>
 						</select>
					</div>
				</td>
				<td>
					<div class="selectType" style="width:120px">
						<select id="annee_select_mensuel" name="annee_select_mensuel">
							<option value="0" style="font-style:italic">-- Annee --</option>
							<?php
								$query = mysqli_query($db, "SELECT DISTINCT date_format(ASSOC_date,'%Y') as date from pl_association ORDER BY date");
								while($data = mysqli_fetch_assoc($query))
								{
									echo '<option value="'.$data["date"].'">'.$data["date"].'</option>';
								}


							?>
 						</select>
					</div>
				</td>
				<td>
					<div class="selectType" style="width:255px">
						<select id="type_select_mensuel" name="type_select_mensuel">
							<option style="font-style:italic" value="null"> -- Choisissez un type de salarié --</option>
							<?php
								$query = mysqli_query($db, "SELECT DISTINCT TYP_Id, TYP_Nom FROM type WHERE TYP_Id > 5 ORDER BY TYP_Id DESC;");
								while($data = mysqli_fetch_assoc($query))
								{
									echo '<option value="'.$data["TYP_Id"].'">'.$data["TYP_Nom"].'</option>';
								}
							?>
						</select>
					</div>
				</td>
				<td>
					<div class="selectType" style="width:200px">
						<select id="salarie_select_mensuel" name="salarie_select_mensuel" disabled="disabled">
							<option value="null">Aucun Salarie</option>
						</select>
					</div>
				</td>
				<td>
					<input name="printMensuel" id="printMensuel" type="submit" value="Générer" class="printButton" disabled="disabled">
				</td>
			</table>
		</form>
	</div>
</div>

<!-- FONCTION DE CHANGEMENT AUTOMATIQUES -->

<script type="text/javascript">

	// FICHE POINTAGE HEBDO

	$("#date_select_hebdo").on("change", function(){
		loadListeContentHebdo();
	});

	$("#encadrant_select_hebdo").on("change", function(){
		checkEncListHebdo();
	});

	function loadListeContentHebdo(){
		if($("#date_select_hebdo").val() != 0){
			$.post('./ajax/getEncadrant.php',{"date":$("#date_select_hebdo").val()}, function(data){
				$('#encadrant_select_hebdo').prop("disabled", "disabled");
				if(data.length > 0)
				{
					$("#encadrant_select_hebdo").html(data);
					$("#encadrant_select_hebdo").prop("disabled","");
				}
			});
		}
		else{
			$('#encadrant_select_hebdo').prop("disabled", "disabled");
			$("#encadrant_select_hebdo").html('<option value="null">Aucun encadrant</option>');
		}
		$('#printHebdo').prop("disabled", "disabled");
	}

	function checkEncListHebdo(){
		if($("#encadrant_select_hebdo").val() != 0){
			$('#printHebdo').prop("disabled", "");
		}
		else{
			$('#printHebdo').prop("disabled", "disabled");
		}
	}

	// FICHE POINTAGE MENSUEL //

	$("#type_select_mensuel").on("change", function(){
		loadListeContentMensuel();
	});

	$("#salarie_select_mensuel").on("change", function(){
		checkEncListMensuel();
	});

//-------------------------------------------------------

	function loadListeContentMensuel(){
		if($("#type_select_mensuel").val() != 0){
			$.post('./ajax/getSalarie.php',{"type":$("#type_select_mensuel").val(), "mois":$("#mois_select_mensuel").val(), "annee":$("#annee_select_mensuel").val()}, function(data){
				$('#salarie_select_mensuel').prop("disabled", "disabled");
				if(data.length > 0)
				{
					$("#salarie_select_mensuel").html(data);
					$("#salarie_select_mensuel").prop("disabled","");
				}

				//$("#res").html(data);
			});
		}
		else{
			$('#salarie_select_mensuel').prop("disabled", "disabled");
			$("#salarie_select_mensuel").html('<option value="null">Aucun Salarie</option>');
		}
	}

	function checkEncListMensuel(){
		if($("#salarie_select_mensuel").val() != 0){
			$('#printMensuel').prop("disabled", "");
		}
		else{
			$('#printMensuel').prop("disabled", "disabled");
		}
	}

</script>
<?php
	include($pwd."footer.php");
?>