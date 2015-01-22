<?php
$pageTitle = "Modifier Membre";
include('bandeau.php');
?>
    <div id="corps">
        <?php
        $num = $_POST["NumC"];

        $reponse = mysqli_query($db, "SELECT * FROM Salaries cl JOIN Personnes pe ON cl.PER_Num=pe.PER_Num JOIN Type ty ON cl.TYP_Id=ty.TYP_Id Join Fonction USING (FCT_Id) WHERE SAL_NumSalarie='$num' ORDER BY PER_Nom");
        $donnees = mysqli_fetch_assoc($reponse);
        ?>
        <div id="labelT">
            <label>Modifier Membre</label>
        </div>
        <br>

        <form method="post" action="salpre.php" name="Sal">
            <input type="hidden" name="NumC" value="<?php echo $donnees['PER_Num']; ?>">

            <div style="overflow:auto;">
                <table align="left">
                    <tr>
                        <td style="vertical-align:top;">
                            <table id="leftT" cellpadding="10">
                                <tr id="Sal-Nom">
                                    <td style="text-align: left; width: 150px; white-space: normal;">
                                        <label for="Nom">Nom* :</label>
                                    </td>
                                    <td>
                                        <input id="Nom" required maxlength="255" name="Nom" type="text" class="inputC"
                                               value="<?php echo $donnees['PER_Nom']; ?>">
                                    </td>
                                </tr>
                                <tr id="Sal-Prenom">
                                    <td style="text-align: left; width: 150px; white-space: normal;">
                                        <label for="Prenom">Prenom* :</label>
                                    </td>
                                    <td>
                                        <input id="Prenom" required maxlength="255" name="Prenom" type="text"
                                               class="inputC"
                                               value="<?php echo $donnees['PER_Prenom']; ?>">
                                    </td>

                                </tr>
                                <tr id="Sal-Tel_Fixe">
                                    <td style="text-align: left; width: 150px; white-space: normal;">
                                        <label for="Tel_Fixe">Telephone Fixe :</label>
                                    </td>
                                    <td>
                                        <input id="Tel_Fixe" maxlength="255" name="Tel_Fixe" type="text"
                                               class="inputC" pattern="^[0-9][0-9](?:[\/_:-\s]?\d\d){4}$"
                                               value="<?php echo $donnees['PER_TelFixe']; ?>">
                                    </td>
                                </tr>
                                <tr id="Sal-Portable">
                                    <td style="text-align: left; width: 150px; white-space: normal;">
                                        <label for="Portable">Telephone Portable :</label>
                                    </td>
                                    <td>
                                        <input id="Portable" maxlength="255" name="Portable" type="text" class="inputC"
                                               pattern="^[0-9][0-9](?:[\/_:-\s]?\d\d){4}$"
                                               value="<?php echo $donnees['PER_TelPort']; ?>">
                                    </td>
                                </tr>
                                <tr id="Sal-Fax">
                                    <td style="text-align: left; width: 150px; white-space: normal;">
                                        <label for="Fax">Fax :</label>
                                    </td>
                                    <td>
                                        <input id="Fax" maxlength="255" name="Fax" type="text"
                                               class="inputC"
                                               pattern="^[0-9][0-9](?:[\/_:-\s]?\d\d){4}$"
                                               value="<?php echo $donnees['PER_Fax']; ?>">
                                    </td>
                                </tr>
                            </table>
                        </td>
                        <td style="vertical-align:top;">
                            <table id="rightT" cellpadding="10">
                                <tr id="Sal-Email">
                                    <td style="text-align: left; width: 150px; white-space: normal;">
                                        <label>Email :</label>
                                    </td>
                                    <td>
                                        <input id="Email" maxlength="255" name="Email" type="text" class="inputC"
                                               title="exemple@exemple.com"
                                               pattern="^[a-zA-Z0-9\._-]+@[a-zA-Z0-9\._-]+\.[a-z]{2,3}$"
                                               value="<?php echo $donnees['PER_Email']; ?>">
                                    </td>
                                </tr>
                                <tr id="Sal-Adresse">
                                    <td style="text-align: left; width: 150px; white-space: normal;">
                                        <label for="Adresse">Adresse* :</label>
                                    </td>
                                    <td>
                                        <input id="Adresse" required maxlength="255" name="Adresse" type="text"
                                               class="inputC"
                                               value="<?php echo $donnees['PER_Adresse']; ?>">
                                    </td>
                                </tr>
                                <tr id="Sal-Code_Postal">
                                    <td style="text-align: left; width: 150px; white-space: normal;">
                                        <label for="Code_Postal">Code Postal* :</label>
                                    </td>
                                    <td>
                                        <input id="Code_Postal" required name="Code_Postal" pattern="^\d{5}$"
                                               type="text"
                                               title="" style="width:100px;background-color:#cde5f7;"
                                               maxlength="5"
                                               value="<?php echo $donnees['PER_CodePostal']; ?>">
                                    </td>
                                </tr>
                                <tr id="Sal-Ville">
                                    <td style="text-align: left; width: 150px; white-space: normal;">
                                        <label for="Ville">Ville* :</label>
                                    </td>
                                    <td>
                                        <input id="Ville" required maxlength="255" name="Ville" type="text"
                                               class="inputC"
                                               value="<?php echo $donnees['PER_Ville']; ?>">
                                    </td>
                                </tr>
                                <tr id="Sal-Type">
                                    <td style="text-align: left; width: 150px; white-space: normal;">
                                        <label for="Type">Type :</label>
                                    </td>
                                    <td>
                                        <div class="selectType2">
                                            <select id=Type" name="Type">
                                                <optgroup label="Type actuel">
                                                    <option value="<?php echo formatLOW($donnees['TYP_Id']); ?>">
                                                        <?php echo formatLOW($donnees['TYP_Nom']); ?>
                                                    </option>
                                                </optgroup>
                                                <optgroup label="Types disponibles">
                                                    <?php
                                                    $reponse2 = mysqli_query($db, "SELECT * FROM Type WHERE TYP_Nom not in (SELECT TYP_Nom FROM Salaries cl JOIN Personnes pe ON cl.PER_Num=pe.PER_Num JOIN Type ty ON cl.TYP_Id=ty.TYP_Id WHERE SAL_NumSalarie='$num' ORDER BY PER_Nom) and TYP_Id < 6");
                                                    while ($donnees2 = mysqli_fetch_assoc($reponse2)) {
                                                        ?>
                                                        <option value="<?php echo $donnees2['TYP_Id']; ?>">
                                                            <?php echo formatLOW($donnees2['TYP_Nom']); ?>
                                                        </option>
                                                        <?php
                                                    }
                                                    mysqli_free_result($reponse2);
                                                    ?>
                                                </optgroup>
                                            </select>
                                        </div>
                                    </td>
                                </tr>
                                <tr id="Sal-Fonction">
                                    <td style="text-align: left; width: 150px; white-space: normal;">
                                        <label for="Fonction">Fonction :</label>
                                    </td>
                                    <td>
                                        <div class="selectType2">
                                            <select id="Fonction" name="Fonction">
                                                <optgroup label="Fonction actuelles">
                                                    <option value="<?php echo formatLOW($donnees['FCT_Id']); ?>">
                                                        <?php echo formatLOW($donnees['FCT_Nom']); ?>
                                                    </option>
                                                </optgroup>
                                                <optgroup label="Fonctions disponibles">
                                                    <?php
                                                    $reponse2 = mysqli_query($db, "SELECT * FROM Fonction WHERE FCT_Id not in (SELECT FCT_Id FROM Salaries cl JOIN Personnes pe ON cl.PER_Num=pe.PER_Num JOIN Type ty ON cl.TYP_Id=ty.TYP_Id WHERE SAL_NumSalarie='$num' ORDER BY PER_Nom) AND FCT_Id>0 ORDER BY FCT_Nom");
                                                    while ($donnees2 = mysqli_fetch_assoc($reponse2)) {
                                                        ?>
                                                        <option value="<?php echo $donnees2['FCT_Id']; ?>">
                                                            <?php echo formatLOW($donnees2['FCT_Nom']); ?>
                                                        </option>
                                                    <?php
                                                    }
                                                    mysqli_free_result($reponse2);
                                                    ?>
                                                </optgroup>
                                            </select>
                                        </div>
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
            <br/><br/>
            * : Champs obligatoires.
        </form>
    </div>
<?php
include('footer.php');
?>