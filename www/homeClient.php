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
				<label>Liste des Contacts</label>
			</div><br>
					<table class="listeClients" cellpadding="5">
						<tr>
							<td style="text-align: center; width: 150px;">
								Nom
							</td>
							<td style="text-align: center; width: 150px;">
								Prenom
							</td>
							<td style="text-align: center; width: 150px;">
								Type
							</td>
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
							<form method="post" action="detailClient.php" name="detailClient">
								<input type="hidden" name="NumC" value="">
							<td id="detail"><a href="javascript:fsubmit('<?php echo $donnees['CLI_NumClient']; ?>');"><?php echo $donnees['CLI_Nom']; ?></td>
							<td><?php echo $donnees['CLI_Prenom']; ?></a></td>
							<td>Client</td>
							</form>
						</tr>
						<?php
	}
	mysqli_free_result($reponse);

	$reponse = mysqli_query($db, 'SELECT * FROM Encadrant');
	while ($donnees = mysqli_fetch_assoc($reponse))
	{
	?>
						<tr style="font-size: 14;">
							<form method="post" action="detailClient.php" name="detailClient">
								<input type="hidden" name="NumC" value="">
							<td id="detail"><a href="javascript:fsubmit('<?php echo $donnees['ENC_NumEncadrant']; ?>');"><?php echo $donnees['ENC_Nom']; ?></td>
							<td><?php echo $donnees['ENC_Prenom']; ?></a></td>
							<td>Encadrant</td>
							</form>
						</tr>
						<?php
	}
	mysqli_free_result($reponse);

	$reponse = mysqli_query($db, 'SELECT * FROM Fournisseurs');
	while ($donnees = mysqli_fetch_assoc($reponse))
	{
	?>
						<tr style="font-size: 14;">
							<form method="post" action="detailClient.php" name="detailClient">
								<input type="hidden" name="NumC" value="">
							<td id="detail"><a href="javascript:fsubmit('<?php echo $donnees['FOU_NumFournisseur']; ?>');"><?php echo $donnees['FOU_Nom']; ?></td>
							<td><?php echo $donnees['FOU_Prenom']; ?></a></td>
							<td>Fournisseur</td>
							</form>
						</tr>
						<?php
	}
	mysqli_free_result($reponse);

	$reponse = mysqli_query($db, 'SELECT * FROM Salaries');
	while ($donnees = mysqli_fetch_assoc($reponse))
	{
	?>
						<tr style="font-size: 14;">
							<form method="post" action="detailClient.php" name="detailClient">
								<input type="hidden" name="NumC" value="">
							<td id="detail"><a href="javascript:fsubmit('<?php echo $donnees['SAL_NumSalarie']; ?>');"><?php echo $donnees['SAL_Nom']; ?></td>
							<td><?php echo $donnees['SAL_Prenom']; ?></a></td>
							<td>Fournisseur</td>
							</form>
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