<?php
$pageTitle = "Ajouter Membre en insertion";
include('bandeau.php');
?>
<div id="corps">

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
                        <input id="Nationalite" required maxlength="255" name="Nationalite" type="text" class="inputC"
                               autofocus="autofocus">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        &nbsp;
                    </td>
                </tr>
                <tr id="Contact-Adresse">
                    <td style="text-align: left; width: 150px; white-space: normal;">
                        <label for="Adresse">Adresse :</label>
                    </td>
                    <td>
                        <input id="Adresse" required maxlength="255" name="Adresse" type="text" class="inputC">
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
        </td>
        <td style="vertical-align:top;">
            <table id="rightT" cellpadding="10">
                <tr id="Contact-DateNai">
                    <td colspan="2">
                        &nbsp;
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
                <tr>
                    <td colspan="2">
                        &nbsp;
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
                        &nbsp;
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
                <tr>
                    <td colspan="2">
                        &nbsp;
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
                        <input id="N_Heures" maxlength="255" name="N_Heures" type="number" min="0" class="inputC">
                    </td>
                </tr>
            </table>
        </td>
        <td style="vertical-align:top;">
            <table id="rightT" cellpadding="10">
                <tr>
                    <td colspan="2">
                        &nbsp;
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        &nbsp;
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
                    <td colspan="2">
                        &nbsp;
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
    </tr>
</table>

</div>
</div>