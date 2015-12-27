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

			case "global":
				getGlobalNew($db);
				break;
		}
	}

	function getEncList($db){
		if(isset($_POST["ASSOC_Date"]) && !empty($_POST["ASSOC_Date"]) && isset($_POST["PL_id"]) && !empty($_POST["PL_id"]))
		{
			echo '<option value="0" selected="selected" disabled="disabled">Choisissez un encadrant</option>';
			$query = mysqli_query($db, "SELECT PER_Nom, PER_Prenom, SAL_NumSalarie
										FROM salaries
										JOIN personnes USING(PER_Num)
										WHERE FCT_id = 4 AND SAL_Actif = 1 AND SAL_NumSalarie NOT IN
										(
											SELECT DISTINCT ENC_Num FROM pl_association WHERE ASSOC_Date = '".$_POST["ASSOC_Date"]."' AND PL_id = ".$_POST["PL_id"]."
										)
										ORDER BY PER_Nom, PER_Prenom;");

			while($data = mysqli_fetch_assoc($query))
			{
				echo '<option value="'.$data["SAL_NumSalarie"].'">'.$data["PER_Nom"].' '.$data["PER_Prenom"].'</option>';
			}
		}
		else{
			echo '<option value="0" selected="selected" disabled="disabled">Aucune donnée, une erreure s\'est produite</option>';
		}
	}

	function checkJourFerie($mondayDate){
		$tabJoursFeries = [];
		for($x=0; $x<5; $x++){
			$tabJoursFeries[$x] = isJourFerie(date("d/m/Y", strtotime($mondayDate." + ".$x." day")));
		}
		return $tabJoursFeries;
	}

	function getGlobalNew($db){
		if(isset($_POST["ASSOC_Date"]) && !empty($_POST["ASSOC_Date"]) && isset($_POST["PL_id"]) && !empty($_POST["PL_id"]))
		{
			$query = mysqli_query($db, "SELECT PER_Nom, PER_Prenom, SAL_NumSalarie
													FROM insertion
													JOIN salaries USING(SAL_NumSalarie) 
													JOIN personnes USING(PER_Num) 
													WHERE TYS_ID = 0 AND TYP_Id IN (8,7,9) AND SAL_Actif = 1 AND SAL_NumSalarie NOT IN
													(
														SELECT DISTINCT SAL_NumSalarie FROM pl_association WHERE ASSOC_Date = '".$_POST["ASSOC_Date"]."'
													)
													ORDER BY PER_Nom, PER_Prenom;");

			$listeSalaries = mysqli_fetch_all($query, MYSQLI_ASSOC);

			$query = mysqli_query($db, "SELECT * FROM typeplanning WHERE PL_id = ".$_POST["PL_id"].";");
			$proprietees = mysqli_fetch_all($query, MYSQLI_ASSOC);

			$tabJoursFeries = checkJourFerie($_POST["ASSOC_Date"]);

			$query = mysqli_query($db, "SELECT LOGO_Url, LOGO_Id FROM logo;");
			$logos =  mysqli_fetch_all($query, MYSQLI_ASSOC);
?>

			<div class="planning-edit-tools">
				<label>Salarié : </label>
				<select id="SAL_NumSalarie" name="SAL_NumSalarie"style="width:200px">
					<option value="0" selected="selected" disabled="disabled">Choisissez un salarié</option>
					<?php
						for($x=0; $x<sizeof($listeSalaries); $x++){
							echo '<option value="'.$listeSalaries[$x]["SAL_NumSalarie"].'">'.$listeSalaries[$x]["PER_Nom"].' '.$listeSalaries[$x]["PER_Prenom"].'</option>';
						}
					?>
				</select>
				<table>
					<tr>
						<td colspan="5"><input type="button" id="checkall" name="checkall" value="Tout sélectionner"></td>
					</tr>
					<tr>
						<td rowspan="2" <?php echo ($tabJoursFeries[0]) ? 'class="ferie"' : ""; ?> ><label class="dayTitle">Lundi : </label></td>
						<td>
							<input type="checkbox" id="choice00" name="choice00" data-value="0-0" value="1" <?php echo ($tabJoursFeries[0]) ? ' disabled ' : ""; ?>/>
							<label for="choice00"<?php echo ($tabJoursFeries[0]) ? ' class="ferie" ' : ""; ?>>Matin</label>
						</td>
						<td rowspan="2" <?php echo ($tabJoursFeries[1]) ? 'class="ferie"' : ""; ?> ><label class="dayTitle">Mardi : </label></td>
						<td>
							<input type="checkbox" id="choice10" name="choice10" data-value="1-0" value="3" <?php echo ($tabJoursFeries[1]) ? ' disabled ' : ""; ?>/>
							<label for="choice10"<?php echo ($tabJoursFeries[1]) ? ' class="ferie" ' : ""; ?>>Matin</label>
						</td>
						<td rowspan="2" <?php echo ($tabJoursFeries[2]) ? 'class="ferie"' : ""; ?> ><label class="dayTitle">Mercredi : </label></td>
						<td>
							<input type="checkbox" id="choice20" name="choice20" data-value="2-0" value="5" <?php echo ($tabJoursFeries[2]) ? ' disabled ' : ""; ?>/>
							<label for="choice20"<?php echo ($tabJoursFeries[2]) ? ' class="ferie" ' : ""; ?>>Matin</label>
						</td>
						<td rowspan="2" <?php echo ($tabJoursFeries[3]) ? 'class="ferie"' : ""; ?> ><label class="dayTitle">Jeudi : </label></td>
						<td>
							<input type="checkbox" id="choice30" name="choice30" data-value="3-0" value="7" <?php echo ($tabJoursFeries[3]) ? ' disabled ' : ""; ?>/>
							<label for="choice30"<?php echo ($tabJoursFeries[3]) ? ' class="ferie" ' : ""; ?>>Matin</label>
						</td>
						<td rowspan="2" <?php echo ($tabJoursFeries[4]) ? 'class="ferie"' : ""; ?> ><label class="dayTitle">Vendredi : </label></td>
						<td>
							<input type="checkbox" id="choice40" name="choice40" data-value="4-0" value="9" <?php echo ($tabJoursFeries[4]) ? ' disabled ' : ""; ?>/>
							<label for="choice40"<?php echo ($tabJoursFeries[4]) ? ' class="ferie" ' : ""; ?>>Matin</label>
						</td>
					</tr>
					<tr>
						<td>
							<input type="checkbox" id="choice01" name="choice01" data-value="0-1" value="2" <?php echo ($tabJoursFeries[0]) ? ' disabled ' : ""; ?>/>
							<label for="choice01"<?php echo ($tabJoursFeries[0]) ? ' class="ferie" ' : ""; ?>>Après-midi</label>
						</td>
						<td>
							<input type="checkbox" id="choice11" name="choice11" data-value="1-1" value="4" <?php echo ($tabJoursFeries[1]) ? ' disabled ' : ""; ?>/>
							<label for="choice11"<?php echo ($tabJoursFeries[1]) ? ' class="ferie" ' : ""; ?>>Après-midi</label>
						</td>
						<td>
							<input type="checkbox" id="choice21" name="choice21" data-value="2-1" value="6" <?php echo ($tabJoursFeries[2]) ? ' disabled ' : ""; ?>/>
							<label for="choice21"<?php echo ($tabJoursFeries[2]) ? ' class="ferie" ' : ""; ?>>Après-midi</label>
						</td>
						<td>
							<input type="checkbox" id="choice31" name="choice31" data-value="3-1" value="8" <?php echo ($tabJoursFeries[3]) ? ' disabled ' : ""; ?>/>
							<label for="choice31"<?php echo ($tabJoursFeries[3]) ? ' class="ferie" ' : ""; ?>>Après-midi</label>
						</td>
						<td>
							<input type="checkbox" id="choice41" name="choice41" data-value="4-1" value="10" <?php echo ($tabJoursFeries[4]) ? ' disabled ' : ""; ?>/>
							<label for="choice41"<?php echo ($tabJoursFeries[4]) ? ' class="ferie" ' : ""; ?>>Après-midi</label>
						</td>
					</tr>
				</table>
				<div class="buttonWrapper">
					<input type="button" id="addSal" name="addSal" value="Ajouter"/>
				</div>
			</div>
			<table>
				<thead style="background-color: <?php echo $proprietees[0]["PL_Couleur"]; ?>;">
					<tr>
						<th><input type="color" id="selectColor" name="selectColor" value="<?php echo $proprietees[0]["PL_Couleur"]; ?>"/></th>
						<th>Matin<br/><input type="text" id="time-am" name="time-am" value="<?php echo $proprietees[0]["PL_AM"]; ?>" class="planning-time"/></th>
						<th>Après-midi<br/><input type="text" id="time-pm" name="time-pm" value="<?php echo $proprietees[0]["PL_PM"]; ?>" class="planning-time"/></th>
					</tr>
				</thead>
				<tbody>
					<tr><td>Lundi<br/><span class="dayDate"><?php echo ($tabJoursFeries[0]) ? "FÉRIÉ" : date("d/m", strtotime($_POST["ASSOC_Date"]." + 0 day")); ?></span></td><td></td><td></td></tr>
					<tr><td>Mardi<br/><span class="dayDate"><?php echo ($tabJoursFeries[1]) ? "FÉRIÉ" : date("d/m", strtotime($_POST["ASSOC_Date"]." + 1 day")); ?></span></td><td></td><td></td></tr>
					<tr><td>Mercredi<br/><span class="dayDate"><?php echo ($tabJoursFeries[2]) ? "FÉRIÉ" : date("d/m", strtotime($_POST["ASSOC_Date"]." + 2 day")); ?></span></td><td></td><td></td></tr>
					<tr><td>Jeudi<br/><span class="dayDate"><?php echo ($tabJoursFeries[3]) ? "FÉRIÉ" : date("d/m", strtotime($_POST["ASSOC_Date"]." + 3 day")); ?></span></td><td></td><td></td></tr>
					<tr><td>Vendredi<br/><span class="dayDate"><?php echo ($tabJoursFeries[4]) ? "FÉRIÉ" : date("d/m", strtotime($_POST["ASSOC_Date"]." + 4 day")); ?></span></td><td></td><td></td></tr>
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
<?php
		}
	}
?>