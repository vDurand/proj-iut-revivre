<?php
$pageTitle = "Detail Référent";
$pwd='../../';
include('../../bandeau.php');
?>
    <div id="corps">
        <?php
        // Modification Référent
        $num = $_POST["NumC"];
        $nom = addslashes(mysqli_real_escape_string($db, formatUP($_POST["Nom"])));
        $prenom = addslashes(mysqli_real_escape_string($db, formatLOW($_POST["Prenom"])));
        $tel = addslashes(mysqli_real_escape_string($db, $_POST["Tel_Fixe"]));
        $port = addslashes(mysqli_real_escape_string($db, $_POST["Portable"]));
        $fax = addslashes(mysqli_real_escape_string($db, $_POST["Fax"]));
        $email = addslashes(mysqli_real_escape_string($db, $_POST["Email"]));
        $add = addslashes(mysqli_real_escape_string($db, formatLOW($_POST["Adresse"])));
        $cp = addslashes($_POST["Code_Postal"]);
        $ville = addslashes(mysqli_real_escape_string($db, formatUP($_POST["Ville"])));
        $prescript = addslashes($_POST["Prescript"]);


        $query = "UPDATE Personnes SET PER_Nom = '$nom', PER_Prenom = '$prenom', PER_TelFixe = '$tel',
            PER_TelPort = '$port', PER_Fax = '$fax', PER_Email = '$email', PER_Adresse = '$add', PER_CodePostal = '$cp',
            PER_Ville = '$ville' WHERE PER_Num = (SELECT PER_Num FROM Referents WHERE REF_NumRef = '$num')";
        $sql = mysqli_query($db, $query);
        $errr = mysqli_error($db);

        if ($sql) {

            $query = "UPDATE Referents SET PRE_Id = '$prescript' WHERE REF_NumRef = '$num'";
            $sql2 = mysqli_query($db, $query);

            if ($sql2) {
                echo '<div id="good">
            <label>Référent modifié avec succès</label>
            </div>';

                $reponse = mysqli_query($db, "SELECT * FROM Referents cl JOIN Personnes pe ON cl.PER_Num=pe.PER_Num JOIN Prescripteurs ty ON cl.PRE_Id=ty.PRE_Id WHERE REF_NumRef='$num' ORDER BY PER_Nom");
                $donnees = mysqli_fetch_assoc($reponse);
                ?>
                <div id="labelT">
                    <label>Detail du Référent</label>
                </div>
                <br>
                <table id="fullTable" rules="all">
                    <tr>
                        <td>
                            <table cellpadding="10" class="detailClients">
                                <tr>
                                    <th style="text-align: left; width: 200px; white-space: normal;">Nom :</th>
                                    <td style="text-align: left; width: 300px;"><?php echo formatUP($donnees['PER_Nom']); ?></td>
                                </tr>
                                <tr>
                                    <th style="text-align: left; width: 200px; white-space: normal;">Prénom :</th>
                                    <td style="text-align: left; width: 300px;"><?php echo formatLOW($donnees['PER_Prenom']); ?></td>
                                </tr>
                                <tr>
                                    <th style="text-align: left; width: 200px; white-space: normal;">Téléphone Fixe
                                        :
                                    </th>
                                    <td style="text-align: left; width: 300px;"><?php echo $donnees['PER_TelFixe']; ?></td>
                                </tr>
                                <tr>
                                    <th style="text-align: left; width: 200px; white-space: normal;">Téléphone
                                        Portable
                                        :
                                    </th>
                                    <td style="text-align: left; width: 300px;"><?php echo $donnees['PER_TelPort']; ?></td>
                                </tr>
                                <tr>
                                    <th style="text-align: left; width: 200px; white-space: normal;">Fax :</th>
                                    <td style="text-align: left; width: 300px;"><?php echo $donnees['PER_Fax']; ?></td>
                                </tr>
                            </table>
                        </td>
                        <td>
                            <table cellpadding="10" class="detailClients">
                                <tr>
                                    <th style="text-align: left; width: 200px; white-space: normal;">Email :</th>
                                    <td style="text-align: left; width: 300px;"><A
                                            HREF="mailto:<?php echo $donnees['PER_Email']; ?>"> <?php echo $donnees['PER_Email']; ?></A>
                                    </td>
                                </tr>
                                <tr>
                                    <th style="text-align: left; width: 200px; white-space: normal;">Adresse :</th>
                                    <td style="text-align: left; width: 300px;"><?php echo formatLOW($donnees['PER_Adresse']); ?></td>
                                </tr>
                                <tr>
                                    <th style="text-align: left; width: 200px; white-space: normal;">Ville :</th>
                                    <td style="text-align: left; width: 300px;"><?php echo formatUP($donnees['PER_Ville']); ?></td>
                                </tr>
                                <tr>
                                    <th style="text-align: left; width: 200px; white-space: normal;">Code Postal :
                                    </th>
                                    <td style="text-align: left; width: 300px;"><?php echo $donnees['PER_CodePostal']; ?></td>
                                </tr>
                                <tr>
                                    <th style="text-align: left; width: 200px; white-space: normal;">Prescripteur
                                        :
                                    </th>
                                    <td style="text-align: left; width: 300px;"><?php echo $donnees['PRE_Nom']; ?></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
                <form method="post" action="editRef.php" name="EditRef">
                    <input type="hidden" name="NumC" value="<?php echo $donnees['REF_NumRef']; ?>">
                    <table id="downT">
                        <tr>
                            <td>
              <span>
                <input name="submit" type="submit" value="Modifier" class="buttonC">
              </span>
                            </td>
                        </tr>
                    </table>
                </form>
            <?php
            } else {
                echo '<div id="bad">
              <label>Le référent n a pas pu etre modifie</label>
              </div>';
            }
        } else {
            echo '<div id="bad">
              <label>Le référent n a pas pu etre modifie</label>
              </div>';
        }
        mysqli_free_result($sql1);
        mysqli_free_result($sql2);
        ?>
    </div>
<?php
include('../../footer.php');
?>