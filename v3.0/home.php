<?php  
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
								<td><?php echo formatUP($donnees['CHA_NumDevis']); ?></td>
								<td><?php echo formatLOW($donnees['CHA_Intitule']); ?></td>
                                <td><?php
                                    if(empty($donnees['Client'])){
                                        $cliN=$donnees['NumClient'];
                                        $reponse2 = mysqli_query($db, "select PER_Nom, PER_Prenom from EmployerClient join Personnes USING (PER_Num) where CLI_NumClient=$cliN");
                                        $donnees2 = mysqli_fetch_assoc($reponse2);
                                        echo formatUP($donnees2['PER_Nom'])." ".formatLOW($donnees2['PER_Prenom']);
                                    }
                                    else{
                                        echo formatUP($donnees['Client']);
                                    }
                                    ?></td>
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
	$reponse = mysqli_query($db, 'SELECT * FROM Salaries cl JOIN Personnes pe ON cl.PER_Num=pe.PER_Num JOIN Type ty ON cl.TYP_Id=ty.TYP_Id ORDER BY SAL_NumSalarie DESC');
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
										<td><?php echo formatLOW($donnees['PER_Adresse']); ?><br><?php echo formatUP($donnees['PER_Ville']); ?> <?php if(!empty($donnees['PER_CodePostal'])) echo $donnees['PER_CodePostal']; ?></td>
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
									Structure
								</td>
                                <td style="text-align: center; width: 150px; cursor: crosshair;">
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
							</tr>
						</thead>
						<tbody>
<?php
	$i = 0;
	$reponse = mysqli_query($db, '(SELECT CLI_NumClient, CLI_Nom, CLI_Adresse, CLI_CodePostal, CLI_Ville, CLI_Portable, CLI_Telephone, CLI_Email, CLI_Fax,
        NULL as PER_Nom, NULL as PER_Prenom, NULL as PER_TelFixe, NULL as PER_TelPort, NULL as PER_FAX, NULL as PER_Email, NULL as PER_Adresse, NULL as PER_CodePostal, NULL as PER_Ville
        FROM Clients WHERE CLI_Nom IS NOT NULL)
        UNION
        (SELECT CLI_NumClient, CLI_Nom, CLI_Adresse, CLI_CodePostal, CLI_Ville, CLI_Portable, CLI_Telephone, CLI_Email, CLI_Fax,
        PER_Nom, PER_Prenom, PER_TelFixe, PER_TelPort, PER_FAX, PER_Email, PER_Adresse, PER_CodePostal, PER_Ville
        FROM Clients JOIN EmployerClient USING (CLI_NumClient) JOIN Personnes USING (PER_Num) WHERE CLI_Nom IS NULL)
        ORDER BY CLI_NumClient DESC');
	while (($donnees = mysqli_fetch_assoc($reponse))&&($i<3))
	{ 
		?>					<form method="get" action="detailClient.php" name="detailClient">
								<input type="hidden" name="NumC" value="">
									<tr onclick="javascript:submitViewDetail('<?php echo $donnees['CLI_NumClient']; ?>', 'detailClient');" style="font-size: 14;">
                                        <td><?php echo formatUP($donnees['CLI_Nom']); ?></td>
                                        <td><?php echo formatLOW($donnees['PER_Nom']); ?></td>
										<td><?php echo formatLOW($donnees['PER_Prenom']); ?></td>
										<td>
                                            <?php
                                            if(empty($donnees['PER_TelFixe'])){
                                                echo $donnees['CLI_Telephone'];
                                            }
                                            else{
                                                echo $donnees['PER_TelFixe'];
                                            }
                                            ?>
                                        </td>
										<td>
                                            <?php
                                            if(empty($donnees['PER_TelPort'])){
                                                echo $donnees['CLI_Portable'];
                                            }
                                            else{
                                                echo $donnees['PER_TelPort'];
                                            }
                                            ?>
                                        </td>
										<td>
                                            <?php
                                            if(empty($donnees['PER_Email'])){
                                                echo $donnees['CLI_Email'];
                                            }
                                            else{
                                                echo $donnees['PER_Email'];
                                            }
                                            ?>
                                        </td>
										<td>
                                            <?php
                                            if(empty($donnees['PER_Adresse'])&&empty($donnees['PER_Ville'])&&empty($donnees['PER_CodePostal'])){
                                                echo formatLOW($donnees['CLI_Adresse'])."<br>".formatUP($donnees['CLI_Ville']);
                                                if(!empty($donnees['CLI_CodePostal']))
                                                    echo " ".$donnees['CLI_CodePostal'];
                                            }
                                            else{
                                                echo formatLOW($donnees['PER_Adresse'])."<br>".formatUP($donnees['PER_Ville']);
                                                if(!empty($donnees['PER_CodePostal']))
                                                    echo " ".$donnees['PER_CodePostal'];
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
							</tr>
						</thead>
						<tbody>
<?php
	$i = 0;
	$reponse = mysqli_query($db, 'SELECT * FROM Fournisseurs ORDER BY FOU_NumFournisseur DESC');
	while (($donnees = mysqli_fetch_assoc($reponse))&&($i<3))
	{
		?>					<form method="get" action="detailFournisseur.php" name="detailFour">
								<input type="hidden" name="NumC" value="">
									<tr onclick="javascript:submitViewDetail('<?php echo $donnees['FOU_NumFournisseur']; ?>', 'detailFour');" style="font-size: 14;">
										<td><?php echo formatUP($donnees['FOU_Nom']); ?></td>
										<td><?php echo $donnees['FOU_Telephone']; ?></td>
										<td><?php echo $donnees['FOU_Portable']; ?></td>
										<td><?php echo $donnees['FOU_Email']; ?></td>
										<td><?php echo formatLOW($donnees['FOU_Adresse']); ?><br><?php echo formatUP($donnees['FOU_Ville']); ?> <?php if(!empty($donnees['FOU_CodePostal'])) echo $donnees['FOU_CodePostal']; ?></td>
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
