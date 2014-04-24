		<?php  
		include('bandeau.php');
		?>
		<div id="corps">
			<div id="labelT" style="background-color:cde5f7; ">     
				<label>Liste des Clients</label>
			</div><br>
					<table class="listeClients" cellpadding="5">
						<tr>
							<th style="text-align: center; width: 150px;">
								Nom
							</th>
							<th style="text-align: center; width: 150px;">
								Prenom
							</th>
							<th style="text-align: center; width: 150px;">
								Tel Fixe
							</th>
							<th style="text-align: center; width: 150px;">
								Tel Portable
							</th>
							<th style="text-align: center; width: 150px;">
								Fax
							</th>
							<th style="text-align: center; width: 150px;">
								Email
							</th>
							<th style="text-align: center; width: 150px;">
								Adresse
							</th>
						</tr>
						<?php

	if($db = MySQLi_connect("localhost","Kepha",'pfudor', 'Revivre', 0, '/media/sds1/home/alx22/private/mysql/socket'))
		echo '';
	else
		echo 'Erreur';

	$reponse = mysqli_query($db, 'SELECT * FROM Clients');
	while ($donnees = mysqli_fetch_assoc($reponse))
	{
	?>
						<tr style="font-size: 14;">
							<td><?php echo $donnees['CLI_Nom']; ?></td>
							<td><?php echo $donnees['CLI_Prenom']; ?></td>
							<td><?php echo $donnees['CLI_TelFixe']; ?></td>
							<td><?php echo $donnees['CLI_TelPort']; ?></td>
							<td><?php echo $donnees['CLI_Fax']; ?></td>
							<td><?php echo $donnees['CLI_Email']; ?></td>
							<td><?php echo $donnees['CLI_Adresse']; ?>, <?php echo $donnees['CLI_Ville']; ?> <?php echo $donnees['CLI_CodePostal']; ?></td>
						</tr>
						<?php
	}

	mysqli_free_result($reponse);
	?>
					</table>
		</div>
	<?php  
		include('footer.php');
		?>