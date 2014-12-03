<?php
$pageTitle = "Ajouter Contact";
include('bandeau.php');
?>
    <div id="corps">
        <div id="labelT">
            <label>Ajouter un Contact</label>
        </div>
        <br>

        <form method="post" action="contactPost.php" name="Contact">
            <div id="labelCat">
                <table align="center">
                    <tr>
                        <td style="text-align: left; width: 150px;">
                            <label for="Type">Catégorie</label>
                        </td>
                        <td>
                            <div class="selectType">
                                <select id="Type" name="Type" onchange="showMemberInput(this)">
                                    <option value="0">Client</option>
                                    <option value="1">Fournisseur</option>
                                    <?php
                                    $i = 2;
                                    $reponse = mysqli_query($db, "SELECT * FROM Type");
                                    while ($donnees = mysqli_fetch_assoc($reponse)) {
                                        ?>
                                        <option value="<?php echo $i; ?>"><?php echo $donnees['TYP_Nom']; ?></option>
                                        <?php
                                        $i++;
                                    }
                                    mysqli_free_result($reponse);
                                    ?>
                                </select>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
            <br/>
            <table align="center">
                <tr id="Contact-Particulier">
                    <td style="padding-top: 0;">
                        <input type="radio" checked onclick="showStruct();" name="Particulier" id="Particulier"
                               value="Structure"/>
                        <label for="Particulier">&nbsp; Structure</label>
                    </td>
                    <td style="padding-top: 0;">
                        <input type="radio" onclick="showStruct();" name="Particulier" id="yesCheck"
                               value="Particulier"/>
                        <label for="yesCheck">&nbsp; Particulier</label>
                    </td>
                </tr>
            </table>
            <br/>

            <div style="overflow:auto;">
                <table align="left">
                    <tr>
                        <td style="vertical-align:top;">
                            <table id="leftT" cellpadding="10">
                                <tr id="Contact-Structure">
                                    <td style="text-align: left; width: 150px; white-space: normal;">
                                        <label for="Structure">Structure :</label>
                                    </td>
                                    <td>
                                        <input id="Structure" maxlength="255" name="Structure" type="text"
                                               class="inputC" autofocus="autofocus">
                                    </td>

                                </tr>
                                <tr id="Contact-Nom">
                                    <td style="text-align: left; width: 150px; white-space: normal;">
                                        <label for="Nom">Nom* :</label>
                                    </td>
                                    <td>
                                        <input id="Nom" required maxlength="255" name="Nom" type="text" class="inputC"
                                               autofocus="autofocus">
                                    </td>
                                </tr>
                                <tr id="Contact-Prenom">
                                    <td style="text-align: left; width: 150px; white-space: normal;">
                                        <label for="Prenom">Prénom* :</label>
                                    </td>
                                    <td>
                                        <input id="Prenom" maxlength="255" name="Prenom" type="text" class="inputC">
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
                                <tr id="Contact-Adresse">
                                    <td style="text-align: left; width: 150px; white-space: normal;">
                                        <label for="Adresse">Adresse* :</label>
                                    </td>
                                    <td>
                                        <input id="Adresse" required maxlength="255" name="Adresse" type="text"
                                               class="inputC">
                                    </td>
                                </tr>
                                <tr id="Contact-Code_Postal">
                                    <td style="text-align: left; width: 150px; white-space: normal;">
                                        <label for="Code_Postal">Code Postal* :</label>
                                    </td>
                                    <td>
                                        <input id="Code_Postal" required name="Code_Postal" pattern="^\d{5}$"
                                               type="text" title="" style="width:100px;background-color:#cde5f7;"
                                               maxlength="5">
                                    </td>
                                </tr>
                                <tr id="Contact-Ville">
                                    <td style="text-align: left; width: 150px; white-space: normal;">
                                        <label for="Ville">Ville* :</label>
                                    </td>
                                    <td>
                                        <input id="Ville" required maxlength="255" name="Ville" type="text"
                                               class="inputC">
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