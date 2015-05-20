<?php
	$pageTitle = "Création de planning occupationnel";
	$pwd='../../';
	include($pwd."bandeau.php");
	if(isset($_POST['typePL']) && isset($_POST['numberNew']) && $_POST['numberNew'] > 0 && isset($_POST['dateNew']))
	{
        $date = $_POST['dateNew'];
		$appelValide = $_POST['typePL'];
		$nombreEncadrant = $_POST['numberNew'];
	}
	else
	{
        $date = '01/01/1970';
		$appelValide  = "0";
		$nombreEncadrant = "0";
	}
?>
<div id="corps">
<?php
	if($appelValide == "2")
	{
		$query = mysqli_query($db, "SELECT DISTINCT ASSOC_date FROM pl_association WHERE PL_id = 2 ORDER BY ASSOC_date desc LIMIT 1;");
		$data =  mysqli_fetch_assoc($query);
		$tabJour = Array("Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi");
		mysqli_free_result($query);
		echo '<div id="labelT">     
    		 <label>Création d\'un nouveau planning</label>
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
												WHERE TYS_ID = 0 AND TYP_Id = 9 AND SAL_Actif = 1 ORDER BY Nom;");
						while($donnees = mysqli_fetch_assoc($reponse))
						{
							echo '<option value="'.$donnees["SAL_NumSalarie"].'">'.$donnees["Nom"].'</option>';	
						}
						mysqli_free_result($reponse);
				?>
			</select>
			<select id="equipechoix" style="height:25px;">
			<?php
				for($x=0; $x<$nombreEncadrant; $x++)
				{
					echo '<option value="'.$x.'">Equipe '.($x+1).'</option>';
				}
			?>
			</select>
			&nbsp;
			<input name="addpersonne" type="button" value="Ajouter la personne au planning" onclick="parseWorkTime()" style="margin:3px 0px 3px 5px;" class="buttonNormal">
			<table style="margin:5px 0px 0px 0px;">
                <tr>
					<td rowspan="2" id="daytitle" <?php if(isJourFerie(date("d/m/Y", strtotime($date.' + 0 day')))) echo 'style="color:lightgrey"';?>>&nbsp;&nbsp;Lundi : </td>
					<td>
                        <input type="checkbox" id="choice00" value="1" <?php if(isJourFerie(date("d/m/Y", strtotime($date.' + 0 day')))) echo 'disabled';?>/>
                        <label <?php if(isJourFerie(date("d/m/Y", strtotime($date.' + 0 day')))) echo 'style="color:lightgrey"';?>>Matin</label>
                    </td>
					<td rowspan="2" id="daytitle" <?php if(isJourFerie(date("d/m/Y", strtotime($date.' + 1 day')))) echo 'style="color:lightgrey"';?>>Mardi : </td>
					<td>
                        <input type="checkbox" id="choice10" value="3" <?php if(isJourFerie(date("d/m/Y", strtotime($date.' + 1 day')))) echo 'disabled';?>/>
                        <label <?php if(isJourFerie(date("d/m/Y", strtotime($date.' + 1 day')))) echo 'style="color:lightgrey"';?>>Matin</label>
                    </td>
					<td rowspan="2" id="daytitle" <?php if(isJourFerie(date("d/m/Y", strtotime($date.' + 2 day')))) echo 'style="color:lightgrey"';?>>Mercredi : </td>
					<td>
                        <input type="checkbox" id="choice20" value="5" <?php if(isJourFerie(date("d/m/Y", strtotime($date.' + 2 day')))) echo 'disabled';?>/>
                        <label <?php if(isJourFerie(date("d/m/Y", strtotime($date.' + 2 day')))) echo 'style="color:lightgrey"';?>>Matin</label>
                    </td>
					<td rowspan="2" id="daytitle" <?php if(isJourFerie(date("d/m/Y", strtotime($date.' + 3 day')))) echo 'style="color:lightgrey"';?>>Jeudi : </td>
					<td>
                        <input type="checkbox" id="choice30" value="7" <?php if(isJourFerie(date("d/m/Y", strtotime($date.' + 3 day')))) echo 'disabled';?>/>
                        <label <?php if(isJourFerie(date("d/m/Y", strtotime($date.' + 3 day')))) echo 'style="color:lightgrey"';?>>Matin</label>
                    </td>
					<td rowspan="2" id="daytitle" <?php if(isJourFerie(date("d/m/Y", strtotime($date.' + 4 day')))) echo 'style="color:lightgrey"';?>>Vendredi : </td>
					<td>
                        <input type="checkbox" id="choice40" value="9" <?php if(isJourFerie(date("d/m/Y", strtotime($date.' + 4 day')))) echo 'disabled';?>/>
                        <label <?php if(isJourFerie(date("d/m/Y", strtotime($date.' + 4 day')))) echo 'style="color:lightgrey"';?>>Matin</label>
                    </td>
				</tr>
				<tr>
					<td>
                        <input type="checkbox" id="choice01" value="2" <?php if(isJourFerie(date("d/m/Y", strtotime($date.' + 0 day')))) echo 'disabled';?>/>
                        <label <?php if(isJourFerie(date("d/m/Y", strtotime($date.' + 0 day')))) echo 'style="color:lightgrey"';?>>Après-midi</label>
                    </td>
					<td>
                        <input type="checkbox" id="choice11" value="4" <?php if(isJourFerie(date("d/m/Y", strtotime($date.' + 1 day')))) echo 'disabled';?>/>
                        <label <?php if(isJourFerie(date("d/m/Y", strtotime($date.' + 1 day')))) echo 'style="color:lightgrey"';?>>Après-midi</label>
                    </td>
					<td>
                        <input type="checkbox" id="choice21" value="6" <?php if(isJourFerie(date("d/m/Y", strtotime($date.' + 2 day')))) echo 'disabled';?>/>
                        <label <?php if(isJourFerie(date("d/m/Y", strtotime($date.' + 2 day')))) echo 'style="color:lightgrey"';?>>Après-midi</label>
                    </td>
					<td>
                        <input type="checkbox" id="choice31" value="8" <?php if(isJourFerie(date("d/m/Y", strtotime($date.' + 3 day')))) echo 'disabled';?>/>
                        <label <?php if(isJourFerie(date("d/m/Y", strtotime($date.' + 3 day')))) echo 'style="color:lightgrey"';?>>Après-midi</label>
                    </td>
					<td>
                        <input type="checkbox" id="choice41" value="10" <?php if(isJourFerie(date("d/m/Y", strtotime($date.' + 4 day')))) echo 'disabled';?>/>
                        <label <?php if(isJourFerie(date("d/m/Y", strtotime($date.' + 4 day')))) echo 'style="color:lightgrey"';?>>Après-midi</label>
                    </td>
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
						for($x=0; $x<$nombreEncadrant; $x++)
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
								echo '<option value="'.$donnees["SAL_NumSalarie"].'">'.$donnees["Nom"].'</option>';
							}
							mysqli_free_result($reponse);
							echo '</select><br/>8h30 - 12h</th><th id="emptyColumn">P</th><th id="encad'.$x.'"><b>Encadrant équipe n°'.($x+1).'</b><br>13h - 16h30</th><th id="emptyColumn">P</th>';
						}
						if($nombreEncadrant == 1)
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
					for($x=0; $x<5; $x++)
					{
						echo '<tr><td><b>'.$tabJour[$x].'<br>';
                        
                        if(isJourFerie(date("d/m/Y", strtotime($date.' + '.$x.' day'))))
                        {
                            echo 'FÉRIÉ';
                        }
                        else
                        {
                            echo date("d/m", strtotime($date.' + '.$x.' day')); 
                        }
                        echo '</b></td>';
                        
						for($y=0; $y<$nombreEncadrant*2; $y++)
						{	
				            if(isJourFerie(date("d/m/Y", strtotime($date.' + '.$x.' day'))))
				                echo '<td style="background:url(\'../../images/hachure-planning.png\') repeat;"></td><td style="background:url(\'../../images/hachure-planning.png\') repeat;"></td>';
                            else
                                echo '<td></td><td></td>';
						}
						if($nombreEncadrant == 1)
						{
							echo '<td style="background:url(\'../../images/hachure-planning.png\') repeat;"></td><td style="background:url(\'../../images/hachure-planning.png\') repeat;"></td>
								  <td style="background:url(\'../../images/hachure-planning.png\') repeat;"></td><td style="background:url(\'../../images/hachure-planning.png\') repeat;"></td>';
						}
						echo '</tr>';
					}
				?>
				</tbody>
			</table>
		</div>
	</div>
	<form method="post" action="./post_occupationnel.php" name="valid_planning" id="valid_planning">
		<table style="margin:10px auto 0 auto;">
			<tr>
				<td>
					<input name="cancel" id="cancel" type="button" class="buttonC" value="Annuler" onclick="if(confirm('Etes-vous sûr de vouloir annuler ?')){window.location.replace('./planning_occupationnel.php');}">
					<input type='hidden' id="Tableau" name='Tableau' value=''>
					<input type='hidden' id="Modify" name='Modify' value='false'>
					<input type='hidden' id="typePL" name='typePL' value='2'>
                    <input type="hidden" id="Date" name="Date" value=<?php echo "'".$date."'";?>/>
					<input type='hidden' id="redirectPage" name='redirectPage' value="./planning_occupationnel.php">
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
			 window.setTimeout("location=(\'./planning_occupationnel.php\');",2500);
			 </script>';
	}
