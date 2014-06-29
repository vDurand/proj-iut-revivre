<?php  
	include('bandeau.php');
?>
		<script src="js/sorttable.js"></script>
		<script>
        $(document).ready(function() {
            $('.tooltip').tooltipster();
        });
    	</script>
		<div id="corps">
			<div id="labelT">     
				<label>Liste des Chantiers Archivés</label>
			</div><br>
				<div class="listeMembers">
					<table class="sortable" cellpadding="5">
						<thead>
						<tr>
							<td class="firstCol" style="text-align: center; width: 40px;">
								<a>#</a>
							</td>
							<td style="text-align: center; width: 231px;">
								<a>Chantier</a>
							</td>
							<td style="text-align: center; width: 155px;">
								<a>Client</a>
							</td>
							<td style="text-align: center; width: 155px;">
								<a>Responsable</a>
							</td>
							<td style="text-align: center; width: 155px; cursor: help;" class="sorttable_nosort tooltip" title="Classement par défaut.">
								Debut
							</td>
							<td style="text-align: center; width: 155px; cursor: help;" class="sorttable_nosort tooltip" title="Vous ne pouvez pas classer par date de fin.">
								<a>Fin</a>
							</td>
						</tr>
					</thead>
					<tbody>
<?php
	$sorter = 'CHA_DateDebut';

	$reponse = mysqli_query($db, "SELECT *, max(Id) FROM Chantiers ch JOIN ChantierClient vcl ON ch.CHA_NumDevis=vcl.CNumDevis LEFT JOIN ChantierResp vre ON ch.CHA_NumDevis=vre.RNumDevis LEFT JOIN ChantierEtat cet ON ch.CHA_NumDevis=NumDevis Group By NumDevis HAVING max(Id)>3 ORDER BY ch.CHA_DateDebut DESC");
	while ($donnees = mysqli_fetch_assoc($reponse))
	{
?>
						<form method="post" action="detailChantier.php" name="detailClient">
							<input type="hidden" name="NumC" value="">
							<tr onclick="javascript:submitViewDetail('<?php echo $donnees['CHA_NumDevis']; ?>', 'detailClient');" style="font-size: 14;">
								<td><?php echo $donnees['CHA_Id']; ?></td>
								<td><?php echo ucfirst(strtolower($donnees['CHA_Intitule'])); ?></td>
								<td><?php echo strtoupper($donnees['Client']); ?> <?php echo $donnees['ClientP']; ?></td>
								<td><?php echo strtoupper($donnees['Resp']); ?> <?php echo $donnees['RespP']; ?></td>
								<td><?php echo dater($donnees['CHA_DateDebut']); ?></td>
								<td>
<?php 
		if ($donnees['max(Id)']==4) {
			echo dater($donnees['CHA_DateFinReel']);
		}
		if ($donnees['max(Id)']==5) {
		  	echo Refuse;
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