		<?php  
		include('bandeau.php');
		?>
		<script src="js/sorttable.js"></script>
		<script language="javascript"> 
			function fsubmit(value_p) 
			{ 
				document.forms['detailClient'].NumC.value = value_p; 
				document.forms['detailClient'].submit(); 
			} 
		</script>
		<script>
        $(document).ready(function() {
            $('.tooltip').tooltipster();
        });
    	</script>
		<div id="corps">
			<div id="labelT">     
				<label>Liste des Contacts</label>
			</div><br>
					<table class="tableContact" cellpadding="5">
						<thead>
						<tr>
							<td class="firstCol" style="text-align: center; width: 155px;">
								<a>Nom</a>
							</td>
							<td style="text-align: center; width: 155px;">
								<a>Prenom</a>
							</td>
							<td style="text-align: center; width: 155px;">
								<a>Adresse</a>
							</td>
							<td style="text-align: center; width: 155px;">
								<a>Ville</a>
							</td>
							<td class="sorttable_nosort tooltip" style="text-align: center; width: 155px; cursor: help;" title="Vous ne pouvez pas classer par numero de portable.">
								Portable
							</td>
							<td style="text-align: center; width: 155px;">
								<a>Type</a>
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
		?>				<form method="post" action="detailClient.php" name="detailClient">
							<input type="hidden" name="NumC" value="">
							<tr onclick="javascript:fsubmit('<?php echo $donnees['CLI_NumClient']; ?>');" style="font-size: 14;">
								<td><?php echo $donnees['PER_Nom']; ?></td>
								<td><?php echo $donnees['PER_Prenom']; ?></td>
								<td><?php echo $donnees['PER_Adresse']; ?></td>
								<td><?php echo $donnees['PER_Ville']; ?></td>
								<td><?php echo $donnees['PER_TelPort']; ?></td>
								<td>Client</td>
							</tr>
						</form>
						<?php
	}
	mysqli_free_result($reponse);

	$reponse = mysqli_query($db, 'SELECT * FROM Encadrant cl JOIN Personnes pe ON cl.PER_Num=pe.PER_Num ORDER BY PER_Nom');
	while ($donnees = mysqli_fetch_assoc($reponse))
	{
	?>					<form method="post" action="detailEncadrant.php" name="detailEnc">
							<input type="hidden" name="NumC" value="">
							<tr onclick="javascript:fsubmit('<?php echo $donnees['ENC_NumEncadrant']; ?>');" style="font-size: 14;">
								<td><?php echo $donnees['PER_Nom']; ?></td>
								<td><?php echo $donnees['PER_Prenom']; ?></td>
								<td><?php echo $donnees['PER_Adresse']; ?></td>
								<td><?php echo $donnees['PER_Ville']; ?></td>
								<td><?php echo $donnees['PER_TelPort']; ?></td>
								<td>Encadrant</td>
							</tr>
						</form>
						<?php
	}
	mysqli_free_result($reponse);

	$reponse = mysqli_query($db, 'SELECT * FROM Fournisseurs cl JOIN Personnes pe ON cl.PER_Num=pe.PER_Num ORDER BY PER_Nom');
	while ($donnees = mysqli_fetch_assoc($reponse))
	{
	?>					<form method="post" action="detailFournisseur.php" name="detailFour">
							<input type="hidden" name="NumC" value="">
							<tr onclick="javascript:fsubmit('<?php echo $donnees['FOU_NumFournisseur']; ?>');" style="font-size: 14;">
								<td><?php echo $donnees['PER_Nom']; ?></td>
								<td><?php echo $donnees['PER_Prenom']; ?></td>
								<td><?php echo $donnees['PER_Adresse']; ?></td>
								<td><?php echo $donnees['PER_Ville']; ?></td>
								<td><?php echo $donnees['PER_TelPort']; ?></td>
								<td>Fournisseur</td>
							</tr>
						</form>	
						<?php
	}
	mysqli_free_result($reponse);

	$reponse = mysqli_query($db, 'SELECT * FROM Salaries cl JOIN Personnes pe ON cl.PER_Num=pe.PER_Num ORDER BY PER_Nom');
	while ($donnees = mysqli_fetch_assoc($reponse))
	{
	?>					<form method="post" action="detailSalarie.php" name="detailSal">
							<input type="hidden" name="NumC" value="">
							<tr onclick="javascript:fsubmit('<?php echo $donnees['SAL_NumSalarie']; ?>');" style="font-size: 14;">
								<td><?php echo $donnees['PER_Nom']; ?></td>
								<td><?php echo $donnees['PER_Prenom']; ?></td>
								<td><?php echo $donnees['PER_Adresse']; ?></td>
								<td><?php echo $donnees['PER_Ville']; ?></td>
								<td><?php echo $donnees['PER_TelPort']; ?></td>
								<td><?php echo $donnees['SAL_Type']; ?></td>
							</tr>
						</form>
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