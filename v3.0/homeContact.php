<?php
$pageTitle = "Contacts";
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
				<label>Liste des Contacts</label>
			</div><br>
			<form method="post" action="rangContact.php" name="EditClient">
		        <table id="alphaL">
		          <tr>
		          	<td>
		          		<div class="selectDrop">
		          		<select name="trieur">
				        	<option value="0">Nom</option>
				        	<option value="1">Prénom</option>
				    	</select>
				    </div>
		          	</td>
		            <td>
		              <span>
		                <input name="submit" type="submit" value="A" class="alphaButton">
		              </span>
		            </td>
		            <td>
		              <span>
		                <input name="submit" type="submit" value="B" class="alphaButton">
		              </span>
		            </td>
		            <td>
		              <span>
		                <input name="submit" type="submit" value="C" class="alphaButton">
		              </span>
		            </td>
		            <td>
		              <span>
		                <input name="submit" type="submit" value="D" class="alphaButton">
		              </span>
		            </td>
		            <td>
		              <span>
		                <input name="submit" type="submit" value="E" class="alphaButton">
		              </span>
		            </td>
		            <td>
		              <span>
		                <input name="submit" type="submit" value="F" class="alphaButton">
		              </span>
		            </td>
		            <td>
		              <span>
		                <input name="submit" type="submit" value="G" class="alphaButton">
		              </span>
		            </td>
		            <td>
		              <span>
		                <input name="submit" type="submit" value="H" class="alphaButton">
		              </span>
		            </td>
		            <td>
		              <span>
		                <input name="submit" type="submit" value="I" class="alphaButton">
		              </span>
		            </td>
		            <td>
		              <span>
		                <input name="submit" type="submit" value="J" class="alphaButton">
		              </span>
		            </td>
		            <td>
		              <span>
		                <input name="submit" type="submit" value="K" class="alphaButton">
		              </span>
		            </td>
		            <td>
		              <span>
		                <input name="submit" type="submit" value="L" class="alphaButton">
		              </span>
		            </td>
		            <td>
		              <span>
		                <input name="submit" type="submit" value="M" class="alphaButton">
		              </span>
		            </td>
		            <td>
		              <span>
		                <input name="submit" type="submit" value="N" class="alphaButton">
		              </span>
		            </td>
		            <td>
		              <span>
		                <input name="submit" type="submit" value="O" class="alphaButton">
		              </span>
		            </td>
		            <td>
		              <span>
		                <input name="submit" type="submit" value="P" class="alphaButton">
		              </span>
		            </td>
		            <td>
		              <span>
		                <input name="submit" type="submit" value="Q" class="alphaButton">
		              </span>
		            </td>
		            <td>
		              <span>
		                <input name="submit" type="submit" value="R" class="alphaButton">
		              </span>
		            </td>
		            <td>
		              <span>
		                <input name="submit" type="submit" value="S" class="alphaButton">
		              </span>
		            </td>
		            <td>
		              <span>
		                <input name="submit" type="submit" value="T" class="alphaButton">
		              </span>
		            </td>
		            <td>
		              <span>
		                <input name="submit" type="submit" value="U" class="alphaButton">
		              </span>
		            </td>
		            <td>
		              <span>
		                <input name="submit" type="submit" value="V" class="alphaButton">
		              </span>
		            </td>
		            <td>
		              <span>
		                <input name="submit" type="submit" value="W" class="alphaButton">
		              </span>
		            </td>
		            <td>
		              <span>
		                <input name="submit" type="submit" value="X" class="alphaButton">
		              </span>
		            </td>
		            <td>
		              <span>
		                <input name="submit" type="submit" value="Y" class="alphaButton">
		              </span>
		            </td>
		            <td>
		              <span>
		                <input name="submit" type="submit" value="Z" class="alphaButton">
		              </span>
		            </td>
		          </tr>
		        </table>
		    </form>
					<table class="tableContact" cellpadding="5">
						<thead>
						<tr>
							<td class="firstCol" style="text-align: center; width: 155px;">
								<a>Structure</a>
							</td>
                            <td style="text-align: center; width: 155px;">
                                <a>Nom</a>
                            </td>
							<td style="text-align: center; width: 155px;">
								<a>Prénom</a>
							</td>
							<!--<td class="sorttable_nosort tooltip" style="text-align: center; width: 155px; cursor: help;" title="Vous ne pouvez pas classer par adresse.">
								<a>Adresse</a>
							</td>-->
							<td style="text-align: center; width: 155px;">
								<a>Ville</a>
							</td>
							<td class="sorttable_nosort tooltip" style="text-align: center; width: 155px; cursor: help;" title="Vous ne pouvez pas classer par numero de portable.">
								Téléphone
							</td>
							<td style="text-align: center; width: 155px;">
								<a>Type</a>
							</td>
						</tr>
					</thead>
					<tbody>
