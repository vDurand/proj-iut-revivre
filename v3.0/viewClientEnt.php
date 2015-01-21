<?php
/**
 * Created by Valentin Durand
 * IUT Caen - DUT Informatique
 * Date: 21/01/15
 * Time: 21:57
 */
$pageTitle = "Clients Entreprises";
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
            <label>Liste des Entreprises Clientes</label>
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
                }
                mysqli_free_result($queryCliStruct);
                ?>
                </tbody>
            </table>
        </div>
    </div>
<?php
include('footer.php');
?>