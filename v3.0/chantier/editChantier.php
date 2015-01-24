<?php
$pageTitle = "Modifier Chantier";
$pwd='../';
    include('../bandeau.php');
?>
    <div id="corps">
<?php
  $num=$_POST["NumC"];
  $reponse = mysqli_query($db, "SELECT * FROM Chantiers ch JOIN ChantierClient vcl ON ch.CHA_NumDevis=vcl.CNumDevis LEFT JOIN ChantierResp vre ON ch.CHA_NumDevis=vre.RNumDevis LEFT JOIN ChantierEtat cet ON ch.CHA_NumDevis=NumDevis WHERE ch.CHA_NumDevis='$num' limit 1");
  $donnees = mysqli_fetch_assoc($reponse);
?>
			<div id="labelT">     
				<label>Modifier Chantier</label>
			</div>
			<br>
			<form method="post" action="chantierpre.php" name="Chantier" formtype="1" colvalue="2">
                <input type="hidden" name="NumC" value="<?php echo $donnees['CHA_NumDevis']; ?>">
				<div id="labelCat">
					<table align="center">
						<tr>
							<td style="text-align: left; width: 150px;">
								<label>Client</label>
							</td>
							<td>
								<div class="selectType2">
		          					<select name="Client">									
                                        <optgroup label="Client actuel">
										<?php
											$reponse = mysqli_query($db, "select * from ChantierClient where CNumDevis ='$num' limit 1");
											$donnees = mysqli_fetch_assoc($reponse);
                                            if(!empty($donnees['Client'])){
                                        ?>
                                                <option value="<?php echo $donnees['NumClient']; ?>"><?php echo formatUP($donnees['Client']); ?></option>
                                        <?php
                                            }
                                            else{
                                                $numclient = $donnees['NumClient'];
                                                $reponsee = mysqli_query($db, "SELECT * FROM Clients cl JOIN EmployerClient em ON cl.CLI_NumClient=em.CLI_NumClient JOIN Personnes pe ON em.PER_Num=pe.PER_Num WHERE CLI_Nom IS NULL AND cl.CLI_NumClient=$numclient ORDER BY PER_Nom");
                                                $donneess = mysqli_fetch_assoc($reponsee);
                                        ?>
                                                <option value="<?php echo $donneess['NumClient']; ?>"><?php echo formatUP($donneess['PER_Nom'])." ".formatLow($donneess['PER_Prenom']); ?></option>
                                        <?php
                                            }
										?>
										</optgroup>
										
                                        <optgroup label="Particuliers">
<?php
	$reponse = mysqli_query($db, "SELECT * FROM Clients cl JOIN EmployerClient em ON cl.CLI_NumClient=em.CLI_NumClient JOIN Personnes pe ON em.PER_Num=pe.PER_Num WHERE CLI_Nom IS NULL ORDER BY PER_Nom");
	while ($donnees = mysqli_fetch_assoc($reponse))
	{
?>
				        				<option value="<?php echo $donnees['CLI_NumClient']; ?>"><?php
                                            if(!empty($donnees['PER_Nom'])){
                                                echo formatUP($donnees['PER_Nom']);
                                                if(!empty($donnees['PER_Prenom'])){
                                                    echo " ".formatLOW($donnees['PER_Prenom']);
                                                }
                                            }
                                            ?>
                                        </option>
<?php
	}
	mysqli_free_result($reponse);
?>									    </optgroup>
                                        <optgroup label="Structures">
                                            <?php
                                            $reponse = mysqli_query($db, "SELECT * FROM Clients cl WHERE CLI_Nom IS NOT NULL ORDER BY CLI_Nom");
                                            while ($donnees = mysqli_fetch_assoc($reponse))
                                            {
                                                ?>
                                                <option value="<?php echo $donnees['CLI_NumClient']; ?>"><?php
                                                    echo formatUP($donnees['CLI_Nom']);
                                                    ?></option>
                                                <?php
                                            }
                                            mysqli_free_result($reponse);
                                            ?>
                                        </optgroup>
				    				</select>
				    			</div>
				    		</td>
						</tr>
					</table>
				</div>
				<br/>
<?php
  $reponse = mysqli_query($db, "SELECT * FROM Chantiers ch JOIN ChantierClient vcl ON ch.CHA_NumDevis=vcl.CNumDevis LEFT JOIN ChantierResp vre ON ch.CHA_NumDevis=vre.RNumDevis LEFT JOIN ChantierEtat cet ON ch.CHA_NumDevis=NumDevis WHERE ch.CHA_NumDevis='$num' limit 1");
  $donnees = mysqli_fetch_assoc($reponse);
