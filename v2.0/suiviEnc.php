<?php
/**
 * Created by Valentin Durand
 * IUT Caen - DUT Informatique
 * Date: 22/11/14
 * Time: 18:34
 */
    include('bandeau.php');
    if(!empty($_POST['Encad'])){
        $numEnc = $_POST['Encad'];
    }
    else{
        $numEnc = 0;
    }

    $totMP = 0;
    $totAP = 0;
    $totAT = 0;
    $totEA = 0;
    $totHP = 0;
    $totHT = 0;
    $totEH = 0;
    $totNS = 0;
?>
    <script src="js/sorttable.js"></script>
    <div id="corps">
        <div id="labelCat" style="padding-bottom: 15px;">
            <table align="center">
                <tr>
                    <td style="text-align: left; width: 150px;">
                        <label>Encadrant</label>
                    </td>
                    <td>
                        <div class="selectType">
                            <form method="post" action="suiviEnc.php" name="Encadrant">
                                <select name="Encad" onchange="this.parentNode.submit()">
                                    <option <?php if($numEnc == 0){echo "selected";} ?> value="0">--</option>
                                    <?php
                                    $reponse = mysqli_query($db, "SELECT Distinct SAL_NumSalarie, PER_Nom, PER_Prenom FROM Encadrer JOIN Salaries USING (SAL_NumSalarie) JOIN Personnes USING (PER_Num) ORDER BY PER_Nom");
                                    while ($donnees = mysqli_fetch_assoc($reponse))
                                    {
                                        ?>
                                        <option <?php if($donnees['SAL_NumSalarie'] == $numEnc){echo "selected";} ?> value="<?php echo $donnees['SAL_NumSalarie']; ?>"><?php echo formatUP($donnees['PER_Nom'])." ".formatLOW($donnees['PER_Prenom']); ?></option>
                                        <?php
                                    }
                                    mysqli_free_result($reponse);
                                    ?>
                                </select>
                            </form>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
        <table class="tableContact">
            <thead>
            <tr>
                <td class="firstCol" style="text-align: center; width: 20%;">Intitulé</td>
                <td style="text-align: center; width: 10%;">Montant</td>
                <td style="text-align: center; width: 10%;">Achats Prévus</td>
                <td style="text-align: center; width: 10%;">Achats Totals</td>
                <td style="text-align: center; width: 10%;">Ecart Achat</td>
                <td style="text-align: center; width: 10%;">Heures prévues</td>
                <td style="text-align: center; width: 10%;">Heures Tolales</td>
                <td style="text-align: center; width: 10%;">Ecart MO</td>
                <td style="text-align: center; width: 10%;">NB Salariés</td>
            </tr>
            </thead>
            <tbody>
<?php

    /*
     * VIEWS USED HERE :
     *
     * -- ChantierAchat --
     * create or replace view ChantierAchat as
     * select CHA_NumDevis, CHA_AchatsPrev,
     * sum(ACH_Montant) as AchatTot,
     * ROUND((CHA_AchatsPrev-sum(ACH_Montant)),2) as EcartAch
     * from Chantiers
     * JOIN Acheter USING (CHA_NumDevis)
     * group by CHA_NumDevis;
     *
     * -- ChantierHeure --
     * create or replace view ChantierHeure as
     * select CHA_NumDevis, CHA_HeuresPrev,
     * sum(TRA_Duree) as HeureTot,
     * (CHA_HeuresPrev-sum(TRA_Duree)) as EcartHeure,
     * COUNT(DISTINCT SAL_NumSalarie) as NbSalarie
     * from Chantiers
     * JOIN TempsTravail USING (CHA_NumDevis)
     * group by CHA_NumDevis
     *
     */

    if($numEnc == 0){
        $query = "select CHA_Intitule, CHA_MontantPrev, ac.CHA_AchatsPrev, AchatTot, EcartAch, he.CHA_HeuresPrev, HeureTot, EcartHeure, NbSalarie
            from Chantiers ch
            JOIN ChantierAchat ac ON ch.CHA_NumDevis=ac.CHA_NumDevis
            JOIN ChantierHeure he ON ch.CHA_NumDevis=he.CHA_NumDevis
            JOIN Encadrer en ON ch.CHA_NumDevis=en.CHA_NumDevis
            ORDER BY CHA_Intitule";
    }
    else{
        $query = "select CHA_Intitule, CHA_MontantPrev, ac.CHA_AchatsPrev, AchatTot, EcartAch, he.CHA_HeuresPrev, HeureTot, EcartHeure, NbSalarie
            from Chantiers ch
            JOIN ChantierAchat ac ON ch.CHA_NumDevis=ac.CHA_NumDevis
            JOIN ChantierHeure he ON ch.CHA_NumDevis=he.CHA_NumDevis
            JOIN Encadrer en ON ch.CHA_NumDevis=en.CHA_NumDevis
            WHERE en.SAL_NumSalarie = $numEnc
            ORDER BY CHA_Intitule";
    }

    $reponse = mysqli_query($db, $query);
    while ($donnees = mysqli_fetch_assoc($reponse)){
?>
            <tr>
                <td><?php echo formatLOW($donnees['CHA_Intitule']); ?></td>
                <td><?php echo $donnees['CHA_MontantPrev']." €"; $totMP += $donnees['CHA_MontantPrev']; ?></td>
                <td><?php echo $donnees['CHA_AchatsPrev']." €"; $totAP += $donnees['CHA_AchatsPrev']; ?></td>
                <td><?php echo $donnees['AchatTot']." €"; $totAT += $donnees['AchatTot']; ?></td>
                <td><?php echo $donnees['EcartAch']." €"; $totEA += $donnees['EcartAch']; ?></td>
                <td><?php echo $donnees['CHA_HeuresPrev']; $totHP += $donnees['CHA_HeuresPrev']; ?></td>
                <td><?php echo $donnees['HeureTot']; $totHT += $donnees['HeureTot']; ?></td>
                <td><?php echo $donnees['EcartHeure']; $totEH += $donnees['EcartHeure']; ?></td>
                <td><?php echo $donnees['NbSalarie']; $totNS += $donnees['NbSalarie']; ?></td>
            </tr>
<?php
    }
    mysqli_free_result($reponse);
?>
            </tbody>
            <tfoot>
                <tr>
                    <th style="text-align: right; font-size: 14px;">TOTAL&nbsp;&nbsp;</th>
                    <th style="text-align: left; font-size: 14px; padding-left: 5px;"><?php echo $totMP." €"; ?></th>
                    <th style="text-align: left; font-size: 14px; padding-left: 5px;"><?php echo $totAP." €"; ?></th>
                    <th style="text-align: left; font-size: 14px; padding-left: 5px;"><?php echo $totAT." €"; ?></th>
                    <th style="text-align: left; font-size: 14px; padding-left: 5px;"><?php echo $totEA." €"; ?></th>
                    <th style="text-align: left; font-size: 14px; padding-left: 5px;"><?php echo $totHP; ?></th>
                    <th style="text-align: left; font-size: 14px; padding-left: 5px;"><?php echo $totHT; ?></th>
                    <th style="text-align: left; font-size: 14px; padding-left: 5px;"><?php echo $totEH; ?></th>
                    <th style="text-align: left; font-size: 14px; padding-left: 5px;"><?php echo $totNS; ?></th>
                </tr>
            </tfoot>
        </table>
    </div>
<?php
include('footer.php');
?>