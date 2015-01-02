<?php
$pageTitle = "Ajout Membre en Insertion";
include('bandeau.php');
?>
    <div id="corps">
    <?php
    $num = $_POST["NumC"];
    $reponse1 = mysqli_query($db,
        "SELECT * FROM Personnes JOIN Salaries USING (PER_Num) JOIN Insertion USING (SAL_NumSalarie)
                WHERE SAL_NumSalarie='$num' ORDER BY PER_Nom");
    $personne = mysqli_fetch_assoc($reponse1);

    $numConv = $personne['CNV_Id'];
    $reponse2 = mysqli_query($db, "SELECT * FROM Convention WHERE CNV_Id='$numConv' ORDER BY CNV_Nom");
    $convention = mysqli_fetch_assoc($reponse2);

    $numContrat = $personne['CNT_Id'];
    $reponse3 = mysqli_query($db, "SELECT * FROM Contrat WHERE CNT_Id='$numContrat' ORDER BY CNT_Nom");
    $contrat = mysqli_fetch_assoc($reponse3);

    $numRef = $personne['REF_NumRef'];
    $reponse4 = mysqli_query($db, "SELECT * FROM Personnes JOIN Referents USING (PER_Num) WHERE PER_Num in (SELECT PER_Num FROM Referents WHERE REF_NumRef='$numRef')");
    $referent = mysqli_fetch_assoc($reponse4);

    $numType = $personne['TYP_Id'];
    $reponse5 = mysqli_query($db, "SELECT * FROM Type WHERE TYP_Id='$numType'");
    $type = mysqli_fetch_assoc($reponse5);
    ?>
    <div id="labelT">
        <label>Editer un Salarié en insertion</label>
    </div>
    <br>

    <form method="post" action="insertionPre.php" name="Insertion">
    <br/>
    <table align="left">
        <tr>
            <td style="vertical-align:top;">
                <table id="leftT" cellpadding="10">
                    <tr id="Contact-Entretien">
                        <td style="text-align: left; width: 150px; white-space: normal;">
                            <label for="Entretien">Date de l'entretien :</label>
                        </td>
                        <td>
                            <input id="Entretien" required name="Entretien" type="date" class="inputC"
                                   value="<?php echo $personne['INS_DateEntretien']; ?>">
                        </td>
                    </tr>
                    <tr id="Contact-Nom">
                        <td style="text-align: left; width: 150px; white-space: normal;">
                            <label for="Nom">Nom :</label>
                        </td>
                        <td>
                            <input id="Nom" required maxlength="255" name="Nom" type="text" class="inputC"
                                   autofocus="autofocus" value="<?php echo $personne['PER_Nom']; ?>">
                        </td>
                    </tr>
                    <tr id="Contact-DateNai">
                        <td style="text-align: left; width: 150px; white-space: normal;">
                            <label for="DateNai">Date de naissance :</label>
                        </td>
                        <td>
                            <input id="DateNai" name="DateNai" type="date" class="inputC"
                                   value="<?php echo $personne['INS_DateN']; ?>">
                        </td>
                    </tr>
                    <tr id="Contact-Nationalite">
                        <td style="text-align: left; width: 150px; white-space: normal;">
                            <label for="Nationalite">Nationalité :</label>
                        </td>
                        <td>
                            <input id="Nationalite" required maxlength="255" name="Nationalite" type="text"
                                   class="inputC" value="<?php echo $personne['INS_Nation']; ?>"
                                   autofocus="autofocus">
                        </td>
                    </tr>
                </table>
            <td style="vertical-align:top;">
                <table id="rightT" cellpadding="10">
                    <tr>
                        <td style="text-align: left; width: 150px;">
                            <label for="Type">Catégorie</label>
                        </td>
                        <td>
                            <div class="selectType">
                                <select id="Type" name="Type">
                                    <?php
                                    $reponse = mysqli_query($db, "SELECT * FROM Type WHERE TYP_Id > 5");
                                    while ($donnees = mysqli_fetch_assoc($reponse)) {
                                        ?>
                                        <option
                                            value="<?php echo $donnees['TYP_Id']; ?>"><?php echo $donnees['TYP_Nom']; ?></option>
                                    <?php
                                    }
                                    mysqli_free_result($reponse);
                                    ?>
                                </select>
                            </div>
                        </td>
                    </tr>
                    <tr id="Contact-Prenom">
                        <td style="text-align: left; width: 150px; white-space: normal;">
                            <label for="Prenom">Prénom :</label>
                        </td>
                        <td>
                            <input id="Prenom" maxlength="255" name="Prenom" type="text" class="inputC"
                                   value="<?php echo $personne['PER_Prenom']; ?>">
                        </td>
                    </tr>
                    <tr id="Contact-LieuNai">
                        <td style="text-align: left; width: 150px; white-space: normal;">
                            <label for="LieuNai">Lieu de naissance :</label>
                        </td>
                        <td>
                            <input id="LieuNai" required maxlength="255" name="LieuNai" type="text" class="inputC" value="<?php echo $personne['INS_LieuN']; ?>">
                        </td>
                    </tr>
                    <tr id="Contact-Situation">
                        <td style="text-align: left; width: 150px; white-space: normal;">
                            <label for="Situation">Situation familiale :</label>
                        </td>
                        <td>
                            <input id="Situation" maxlength="255" name="Situation" type="text" class="inputC" value="<?php echo $personne['INS_SituationF']; ?>">
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    <table align="left">
        <tr>
            <td style="vertical-align:top;">
                <table id="leftT" cellpadding="10">
                    <tr>
                        <td colspan="2">
                            &nbsp;&nbsp;
                        </td>
                    </tr>
                    <tr id="Contact-Adresse">
                        <td style="text-align: left; width: 150px; white-space: normal;">
                            <label for="Adresse">Adresse :</label>
                        </td>
                        <td>
                            <input id="Adresse" required maxlength="255" name="Adresse" type="text"
                                   class="inputC" value="<?php echo formatLOW($personne['PER_Adresse']); ?>">
                        </td>
                    </tr>
                    <tr id="Contact-Ville">
                        <td style="text-align: left; width: 150px; white-space: normal;">
                            <label for="Ville">Ville :</label>
                        </td>
                        <td>
                            <input id="Ville" required maxlength="255" name="Ville" type="text" class="inputC" value="<?php echo formatUP($personne['PER_Ville']); ?>">
                        </td>
                    </tr>
                    <tr id="Contact-Tel_Fixe">
                        <td style="text-align: left; width: 150px; white-space: normal;">
                            <label for="Tel_Fixe">Téléphone Fixe :</label>
                        </td>
                        <td>
                            <input id="Tel_Fixe" maxlength="255" name="Tel_Fixe" type="text" class="inputC" value="<?php echo $personne['PER_TelFixe']; ?>">
                        </td>
                    </tr>
                    <tr id="Contact-Portable">
                        <td style="text-align: left; width: 150px; white-space: normal;">
                            <label for="Portable">Téléphone Portable :</label>
                        </td>
                        <td>
                            <input id="Portable" maxlength="255" name="Portable" type="text" class="inputC" value="<?php echo $personne['PER_TelPort']; ?>">
                        </td>
                    </tr>
                    <tr id="Contact-Fax">
                        <td style="text-align: left; width: 150px; white-space: normal;">
                            <label for="Fax">Fax :</label>
                        </td>
                        <td>
                            <input id="Fax" maxlength="255" name="Fax" type="text" class="inputC" value="<?php echo $personne['PER_Fax']; ?>">
                        </td>
                    </tr>
                </table>
            <td style="vertical-align:top;">
                <table id="rightT" cellpadding="10">
                    <tr>
                        <td colspan="2">
                            &nbsp;&nbsp;
                        </td>
                    </tr>
                    <tr id="Contact-Code_Postal">
                        <td style="text-align: left; width: 150px; white-space: normal;">
                            <label for="Code_Postal">Code Postal :</label>
                        </td>
                        <td>
                            <input id="Code_Postal" required name="Code_Postal" pattern="^\d{5}$" type="text"
                                   value="<?php echo $personne['PER_CodePostal']; ?>"
                                   style="width:100px;background-color:#cde5f7;" maxlength="5">
                        </td>
                    </tr>
                    <tr id="Contact-Email">
                        <td style="text-align: left; width: 150px; white-space: normal;">
                            <label for="Email">Email :</label>
                        </td>
                        <td>
                            <input id="Email" maxlength="255" name="Email" type="text" class="inputC"
                                   title="exemple@exemple.com"
                                   pattern="^[a-zA-Z0-9\._-]+@[a-zA-Z0-9\._-]+\.[a-z]{2,3}$" value="<?php echo $personne['PER_Email']; ?>">
                        </td>
                    </tr>
                    <tr id="Contact-Pole">
                        <td style="text-align: left; width: 150px; white-space: normal;">
                            <label for="N_Pole">N° Pôle Emploi :</label>
                        </td>
                        <td>
                            <input id="N_Pole" maxlength="255" name="N_Pole" type="text" class="inputC" value="<?php echo $personne['INS_NPoleEmp']; ?>">
                        </td>
                    </tr>
                    <tr id="Contact-Secu">
                        <td style="text-align: left; width: 150px; white-space: normal;">
                            <label for="N_Secu">N° Sécurité sociale :</label>
                        </td>
                        <td>
                            <input id="N_Secu" maxlength="255" name="N_Secu" type="text" class="inputC" value="<?php echo $personne['INS_NSecu']; ?>">
                        </td>
                    </tr>
                    <tr id="Contact-CAF">
                        <td style="text-align: left; width: 150px; white-space: normal;">
                            <label for="N_CAF">N° CAF :</label>
                        </td>
                        <td>
                            <input id="N_CAF" maxlength="255" name="N_CAF" type="text" class="inputC" value="<?php echo $personne['INS_NCaf']; ?>">
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    <table align="left">
        <tr>
            <td style="vertical-align:top;">
                <table id="leftT" cellpadding="10">
                    <tr>
                        <td colspan="2">
                            &nbsp;&nbsp;
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align: left; width: 150px; white-space: normal;">
                            <label for="Ref">Référent identifié :</label>
                        </td>
                        <td>
                            <div class="selectType">
                                <select id="Ref" name="Ref">
                                    <?php
                                    $reponse2 = mysqli_query($db, "SELECT * FROM Referents JOIN Personnes USING (PER_NUM) ORDER BY PER_Nom");
                                    while ($donnees2 = mysqli_fetch_assoc($reponse2)) {
                                        ?>
                                        <option
                                            value="<?php echo $donnees2['REF_NumRef']; ?>"><?php echo $donnees2['PER_Nom'] . ' ' . $donnees2['PER_Prenom']; ?></option>
                                    <?php
                                    }
                                    mysqli_free_result($reponse2);
                                    ?>
                                </select>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align: left; width: 150px; white-space: normal;">
                            <label for="Prescipteur">Prescripteur :</label>
                        </td>
                        <td>
                            <div class="selectType2">
                                <select id="Prescipteur" name="Prescripteur">
                                    <option value="Mission Locale">Mission Locale</option>
                                    <option value="CCAS Mairie">CCAS Mairie</option>
                                    <option value="Organisme de formation">Organisme de formation</option>
                                    <option value="Structures médicales">Structures médicales</option>
                                    <option value="Servies judiciaires">Services judiciaires</option>
                                    <option value="Structure d'urgence">Structure d'urgence</option>
                                    <option value="Tremplin">Tremplin</option>
                                    <option value="Service secteur social">Service secteur social</option>
                                    <option value="CAO - SSE">CAO - SSE</option>
                                    <option value="SAJD / SAP / SPMO">SAJD / SAP / SPMO</option>
                                    <option value="Pôle emploi">Pôle emploi</option>
                                    <option value="Organisme de tutelles">Organisme de tutelles</option>
                                    <option value="CHRS">CHRS</option>
                                    <option value="Maison Relais">Maison Relais</option>
                                </select>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align: left; width: 150px; white-space: normal;">
                            <label for="Convention">Convention :</label>
                        </td>
                        <td>
                            <div class="selectType2">
                                <select id="Convention" name="Convention" class="selectType2">
                                    <?php
                                    $reponse2 = mysqli_query($db, "SELECT * FROM Convention ORDER BY CNV_Id");
                                    while ($donnees2 = mysqli_fetch_assoc($reponse2)) {
                                        ?>
                                        <option
                                            value="<?php echo $donnees2['CNV_Id']; ?>"><?php echo $donnees2['CNV_Nom']; ?></option>
                                    <?php
                                    }
                                    mysqli_free_result($reponse2);
                                    ?>
                                </select>
                            </div>
                        </td>
                    </tr>
                    <tr id="Jours-Travailles">
                        <td style="text-align: left; width: 150px; white-space: normal;">
                            <label for="Jours">Jours travaillés :</label>
                        </td>
                        <td>
                            <input id="Jours" maxlength="255" name="Jours" type="number" min="0" class="inputC">
                        </td>
                    </tr>
                </table>
            </td>
            <td style="vertical-align:top;">
                <table id="rightT" cellpadding="10">
                    <tr>
                        <td colspan="2">
                            &nbsp;&nbsp;
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            &nbsp;&nbsp;
                        </td>
                    </tr>
                    <tr id="Date-Entree">
                        <td style="text-align: left; width: 150px; white-space: normal;">
                            <label for="Entree">Date d'entrée :</label>
                        </td>
                        <td>
                            <input id="Entree" required name="Entree" type="date" class="inputC">
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align: left; width: 150px; white-space: normal;">
                            <label for="Contrat">Type de contrat :</label>
                        </td>
                        <td>
                            <div class="selectType2">
                                <select id="Contrat" name="Contrat">
                                    <?php
                                    $reponse3 = mysqli_query($db, "SELECT * FROM Contrat ORDER BY CNT_Id");
                                    while ($donnees3 = mysqli_fetch_assoc($reponse3)) {
                                        ?>
                                        <option
                                            value="<?php echo $donnees3['CNT_Id']; ?>"><?php echo $donnees3['CNT_Nom']; ?></option>
                                    <?php
                                    }
                                    mysqli_free_result($reponse3);
                                    ?>
                                </select>
                            </div>
                        </td>
                    </tr>
                    <tr id="Nombre-Heures">
                        <td style="text-align: left; width: 150px; white-space: normal;">
                            <label for="N_Heures">Nombre d'heures :</label>
                        </td>
                        <td>
                            <input id="N_Heures" maxlength="255" name="N_Heures" type="number" min="0"
                                   class="inputC">
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    <table align="left">
        <tr>
            <td style="vertical-align:top;">
                <table id="leftT" cellpadding="10">
                    <tr>
                        <td colspan="2">
                            &nbsp;&nbsp;
                        </td>
                    </tr>
                    <tr id="Niveau">
                        <td style="text-align: left; width: 150px; white-space: normal;">
                            <label for="Niveau">Niveau soclaire :</label>
                        </td>
                        <td>
                            <div class="selectType2">
                                <select id="Niveau" name="Niveau">
                                    <option value="Non scolarisé">Non scolarisé</option>
                                    <option value="3 et +">3 et +</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="5 Bis">5 Bis</option>
                                    <option value="6">6</option>
                                </select>
                            </div>
                        </td>
                    </tr>
                    <tr id="Reconnaissance">
                        <td style="text-align: left; width: 150px; white-space: normal;">
                            <label for="Reconnaissance">Reconnaissance TH:</label>
                        </td>
                        <td>
                            <input type="radio" id="Reconnaissance" name="Reconnaissance"
                                   value="Oui">Oui<br>
                            <input type="radio" id="Reconnaissance" name="Reconnaissance" value="Non"
                                   checked>Non<br>
                        </td>
                    </tr>
                </table>
            </td>
            <td style="vertical-align:top;">
                <table id="rightT" cellpadding="10">
                    <tr>
                        <td colspan="2">
                            &nbsp;&nbsp;
                        </td>
                    </tr>
                    <tr id="Diplome">
                        <td style="text-align: left; width: 150px; white-space: normal;">
                            <label for="Diplome">Diplôme :</label>
                        </td>
                        <td>
                            <div class="selectType2">
                                <select id="Diplome" name="Diplome">
                                    <option value="Sans">Sans</option>
                                    <option value="Brevet des collèges">Brevet des collèges</option>
                                    <option value="CAP - BEP">CAP - BEP</option>
                                    <option value="BAC">BAC</option>
                                    <option value="Et plus">Et plus</option>
                                </select>
                            </div>
                        </td>
                    </tr>
                    <tr id="Permis">
                        <td style="text-align: left; width: 150px; white-space: normal;">
                            <label for="Permis">Permis :</label>
                        </td>
                        <td>
                            <input type="radio" id="Permis" name="Permis" value="Oui">Oui<br>
                            <input type="radio" id="Permis" name="Permis" value="Non" checked>Non<br>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <table align="left">
        <tr>
            <td style="vertical-align:top;">
                <table id="leftT" cellpadding="10">
                    <tr>
                        <td colspan="2">
                            &nbsp;&nbsp;
                        </td>
                    </tr>
                    <tr id="Revenus-Type">
                        <td style="text-align: left; width: 150px; white-space: normal;">
                            <label for="Revenus-Type">Revenus :</label>
                        </td>
                        <td>
                            <div class="selectType2">
                                <select id="Revenus-Type" name="Revenus-Type">
                                    <option value="RSA">RSA</option>
                                    <option value="ASS">ASS</option>
                                    <option value="ARE">ARE</option>
                                    <option value="AAH">AAH</option>
                                    <option value="Autre">Autre, précisez :</option>
                                    <option value="Aucun">Aucun</option>
                                </select>
                            </div>
                        </td>
                    </tr>
                    <tr id="Inscrit-Pole">
                        <td style="text-align: left; width: 150px; white-space: normal;">
                            <label for="Inscrit-Pole">Inscription Pôle Emploi depuis :</label>
                        </td>
                        <td>
                            <div class="selectType2">
                                <select id="Inscrit-Pole" name="Inscrit-Pole">
                                    <option value="Non inscrit">Non inscrit</option>
                                    <option value="Moins de 6 mois">Moins de 6 mois</option>
                                    <option value="De 6 à 11 mois">De 6 à 11 mois</option>
                                    <option value="De 12 à 23 mois">De 12 à 23 mois</option>
                                    <option value="De 24 mois et plus">De 24 mois et plus</option>
                                </select>
                            </div>
                        </td>
                    </tr>
                    <tr id="CAP">
                        <td style="text-align: left; width: 150px; white-space: normal;">
                            <label for="CAP">Positionnement sur l'atelier du CAP :</label>
                        </td>
                        <td>
                            <div class="selectType2">
                                <select id="CAP" name="CAP">
                                    <option value="GOB (ACI)">GOB (ACI)</option>
                                    <option value="SOB (ACI)">SOB (ACI)</option>
                                    <option value="Equipe propreté (ACI)">Equipe propreté (ACI)</option>
                                    <option value="Agent de conditionnement (Filt) (ACI)">Agent de conditionnement
                                        (Filt) (ACI)
                                    </option>
                                    <option value="Chauffeur-Magasinier (ACI)">Chauffeur-Magasinier (ACI)</option>
                                    <option value="Agent de conditionnement (AVA)">Agent de conditionnement (AVA)
                                    </option>
                                    <option value="CAP Vert (AUS)">CAP Vert (AUS)</option>
                                </select>
                            </div>
                        </td>
                    </tr>
                    <tr id="Situation-Geo">
                        <td style="text-align: left; width: 150px; white-space: normal;">
                            <label for="Situation-Geo">Situation géograhique :</label>
                        </td>
                        <td>
                            <input type="radio" id="Situation-Geo" name="Situation-Geo" value="ZUS">ZUS<br>
                            <input type="radio" id="Situation-Geo" name="Situation-Geo" value="CUCS"
                                   checked>CUCS<br>
                        </td>
                    </tr>
                </table>
            </td>
            <td style="vertical-align:top;">
                <table id="rightT" cellpadding="10">
                    <tr>
                        <td colspan="2">
                            &nbsp;&nbsp;
                        </td>
                    </tr>
                    <tr id="Revenus-Durée">
                        <td style="text-align: left; width: 150px; white-space: normal;">
                            <label for="Revenus-Durée">Depuis :</label>
                        </td>
                        <td>
                            <div class="selectType2">
                                <select id="Revenus-Durée" name="Revenus-Durée">
                                    <option value="Moins de 6 mois">Moins de 6 mois</option>
                                    <option value="De 6 à 11 mois">De 6 à 11 mois</option>
                                    <option value="De 12 à 23 mois">De 12 à 23 mois</option>
                                    <option value="De 24 mois et plus">De 24 mois et plus</option>
                                </select>
                            </div>
                        </td>
                    </tr>
                    <tr id="Sans-Emploi">
                        <td style="text-align: left; width: 150px; white-space: normal;">
                            <label for="Sans-Emploi">Sans emploi depuis :</label>
                        </td>
                        <td>
                            <div class="selectType2">
                                <select id="Sans-Emploi" name="Sans-Emploi">
                                    <option value="Moins de 6 mois">Moins de 6 mois</option>
                                    <option value="De 6 à 11 mois">De 6 à 11 mois</option>
                                    <option value="De 12 à 23 mois">De 12 à 23 mois</option>
                                    <option value="De 24 mois et plus">De 24 mois et plus</option>
                                    <option value="Primo demandeur">Primo demandeur</option>
                                </select>
                            </div>
                        </td>
                    </tr>
                    <tr id="Mutuelle">
                        <td style="text-align: left; width: 150px; white-space: normal;">
                            <label for="Mutuelle">Mutuelle :</label>
                        </td>
                        <td>
                            <div class="selectType2">
                                <select id="Mutuelle" name="Mutuelle">
                                    <option value="CMU">CMU</option>
                                    <option value="CMU Complémentaire">CMU Complémentaire</option>
                                    <option value="Autre mutuelle">Autre mutuelle</option>
                                    <option value="Pas de mutuelle">Pas de mutuelle</option>
                                </select>
                            </div>
                        </td>
                    </tr>
                    <tr id="Repas">
                        <td style="text-align: left; width: 150px; white-space: normal;">
                            <label for="Repas">Repas :</label>
                        </td>
                        <td>
                            <input type="radio" id="Repas" name="Repas" value="Oui">Oui<br>
                            <input type="radio" id="Repas" name="Repas" value="Non" checked>Non<br>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <table id="downT">
        <tr>
            <td>
							<span>
								<input name="submit" type="submit" value="Ajouter" class="buttonC">&nbsp;&nbsp;
								<input name="reset" type="reset" value="Annuler" class="buttonC">
							</span>
            </td>
        </tr>
    </table>
    <br/><br/>
    * : Champs obligatoires.
    </form>
    <?php
    mysqli_free_result($reponse1);
    mysqli_free_result($reponse2);
    mysqli_free_result($reponse3);
    mysqli_free_result($reponse4);
    mysqli_free_result($reponse5);
    ?>
    </div>
<?php
include('footer.php');
?>