<?php
// Entreprises clientes
    $queryCliEnt = mysqli_query($db, "SELECT * FROM Clients WHERE CLI_Nom IS NOT NULL ORDER BY CLI_Nom");
    while ($cliEnt = mysqli_fetch_assoc($queryCliEnt))
    {
    ?>
    <form method="get" action="detailClient.php" name="detailClient">
        <input type="hidden" name="NumC" value="">
        <tr onclick="javascript:submitViewDetail('<?php echo $cliEnt['CLI_NumClient']; ?>', 'detailClient')" style="font-size: 14;">
            <td><?php echo formatUP($cliEnt['CLI_Nom']); ?></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td><?php echo formatUP($cliEnt['CLI_Ville']); ?> <?php if(!empty($cliEnt['CLI_CodePostal'])) echo $cliEnt['CLI_CodePostal']; ?></td>
            <td><?php if (!empty($cliEnt['CLI_Telephone'])) {
                    echo $cliEnt['CLI_Telephone'];
                }else {
                    echo $cliEnt['CLI_Portable'];
                } ?></td>
            <td>Client</td>
        </tr>
    </form>
<?php
    // Employes clients
        $numStruct = $cliEnt['CLI_NumClient'];
        $queryCliEmp = mysqli_query($db, "SELECT * FROM EmployerClient cl JOIN Personnes pe ON cl.PER_Num=pe.PER_Num WHERE CLI_NumClient=$numStruct ORDER BY PER_Nom");
        while ($cliEmp = mysqli_fetch_assoc($queryCliEmp))
        {
    ?>
    <form method="get" action="detailEmployeC.php" name="detailEmploye">
        <input type="hidden" name="NumC" value="">
        <tr onclick="javascript:submitViewDetail('<?php echo $cliEmp['PER_Num']; ?>', 'detailEmploye')" style="font-size: 14;">
            <td><?php echo formatUP($cliEnt['CLI_Nom']); ?></td>
            <td><?php echo formatLOW($cliEmp['PER_Nom']); ?></td>
            <td><?php echo formatLOW($cliEmp['PER_Prenom']); ?></td>
            <td><?php echo formatUP($cliEmp['PER_Ville']); ?> <?php if(!empty($cliEmp['PER_CodePostal'])) echo $cliEmp['PER_CodePostal']; ?></td>
            <td><?php if (!empty($cliEmp['PER_TelFixe'])) {
                    echo $cliEmp['PER_TelFixe'];
                }else {
                    echo $cliEmp['PER_TelPort'];
                } ?></td>
            <td>Client</td>
        </tr>
    </form>
<?php
        }
        mysqli_free_result($queryCliEmp);
    }
    mysqli_free_result($queryCliEnt);

// Particuliers clients
	$queryCliPart = mysqli_query($db, "SELECT * FROM Clients cl JOIN EmployerClient em ON cl.CLI_NumClient=em.CLI_NumClient JOIN Personnes pe ON em.PER_Num=pe.PER_Num WHERE CLI_Nom IS NULL ORDER BY PER_Nom");
	while ($cliPart = mysqli_fetch_assoc($queryCliPart))
	{
?>
						<form method="get" action="detailClient.php" name="detailClient">
							<input type="hidden" name="NumC" value="">
							<tr onclick="javascript:submitViewDetail('<?php echo $cliPart['CLI_NumClient']; ?>', 'detailClient')" style="font-size: 14;">
                                <td>PARTICULIER</td>
                                <td><?php echo formatLOW($cliPart['PER_Nom']); ?></td>
								<td><?php echo formatLOW($cliPart['PER_Prenom']); ?></td>
								<td><?php echo formatUP($cliPart['PER_Ville']); ?> <?php if(!empty($cliPart['PER_CodePostal'])) echo $cliPart['PER_CodePostal']; ?></td>
								<td><?php if (!empty($cliPart['PER_TelFixe'])) {
									echo $cliPart['PER_TelFixe'];
								}else {
									echo $cliPart['PER_TelPort'];
								} ?></td>
								<td>Client</td>
							</tr>
						</form>
<?php
	}
	mysqli_free_result($queryCliPart);
