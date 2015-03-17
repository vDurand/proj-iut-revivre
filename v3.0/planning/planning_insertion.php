<?php
	$pwd='../';
	include($pwd."bandeau.php");

	if(isset($_POST['date_select']) && $_POST['date_select'] >= 0 && $_POST['date_select'] < 11)
		$datepl = $_POST['date_select'];
	else
		$datepl = 0;
	$tabDate = Array("Aucune date");
	$tabJour = Array("Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi");

?>
<div id="corps">
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
								$query = mysqli_query($db, "SELECT DISTINCT date_format(ASSOC_date, '%d/%m/%Y') as 'date' FROM pl_insertion ORDER BY ASSOC_date DESC;");
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
<form method="POST" action="./new_insertion.php" name="pl_insertion" id="pl_insertion">
		<input name="newPl" id="newPl" type="submit" value="Nouveau" class="printButton">&nbsp;
		<input name="editPl" id="editPl" type="button" value="Modifier" class="printButton" <?php if($datepl==0) echo 'disabled="disabled"'; ?> onclick="editPlanning()">&nbsp;
		<input type='hidden' id="Date" name='Date' value=''>
		<input type='hidden' id="tableName" name='tableName' value=''>
		<input name="delPl" type="button" value="Supprimer" class="printButton" <?php if($datepl==0) echo 'disabled="disabled"'; ?> onclick="deletePlanning()">
</form>
<br/>
<?php
	if($datepl!=0)
	{
		$reponse = mysqli_query($db, "select distinct concat(concat(upper(PER_nom),' '),PER_prenom) as 'nom', ENC_Num
							from pl_insertion join salaries sa on sa.SAL_NumSalarie = ENC_Num 
							join personnes using(PER_Num) where date_format(ASSOC_date, '%d/%m/%Y')='".$tabDate[$datepl]."' ORDER BY ENC_Num;");
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
				<th id="emptyColumn"></th>
				<th><?php echo $encadrantNom[1]; ?><br/>8h - 12h</th>
				<th id="emptyColumn"></th>
				<th><?php echo $encadrantNom[0]; ?><br/>13h - 17h</th>
				<th id="emptyColumn"></th>
				<th><?php echo $encadrantNom[1]; ?><br/>13h - 17h</th>
			</thead>
			<tbody>
			<?php
				for($x=0; $x<5; $x++)
				{
			?>
					<tr>
						<td><b><?php echo $tabJour[$x]?></b></td>
					<?php
						for($y=0; $y<4; $y++)
						{
							echo '<td style="text-align:center; vertical-align:middle;">';
							$query = mysqli_query($db,"SELECT concat(concat(PER_nom,' '),PER_prenom) AS 'nom' FROM pl_insertion
												JOIN salaries USING(SAL_NumSalarie)
												JOIN personnes USING(PER_Num)
												WHERE date_format(ASSOC_date, '%d/%m/%Y') = '".$tabDate[$datepl]."' AND CRE_id = ".$CreValue." AND ENC_Num = ".$encadrant[$y%2].";");
							while($data = mysqli_fetch_assoc($query))
							{
								echo $data["nom"].'<br/>';
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
		        document.getElementById("pl_insertion").action="./del_planning.php";
		        document.getElementById("tableName").value="pl_insertion";
		        document.getElementById("Date").value="<?php echo $tabDate[$datepl]; ?>";
		        document.getElementById("pl_insertion").submit();
		    }
		}

		function editPlanning()
		{
		        document.getElementById("pl_insertion").action="./edit_planning.php";
		        document.getElementById("Date").value="<?php echo $tabDate[$datepl]; ?>";
		        document.getElementById("pl_insertion").submit();
		}

	</script>
<?php
	}
?>
</div>
<?php
	include($pwd."footer.php");
?>