<?php
$pageTitle = "Modifier Fournisseur";
include('bandeau.php');
?>
    <div id="corps">
        <?php
        $num = $_POST["NumC"];

        $queryFourn = mysqli_query($db, "SELECT * FROM Fournisseurs WHERE FOU_NumFournisseur='$num'");
        $fourn = mysqli_fetch_assoc($queryFourn);
        ?>
        <div id="labelT">
            <label>Modifier Fournisseur</label>
        </div>
        <br>

        <form method="post" action="fournisseurpre.php" name="Fournisseur">
            <input type="hidden" name="NumC" value="<?php echo $fourn['FOU_NumFournisseur']; ?>">

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
                                               value="<?php echo formatUP($fourn['FOU_Nom']); ?>">
                                    </td>
                                </tr>
                                <tr id="Client-Tel_Fixe">
                                    <td style="text-align: left; width: 150px; white-space: normal;">
                                        <label for="Tel_Fixe">Telephone Fixe :</label>
                                    </td>
                                    <td>
                                        <input id="Tel_Fixe" maxlength="255" name="Tel_Fixe" type="text"
                                               class="inputC" pattern="^[0-9][0-9](?:[\/_:-\s]?\d\d){4}$"
                                               value="<?php echo$fourn['FOU_Telephone']; ?>">
                                    </td>
                                </tr>
                                <tr id="Client-Portable">
                                    <td style="text-align: left; width: 150px; white-space: normal;">
                                        <label for="Portable">Telephone Portable :</label>
                                    </td>
                                    <td>
                                        <input id="Portable" maxlength="255" name="Portable" type="text" class="inputC"
                                               pattern="^[0-9][0-9](?:[\/_:-\s]?\d\d){4}$"
                                               value="<?php echo $fourn['FOU_Portable']; ?>">
                                    </td>
                                </tr>
                                <tr id="Client-Fax">
                                    <td style="text-align: left; width: 150px; white-space: normal;">
                                        <label for="Fax">Fax :</label>
                                    </td>
                                    <td>
                                        <input id="Fax" maxlength="255" name="Fax" type="text"
                                               class="inputC"
                                               pattern="^[0-9][0-9](?:[\/_:-\s]?\d\d){4}$"
                                               value="<?php echo $fourn['FOU_Fax']; ?>">
                                    </td>
                                </tr>
                            </table>
                        </td>
                        <td style="vertical-align:top;">
                            <table id="rightT" cellpadding="10">
                                <tr id="Client-Email">
                                    <td style="text-align: left; width: 150px; white-space: normal;">
                                        <label>Email :</label>
                                    </td>
                                    <td>
                                        <input id="Email" maxlength="255" name="Email" type="text" class="inputC"
                                               title="exemple@exemple.com"
                                               pattern="^[a-zA-Z0-9\._-]+@[a-zA-Z0-9\._-]+\.[a-z]{2,3}$"
                                               value="<?php echo $fourn['FOU_Email']; ?>">
                                    </td>
                                </tr>
                                <tr id="Client-Adresse">
                                    <td style="text-align: left; width: 150px; white-space: normal;">
                                        <label for="Adresse">Adresse :</label>
                                    </td>
                                    <td>
                                        <input id="Adresse" required maxlength="255" name="Adresse" type="text"
                                               class="inputC"
                                               value="<?php echo formatLOW($fourn['FOU_Adresse']); ?>">
                                    </td>
                                </tr>
                                <tr id="Client-Code_Postal">
                                    <td style="text-align: left; width: 150px; white-space: normal;">
                                        <label for="Code_Postal">Code Postal :</label>
                                    </td>
                                    <td>
                                        <input id="Code_Postal" required name="Code_Postal" pattern="^\d{5}$"
                                               type="text"
                                               style="width:100px;background-color:#cde5f7;" maxlength="5"
                                               value="<?php echo $fourn['FOU_CodePostal']; ?>">
                                    </td>
                                </tr>
                                <tr id="Client-Ville">
                                    <td style="text-align: left; width: 150px; white-space: normal;">
                                        <label for="Ville">Ville :</label>
                                    </td>
                                    <td>
                                        <input id="Ville" required maxlength="255" name="Ville" type="text"
                                               class="inputC"
                                               value="<?php echo formatUP($fourn['FOU_Ville']); ?>">
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