// Fournisseurs
	$queryFourn = mysqli_query($db, 'SELECT * FROM Fournisseurs ORDER BY FOU_Nom');
	while ($fourn = mysqli_fetch_assoc($queryFourn))
	{
?>
						<form method="get" action="detailFournisseur.php" name="detailFour">
							<input type="hidden" name="NumC" value="">
							<tr onclick="javascript:submitViewDetail('<?php echo $fourn['FOU_NumFournisseur']; ?>', 'detailFour');" style="font-size: 14;">
								<td><?php echo formatUP($fourn['FOU_Nom']); ?></td>
								<td> </td>
                                <td> </td>
								<td><?php echo formatUP($fourn['FOU_Ville']); ?> <?php if(!empty($fourn['FOU_CodePostal'])) echo $fourn['FOU_CodePostal']; ?></td>
								<td><?php if (!empty($fourn['FOU_Telephone'])) {
									echo $fourn['FOU_Telephone'];
								}else {
									echo $fourn['FOU_Portable'];
								} ?></td>
								<td>Fournisseur</td>
							</tr>
						</form>
<?php
        // Employes Fournisseurs
        $numF = $fourn['FOU_NumFournisseur'];
        $queryFouEmp = mysqli_query($db, 'SELECT * FROM Fournisseurs fo JOIN EmployerFourn em ON fo.FOU_NumFournisseur=em.FOU_NumFournisseur JOIN Personnes pe ON em.PER_Num=pe.PER_Num WHERE fo.FOU_NumFournisseur='.$numF.' ORDER BY PER_Nom');
        while ($fouEmp = mysqli_fetch_assoc($queryFouEmp))
        {
        ?>
        <form method="get" action="detailEmployeF.php" name="detailEmpF">
            <input type="hidden" name="NumC" value="">
            <tr onclick="javascript:submitViewDetail('<?php echo $fouEmp['PER_Num']; ?>', 'detailEmpF');" style="font-size: 14;">
                <td><?php echo formatUP($fourn['FOU_Nom']); ?></td>
                <td><?php echo formatUP($fouEmp['PER_Nom']); ?></td>
                <td><?php echo formatLOW($fouEmp['PER_Prenom']); ?></td>
                <td><?php echo formatUP($fouEmp['PER_Ville']); ?> <?php if(!empty($fouEmp['PER_CodePostal'])) echo $fouEmp['PER_CodePostal']; ?></td>
                <td><?php if (!empty($fouEmp['PER_TelFixe'])) {
                        echo $fouEmp['PER_TelFixe'];
                    }else {
                        echo $fouEmp['PER_TelPort'];
                    } ?></td>
                <td>Fournisseur</td>
            </tr>
        </form>
<?php
        }
        mysqli_free_result($queryFouEmp);
	}
	mysqli_free_result($queryFourn);

	$reponse = mysqli_query($db, 'SELECT * FROM Salaries cl JOIN Personnes pe ON cl.PER_Num=pe.PER_Num JOIN Type ty ON cl.TYP_Id=ty.TYP_Id ORDER BY PER_Nom');
	while ($donnees = mysqli_fetch_assoc($reponse))
	{
?>
						<form method="get" action="detailSal.php" name="detailSal">
							<input type="hidden" name="NumC" value="">
							<tr onclick="javascript:submitViewDetail('<?php echo $donnees['SAL_NumSalarie']; ?>', 'detailSal');" style="font-size: 14;">
                                <td>REVIVRE</td>
                                <td><?php echo formatLOW($donnees['PER_Nom']); ?></td>
								<td><?php echo formatLOW($donnees['PER_Prenom']); ?></td>
								<!--<td><?php /*echo formatLOW($donnees['PER_Adresse']); */?></td>-->
								<td><?php echo formatUP($donnees['PER_Ville']); ?> <?php if(!empty($donnees['PER_CodePostal'])) echo $donnees['PER_CodePostal']; ?></td>
								<td><?php if (!empty($donnees['PER_TelFixe'])) {
									echo $donnees['PER_TelFixe'];
								}else {
									echo $donnees['PER_TelPort'];
								} ?></td>
								<td><?php echo $donnees['TYP_Nom']; ?></td>
							</tr>
						</form>
<?php
	}
	mysqli_free_result($reponse);
?>
					</tbody>
					</table>
		</div>
<?php  
	include('footer.php');
?>