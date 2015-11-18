<?php
$pageTitle = "Detail Salarié en insertion";
$pwd = '../../';
include('../../bandeau.php');
?>
    <div id="corps">
    <?php
    $num = intval($_GET["NumC"]);
    if (is_numeric($_GET["NumC"])) {

        $reponse1 = mysqli_query($db,
            "SELECT * FROM Personnes JOIN Salaries USING (PER_Num) JOIN Insertion USING (SAL_NumSalarie)
                WHERE SAL_NumSalarie='$num' ORDER BY PER_Nom");
        $personne = mysqli_fetch_assoc($reponse1);

        $numSortie = $personne['TYS_ID'];
        $reponse0 = mysqli_query($db, "SELECT * FROM TypeSortie WHERE TYS_ID='$numSortie' ORDER BY TYS_Libelle");
        $typeSortie = mysqli_fetch_assoc($reponse0);

        $numConv = $personne['CNV_Id'];
        $reponse2 = mysqli_query($db, "SELECT * FROM Convention WHERE CNV_Id='$numConv' ORDER BY CNV_Nom");
        $convention = mysqli_fetch_assoc($reponse2);

        $numContrat = $personne['CNT_Id'];
        $reponse3 = mysqli_query($db, "SELECT * FROM Contrat WHERE CNT_Id='$numContrat' ORDER BY CNT_Nom");
        $contrat = mysqli_fetch_assoc($reponse3);

        $numRef = $personne['REF_NumRef'];
        $reponse4 = mysqli_query($db, "SELECT * FROM Personnes JOIN Referents USING (PER_Num) JOIN Prescripteurs USING (PRE_Id) WHERE PER_Num in (SELECT PER_Num FROM Referents WHERE REF_NumRef='$numRef')");
        $referent = mysqli_fetch_assoc($reponse4);

        $numType = $personne['TYP_Id'];
        $reponse5 = mysqli_query($db, "SELECT * FROM Type WHERE TYP_Id='$numType'");
        $type = mysqli_fetch_assoc($reponse5);

        if ($personne) {
            ?>
            <div id="labelT">
                <label>Detail <?php echo $type['TYP_Nom']; ?></label>
            </div>
            <br>
            <table id="fullTable" rules="all">
            <tr>
            <td>
                <table cellpadding="10" class="detailClients">
                    <tr>
                        <th style="text-align: left; width: 200px; white-space: normal;">Date de l'entretien
                            :
                        </th>
                        <td style="text-align: left; width: 300px;"><?php echo dater($personne['INS_DateEntretien']); ?></td>
                    </tr>
                    <tr>
                        <th style="text-align: left; width: 200px; white-space: normal;">Nom :</th>
                        <td style="text-align: left; width: 300px;"><?php echo $personne['PER_Nom']; ?></td>
                    </tr>
                    <tr>
                        <th style="text-align: left; width: 200px; white-space: normal;">Date de naissance
                            :
                        </th>
                        <td style="text-align: left; width: 300px;"><?php echo dater($personne['INS_DateN']); ?></td>
                    </tr>
                    <tr>
                        <th style="text-align: left; width: 200px; white-space: normal;">Nationalité :
                        </th>
                        <td style="text-align: left; width: 300px;"><?php echo $personne['INS_Nation']; ?></td>
                    </tr>
                    <tr>
                        <td colspan="2">&nbsp;</td>
                    </tr>
                    <tr>
                        <th style="text-align: left; width: 200px; white-space: normal;">Adresse :
                        </th>
                        <td style="text-align: left; width: 300px;"><?php echo formatLOW($personne['PER_Adresse']); ?></td>
                    </tr>
                    <tr>
                        <th style="text-align: left; width: 200px; white-space: normal;">Ville :</th>
                        <td style="text-align: left; width: 300px;"><?php echo formatUP($personne['PER_Ville']); ?></td>
                    </tr>
                    <tr>
                        <th style="text-align: left; width: 200px; white-space: normal;">Téléphone Fixe :
                        </th>
                        <td style="text-align: left; width: 300px;"><?php echo $personne['PER_TelFixe']; ?></td>
                    </tr>
                    <tr>
                        <th style="text-align: left; width: 200px; white-space: normal;">Téléphone Portable
                            :
                        </th>
                        <td style="text-align: left; width: 300px;"><?php echo $personne['PER_TelPort']; ?></td>
                    </tr>
                    <tr>
                        <th style="text-align: left; width: 200px; white-space: normal;">Fax :</th>
                        <td style="text-align: left; width: 300px;"><?php echo $personne['PER_Fax']; ?></td>
                    </tr>
                    <tr>
                        <td colspan="2">&nbsp;</td>
                    </tr>
                    <tr>
                        <th style="text-align: left; width: 200px; white-space: normal;">Référent identifié :
                        </th>
                        <td style="text-align: left; width: 300px;"><?php echo formatUP($referent['PER_Nom']) . ' ' . formatLow($referent['PER_Prenom']); ?></td>
                    </tr>
                    <tr>
                        <th style="text-align: left; width: 200px; white-space: normal;">Prescripteur :
                        </th>
                        <td style="text-align: left; width: 300px;"><?php echo $referent['PRE_Nom']; ?></td>
                    </tr>
                    <tr>
                        <th style="text-align: left; width: 200px; white-space: normal;">Convention :
                        </th>
                        <td style="text-align: left; width: 300px;"><?php echo $convention['CNV_Nom']; ?></td>
                    </tr>
                    <tr>
                        <th style="text-align: left; width: 200px; white-space: normal;">Jours Travaillés :</th>
                        <td style="text-align: left; width: 300px;"><?php echo $personne['INS_NbJours']; ?></td>
                    </tr>
                    <tr>
                        <td colspan="2">&nbsp;</td>
                    </tr>
                    <tr>
                        <th style="text-align: left; width: 200px; white-space: normal;">Niveau scolaire :</th>
                        <td style="text-align: left; width: 300px;"><?php echo $personne['INS_NivScol']; ?></td>
                    </tr>
                    <tr>
                        <th style="text-align: left; width: 200px; white-space: normal;">Reconnaissance TH :
                        </th>
                        <td style="text-align: left; width: 300px;">
                            <?php
                            if ($personne['INS_RecoTH'] == 0) {
                                echo "Non";
                            } else {
                                echo "Oui";
                            }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">&nbsp;</td>
                    </tr>
                    <tr>
                        <th style="text-align: left; width: 200px; white-space: normal;">Revenus :
                        </th>
                        <td style="text-align: left; width: 300px;"><?php echo $personne['INS_Revenu']; ?></td>
                    </tr>
                    <tr>
                        <th style="text-align: left; width: 200px; white-space: normal;">Pôle Emploi depuis :
                        </th>
                        <td style="text-align: left; width: 300px;"><?php echo $personne['INS_PEDupuis']; ?></td>
                    </tr>
                    <tr>
                        <th style="text-align: left; width: 200px; white-space: normal;">Positionnement CAP :
                        </th>
                        <td style="text-align: left; width: 300px;"><?php echo $personne['INS_Positionmt']; ?></td>
                    </tr>
                    <tr>
                        <th style="text-align: left; width: 200px; white-space: normal;">Situation géo :</th>
                        <td style="text-align: left; width: 300px;"><?php echo $personne['INS_SituGeo']; ?></td>
                    </tr>
                    <tr>
                        <td colspan="2">&nbsp;</td>
                    </tr>
                    <tr>
                        <th style="text-align: left; width: 200px; white-space: normal;">Date de sortie :</th>
                        <td style="text-align: left; width: 300px;">
                            <?php if (($personne['INS_DateSortie'] == null) || $personne['INS_DateSortie'] == "0000-00-00") {
                                echo "Non sorti";
                            } else {
                                echo dater($personne['INS_DateSortie']);
                            }?>
                        </td>
                    </tr>
                </table>
            </td>
            <td>
                <table cellpadding="10" class="detailClients">
                    <tr>
                        <th style="text-align: left; width: 200px; white-space: normal;">Type :</th>
                        <td style="text-align: left; width: 300px;"><?php echo $type['TYP_Nom']; ?>
                        </td>
                    </tr>
                    <tr>
                        <th style="text-align: left; width: 200px; white-space: normal;">Prénom :</th>
                        <td style="text-align: left; width: 300px;"><?php echo $personne['PER_Prenom']; ?></td>
                    </tr>
                    <tr>
                        <th style="text-align: left; width: 200px; white-space: normal;">Lieu de naissance
                            :
                        </th>
                        <td style="text-align: left; width: 300px;"><?php echo $personne['INS_LieuN']; ?></td>
                    </tr>
                    <tr>
                        <th style="text-align: left; width: 200px; white-space: normal;">Situation familiale
                            :
                        </th>
                        <td style="text-align: left; width: 300px;"><?php echo $personne['INS_SituationF']; ?></td>
                    </tr>
                    <tr>
                        <td colspan="2">&nbsp;</td>
                    </tr>
                    <tr>
                        <th style="text-align: left; width: 200px; white-space: normal;">Code Postal :</th>
                        <td style="text-align: left; width: 300px;"><?php echo $personne['PER_CodePostal']; ?></td>
                    </tr>
                    <tr>
                        <th style="text-align: left; width: 200px; white-space: normal;">Email :</th>
                        <td style="text-align: left; width: 300px;"><A
                                HREF="mailto:<?php echo $personne['PER_Email']; ?>"> <?php echo $personne['PER_Email']; ?></A>
                        </td>
                    </tr>
                    <tr>
                        <th style="text-align: left; width: 200px; white-space: normal;">N° Pôle Emploi :
                        </th>
                        <td style="text-align: left; width: 300px;"><?php echo $personne['INS_NPoleEmp']; ?></td>
                    </tr>
                    <tr>
                        <th style="text-align: left; width: 200px; white-space: normal;">N° Sécurité Sociale
                            :
                        </th>
                        <td style="text-align: left; width: 300px;"><?php echo $personne['INS_NSecu']; ?></td>
                    </tr>
                    <tr>
                        <th style="text-align: left; width: 200px; white-space: normal;">N° CAF :
                        </th>
                        <td style="text-align: left; width: 300px;"><?php echo $personne['INS_NCaf']; ?></td>
                    </tr>
                    <tr>
                        <td colspan="2">&nbsp;</td>
                    </tr>
                    <tr>
                        <td colspan="2">&nbsp;</td>
                    </tr>
                    <tr>
                        <th style="text-align: left; width: 200px; white-space: normal;">Date d'entrée :
                        </th>
                        <td style="text-align: left; width: 300px;"><?php echo dater($personne['INS_DateEntree']); ?></td>
                    </tr>
                    <tr>
                        <th style="text-align: left; width: 200px; white-space: normal;">Type de contrat :
                        </th>
                        <td style="text-align: left; width: 300px;"><?php echo $contrat['CNT_Nom']; ?></td>
                    </tr>
                    <tr>
                        <th style="text-align: left; width: 200px; white-space: normal;">Nombre d'heures :</th>
                        <td style="text-align: left; width: 300px;"><?php echo $personne['INS_NbHeures']; ?></td>
                    </tr>
                    <tr>
                        <td colspan="2">&nbsp;</td>
                    </tr>
                    <tr>
                        <th style="text-align: left; width: 200px; white-space: normal;">Diplôme :</th>
                        <td style="text-align: left; width: 300px;"><?php echo $personne['INS_Diplome']; ?></td>
                    </tr>
                    <tr>
                        <th style="text-align: left; width: 200px; white-space: normal;">Permis :
                        </th>
                        <td style="text-align: left; width: 300px;">
                            <?php
                            if ($personne['INS_Permis'] == 0) {
                                echo "Non";
                            } else {
                                echo "Oui";
                            }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">&nbsp;</td>
                    </tr>
                    <tr>
                        <th style="text-align: left; width: 200px; white-space: normal;">Depuis :</th>
                        <td style="text-align: left; width: 300px;"><?php echo $personne['INS_RevenuDepuis']; ?></td>
                    </tr>
                    <tr>
                        <th style="text-align: left; width: 200px; white-space: normal;">Sans emploi depuis :</th>
                        <td style="text-align: left; width: 300px;"><?php echo $personne['INS_SEDepuis']; ?></td>
                    </tr>
                    <tr>
                        <th style="text-align: left; width: 200px; white-space: normal;">Mutuelle :</th>
                        <td style="text-align: left; width: 300px;"><?php echo $personne['INS_Mutuelle']; ?></td>
                    </tr>
                    <tr>
                        <th style="text-align: left; width: 200px; white-space: normal;">Repas :
                        </th>
                        <td style="text-align: left; width: 300px;"><?php echo $personne['INS_Repas'] ?></td>
                    </tr>
                    <tr>
                        <td colspan="2">&nbsp;</td>
                    </tr>
                    <tr>
                        <th style="text-align: left; width: 200px; white-space: normal;">Type de sortie :
                        </th>
                        <td style="text-align: left; width: 300px;"><?php 
							if(!$typeSortie['TYS_Active']) echo "Attention ! Ancien type de sortie !<br/>";
							echo "n°".$typeSortie['TYS_ID']." &ndash; ".$typeSortie['TYS_Libelle']; 
						?></td>
                    </tr>
                </table>
            </td>
            </tr>
            </table>
            <form method="post" action="editIns.php" name="EditIns">
                <input type="hidden" name="NumC" value="<?php echo $num; ?>">
                <table id="downT">
                    <tr>
                        <td>
              <span>
                <input name="submit" type="submit" value="Modifier" class="buttonC">
                <input name="retour" type="button" value="Retour"   class="buttonC" onclick="javascript:submitListMember('<?php echo $numType; ?>');">
              </span>
                        </td>
                    </tr>
                </table>
            </form>
        <?php
        } else {
            echo "<div id='error'>ERROR : WRONG NUMBER</div>";
        }
    } else {
        echo "<div id='error'>ERROR : NUMBER ONLY</div>";
    }
    mysqli_free_result($reponse1);
    mysqli_free_result($reponse2);
    mysqli_free_result($reponse3);
    mysqli_free_result($reponse4);
    mysqli_free_result($reponse5);
    ?>
    </div>
<?php
include('../../footer.php');
?>