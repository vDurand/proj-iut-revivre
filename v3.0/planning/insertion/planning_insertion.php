<?php
	$pageTitle = "Plannings ACI/Insertion";
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
    	<label>Le planning ACI est en version beta, des modifications risquent d'être apportées.</label>
   	</div>
   	<br/>
	<table>
		<tr>
			<td>
				<label>&#8226; Planning des salariés en ACI de la semaine du lundi : </label>
			</td>
			<td>
				<div class="selectType" style="width:200px">
					<form method="POST" action="./planning_insertion.php" name="pl_insertion">
						<select name="date_select" onchange="this.form.submit()">
							<option <?php if($datepl == 0){echo "selected";} ?> value="0">Choisissez une date</option>
							<?php
								$query = mysqli_query($db, "SELECT DISTINCT date_format(ASSOC_date, '%d/%m/%Y') as 'date' FROM pl_association WHERE PL_id = 1 ORDER BY ASSOC_date DESC;");
								$x=1;
								while($data = mysqli_fetch_assoc($query))
								{
							?>
									<option <?php if($datepl == $x){echo "selected";} ?> value=<?php echo "'".$x."'";?>><?php echo $data["date"]; ?></option>;
							<?php
									$tabDate[$x++] = $data["date"];
									echo $x;
								}
							?>
						</select>
					</form>
				</div>
			</td>
		</tr>
	</table>
<div id="divCopyInfo" class="ConfigPanel" style="margin-top:5px; height:25px;">
	<form method="POST" action="./new_insertion.php" name="pl_insertion" id="pl_insertion" style="margin:0 auto; text-align:center; padding-top:2px;" >
			<input name="newPl" id="newPl" type="submit" value="Nouveau" class="printButton">
			<input name="editPl" id="editPl" type="button" value="Modifier" class="printButton" <?php if($datepl==0) echo 'disabled="disabled"'; ?> onclick="editPlanning()">
			<input name="copiePl" id="copiePl" type="button" value="Copier" class="printButton" <?php if($datepl==0) echo 'disabled="disabled"'; ?> onclick="copyPlanning(1)">
			<label name="labelCopie" id="labelCopie" style="display:none;">Copie du planning du lundi <?php echo $tabDate[$datepl];?> pour le : </label>

			<input type='date' id="dateToCopy" name='dateToCopy' class="SpecialDate" value="<?php if($datepl>0) echo date('Y-m-d',strtotime('next monday + 7 day')); ?>" 
					min="<?php if($datepl>0) echo date('Y-m-d',strtotime('next monday + 7 day')); ?>" step="7" style="height:21px; display:none;">

			<input name="validCopie" id="validCopie" type="button" value="Valider" class="buttonNormal" onclick="copyPlanning(3)" style="display:none;">
			<input name="cancelCopie" id="cancelCopie" type="button" value="X" class="buttonNormal" onclick="copyPlanning(2)" style="display:none;">
			<input name="delPl" id="delPl" type="button" value="Supprimer" class="printButton" <?php if($datepl==0) echo 'disabled="disabled"'; ?> onclick="deletePlanning()">
			<input name="printPl" id="printPl" type="button" value="Imprimer" class="printButton" <?php if($datepl>-1) echo 'disabled="disabled"'; ?> onclick="">
		<input type='hidden' id="Date" name='Date' value=''>
		<input type='hidden' id="typePL" name='typePL' value='1'>
		<input type='hidden' id="redirectPage" name='redirectPage' value="./insertion/planning_insertion.php">
	</form>
