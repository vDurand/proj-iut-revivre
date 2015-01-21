<?php
/**
 * Created by Valentin Durand
 * IUT Caen - DUT Informatique
 * Date: 21/01/15
 * Time: 22:02
 */
$pageTitle = "Fournisseurs Employés";
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
            <label>Liste des Employés Fournisseurs</label>
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
                    $nFourn = $donneeFourn['FOU_NumFournisseur'];
                    $queryEmploye = mysqli_query($db, 'SELECT * FROM EmployerFourn JOIN Personnes USING (PER_Num) WHERE FOU_NumFournisseur = '.$nFourn.' ORDER BY PER_Nom');
                    while ($donneeEmp = mysqli_fetch_assoc($queryEmploye))
                    {
                        ?>
                        <form method="get" action="detailEmployeF.php" name="detailEmp">
                            <input type="hidden" name="NumC" value="">
                            <tr onclick="javascript:submitViewDetail('<?php echo $donneeEmp['PER_Num']; ?>', 'detailEmp');" style="font-size: 14;">
                                <td><?php echo formatUP($donneeFourn['FOU_Nom']); ?></td>
                                <td><?php echo formatUP($donneeEmp['PER_Nom']); ?></td>
                                <td><?php echo formatLOW($donneeEmp['PER_Prenom']); ?></td>
                                <td><?php echo $donneeEmp['PER_TelFixe']; ?></td>
                                <td><?php echo $donneeEmp['PER_TelPort']; ?></td>
                                <td><a href="mailto:<?php echo $donneeEmp['PER_Email'];?>"><?php echo $donneeEmp['PER_Email']; ?></a></td>
                                <td>
                                    <?php
                                    if(!empty($donneeEmp['PER_Adresse'])){
                                        echo formatLOW($donneeEmp['PER_Adresse']).", ";
                                    }
                                    if(!empty($donneeEmp['PER_Ville'])){
                                        echo formatUP($donneeEmp['PER_Ville'])." ";
                                    }
                                    if(!empty($donneeEmp['PER_CodePostal'])){
                                        echo $donneeEmp['PER_CodePostal'];
                                    }
                                    ?>
                                </td>
                            </tr>
                        </form>
                    <?php
                    }
                    mysqli_free_result($queryEmploye);
                    ?>
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