<?php
	$pwd='../';
	include($pwd."bandeau.php");
?>
<div id="corps">
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
										<option value='<?php echo $donnees["SAL_NumSalarie"]?>'><?php echo $donnees["Nom"] ?></option>
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
										<option value='<?php echo $donnees["SAL_NumSalarie"]?>'><?php echo $donnees["Nom"] ?></option>
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
		<table style="margin:10px auto -2px auto;">
			<tr style="text-align:center;">
				<td>
					<label for="date"><b>Date : </b></label>
					<input type="date" id="pl_date" value=<?php echo "'".date("Y-m-d",strtotime("next monday"))."'"; ?> min=<?php echo "'".date("Y-m-d",strtotime("next monday"))."'";?> step="7" required="required"/>
				</td>
			</tr>
		</table>
	</form>
	<form method="post" action="./post_insertion.php" name="valid_planning" id="valid_planning">
		<table style="margin:10px auto 0 auto;">
			<tr>
				<td>
					<input name="cancel" id="cancel" type="button" class="buttonC" value="Annuler" onclick="window.location.replace('./planning_insertion.php');">
					<input type='hidden' id="Date" name='Date' value=''>
					<input type='hidden' id="Tableau" name='Tableau' value=''>
				</td>
				<td><input name="validPL" type="button" class="buttonC" style="width:225px;" value="Valider la création du planning" onclick="postData()"></td>
			</tr>
		</table>
	</form>
</div>
<script type="text/javascript">
	var tableau = new Array;
	function changeName(index)
	{
		switch(index)
		{
			case 0:
				if(document.getElementById("encadrant1").value != -1)
					document.getElementById("encad1").innerHTML = document.getElementById("encadrant1").options[document.getElementById("encadrant1").selectedIndex].text+"<br>13h-17h";
				break;
			case 1:
				if(document.getElementById("encadrant3").value != -1)
					document.getElementById("encad2").innerHTML = document.getElementById("encadrant3").options[document.getElementById("encadrant3").selectedIndex].text+"<br>13h-17h";
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
					document.getElementById("encadrant1").disabled = "disabled";
					document.getElementById("encadrant3").disabled = "disabled";
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
				table.rows[x].cells[y].innerHTML = table.rows[x].cells[y].innerHTML+"<br>"+nom+'&nbsp;<input name="suppr" type="button" class="delCross" value="x" onclick="delPersonne('+x+','+y+',\''+nom+'\','+valueAdh+','+encadNum+','+creneau+')">';
				tableau[tableau.length]= new Array(valueAdh,encadNum,creneau);
			}
			else
			{
				table.rows[x].cells[y].innerHTML = nom+'&nbsp;<input name="suppr" type="button" class="delCross" value="x" onclick="delPersonne('+x+','+y+',\''+nom+'\','+valueAdh+','+encadNum+','+creneau+')">';
				tableau[tableau.length]= new Array(valueAdh,encadNum,creneau);
			}
		}
	}

	function delPersonne(x,y,nom,valueAdh,encadNum,creneau)
	{
		var table = document.getElementById('insertionTableau');
		var txt = table.rows[x].cells[y].innerHTML;
		var chaine = nom+'&nbsp;<input name="suppr" type="button" class="delCross" value="x" onclick="delPersonne('+x+','+y+',\''+nom+'\','+valueAdh+','+encadNum+','+creneau+')">';
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
		if(tableau.length > 0)
		{
			if(confirm("Etes-vous sûr de vouloir valider le planning ?"))
			{
				document.getElementById('Tableau').value = JSON.stringify(tableau);
				document.getElementById('Date').value = document.getElementById("pl_date").value;
		     	document.getElementById("valid_planning").submit();
			}
		}
		else
		{
			alert("Vous devez remplir le planning avant de la valider !");
		}
	}
</script>
<?php
	include($pwd."footer.php");
?>