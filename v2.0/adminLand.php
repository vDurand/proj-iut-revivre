		<?php  
		include('bandeau.php');
		?>
		<div id="corps">
			<div id="labelT">     
				<label>Admin Cave</label>
			</div>
			<br>
			<form method="post" action="terminator.php" name="rm_all" formtype="1" colvalue="2">
				<div id="labelCat">
					<table align="center">
						<tr>
							<td style="text-align: left; width: 150px;">
								<label>Client</label>
							</td>
							<td>
								<div class="selectType">
		          					<select name="Client">
		          						<option value="0"></option>
		          			<?php

	if($db = MySQLi_connect("localhost","Kepha",'pfudor', 'Revivre', 0, '/media/sds1/home/alx22/private/mysql/socket'))
		echo '';
	else
		echo 'Erreur';
	$i = 2;
	$reponse = mysqli_query($db, "SELECT * FROM Clients cl JOIN Personnes pe ON cl.PER_Num=pe.PER_Num ORDER BY PER_Nom");
	while ($donnees = mysqli_fetch_assoc($reponse))
	{
		?>
				        				<option value="<?php echo $donnees['PER_Num']; ?>"><?php echo $donnees['PER_Nom']; ?></option>
				        	<?php
	$i++;
	}
	mysqli_free_result($reponse);
	?>									
				    				</select>
				    			</div>
				    		</td>
						</tr>
						<tr>
							<td style="text-align: left; width: 150px;">
								<label>Fournisseur</label>
							</td>
							<td>
								<div class="selectType">
		          					<select name="Fourn">
		          						<option value="0"></option>
		          			<?php

	if($db = MySQLi_connect("localhost","Kepha",'pfudor', 'Revivre', 0, '/media/sds1/home/alx22/private/mysql/socket'))
		echo '';
	else
		echo 'Erreur';
	$i = 2;
	$reponse = mysqli_query($db, "SELECT * FROM Fournisseurs cl JOIN Personnes pe ON cl.PER_Num=pe.PER_Num ORDER BY PER_Nom");
	while ($donnees = mysqli_fetch_assoc($reponse))
	{
		?>
				        				<option value="<?php echo $donnees['PER_Num']; ?>"><?php echo $donnees['PER_Nom']; ?></option>
				        	<?php
	$i++;
	}
	mysqli_free_result($reponse);
	?>									
				    				</select>
				    			</div>
				    		</td>
						</tr>
						<tr>
							<td style="text-align: left; width: 150px;">
								<label>Membre</label>
							</td>
							<td>
								<div class="selectType">
		          					<select name="Memb">
		          						<option value="0"></option>
		          			<?php

	if($db = MySQLi_connect("localhost","Kepha",'pfudor', 'Revivre', 0, '/media/sds1/home/alx22/private/mysql/socket'))
		echo '';
	else
		echo 'Erreur';
	$i = 2;
	$reponse = mysqli_query($db, "SELECT * FROM Salaries cl JOIN Personnes pe ON cl.PER_Num=pe.PER_Num ORDER BY PER_Nom");
	while ($donnees = mysqli_fetch_assoc($reponse))
	{
		?>
				        				<option value="<?php echo $donnees['PER_Num']; ?>"><?php echo $donnees['PER_Nom']; ?></option>
				        	<?php
	$i++;
	}
	mysqli_free_result($reponse);
	?>									
				    				</select>
				    			</div>
				    		</td>
						</tr>
						<tr>
							<td style="text-align: left; width: 150px;">
								<label>Chantier</label>
							</td>
							<td>
								<div class="selectType">
		          					<select name="Chantier">
		          						<option value="0"></option>
		          			<?php

	if($db = MySQLi_connect("localhost","Kepha",'pfudor', 'Revivre', 0, '/media/sds1/home/alx22/private/mysql/socket'))
		echo '';
	else
		echo 'Erreur';
	$i = 2;
	$reponse = mysqli_query($db, "SELECT * FROM Chantiers");
	while ($donnees = mysqli_fetch_assoc($reponse))
	{
		?>
				        				<option value="<?php echo $donnees['CHA_NumDevis']; ?>"><?php echo $donnees['CHA_Id']; ?></option>
				        	<?php
	$i++;
	}
	mysqli_free_result($reponse);
	?>									
				    				</select>
				    			</div>
				    		</td>
						</tr>
						<tr>
						<td colspan="2">&nbsp;
						</td>
						</tr>
						<tr>
						<td colspan="2">
							<span>
								<input name="submit" type="submit" value="RM dat Shite" class="buttonC">&nbsp;&nbsp; 
								<input name="reset" type="reset" value="Useless button" class="buttonC">
							</span>
						</td>
					</tr>
					</table>
				</div>
			</form>
		</div>
		<?php  
		include('footer.php');
		?>