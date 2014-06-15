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
				<label>Liste des Chantiers en Cours</label>
			</div><br>
		    <div class="listeClients">
					<table cellpadding="5">
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
							<td style="text-align: center; width: 155px;">
								Debut
							</td>
							<td style="text-align: center; width: 155px;">
								<a>Etat</a>
							</td>
						</tr>
					</thead>
					<tbody>
						<?php

	if($db = MySQLi_connect("localhost","Kepha",'pfudor', 'Revivre', 0, '/media/sds1/home/alx22/private/mysql/socket'))
		echo '';
	else
		echo 'Erreur';

	$sorter = 'CHA_DateDebut';

/*CREATE OR REPLACE VIEW ChantierClient AS SELECT co.CHA_NumDevis, pe.PER_Nom as Client, pe.PER_Prenom as ClientP FROM Commanditer co JOIN Clients cl ON co.CLI_NumClient=cl.CLI_NumClient JOIN Personnes pe ON cl.PER_Num=pe.PER_Num;

CREATE OR REPLACE VIEW ChantierClient AS SELECT co.CHA_NumDevis as CNumDevis, pe.PER_Nom as Client, pe.PER_Prenom as ClientP, pe.PER_TelFixe as ClientTel, pe.PER_Email as ClientEmail, pe.PER_Adresse as ClientAd, pe.PER_Ville as ClientV, pe.PER_CodePostal as ClientCP FROM Commanditer co JOIN Clients cl ON co.CLI_NumClient=cl.CLI_NumClient JOIN Personnes pe ON cl.PER_Num=pe.PER_Num;

CREATE OR REPLACE VIEW ChantierResp AS SELECT en.CHA_NumDevis as RNumDevis, pe.PER_Nom as Resp, pe.PER_Prenom as RespP FROM Encadrer en JOIN Salaries sa ON en.SAL_NumSalarie=sa.SAL_NumSalarie JOIN Personnes pe ON sa.PER_Num=pe.PER_Num;*/

	//$reponse = mysqli_query($db, "SELECT * FROM Chantiers ch JOIN ChantierClient vcl ON ch.CHA_NumDevis=vcl.CHA_NumDevis LEFT JOIN ChantierResp vre ON ch.CHA_NumDevis=vre.CHA_NumDevis ORDER BY ch.CHA_NumDevis DESC");
	
	//SELECT * FROM ChantierEtat WHERE Id = (select max(Id) AS MAXId from ChantierEtat WHERE NumDevis=11)
	
	//SELECT * FROM Chantiers ch JOIN ChantierClient vcl ON ch.CHA_NumDevis=vcl.CNumDevis LEFT JOIN ChantierResp vre ON ch.CHA_NumDevis=vre.RNumDevis LEFT JOIN ChantierEtat cet ON ch.CHA_NumDevis=NumDevis WHERE Id = (select NumDevis, max(Id) From ChantierEtat Group By NumDevis) ORDER BY ch.CHA_NumDevis DESC
	
	//SELECT *, max(Id) FROM Chantiers ch JOIN ChantierClient vcl ON ch.CHA_NumDevis=vcl.CNumDevis LEFT JOIN ChantierResp vre ON ch.CHA_NumDevis=vre.RNumDevis LEFT JOIN ChantierEtat cet ON ch.CHA_NumDevis=NumDevis Group By NumDevis HAVING max(Id)>4 ORDER BY ch.CHA_NumDevis DESC
	
	$reponse = mysqli_query($db, "SELECT * FROM ChantierMax Join TypeEtat ON IdMax=TYE_Id WHERE IdMax<4 ORDER BY CHA_NumDevis DESC");
	while ($donnees = mysqli_fetch_assoc($reponse))
	{
		?>				<form method="post" action="detailChantier.php" name="detailClient">
							<input type="hidden" name="NumC" value="">
							<tr onclick="javascript:fsubmit('<?php echo $donnees['CHA_NumDevis']; ?>');" style="font-size: 14;">
								<td><?php echo $donnees['CHA_Id']; ?></td>
								<td><?php echo ucfirst(strtolower($donnees['CHA_Intitule'])); ?></td>
								<td><?php echo strtoupper($donnees['Client']); ?> <?php echo $donnees['ClientP']; ?></td>
								<td><?php echo strtoupper($donnees['Resp']); ?> <?php echo $donnees['RespP']; ?></td>
								<td><?php echo dater($donnees['CHA_DateDebut']); ?></td>
								<td><?php echo $donnees['TYE_Nom']; ?></td>
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