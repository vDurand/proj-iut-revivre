<?php
	$pageTitle = "Création d'un planning";
	$pwd='../';
	include($pwd."bandeau.php");

	$listeTypesPlanning = mysqli_query($db, "SELECT PL_id, PL_Libelle FROM typeplanning ORDER BY PL_id");
	$query = mysqli_query($db, "SELECT LOGO_Url, LOGO_Id FROM logo;");
	$logos =  mysqli_fetch_all($query, MYSQLI_ASSOC);
?>
<div id="corps">
	<div id="labelT">
		<label>Création d'un planning</label>
	</div>
	
	<div class="planning-filters">
		<table>
			<thead>
				<tr>
					<th colspan="4">Configuration pré-requise :</th>
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
										echo '<option value="'.$data["PL_id"].'">Planning '.$data["PL_Libelle"].'</option>';
									}
								?>
							</select>
						</div>
					</td>
					<td>
						<label for="ASSOC_Date">Date : </label>
						<input type="date" id="ASSOC_Date" name="ASSOC_Date" value="<?php echo date('Y-m-d', strtotime("next monday")); ?>" step="7" class="SpecialDate" disabled="disabled">
					</td>
					<td>
						<div class="selectType" style="width:200px">
							<select id="ENC_Num" name="ENC_Num" disabled="disabled">
								<option value="0" selected="selected" disabled="disabled">Choisissez un encadrant</option>
							</select>
						</div>
					</td>
					<td>
						<input type="button" id="valid_required" name="valid_required" class="printButton" value="Valider" disabled="disabled"/>
					</td>
				</tr>
			</tbody>
		</table>
	</div>
	<hr class="hr-stylized"/>
	<div class="planning-edit-area planning-table">
		<div class="planning-disabled"></div>
		<div class="planning-edit-tools">
			<label>Salarié : </label>
			<select id="SAL_NumSalarie" name="SAL_NumSalarie"style="width:200px">
				<option value="0" selected="selected" disabled="disabled">Choisissez un salarié</option>
			</select>
			<table>
				<tr>
					<td colspan="5"><input type="button" id="checkall" name="checkall" value="Tout sélectionner"></td>
				</tr>
				<tr>
					<td rowspan="2"><label class="dayTitle">Lundi : </label></td>
					<td><input type="checkbox" id="choice00" name="choice00" data-value="0-0" value="1"/><label for="choice00">Matin</label></td>
					<td rowspan="2"><label class="dayTitle">Mardi : </label></td>
					<td><input type="checkbox" id="choice10" name="choice10" data-value="1-0" value="3"/><label for="choice10">Matin</label></td>
					<td rowspan="2"><label class="dayTitle">Mercredi : </label></td>
					<td><input type="checkbox" id="choice20" name="choice20" data-value="2-0" value="5"/><label for="choice20">Matin</label></td>
					<td rowspan="2"><label class="dayTitle">Jeudi : </label></td>
					<td><input type="checkbox" id="choice30" name="choice30" data-value="3-0" value="7"/><label for="choice30">Matin</label></td>
					<td rowspan="2"><label class="dayTitle">Vendredi : </label></td>
					<td><input type="checkbox" id="choice40" name="choice40" data-value="4-0" value="9"/><label for="choice40">Matin</label></td>
				</tr>
				<tr>
					<td><input type="checkbox" id="choice01" name="choice01" data-value="0-1" value="2"/><label for="choice01">Après-midi</label></td>
					<td><input type="checkbox" id="choice11" name="choice11" data-value="1-1" value="4"/><label for="choice11">Après-midi</label></td>
					<td><input type="checkbox" id="choice21" name="choice21" data-value="2-1" value="6"/><label for="choice21">Après-midi</label></td>
					<td><input type="checkbox" id="choice31" name="choice31" data-value="3-1" value="8"/><label for="choice31">Après-midi</label></td>
					<td><input type="checkbox" id="choice41" name="choice41" data-value="4-1" value="10"/><label for="choice41">Après-midi</label></td>
				</tr>
			</table>
			<div class="buttonWrapper">
				<input type="button" id="addSal" name="addSal" value="Ajouter"/>
			</div>
		</div>
		<table>
			<thead style="background-color: #005fbf;">
				<tr>
					<th><input type="color" id="selectColor" name="selectColor" value="#005fbf"/></th>
					<th>Matin<br/><input type="text" id="time-am" name="time-am" value="08h00 - 12h00" class="planning-time"/></th>
					<th>Après-midi<br/><input type="text" id="time-pm" name="time-pm" value="13h00 - 18h00" class="planning-time"/></th>
				</tr>
			</thead>
			<tbody>
				<tr><td>Lundi<br/><span class="dayDate">01/<?php echo date("m");?></span></td><td></td><td></td></tr>
				<tr><td>Mardi<br/><span class="dayDate">02/<?php echo date("m");?></span></td><td></td><td></td></tr>
				<tr><td>Mercredi<br/><span class="dayDate">03/<?php echo date("m");?></span></td><td></td><td></td></tr>
				<tr><td>Jeudi<br/><span class="dayDate">04/<?php echo date("m");?></span></td><td></td><td></td></tr>
				<tr><td>Vendredi<br/><span class="dayDate">05/<?php echo date("m");?></span></td><td></td><td></td></tr>
			</tbody>
		</table>
		<div class="planning-logo">
		<?php
			for($x=0; $x<sizeof($logos); $x++){
				echo '<div class="logo-wrapper">
						<input type="checkbox" class="logoCheckbox" data-logo="'.$logos[$x]["LOGO_Id"].'"/>
						<img src="'.$logos[$x]["LOGO_Url"].'"/>
					</div>';
			}
		?>
		</div>
	</div>
	<div class="planning-edit-form">
		<input type="button" id="annuler" name="annuler" class="buttonC" value="Annuler"/>
		<input type="button" id="sauvegarder" name="sauvegarder" class="buttonC" value="Sauvegarder" disabled="disabled"/>
	</div>
