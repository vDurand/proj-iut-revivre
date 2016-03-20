<?php
$pwd="";
	include('bandeau.php');
?>
		<div id="corps">
			<div id="labelT">     
	            <label>Intranet de l'Association Revivre</label>
			</div>
			<div id="news-update">
				<span class="news-title">21/03/2016 - Le site a été mis à jour, voici l'essentiel du détail :</span>
				<ul>
					<li>Nouveau menu déroulant plus joli, mieux conçu, plus pratique</li>
					<li>Refonte totale du répertoire, divisé en deux catégories : « Salariés » et « Contacts »</li>
					<li>On peut naviguer de gauche à droite via la tabulation entre les champs</li>
					<li>Un système d'erreur lors de la saisie permet d'éviter de remplir à nouveau les formulaires</li>
					<li>Ajout du système de cursus dans la fiche détail des salariés (ACI, AVA, CAP Vert)</li>
					<li>Intégration de l'ajout rapide d'un référent</li>
					<li>Beaucoup d'autres ajouts et corrections</li>
				</ul>
			</div>
			<br/>
            <div>
                <label>&#8226; Derniers chantiers ajoutés :</label>
				<span style="float: right;">
					<button class="printButton">
                        <a style="text-decoration:none;color:#777777;" href="exportExcel/exportExcelChantiers.php">Exporter</a>
                    </button>
				</span>
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
	$sorter = 'CHA_DateDebut';
	$i = 0;
	$reponse = mysqli_query($db, "SELECT * FROM ChantierMax Join TypeEtat ON IdMax=TYE_Id ORDER BY CHA_NumDevis DESC");
	while (($donnees = mysqli_fetch_assoc($reponse))&&($i<3))
	{
?>
						<form method="get" action="chantier/detailChantier.php" name="detailChantier">
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
                    <label>&#8226; Derniers salariés de l'association ajoutés :</label>
                    <span style="float: right;">
                        <button class="printButton">
                            <a style="text-decoration:none;color:#777777;" href="exportExcel/exportExcelSalaries.php">Exporter</a>
                        </button>
                    </span>
                </div>
                <br>
				<div class="listeMembers">
					<table cellpadding="5">
						<thead>
							<tr>
								<td class="premierCol" style="text-align: center; width: 150px;">
									Nom
								</td>
								<td style="text-align: center; width: 150px;">
									Prénom
								</td>
								<td style="text-align: center; width: 150px;">
									Tél Fixe
								</td>
								<td style="text-align: center; width: 150px;">
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
	$i = 0;
	$reponse = mysqli_query($db, 'SELECT * FROM Salaries cl JOIN Personnes pe ON cl.PER_Num=pe.PER_Num JOIN Type ty ON cl.TYP_Id=ty.TYP_Id ORDER BY SAL_NumSalarie DESC');
	while (($donnees = mysqli_fetch_assoc($reponse))&&($i<3))
	{
		?>
							<tr onclick="$.redirect('repertoire/salaries/showSalarie.php', {'SalNum':'<?php echo $donnees["SAL_NumSalarie"];?>'}, 'get');" style="font-size: 14;">
								<td><?php echo formatUP($donnees['PER_Nom']); ?></td>
								<td><?php echo formatLOW($donnees['PER_Prenom']); ?></td>
								<td><?php echo !empty($donnees['PER_TelFixe']) ? $donnees['PER_TelFixe'] : '<i class="no-data">Aucun numéro</i>';?></td>
								<td><?php echo !empty($donnees['PER_TelPort']) ? $donnees['PER_TelPort'] : '<i class="no-data">Aucun numéro</i>';?></td>
								<td><?php echo !empty($donnees['PER_Email']) ? $donnees['PER_Email'] : '<i class="no-data">Aucun email</i>';?></td>
								<?php
									if(!empty($donnees['PER_Adresse']) && !empty($donnees['PER_Ville']) && !empty($donnees['PER_CodePostal'])){
								?>
									<td><?php echo formatLOW($donnees['PER_Adresse']); ?><br><?php echo formatUP($donnees['PER_Ville']); ?> <?php echo $donnees['PER_CodePostal']; ?></td>
								<?php	
									}
									else{
								?>
									<td><i class="no-data">Aucune adresse</i></td>
								<?php
									}
								?>
								<td><?php echo formatLOW($donnees['TYP_Nom']); ?></td>
							</tr>
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
				<label>&#8226; Derniers clients ajoutés :</label>
			</div><br>
				<div class="listeClients">
					<table cellpadding="5">
						<thead>
							<tr>
								<td class="premierCol" style="text-align: center; width: 150px;">
									Client
								</td>
								<td style="text-align: center; width: 150px;">
									Tél Fixe
								</td>
								<td style="text-align: center; width: 150px;">
									Tél Portable
								</td>
								<td style="text-align: center; width: 150px;">
									Email
								</td>
								<td style="text-align: center; width: 150px;">
									Adresse
								</td>
							</tr>
						</thead>
						<tbody>
<?php
	$i = 0;
	$reponse = mysqli_query($db, "(SELECT *, 'structure' AS TC FROM clients WHERE CLI_NOM IS NOT NULL AND (CLI_Prenom IS NULL OR CLI_Prenom = ''))
						        UNION
						        (SELECT *, 'particulier' AS TC FROM Clients WHERE CLI_NOM IS NOT NULL AND (CLI_Prenom IS NOT NULL AND CLI_Prenom <> ''))
						        ORDER BY CLI_NumClient DESC");
	while (($donnees = mysqli_fetch_assoc($reponse))&&($i<3))
	{ 
		?>
							<tr onclick="$.redirect('repertoire/contacts/showContact.php', {'ConNum':'<?php echo $donnees["CLI_NumClient"];?>', 'TC_ID':2, 'TypeClient':'<?php echo $donnees["TC"];?>'}, 'post');" style="font-size: 14;">
	                            <td><?php echo formatUP($donnees['CLI_Nom'])." ".FirstToUpper($donnees['CLI_Prenom']); ?></td>
								<td><?php echo !empty($donnees['CLI_Telephone']) ? $donnees['CLI_Telephone'] : '<i class="no-data">Aucun numéro</i>';?></td>
								<td><?php echo !empty($donnees['CLI_Portable']) ? $donnees['CLI_Portable'] : '<i class="no-data">Aucun numéro</i>';?></td>
								<td><?php echo !empty($donnees['CLI_Email']) ? $donnees['CLI_Email'] : '<i class="no-data">Aucun email</i>';?></td>
								<td><?php echo formatLOW($donnees['CLI_Adresse'])."<br>".formatUP($donnees['CLI_Ville']).(!empty($donnees['CLI_CodePostal']) ? " ".$donnees['CLI_CodePostal'] : "");?></td>
							</tr>
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
				<label>&#8226; Derniers fournisseurs ajoutés :</label>
			</div><br>
				<div class="listeMembers">
					<table cellpadding="5">
						<thead>
							<tr>
								<td class="premierCol" style="text-align: center; width: 150px;">
									Nom
								</td>
								<td style="text-align: center; width: 150px;">
									Tél Fixe
								</td>
								<td style="text-align: center; width: 150px;">
									Tél Portable
								</td>
								<td style="text-align: center; width: 150px;">
									Email
								</td>
								<td style="text-align: center; width: 150px;">
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
		?>
							<tr onclick="$.redirect('repertoire/contacts/showContact.php', {'ConNum':'<?php echo $donnees["FOU_NumFournisseur"];?>', 'TC_ID': 1}, 'post');" style="font-size: 14;">
								<td><?php echo formatUP($donnees['FOU_Nom']); ?></td>
								<td><?php echo !empty($donnees['FOU_Telephone']) ? $donnees['FOU_Telephone'] : '<i class="no-data">Aucun numéro</i>';?></td>
								<td><?php echo !empty($donnees['FOU_Portable']) ? $donnees['FOU_Portable'] : '<i class="no-data">Aucun numéro</i>';?></td>
								<td><?php echo !empty($donnees['FOU_Email']) ? $donnees['FOU_Email'] : '<i class="no-data">Aucun email</i>';?></td>
								<td><?php echo formatLOW($donnees['FOU_Adresse']); ?><br><?php echo formatUP($donnees['FOU_Ville']); ?> <?php if(!empty($donnees['FOU_CodePostal'])) echo $donnees['FOU_CodePostal']; ?></td>
							</tr>
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
