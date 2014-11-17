<div id="labelT">
    <label>Detail du Chantier</label>
	<form  method="post" action="printer.php" name="printer">
		<input type="hidden" name="NumC" value="<?php echo $donnees['CHA_NumDevis']; ?>">
		<div style="text-align: right; margin-top: -25px; margin-right: 5px;"><input class="printButton" type="submit" name="printer" value="Imprimer"/></div>
	</form>
</div>
<br>
<table id="fullTable" rules="all">
    <tr>
        <td rowspan="3">
            <table cellpadding="10" class="detailClients">
                <tr>
                    <th style="text-align: left; width: 200px; white-space: normal;">Nom du Chantier:</th>
                    <td style="text-align: center; width: 250px;"><?php echo formatLOW($donnees['CHA_Intitule']); ?></td>
                </tr>
                <tr>
                    <th style="text-align: left; width: 200px; white-space: normal;">Adresse:</th>
                    <td style="text-align: center; width: 200px;"><?php echo formatUP($donnees['CHA_Adresse']); ?></td>
                </tr>
                <tr>
                    <th style="text-align: left; width: 200px; white-space: normal;">Date de Début:</th>
                    <td style="text-align: center; width: 200px;"><?php echo dater($donnees['CHA_DateDebut']); ?></td>
                </tr>
                <tr style="height: 40px;">
                    <th style="text-align: left; width: 200px; white-space: normal;">Echéance:</th>
                    <td style="text-align: center; width: 200px;"><?php echo dater($donnees['CHA_Echeance']); ?></td>
                </tr>
                <tr style="height: 40px;">
                    <th style="text-align: left; width: 200px; white-space: normal;">Fin:</th>
                <?php
                if($donnees['CHA_DateFinReel']!=NULL){
                    ?>
                        <td style="text-align: center; width: 200px;"><?php echo dater($donnees['CHA_DateFinReel']); ?></td>
                <?php
                }
                else{
                ?>
                    <td style="text-align: center; width: 200px;">--</td>
                <?php
                }
                ?>
                </tr>
                <tr style="height: 40px;">
                    <th style="text-align: left; width: 200px; white-space: normal;">Etat du Devis:</th>
                    <td style="text-align: center; width: 200px;"><div id="stateOfSite"><?php echo formatLOW($donnees['Etat']); ?></div></td>
                </tr>
                <tr>
                    <th style="text-align: left; width: 200px; white-space: normal;">Montant:</th>
                    <td style="text-align: center; width: 200px;"><?php echo $donnees['CHA_MontantPrev']; ?> &euro;</td>
                </tr>
                <tr>
                    <th style="text-align: left; width: 200px; white-space: normal;">Achats Prévus:</th>
                    <td style="text-align: center; width: 200px;"><?php echo $donnees['CHA_AchatsPrev']; $MontantMax = $donnees['CHA_AchatsPrev']; ?> &euro;</td>
                </tr>
                <tr>
                    <th style="text-align: left; width: 200px; white-space: normal;">Heures Prévues:</th>
                    <td style="text-align: center; width: 200px;"><div id="hoursOnSite"><?php echo $donnees['CHA_HeuresPrev']; $Hmax = $donnees['CHA_HeuresPrev'];?></div></td>
                </tr>
                <tr>
                    <th style="text-align: left; width: 200px; white-space: normal;">Responsable:</th>
                    <td style="text-align: center; width: 200px;"><?php echo formatUP($donnees['Resp']); ?> <?php echo formatLOW($donnees['RespP']); ?></td>
                </tr>
            </table>
        </td>
        <td>
            <table cellpadding="10" class="detailClients">
                <tr>
                    <th style="text-align: left; width: 200px; white-space: normal;">Client:</th>
                <?php
                    if(empty($donnees['Structure'])){
                ?>
                    <td style="text-align: center; width: 200px;"><?php echo formatUP($donnees['Client'])." ".formatLOW($donnees['ClientP']); ?></td>
                <?php
                    }
                    else{
                ?>
                    <td style="text-align: center; width: 200px;"><?php echo formatUP($donnees['Structure']); ?></td>
                <?php
                    }
                ?>
                </tr>
                <tr>
                    <th style="text-align: left; width: 200px; white-space: normal;">Tél Fixe :</th>
                    <td style="text-align: center; width: 200px;"><?php echo $donnees['ClientTel']; ?></td>
                </tr>
                <tr>
                    <th style="text-align: left; width: 200px; white-space: normal;">Adresse :</th>
                    <td style="text-align: center; width: 200px;"><?php echo formatLOW($donnees['ClientAd']); ?></td>
                </tr>
                <tr>
                    <th style="text-align: left; width: 200px; white-space: normal;">Ville :</th>
                    <td style="text-align: center; width: 200px;"><?php echo formatLOW($donnees['ClientV']); ?>, <?php echo $donnees['ClientCP']; ?></td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td>
            <table cellpadding="10" class="detailClients noimprim">
                <tr>
                    <th style="text-align: left; width: 200px; white-space: normal;">TVA :</th>
                    <td style="text-align: center; width: 200px;"><?php echo $donnees['CHA_TVA']; ?> %</td>
                </tr>
                <tr>
                    <th style="text-align: left; width: 200px; white-space: normal;">Taux Horaire :</th>
                    <td style="text-align: center; width: 200px;"><?php echo $donnees['CHA_TxHoraire']; ?> € /h</td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td>
            <table cellpadding="10" class="detailClients">
                <tr>
                    <th style="text-align: left; width: 200px; white-space: normal;">Achats :</th>
                    <td style="text-align: center; width: 200px;"><div id="progressbar2"><div class="progress-label2"></div></div></td>
                </tr>
                <tr>
                    <th style="text-align: left; width: 200px; white-space: normal;">Heures en cours :</th>
                    <td style="text-align: center; width: 200px;"><div id="progressbar"><div class="progress-label"></div></div></td>
                </tr>
                <tr>
                    <th style="text-align: left; width: 200px; white-space: normal;">Heures restantes :</th>
                    <td style="text-align: center; width: 200px;"><div id="heureRestante"></div></td>
                </tr>
                <tr>
                    <th style="text-align: left; width: 200px; white-space: normal;">Achat Restant :</th>
                    <td style="text-align: center; width: 200px;"><div id="achatRestant"></div></td>
                </tr>
            </table>
        </td>
    </tr>
