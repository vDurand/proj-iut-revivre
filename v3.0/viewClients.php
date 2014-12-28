<?php
    $pageTitle = "Clients";
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
				<label>Liste des Clients</label>
			</div><br>
				<div class="listeClients">
					<table class="sortable" cellpadding="5">
						<thead>
							<tr>
								<td class="premierCol" style="text-align: center; width: 150px;">
									Structure
								</td>
                                <td style="text-align: center; width: 150px;">
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
							</tr>
						</thead>
						<tbody>
<?php
// Affiche les entreprises clientes
	$queryCliStruct = mysqli_query($db, 'SELECT * FROM Clients WHERE CLI_Nom IS NOT NULL ORDER BY CLI_Nom');
	while ($CliStruct = mysqli_fetch_assoc($queryCliStruct))
	{
?>
							<form method="get" action="detailClient.php" name="detailClient">
								<input type="hidden" name="NumC" value="">
									<tr onclick="javascript:submitViewDetail('<?php echo $CliStruct['CLI_NumClient']; ?>', 'detailClient');" style="font-size: 14;">
                                        <td><?php echo formatUP($CliStruct['CLI_Nom']); ?></td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td><?php echo $CliStruct['CLI_Telephone']; ?></td>
										<td><?php echo $CliStruct['CLI_Portable']; ?></td>
										<td><a href="mailto:<?php echo $CliStruct['CLI_Email'];?>"><?php echo $CliStruct['CLI_Email']; ?></a></td>
										<td>
										<?php
											if(!empty($CliStruct['CLI_Adresse'])){
												echo formatLOW($CliStruct['CLI_Adresse']).", ";
											}
											if(!empty($CliStruct['CLI_Ville'])){
												echo formatUP($CliStruct['CLI_Ville'])." ";
											}
											if(!empty($CliStruct['CLI_CodePostal'])){
												echo $CliStruct['CLI_CodePostal'];
											}
											?>
										  </td>
									</tr>
							</form>
        <?php
        // Affiche les employers rattaches a une entreprise clients
        $numStruct = $CliStruct['CLI_NumClient'];
        $queryCliEmp = mysqli_query($db, 'SELECT * FROM EmployerClient cl JOIN Personnes pe ON cl.PER_Num=pe.PER_Num WHERE CLI_NumClient='.$numStruct.' ORDER BY PER_Nom');
        while ($CliEmp = mysqli_fetch_assoc($queryCliEmp))
        {
            ?>
            <form method="get" action="detailClient.php" name="detailClient">
                <input type="hidden" name="NumC" value="">
                <tr onclick="javascript:submitViewDetail('<?php echo $CliEmp['CLI_NumClient']; ?>', 'detailClient');" style="font-size: 14;">
                    <td><?php echo formatUP($CliStruct['CLI_Nom']); ?></td>
                    <td><?php echo formatUP($CliEmp['PER_Nom']); ?></td>
                    <td><?php echo formatLOW($CliEmp['PER_Prenom']); ?></td>
                    <td><?php echo $CliEmp['PER_TelFixe']; ?></td>
                    <td><?php echo $CliEmp['PER_TelPort']; ?></td>
                    <td><a href="mailto:<?php echo $CliEmp['PER_Email'];?>"><?php echo $CliEmp['PER_Email']; ?></a></td>
                    <td>
                        <?php
                        if(!empty($CliEmp['PER_Adresse'])){
                            echo formatLOW($CliEmp['PER_Adresse']).", ";
                        }
                        if(!empty($CliEmp['PER_Ville'])){
                            echo formatUP($CliEmp['PER_Ville'])." ";
                        }
                        if(!empty($CliEmp['PER_CodePostal'])){
                            echo $CliEmp['PER_CodePostal'];
                        }
                        ?>
                    </td>
                </tr>
            </form>
        <?php
        }
        mysqli_free_result($queryCliEmp);
	}
	mysqli_free_result($queryCliStruct);

// Affiche les particuliers clients
    $queryCliPart = mysqli_query($db, 'SELECT * FROM Clients cl JOIN EmployerClient em ON cl.CLI_NumClient=em.CLI_NumClient JOIN Personnes pe ON em.PER_Num=pe.PER_Num WHERE CLI_Nom IS NULL ORDER BY PER_Nom');
    while ($CliPart = mysqli_fetch_assoc($queryCliPart))
    {
    ?>
    <form method="get" action="detailClient.php" name="detailClient">
        <input type="hidden" name="NumC" value="">
        <tr onclick="javascript:submitViewDetail('<?php echo $CliPart['CLI_NumClient']; ?>', 'detailClient');" style="font-size: 14;">
            <td>PARTICULIER</td>
            <td><?php echo formatUP($CliPart['PER_Nom']); ?></td>
            <td><?php echo formatLOW($CliPart['PER_Prenom']); ?></td>
            <td><?php echo $CliPart['PER_TelFixe']; ?></td>
            <td><?php echo $CliPart['PER_TelPort']; ?></td>
            <td><a href="mailto:<?php echo $CliPart['PER_Email'];?>"><?php echo $CliPart['PER_Email']; ?></a></td>
            <td>
                <?php
                if(!empty($CliPart['PER_Adresse'])){
                    echo formatLOW($CliPart['PER_Adresse']).", ";
                }
                if(!empty($CliPart['PER_Ville'])){
                    echo formatUP($CliPart['PER_Ville'])." ";
                }
                if(!empty($CliPart['PER_CodePostal'])){
                    echo $CliPart['PER_CodePostal'];
                }
                ?>
            </td>
        </tr>
    </form>
<?php
    }
    mysqli_free_result($queryCliPart);
?>
						</tbody>
					</table>
				</div>
		</div>
<?php  
	include('footer.php');
?>