		<?php  
		include('bandeau.php');
		?>
		<script src="js/sorttable.js"></script>
		<script language="javascript"> 
			function fsubmit(value_p, type) 
			{ 
				document.forms[type].NumC.value = value_p; 
				document.forms[type].submit(); 
			} 
		</script>
		<script>
        $(document).ready(function() {
            $('.tooltip').tooltipster();
        });
    	</script>
		<div id="corps">
			<div id="labelT">     
				<label>Liste des Membres de l'association</label>
			</div><br>
				<div class="listeMembers">
					<table class="sortable" cellpadding="5">
						<thead>
							<tr>
								<td class="premierCol" style="text-align: center; width: 150px;">
									Nom
								</td>
								<td style="text-align: center; width: 150px;">
									Prénom
								</td>
								<td class="sorttable_nosort tooltip" style="text-align: center; width: 150px; cursor: help;" title="Vous ne pouvez pas classer par telephone fixe.">
									Tél Fixe
								</td>
								<td class="sorttable_nosort tooltip" style="text-align: center; width: 150px; cursor: help;" title="Vous ne pouvez pas classer par telephone portable.">
									Tél Portable
								</td>
								<td style="text-align: center; width: 150px;">
									Email
								</td>
								<td style="text-align: center; width: 150px;">
									Adresse
								</td>
								<td style="text-align: center; width: 150px;">
									Type
								</td>
							</tr>
						</thead>
						<tbody>
						<?php

	if($db = MySQLi_connect("localhost","Kepha",'pfudor', 'Revivre', 0, '/media/sds1/home/alx22/private/mysql/socket'))
		echo '';
	else
		echo 'Erreur';

	$reponse = mysqli_query($db, 'SELECT * FROM Salaries cl JOIN Personnes pe ON cl.PER_Num=pe.PER_Num JOIN Type ty ON cl.TYP_Id=ty.TYP_Id ORDER BY PER_Nom');
	while ($donnees = mysqli_fetch_assoc($reponse))
	{
?>					<form method="post" action="detailSal.php" name="detailSal">
							<input type="hidden" name="NumC" value="">
							<tr onclick="javascript:fsubmit('<?php echo $donnees['SAL_NumSalarie']; ?>', 'detailSal');" style="font-size: 14;">
								<td><?php echo $donnees['PER_Nom']; ?></td>
								<td><?php echo $donnees['PER_Prenom']; ?></td>
								<td><?php echo $donnees['PER_TelFixe']; ?></td>
								<td><?php echo $donnees['PER_TelPort']; ?></td>
								<td><a href="mailto:<?php echo $donnees['PER_Email'];?>"><?php echo $donnees['PER_Email']; ?></a></td>
								<td><?php echo $donnees['PER_Adresse']; ?>, <?php echo $donnees['PER_Ville']; ?> <?php echo $donnees['PER_CodePostal']; ?></td>
								<td><?php echo $donnees['TYP_Nom']; ?></td>
							</tr>
					</form>
						<?php
	}

	mysqli_free_result($reponse);
	?>					</tbody>
					</table>
				</div>
		</div>
	<?php  
		include('footer.php');
		?>