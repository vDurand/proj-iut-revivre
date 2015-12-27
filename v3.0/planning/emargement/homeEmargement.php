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
							<option value="0" disabled="disabled" selected="selected">Choisissez une date</option>
							<?php
								$query = mysqli_query($db, "SELECT DISTINCT date_format(ASSOC_date,'%d/%m/%Y') AS 'date' FROM pl_association 
															WHERE PL_id IN (SELECT PL_id FROM typeplanning WHERE PL_Libelle IN ('GOB', 'SOB'))
															AND ASSOC_Archi = 0 ORDER BY ASSOC_date DESC;");
								while($data = mysqli_fetch_assoc($query))
								{
									echo '<option value="'.$data["date"].'">'.$data["date"].'</option>';
								}
							?>
						</select>
					</div>
				</td>
				<td>
					<div class="selectType" style="width:200px">
						<select id="plid_select_hebdo" name="plid_select_hebdo" disabled="disabled">
							<option value="0" disabled="disabled" selected="selected">Choisissez un type</option>
							<?php
								$query = mysqli_query($db, "SELECT PL_id, PL_Libelle FROM typeplanning
															WHERE PL_id IN (SELECT PL_id FROM typeplanning WHERE PL_Libelle IN ('GOB', 'SOB'));");
								while($data = mysqli_fetch_assoc($query))
								{
									echo '<option value="'.$data["PL_id"].'">'.$data["PL_Libelle"].'</option>';
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

	<div class="emargement-bloc">
		<h4>Feuilles de pointage mensuelles</h4>
		<form method="POST" action="printerMensuel.php" target="_blank">
			<table>
				<td>
					<div class="selectType" style="width:200px">
						<select id="annee_select_mensuel" name="annee_select_mensuel">
							<option value="0" disabled="disabled" selected="selected">Choisissez une année</option>
							<?php
								$query = mysqli_query($db, "SELECT DISTINCT date_format(ASSOC_date,'%Y') AS annee FROM pl_association WHERE ASSOC_Archi = 0 ORDER BY annee");
								while($data = mysqli_fetch_assoc($query))
								{
									echo '<option value="'.$data["annee"].'">'.$data["annee"].'</option>';
								}
							?>
 						</select>
					</div>
				</td>
				<td>
					<div class="selectType" style="width:200px">
						<select id="mois_select_mensuel" name="mois_select_mensuel" disabled="disabled">
							<option value="0" disabled="disabled" selected="selected">Choisissez un mois</option>
 						</select>
					</div>
				</td>
				<td>
					<div class="selectType" style="width:300px">
						<select id="salarie_select_mensuel" name="salarie_select_mensuel" disabled="disabled">
							<option value="0">Choisissez un salarié</option>
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

<script type="text/javascript">

	$("#date_select_hebdo").on("change", function(){
		$('#plid_select_hebdo').prop("disabled", "");
	});

	$("#plid_select_hebdo").on("change", function(){
		loadListeContentHebdo();
	});

	$("#encadrant_select_hebdo").on("change", function(){
		checkEncListHebdo();
	});

	function loadListeContentHebdo(){
		if($("#date_select_hebdo").val() != 0){
			$.post('./ajax/emargementHebdo.php',{"date": $("#date_select_hebdo").val(), "PL_id": $("#plid_select_hebdo").val()}, function(data){
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
			$("#encadrant_select_hebdo").html('<option value="0">Aucun encadrant</option>');
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

//-------------------------------------------------------
	
	$("#annee_select_mensuel").on("change", function(){
		loadListeContentMois();
	});

	$("#mois_select_mensuel").on("change", function(){
		loadListeContentMensuel();
	});

	$("#salarie_select_mensuel").on("change", function(){
		checkEncListMensuel();
	});


	function loadListeContentMois(){
		if($("#annee_select_mensuel").val() != 0){
			$.post('./ajax/emargementMensuel.php', {"request_type": "mois", "annee":$("#annee_select_mensuel").val()}, function(data){
				$('#mois_select_mensuel').prop("disabled", "disabled");
				if(data.length > 0)
				{
					$("#mois_select_mensuel").html(data);
					$("#mois_select_mensuel").prop("disabled","");
				}
			});
		}
		else{
			$('#mois_select_mensuel').prop("disabled", "disabled");
			$("#mois_select_mensuel").html('<option value="0">Aucun mois</option>');
		}
	}

	function loadListeContentMensuel(){
		if($("#mois_select_mensuel").val() != 0){
			$.post('./ajax/emargementMensuel.php',{"request_type": "sal", "mois":$("#mois_select_mensuel").val(), "annee":$("#annee_select_mensuel").val()}, function(data){
				$('#salarie_select_mensuel').prop("disabled", "disabled");
				if(data.length > 0)
				{
					$("#salarie_select_mensuel").html(data);
					$("#salarie_select_mensuel").prop("disabled","");
				}

			});
		}
		else{
			$('#salarie_select_mensuel').prop("disabled", "disabled");
			$("#salarie_select_mensuel").html('<option value="0">Aucun Salarié</option>');
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