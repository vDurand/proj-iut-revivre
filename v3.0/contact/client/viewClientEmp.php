<?php
/**
 * Created by Valentin Durand
 * IUT Caen - DUT Informatique
 * Date: 21/01/15
 * Time: 22:00
 */
$pageTitle = "Clients Employés";
$pwd='../../';
include('../../bandeau.php');
?>
    <script src="../../js/sorttable.js"></script>
    <script>
        $(document).ready(function() {
            $('.tooltip').tooltipster();
        });
    </script>
    <div id="corps">
        <div id="labelT">
            <label>Liste des Employés Clients</label>
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
                    <td style="text-align: center; width: 350px;">
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
                    // Affiche les employers rattaches a une entreprise clients
                    $numStruct = $CliStruct['CLI_NumClient'];
                    $queryCliEmp = mysqli_query($db, 'SELECT * FROM EmployerClient cl JOIN Personnes pe ON cl.PER_Num=pe.PER_Num WHERE CLI_NumClient='.$numStruct.' ORDER BY PER_Nom');
                    while ($CliEmp = mysqli_fetch_assoc($queryCliEmp))
                    {
                        ?>
                        <form method="get" action="detailEmployeC.php" name="detailEmploye">
                            <input type="hidden" name="NumC" value="">
                            <tr onclick="javascript:submitViewDetail('<?php echo $CliEmp['PER_Num']; ?>', 'detailEmploye');" style="font-size: 14;">
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
                ?>
                </tbody>
            </table>
        </div>
    </div>
<?php
include('../../footer.php');
?>