<?php
	$pageTitle = "Modification d'un planning";
	$pwd='../';
	include($pwd."bandeau.php");

	if(isset($_POST["PL_id"]) && !empty($_POST["PL_id"]) && isset($_POST["ASSOC_Date"]) && !empty($_POST["ASSOC_Date"]) && isset($_POST["ENC_Num"]) && !empty($_POST["ENC_Num"]))
	{
		$nomTypesPlanning = ["1" => "ACI", "2" => "occupationnel", "3" => "stagiaire"];
		$query = mysqli_query($db, "SELECT concat(PER_Nom,' ',PER_Prenom) AS Nom FROM salaries JOIN personnes USING(PER_Num) WHERE SAL_NumSalarie = ".$_POST["ENC_Num"]);
		$nomEncadrant = mysqli_fetch_assoc($query);

		$query = mysqli_query($db, "SELECT LOGO_Url, LOGO_Id, 'false' AS checked FROM logo 
									WHERE LOGO_Id NOT IN (SELECT LOGO_Id FROM pl_logo WHERE ENC_Num = ".$_POST["ENC_Num"]." AND ASSOC_Date ='".$_POST["ASSOC_Date"]."')
									UNION 
									SELECT LOGO_Url, LOGO_Id, 'true' AS checked FROM pl_logo NATURAL JOIN logo 
									WHERE ENC_Num = ".$_POST["ENC_Num"]." AND ASSOC_Date ='".$_POST["ASSOC_Date"]."' ORDER BY LOGO_Id");
		$logos = mysqli_fetch_all($query, MYSQLI_ASSOC);

		$query = mysqli_query($db, "SELECT * FROM pl_proprietees WHERE ASSOC_Date = '".$_POST["ASSOC_Date"]."' AND ENC_Num = ".$_POST["ENC_Num"]);
		$proprietees = mysqli_fetch_assoc($query);

		$typesSalariesFct = [8,7,9];
		$queryListeSalaries = mysqli_query($db, "SELECT PER_Nom, PER_Prenom, SAL_NumSalarie
			FROM insertion
			JOIN salaries USING(SAL_NumSalarie) 
			JOIN personnes USING(PER_Num) 
			WHERE TYS_ID = 0 AND TYP_Id = ".$typesSalariesFct[((int)$_POST["PL_id"])-1]." AND SAL_Actif = 1 AND SAL_NumSalarie NOT IN
			(
				SELECT DISTINCT SAL_NumSalarie FROM pl_association WHERE ASSOC_Date = '".$_POST["ASSOC_Date"]."' AND ENC_Num <> ".$_POST["ENC_Num"]."
			)
			ORDER BY PER_Nom, PER_Prenom;");

        $query = mysqli_query($db, "SELECT concat(PER_Nom, ' ',PER_Prenom) AS nom, CNV_Couleur, CRE_id, SAL_NumSalarie FROM pl_association
		                    JOIN salaries USING(SAL_NumSalarie)
		                    JOIN personnes USING(PER_Num)
		                    JOIN insertion USING(SAL_NumSalarie)
		                    JOIN convention USING(CNV_id)
		                    WHERE ASSOC_date = '".$_POST["ASSOC_Date"]."' AND ENC_Num = ".$_POST["ENC_Num"]." AND PL_id = ".$_POST["PL_id"]." AND ASSOC_Archi = 0 ORDER BY CRE_id, nom");
	    $planningContenu = mysqli_fetch_all($query, MYSQLI_ASSOC);

		$listeJours = ["Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi"];
		$joursFeries = [];
		for($x=0; $x<5; $x++){
			$joursFeries[$x] = isJourFerie(date("d/m/Y", strtotime($_POST["ASSOC_Date"].' + '.$x.' day')));
		}

		$phpDataToJS = [];
		$phpLogoToJS = [];
?>
<div id="corps">
	<div id="labelT">
		<label>Modification : planning <?php echo $nomTypesPlanning[$_POST["PL_id"]]; ?> du <?php echo date("d/m/Y", strtotime($_POST["ASSOC_Date"])); ?> encadré par <i><?php echo $nomEncadrant["Nom"]; ?></i></label>
	</div>
	<div class="planning-edit-area planning-table">
		<div class="planning-edit-tools">
			<label>Salarié : </label>
			<select id="SAL_NumSalarie" name="SAL_NumSalarie" style="width:200px">
				<option value="0" selected="selected" disabled="disabled">Choisissez un salarié</option>
				<?php
					while($data = mysqli_fetch_assoc($queryListeSalaries))
					{
						echo '<option value="'.$data["SAL_NumSalarie"].'">'.$data["PER_Nom"].' '.$data["PER_Prenom"].'</option>';
					}
				?>
			</select>
			<table>
				<tr>
					<td colspan="5"><input type="button" id="checkall" name="checkall" value="Tout sélectionner"></td>
				</tr>
				<tr>
					<td rowspan="2" <?php echo ($joursFeries[0]) ? 'class="ferie"' : ""; ?> ><label class="dayTitle">Lundi : </label></td>
					<td>
						<input type="checkbox" id="choice00" name="choice00" data-value="0-0" value="1" <?php echo ($joursFeries[0]) ? ' disabled ' : ""; ?>/>
						<label for="choice00"<?php echo ($joursFeries[0]) ? ' class="ferie" ' : ""; ?>>Matin</label>
					</td>
					<td rowspan="2" <?php echo ($joursFeries[1]) ? 'class="ferie"' : ""; ?> ><label class="dayTitle">Mardi : </label></td>
					<td>
						<input type="checkbox" id="choice10" name="choice10" data-value="1-0" value="3" <?php echo ($joursFeries[1]) ? ' disabled ' : ""; ?>/>
						<label for="choice10"<?php echo ($joursFeries[1]) ? ' class="ferie" ' : ""; ?>>Matin</label>
					</td>
					<td rowspan="2" <?php echo ($joursFeries[2]) ? 'class="ferie"' : ""; ?> ><label class="dayTitle">Mercredi : </label></td>
					<td>
						<input type="checkbox" id="choice20" name="choice20" data-value="2-0" value="5" <?php echo ($joursFeries[2]) ? ' disabled ' : ""; ?>/>
						<label for="choice20"<?php echo ($joursFeries[2]) ? ' class="ferie" ' : ""; ?>>Matin</label>
					</td>
					<td rowspan="2" <?php echo ($joursFeries[3]) ? 'class="ferie"' : ""; ?> ><label class="dayTitle">Jeudi : </label></td>
					<td>
						<input type="checkbox" id="choice30" name="choice30" data-value="3-0" value="7" <?php echo ($joursFeries[3]) ? ' disabled ' : ""; ?>/>
						<label for="choice30"<?php echo ($joursFeries[3]) ? ' class="ferie" ' : ""; ?>>Matin</label>
					</td>
					<td rowspan="2" <?php echo ($joursFeries[4]) ? 'class="ferie"' : ""; ?> ><label class="dayTitle">Vendredi : </label></td>
					<td>
						<input type="checkbox" id="choice40" name="choice40" data-value="4-0" value="9" <?php echo ($joursFeries[4]) ? ' disabled ' : ""; ?>/>
						<label for="choice40"<?php echo ($joursFeries[4]) ? ' class="ferie" ' : ""; ?>>Matin</label>
					</td>
				</tr>
				<tr>
					<td>
						<input type="checkbox" id="choice01" name="choice01" data-value="0-1" value="2" <?php echo ($joursFeries[0]) ? ' disabled ' : ""; ?>/>
						<label for="choice01"<?php echo ($joursFeries[0]) ? ' class="ferie" ' : ""; ?>>Après-midi</label>
					</td>
					<td>
						<input type="checkbox" id="choice11" name="choice11" data-value="1-1" value="4" <?php echo ($joursFeries[1]) ? ' disabled ' : ""; ?>/>
						<label for="choice11"<?php echo ($joursFeries[1]) ? ' class="ferie" ' : ""; ?>>Après-midi</label>
					</td>
					<td>
						<input type="checkbox" id="choice21" name="choice21" data-value="2-1" value="6" <?php echo ($joursFeries[2]) ? ' disabled ' : ""; ?>/>
						<label for="choice21"<?php echo ($joursFeries[2]) ? ' class="ferie" ' : ""; ?>>Après-midi</label>
					</td>
					<td>
						<input type="checkbox" id="choice31" name="choice31" data-value="3-1" value="8" <?php echo ($joursFeries[3]) ? ' disabled ' : ""; ?>/>
						<label for="choice31"<?php echo ($joursFeries[3]) ? ' class="ferie" ' : ""; ?>>Après-midi</label>
					</td>
					<td>
						<input type="checkbox" id="choice41" name="choice41" data-value="4-1" value="10" <?php echo ($joursFeries[4]) ? ' disabled ' : ""; ?>/>
						<label for="choice41"<?php echo ($joursFeries[4]) ? ' class="ferie" ' : ""; ?>>Après-midi</label>
					</td>
				</tr>
			</table>
			<div class="buttonWrapper">
				<input type="button" id="addSal" name="addSal" value="Ajouter"/>
			</div>
		</div>
		<table>
			<thead style="background-color: <?php echo $proprietees['ASSOC_Couleur']; ?>;">
				<tr>
					<th><input type="color" id="selectColor" name="selectColor" value="<?php echo $proprietees['ASSOC_Couleur']; ?>"/></th>
					<th>Matin<br/><input type="text" id="time-am" name="time-am" value="<?php echo $proprietees['ASSOC_AM']; ?>" class="planning-time"/></th>
					<th>Après-midi<br/><input type="text" id="time-pm" name="time-pm" value="<?php echo $proprietees['ASSOC_PM']; ?>" class="planning-time"/></th>
				</tr>
			</thead>
			<tbody>
				<?php
					$CRE_id = 1;
					$z=0;

					for($x=0; $x<5; $x++)
					{
						echo '<tr>';

						$dateJourCourant = strtotime($_POST["ASSOC_Date"].' + '.$x.' day');

	                    if($joursFeries[$x]){
	                        echo '<td><b>'.$listeJours[$x].'<br>FÉRIÉ</td></b>';
	                    }
	                    else{
	                        echo '<td><b>'.$listeJours[$x].'<br>'.date("d/m", $dateJourCourant).'</td></b>';
	                    }

	                    for($y=0; $y<2; $y++)
	                    {
	                        echo '<td><ul>';
	                        while(isset($planningContenu[$z]) && $planningContenu[$z]["CRE_id"] == $CRE_id){
								echo '<li>
										<span data-num="'.$planningContenu[$z]["SAL_NumSalarie"].'">'.$planningContenu[$z]["nom"].'</span>
										<input type="button" class="delCross" value="x" onclick="deleteSal(\''.$x.'-'.$y.'-'.$planningContenu[$z]['SAL_NumSalarie'].'\','.$CRE_id.')"/>
									</li>';
								$phpDataToJS[$z] = [$planningContenu[$z]['SAL_NumSalarie'], $CRE_id];
	                        	$z++;
	                        }
	                        echo '</ul></td>';

	                        $CRE_id++;
	                    }
	                    echo '</tr>';
	                }
				?>
			</tbody>
		</table>
		<div class="planning-logo">
		<?php
			for($x=0; $x<sizeof($logos); $x++){
				if($logos[$x]["checked"] == "true"){
					echo '<div class="logo-wrapper">
							<input type="checkbox" class="logoCheckbox" data-logo="'.$logos[$x]["LOGO_Id"].'" checked="checked"/>
							<img src="'.$logos[$x]["LOGO_Url"].'"/>
						</div>';
					array_push($phpLogoToJS, (int)($logos[$x]["LOGO_Id"]));
				}
				else{
					echo '<div class="logo-wrapper">
						<input type="checkbox" class="logoCheckbox" data-logo="'.$logos[$x]["LOGO_Id"].'"/>
						<img src="'.$logos[$x]["LOGO_Url"].'"/>
					</div>';
				}
			}
		?>
		</div>
	</div>
	<div class="planning-edit-form">
		<input type="button" id="annuler" name="annuler" class="buttonC" value="Annuler"/>
		<input type="button" id="sauvegarder" name="sauvegarder" class="buttonC" value="Sauvegarder"/>
	</div>
</div>
<script type="text/javascript">
	var dataSalarieToStore = <?php echo json_encode($phpDataToJS);?>;
	var dataLogoToStore = <?php echo json_encode($phpLogoToJS);?>;
	
	$(document).ready(function() {
	    $(".dayTitle").each(function(index){
			$(this).on("click", triggerCheckboxes(index));
		});
	});

	$("#annuler").on("click", function(){
		$.redirect("./planningShowcase.php", {
					"ENC_Num": <?php echo $_POST["ENC_Num"]; ?>,
					"ASSOC_Date": '<?php echo $_POST["ASSOC_Date"]; ?>',
					"PL_id": <?php echo $_POST["PL_id"]; ?>
				});
	});

	$("#sauvegarder").on("click", function(){
		if(dataSalarieToStore.length > 0){
			$.redirect("./planningPost.php", {
				"ENC_Num": <?php echo $_POST["ENC_Num"]; ?>,
				"ASSOC_Date": '<?php echo $_POST["ASSOC_Date"]; ?>',
				"PL_id": <?php echo $_POST["PL_id"]; ?>,
				"DataSalarie": JSON.stringify(dataSalarieToStore),
				"DataLogo": JSON.stringify(dataLogoToStore),
				"ASSOC_Couleur": $("#selectColor").val(),
				"ASSOC_AM": $("#time-am").val(),
				"ASSOC_PM": $("#time-pm").val(),
				"Type": "edit"
			});
		}
		else{
			alert("Vous devez d'abord remplir le planning avant de le sauvegarder.");
		}
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
			}
			dataSalarieToStore[dataSalarieToStore.length] = [$("#SAL_NumSalarie").val(), checkbox.val()];
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
	}
	else{
?>
<script type="text/javascript">
	$.redirect("./planningShowcase.php");
</script>
<?php
	}
	include($pwd."footer.php");
?>