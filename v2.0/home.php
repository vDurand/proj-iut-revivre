		<?php  
		include('bandeau.php');
		?>
		<script language="javascript"> 
			function fsubmit(value_p, type) 
			{ 
				document.forms[type].NumC.value = value_p; 
				document.forms[type].submit(); 
			} 
		</script>
		<div id="corps">
			<div id="labelT">     
	            <label>Base de Données de l'Association Revivre</label>
			</div>
			<br/>
			<div>     
				<label>&#8226; Derniers Chantiers Ajoutés :</label>
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
								<a>Fin</a>
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
	$i = 0;
	$reponse = mysqli_query($db, "SELECT * FROM ChantierMax Join TypeEtat ON IdMax=TYE_Id ORDER BY CHA_NumDevis DESC");
	while (($donnees = mysqli_fetch_assoc($reponse))&&($i<3))
	{
		?>				<form method="post" action="detailChantier.php" name="detailChantier">
							<input type="hidden" name="NumC" value="">
							<tr onclick="javascript:fsubmit('<?php echo $donnees['CHA_NumDevis']; ?>', 'detailChantier');" style="font-size: 14;">
								<td><?php echo $donnees['CHA_Id']; ?></td>
								<td><?php echo ucfirst(strtolower($donnees['CHA_Intitule'])); ?></td>
								<td><?php echo strtoupper($donnees['Client']); ?><br/><?php echo $donnees['ClientP']; ?></td>
								<td><?php echo strtoupper($donnees['Resp']); ?><br/><?php echo $donnees['RespP']; ?></td>
								<td><?php echo dater($donnees['CHA_DateDebut']); ?></td>
								<td><?php if ($donnees['IdMax']==4) {
											echo dater($donnees['CHA_DateFinReel']);
										  }
										  else {
										  	echo $donnees['TYE_Nom'];
										  } ?>
								</td>
							</tr>
						</form>
						<?php
	$i++;}
	mysqli_free_result($reponse);
	?>					
					</tbody>
				</table>
			</div>
				<br/>
				<br/>
				<div>     
				<label>&#8226; Derniers Membres de l'association Ajoutés :</label>
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
	$i = 0;
	$reponse = mysqli_query($db, 'SELECT * FROM Salaries cl JOIN Personnes pe ON cl.PER_Num=pe.PER_Num JOIN Type ty ON cl.TYP_Id=ty.TYP_Id ORDER BY PER_Nom');
	while (($donnees = mysqli_fetch_assoc($reponse))&&($i<3))
	{
?>					<form method="post" action="detailSal.php" name="detailSal">
							<input type="hidden" name="NumC" value="">
							<tr onclick="javascript:fsubmit('<?php echo $donnees['SAL_NumSalarie']; ?>', 'detailSal');" style="font-size: 14;">
								<td><?php echo $donnees['PER_Nom']; ?></td>
								<td><?php echo $donnees['PER_Prenom']; ?></td>
								<td><?php echo $donnees['PER_TelFixe']; ?></td>
								<td><?php echo $donnees['PER_TelPort']; ?></td>
								<td><?php echo $donnees['PER_Email']; ?></td>
								<td><?php echo $donnees['PER_Adresse']; ?>, <?php echo $donnees['PER_Ville']; ?> <?php echo $donnees['PER_CodePostal']; ?></td>
								<td><?php echo $donnees['TYP_Nom']; ?></td>
							</tr>
					</form>
						<?php
	$i++;}

	mysqli_free_result($reponse);
	?>					</tbody>
					</table>
				</div>
				<br/>
			<br/>
			<div>     
				<label>&#8226; Derniers Clients Ajoutés :</label>
			</div><br>
				<div class="listeClients">
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
									Structure
								</td>
							</tr>
						</thead>
						<tbody>
						<?php

	if($db = MySQLi_connect("localhost","Kepha",'pfudor', 'Revivre', 0, '/media/sds1/home/alx22/private/mysql/socket'))
		echo '';
	else
		echo 'Erreur';
	$i = 0;
	$reponse = mysqli_query($db, 'SELECT * FROM Clients cl JOIN Personnes pe ON cl.PER_Num=pe.PER_Num ORDER BY CLI_NumClient DESC');
	while (($donnees = mysqli_fetch_assoc($reponse))&&($i<3))
	{ 
?>					<form method="post" action="detailClient.php" name="detailClient">
						<input type="hidden" name="NumC" value="">
							<tr onclick="javascript:fsubmit('<?php echo $donnees['CLI_NumClient']; ?>', 'detailClient');" style="font-size: 14;">
								<td><?php echo $donnees['PER_Nom']; ?></td>
								<td><?php echo $donnees['PER_Prenom']; ?></td>
								<td><?php echo $donnees['PER_TelFixe']; ?></td>
								<td><?php echo $donnees['PER_TelPort']; ?></td>
								<td><?php echo $donnees['PER_Email']; ?></td>
								<td><?php echo $donnees['PER_Adresse']; ?>, <?php echo $donnees['PER_Ville']; ?> <?php echo $donnees['PER_CodePostal']; ?></td>
								<td><?php echo $donnees['CLI_Structure']; ?></td>
							</tr>
					</form>
						<?php
	$i++;}

	mysqli_free_result($reponse);
	?>					</tbody>
					</table>
				</div>
				<br/>
				<br/>
				<div>     
				<label>&#8226; Derniers Fournisseurs Ajoutés :</label>
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
									Structure
								</td>
							</tr>
						</thead>
						<tbody>
						<?php

	if($db = MySQLi_connect("localhost","Kepha",'pfudor', 'Revivre', 0, '/media/sds1/home/alx22/private/mysql/socket'))
		echo '';
	else
		echo 'Erreur';
	$i = 0;
	$reponse = mysqli_query($db, 'SELECT * FROM Fournisseurs cl JOIN Personnes pe ON cl.PER_Num=pe.PER_Num ORDER BY FOU_NumFournisseur DESC');
	while (($donnees = mysqli_fetch_assoc($reponse))&&($i<3))
	{
?>					<form method="post" action="detailFournisseur.php" name="detailFour">
						<input type="hidden" name="NumC" value="">
							<tr onclick="javascript:fsubmit('<?php echo $donnees['FOU_NumFournisseur']; ?>', 'detailFour');" style="font-size: 14;">
								<td><?php echo $donnees['PER_Nom']; ?></td>
								<td><?php echo $donnees['PER_Prenom']; ?></td>
								<td><?php echo $donnees['PER_TelFixe']; ?></td>
								<td><?php echo $donnees['PER_TelPort']; ?></td>
								<td><?php echo $donnees['PER_Email']; ?></td>
								<td><?php echo $donnees['PER_Adresse']; ?>, <?php echo $donnees['PER_Ville']; ?> <?php echo $donnees['PER_CodePostal']; ?></td>
								<td><?php echo $donnees['FOU_Structure']; ?></td>
							</tr>
					</form>
						<?php
	$i++;}

	mysqli_free_result($reponse);
	?>					</tbody>
					</table>
				</div>
				<br/>
		</div>
		<?php  
		include('footer.php');
		?>