</table>
<!-- Buttons Line -->
<table id="downT">
    <tr id="button-line">
        <td style="text-align: center; width: 150px;">
            <form method="post" action="editChantier.php" name="EditChantier">
                <input type="hidden" name="NumC" value="<?php echo $donnees['CHA_NumDevis']; ?>">
            <span>
              <input name="submit" type="submit" value="Modifier" class="buttonC">
            </span>
            </form>
        </td>
        <?php
        $IdEtat=$donnees['Id'];
        if($donnees['Resp']==""){
            ?>
            <td style="text-align: center; width: 200px;">
            <span>
              <input  name="submit" type="submit" onclick="addResp()" value="Responsable" class="buttonC">
            </span>
            </td>
        <?php
        }
        else{
            ?>
            <td style="text-align: center; width: 200px;">
            <span>
              <input  name="submit" type="submit" onclick="addTps()" value="Travail" class="buttonC">
            </span>
            </td>
        <?php
        }
        ?>
        <td style="text-align: center; width: 200px;">
            <span>
              <input  name="submit" type="submit" onclick="changeEtat(<?php echo $IdEtat; ?>)" value="Etat" class="buttonC">
            </span>
        </td>
        <td style="text-align: center; width: 150px;">
            <form method="post" action="buy.php" name="addBuy">
                <input type="hidden" name="NumC" value="<?php echo $donnees['CHA_NumDevis']; ?>">
            <span>
              <input name="submit" type="submit" value="Achat" class="buttonC">
            </span>
            </form>
        </td>
    </tr>
    <!-- Ajout Responsable -->
    <tr id="Ajout-Resp" style="display:none;">
        <form method="post" action="chantierAdd.php" name="Chantier" formtype="1" colvalue="2">
            <input type="hidden" name="NumC" value="<?php echo $donnees['CHA_NumDevis']; ?>">
            <td style="text-align: center; padding-top: 35px;">
                <label>Responsable : </label>
            </td>
            <td align="center" style="padding-top: 35px;">
                <div class="selectType">
                    <select required name="Resp">
                        <?php
                        $reponseBis = mysqli_query($db, "SELECT * FROM Salaries cl JOIN Personnes pe ON cl.PER_Num=pe.PER_Num ORDER BY PER_Nom");
                        while ($donneesBis = mysqli_fetch_assoc($reponseBis))
                        {
                            ?>
                            <option value="<?php echo $donneesBis['SAL_NumSalarie']; ?>"><?php echo formatUP($donneesBis['PER_Nom']);?> <?php echo formatLOW($donneesBis['PER_Prenom']);?></option>
                        <?php
                        }
                        mysqli_free_result($reponseBis);
                        ?>
                    </select>
                </div>
            </td>
            <td align="left" style="padding-top: 35px;">
                <input name="submit" type="submit" value="Ajouter">
            </td>
        </form>
    </tr>
    <!-- Ajout Tps Travail -->
    <form method="post" action="chantierAdd.php" name="AddWork" id="AddWork">
        <tr id="Ajout-Tps" style="display:none;">
            <input form="AddWork" type="hidden" name="NumC" value="<?php echo $donnees['CHA_NumDevis']; ?>">
            <td style="text-align: center; padding-top: 35px;">
                <label>Membres : </label>
            </td>
            <td align="center" style="padding-top: 35px;">
                <div class="selectType">
                    <select required form="AddWork" name="Member[]">
                        <option></option>
                        <optgroup label="Stagiaires">
                            <?php
                            $j = 0;
                            $reponseTres = mysqli_query($db, "SELECT * FROM Salaries cl JOIN Personnes pe ON cl.PER_Num=pe.PER_Num Where TYP_Id = 7 ORDER BY PER_Nom");
                            while ($donneesTres = mysqli_fetch_assoc($reponseTres))
                            {
                                ?>
                                <option value="<?php echo $donneesTres['SAL_NumSalarie']; ?>"><?php echo formatUP($donneesTres['PER_Nom']); ?> <?php echo formatLOW($donneesTres['PER_Prenom']); ?></option>
                                <?php
                                $temp1=formatUP($donneesTres['PER_Nom']);
                                $temp2=formatLOW($donneesTres['PER_Prenom']);
                                $Workers[$j] = "$temp1 $temp2";
                                $Ids[$j] = $donneesTres['SAL_NumSalarie'];
                                $limitOpt = $j;
                                $j++;
                            }
                            mysqli_free_result($reponseTres);
                            ?>
                        </optgroup>
                        <optgroup label="Salariés en Insertion">
                            <?php
                            $reponseTres = mysqli_query($db, "SELECT * FROM Salaries cl JOIN Personnes pe ON cl.PER_Num=pe.PER_Num Where TYP_Id = 8 ORDER BY PER_Nom");
                            while ($donneesTres = mysqli_fetch_assoc($reponseTres))
                            {
                                ?>
                                <option value="<?php echo $donneesTres['SAL_NumSalarie']; ?>"><?php echo formatUP($donneesTres['PER_Nom']); ?> <?php echo formatLOW($donneesTres['PER_Prenom']); ?></option>
                                <?php
                                $temp1=formatUP($donneesTres['PER_Nom']);
                                $temp2=formatLOW($donneesTres['PER_Prenom']);
                                $Workers[$j] = "$temp1 $temp2";
                                $Ids[$j] = $donneesTres['SAL_NumSalarie'];
                                $j++;
                            }
                            mysqli_free_result($reponseTres);
                            ?>
                        </optgroup>
                    </select>
                </div>
            </td>
            <td align="left" style="padding-top: 35px;">
                <input form="AddWork" name="submit" type="submit" value="Ajouter">
                <input form="AddWork" name="reset" type="reset" value="Annuler">
            </td>
        </tr>
        <tr id="Ajout-Tpss" style="display:none;">
            <td style="text-align: center; padding-top: 15px;">
                <input required form="AddWork" id="Date" maxlength="100" style="width:140px;" name="Date[]" type="date" class="inputC2" placeholder="Date">
            </td>
            <td align="center" style="padding-top: 15px;">
                <input required form="AddWork" id="Debut" maxlength="100" name="Debut[]" type="time" class="inputC2" placeholder="Nombre d'heures">
            </td>
            <td align="left" style="padding-top: 15px;">
                <input name="plus" type="button" value="+" onclick="AddWorkingTime()">
                <input name="moins" type="button" value="-" onclick="RmWorkingTime()">
            </td>
        </tr>
        <tr id="placeholder_row_bottom"></tr>
    </form>
    <!-- Changement Etat Chantier -->
    <form method="post" action="chantierAdd.php" name="Chantier" formtype="1" colvalue="2">
        <tr id="Chang-Etat" style="display:none;">
            <input type="hidden" name="NumC" value="<?php echo $donnees['CHA_NumDevis']; ?>">
            <td style="text-align: center; padding-top: 35px;">
                <label>Etat : </label>
            </td>
            <td align="center" style="padding-top: 35px;">
                <div class="selectType">
                    <select name="EtatA" onchange="showFin(this)">
                        <?php
                        $reponse4 = mysqli_query($db, "SELECT * FROM TypeEtat WHERE TYE_Id>$IdEtat ORDER BY TYE_Id");
                        while ($donnees4 = mysqli_fetch_assoc($reponse4))
                        {
                            ?>
                            <option value="<?php echo $donnees4['TYE_Id']; ?>"><?php echo $donnees4['TYE_Nom']; ?></option>
                        <?php
                        }
                        mysqli_free_result($reponse4);
                        ?>
                    </select>
                </div>
            </td>
            <td align="left" style="padding-top: 35px;">
                <input name="submit" type="submit" value="Changer">
            </td>
        </tr>
        <tr id="Chang-Etat2" style="display:none;">
            <td style="text-align: center; padding-top: 15px;">
                <label>Date de Fin : </label>
            </td>
            <td align="center" style="padding-top: 15px;">
                <input id="DateFin" maxlength="255" name="DateFin" type="date" class="inputC">
            </td>
            <td align="left" style="padding-top: 15px;">
                &nbsp;
            </td>
        </tr>
    </form>
