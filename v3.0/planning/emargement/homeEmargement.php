<?php
	$pageTitle = "Émargements";
	$pwd='../../';
	include($pwd."bandeau.php");
?>
<div id="corps">
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
							<option value="0">Choisissez une date</option>
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
					<div class="selectType" style="width:200px">
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
		<h4>Feuilles d'émargement mensuelles</h4>
		<form method="POST" action="./printerMensuel.php" target="_blank">
			<table>
				<td>
					<div class="selectType" style="width:200px">
						<select id="date_select_mensuel" name="date_select_mensuel" disabled="disabled">
							<option value="0">Choisissez une date</option>
						</select>
					</div>
				</td>
				<td>
					<div class="selectType" style="width:200px">
						<select id="encadrant_select_mensuel" name="encadrant_select_mensuel" disabled="disabled">
							<option value="null">Aucun encadrant</option>
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
		loadListeContent();
	});

	$("#encadrant_select_hebdo").on("change", function(){
		checkEncList();
	});

	function loadListeContent(){
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
	}

	function checkEncList(){
		if($("#encadrant_select_hebdo").val() != 0){
			$('#printHebdo').prop("disabled", "");
		}
		else{
			$('#printHebdo').prop("disabled", "disabled");
		}
	}

</script>
<?php
	include($pwd."footer.php");
?>