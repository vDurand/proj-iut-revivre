<?php
/**
 * Created by Valentin Durand
 * IUT Caen - DUT Informatique
 * Date: 21/01/15
 * Time: 22:39
 */
$pageTitle = "Référents";
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
            <label>Liste des Référents</label>
        </div><br>
        <div class="listeRef">
            <table class="sortable" cellpadding="5">
                <thead>
                <tr>
                    <td class="premierCol" style="text-align: center; width: 150px;">
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
                    <td style="text-align: center; width: 150px;">
                        Prescripteur
                    </td>
                </tr>
                </thead>
                <tbody>
                <?php
                $reponse = mysqli_query($db, 'SELECT * FROM Referents cl JOIN Personnes pe ON cl.PER_Num=pe.PER_Num JOIN Prescripteurs USING(PRE_Id) ORDER BY PER_Nom');
                while ($donnees = mysqli_fetch_assoc($reponse))
                {
                    ?>
                    <form method="get" action="detailRef.php" name="detailRef">
                        <input type="hidden" name="NumC" value="">
                        <tr onclick="javascript:submitViewDetail('<?php echo $donnees['REF_NumRef']; ?>', 'detailRef');" style="font-size: 14;">
                            <td><?php echo formatUP($donnees['PER_Nom']); ?></td>
                            <td><?php echo formatLOW($donnees['PER_Prenom']); ?></td>
                            <td><?php echo $donnees['PER_TelFixe']; ?></td>
                            <td><?php echo $donnees['PER_TelPort']; ?></td>
                            <td><a href="mailto:<?php echo $donnees['PER_Email'];?>"><?php echo $donnees['PER_Email']; ?></a></td>
                            <td>
                                <?php
                                if(!empty($donnees['PER_Adresse'])){
                                    echo formatLOW($donnees['PER_Adresse']).", ";
                                }
                                if(!empty($donnees['PER_Ville'])){
                                    echo formatUP($donnees['PER_Ville'])." ";
                                }
                                if(!empty($donnees['PER_CodePostal'])){
                                    echo $donnees['PER_CodePostal'];
                                }
                                ?>
                            </td>
                            <td><?php echo formatLOW($donnees['PRE_Nom']); ?></td>
                        </tr>
                    </form>
                <?php
                }
                mysqli_free_result($reponse);
                ?>
                </tbody>
            </table>
        </div>
    </div>
<?php
include('../../footer.php');
?>