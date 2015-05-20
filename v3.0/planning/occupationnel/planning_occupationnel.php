<?php
	$pageTitle = "Plannings Occupationnel";
	$pwd='../../';
	include($pwd."bandeau.php");

	if(isset($_POST['date_select']) && $_POST['date_select'] >= 0 && $_POST['date_select'] < 11)
		$datepl = $_POST['date_select'];
	else
		$datepl = 0;
	$tabDate = Array("Aucune date");
	$tabJour = Array("Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi");
?>
<div id="corps">
	<div id="info">     
    	<label>Les plannings sont en version beta, des modifications risquent d'être apportées.</label>
   	</div>
    <br>
	<table>
		<tr>
			<td>
				<label>&#8226; Planning occupationnel de la semaine du lundi : </label>
			</td>
			<td>
				<div class="selectType" style="width:200px">
					<form method="POST" action="./planning_occupationnel.php" name="pl_occupationnel">
						<select name="date_select" onchange="this.form.submit()">
							<option <?php if($datepl == 0){echo "selected";} ?> value="0">Choisissez une date</option>
							<?php 
								$requete = mysqli_query($db,"SELECT DISTINCT date_format(ASSOC_date,'%d/%m/%Y') AS 'date' FROM pl_association WHERE PL_id = 2 ORDER BY ASSOC_date DESC;");
								$i=1;
								while($data = mysqli_fetch_assoc($requete))
								{
							?>
									<option <?php if($datepl == $i){echo "selected";} ?> value=<?php echo "'".$i."'";?>><?php echo $data["date"]; ?></option>;
							<?php
									$tabDate[$i++] = $data["date"];
										echo $i;
								}
								mysqli_free_result($query);				
							?>				
						</select>
					</form>
				</div>
			</td>
		</tr>
	</table>
	<div id="divCopyInfo" class="ConfigPanel" style="margin-top:5px; height:25px;">
		<form method="POST" name="pl_occupationnel" id="pl_occupationnel" style="margin:0 auto; text-align:center; padding-top:2px;">
			<div id="basicDiv" style="margin:0; padding:0; display:inline;">
				<input name="newPl" id="newPl" type="button" value="Nouveau" class="printButton" onclick="newPlanning(1)">
				<input name="editPl" id="editPl" type="button" value="Modifier" class="printButton" <?php if($datepl==0) echo 'disabled="disabled"'; ?> onclick="editPlanning(1)">
				<input name="copiePl" id="copiePl" type="button" value="Copier" class="printButton" <?php if($datepl==0) echo 'disabled="disabled"'; ?> onclick="copyPlanning(1)">
				<input name="delPl" id="delPl" type="button" value="Supprimer" class="printButton" <?php if($datepl==0) echo 'disabled="disabled"'; ?> onclick="deletePlanning()">
				<input name="printPl" id="printPl" type="button" value="Imprimer" class="printButton" <?php if($datepl>-1) echo 'disabled="disabled"'; ?> onclick="">
			</div>
            <div id="newDiv" style="margin:0; padding:0; display:none;">
                <label>Création d'un planning à la date du</label>
                <input type='date' id="dateNew" name='dateNew' class="SpecialDate" 
                       value="<?php if($datepl>0){echo date('Y-m-d',strtotime(DateTime::createFromFormat('d/m/Y', $tabDate[1])->format('Y-m-d').'+ 7 day'));}
                    else{$valueDate = (sizeof($tabDate)>1) ? date('Y-m-d',strtotime(DateTime::createFromFormat('d/m/Y', $tabDate[1])->format('Y-m-d').'+ 7 day')) : date('Y-m-d',strtotime("next monday")); echo $valueDate;}?>" 
                       min="<?php if($datepl>0){echo date('Y-m-d',strtotime(DateTime::createFromFormat('d/m/Y', $tabDate[1])->format('Y-m-d').'+ 7 day'));}
                    else{$valueDate = (sizeof($tabDate)>1) ? date('Y-m-d',strtotime(DateTime::createFromFormat('d/m/Y', $tabDate[1])->format('Y-m-d').'+ 7 day')) : date('Y-m-d',strtotime("next monday")); echo $valueDate;}?>" 
                       step="7" style="height:21px; margin:0px 5px;">
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
                <input type='date' id="dateToCopy" name='dateToCopy' class="SpecialDate" value="<?php if($datepl>0) echo date('Y-m-d',strtotime(DateTime::createFromFormat('d/m/Y', $tabDate[1])->format('Y-m-d').'+ 7 day')); ?>" 
                        min="<?php if($datepl>0) echo date('Y-m-d',strtotime(DateTime::createFromFormat('d/m/Y', $tabDate[1])->format('Y-m-d').'+ 7 day')); ?>" 
                       step="7" style="height:21px; margin:0px 25px 0px 5px;" <?php echo $tabDate[1]; ?>>
                <input name="validCopie" id="validCopie" type="button" value="Valider" class="buttonNormal" onclick="copyPlanning(3)">
                <input name="cancelCopie" id="cancelCopie" type="button" value="Annuler" class="buttonNormal" onclick="copyPlanning(2)">
            </div>
			<input type='hidden' id="Date" name='Date' value=''>
			<input type='hidden' id="typePL" name='typePL' value='2'>
			<input type='hidden' id="redirectPage" name='redirectPage' value="./occupationnel/planning_occupationnel.php">
		</form>
	</div>
	<?php
		if($datepl != 0)
		{
			$reponse = mysqli_query($db, "select distinct concat(concat(upper(PER_nom),' '),PER_prenom) as 'nom', ENC_Num
								from pl_association join salaries sa on sa.SAL_NumSalarie = ENC_Num 
								join personnes using(PER_Num) where date_format(ASSOC_date, '%d/%m/%Y')='".$tabDate[$datepl]."' AND PL_id = 2 ORDER BY ENC_Num;");
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
					for($x=0; $x<5; $x++)
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
                                                        WHERE date_format(ASSOC_date, '%d/%m/%Y') = '".$tabDate[$datepl]."' AND CRE_id = ".$CreValue." AND ENC_Num = ".$encadrant[$y/2]." AND PL_id = 2;");

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
<?php
	}
	else
	{
?>
	<div class="planningTable">
		<table id="insertionTableau">
			<thead>
				<th id="firstColumn"></th>
				<th><b>Encadrant équipe n°1</b><br/>8h30 - 12h</th>
				<th id="emptyColumn"></th>
				<th><b>Encadrant équipe n°1</b><br>13h - 16h30</th>
				<th id="emptyColumn">P</th>
				<th></th>			
				<th id="emptyColumn"></th>
				<th></th>
				<th id="emptyColumn"></th>
			</thead>
			<tbody>
				<tr>
					<td><b>Lundi<br>00/00</b></td><td></td><td></td><td></td><td></td>
					<td style="background : url('../../images/hachure-planning.png') repeat;"></td>
					<td style="background : url('../../images/hachure-planning.png') repeat;"></td>
					<td style="background : url('../../images/hachure-planning.png') repeat;"></td>
					<td style="background : url('../../images/hachure-planning.png') repeat;"></td>
				</tr>
				<tr>
					<td><b>Mardi<br>00/00</b></td><td></td><td></td><td></td><td></td>
					<td style="background : url('../../images/hachure-planning.png') repeat;"></td>
					<td style="background : url('../../images/hachure-planning.png') repeat;"></td>
					<td style="background : url('../../images/hachure-planning.png') repeat;"></td>
					<td style="background : url('../../images/hachure-planning.png') repeat;"></td>
				</tr>
				<tr>
					<td><b>Mercredi<br>00/00</b></td><td></td><td></td><td></td><td></td>
					<td style="background : url('../../images/hachure-planning.png') repeat;"></td>
					<td style="background : url('../../images/hachure-planning.png') repeat;"></td>
					<td style="background : url('../../images/hachure-planning.png') repeat;"></td>
					<td  style="background : url('../../images/hachure-planning.png') repeat;"></td>
				</tr>
				<tr>
					<td><b>Jeudi<br>00/00</b></td><td></td><td></td><td></td><td></td>
					<td style="background : url('../../images/hachure-planning.png') repeat;"></td>
					<td style="background : url('../../images/hachure-planning.png') repeat;"></td>
					<td style="background : url('../../images/hachure-planning.png') repeat;"></td>
					<td style="background : url('../../images/hachure-planning.png') repeat;"></td>
				</tr>
				<tr>
					<td><b>Vendredi<br>00/00</b></td><td></td><td></td><td></td><td></td>
					<td style="background : url('../../images/hachure-planning.png') repeat;"></td>
					<td style="background : url('../../images/hachure-planning.png') repeat;"></td>
					<td style="background : url('../../images/hachure-planning.png') repeat;"></td>
					<td style="background : url('../../images/hachure-planning.png') repeat;"></td>
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
	        document.getElementById("pl_occupationnel").action="../del_planning.php";
	        document.getElementById("Date").value="<?php echo $tabDate[$datepl]; ?>";
	        document.getElementById("pl_occupationnel").submit();
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
				document.getElementById("pl_occupationnel").action="./edit_occupationnel.php";
				document.getElementById("Date").value="<?php echo $tabDate[$datepl]; ?>";
				document.getElementById("pl_occupationnel").submit();
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
			        document.getElementById("pl_occupationnel").action="../copy_planning.php";
			        document.getElementById("Date").value="<?php echo $tabDate[$datepl]; ?>";
			        document.getElementById("pl_occupationnel").submit();
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
		        document.getElementById("pl_occupationnel").action="../occupationnel/new_occupationnel.php";
		        document.getElementById("pl_occupationnel").submit();
				break;
		}
	}

</script>
<?php
	include($pwd."footer.php");
?>