<?php
$pageTitle = "Edit achat";
$pwd = '../';
include('../bandeau.php');

$num = $_POST['NumC'];

$reponse = mysqli_query($db, "SELECT * FROM Acheter JOIN TypeAchat USING(TAC_Id) JOIN Fournisseurs USING (FOU_NumFournisseur) WHERE ACH_NumAchat='$num' ORDER BY ACH_Date ASC");
$donnees = mysqli_fetch_assoc($reponse);
?>
    <div id="corps">
        <div id="labelT">
            <label>Editer un Achat</label>
        </div>
        <br>

        <form method="post" action="achatPost.php" name="achatPost" id="achatPost">
            <input type="hidden" name="NumC" value="<?php echo $donnees['ACH_NumAchat'] ?>"/>
            <table id="achatEdit" align="center" cellspacing="0px">
                <tr id="Ajout-Tps">
                    <td style="text-align: right; width: 100px; padding-right: 10px;">
                        <label for="fourn">Fournisseur :</label>
                    </td>
                    <td>
                        <div id="ProdSelector" class="selectProd" style="display: ;">
                            <select id="fourn" name="fourn">
                                <optgroup label="Fournisseur actuel">
                                    <option
                                        value="<?php echo $donnees['FOU_NumFournisseur']; ?>"><?php echo formatUP($donnees['FOU_Nom']); ?>
                                        &nbsp;&nbsp;&nbsp;
                                        (<?php echo formatLOW($donnees['FOU_Ville']) . " " . $donnees['FOU_CodePostal']; ?>
                                        )
                                    </option>
                                </optgroup>
                                <optgroup label="Fournisseurs disponibles">
                                    <?php
                                    $reponse2 = mysqli_query($db, "SELECT * FROM Fournisseurs ORDER BY FOU_Nom");
                                    while ($donnees2 = mysqli_fetch_assoc($reponse2)) {
                                        ?>
                                        <option
                                            value="<?php echo $donnees2['FOU_NumFournisseur']; ?>"><?php echo formatUP($donnees2['FOU_Nom']); ?>
                                            &nbsp;&nbsp;&nbsp;
                                            (<?php echo formatLOW($donnees2['FOU_Ville']) . " " . $donnees2['FOU_CodePostal']; ?>
                                            )
                                        </option>
                                    <?php
                                    }
                                    mysqli_free_result($reponse);
                                    ?>
                                </optgroup>
                            </select>
                        </div>
                    </td>
                    <td style="text-align: right; width: 100px; padding-right: 10px;">
                        <label for="montant">Montant :</label>
                    </td>
                    <td>
                        <input required min="0.01" style="width: 125px;" id="montant" name="montant" type="number"
                               step="0.01" class="inputC" value="<?php echo $donnees['ACH_Montant'] ?>">&nbsp;&nbsp;€
                    </td>
                </tr>
                <tr id="Ajout-Tpss">
                    <td style="text-align: right; width: 100px; padding-right: 10px;">
                        <label for="type">Type :</label>
                    </td>
                    <td>
                        <div id="ProdSelector" class="selectProd" style="display: ;">
                            <select id="type" name="type">
                                <optgroup label="Type actuel">
                                    <option
                                        value="<?php echo $donnees['TAC_Id']; ?>"><?php echo formatLow($donnees['TAC_Type']); ?>
                                    </option>
                                </optgroup>
                                <optgroup label="Types disponibles">
                                    <?php
                                    $reponse2 = mysqli_query($db, "SELECT * FROM TypeAchat ORDER BY TAC_Type");
                                    while ($donnees2 = mysqli_fetch_assoc($reponse2)) {
                                        ?>
                                        <option
                                            value="<?php echo $donnees2['TAC_Id']; ?>"><?php echo formatLow($donnees2['TAC_Type']); ?>
                                        </option>
                                    <?php
                                    }
                                    mysqli_free_result($reponse);
                                    ?>
                                </optgroup>
                            </select>
                        </div>
                    </td>
                    <td style="text-align: right; width: 100px; padding-right: 10px;">
                        <label for="date">Date d'achat :</label>
                    </td>
                    <td style="padding-bottom: 10px;">
                        <input id="date" required maxlength="100" style="width: 150px;" name="date" type="date"
                               class="inputC" value="<?php echo $donnees['ACH_Date'] ?>">
                    </td>
                </tr>
                <tr id="placeholder_row_bottom"></tr>
            </table>
            <br/>
            <table id="downT">
                <tr>
                    <td>
							<span>
								<input name="submit" type="submit" value="Valider" class="buttonC">&nbsp;&nbsp;
							</span>
                    </td>
                    <td>
                        <input name="reset" type="reset" value="Annuler" class="buttonC">
        </form>
        </td>
        <td>
            <form id="return" method="get" action="detailChantier.php" name="detailClient">
                <input form="return" type="hidden" name="NumC" value="<?php echo $donnees['CHA_NumDevis']; ?>">
                <input form="return" name="submit" type="submit" value="Retour" class="buttonC">
            </form>
        </td>
        </tr>
        </table>
        </form>
    </div>
<?php
include('../footer.php');
?>