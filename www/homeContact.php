		<?php  
		include('bandeau.php');
		?>
		<script src="sorttable.js"></script>
		<script language="javascript"> 
			function fsubmit(value_p) 
			{ 
				document.forms['detailClient'].NumC.value = value_p; 
				document.forms['detailClient'].submit(); 
			} 
</script> 
		<div id="corps">
			<div id="labelT">     
				<label>Liste des Contacts</label>
			</div><br>
					<table class="tableContact" cellpadding="5">
						<thead>
						<tr>
							<td class="firstCol" style="text-align: center; width: 155px;">
								<a href="#">Nom</a>
							</td>
							<td style="text-align: center; width: 155px;">
								<a href="#">Prenom</a>
							</td>
							<td style="text-align: center; width: 155px;">
								<a href="#">Adresse</a>
							</td>
							<td style="text-align: center; width: 155px;">
								<a href="#">Ville</a>
							</td>
							<td class="sorttable_nosort" style="text-align: center; width: 155px;">
								Portable
							</td>
							<td style="text-align: center; width: 155px;">
								<a href="#">Type</a>
							</td>
						</tr>
					</thead>
					<tbody>
						<?php

	if($db = MySQLi_connect("localhost","Kepha",'pfudor', 'Revivre', 0, '/media/sds1/home/alx22/private/mysql/socket'))
		echo '';
	else
		echo 'Erreur';

	$sorter = 'PER_Nom';

	$reponse = mysqli_query($db, "SELECT * FROM Clients cl JOIN Personnes pe ON cl.PER_Num=pe.PER_Num ORDER BY PER_Nom");
	while ($donnees = mysqli_fetch_assoc($reponse))
	{
	?>
						<tr style="font-size: 14;">
							<form method="post" action="detailClient.php" name="detailClient">
								<input type="hidden" name="NumC" value="">
							<td id="detail"><a href="javascript:fsubmit('<?php echo $donnees['CLI_NumClient']; ?>');"><?php echo $donnees['PER_Nom']; ?></td>
							<td><?php echo $donnees['PER_Prenom']; ?></a></td>
							<td><?php echo $donnees['PER_Adresse']; ?></a></td>
							<td><?php echo $donnees['PER_Ville']; ?></a></td>
							<td><?php echo $donnees['PER_TelPort']; ?></a></td>
							<td>Client</td>
							</form>
						</tr>
						<?php
	}
	mysqli_free_result($reponse);

	$reponse = mysqli_query($db, 'SELECT * FROM Encadrant cl JOIN Personnes pe ON cl.PER_Num=pe.PER_Num ORDER BY PER_Nom');
	while ($donnees = mysqli_fetch_assoc($reponse))
	{
	?>
						<tr style="font-size: 14;">
							<form method="post" action="detailEncadrant.php" name="detailClient">
								<input type="hidden" name="NumC" value="">
							<td id="detail"><a href="javascript:fsubmit('<?php echo $donnees['ENC_NumEncadrant']; ?>');"><?php echo $donnees['PER_Nom']; ?></td>
							<td><?php echo $donnees['PER_Prenom']; ?></a></td>
							<td><?php echo $donnees['PER_Adresse']; ?></a></td>
							<td><?php echo $donnees['PER_Ville']; ?></a></td>
							<td><?php echo $donnees['PER_TelPort']; ?></a></td>
							<td>Encadrant</td>
							</form>
						</tr>
						<?php
	}
	mysqli_free_result($reponse);

	$reponse = mysqli_query($db, 'SELECT * FROM Fournisseurs cl JOIN Personnes pe ON cl.PER_Num=pe.PER_Num ORDER BY PER_Nom');
	while ($donnees = mysqli_fetch_assoc($reponse))
	{
	?>
						<tr style="font-size: 14;">
							<form method="post" action="detailFournisseur.php" name="detailClient">
								<input type="hidden" name="NumC" value="">
							<td id="detail"><a href="javascript:fsubmit('<?php echo $donnees['FOU_NumFournisseur']; ?>');"><?php echo $donnees['PER_Nom']; ?></td>
							<td><?php echo $donnees['PER_Prenom']; ?></a></td>
							<td><?php echo $donnees['PER_Adresse']; ?></a></td>
							<td><?php echo $donnees['PER_Ville']; ?></a></td>
							<td><?php echo $donnees['PER_TelPort']; ?></a></td>
							<td>Fournisseur</td>
							</form>
						</tr>
						<?php
	}
	mysqli_free_result($reponse);

	$reponse = mysqli_query($db, 'SELECT * FROM Salaries cl JOIN Personnes pe ON cl.PER_Num=pe.PER_Num ORDER BY PER_Nom');
	while ($donnees = mysqli_fetch_assoc($reponse))
	{
	?>
						<tr style="font-size: 14;">
							<form method="post" action="detailSalarie.php" name="detailClient">
								<input type="hidden" name="NumC" value="">
							<td id="detail"><a href="javascript:fsubmit('<?php echo $donnees['SAL_NumSalarie']; ?>');"><?php echo $donnees['PER_Nom']; ?></td>
							<td><?php echo $donnees['PER_Prenom']; ?></a></td>
							<td><?php echo $donnees['PER_Adresse']; ?></a></td>
							<td><?php echo $donnees['PER_Ville']; ?></a></td>
							<td><?php echo $donnees['PER_TelPort']; ?></a></td>
							<td><?php echo $donnees['SAL_Type']; ?></td>
							</form>
						</tr>
						<?php
	}
	mysqli_free_result($reponse);
	?>
					</tbody>
					</table>
		</div>
	<?php  
		include('footer.php');
		?>