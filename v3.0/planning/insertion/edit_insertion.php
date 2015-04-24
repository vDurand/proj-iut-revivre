<?php
	$pageTitle = "Édition de planning ACI/insertion";
	$pwd='../../';
	include($pwd."bandeau.php");
	if(isset($_POST['Date']) && isset($_POST['numberEdit']) && $_POST['numberEdit'] >= 0)
	{
		$datepl = $_POST['Date'];
		$nbAjoutEncadrant = $_POST['numberEdit'];
	}
	else
	{
		$datepl = 0;
		$nbAjoutEncadrant = 0;
	}
?>
<div id="corps">
<?php
	if($datepl != 0)
	{
		$date = DateTime::createFromFormat('d/m/Y', $datepl)->format('Y-m-d');
		$reponse = mysqli_query($db, "select distinct concat(concat(upper(PER_nom),' '),PER_prenom) as 'nom', ENC_Num
							from pl_association join salaries sa on sa.SAL_NumSalarie = ENC_Num 
							join personnes using(PER_Num) where ASSOC_date='".$date."' AND PL_id = 1 ORDER BY ENC_Num;");
		$x=0;
		while($donnees = mysqli_fetch_assoc($reponse))
		{
			$encadrant[$x] = $donnees["ENC_Num"];
			$encadrantNom[$x++] = $donnees["nom"];
		}
		mysqli_free_result($reponse);
		$CreValue=1;
		$tabJour = Array("Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi");
		$arrayElements = Array();
		echo '<div id="labelT">     
		      <label>Modification du planning de la semaine du lundi : '.$datepl.'</label>
		      </div><br/>';
?>
	<form name="add_personne" id ="add_personne">
		<div class="ConfigPanel">
			<label for="salariechoix">&nbsp;&nbsp;<b>Salarié : </b></label>
			<select id="salariechoix" required="required" style="height:25px;">
				<option value="-1">Choisissez un salarié</option>
				<?php
					$reponse = mysqli_query($db, "SELECT concat(concat(upper(PER_nom),' '), PER_prenom) AS 'Nom', SAL_NumSalarie FROM insertion
												JOIN salaries USING(SAL_NumSalarie) 
												JOIN personnes USING(PER_Num) 
												WHERE TYS_ID = 0 AND TYP_Id = 8 AND SAL_Actif = 1 ORDER BY Nom;");
						while($donnees = mysqli_fetch_assoc($reponse))
						{
							echo '<option value="'.$donnees["SAL_NumSalarie"].'">'.$donnees["Nom"].'</option>';	
						}
						mysqli_free_result($reponse);
				?>
			</select>
			<select id="equipechoix" style="height:25px;">
			<?php
				for($x=0; $x<sizeof($encadrant)+$nbAjoutEncadrant; $x++)
				{
					echo '<option value="'.$x.'">Equipe '.($x+1).'</option>';
				}
			?>
			</select>
			&nbsp;
			<input name="addpersonne" type="button" value="Ajouter la personne au planning" onclick="parseWorkTime()" style="margin:3px 0px 3px 5px;" class="buttonNormal">
			<table style="margin:5px 0px 0px 0px;">
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
	</form>
	<div class="ScrollFrame">
		<div class="planningTable">
			<table id="insertionTableau">
				<thead>
				<?php
					echo '<th id="firstColumn"></th>';
					for($x=0; $x<sizeof($encadrant)+$nbAjoutEncadrant; $x++)
					{
						echo'<th>
								<select id="encadrant'.$x.'" onchange="changeName('.$x.')" required="required">
									<option value="-1">Choisissez un encadrant</option>';
						$reponse = mysqli_query($db, "SELECT concat(concat(upper(PER_nom),' '), PER_prenom) AS 'Nom', SAL_NumSalarie 
											FROM salaries
											JOIN personnes USING(PER_Num)
											WHERE FCT_id = 4 AND SAL_Actif = 1 ORDER BY Nom;");
						while($donnees = mysqli_fetch_assoc($reponse))
						{
							($donnees["SAL_NumSalarie"] == $encadrant[$x]) ? $selectedOrNot = "selected" : $selectedOrNot = "";
							echo '<option '.$selectedOrNot.' value="'.$donnees["SAL_NumSalarie"].'">'.$donnees["Nom"].'</option>';
						}
						mysqli_free_result($reponse);
						echo '</select><br/>8h-12h</th><th id="emptyColumn">P</th><th id="encad'.$x.'"><b>Encadrant équipe n°'.($x+1).'</b><br>13h-17h</th><th id="emptyColumn">P</th>';
					}
					if(sizeof($encadrant)+$nbAjoutEncadrant == 1)
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
					$z=0;
					for($x=0; $x<5; $x++)
					{
				?>
					<tr>
						<td><b><?php echo $tabJour[$x].'<br>'.date("d/m", strtotime($date.' + '.$x.' day')); ?></b></td>
					<?php
						$increment = 0;
						for($y=0; $y<(sizeof($encadrant)*2); $y++)
						{
							$flag = false;
							$query = mysqli_query($db,"SELECT concat(concat(PER_nom,' '),PER_prenom) AS 'nom', SAL_NumSalarie FROM pl_association
													JOIN salaries USING(SAL_NumSalarie)
													JOIN personnes USING(PER_Num)
													WHERE ASSOC_date = '".$date."' AND CRE_id = ".$CreValue." AND ENC_Num = ".$encadrant[$y/2]." AND PL_id = 1;");
							
							$nbRep = mysqli_num_rows($query);
							echo '<td style="text-align:center; vertical-align:middle;">';
							
							while($data = mysqli_fetch_assoc($query))
							{
								if($flag == false)
								{
									echo '<p>'.$data["nom"].'</p><input name="suppr" type="button" class="delCross" value="x" onclick="delPersonne('.($x+1).','.($y+$increment+1).',\''.$data["nom"].'\','.$data["SAL_NumSalarie"].','.$encadrant[$y/2].','.$CreValue.')">';
									$flag=true;
								}
								else
								{
									echo '<br><p>'.$data["nom"].'</p><input name="suppr" type="button" class="delCross" value="x" onclick="delPersonne('.($x+1).','.($y+$increment+1).',\''.$data["nom"].'\','.$data["SAL_NumSalarie"].','.$encadrant[$y/2].','.$CreValue.')">';
								}
								$arrayElements[$z++] = Array($data["SAL_NumSalarie"],$encadrant[$y/2],$CreValue);
							}
							echo '</td><td class="emptyCells"></td>';
							if($CreValue%2 == 0)
								$CreValue--;
							else
								$CreValue++;
							$increment++;
						}
						for($y=0; $y<$nbAjoutEncadrant; $y++)
						{
							echo '<td></td><td></td><td></td><td></td>';
						}
						if(sizeof($encadrant)+$nbAjoutEncadrant==1)
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
					<input type='hidden' id="typePL" name='typePL' value='1'>
					<input type='hidden' id="redirectPage" name='redirectPage' value="./planning_insertion.php">
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
	var numEncad = new Array(<?php for($x=0; $x<sizeof($encadrant)+$nbAjoutEncadrant; $x++){if($x < sizeof($encadrant)+$nbAjoutEncadrant-1) echo 'document.getElementById("encadrant'.$x.'").value, '; else echo 'document.getElementById("encadrant'.$x.'").value';}?>);
	<?php
			for($x=0; $x<sizeof($encadrant)+$nbAjoutEncadrant; $x++)
			{
				echo 'changeName('.$x.');';
			}
	?>

	function changeName(index)
	{
		switch(index)
		{
		<?php
			$predicat = ""; 
			for($y=0; $y<sizeof($encadrant)+$nbAjoutEncadrant; $y++)
			{
				if($y==0) 
				{
					$predicat .= 'document.getElementById("encadrant'.$y.'").value ';
				}
				else 
				{
					$predicat .= '!= document.getElementById("encadrant'.$y.'").value ';
				}
			}
			for($x=0; $x<sizeof($encadrant)+$nbAjoutEncadrant; $x++)
			{
				if(sizeof($encadrant)+$nbAjoutEncadrant > 1)
				{
					echo 'case '.$x.':
						if(document.getElementById("encadrant'.$x.'").value != -1)
						{
							if('.$predicat.')
							{
									document.getElementById("encad'.$x.'").innerHTML = document.getElementById("encadrant'.$x.'").options[document.getElementById("encadrant'.$x.'").selectedIndex].text+"<br>13h-17h";
									for(var x=0; x<tableau.length; x++)
									{
										if(tableau[x][1] == numEncad['.$x.'])
										{
											tableau[x][1] = document.getElementById("encadrant'.$x.'").value;
										}
									}
									numEncad['.$x.'] = document.getElementById("encadrant'.$x.'").value;
							}
							else
							{
								alert("L\'encadrant est déjà sélectionné !");
								document.getElementById("encadrant'.$x.'").value = -1;
							}
						}
						break;';
				}
				else
				{
					echo 'case '.$x.':
						if(document.getElementById("encadrant'.$x.'").value != -1)
						{
							document.getElementById("encad'.$x.'").innerHTML = document.getElementById("encadrant'.$x.'").options[document.getElementById("encadrant'.$x.'").selectedIndex].text+"<br>13h-17h";
							for(var x=0; x<tableau.length; x++)
							{
								if(tableau[x][1] == numEncad['.$x.'])
								{
									tableau[x][1] = document.getElementById("encadrant'.$x.'").value;
								}
							}
							numEncad['.$x.'] = document.getElementById("encadrant'.$x.'").value;
						}
						break;';
				}
			}
		?>
		}
	}

	function parseWorkTime()
	{
		if(document.getElementById("salariechoix").value != -1)
		{
			if(<?php for($x=0; $x<sizeof($encadrant)+$nbAjoutEncadrant; $x++){if($x==0) echo 'document.getElementById("encadrant'.$x.'").value != -1 '; else echo '&& document.getElementById("encadrant'.$x.'").value != -1 ';}?>)
			{
				for(var x=0; x<5; x++)
				{
					for(var y=0; y<2; y++)
					{
						if(document.getElementById("choice"+x+y).checked)
						{
							addPersonne(parseInt(x+1),parseInt(1+(4*document.getElementById("equipechoix").value)+2*y),document.getElementById("encadrant"+document.getElementById("equipechoix").value).value, document.getElementById("choice"+x+y).value);
						}
					}
				}
				document.getElementById("add_personne").reset();
			}
			else
			{
				alert("Veuillez choisir de(s) encadrant(s) correct(s) !");
			}
		}
		else
		{
			alert("Veuillez choisir un salarié dans le menu déroulant !");
		}
	}


	function addPersonne(x,y,encadNum,creneau)
	{
		var table = document.getElementById('insertionTableau');
		var nom = document.getElementById("salariechoix").options[document.getElementById("salariechoix").selectedIndex].text;
		var salarieNum = document.getElementById("salariechoix").value;
		if((table.rows[x].cells[y].innerHTML).indexOf(nom) == -1)
		{
			if(table.rows[x].cells[y].innerHTML != "")
			{
				table.rows[x].cells[y].innerHTML = table.rows[x].cells[y].innerHTML+'<br><p>'+nom+'</p><input name="suppr" type="button" class="delCross" value="x" onclick="delPersonne('+x+','+y+',\''+nom+'\','+salarieNum+','+encadNum+','+creneau+')">';
				tableau[tableau.length] = new Array(salarieNum,encadNum,creneau);
			}
			else
			{
				table.rows[x].cells[y].innerHTML = '<p>'+nom+'</p><input name="suppr" type="button" class="delCross" value="x" onclick="delPersonne('+x+','+y+',\''+nom+'\','+salarieNum+','+encadNum+','+creneau+')">';
				tableau[tableau.length] = new Array(salarieNum,encadNum,creneau);
			}
		}
	}

	function delPersonne(x,y,nom,salarieNum,encadNum,creneau)
	{
		var table = document.getElementById('insertionTableau');
		var txt = table.rows[x].cells[y].innerHTML;
		var chaine = '<p>'+nom+'</p><input name="suppr" type="button" class="delCross" value="x" onclick="delPersonne('+x+','+y+',\''+nom+'\','+salarieNum+','+encadNum+','+creneau+')">';
		if(txt.indexOf('<br>'+chaine) != -1){
			txt=txt.replace('<br>'+chaine,'');
			table.rows[x].cells[y].innerHTML = txt;
			cleanTable(salarieNum,encadNum,creneau);
		}
		else
		{
			if(txt.indexOf(chaine) != -1){
				txt=txt.replace(chaine,'');
				table.rows[x].cells[y].innerHTML = txt;
				cleanTable(salarieNum,encadNum,creneau);
			}
			else
			{
				alert("Une erreur s'est produite, impossible de supprimer !");
			}
		}
	}

	function cleanTable(salarieNum,encadNum,creneau)
	{
		for(var z=0; z<tableau.length; z++)
		{
			if(tableau[z][0] == salarieNum && tableau[z][1] == encadNum && tableau[z][2] == creneau)
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
		<?php
			if(sizeof($encadrant)+$nbAjoutEncadrant > 1)
			{
		?>
				if(<?php for($x=0; $x<sizeof($encadrant)+$nbAjoutEncadrant; $x++){if($x==0) echo 'document.getElementById("encadrant'.$x.'").value '; else echo '!= document.getElementById("encadrant'.$x.'").value ';}?>)
				{
		<?php 
			} 
		?>
					if(confirm("Etes-vous sûr de vouloir sauvegarder le planning ?"))
					{
						document.getElementById('Tableau').value = JSON.stringify(tableau);
				     	document.getElementById("valid_planning").submit();
				    }
		<?php
			if(sizeof($encadrant)+$nbAjoutEncadrant > 1)
			{
		?>
				}
				else
				{
					alert("Veuillez choisir des encadrants différents pour chaque équipe !");
				}
		<?php 
			}
		?>
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