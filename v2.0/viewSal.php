<?php
$pageTitle = "Contacts Revivres";
	include('bandeau.php');
?>
		<script src="js/sorttable.js"></script>
		<script>
        $(document).ready(function() {
            $('.tooltip').tooltipster();
        });
    	</script>
		<div id="corps">
<?php
	$type=$_POST["TypeM"];
	if($type==4)
		$pronom="du";
	else
		$pronom="des";

	$reponse1 = mysqli_query($db, "SELECT TYP_Nom FROM Type WHERE TYP_Id=$type");
  	$donnees1 = mysqli_fetch_assoc($reponse1);
?>
			<div id="labelT">     
				<label>Liste <?php echo $pronom; ?> <?php echo $donnees1['TYP_Nom']; ?>s</label>
			</div><br>
<?php
	mysqli_free_result($reponse1);
?>	
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
									Ville
								</td>
							</tr>
						</thead>
						<tbody>
<?php
	$reponse = mysqli_query($db, "SELECT * FROM Salaries cl JOIN Personnes pe ON cl.PER_Num=pe.PER_Num WHERE TYP_Id=$type ORDER BY PER_Nom");
	while ($donnees = mysqli_fetch_assoc($reponse))
	{
?>
							<form method="get" action="detailSal.php" name="detailSal">
									<input type="hidden" name="NumC" value="">
									<tr onclick="javascript:submitViewDetail('<?php echo $donnees['SAL_NumSalarie']; ?>', 'detailSal');" style="font-size: 14;">
										<td><?php echo formatUP($donnees['PER_Nom']); ?></td>
										<td><?php echo formatLOW($donnees['PER_Prenom']); ?></td>
										<td><?php echo $donnees['PER_TelFixe']; ?></td>
										<td><?php echo $donnees['PER_TelPort']; ?></td>
										<td><?php echo $donnees['PER_Email']; ?></td>
										<td><?php echo formatLOW($donnees['PER_Adresse']); ?></td>
										<td>
										<?php
											if(!empty($donnees['PER_Ville'])){
												echo formatUP($donnees['PER_Ville'])." "; 
											}
											if(!empty($donnees['PER_CodePostal'])){
												echo $donnees['PER_CodePostal']; 
											}
											?>
										  </td>
									</tr>
							</form>
<?php
	}
	mysqli_free_result($reponse);
?>
						</tbody>
					</table>
				</div>
		</div>
<?php  
	include('footer.php');
?>