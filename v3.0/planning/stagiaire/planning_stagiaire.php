<?php
	$pageTitle = "Plannings Stagiaire";
	$pwd='../../';
	include($pwd."bandeau.php");

	if(isset($_POST['date_select']) && $_POST['date_select'] >= 0)
		$datepl = $_POST['date_select'];
	else
		$datepl = 0;
	$tabDate = Array("Aucune date");
	$tabDateArchi = Array("Aucune date");
	$tabJour = Array("Lundi", "Mardi", "Mercredi", "Jeudi");
?>
<div id="corps">
	<form method="POST" action="./planning_stagiaire.php" name="pl_stagiaire">
		<table>
			<tr>
				<td>
					<label>&#8226; Planning des stagiaires de la semaine du lundi : </label>
				</td>
				<td>
					<div class="selectType" style="width:200px">
						<select id="date_select" name="date_select" onchange="this.form.submit()">
							<option <?php if($datepl == 0){echo "selected";} ?> value="0">Choisissez une date</option>
							<?php
								if(isset($_POST["chkArchive"]) && $_POST["chkArchive"])
								{
									$query = mysqli_query($db, "SELECT DISTINCT date_format(ASSOC_date,'%d/%m/%Y') AS 'date' FROM pl_association WHERE PL_id = 3 AND ASSOC_Archi = 1 ORDER BY ASSOC_date DESC;");
									$x=1;
									while($data = mysqli_fetch_assoc($query))
									{
										echo '<option '.(($datepl == $x) ? "selected" : "").' value="'.$x.'">'.$data["date"].'</option>';
										$tabDate[$x++] = $data["date"];
	                                }
								}
								else
								{
									$query = mysqli_query($db, "SELECT DISTINCT date_format(ASSOC_date,'%d/%m/%Y') AS 'date' FROM pl_association WHERE PL_id = 3 AND ASSOC_Archi = 0 ORDER BY ASSOC_date DESC;");
									$x=1;
									while($data = mysqli_fetch_assoc($query))
									{
										echo '<option '.(($datepl == $x) ? "selected" : "").' value="'.$x.'">'.$data["date"].'</option>';
										$tabDate[$x++] = $data["date"];
	                                }

	                                $query = mysqli_query($db, "SELECT DISTINCT date_format(ASSOC_date,'%d/%m/%Y') AS 'date' FROM pl_association WHERE PL_id = 3 AND ASSOC_Archi = 1 ORDER BY ASSOC_date DESC;");
									$x=1;
									while($data = mysqli_fetch_assoc($query))
									{
										$tabDateArchi[$x++] = $data["date"];
	                                }
	                            }
								mysqli_free_result($query);
							?>					
						</select>
					</div>
				</td>
				<td>
					<?php
						if(isset($_POST["chkArchive"]) && $_POST["chkArchive"])
						{
					?>
						<input id="chkArchive" name="chkArchive" type="checkbox" onchange="$('#date_select option:first-child').attr('selected', 'selected'); this.form.submit();" checked/><label>Archives</label>
					<?php
						}
						else
						{
					?>
						<input id="chkArchive" name="chkArchive" type="checkbox" onchange=" $('#date_select option:first-child').attr('selected', 'selected'); this.form.submit();"/><label>Archives</label>
					<?php
						}
					?>
				</td>
			</tr>
		</table>
	</form>
	<div id="divCopyInfo" class="ConfigPanel" style="margin-top:5px; height:25px;">
		<form method="POST" name="pl_stagiaire" id="pl_stagiaire" style="margin:0 auto; text-align:center; padding-top:2px;">
			<div id="basicDiv" style="margin:0; padding:0; display:inline;">
            <?php
            	if(isset($_POST["chkArchive"]) && $_POST["chkArchive"])
            	{
            ?>
                <input name="printPl" id="printPl" type="button" value="Imprimer" class="printButton" <?php if($datepl==0) echo 'disabled="disabled"'; ?> onclick="printPlanning()">
            <?php
            	}
            	else
            	{
            ?>
                <input name="newPl" id="newPl" type="button" value="Nouveau" class="printButton" onclick="newPlanning(1)">
                <input name="editPl" id="editPl" type="button" value="Modifier" class="printButton" <?php if($datepl==0) echo 'disabled="disabled"'; ?> onclick="editPlanning(1)">
                <input name="copiePl" id="copiePl" type="button" value="Copier" class="printButton" <?php if($datepl==0) echo 'disabled="disabled"'; ?> onclick="copyPlanning(1)">
                <input name="delPl" id="delPl" type="button" value="Supprimer" class="printButton" <?php if($datepl==0) echo 'disabled="disabled"'; ?> onclick="deletePlanning()">
                <input name="printPl" id="printPl" type="button" value="Imprimer" class="printButton" <?php if($datepl==0) echo 'disabled="disabled"'; ?> onclick="printPlanning()">
                <input name="archiPl" id="archiPl" type="button" value="Archiver" class="printButton" <?php if($datepl==0) echo 'disabled="disabled"'; ?> onclick="archiPlanning()">
            <?php
            	}
            ?>
			</div>
            <div id="newDiv" style="margin:0; padding:0; display:none;">
                <label>Création d'un planning à la date du</label>
                <input type='date' id="dateNew" name='dateNew' class="SpecialDate" value="<?php echo highestDate($tabDate, $tabDateArchi); ?>" min="<?php echo highestDate($tabDate, $tabDateArchi); ?>" step="7" style="height:21px; margin:0px 5px;">
                <label>avec</label>
                <input type="number" name="numberNew" id="numberNew" style="height:19px; width:40px; margin:0px 5px;" value="1" min="1">
                <label>encadrant(s).&nbsp;&nbsp;&nbsp;&nbsp;</label>
                <input name="validNew" id="validNew" type="button" value="Valider" class="buttonNormal" onclick="newPlanning(3)">
                <input name="cancelNew" id="cancelNew" type="button" value="Annuler" class="buttonNormal" onclick="newPlanning(2)">
            </div>
            <div id="editDiv" style="margin:0; padding:0; display:none;">
                <label>Modification du planning du lundi <?php echo $tabDate[$datepl];?> en ajoutant</label>
                <input type="number" name="numberEdit" id="numberEdit" style="height:19px; width:40px; margin:0px 5px;" value="0" min="0">
                <label>encadrant(s).&nbsp;&nbsp;&nbsp;&nbsp;</label>
                <input name="validEdit" id="validEdit" type="button" value="Valider" class="buttonNormal" onclick="editPlanning(3)">
                <input name="cancelEdit" id="cancelEdit" type="button" value="Annuler" class="buttonNormal" onclick="editPlanning(2)">
            </div>
            <div id="copieDiv" style="margin:0; padding:0; display:none;">
                <label>Copie du planning du lundi <?php echo $tabDate[$datepl];?> pour le</label>
                <input type='date' id="dateToCopy" name='dateToCopy' class="SpecialDate"  value="<?php echo highestDate($tabDate, $tabDateArchi); ?>" min="<?php echo highestDate($tabDate, $tabDateArchi); ?>" step="7" style="height:21px; margin:0px 25px 0px 5px;">
                <input name="validCopie" id="validCopie" type="button" value="Valider" class="buttonNormal" onclick="copyPlanning(3)">
                <input name="cancelCopie" id="cancelCopie" type="button" value="Annuler" class="buttonNormal" onclick="copyPlanning(2)">
            </div>
			<input type='hidden' id="Date" name='Date' value=''>
			<input type='hidden' id="typePL" name='typePL' value='3'>
			<input type='hidden' id="redirectPage" name='redirectPage' value="./stagiaire/planning_stagiaire.php">
		</form>
	</div>
	<?php
		if($datepl != 0)
		{
			$reponse = mysqli_query($db, "select distinct concat(concat(upper(PER_nom),' '),PER_prenom) as 'nom', ENC_Num
								from pl_association join salaries sa on sa.SAL_NumSalarie = ENC_Num 
								join personnes using(PER_Num) where date_format(ASSOC_date, '%d/%m/%Y')='".$tabDate[$datepl]."' AND PL_id = 3 ORDER BY ENC_Num;");
			$x=0;
			while($donnees = mysqli_fetch_assoc($reponse))
			{
				$encadrant[$x] = $donnees["ENC_Num"];
				$encadrantNom[$x++] = $donnees["nom"];
			}
			mysqli_free_result($reponse);
	?>
	<div class="ScrollFrame">
		<div class="planningTable">
			<table>
				<thead>
					<th id="firstColumn"></th>
					<?php 
						for($x=0; $x<sizeof($encadrant); $x++)
						{
							echo '<th>'.$encadrantNom[$x].'<br/>8h30 - 12h</th>
							<th id="emptyColumn">P</th>
							<th>'.$encadrantNom[$x].'<br/>13h - 16h30</th>
							<th id="emptyColumn">P</th>';
						}
						if(sizeof($encadrant)==1)
						{
							echo '<th></th>
							<th id="emptyColumn"></th>
							<th></th>
							<th id="emptyColumn"></th>';
						}
					?>
				</thead>
				<tbody>
				<?php
					$CreValue=1;
					for($x=0; $x<4; $x++)
					{
				?>
						<tr>
                            <?php
                                if(isJourFerie(date("d/m/Y", strtotime(DateTime::createFromFormat('d/m/Y',$tabDate[$datepl])->format('Y-m-d').' + '.$x.' day'))))
                                {
                                    echo '<td><b>'.$tabJour[$x].'<br>FÉRIÉ</td></b>';
                                }
                                else
                                {
                                    echo '<td><b>'.$tabJour[$x].'<br>'.date("d/m", strtotime(DateTime::createFromFormat('d/m/Y',$tabDate[$datepl])->format('Y-m-d').' + '.$x.' day')).'</td></b>'; 
                                }
                        
                                for($y=0; $y<(sizeof($encadrant)*2); $y++)
                                {
                                    $query = mysqli_query($db,"SELECT concat(concat(PER_nom,' '),PER_prenom) AS 'nom', CNV_Couleur FROM pl_association
                                                        JOIN salaries USING(SAL_NumSalarie)
                                                        JOIN personnes USING(PER_Num)
                                                        JOIN insertion using(SAL_NumSalarie)
                                                        JOIN convention using(CNV_id)
                                                        WHERE date_format(ASSOC_date, '%d/%m/%Y') = '".$tabDate[$datepl]."' AND CRE_id = ".$CreValue." AND ENC_Num = ".$encadrant[$y/2]." AND PL_id = 3;");

                                    $nbRep = mysqli_num_rows($query);
                                    ($nbRep==0) ? $couleur = 'url(\'../../images/hachure-planning.png\') repeat' : $couleur = "none";
                                    echo '<td style="text-align:center; vertical-align:middle; background:'.$couleur.';">';

                                    while($data = mysqli_fetch_assoc($query))
                                    {
                                        echo "<span style='color:".$data["CNV_Couleur"].";'>".$data["nom"].'</span><br/>';
                                    }
                                    echo '</td><td class="emptyCells" style="background:'.$couleur.';"></td>';
                                    if($CreValue%2 == 0)
                                        $CreValue--;
                                    else
                                        $CreValue++;
                                }
                                if(sizeof($encadrant)==1)
                                {
                                    echo '<td style="background:url(\'../../images/hachure-planning.png\') repeat;"></td><td style="background:url(\'../../images/hachure-planning.png\') repeat;"></td>
                                          <td style="background:url(\'../../images/hachure-planning.png\') repeat;"></td><td style="background:url(\'../../images/hachure-planning.png\') repeat;"></td>';
                                }
                            ?>
						</tr>
				<?php
					$CreValue += 2;
					}
					mysqli_free_result($query);
				?>
				</tbody>
			</table>
		</div>
	</div>
    <div style="padding-left:5px;">
        <?php
            $query = mysqli_query($db, "SELECT LOGO_Id, LOGO_Url FROM logo
                                        JOIN logo_association USING(LOGO_Id)
                                        WHERE PL_id=3 AND date_format(ASSOC_date, '%d/%m/%Y') = '".$tabDate[$datepl]."';");
            while($data = mysqli_fetch_assoc($query))
            {
                echo '<div style="display:inline-block; width:150px; height:90px; margin:10px 7px 10px 7px;">
                        <img src="../'.$data["LOGO_Url"].'" style="position:absolute; border:1px solid #bcbcbc;">
                    </div>';
            }
        ?>
    </div>
<?php
	}
	else
	{
?>
	<div class="planningTable">
		<table id="insertionTableau">
			<thead>
				<th id="firstColumn"></th>
				<th>Encadrant équipe n°1<br/>9h - 12h</th>
				<th id="emptyColumn">P</th>
				<th><b>Encadrant équipe n°1</b><br>13h - 15h</th>
				<th id="emptyColumn">P</th>
				<th>Encadrant équipe n°2<br/>9h - 12h</th>			
				<th id="emptyColumn">P</th>
				<th><b>Encadrant équipe n°2</b><br>13h - 15h</th>
				<th id="emptyColumn">P</th>
			</thead>
			<tbody>
				<tr>
					<td><b>Lundi<br>00/00</b></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
				</tr>
				<tr>
					<td><b>Mardi<br>00/00</b></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
				</tr>
				<tr>
					<td><b>Mercredi<br>00/00</b></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
				</tr>
				<tr>
					<td><b>Jeudi<br>00/00</b></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
				</tr>
			</tbody>
		</table>
	</div>
<?php
	}
?>
</div>
<script type="text/javascript">
	function deletePlanning()
	{
	    if(confirm('Etes-vous sûr de vouloir supprimer le planning de la semaine du <?php echo $tabDate[$datepl]; ?> ?'))
	    {
	        document.getElementById("pl_stagiaire").action="../del_planning.php";
	        document.getElementById("Date").value="<?php echo $tabDate[$datepl]; ?>";
	        document.getElementById("pl_stagiaire").submit();
	    }
	}

	function editPlanning(type)
	{
		switch(type)
		{
			case 1:
		        document.getElementById("basicDiv").style.display = "none";
				document.getElementById("editDiv").style.display = "inline";
				break;
			case 2:
				document.getElementById("editDiv").style.display = "none";
				document.getElementById("basicDiv").style.display = "inline";
				break;
			case 3:
				document.getElementById("pl_stagiaire").action="./edit_stagiaire.php";
				document.getElementById("Date").value="<?php echo $tabDate[$datepl]; ?>";
				document.getElementById("pl_stagiaire").submit();
				break;
		}
	}

	function copyPlanning(type)
	{	
		switch(type)
		{
			case 1:
				document.getElementById("basicDiv").style.display = "none";
				document.getElementById("copieDiv").style.display = "inline";
				break;
			case 2:
				document.getElementById("copieDiv").style.display = "none";
				document.getElementById("basicDiv").style.display = "inline";
				break;
			case 3:
				if(confirm('Etes-vous sûr de vouloir copier le planning ?'))
			    {
			        document.getElementById("pl_stagiaire").action="../copy_planning.php";
			        document.getElementById("Date").value="<?php echo $tabDate[$datepl]; ?>";
			        document.getElementById("pl_stagiaire").submit();
			    }
				break;
		}
	}

	function newPlanning(type)
	{	
		switch(type)
		{
			case 1:
				document.getElementById("basicDiv").style.display = "none";
				document.getElementById("newDiv").style.display = "inline";
				break;
			case 2:
				document.getElementById("newDiv").style.display = "none";
				document.getElementById("basicDiv").style.display = "inline";
				break;
			case 3:
		        document.getElementById("pl_stagiaire").action="../stagiaire/new_stagiaire.php";
		        document.getElementById("pl_stagiaire").submit();
				break;
		}
	}
    
	function printPlanning()
	{
		document.getElementById("pl_stagiaire").action="../printer.php";
		document.getElementById("pl_stagiaire").target="_blank";
		document.getElementById("Date").value="<?php echo $tabDate[$datepl]; ?>";
		document.getElementById("pl_stagiaire").submit();
	}

	function archiPlanning()
	{
		if(confirm("Êtes-vous sûr de vouloir archiver le planning du <?php echo $tabDate[$datepl]; ?>"))
		{
			$("#pl_stagiaire").attr("action","../archive_planning.php");
			$("#Date").attr("value", "<?php echo $tabDate[$datepl]; ?>");
			$("#pl_stagiaire").submit();
		}
	}
</script>
<?php
	include($pwd."footer.php");
?>