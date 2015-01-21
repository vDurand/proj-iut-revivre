<?php
$pageTitle = "Modifier Référent";
include('bandeau.php');
?>
    <div id="corps">
        <?php
        $num = intval($_POST["NumC"]);

        $reponse = mysqli_query($db, "SELECT * FROM Referents cl JOIN Personnes pe ON cl.PER_Num=pe.PER_Num JOIN Prescripteurs ty ON cl.PRE_Id=ty.PRE_Id WHERE REF_NumRef='$num' ORDER BY PER_Nom");
        $donnees = mysqli_fetch_assoc($reponse);
        ?>
        <div id="labelT">
            <label>Modifier Référent</label>
        </div>
        <div style="overflow:auto;">
            <form method="post" action="refpre.php" name="EditEmp">
                <table align="left">
                    <tr>
                        <td style="vertical-align:top;">
                            <table id="leftT" cellpadding="10">
                                <tr id="Client-Nom">
                                    <td style="text-align: left; width: 150px; white-space: normal;">
                                        <label for="Nom"> Nom :</label>
                                    </td>
                                    <td>
                                        <input id="Nom" required maxlength="255" name="Nom" type="text" class="inputC"
                                               value="<?php echo formatUP($donnees['PER_Nom']);; ?>">
                                    </td>
                                </tr>
                                <tr id="Client-Prenom">
                                    <td style="text-align: left; width: 150px; white-space: normal;">
                                        <label for="Prenom">Prenom :</label>
                                    </td>
                                    <td>
                                        <input id="Prenom" required maxlength="255" name="Prenom" type="text"
                                               class="inputC"
                                               value="<?php echo formatLOW($donnees['PER_Prenom']); ?>">
                                    </td>

                                </tr>
                                <tr id="Client-Tel_Fixe">
                                    <td style="text-align: left; width: 150px; white-space: normal;">
                                        <label for="Tel_Fixe">Telephone Fixe :</label>
                                    </td>
                                    <td>
                                        <input id="Tel_Fixe" maxlength="255" name="Tel_Fixe" type="text" class="inputC"
                                               pattern="^[0-9][0-9](?:[\/_:-\s]?\d\d){4}$"
                                               value="<?php echo $donnees['PER_TelFixe']; ?>">
                                    </td>
                                </tr>
                                <tr id="Client-Portable">
                                    <td style="text-align: left; width: 150px; white-space: normal;">
                                        <label for="Portable">Telephone Portable :</label>
                                    </td>
                                    <td>
                                        <input id="Portable" maxlength="255" name="Portable" type="text" class="inputC"
                                               pattern="^[0-9][0-9](?:[\/_:-\s]?\d\d){4}$"
                                               value="<?php echo $donnees['PER_TelPort']; ?>">
                                    </td>
                                </tr>
                                <tr id="Client-Fax">
                                    <td style="text-align: left; width: 150px; white-space: normal;">
                                        <label for="Fax">Fax :</label>
                                    </td>
                                    <td>
                                        <input id="Fax" maxlength="255" name="Fax" type="text" class="inputC"
                                               pattern="^[0-9][0-9](?:[\/_:-\s]?\d\d){4}$"
                                               value="<?php echo $donnees['PER_Fax']; ?>">
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
                                               value="<?php echo $donnees['PER_Email']; ?>">
                                    </td>
                                </tr>
                                <tr id="Client-Adresse">
                                    <td style="text-align: left; width: 150px; white-space: normal;">
                                        <label for="Adresse">Adresse :</label>
                                    </td>
                                    <td>
                                        <input id="Adresse" required maxlength="255" name="Adresse" type="text"
                                               class="inputC" value="<?php echo formatLOW($donnees['PER_Adresse']); ?>">
                                    </td>
                                </tr>
                                <tr id="Client-Code_Postal">
                                    <td style="text-align: left; width: 150px; white-space: normal;">
                                        <label for="Code_Postal">Code Postal :</label>
                                    </td>
                                    <td>
                                        <input id="Code_Postal" required name="Code_Postal" pattern="^\d{5}$"
                                               type="text" style="width:100px;background-color:#cde5f7;" maxlength="5"
                                               value="<?php echo $donnees['PER_CodePostal']; ?>">
                                    </td>
                                </tr>
                                <tr id="Client-Ville">
                                    <td style="text-align: left; width: 150px; white-space: normal;">
                                        <label for="Ville">Ville :</label>
                                    </td>
                                    <td>
                                        <input id="Ville" required maxlength="255" name="Ville" type="text"
                                               class="inputC" value="<?php echo formatUP($donnees['PER_Ville']); ?>">
                                    </td>
                                </tr>
                                <tr>
                                    <td style="text-align: left; width: 150px; white-space: normal;">
                                        <label for="Prescript">Prescripteur :</label>
                                    </td>
                                    <td>
                                        <div class="selectType2" style="display: inline-block;">
                                            <select id="Prescript" name="Prescript">
                                                <optgroup label="Prescripteur actuel">
                                                    <option value="<?php echo $donnees['PRE_Id']; ?>" selected>
                                                        <?php echo $donnees['PRE_Nom']; ?>
                                                    </option>
                                                </optgroup>
                                                <optgroup label="Prescripteurs disponibles">
                                                    <?php
                                                    $reponse2 = mysqli_query($db, "SELECT * FROM Prescripteurs ORDER BY PRE_Nom");
                                                    while ($donnees2 = mysqli_fetch_assoc($reponse2)) {
                                                        ?>
                                                        <option
                                                            value="<?php echo $donnees2['PRE_Id']; ?>"><?php echo $donnees2['PRE_Nom']; ?></option>
                                                    <?php
                                                    }
                                                    mysqli_free_result($reponse2);
                                                    ?>
                                                </optgroup>
                                            </select>
                                        </div>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
        </div>
        <input type="hidden" name="NumC" value="<?php echo $num; ?>">
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
mysqli_free_result($reponse);
?>
    </div>
<?php
include('footer.php');
?>