?>
</div>
<script type="text/javascript">
	var tableau = new Array;
	var numEncad = new Array(<?php for($x=0; $x<$nombreEncadrant; $x++){if($x < $nombreEncadrant-1) echo 'document.getElementById("encadrant'.$x.'").value, '; else echo 'document.getElementById("encadrant'.$x.'").value';}?>);

	function changeName(index)
	{
		switch(index)
		{
		<?php
			$predicat = ""; 
			for($y=0; $y<$nombreEncadrant; $y++)
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
			for($x=0; $x<$nombreEncadrant; $x++)
			{
				if($nombreEncadrant > 1)
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
			if(<?php for($x=0; $x<$nombreEncadrant; $x++){if($x==0) echo 'document.getElementById("encadrant'.$x.'").value != -1 '; else echo '&& document.getElementById("encadrant'.$x.'").value != -1 ';}?>)
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
            table.rows[x].cells[y].innerHTML = table.rows[x].cells[y].innerHTML+'<div><p>'+nom+'</p><input name="suppr" type="button" class="delCross" value="x" onclick="delPersonne('+x+','+y+',\''+nom+'\','+salarieNum+','+encadNum+','+creneau+')"></div>';
            tableau[tableau.length] = new Array(salarieNum,encadNum,creneau);
		}
	}

	function delPersonne(x,y,nom,salarieNum,encadNum,creneau)
	{
		var table = document.getElementById('insertionTableau');
		var txt = table.rows[x].cells[y].innerHTML;
		var chaine = '<div><p>'+nom+'</p><input name="suppr" type="button" class="delCross" value="x" onclick="delPersonne('+x+','+y+',\''+nom+'\','+salarieNum+','+encadNum+','+creneau+')"></div>';
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
		if(tableau.length > 0)
		{
			if(confirm("Etes-vous sûr de vouloir sauvegarder le planning ?"))
			{
				document.getElementById('Tableau').value = JSON.stringify(tableau);
		     	document.getElementById("valid_planning").submit();
		    }
		}
		else
		{
			alert("Vous devez remplir le planning avant de le sauvegarder !");
		}
	}
</script>
<?php
	include($pwd."footer.php");
?>