</table>
<!-- List Tps Travail -->
<?php
$graphTpsOK = 0;
$totalHh = 0;
if (mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM TempsTravail WHERE CHA_NumDevis='$num'"))) {
    ?>
    <div style="margin-top: 15px;" id="labelCat">
        Liste des Heures de Travail
    </div>
    <div class="listeClients" style="margin-bottom: 15px;">
        <table cellpadding="5">
            <thead>
            <tr>
                <td class="firstCol" style="text-align: center; width: 600px;">
                    <a>Membre</a>
                </td>
                <td style="text-align: center; width: 200px;">
                    <a>Date</a>
                </td>
                <td style="text-align: center; width: 200px;">
                    <a>Durée</a>
                </td>
            </tr>
            </thead>
            <tbody>
            <?php
            $reponse3 = mysqli_query($db, "SELECT * FROM TempsTravail ttps JOIN Salaries sal ON ttps.SAL_NumSalarie=sal.SAL_NumSalarie JOIN Personnes pe ON pe.PER_Num=sal.PER_Num WHERE ttps.CHA_NumDevis='$num' ORDER BY ttps.TRA_Date ASC");
            while ($donnees3 = mysqli_fetch_assoc($reponse3))
            {
                ?>
                <tr style="font-size: 14;">
                    <td><?php echo formatUP($donnees3['PER_Nom']); ?> <?php echo formatLOW($donnees3['PER_Prenom']); ?></td>
                    <td><?php echo dater($donnees3['TRA_Date']); ?></td>
                    <td><?php echo $donnees3['TRA_Duree']; ?></td>
                </tr>
            <?php
            }
            mysqli_free_result($reponse3);
            $reponse4 = mysqli_query($db, "SELECT TIME(SUM(TRA_Duree)) as total FROM TempsTravail ttps WHERE ttps.CHA_NumDevis='$num' GROUP BY CHA_NumDevis");
            $donnees4 = mysqli_fetch_assoc($reponse4)
            ?>
            <tr style="font-size: 14;">
                <td></td>
                <td style="font-weight: bold;">Heures Totales : </td>
                <td style="font-weight: bold;"><?php echo $donnees4['total']; $totalHh = $donnees4['total'];?></td>
            </tr>
            </tbody>
        </table>
    </div>
<!--    <h style="padding-left: 12px; text-decoration: underline; color: #008000;">Evolution des heures de travail :</h>-->
    <!-- Graph Tps Travail -->
<!--    <div id="HoursEvolution" style="height: 400px;"></div>-->
    <!-- List Achats -->
    <?php
    $reponseT = mysqli_query($db, "SELECT CHA_TxHoraire FROM Chantiers WHERE CHA_NumDevis='$num'");
    $donneesT = mysqli_fetch_assoc($reponseT);

    mysqli_free_result($reponse4);
    $graphTpsOK = 1;
}
$montantHeure = 0;
$resteHeure = 0;
if(!empty($donneesT['CHA_TxHoraire'])){
    $montantHeure = $donneesT['CHA_TxHoraire']*$totalHh;
}
$resteHeure = $Hmax-$totalHh;
$totAchat = 0;
$graphMntOK = 0;
if (mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM Acheter JOIN Produits USING (PRO_Ref) WHERE CHA_NumDevis='$num'"))) {

    ?>
    <div id="labelCat">
        Liste des Achats
    </div>
    <div class="listeMembers" style="margin-bottom: 15px;">
        <table cellpadding="5">
            <thead>
            <tr>
                <td class="firstCol" style="text-align: center; width: 600px;">
                    <a>Produit</a>
                </td>
                <td style="text-align: center; width: 200px;">
                    <a>Date</a>
                </td>
                <td style="text-align: center; width: 200px;">
                    <a>Montant</a>
                </td>
            </tr>
            </thead>
            <tbody>
            <?php

            $reponse5 = mysqli_query($db, "SELECT * FROM Acheter JOIN Produits USING (PRO_Ref) JOIN Fournisseurs USING (FOU_NumFournisseur) JOIN Personnes USING (PER_Num) WHERE CHA_NumDevis='$num' ORDER BY ACH_Date ASC");
            while ($donnees5 = mysqli_fetch_assoc($reponse5))
            {
                ?>
                <tr style="font-size: 14;">
                    <td><?php echo formatLOW($donnees5['PRO_Nom']); ?> (<?php echo formatLOW($donnees5['ACH_TypeAchat']); ?>) <span style="float: right;">Fournisseur : <?php echo formatUP($donnees5['PER_Nom'])." ".formatLOW($donnees5['PER_Prenom']); ?></span></td>
                    <td><?php echo dater($donnees5['ACH_Date']); ?></td>
                    <td><?php echo $donnees5['ACH_Montant']." €"; $totAchat += $donnees5['ACH_Montant']; ?></td>
                </tr>
            <?php
            }
            mysqli_free_result($reponse5);
            ?>
            <tr style="font-size: 14;">
                <td></td>
                <td style="font-weight: bold;">Montant Total : </td>
                <td style="font-weight: bold;"><?php echo $totAchat; ?> €</td>
            </tr>
            </tbody>
        </table>
    </div>
<!--    <h style="padding-left: 12px; text-decoration: underline; color: #1A89D3;">Evolution des achats :</h>-->
    <!-- Graph Achats -->
<!--    <div id="ProductEvolution" style="height: 400px;"></div>-->
    <?php
    $graphMntOK = 1;
}
mysqli_free_result($reponse);
?>
</div>
<script type="text/javascript">
    window.onload=function(){
        // Affiche heure restant et montant des heures dans le haut de la page
        <?php if ($resteHeure < 0) { ?>
        document.getElementById('heureRestante').innerHTML = "Depassé de <?php echo -$resteHeure; ?>h";
        <?php }else{ ?>
        document.getElementById('heureRestante').innerHTML = "<?php echo $resteHeure; ?>h";
        <?php } ?>
        //document.getElementById('heureMontant').innerHTML = "<?php echo $montantHeure; ?> €";
        document.getElementById('achatRestant').innerHTML = "<?php echo $MontantMax-$totAchat; ?> €";


        var state = "<?php echo $IdEtat; $croissance = 0; ?>";
        document.getElementById('stateOfSite').style.color = 'white';
        switch (state) {
            case "1":
                document.getElementById('stateOfSite').style.backgroundColor = '#797979';
                break;
            case "2":
                document.getElementById('stateOfSite').style.backgroundColor = '#13AB0E';
                break;
            case "3":
                document.getElementById('stateOfSite').style.backgroundColor = '#FFF300';
                document.getElementById('stateOfSite').style.color = 'black';
                break;
            case "4":
                document.getElementById('stateOfSite').style.backgroundColor = '#0E52AB';
                break;
            case "5":
                document.getElementById('stateOfSite').style.backgroundColor = '#D50000';
                break;
        }
        <?php if ($graphTpsOK == 1) { ?>
        Morris.Line({
            element: 'HoursEvolution',
            data: [
                <?php
                $i = 0;
                $hourTable[0] = 0;
                $dateTable[0] = 0;
                $reponse5 = mysqli_query($db, "SELECT * FROM TempsTravail ttps JOIN Salaries sal ON ttps.SAL_NumSalarie=sal.SAL_NumSalarie JOIN Personnes pe ON pe.PER_Num=sal.PER_Num WHERE ttps.CHA_NumDevis='$num' ORDER BY ttps.TRA_Date ASC");
                while ($donnees5 = mysqli_fetch_assoc($reponse5))
                {
                    $hourTable[$i] = $donnees5['TRA_Duree'];
                    $dateTable[$i] = $donnees5['TRA_Date'];
                    $i++;
              }
              mysqli_free_result($reponse5);

              $sommeTable[0] = $hourTable[0];
              $distinctDate[0] = $dateTable[0];
              $k = 0;


              for ($j = 1; $j < $i; $j++) {
                  if ($dateTable[$j] == $dateTable[$j-1]) {
                      $sommeTable[$k] = $sommeTable[$k] + $hourTable[$j];
                  }
                  else {
                      $k++;
                      $sommeTable[$k] = $hourTable[$j];
                      $distinctDate[$k] = $dateTable[$j];
                  }
              }

              for ($i = 0; $i < $k+1; $i++) {?>
                { y: '<?php echo $distinctDate[$i]; ?>', a: <?php $croissance = $croissance + $sommeTable[$i]; echo $croissance; ?>},
                <?php
                }
                ?>
            ],
            xkey: 'y',
            ykeys: ['a'],
            labels: ['Nombre d\'heures'],
            goals: [<?php echo $Hmax; ?>],
            goalLineColors: ['Red'],
            goalStrokeWidth: 4,
            lineColors: ['green']
        });
        <?php } ?>
        var current = <?php if($croissance!=""){echo $croissance;}else{echo "0";} ?>;
        var maxxx = <?php echo $Hmax; ?>;
        if (maxxx<current) {
            //document.getElementById('hoursOnSite').style.backgroundColor = 'red';
            //document.getElementById('hoursOnSite').style.color = 'white';
        }
        else {
            //document.getElementById('hoursOnSite').style.backgroundColor = 'green';
            //document.getElementById('hoursOnSite').style.color = 'white';
        }
        <?php if ($graphMntOK == 1) {?>
        Morris.Line({
            element: 'ProductEvolution',
            data: [
                <?php
                $achats = 0;
                $i = 0;
                $buyTable[0] = 0;
                $calTable[0] = 0;
                $reponse5 = mysqli_query($db, "SELECT * FROM Acheter JOIN Produits USING (PRO_Ref) WHERE CHA_NumDevis='$num' ORDER BY ACH_Date ASC");
                while ($donnees5 = mysqli_fetch_assoc($reponse5))
                {
                    $buyTable[$i] = $donnees5['ACH_Montant'];
                        $calTable[$i] = $donnees5['ACH_Date'];
                        $i++;
                }
                    mysqli_free_result($reponse5);

                    $sumTable[0] = $buyTable[0];
                    $distinctCal[0] = $calTable[0];
                    $k = 0;

                    for ($j = 1; $j < $i; $j++) {
                        if ($calTable[$j] == $calTable[$j-1]) {
                            $sumTable[$k] = $sumTable[$k] + $buyTable[$j];
                        }
                        else {
                            $k++;
                            $sumTable[$k] = $buyTable[$j];
                            $distinctCal[$k] = $calTable[$j];
                        }
                    }

                    for ($i = 0; $i < $k+1; $i++) {
                ?>
                { y: '<?php echo $distinctCal[$i]; ?>', a: <?php $achats = $achats + $sumTable[$i]; echo $achats; ?>},
                <?php
                    }
                ?>
            ],
            xkey: 'y',
            ykeys: ['a'],
            labels: ['Montant'],
            goals: [<?php echo $MontantMax; ?>],
            goalLineColors: ['Red'],
            goalStrokeWidth: 4,
            lineColors: ['#1A89D3']
        });
        <?php } ?>
    };