</div>
<script type="text/javascript">
	var dataSalarieToStore = [];
	var dataLogoToStore = [];

	$("#annuler").on("click", function(){
		$.redirect("./planningShowcase.php");
	});

	$("#PL_id").on("change", function(){
		$("#ASSOC_Date").prop("disabled", "");
		$("#ASSOC_Date").val("<?php echo date('Y-m-d', strtotime("next monday")); ?>")
		resetRequired();
		$("#ASSOC_Date").trigger("change");
	});

	$("#ASSOC_Date").on("change", function(){
		resetRequired();

		if($(this).val() != null){
			getDataAjax("./ajax/planningNewData.php", {"request_type": "enc", "ASSOC_Date": $(this).val(), "PL_id":$("#PL_id").val()}, function(data){
		   		if(data.length > 0){
		   			$("#ENC_Num").html(data);
		   			$("#ENC_Num").prop("disabled", "");
				}
				else{
					resetRequired();
				}
		   	});
		}	
		else{
			resetRequired();
		}
	});

	$("#ENC_Num").on("change", function(){
		if($(this).val() != null){
			$("#valid_required").prop("disabled", "");
		}
		else{
			$("#valid_required").prop("disabled", "disabled");
		}
	});

	$("#valid_required").on("click", function(){
		getDataAjax("./ajax/planningNewData.php", {"request_type": "global", "ASSOC_Date": $("#ASSOC_Date").val(), "PL_id": $("#PL_id").val()}, function(data){
			if(data.length > 0){
				$(".planning-edit-area").html(data);
				handleEvents();
				$("#sauvegarder").prop("disabled", "");
				$("#valid_required, #ENC_Num, #ASSOC_Date, #PL_id").prop("disabled", "disabled");
			}
			else{
				alert("Une erreur s'est produite, rechargez la page.");
			}
		});
	});

	function getDataAjax(url, params, callback){
		 $.post(url, params, callback);
	}

	function handleEvents(){
		$(".dayTitle").each(function(index){
			$(this).on("click", triggerCheckboxes(index));
		});

		$("#selectColor").on("change", function(){
			$(".planning-table table thead").css("background-color", $(this).val());
		});

		$(".logoCheckbox").on("change", function(){
			if($(this).prop("checked")){
				if(dataLogoToStore.indexOf($(this).data("logo")) < 0){
					dataLogoToStore.push($(this).data("logo"));
				}
			}
			else{
				if((index = dataLogoToStore.indexOf($(this).data("logo"))) > -1){
					dataLogoToStore.splice(index, 1);
				}
			}
		});

		$("#addSal").on("click", function(){
			if($("#SAL_NumSalarie").val() != null){
				$(".planning-edit-tools > table tbody input[type=checkbox]:checked").each(function(index){
					addSalarie($(this));
				});
				$("#SAL_NumSalarie option:nth-child(1)").prop("selected", "selected");
			}
			else{
				alert("Choisissez d'abord un salarié.");
			}
		});

		$("#checkall").on("click", function(){
			$(".planning-edit-tools > table tbody input[type=checkbox]").each(function(){
				if(!$(this).prop("disabled"))
					$(this).prop("checked", "checked");
			});
		});


		$("#sauvegarder").on("click", function(){
			if(dataSalarieToStore.length > 0){
				$.redirect("./planningPost.php", {
					"ENC_Num": $("#ENC_Num").val(),
					"ASSOC_Date": $("#ASSOC_Date").val(),
					"PL_id": $("#PL_id").val(),
					"DataSalarie": JSON.stringify(dataSalarieToStore),
					"DataLogo": JSON.stringify(dataLogoToStore),
					"ASSOC_Couleur": $("#selectColor").val(),
					"ASSOC_AM": $("#time-am").val(),
					"ASSOC_PM": $("#time-pm").val(),
					"Type": "new"
				});
			}
			else{
				alert("Vous devez d'abord remplir le planning avant de le sauvegarder.");
			}
		});
	}

	function resetRequired(){
		$("#ENC_Num").prop("disabled", "disabled");
		$("#ENC_Num option:nth-child(1)").prop("selected", "selected");
	}

	function triggerCheckboxes(i){
		return function(){
			if($("#choice"+i+"1").prop("checked") && $("#choice"+i+"0").prop("checked"))
			{
				$("#choice"+i+"0").prop("checked","");
				$("#choice"+i+"1").prop("checked","");
			}
			else
			{
				if(!$("#choice"+i+"0").prop("disabled"))
					$("#choice"+i+"0").prop("checked","checked");
				if(!$("#choice"+i+"1").prop("disabled"))
					$("#choice"+i+"1").prop("checked","checked");
			}
		}
	}
	
	function addSalarie(checkbox){
		if(checkbox.prop("checked")){
			var cellAxis = checkbox.data("value").split("-");
			var cellElement = $(".planning-edit-area > table tbody tr:eq("+parseInt(cellAxis[0])+") td:eq("+(parseInt(cellAxis[1])+1)+")");

			if(cellElement.html().indexOf($("#SAL_NumSalarie").val()) == -1)
			{
				if(cellElement.html() == ""){
					cellElement.html('<ul><li><span data-num="'+$("#SAL_NumSalarie").val()+'">'+$("#SAL_NumSalarie option:selected").html()+
						'</span><input type="button" class="delCross" value="x" onclick="deleteSal(\''+checkbox.data("value")+'-'+$("#SAL_NumSalarie").val()+'\','+checkbox.val()+')"/></li></ul>');
				}
				else{
					cellElement.find("ul").append('<li><span data-num="'+$("#SAL_NumSalarie").val()+'">'+$("#SAL_NumSalarie option:selected").html()+
						'</span><input type="button" class="delCross" value="x" onclick="deleteSal(\''+checkbox.data("value")+'-'+$("#SAL_NumSalarie").val()+'\','+checkbox.val()+')"/></li>');
				}
				dataSalarieToStore[dataSalarieToStore.length] = [$("#SAL_NumSalarie").val(), checkbox.val()];
			}
			checkbox.prop("checked", false);
		}
	}

	function deleteSal(params, creneau){
		var salInfo = params.split("-");
		var cellElement = $(".planning-edit-area > table tbody tr:eq("+parseInt(salInfo[0])+") td:eq("+(parseInt(salInfo[1])+1)+")");

		if(cellElement.find("ul li").length == 1){
			cellElement.find("ul").remove();
		}
		else{
			cellElement.find("ul li").each(function(index){
				if($(this).html().indexOf(salInfo[2]) > -1)
				{
					$(this).remove();
					return;
				}
			});
		}

		for(var x=0; x<dataSalarieToStore.length; x++){
			if(dataSalarieToStore[x][0] == salInfo[2] && dataSalarieToStore[x][1] == creneau){
				dataSalarieToStore.splice(x,1);
				break;
			}
		}
	}
</script>
<?php
	include($pwd."footer.php");
?>