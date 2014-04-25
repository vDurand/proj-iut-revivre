		<?php  
		include('bandeau.php');
		?>
		<script language="javascript"> 
			function fsubmit(value_p) 
			{ 
				document.forms['detailClient'].NumC.value = value_p; 
				document.forms['detailClient'].submit(); 
			} 
</script> 
		<div id="corps">
			<div id="labelT">     
				<label>Liste des Clients</label>
			</div><br>
				<div class="listeClients">
					<table cellpadding="5">
						<tr>
							<td style="text-align: center; width: 150px;">
								Nom
							</td>
							<td style="text-align: center; width: 150px;">
								Prenom
							</td>
							<td style="text-align: center; width: 150px;">
								Tel Fixe
							</td>
							<td style="text-align: center; width: 150px;">
								Tel Portable
							</td>
							<td style="text-align: center; width: 150px;">
								Structure
							</td>
							<td style="text-align: center; width: 150px;">
								Email
							</td>
							<td style="text-align: center; width: 150px;">
								Adresse
							</td>
						</tr>
						<?php

	if($db = MySQLi_connect("localhost","Kepha",'pfudor', 'Revivre', 0, '/media/sds1/home/alx22/private/mysql/socket'))
		echo '';
	else
		echo 'Erreur';

	$reponse = mysqli_query($db, 'SELECT * FROM Clients cl JOIN Personnes pe ON cl.PER_Num=pe.PER_Num ORDER BY PER_Nom');
	while ($donnees = mysqli_fetch_assoc($reponse))
	{
	?>
						<tr style="font-size: 14;">
							<form method="post" action="detailClient.php" name="detailClient">
								<input type="hidden" name="NumC" value="">
							<td id="detail"><a href="javascript:fsubmit('<?php echo $donnees['CLI_NumClient']; ?>');"><?php echo $donnees['PER_Nom']; ?></td>
							<td><?php echo $donnees['PER_Prenom']; ?></a></td>
							<td><?php echo $donnees['PER_TelFixe']; ?></td>
							<td><?php echo $donnees['PER_TelPort']; ?></td>
							<td><?php echo $donnees['CLI_Structure']; ?></td>
							<td><?php echo $donnees['PER_Email']; ?></td>
							<td><?php echo $donnees['PER_Adresse']; ?>, <?php echo $donnees['PER_Ville']; ?> <?php echo $donnees['PER_CodePostal']; ?></td>
							</form>
						</tr>
						<?php
	}

	mysqli_free_result($reponse);
	?>
					</table>
				</div>
		</div>
	<?php  
		include('footer.php');
		?>