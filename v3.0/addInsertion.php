<?php
$pageTitle = "Ajout Membre en Insertion";
include('bandeau.php');
?>
    <div id="corps">
    <div id="labelT">
        <label>Ajouter un Salarié en insertion</label>
    </div>
    <br>

    <form method="post" action="insertionPost.php" name="Insertion">
    <div style="overflow:auto;">
    <table align="left">
        <tr>
            <td style="vertical-align:top;">
                <table id="leftT" cellpadding="10">
                    <tr id="Contact-Entretien">
                        <td style="text-align: left; width: 150px; white-space: normal;">
                            <label for="Entretien">Date de l'entretien :</label>
                        </td>
                        <td>
                            <input id="Entretien" required name="Entretien" type="date" class="inputC">
                        </td>
                    </tr>
                    <tr id="Contact-Nom">
                        <td style="text-align: left; width: 150px; white-space: normal;">
                            <label for="Nom">Nom :</label>
                        </td>
                        <td>
                            <input id="Nom" required maxlength="255" name="Nom" type="text" class="inputC"
                                   autofocus="autofocus">
                        </td>
                    </tr>
                    <tr id="Contact-DateNai">
                        <td style="text-align: left; width: 150px; white-space: normal;">
                            <label for="DateNai">Date de naissance :</label>
                        </td>
                        <td>
                            <input id="DateNai" name="DateNai" type="date" class="inputC">
                        </td>
                    </tr>
                    <tr id="Contact-Nationalite">
                        <td style="text-align: left; width: 150px; white-space: normal;">
                            <label for="Nationalite">Nationalité :</label>
                        </td>
                        <td>
                            <input id="Nationalite" required maxlength="255" name="Nationalite" type="text"
                                   class="inputC"
                                   autofocus="autofocus">
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
                    <tr id="Contact-Prenom">
                        <td style="text-align: left; width: 150px; white-space: normal;">
                            <label for="Prenom">Prénom :</label>
                        </td>
                        <td>
                            <input id="Prenom" maxlength="255" name="Prenom" type="text" class="inputC">
                        </td>
                    </tr>
                    <tr id="Contact-LieuNai">
                        <td style="text-align: left; width: 150px; white-space: normal;">
                            <label for="LieuNai">Lieu de naissance :</label>
                        </td>
                        <td>
                            <input id="LieuNai" required maxlength="255" name="LieuNai" type="text" class="inputC">
                        </td>
                    </tr>
                    <tr id="Contact-Situation">
                        <td style="text-align: left; width: 150px; white-space: normal;">
                            <label for="Situation">Situation familiale :</label>
                        </td>
                        <td>
                            <input id="Situation" maxlength="255" name="Situation" type="text" class="inputC">
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
                                   class="inputC">
                        </td>
                    </tr>
                    <tr id="Contact-Ville">
                        <td style="text-align: left; width: 150px; white-space: normal;">
                            <label for="Ville">Ville :</label>
                        </td>
                        <td>
                            <input id="Ville" required maxlength="255" name="Ville" type="text" class="inputC">
                        </td>
                    </tr>
                    <tr id="Contact-Tel_Fixe">
                        <td style="text-align: left; width: 150px; white-space: normal;">
                            <label for="Tel_Fixe">Téléphone Fixe :</label>
                        </td>
                        <td>
                            <input id="Tel_Fixe" maxlength="255" name="Tel_Fixe" type="text" class="inputC">
                        </td>
                    </tr>
                    <tr id="Contact-Portable">
                        <td style="text-align: left; width: 150px; white-space: normal;">
                            <label for="Portable">Téléphone Portable :</label>
                        </td>
                        <td>
                            <input id="Portable" maxlength="255" name="Portable" type="text" class="inputC">
                        </td>
                    </tr>
                    <tr id="Contact-Fax">
                        <td style="text-align: left; width: 150px; white-space: normal;">
                            <label for="Fax">Fax :</label>
                        </td>
                        <td>
                            <input id="Fax" maxlength="255" name="Fax" type="text" class="inputC">
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
                            <input id="Code_Postal" required name="Code_Postal" pattern="^\d{5}$" type="text" title=""
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
                                   pattern="^[a-zA-Z0-9\._-]+@[a-zA-Z0-9\._-]+\.[a-z]{2,3}$">
                        </td>
                    </tr>
                    <tr id="Contact-Pole">
                        <td style="text-align: left; width: 150px; white-space: normal;">
                            <label for="N_Pole">N° Pôle Emploi :</label>
                        </td>
                        <td>
                            <input id="N_Pole" maxlength="255" name="N_Pole" type="text" class="inputC">
                        </td>
                    </tr>
                    <tr id="Contact-Secu">
                        <td style="text-align: left; width: 150px; white-space: normal;">
                            <label for="N_Secu">N° Sécurité sociale :</label>
                        </td>
                        <td>
                            <input id="N_Secu" maxlength="255" name="N_Secu" type="text" class="inputC">
                        </td>
                    </tr>
                    <tr id="Contact-CAF">
                        <td style="text-align: left; width: 150px; white-space: normal;">
                            <label for="N_CAF">N° CAF :</label>
                        </td>
                        <td>
                            <input id="N_CAF" maxlength="255" name="N_CAF" type="text" class="inputC">
                        </td>
                    </tr>
                    <tr id="Contact-Fonction" style="display: none;">
                        <td style="text-align: left; width: 150px; white-space: normal;">
                            <label for="Struct">Fonction :</label>
                        </td>
                        <td>
                            <input id="Struct" maxlength="255" name="Fonction" type="text" class="inputC">
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
                            <label for="Nom-Ref">Référent identifié :</label>
                        </td>
                        <td>
                            <input id="Nom-Ref" required maxlength="255" name="Nom-Ref" type="text" class="inputC"
                                   autofocus="autofocus">
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
                                    <option value="CG">CG</option>
                                    <option value="ASH">ASH</option>
                                    <option value="ASSH">ASSH</option>
                                    <option value="CUCS">CUCS</option>
                                    <option value="FAJ">FAJ</option>
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
                                    <option value="AVA">AVA</option>
                                    <option value="ACI">ACI</option>
                                    <option value="CAP VERT">CAP VERT</option>
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
                    <tr id="Diplôme">
                        <td style="text-align: left; width: 150px; white-space: normal;">
                            <label for="Diplôme">Diplôme :</label>
                        </td>
                        <td>
                            <div class="selectType2">
                                <select id="Diplôme" name="Diplôme">
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
                                    <option value="GOB">GOB</option>
                                    <option value="SOB">SOB</option>
                                    <option value="Equipe propreté">Equipe propreté</option>
                                    <option value="Agent de conditionnement (Filt)">Agent de conditionnement (Filt)</option>
                                    <option value="Chauffeur-Magasinier">Chauffeur-Magasinier</option>
                                    <option value="Agent de conditionnement">Agent de conditionnement</option>
                                    <option value="CAP Vert">CAP Vert</option>
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
                            <input type="radio" id="Situation-Geo" name="Situation-Geo" value="CUCS" checked>CUCS<br>
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
    </div>
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
    </div>
<?php
include('footer.php');
?>