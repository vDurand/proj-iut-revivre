﻿<?php  
	include('bandeau.php');
?>
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
							<td class="firstCol" style="text-align: center; width: 40px; cursor: crosshair;">
								<a>#</a>
							</td>
							<td style="text-align: center; width: 231px; cursor: crosshair;">
								<a>Chantier</a>
							</td>
							<td style="text-align: center; width: 155px; cursor: crosshair;">
								<a>Client</a>
							</td>
							<td style="text-align: center; width: 155px; cursor: crosshair;">
								<a>Responsable</a>
							</td>
							<td style="text-align: center; width: 155px; cursor: crosshair;">
								Debut
							</td>
							<td style="text-align: center; width: 155px; cursor: crosshair;">
								<a>Fin</a>
							</td>
						</tr>
					</thead>
					<tbody>
<?php
	$sorter = 'CHA_DateDebut';
	$i = 0;
	$reponse = mysqli_query($db, "SELECT * FROM ChantierMax Join TypeEtat ON IdMax=TYE_Id ORDER BY CHA_NumDevis DESC");
	while (($donnees = mysqli_fetch_assoc($reponse))&&($i<3))
	{
?>
						<form method="get" action="detailChantier.php" name="detailChantier">
							<input type="hidden" name="NumC" value="">
							<tr onclick="javascript:submitViewDetail('<?php echo $donnees['CHA_NumDevis']; ?>', 'detailChantier');" style="font-size: 14;">
								<td><?php echo formatUP($donnees['CHA_Id']); ?></td>
								<td><?php echo formatLOW($donnees['CHA_Intitule']); ?></td>
								<td><?php echo formatUP($donnees['Client']); ?><br/><?php echo formatLOW($donnees['ClientP']); ?></td>
								<td><?php echo formatUP($donnees['Resp']); ?><br/><?php echo formatLOW($donnees['RespP']); ?></td>
								<td><?php echo dater($donnees['CHA_DateDebut']); ?></td>
								<td>
<?php
		if ($donnees['IdMax']==4) {
			echo dater($donnees['CHA_DateFinReel']);
		}
		else {
			echo $donnees['TYE_Nom'];
		}
?>
								</td>
							</tr>
						</form>
<?php
		$i++;
	}
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
					<table cellpadding="5">
						<thead>
							<tr>
								<td class="premierCol" style="text-align: center; width: 150px; cursor: crosshair;">
									Nom
								</td>
								<td style="text-align: center; width: 150px; cursor: crosshair;">
									Prénom
								</td>
								<td style="text-align: center; width: 150px; cursor: crosshair;">
									Tél Fixe
								</td>
								<td style="text-align: center; width: 150px; cursor: crosshair;">
									Tél Portable
								</td>
								<td style="text-align: center; width: 150px; cursor: crosshair;">
									Email
								</td>
								<td style="text-align: center; width: 150px; cursor: crosshair;">
									Adresse
								</td>
								<td style="text-align: center; width: 150px; cursor: crosshair;">
									Type
								</td>
							</tr>
						</thead>
						<tbody>
<?php
	$i = 0;
	$reponse = mysqli_query($db, 'SELECT * FROM Salaries cl JOIN Personnes pe ON cl.PER_Num=pe.PER_Num JOIN Type ty ON cl.TYP_Id=ty.TYP_Id ORDER BY PER_Nom');
	while (($donnees = mysqli_fetch_assoc($reponse))&&($i<3))
	{
		?>					<form method="get" action="detailSal.php" name="detailSal">
									<input type="hidden" name="NumC" value="">
									<tr onclick="javascript:submitViewDetail('<?php echo $donnees['SAL_NumSalarie']; ?>', 'detailSal');" style="font-size: 14;">
										<td><?php echo formatUP($donnees['PER_Nom']); ?></td>
										<td><?php echo formatLOW($donnees['PER_Prenom']); ?></td>
										<td><?php echo $donnees['PER_TelFixe']; ?></td>
										<td><?php echo $donnees['PER_TelPort']; ?></td>
										<td><?php echo $donnees['PER_Email']; ?></td>
										<td><?php echo formatLOW($donnees['PER_Adresse']); ?> <?php echo formatUP($donnees['PER_Ville']); ?> <?php if(!empty($donnees['PER_CodePostal'])) echo $donnees['PER_CodePostal']; ?></td>
										<td><?php echo formatLOW($donnees['TYP_Nom']); ?></td>
									</tr>
							</form>
<?php
		$i++;
	}
	mysqli_free_result($reponse);