</script>
<?php
include('footer.php');
?>
<script type="text/javascript">
    var buttonCount = 1;
    // Add tps travail form ++ (detailChantier)
    function AddWorkingTime()
    {
        // conversion php array to js array
        var jWorkers= <?php echo json_encode($Workers); ?>;
        var jIds= <?php echo json_encode($Ids); ?>;

        // structure html tr/td/div
        var table = document.getElementById("downT");
        var NewRow = table.insertRow(4);
        NewRow.id = "Ajout-Tps"+buttonCount;
        NewRow.setAttribute("style", "display:;")

        var NewCell1 = NewRow.insertCell(0);
        NewCell1.setAttribute("style","text-align: center; padding-top: 35px;");
        NewCell1.innerHTML = "<label>Membres : </label>";

        var NewCell2 = NewRow.insertCell(1);
        NewCell2.setAttribute("style","padding-top: 35px;");
        NewCell2.setAttribute("align","center");

        var NewDiv = document.createElement("div");
        NewDiv.setAttribute("class","selectType");

        // insertion array in select option via tmp
        tmp = '<select required form="AddWork" name="Member[]">\n<option></option>\n<optgroup label="Stagiaires"> ';
        for (var i in jWorkers) {
            tmp += '<option value="'+jIds[i]+'">'+jWorkers[i]+"</option>\n";
            if (i == <?php echo $limitOpt; ?>) {
                tmp += '</optgroup>\n<optgroup label="Salariés en Insertion">';
            }
        }
        tmp += "</optgroup>\n</select>";

        NewDiv.innerHTML = tmp;

        NewCell2.appendChild(NewDiv);

        var NewCell3 = NewRow.insertCell(2);
        NewCell3.setAttribute("style","padding-top: 35px;");
        NewCell3.setAttribute("align","center");

        // next tr
        var NewRow2 = table.insertRow(5);
        NewRow2.id = "Ajout-Tpss"+buttonCount;
        NewRow2.setAttribute("style", "display:;")

        var NewCell4 = NewRow2.insertCell(0);
        NewCell4.setAttribute("style","text-align: center; padding-top: 15px;");

        /*var NewDiv2 = document.createElement("div");

         var input1 = document.createElement("input");
         input1.type = "date";
         input1.name = "Date[]";
         NewDiv2.appendChild(input1);
         NewCell4.appendChild(NewDiv2);*/

        NewCell4.innerHTML = '<input required form="AddWork" id="Date" style="width:140px;" maxlength="100" name="Date[]" type="date" class="inputC2" placeholder="Date">';

        var NewCell5 = NewRow2.insertCell(1);
        NewCell5.setAttribute("style","text-align: center; padding-top: 15px;");
        NewCell5.innerHTML = '<input required form="AddWork" id="Debut" maxlength="100" name="Debut[]" type="time" class="inputC2" placeholder="Nombre dheures">';

        var NewCell6 = NewRow2.insertCell(2);
        NewCell6.setAttribute("style","padding-top: 35px;");
        NewCell6.setAttribute("align","center");

        /*var AllDiv = document.createElement("div");
         AllDiv.appendChild(NewRow);
         AllDiv.appendChild(NewRow2);*/

        buttonCount++;
    }
    // Remove tps travail form -- (detailChantier)
    function RmWorkingTime()
    {
        if (buttonCount > 1) {
            $("#placeholder_row_bottom").prev().remove();
            buttonCount--;
            $("#placeholder_row_bottom").prev().remove();
        }
    }