?>
				<div>
					<table align="left">
						<td>
							<table id="leftT" colcount="0" cellpadding="10">
								<tr id="Contact-Nom">
									<td style="text-align: left; width: 150px; white-space: normal;">
										<label>Nom du Chantier :</label>
									</td>
									<td>
										<input id="Nom" required maxlength="255" name="Nom" type="text" class="inputC" autofocus="autofocus" value="<?php echo formatLOW($donnees['CHA_Intitule']); ?>"> 
									</td>
								</tr>
								<tr id="Contact-Prenom">
									<td style="text-align: left; width: 150px; white-space: normal;">
										<label>Date de Début :</label>
									</td>
									<td>
										<input id="Debut" required maxlength="255" name="Debut" type="date" class="inputC" value="<?php echo formatLOW($donnees['CHA_DateDebut']); ?>"> 
									</td>

								</tr>
								<tr id="Contact-Echeance">
									<td style="text-align: left; width: 150px; white-space: normal;">
										<label>Echéance :</label>
									</td>
									<td>
										<input id="Fin_Max" maxlength="255" name="Fin_Max" type="date" class="inputC" value="<?php echo ($donnees['CHA_Echeance']); ?>"> 
									</td>
								</tr>
                                <tr id="Chantier_Ad">
                                    <td style="text-align: left; width: 150px; white-space: normal;">
                                        <label>Adresse Chantier :</label>
                                    </td>
                                    <td>
                                        <input id="Add" required maxlength="255" name="Add" type="text" class="inputC" value="<?php echo ($donnees['CHA_Adresse']); ?>">
                                    </td>
                                </tr>
                                <tr id="Chantier_Tva">
                                    <td style="text-align: left; width: 150px; white-space: normal;">
                                        <label>TVA :</label>
                                    </td>
                                    <td>
                                        <input id="tva" required name="tva" type="number" step="0.01" class="inputC" value="<?php echo ($donnees['CHA_TVA']); ?>">
                                    </td>
                                </tr>
							</table>
						</td>
						<td>
							<table id="rightT" colcount="1" cellpadding="10">
								<tr id="Contact-Portable">
									<td style="text-align: left; width: 150px; white-space: normal;">
										<label>Montant :</label>
									</td>
									<td>
										<input id="Montant_Prev" maxlength="255" name="Montant_Prev" type="text" class="inputC" placeholder="&euro;" value="<?php echo $donnees['CHA_MontantPrev']; ?>"> 
									</td>
								</tr>
								<tr id="Contact-Fax">
									<td style="text-align: left; width: 150px; white-space: normal;">
										<label>Achats Prévus :</label>
									</td>
									<td>
										<input id="Achats_Prev" maxlength="255" name="Achats_Prev" type="text" class="inputC" placeholder="&euro;" value="<?php echo $donnees['CHA_AchatsPrev']; ?>"> 
									</td>
								</tr>
								<tr id="Contact-Fonction">
									<td style="text-align: left; width: 150px; white-space: normal;">
										<label>Heures Prévues :</label>
									</td>
									<td>
										<input id="Heures_Prev" maxlength="255" name="Heures_Prev" type="text" class="inputC" value="<?php echo $donnees['CHA_HeuresPrev']; ?>">
									</td>
								</tr>
								<tr id="Chantier_Resp">
									<td style="text-align: left; width: 150px; white-space: normal;">
										<label>Responsable :</label>
									</td>
									<td>
										<div class="selectType">
										            <select name="Resp">
														<optgroup label="Responsable actuel">
														<?php
															$reponse = mysqli_query($db, "select * from ChantierResp where RNumDevis ='$num' limit 1");
															$donnees = mysqli_fetch_assoc($reponse);
														?>
															<option value="<?php echo $donnees['NumSal']; ?>"><?php echo formatUP($donnees['Resp']); ?> <?php echo formatLOW($donnees['RespP']); ?></option>
														</optgroup>
<?php
    $reponseType = mysqli_query($db, "SELECT * FROM Type");
    while ($donneesType = mysqli_fetch_assoc($reponseType))
    {
        $typeNOM = $donneesType['TYP_Nom'];
        $typeID = $donneesType['TYP_Id'];
?>
                                                        <optgroup label="<?php echo $typeNOM; ?>">
<?php
        $reponse = mysqli_query($db, "SELECT * FROM Salaries cl JOIN Personnes pe ON cl.PER_Num=pe.PER_Num WHERE TYP_Id=$typeID ORDER BY PER_Nom");
        while ($donnees = mysqli_fetch_assoc($reponse))
        {
?>
														<option value="<?php echo $donnees['SAL_NumSalarie']; ?>"><?php echo formatUP($donnees['PER_Nom']); ?> <?php echo formatLOW($donnees['PER_Prenom']); ?></option>
<?php
        }
        mysqli_free_result($reponse);
?>
                                                        </optgroup>
<?php
    }
mysqli_free_result($reponseType);
?>
										            </select>
										          </div>
									</td>
								</tr>
<?php
  $reponse = mysqli_query($db, "SELECT * FROM Chantiers ch JOIN ChantierClient vcl ON ch.CHA_NumDevis=vcl.CNumDevis LEFT JOIN ChantierResp vre ON ch.CHA_NumDevis=vre.RNumDevis LEFT JOIN ChantierEtat cet ON ch.CHA_NumDevis=NumDevis WHERE ch.CHA_NumDevis='$num' limit 1");
  $donnees = mysqli_fetch_assoc($reponse);
?>
                                <tr id="Chantier_TxH">
                                    <td style="text-align: left; width: 150px; white-space: normal;">
                                        <label>Taux Horaire :</label>
                                    </td>
                                    <td>
                                        <input id="TxH" required step="0.01" name="TxH" type="number" class="inputC" value="<?php echo $donnees['CHA_TxHoraire']; ?>">
                                    </td>
                                </tr>
							</table>
						</td>
					</table>
				</div>
				<table id="downT">
					<tr>
						<td>
							<span>
								<input name="submit" type="submit" value="Valider" class="buttonC">&nbsp;&nbsp; 
							</span>
						</td>
						<td>
							<input name="reset" type="reset" value="Annuler" class="buttonC">
							</form>
						</td>
						<td>
							<form id="return" method="get" action="detailChantier.php" name="detailClient">
								<input form="return" type="hidden" name="NumC" value="<?php echo $num; ?>">
								<input form="return" name="submit" type="submit" value="Retour" class="buttonC">
							</form>
						</td>
					</tr>
				</table>
			</form>
	</div>
<?php  
	include('../footer.php');
?>