?>
					</tbody>
					</table>
				</div>
				<br/>
			<br/>
			<div>     
				<label>&#8226; Derniers Clients Ajoutés :</label>
			</div><br>
				<div class="listeClients">
					<table cellpadding="5">
						<thead>
							<tr>
								<td class="premierCol" style="text-align: center; width: 150px; cursor: crosshair;">
									Nom
								</td>
								<td style="text-align: center; width: 150px; cursor: crosshair;">
									Prénom
								</td>
								<td style="text-align: center; width: 150px; cursor: crosshair;">
									Tél Fixe
								</td>
								<td style="text-align: center; width: 150px; cursor: crosshair;">
									Tél Portable
								</td>
								<td style="text-align: center; width: 150px; cursor: crosshair;">
									Email
								</td>
								<td style="text-align: center; width: 150px; cursor: crosshair;">
									Adresse
								</td>
								<td style="text-align: center; width: 150px; cursor: crosshair;">
									Structure
								</td>
							</tr>
						</thead>
						<tbody>
<?php
	$i = 0;
	$reponse = mysqli_query($db, 'SELECT * FROM Clients cl JOIN Personnes pe ON cl.PER_Num=pe.PER_Num ORDER BY CLI_NumClient DESC');
	while (($donnees = mysqli_fetch_assoc($reponse))&&($i<3))
	{ 
		?>					<form method="get" action="detailClient.php" name="detailClient">
								<input type="hidden" name="NumC" value="">
									<tr onclick="javascript:submitViewDetail('<?php echo $donnees['CLI_NumClient']; ?>', 'detailClient');" style="font-size: 14;">
										<td><?php echo formatUP($donnees['PER_Nom']); ?></td>
										<td><?php echo formatLOW($donnees['PER_Prenom']); ?></td>
										<td><?php echo $donnees['PER_TelFixe']; ?></td>
										<td><?php echo $donnees['PER_TelPort']; ?></td>
										<td><?php echo $donnees['PER_Email']; ?></td>
										<td><?php echo formatLOW($donnees['PER_Adresse']); ?> <?php echo formatUP($donnees['PER_Ville']); ?> <?php if(!empty($donnees['PER_CodePostal'])) echo $donnees['PER_CodePostal']; ?></td>
										<td><?php echo formatLOW($donnees['CLI_Structure']); ?></td>
									</tr>
							</form>
<?php
		$i++;
	}
	mysqli_free_result($reponse);
?>
					</tbody>
					</table>
				</div>
				<br/>
				<br/>
				<div>     
				<label>&#8226; Derniers Fournisseurs Ajoutés :</label>
			</div><br>
				<div class="listeMembers">
					<table cellpadding="5">
						<thead>
							<tr>
								<td class="premierCol" style="text-align: center; width: 150px; cursor: crosshair;">
									Nom
								</td>
								<td style="text-align: center; width: 150px; cursor: crosshair;">
									Prénom
								</td>
								<td style="text-align: center; width: 150px; cursor: crosshair;">
									Tél Fixe
								</td>
								<td style="text-align: center; width: 150px; cursor: crosshair;">
									Tél Portable
								</td>
								<td style="text-align: center; width: 150px; cursor: crosshair;">
									Email
								</td>
								<td style="text-align: center; width: 150px; cursor: crosshair;">
									Adresse
								</td>
								<td style="text-align: center; width: 150px; cursor: crosshair;">
									Structure
								</td>
							</tr>
						</thead>
						<tbody>
<?php
	$i = 0;
	$reponse = mysqli_query($db, 'SELECT * FROM Fournisseurs cl JOIN Personnes pe ON cl.PER_Num=pe.PER_Num ORDER BY FOU_NumFournisseur DESC');
	while (($donnees = mysqli_fetch_assoc($reponse))&&($i<3))
	{
		?>					<form method="get" action="detailFournisseur.php" name="detailFour">
								<input type="hidden" name="NumC" value="">
									<tr onclick="javascript:submitViewDetail('<?php echo $donnees['FOU_NumFournisseur']; ?>', 'detailFour');" style="font-size: 14;">
										<td><?php echo formatUP($donnees['PER_Nom']); ?></td>
										<td><?php echo formatLOW($donnees['PER_Prenom']); ?></td>
										<td><?php echo $donnees['PER_TelFixe']; ?></td>
										<td><?php echo $donnees['PER_TelPort']; ?></td>
										<td><?php echo $donnees['PER_Email']; ?></td>
										<td><?php echo formatLOW($donnees['PER_Adresse']); ?> <?php echo formatUP($donnees['PER_Ville']); ?> <?php if(!empty($donnees['PER_CodePostal'])) echo $donnees['PER_CodePostal']; ?></td>
										<td><?php echo formatLOW($donnees['FOU_Structure']); ?></td>
									</tr>
							</form>
<?php
		$i++;
	}
	mysqli_free_result($reponse);
?>
					</tbody>
					</table>
				</div>
				<br/>
		</div>
<?php  
	include('footer.php');
?>