</div>
<?php
	if($datepl!=0)
	{
		$reponse = mysqli_query($db, "select distinct concat(concat(upper(PER_nom),' '),PER_prenom) as 'nom', ENC_Num
							from pl_association join salaries sa on sa.SAL_NumSalarie = ENC_Num 
							join personnes using(PER_Num) where date_format(ASSOC_date, '%d/%m/%Y')='".$tabDate[$datepl]."' AND PL_id = 1 ORDER BY ENC_Num;");
		$x=0;
		while($donnees = mysqli_fetch_assoc($reponse))
		{
			$encadrant[$x] = $donnees["ENC_Num"];
			$encadrantNom[$x++] = $donnees["nom"];
		}
		$CreValue=1;
?>
	<div class="planningTable">
		<table>
			<thead>
				<th id="firstColumn"></th>
				<th><?php echo $encadrantNom[0]; ?><br/>8h - 12h</th>
				<th id="emptyColumn">P</th>
				<th><?php echo $encadrantNom[1]; ?><br/>8h - 12h</th>
				<th id="emptyColumn">P</th>
				<th><?php echo $encadrantNom[0]; ?><br/>13h - 17h</th>
				<th id="emptyColumn">P</th>
				<th><?php echo $encadrantNom[1]; ?><br/>13h - 17h</th>
			</thead>
			<tbody>
			<?php
				for($x=0; $x<5; $x++)
				{
			?>
					<tr>
						<td><b><?php echo $tabJour[$x]."<br>".date("d/m", strtotime(DateTime::createFromFormat('d/m/Y',$tabDate[$datepl])->format('Y-m-d').' + '.$x.' day')); ?></b></td>
					<?php
						for($y=0; $y<4; $y++)
						{
							echo '<td style="text-align:center; vertical-align:middle;">';
							$query = mysqli_query($db,"SELECT concat(concat(PER_nom,' '),PER_prenom) AS 'nom', CNV_Couleur FROM pl_association
												JOIN salaries USING(SAL_NumSalarie)
												JOIN personnes USING(PER_Num)
												JOIN insertion using(SAL_NumSalarie)
												JOIN convention using(CNV_id)
												WHERE date_format(ASSOC_date, '%d/%m/%Y') = '".$tabDate[$datepl]."' AND CRE_id = ".$CreValue." AND ENC_Num = ".$encadrant[$y%2]." AND PL_id = 1;");
							while($data = mysqli_fetch_assoc($query))
							{
								echo "<span style='color:".$data["CNV_Couleur"].";'>".$data["nom"].'</span><br/>';
							}
							echo '</td>';
							if($y<3)
							{ 
								echo "<td class='emptyCells'></td>";
							}
							if($y==1)
							{
								$CreValue++;
							}
						}
					?>
					</tr>
			<?php
					$CreValue++;
				}
			?>
			</tbody>
		</table>
	</div>
	<script type="text/javascript">
		function deletePlanning()
		{
		    if(confirm('Etes-vous sûr de vouloir supprimer le planning de la semaine du <?php echo $tabDate[$datepl]; ?> ?'))
		    {
		        document.getElementById("pl_insertion").action="../del_planning.php";
		        document.getElementById("Date").value="<?php echo $tabDate[$datepl]; ?>";
		        document.getElementById("pl_insertion").submit();
		    }
		}

		function editPlanning()
		{
		        document.getElementById("pl_insertion").action="./edit_insertion.php";
		        document.getElementById("Date").value="<?php echo $tabDate[$datepl]; ?>";
		        document.getElementById("pl_insertion").submit();
		}

		function copyPlanning(type)
		{	
			switch(type)
			{
				case 1:
					document.getElementById("copiePl").style.display = document.getElementById("delPl").style.display = "none";
					document.getElementById("newPl").style.display = document.getElementById("editPl").style.display = document.getElementById("printPl").style.display = "none";
					document.getElementById("dateToCopy").style.display = document.getElementById("validCopie").style.display = "inline-block";
					document.getElementById("cancelCopie").style.display = document.getElementById("labelCopie").style.display = "inline-block";
					break;
				case 2:
					document.getElementById("dateToCopy").style.display = document.getElementById("validCopie").style.display = "none";
					document.getElementById("cancelCopie").style.display = document.getElementById("labelCopie").style.display = "none";
					document.getElementById("copiePl").style.display = document.getElementById("delPl").style.display = document.getElementById("newPl").style.display = "inline-block";
					document.getElementById("editPl").style.display = document.getElementById("printPl").style.display = "inline-block";
					break;
				case 3:
					if(confirm('Etes-vous sûr de vouloir copier le planning ?'))
				    {
				        document.getElementById("pl_insertion").action="../copy_planning.php";
				        document.getElementById("Date").value="<?php echo $tabDate[$datepl]; ?>";
				        document.getElementById("pl_insertion").submit();
				    }
					break;
			}
		}

	</script>
<?php
	}
	else
	{
?>
		<div class="planningTable">
			<table id="insertionTableau">
				<thead>
					<th id="firstColumn"></th>
					<th>Encadrant équipe n°1<br/>8h-12h</th>
					<th id="emptyColumn">P</th>
					<th>Encadrant équipe n°2<br/>8h-12h</th>
					<th id="emptyColumn">P</th>
					<th><b>Encadrant équipe n°1</b><br>13h-17h</th>
					<th id="emptyColumn">P</th>
					<th><b>Encadrant équipe n°2</b><br>13h-17h</th>
				</thead>
				<tbody>
					<tr>
						<td><b>Lundi</b></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
					</tr>
					<tr>
						<td><b>Mardi</b></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
					</tr>
					<tr>
						<td><b>Mercredi</b></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
					</tr>
					<tr>
						<td><b>Jeudi</b></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
					</tr>
					<tr>
						<td><b>Vendredi</b></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
					</tr>
				</tbody>
			</table>
		</div>
<?php
	}
?>
</div>
<?php
	include($pwd."footer.php");
?>