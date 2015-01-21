<?php
$pageTitle = "Modifier Client";
include('bandeau.php');
?>
    <div id="corps">
        <?php
        $numC = $_POST["NumC"];
        $queryStruc = mysqli_query($db, "SELECT * FROM Clients WHERE CLI_NumClient=$numC");
        $donneesStruc = mysqli_fetch_assoc($queryStruc);
        if (!empty($donneesStruc['CLI_Nom'])) {
            $num = $donneesStruc['CLI_NumClient'];
            $nom = formatUP($donneesStruc['CLI_Nom']);
            $add = formatLOW($donneesStruc['CLI_Adresse']);
            $cp = $donneesStruc['CLI_CodePostal'];
            $ville = formatUP($donneesStruc['CLI_Ville']);
            $tel = $donneesStruc['CLI_Telephone'];
            $port = $donneesStruc['CLI_Portable'];
            $fax = $donneesStruc['CLI_Fax'];
            $mail = $donneesStruc['CLI_Email'];
            $struc = "Entreprise";
        } else {
            $queryPart = mysqli_query($db, "SELECT * FROM EmployerClient em JOIN Personnes pe ON em.PER_Num=pe.PER_Num WHERE CLI_NumClient=$numC");
            $donneesPart = mysqli_fetch_assoc($queryPart);

            $num = $donneesPart['PER_Num'];
            $nom = formatUP($donneesPart['PER_Nom']);
            $prenom = formatLow($donneesPart['PER_Prenom']);
            $add = formatLOW($donneesPart['PER_Adresse']);
            $cp = $donneesPart['PER_CodePostal'];
            $ville = formatUP($donneesPart['PER_Ville']);
            $tel = $donneesPart['PER_TelFixe'];
            $port = $donneesPart['PER_TelPort'];
            $fax = $donneesPart['PER_Fax'];
            $mail = $donneesPart['PER_Email'];
            $struc = "Particulier";
            mysqli_free_result($queryPart);
        }
        ?>
        <div id="labelT">
            <label>Modifier Client</label>
        </div>
        <br>

        <form method="post" action="clientpre.php" name="Client">
            <input type="hidden" name="NumC" value="<?php echo $num; ?>">

            <div style="overflow:auto;">
                <table align="left">
                    <tr>
                        <td style="vertical-align:top;">
                            <table id="leftT" cellpadding="10">
                                <tr id="Client-Nom">
                                    <td style="text-align: left; width: 150px; white-space: normal;">
                                        <label for="Nom">Nom :</label>
                                    </td>
                                    <td>
                                        <input id="Nom" required maxlength="255" name="Nom" type="text" class="inputC"
                                               value="<?php echo $nom; ?>">
                                    </td>
                                </tr>
                                <?php if (!empty($prenom)) { ?>
                                    <tr id="Client-Prenom">
                                        <td style="text-align: left; width: 150px; white-space: normal;">
                                            <label for="Prenom">Prenom :</label>
                                        </td>
                                        <td>
                                            <input id="Prenom" required maxlength="255" name="Prenom" type="text"
                                                   class="inputC" value="<?php echo $prenom; ?>">
                                        </td>

                                    </tr>
                                <?php } ?>
                                <tr id="Client-Tel_Fixe">
                                    <td style="text-align: left; width: 150px; white-space: normal;">
                                        <label for="Tel_Fixe">Telephone Fixe :</label>
                                    </td>
                                    <td>
                                        <input id="Tel_Fixe" maxlength="255" name="Tel_Fixe" type="text" class="inputC"
                                               pattern="^[0-9][0-9](?:[\/_:-\s]?\d\d){4}$"
                                               value="<?php echo $tel; ?>">
                                    </td>
                                </tr>
                                <tr id="Client-Portable">
                                    <td style="text-align: left; width: 150px; white-space: normal;">
                                        <label for="Portable">Telephone Portable :</label>
                                    </td>
                                    <td>
                                        <input id="Portable" maxlength="255" name="Portable" type="text" class="inputC"
                                               pattern="^[0-9][0-9](?:[\/_:-\s]?\d\d){4}$"
                                               value="<?php echo $port; ?>">
                                    </td>
                                </tr>
                                <tr id="Client-Fax">
                                    <td style="text-align: left; width: 150px; white-space: normal;">
                                        <label for="Fax">Fax :</label>
                                    </td>
                                    <td>
                                        <input id="Fax" maxlength="255" name="Fax" type="text" class="inputC"
                                               pattern="^[0-9][0-9](?:[\/_:-\s]?\d\d){4}$"
                                               value="<?php echo $fax; ?>">
                                    </td>
                                </tr>
                            </table>
                        </td>
                        <td style="vertical-align:top;">
                            <table id="rightT" cellpadding="10">
                                <tr id="Client-Email">
                                    <td style="text-align: left; width: 150px; white-space: normal;">
                                        <label for="Email">Email :</label>
                                    </td>
                                    <td>
                                        <input id="Email" maxlength="255" name="Email" type="text" class="inputC"
                                               title="exemple@exemple.com"
                                               pattern="^[a-zA-Z0-9\._-]+@[a-zA-Z0-9\._-]+\.[a-z]{2,3}$"
                                               value="<?php echo $mail; ?>">
                                    </td>
                                </tr>
                                <tr id="Client-Adresse">
                                    <td style="text-align: left; width: 150px; white-space: normal;">
                                        <label for="Adresse">Adresse :</label>
                                    </td>
                                    <td>
                                        <input id="Adresse" required maxlength="255" name="Adresse" type="text"
                                               class="inputC" value="<?php echo $add; ?>">
                                    </td>
                                </tr>
                                <tr id="Client-Code_Postal">
                                    <td style="text-align: left; width: 150px; white-space: normal;">
                                        <label for="Code_Postal">Code Postal :</label>
                                    </td>
                                    <td>
                                        <input id="Code_Postal" required name="Code_Postal" pattern="^\d{5}$"
                                               type="text" style="width:100px;background-color:#cde5f7;" maxlength="5"
                                               value="<?php echo $cp; ?>">
                                    </td>
                                </tr>
                                <tr id="Client-Ville">
                                    <td style="text-align: left; width: 150px; white-space: normal;">
                                        <label for="Ville">Ville :</label>
                                    </td>
                                    <td>
                                        <input id="Ville" required maxlength="255" name="Ville" type="text"
                                               class="inputC" value="<?php echo $ville; ?>">
                                    </td>
                                </tr>
                                <tr id="Client-Structure">
                                    <td style="text-align: left; width: 150px; white-space: normal;" colspan="2">
                                        <?php if (!empty($prenom)) { ?>
                                            <input type="hidden" name="Struct" id="Struct" value="Particulier"
                                                   <?php } else { ?>
                                            <input type="hidden" name="Struct" id="Struct" value="Entreprise"
                                        <?php } ?>
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
								<input name="submit" type="submit" value="Valider" class="buttonC">&nbsp;&nbsp; 
								<input name="reset" type="reset" value="Annuler" class="buttonC">
							</span>
                    </td>
                </tr>
            </table>
        </form>
    </div>
<?php
include('footer.php');
?>