</script>
<script>
    $(function() {
        $(function() {
            var progressbar = $( "#progressbar" ),
                progressLabel = $( ".progress-label" );

            progressbar.progressbar({
                value: <?php echo round($croissance*100/$Hmax, 2) ; ?>,
            });
            <?php if ($croissance*100/$Hmax > 100) {?>
            progressLabel.text( "<?php echo round($croissance*100/$Hmax, 2) ; ?> %" );
            <?php } else { ?>
            progressLabel.text( progressbar.progressbar( "value" ) + "%" );
            <?php }?>

        });
        $(function() {
            var progressbar = $( "#progressbar2" ),
                progressLabel = $( ".progress-label2" );

            progressbar.progressbar({
                value: <?php echo round($totAchat*100/$MontantMax, 2) ; ?>,
            });
            <?php if ($totAchat*100/$MontantMax > 100) {?>
            progressLabel.text( "<?php echo round($totAchat*100/$MontantMax, 2) ; ?> %" );
            <?php } else { ?>
            progressLabel.text( progressbar.progressbar( "value" ) + "%" );
            <?php }?>

        });
    });
</script>
<style>
    #progressbar .ui-progressbar-value {
    <?php if ($croissance*100/$Hmax > 100) {?>
        background-color: #EB0C0C;
    <?php } else { ?>
        background-color: #2FB044;
    <?php }?>
    }
    #progressbar2 .ui-progressbar-value {
    <?php if ($totAchat*100/$MontantMax > 100) {?>
        background-color: #E00B0B;
    <?php } else { ?>
        background-color: #2F72B0;
    <?php }?>
    }
    .ui-progressbar {
        position: relative;
    }
    .progress-label {
        position: absolute;
        right: 35%;
        font-weight: bold;
        font-size: 12px;
    <?php if ($croissance*100/$Hmax > 50) {?>
        color: #fff;
        text-shadow: 1px 1px 0 #000;
    <?php } else { ?>
        color: #000;
        text-shadow: 1px 1px 0 #fff;
    <?php }?>
    }
    .ui-progressbar2 {
        position: relative;
    }
    .progress-label2 {
        position: absolute;
        right: 35%;
        font-weight: bold;
        font-size: 12px;
    <?php if ($totAchat*100/$MontantMax > 50) {?>
        color: #fff;
        text-shadow: 1px 1px 0 #000;
    <?php } else { ?>
        color: #000;
        text-shadow: 1px 1px 0 #fff;
    <?php }?>

    }
</style>