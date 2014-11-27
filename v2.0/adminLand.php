<?php
$pageTitle = "Administration";
	include('bandeau.php');
?>
		<div id="corps">
			<div id="labelT">     
				<label>Panneau d'administration</label>
			</div>
			<br>
			<form method="post" action="terminator.php" name="rm_all" formtype="1" colvalue="2">
				<fieldset>
                    <legend>Suppression</legend>
					<table align="left">
						<tr>
							<td style="text-align: left; width: 250px;">
								<label>Client</label>
							</td>
							<td colspan="2">
								<div class="selectType">
		          					<select name="Client">
		          						<option value="0"></option>
<?php
	$reponse = mysqli_query($db, "SELECT * FROM Clients cl JOIN Personnes pe ON cl.PER_Num=pe.PER_Num ORDER BY PER_Nom");
	while ($donnees = mysqli_fetch_assoc($reponse))
	{
?>
				        				<option value="<?php echo $donnees['PER_Num']; ?>"><?php echo formatUP($donnees['PER_Nom'])." ".formatLOW($donnees['PER_Prenom']); if(!empty($donnees['CLI_Structure'])) echo " (".formatUP($donnees['CLI_Structure']).")"; ?></option>
<?php
	}
	mysqli_free_result($reponse);
?>									
				    				</select>
				    			</div>
				    		</td>
						</tr>
						<tr>
							<td>
								<label>Fournisseur</label>
							</td>
							<td style="width: 250px;">
								<div class="selectType">
		          					<select name="Fourn">
		          						<option value="0"></option>
<?php
	$reponse = mysqli_query($db, "SELECT * FROM Fournisseurs cl JOIN Personnes pe ON cl.PER_Num=pe.PER_Num ORDER BY PER_Nom");
	while ($donnees = mysqli_fetch_assoc($reponse))
	{
?>
				        				<option value="<?php echo $donnees['PER_Num']; ?>"><?php echo formatUP($donnees['PER_Nom']); ?></option>
<?php
	}
	mysqli_free_result($reponse);
?>
				    				</select>
				    			</div>
				    		</td>
                            <td rowspan="2">
                                <input name="submit" style="width: 100px;" type="submit" value="Valider">
                            </td>
						</tr>
						<tr>
							<td>
								<label>Membre</label>
							</td>
							<td>
								<div class="selectType">
		          					<select name="Memb">
		          						<option value="0"></option>
<?php
	$reponse = mysqli_query($db, "SELECT * FROM Salaries cl JOIN Personnes pe ON cl.PER_Num=pe.PER_Num ORDER BY PER_Nom");
	while ($donnees = mysqli_fetch_assoc($reponse))
	{
?>
				        				<option value="<?php echo $donnees['PER_Num']; ?>"><?php echo formatUP($donnees['PER_Nom'])." ".formatLOW($donnees['PER_Prenom']); ?></option>
<?php
	}
	mysqli_free_result($reponse);
?>									
				    				</select>
				    			</div>
				    		</td>
						</tr>
						<tr>
							<td>
								<label>Chantier</label>
							</td>
							<td colspan="2">
								<div class="selectType">
		          					<select name="Chantier">
		          						<option value="0"></option>
<?php
	$reponse = mysqli_query($db, "SELECT * FROM Chantiers");
	while ($donnees = mysqli_fetch_assoc($reponse))
	{
?>
				        				<option value="<?php echo $donnees['CHA_NumDevis']; ?>"><?php echo $donnees['CHA_NumDevis']." - ".$donnees['CHA_Intitule']; ?></option>
<?php
	}
	mysqli_free_result($reponse);
?>									
				    				</select>
				    			</div>
				    		</td>
						</tr>
					</table>
				</fieldset>
			</form>
            <br>
            <form method="post" action="terminator.php" name="add_all" formtype="1" colvalue="2">
                <fieldset>
                    <legend>Ajout</legend>
                    <table align="left">
                        <tr>
                            <td style="text-align: left; width: 250px;">
                                <label>Type de Membre</label>
                            </td>
                            <td style="width: 250px;">
                                <input class="inputC" style="width: 161px;" type="text" name="typeMb">
                            </td>
                            <td>
                                <input name="submit" style="width: 100px;" type="submit" value="Valider">
                            </td>
                        </tr>
                    </table>
                </fieldset>
            </form>
		</div>
<?php  
	include('footer.php');
?>