<?php
	$pageTitle = "Sélection des plannings";
	$pwd='../';
	include($pwd."bandeau.php");

	$listeTypesPlanning = mysqli_query($db, "SELECT PL_id, PL_Libelle FROM typeplanning ORDER BY PL_id");
?>
<div id="corps">
	<div id="labelT">
		<label>Sélection des plannings</label>
	</div>
	<div class="planning-filters">
		<form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
			<table>
				<thead>
					<tr>
						<th colspan="4">Filtres :</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>
							<div class="selectType" style="width:200px">
								<select id="PL_id" name="PL_id">
									<option value="0" selected="selected" disabled="disabled">Choisissez un type</option>
									<?php
										while($data = mysqli_fetch_assoc($listeTypesPlanning))
										{
											if(isset($_POST["PL_id"])){
												if($_POST["PL_id"] == $data["PL_id"]){
													echo '<option value="'.$data["PL_id"].'" selected>Planning '.$data["PL_Libelle"].'</option>';
												}
												else{
													echo '<option value="'.$data["PL_id"].'">Planning '.$data["PL_Libelle"].'</option>';
												}
											}
											else{
												echo '<option value="'.$data["PL_id"].'">Planning '.$data["PL_Libelle"].'</option>';
											}
										}
									?>
								</select>
							</div>
						</td>
						<td>
							<div class="selectType" style="width:200px">
								<select id="ASSOC_Date" name="ASSOC_Date" disabled="disabled">
									<option value="0" selected="selected" disabled="disabled">Choisissez une date</option>
								</select>
							</div>
						</td>
						<td>
							<div class="selectType" style="width:200px">
								<select id="ENC_Num" name="ENC_Num" disabled="disabled">
									<option value="0" selected="selected" disabled="disabled">Choisissez un encadrant</option>
								</select>
							</div>
						</td>
						<td>
							<input type="checkbox" id="ASSOC_Archi" name="ASSOC_Archi"/>
							<label>N'afficher que les archives</label>
						</td>
					</tr>
					<tr>
						<td colspan="4">
							<input type="button" class="buttonC" id="new" value="Nouveau"/>
						</td>
					</tr>
				</tbody>
			</table>
		</form>
	</div>
	<hr class="hr-stylized"/>
	<div class="planning-table waiting-planning">
		<div class="planning-loader">
			<div class='uil-ring-css' style='transform:scale(0.6);'><div></div></div>
			<label>En attente de sélection d'un planning...</label>
		</div>
	</div>
</div>
<script type="text/javascript">
<?php
	if(isset($_POST['ASSOC_Date']) && isset($_POST['ENC_Num']) && isset($_POST['PL_id']))
	{
?>
	$(document).ready(function(){
	    $("#PL_id").trigger("change");
	});

	function loadDate(){
		$("#ASSOC_Date option").each(function(){
			if($(this).val() == "<?php echo $_POST['ASSOC_Date']; ?>"){
				$(this).prop("selected", "selected");
				$("#ASSOC_Date").trigger("change");
			}
		});
	}

	function loadEnc(){
		$("#ENC_Num option").each(function(){
			if($(this).val() == <?php echo $_POST['ENC_Num']; ?>){
				$(this).prop("selected", "selected");
				$("#ENC_Num").trigger("change");
			}
		});
	}
<?php
	}
?>

	$("#new").on("click", function(){
		$.redirect("./planningNew.php");
	});

	$("#PL_id").on("change", function(){
		resetPlanning();

		if($(this).val() != null){
			getDataAjax("./ajax/planningShowcaseData.php", {"request_type": "date", "PL_id": $(this).val(), "ASSOC_Archi": $("#ASSOC_Archi").prop("checked")}, function(data){
		   		if(data.length > 0){
		   			$("#ASSOC_Date").html(data);
		   			$("#ASSOC_Date").prop("disabled", "");
<?php
	if(isset($_POST['ASSOC_Date']) && isset($_POST['ENC_Num']) && isset($_POST['PL_id']))
	{
?>
					loadDate();
<?php
	}
?>
				}
				else{
					$("#ASSOC_Date").prop("disabled", "disabled");
					$("#ENC_Num").prop("disabled", "disabled");
				}
		   	});
		
		}	
		else{
			$("#ASSOC_Date").prop("disabled", "disabled");
			$("#ENC_Num").prop("disabled", "disabled");
		}
	});

	$("#ASSOC_Date").on("change", function(){
		resetPlanning();

		if($(this).val() != null){
			getDataAjax("./ajax/planningShowcaseData.php", {"request_type": "enc", "PL_id": $("#PL_id").val(), "ASSOC_Date": $(this).val(), "ASSOC_Archi": $("#ASSOC_Archi").prop("checked")}, function(data){
		   		if(data.length > 0){
		   			$("#ENC_Num").html(data);
		   			$("#ENC_Num").prop("disabled", "");
<?php
	if(isset($_POST['ASSOC_Date']) && isset($_POST['ENC_Num']) && isset($_POST['PL_id']))
	{
?>
					loadEnc();
<?php
	}
?>
				}
				else{
					$("#ENC_Num").prop("disabled", "disabled");
				}
		   	});
		
		}	
		else{
			$("#ENC_Num").prop("disabled", "disabled");
		}
	});

	$("#ENC_Num").on("change", function(){
		if($(this).val() != null){

			getDataAjax("./ajax/planningShowcaseData.php", {"request_type": "global", "PL_id": $("#PL_id").val(), "ASSOC_Date": $("#ASSOC_Date").val(), "ENC_Num": $(this).val(), "ASSOC_Archi": $("#ASSOC_Archi").prop("checked"), "PWD": "<?php echo $pwd; ?>"}, function(data){
		   		if(data.length > 0){
		   			cleanPlanning();
		   			$(".planning-table").removeClass('waiting-planning');
					$(".planning-table .planning-loader").hide();
		   			$(".planning-table").html($(".planning-table").html()+data);
				}
				else{
					$(".planning-table").addClass('waiting-planning');
					$(".planning-table .planning-loader").show();
				}
		   	});
		
		}	
		else{
			$(".planning-table").addClass('waiting-planning');
			$(".planning-table .planning-loader").show();
		}
	});

	$("#ASSOC_Archi").on("change", function(){
		$("#PL_id").trigger("change");
		resetPlanning();
	});

	function getDataAjax(url, params, callback){
		 $.post(url, params, callback);
	}

	function resetPlanning(){
		$("#ENC_Num").prop("disabled", "disabled");
		$("#ENC_Num option:nth-child(1)").prop("selected", "selected");
		$(".planning-table").addClass("waiting-planning");
		$(".planning-table .planning-loader").show();
		cleanPlanning();
	}

	function cleanPlanning(){
		$(".planning-table table").remove();
		$(".planning-table .planning-menu").remove();
		$(".planning-table .planning-logo").remove();
		$(".planning-table #dialog-confirm").remove();
	}
</script>
<?php
	include($pwd."footer.php");
?>