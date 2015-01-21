<?php
/**
 * Created by Valentin Durand
 * IUT Caen - DUT Informatique
 * Date: 21/01/15
 * Time: 22:01
 */
$pageTitle = "Fournisseurs Entreprises";
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
            <label>Liste des Entreprises Fournisseurs</label>
        </div><br>
        <div class="listeFourn">
            <table class="sortable" cellpadding="5">
                <thead>
                <tr>
                    <td class="premierCol" style="text-align: center; width: 150px;">
                        Entreprise
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
                $queryFourn = mysqli_query($db, 'SELECT * FROM Fournisseurs ORDER BY FOU_Nom');
                while ($donneeFourn = mysqli_fetch_assoc($queryFourn))
                {
                    ?>
                    <form method="get" action="detailFournisseur.php" name="detailFour">
                        <input type="hidden" name="NumC" value="">
                        <tr onclick="javascript:submitViewDetail('<?php echo $donneeFourn['FOU_NumFournisseur']; ?>', 'detailFour');" style="font-size: 14;">
                            <td><?php echo formatUP($donneeFourn['FOU_Nom']); ?></td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td><?php echo $donneeFourn['FOU_Telephone']; ?></td>
                            <td><?php echo $donneeFourn['FOU_Portable']; ?></td>
                            <td><a href="mailto:<?php echo $donneeFourn['FOU_Email'];?>"><?php echo $donneeFourn['FOU_Email']; ?></a></td>
                            <td>
                                <?php
                                if(!empty($donneeFourn['FOU_Adresse'])){
                                    echo formatLOW($donneeFourn['FOU_Adresse']).", ";
                                }
                                if(!empty($donneeFourn['FOU_Ville'])){
                                    echo formatUP($donneeFourn['FOU_Ville'])." ";
                                }
                                if(!empty($donneeFourn['FOU_CodePostal'])){
                                    echo $donneeFourn['FOU_CodePostal'];
                                }
                                ?>
                            </td>
                        </tr>
                    </form>
                    <?php
                }
                mysqli_free_result($queryFourn);
                ?>
                </tbody>
            </table>
        </div>
    </div>
<?php
include('footer.php');
?>