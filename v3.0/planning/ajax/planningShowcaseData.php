<?php
    session_set_cookie_params(0);
	session_start();
	include('../../assets.php');
	$db = revivre();
	mysqli_query($db, "SET NAMES 'utf8'");

	if(isset($_POST["request_type"]) && !empty($_POST["request_type"])){

		switch($_POST["request_type"]){
			case "enc":
				getEncList($db);
				break;

			case "date":
				getDateList($db);
				break;

			case "global":
				getGlobalShowcase($db);
				break;
		}
	}

	function getEncList($db){
		if(isset($_POST["PL_id"]) && !empty($_POST["PL_id"]) && isset($_POST["ASSOC_Date"]) && !empty($_POST["ASSOC_Date"]) && isset($_POST["ASSOC_Archi"]))
		{
			echo '<option value="0" selected="selected" disabled="disabled">Choisissez un encadrant</option>';
			$query = mysqli_query($db, "SELECT DISTINCT pl.ENC_Num, pe.PER_Nom, pe.PER_Prenom FROM pl_association pl
										JOIN salaries sa ON pl.ENC_Num = sa.SAL_NumSalarie
										JOIN personnes pe ON pe.PER_NUM = sa.PER_NUM
										WHERE pl.PL_id = ".$_POST["PL_id"]." AND pl.ASSOC_Date = '".$_POST["ASSOC_Date"]."' AND ASSOC_Archi = ".$_POST["ASSOC_Archi"]." ORDER BY pe.PER_Nom, pe.PER_Prenom");

			while($data = mysqli_fetch_assoc($query))
			{
				echo '<option value="'.$data["ENC_Num"].'">'.$data["PER_Nom"].' '.$data["PER_Prenom"].'</option>';
			}
		}
		else{
			echo '<option value="0" selected="selected" disabled="disabled">Aucune donnée, une erreure s\'est produite</option>';
		}
	}

	function getDateList($db){
		if(isset($_POST["PL_id"]) && !empty($_POST["PL_id"]) && isset($_POST["ASSOC_Archi"]))
		{
			echo '<option value="0" selected="selected" disabled="disabled">Choisissez une date</option>';
			$query = mysqli_query($db, "SELECT DISTINCT ASSOC_Date, date_format(ASSOC_Date, '%d/%m/%Y') AS date FROM pl_association
										WHERE PL_id = ".$_POST["PL_id"]." AND ASSOC_Archi = ".$_POST["ASSOC_Archi"]." ORDER BY ASSOC_Date DESC");

			while($data = mysqli_fetch_assoc($query))
			{
				echo '<option value="'.$data["ASSOC_Date"].'">'.$data["date"].'</option>';
			}
		}
		else{
			echo '<option value="0" selected="selected" disabled="disabled">Aucune donnée, une erreure s\'est produite</option>';
		}
	}

	function getGlobalShowcase($db){
		if(isset($_POST["PL_id"]) && !empty($_POST["PL_id"]) && isset($_POST["ASSOC_Date"]) && !empty($_POST["ASSOC_Date"]) && isset($_POST["ENC_Num"]) && !empty($_POST["ENC_Num"]) && isset($_POST["ASSOC_Archi"]))
		{
			$listeJours = array("Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi");

	        $query = mysqli_query($db, "SELECT concat(PER_Nom, ' ',PER_Prenom) AS nom, CNV_Couleur, CRE_id FROM pl_association
					                    JOIN salaries USING(SAL_NumSalarie)
					                    JOIN personnes USING(PER_Num)
					                    JOIN insertion USING(SAL_NumSalarie)
					                    JOIN convention USING(CNV_id)
					                    WHERE ASSOC_date = '".$_POST["ASSOC_Date"]."' AND ENC_Num = ".$_POST["ENC_Num"]." AND PL_id = ".$_POST["PL_id"]." AND ASSOC_Archi = ".$_POST["ASSOC_Archi"]." ORDER BY CRE_id, nom");
	        $planningContenu = mysqli_fetch_all($query, MYSQLI_ASSOC);

	        $query = mysqli_query($db, "SELECT DISTINCT ASSOC_Couleur, ASSOC_AM, ASSOC_PM, ASSOC_LastEdit FROM pl_proprietees 
	        							WHERE ENC_Num = ".$_POST["ENC_Num"]." AND ASSOC_Date = '".$_POST["ASSOC_Date"]."' AND PL_id = ".$_POST["PL_id"]);
	        $proprietees = mysqli_fetch_assoc($query);

	        $query = mysqli_query($db, "SELECT lo.LOGO_Url FROM pl_logo plo JOIN logo lo ON lo.LOGO_id = plo.LOGO_Id
										WHERE plo.ENC_Num = ".$_POST["ENC_Num"]." AND plo.ASSOC_Date = '".$_POST["ASSOC_Date"]."' AND PL_id = ".$_POST["PL_id"].";");
			$logos =  mysqli_fetch_all($query, MYSQLI_ASSOC);
		?>
			<div class="planning-menu">
				<ul class="buttons">
					<li><input type="button" class="printButton" id="edit" value="Modifier"<?php echo ($_POST["ASSOC_Archi"] == "true") ? " disabled" : ""; ?>/></li>
					<li><input type="button" class="printButton" id="copy" value="Copier"/></li>
					<li><input type="button" class="printButton" id="archive" value="Archiver"<?php echo ($_POST["ASSOC_Archi"] == "true") ? " disabled" : ""; ?>/></li>
					<li><input type="button" class="printButton" id="delete" value="Supprimer"<?php echo ($_POST["ASSOC_Archi"] == "true") ? " disabled" : ""; ?>/></li>
					<li><input type="button" class="printButton" id="print" value="Imprimer"/></li>
				</ul>
				<ul class="hide options">
					<li>Copier le planning au lundi : </li>
					<li><input type="date" name="copyDate" id="copyDate" value="<?php echo date("Y-m-d", strtotime("next monday")); ?>" step="7" class="SpecialDate"></li>
					<li><input name="validCopy" id="validCopy" type="button" value="Valider" class="buttonNormal"></li>
                	<li><input name="cancelCopy" id="cancelCopy" type="button" value="Annuler" class="buttonNormal"></li>
				</ul>
			</div>
			<table>
				<thead style="background-color: <?php echo $proprietees["ASSOC_Couleur"]; ?>;">
					<tr>
						<th>Dernière modification<br/><?php echo date("d/m/Y H:i", strtotime($proprietees["ASSOC_LastEdit"])); ?></th>
						<th>Matin<br/><?php echo $proprietees["ASSOC_AM"]; ?></th>
						<th>Après-midi<br/><?php echo $proprietees["ASSOC_PM"]; ?></th>
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

		                    if(isJourFerie(date("d/m/Y", $dateJourCourant))){
		                        echo '<td><b>'.$listeJours[$x].'<br>FÉRIÉ</b></td>';
		                    }
		                    else{
		                        echo '<td><b>'.$listeJours[$x].'<br>'.date("d/m", $dateJourCourant).'</b></td>';
		                    }

		                    for($y=0; $y<2; $y++)
		                    {
		                        echo '<td><ul>';
		                        while(isset($planningContenu[$z]) && $planningContenu[$z]["CRE_id"] == $CRE_id){
									echo '<li style="color: '.$planningContenu[$z]["CNV_Couleur"].';">'.$planningContenu[$z++]["nom"].'</li>';
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
						echo '<div class="logo-wrapper"><img src="'.$logos[$x]["LOGO_Url"].'"/></div>';
					}
				?>
			</div>
			<div id="dialog-confirm" title="Format d'impression">
				<p style="text-align:center;">Choisissez le format d'impression</p>
			</div>
			<script type="text/javascript">
		<?php
			if($_POST["ASSOC_Archi"] == "false")
			{
		?>
				$("#edit").on("click", function(){
					$.redirect("./planningEdit.php", {"PL_id": $("#PL_id").val(), "ASSOC_Date": $("#ASSOC_Date").val(), "ENC_Num": $("#ENC_Num").val()});
				});

				$("#archive").on("click", function(){
					var canArchive = confirm("Êtes-vous sûr de vouloir archiver le planning ?");
					setTimeout(function(){
						if(canArchive){
							$.redirect("./planningArchive.php", {"PL_id": $("#PL_id").val(), "ASSOC_Date": $("#ASSOC_Date").val(), "ENC_Num": $("#ENC_Num").val()});
						}
					},100);
				});

				$("#delete").on("click", function(){
					var canDelete = confirm("Êtes-vous sûr de vouloir supprimer le planning ?");
					setTimeout(function(){
						if(canDelete){
							$.redirect("./planningDelete.php", {"PL_id": $("#PL_id").val(), "ASSOC_Date": $("#ASSOC_Date").val(), "ENC_Num": $("#ENC_Num").val()});
						}
					},100);
				});

		<?php
			}
		?>
				$("#copy").on("click", function(){
					$(".planning-menu ul.buttons").addClass("hide");
					$(".planning-menu ul.options").removeClass("hide");
				});

				$("#cancelCopy").on("click", function(){
					$(".planning-menu ul.buttons").removeClass("hide");
					$(".planning-menu ul.options").addClass("hide");
				});

				$("#validCopy").on("click", function(){
					$.redirect("./planningCopy.php", {"PL_id": $("#PL_id").val(), "ASSOC_Date": $("#ASSOC_Date").val(), "ENC_Num": $("#ENC_Num").val(), "ASSOC_Date_new": $("#copyDate").val()});
				});

				$("#print").on("click", function(){
					$("#dialog-confirm").dialog({
					    resizable: false,
					    draggable: false,
					    height: 185,
					    modal: true,
					    buttons: {
					        "Format A3": function() {
					        	$(this).dialog("close");
					        	$.redirect("./planningPrinter.php", {"PL_id": $("#PL_id").val(), "ASSOC_Date": $("#ASSOC_Date").val(), "ENC_Num": $("#ENC_Num").val(), "Page_Format":"A3"}, "POST", "_blank");
					        	$(this).dialog("close");

					        },
					        "Format A4": function() {
					        	$(this).dialog("close");
					          	$.redirect("./planningPrinter.php", {"PL_id": $("#PL_id").val(), "ASSOC_Date": $("#ASSOC_Date").val(), "ENC_Num": $("#ENC_Num").val(), "Page_Format":"A4"}, "POST", "_blank");
					          	$(this).dialog("close");
					        }
					    }
					});
				});

			</script>
		<?php
		}
		else{
			echo '<h4>Une erreur s\'est produite !</h4>';
		}
	}
?>