<?php
$pageTitle = "Edit temps";
$pwd = '../';
include('../bandeau.php');
$num = $_POST["NumC"];

$reponse = mysqli_query($db, "SELECT SAL_NumSalarie, CHA_NumDevis, TRA_NumTravail, PER_Nom, PER_Prenom, TRA_Date, TIME_FORMAT(TRA_Duree, '%H:%i')
as TRA_Duree FROM TempsTravail
JOIN Salaries using (SAL_NumSalarie)
JOIN Personnes using (PER_Num)
WHERE TRA_NumTravail='$num' ORDER BY TRA_Date ASC");
$donnees = mysqli_fetch_assoc($reponse);
?>
    <div id="corps">
        <div id="labelT">
            <label>Edition d'un temps de travail</label>
        </div>
        <br>

        <form method="post" action="tempsPost.php" name="tempsPost" id="tempsPost">
            <input type="hidden" name="NumC" id="NumC" value="<?php echo $num ?>"/>
            <table id="tempsPost" align="center" cellspacing="0px">
                <tr id="tempsPost">
                    <td style="text-align: right; width: 100px; padding-right: 10px;">
                        <label for="membre">Membre :</label>
                    </td>
                    <td>
                        <div class="selectProd" style="display: ;">
                            <select id="membre" name="membre">
                                <optgroup label="Membre actuel">
                                    <option
                                        value="<?php echo $donnees['SAL_NumSalarie']; ?>"><?php echo formatUP($donnees['PER_Nom']); ?>
                                        <?php echo formatLOW($donnees['PER_Prenom']); ?>
                                    </option>
                                </optgroup>
                                <optgroup label="Stagiaires">
                                    <?php
                                    $reponseTres = mysqli_query($db, "SELECT * FROM Salaries cl JOIN Personnes pe ON cl.PER_Num=pe.PER_Num Where TYP_Id = 6 ORDER BY PER_Nom");
                                    while ($donneesTres = mysqli_fetch_assoc($reponseTres)) {
                                        ?>
                                        <option
                                            value="<?php echo $donneesTres['SAL_NumSalarie']; ?>">
                                            <?php echo formatUP($donneesTres['PER_Nom']); ?> <?php echo formatLOW($donneesTres['PER_Prenom']); ?></option>
                                    <?php
                                    }
                                    mysqli_free_result($reponseTres);
                                    ?>
                                </optgroup>
                                <optgroup label="Salariés en Insertion">
                                    <?php
                                    $reponseTres = mysqli_query($db, "SELECT * FROM Salaries cl JOIN Personnes pe ON cl.PER_Num=pe.PER_Num Where TYP_Id = 7 ORDER BY PER_Nom");
                                    while ($donneesTres = mysqli_fetch_assoc($reponseTres)) {
                                        ?>
                                        <option
                                            value="<?php echo $donneesTres['SAL_NumSalarie']; ?>">
                                            <?php echo formatUP($donneesTres['PER_Nom']); ?> <?php echo formatLOW($donneesTres['PER_Prenom']); ?></option>
                                    <?php
                                    }
                                    mysqli_free_result($reponseTres);
                                    ?>
                                </optgroup>
                                <optgroup label="Atelier Occupationnel">
                                    <?php
                                    $reponseTres = mysqli_query($db, "SELECT * FROM Salaries cl JOIN Personnes pe ON cl.PER_Num=pe.PER_Num Where TYP_Id = 8 ORDER BY PER_Nom");
                                    while ($donneesTres = mysqli_fetch_assoc($reponseTres)) {
                                        ?>
                                        <option
                                            value="<?php echo $donneesTres['SAL_NumSalarie']; ?>">
                                            <?php echo formatUP($donneesTres['PER_Nom']); ?> <?php echo formatLOW($donneesTres['PER_Prenom']); ?></option>
                                    <?php
                                    }
                                    mysqli_free_result($reponseTres);
                                    ?>
                                </optgroup>
                            </select>
                        </div>
                    </td>
                </tr>
                <tr id="placeholder_row_middle">
                    <td colspan="4">&nbsp;</td>
                </tr>
                <tr id="tempsPost">
                    <td style="text-align: right; width: 100px; padding-right: 10px;">
                        <label for="temps">Temps :</label>
                    </td>
                    <td>
                        <input required id="temps" step="300" name="temps" type="time" class="inputC"
                               value="<?php echo $donnees['TRA_Duree']; ?>">
                    </td>
                    <td style="text-align: right; width: 100px; padding-right: 10px;">
                        <label for="date">Date :</label>
                    </td>
                    <td>
                        <input required maxlength="100" style="width: 150px;" id="date" name="date" type="date"
                               class="inputC" value="<?php echo $donnees['TRA_Date']; ?>">
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
    </div>
<?php
include('../footer.php');
?>