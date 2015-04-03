<?php
$pwd='../';
include('../bandeau.php');
?>
    <div id="corps">
    <?php
    // Edition personne en insertion
    $num = $_POST["NumC"];
    $actif = 1;
    $fonct = 0;
    $type = addslashes($_POST["Type"]);
    $dateEntretien = addslashes($_POST["Entretien"]);
    $nom = addslashes(mysqli_real_escape_string($db, formatUP($_POST["Nom"])));
    $prenom = addslashes(mysqli_real_escape_string($db, formatLOW($_POST["Prenom"])));
    $dateN = addslashes($_POST["DateNai"]);
    $nation = addslashes(mysqli_real_escape_string($db, formatUP($_POST["Nationalite"])));
    $lieuN = addslashes(mysqli_real_escape_string($db, formatUP($_POST["LieuNai"])));
    $situationF = addslashes(mysqli_real_escape_string($db, formatUP($_POST["Situation"])));
    $tel = addslashes(mysqli_real_escape_string($db, $_POST["Tel_Fixe"]));
    $port = addslashes(mysqli_real_escape_string($db, $_POST["Portable"]));
    $fax = addslashes(mysqli_real_escape_string($db, $_POST["Fax"]));
    $email = addslashes(mysqli_real_escape_string($db, $_POST["Email"]));
    $add = addslashes(mysqli_real_escape_string($db, formatLOW($_POST["Adresse"])));
    $cp = addslashes($_POST["Code_Postal"]);
    $ville = addslashes(mysqli_real_escape_string($db, formatUP($_POST["Ville"])));
    $nPoleEmploi = addslashes($_POST["N_Pole"]);
    $nSecu = addslashes($_POST["N_Secu"]);
    $nCaf = addslashes($_POST["N_CAF"]);
    $numRef = addslashes($_POST["Ref"]);
    $convention = addslashes($_POST["Convention"]);
    $nbJours = addslashes($_POST["Jours"]);
    $dateEntree = addslashes($_POST["Entree"]);
    $contrat = addslashes($_POST["Contrat"]);
    $nbHeures = addslashes($_POST["N_Heures"]);
    $nivScol = addslashes($_POST["Niveau"]);
    $recoTH = addslashes($_POST["Reconnaissance"]);
    $diplome = addslashes($_POST["Diplome"]);
    $permis = addslashes($_POST["Permis"]);
    $revenu = addslashes($_POST["Revenus-Type"]);
    $PEDepuis = addslashes($_POST["Inscrit-Pole"]);
    $positionement = addslashes($_POST["CAP"]);
    $situGeo = addslashes($_POST["Situation-Geo"]);
    $revenuDepuis = addslashes($_POST["Revenus-Durée"]);
    $SEDepuis = addslashes($_POST["Sans-Emploi"]);
    $mutuelle = addslashes($_POST["Mutuelle"]);
    $repas = addslashes($_POST["Repas"]);
    if(addslashes($_POST["DateSortie"])==null){
        $dateSortie = "0000-00-00";
    } else {
        $dateSortie = addslashes($_POST["DateSortie"]);
        $actif=0;
    }
    $typeSortie = addslashes($_POST["TypeSortie"]);

    $queryPerMax = mysqli_query($db, "SELECT MAX(PER_Num) as maxi FROM Personnes");
    $resultPerMax = mysqli_fetch_assoc($queryPerMax);
    $perMax = $resultPerMax['maxi'] + 1;

    $editPersonne = "UPDATE Personnes SET PER_Nom='$nom', PER_Prenom='$prenom', PER_TelFixe='$tel',
                         PER_TelPort='$port', PER_Fax='$fax', PER_Email='$email', PER_Adresse='$add',
                         PER_CodePostal='$cp', PER_Ville='$ville' WHERE PER_Num='$num'";
    $sql2 = mysqli_query($db, $editPersonne);
    $errr2 = mysqli_error($db);

    if ($sql2) {

        $editSal = "UPDATE Salaries set TYP_Id='$type', SAL_Actif='$actif' WHERE PER_Num='$num'";
        $sql = mysqli_query($db, $editSal);
        $errr = mysqli_error($db);

        if ($sql) {
            $editIns = "UPDATE Insertion SET INS_DateEntretien='$dateEntretien', INS_DateN='$dateN', INS_LieuN='$lieuN',
                              INS_Nation='$nation', INS_SituationF='$situationF', INS_NPoleEmp='$nPoleEmploi', INS_NSecu='$nSecu',
                              INS_NCaf='$nCaf', INS_NivScol='$nivScol', INS_Diplome='$diplome', INS_Permis='$permis',
                              INS_RecoTH='$recoTH', INS_Revenu='$revenu', INS_Mutuelle='$mutuelle', CNV_Id='$convention',
                              CNT_Id='$contrat', INS_DateEntree='$dateEntree', INS_NbHeures='$nbHeures', INS_NbJours='$nbJours',
                              INS_RevenuDepuis='$revenuDepuis', INS_SEDepuis='$SEDepuis', INS_PEDupuis='$PEDepuis',
                              INS_Repas='$repas', INS_Positionmt='$positionement', INS_SituGeo='$situGeo', REF_NumRef='$numRef',
                              INS_DateSortie='$dateSortie', TYS_ID='$typeSortie'
                              WHERE SAL_NumSalarie IN (select SAL_NumSalarie from Salaries WHERE PER_Num='$num')";
            $sql3 = mysqli_query($db, $editIns);
            $errr = mysqli_error($db);

            if ($sql3) {
                echo '<div id="good">
        <label>Edité avec succès</label>
        </div>';
                $reponse0 = mysqli_query($db,"select SAL_NumSalarie from Salaries WHERE PER_Num='$num'");
                $reponse0 = mysqli_fetch_assoc($reponse0);
                $num = $reponse0['SAL_NumSalarie'];

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
                            <td style="text-align: left; width: 300px;"><?php echo $typeSortie['TYS_Libelle'] ?></td>
                        </tr>
                    </table>
                </td>
                </tr>
                </table>
                <form method="post" action="membre/editIns.php" name="EditIns">
                    <input type="hidden" name="NumC" value="<?php echo $num; ?>">
                    <table id="downT">
                        <tr>
                            <td>
              <span>
                <input name="submit" type="submit" value="Modifier" class="buttonC">
              </span>
                            </td>
                        </tr>
                    </table>
                </form>
                <?php

                mysqli_free_result($reponse0);
                mysqli_free_result($reponse1);
                mysqli_free_result($reponse2);
                mysqli_free_result($reponse3);
                mysqli_free_result($reponse4);
                mysqli_free_result($reponse5);

            } else {
                echo '
            <div id="bad">
                <label>3 Le Salarié n\'a pas pu être édité</label>
            </div>';
            }
        } else {
            echo '
            <div id="bad">
                <label>Le Salarié n\'a pas pu être édité</label>
            </div>';
        }
    } else {
        echo '
            <div id="bad">
                <label>Le Salarié n\'a pas pu être édité</label>
            </div>';
    }?>
    </div>
<?php
include('../footer.php');
?>