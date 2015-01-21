<?php
/**
 * Created by Valentin Durand
 * IUT Caen - DUT Informatique
 * Date: 21/01/15
 * Time: 21:57
 */
$pageTitle = "Clients Particuliers";
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
            <label>Liste des Particuliers Clients</label>
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