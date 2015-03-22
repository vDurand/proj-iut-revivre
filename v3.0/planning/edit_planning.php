<?php
	$pwd='../';
	include($pwd."bandeau.php");
	if(isset($_POST['Date']))
		$datepl = $_POST['Date'];
	else
		$datepl = 0;
?>
<div id="corps">
<?php
	if($datepl != 0)
	{
		$date = DateTime::createFromFormat('d/m/Y', $datepl)->format('Y-m-d');
		$reponse = mysqli_query($db, "select distinct concat(concat(upper(PER_nom),' '),PER_prenom) as 'nom', ENC_Num
							from pl_insertion join salaries sa on sa.SAL_NumSalarie = ENC_Num 
							join personnes using(PER_Num) where ASSOC_date='".$date."' ORDER BY ENC_Num;");
		$x=0;
		while($donnees = mysqli_fetch_assoc($reponse))
		{
			$encadrant[$x] = $donnees["ENC_Num"];
			$encadrantNom[$x++] = $donnees["nom"];
		}
		$CreValue=1;
		$tabJour = Array("Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi");
		$arrayElements = Array();
		echo '<div id="labelT">     
		      <label>Modification du planning de la semaine du lundi : '.$datepl.'</label>
		      </div><br/>';
?>
	<form name="add_personne" id ="add_personne">
		<div class="tableNewPl">
			<label for="adherentchoix">&nbsp;&nbsp;<b>Adhérent : </b></label>
			<select id="adherentchoix" required="required">
				<option value="-1">Choisissez un adhérent</option>
				<?php
					$reponse = mysqli_query($db, "select concat(concat(upper(PER_nom),' '), PER_prenom) as 'Nom', SAL_NumSalarie from insertion
								join salaries using(SAL_NumSalarie) join personnes using(PER_Num)
								where TYS_ID = 0 order by Nom;");
						while($donnees = mysqli_fetch_assoc($reponse))
						{
				?>
							<option value='<?php echo $donnees["SAL_NumSalarie"]?>'><?php echo $donnees["Nom"] ?></option>
				<?php		
						}
				?>
			</select>
			&nbsp;&nbsp;
			<select id="equipechoix">
				<option value="1">Equipe 1</option>
				<option value="3">Equipe 2</option>
			</select>
			&nbsp;&nbsp;
			<input name="addpersonne" type="button" value="Ajouter la personne au planning" onclick="parseWorkTime()">
			<table>
				<tr>
					<td rowspan="2" id="daytitle">&nbsp;&nbsp;Lundi : </td>
					<td><input type="checkbox" id="choice00" value="1" /><label>Matin</label></td>
					<td rowspan="2" id="daytitle">Mardi : </td>
					<td><input type="checkbox" id="choice10" value="3" /><label>Matin</label></td>
					<td rowspan="2" id="daytitle">Mercredi : </td>
					<td><input type="checkbox" id="choice20" value="5" /><label>Matin</label></td>
					<td rowspan="2" id="daytitle">Jeudi : </td>
					<td><input type="checkbox" id="choice30" value="7" /><label>Matin</label></td>
					<td rowspan="2" id="daytitle">Vendredi : </td>
					<td><input type="checkbox" id="choice40" value="9" /><label>Matin</label></td>
				</tr>
				<tr>
					<td><input type="checkbox" id="choice01" value="2" /><label>Après-midi</label></td>
					<td><input type="checkbox" id="choice11" value="4" /><label>Après-midi</label></td>
					<td><input type="checkbox" id="choice21" value="6" /><label>Après-midi</label></td>
					<td><input type="checkbox" id="choice31" value="8" /><label>Après-midi</label></td>
					<td><input type="checkbox" id="choice41" value="10" /><label>Après-midi</label></td>
				</tr>
			</table>
		</div>
		<div class="planningTable">
			<table id="insertionTableau">
				<thead>
					<th id="firstColumn"></th>
					<th>
						<select id="encadrant1" onchange="changeName(0)" required="required">
							<option value="-1">Choisissez un encadrant</option>
							<?php
								$reponse = mysqli_query($db, "select concat(concat(upper(PER_nom),' '), PER_prenom) as 'Nom', SAL_NumSalarie from salaries
												join personnes using(PER_Num)
												where FCT_id = 4 order by Nom;");
									while($donnees = mysqli_fetch_assoc($reponse))
									{
							?>
										<option <?php if($donnees["SAL_NumSalarie"] == $encadrant[0]){echo "selected";} ?> value='<?php echo $donnees["SAL_NumSalarie"]?>'><?php echo $donnees["Nom"] ?></option>
							<?php
									}
							?>
						</select>
						<br/>8h-12h
					</th>
					<th id="emptyColumn"></th>
					<th>
						<select id="encadrant3" onchange="changeName(1)" required="required">
							<option value="-1">Choisissez un encadrant</option>
							<?php
								$reponse = mysqli_query($db, "select concat(concat(upper(PER_nom),' '), PER_prenom) as 'Nom', SAL_NumSalarie from salaries
												join personnes using(PER_Num)
												where FCT_id = 4 order by Nom;");
									while($donnees = mysqli_fetch_assoc($reponse))
									{
							?>
										<option <?php if($donnees["SAL_NumSalarie"] == $encadrant[1]){echo "selected";} ?> value='<?php echo $donnees["SAL_NumSalarie"]?>'><?php echo $donnees["Nom"] ?></option>
							<?php
									}
							?>
						</select>
						<br/>8h-12h
					</th>
					<th id="emptyColumn"></th>
					<th id="encad1"><b>Encadrant équipe n°1</b><br>13h-17h</th>
					<th id="emptyColumn"></th>
					<th id="encad2"><b>Encadrant équipe n°2</b><br>13h-17h</th>
				</thead>
				<tbody>
				<?php
					$z=0;
					for($x=0; $x<5; $x++)
					{	
						echo '<tr>
							 <td><b>'.$tabJour[$x].'</b></td>';
							$increment = 1;
							for($y=0; $y<4; $y++)
							{
								$flag=false;
								echo '<td style="text-align:center; vertical-align:middle;">';
								$query = mysqli_query($db,"SELECT concat(concat(PER_nom,' '),PER_prenom) AS 'nom', SAL_NumSalarie FROM pl_insertion
													JOIN salaries USING(SAL_NumSalarie)
													JOIN personnes USING(PER_Num)
													WHERE ASSOC_date = '".$date."' AND CRE_id = ".$CreValue." AND ENC_Num = ".$encadrant[$y%2].";");
								while($data = mysqli_fetch_assoc($query))
								{
									if($flag == false)
									{
										echo '<p>'.$data["nom"].'</p><input name="suppr" type="button" class="delCross" value="x" onclick="delPersonne('.($x+1).','.($y+$increment).',\''.$data["nom"].'\','.$data["SAL_NumSalarie"].','.$encadrant[$y%2].','.$CreValue.')">';
										$flag=true;
									}
									else
									{
										echo '<br><p>'.$data["nom"].'</p><input name="suppr" type="button" class="delCross" value="x" onclick="delPersonne('.($x+1).','.($y+$increment).',\''.$data["nom"].'\','.$data["SAL_NumSalarie"].','.$encadrant[$y%2].','.$CreValue.')">';
									}
									$arrayElements[$z++] = Array($data["SAL_NumSalarie"],$encadrant[$y%2],$CreValue);
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
								$increment++;
							}
						echo '</tr>';
						$CreValue++;
					}
				?>
				</tbody>
			</table>
		</div>
	</form>
	<form method="post" action="./post_insertion.php" name="valid_planning" id="valid_planning">
		<table style="margin:10px auto 0 auto;">
			<tr>
				<td colspan="2" style="text-align:center;">
					<input type="hidden" id="Date" name="Date" value=<?php echo "'".$date."'";?>/>
				</td>
			</tr>
			<tr>
				<td>
					<input name="cancel" id="cancel" type="button" class="buttonC" value="Annuler" onclick="if(confirm('Etes-vous sûr de vouloir annuler ?')){window.location.replace('./planning_insertion.php');}">
					<input type='hidden' id="Tableau" name='Tableau' value=''>
					<input type='hidden' id="Modify" name='Modify' value='true'>
				</td>
				<td><input name="validPL" type="button" class="buttonC" value="Sauvegarder" onclick="postData()"></td>
			</tr>
		</table>
	</form>
<?php
	}
	else
	{
		echo '<div id="bad">     
		      <label>Une erreur s\'est produite, la requête vers le serveur à expiré !</label>
		      </div>';
	    echo '<script type="text/javascript">
			 window.setTimeout("location=(\'./planning_insertion.php\');",2500);
			 </script>';
	}
?>
</div>
<script type="text/javascript">
	<?php
		$js_array = json_encode($arrayElements);
		echo "var tableau = ".$js_array.";";
	?>
	var numEncad = new Array(document.getElementById("encadrant1").value,document.getElementById("encadrant3").value)
	changeName(0);
	changeName(1);

	function changeName(index)
	{
		switch(index)
		{
			case 0:
				if(document.getElementById("encadrant1").value != -1)
				{
					document.getElementById("encad1").innerHTML = document.getElementById("encadrant1").options[document.getElementById("encadrant1").selectedIndex].text+"<br>13h-17h";
					for(var x=0; x<tableau.length; x++)
					{
						if(tableau[x][1] == numEncad[0])
						{
							tableau[x][1] = document.getElementById("encadrant1").value;
						}
					}
					numEncad[0] = document.getElementById("encadrant1").value;
				}
				break;
			case 1:
				if(document.getElementById("encadrant3").value != -1)
				{
					document.getElementById("encad2").innerHTML = document.getElementById("encadrant3").options[document.getElementById("encadrant3").selectedIndex].text+"<br>13h-17h";
					for(var x=0; x<tableau.length; x++)
					{
						if(tableau[x][1] == numEncad[1])
						{
							tableau[x][1] = document.getElementById("encadrant3").value;
						}
					}
					numEncad[1] = document.getElementById("encadrant3").value;
				}
				break;
		}
	}

	function parseWorkTime()
	{
		if(document.getElementById("adherentchoix").value != -1)
		{
			if(document.getElementById("encadrant1").value != -1 && document.getElementById("encadrant3").value != -1)
			{
				if(document.getElementById("encadrant1").value != document.getElementById("encadrant3").value)
				{
					for(var x=0; x<5; x++)
					{
						for(var y=0; y<2; y++)
						{
							if(document.getElementById("choice"+x+y).checked)
							{
								if(y==1)
								{
									addPersonne(parseInt(x+1),parseInt(document.getElementById("equipechoix").value)+4, document.getElementById("encadrant"+document.getElementById("equipechoix").value).value, document.getElementById("choice"+x+y).value);
								}
								else
								{
									addPersonne(parseInt(x+1),parseInt(document.getElementById("equipechoix").value), document.getElementById("encadrant"+document.getElementById("equipechoix").value).value, document.getElementById("choice"+x+y).value);	
								}
							}
						}
					}
					var idx1 = document.getElementById("encadrant1").selectedIndex;
					var idx2 = document.getElementById("encadrant3").selectedIndex;
					document.getElementById("add_personne").reset();
					document.getElementById("encadrant1").selectedIndex = idx1;
					document.getElementById("encadrant3").selectedIndex = idx2;
				}
				else
				{
					alert("Veuillez choisir des encadrants différents pour chaque équipe !");
				}
			}
			else
			{
				alert("Veuillez choisir des encadrants corrects !");
			}
		}
		else
		{
			alert("Veuillez choisir un adhérent dans le menu déroulant !");
		}
	}

	function addPersonne(x,y,encadNum,creneau)
	{
		var table = document.getElementById('insertionTableau');
		var nom = document.getElementById("adherentchoix").options[document.getElementById("adherentchoix").selectedIndex].text;
		var valueAdh = document.getElementById("adherentchoix").value;
		if((table.rows[x].cells[y].innerHTML).indexOf(nom) == -1)
		{
			if(table.rows[x].cells[y].innerHTML != "")
			{
				table.rows[x].cells[y].innerHTML = table.rows[x].cells[y].innerHTML+'<br><p>'+nom+'</p><input name="suppr" type="button" class="delCross" value="x" onclick="delPersonne('+x+','+y+',\''+nom+'\','+valueAdh+','+encadNum+','+creneau+')">';
				tableau[tableau.length]= new Array(valueAdh,encadNum,creneau);
			}
			else
			{
				table.rows[x].cells[y].innerHTML = '<p>'+nom+'</p><input name="suppr" type="button" class="delCross" value="x" onclick="delPersonne('+x+','+y+',\''+nom+'\','+valueAdh+','+encadNum+','+creneau+')">';
				tableau[tableau.length]= new Array(valueAdh,encadNum,creneau);
			}
		}
	}

	function delPersonne(x,y,nom,valueAdh,encadNum,creneau)
	{
		var table = document.getElementById('insertionTableau');
		var txt = table.rows[x].cells[y].innerHTML;
		var chaine = '<p>'+nom+'</p><input name="suppr" type="button" class="delCross" value="x" onclick="delPersonne('+x+','+y+',\''+nom+'\','+valueAdh+','+encadNum+','+creneau+')">';
		if(txt.indexOf('<br>'+chaine) != -1){
			txt=txt.replace('<br>'+chaine,'');
			table.rows[x].cells[y].innerHTML = txt;
			cleanTable(valueAdh,encadNum,creneau);
		}
		else
		{
			if(txt.indexOf(chaine) != -1){
				txt=txt.replace(chaine,'');
				table.rows[x].cells[y].innerHTML = txt;
				cleanTable(valueAdh,encadNum,creneau);
			}
			else
			{
				alert("Une erreur s'est produite, impossible de supprimer !");
			}
		}
	}

	function cleanTable(valueAdh,encadNum,creneau)
	{
		for(var z=0; z<tableau.length; z++)
		{
			if(tableau[z][0] == valueAdh && tableau[z][1] == encadNum && tableau[z][2] == creneau)
			{
				tableau.splice(z,1);
			}
		}
	}

	function postData()
	{	
		var allEncad = false;
		if(tableau.length > 0)
		{
			if(document.getElementById("encadrant1").value != document.getElementById("encadrant3").value)
			{
				for(var x=0; x<tableau.length; x++)
				{
					if(tableau[x][1] != document.getElementById("encadrant1").value)
						allEncad = true;
				}
				if(allEncad)
				{
					if(confirm("Etes-vous sûr de vouloir sauvegarder le planning ?"))
					{
						document.getElementById('Tableau').value = JSON.stringify(tableau);
				     	document.getElementById("valid_planning").submit();
				    }
				}
				else
				{
					alert("Vous devez ajouter des adhérents aux deux encadrants !");
				}
			}
			else
			{
				alert("Veuillez choisir des encadrants différents pour chaque équipe !");
			}
		}
		else
		{
			alert("Vous devez remplir le planning avant de la sauvegarder !");
		}
	}
</script>
<?php
	include($pwd."footer.php");
?>