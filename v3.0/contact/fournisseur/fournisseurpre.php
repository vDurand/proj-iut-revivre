<?php
$pwd='../../';
include('../../bandeau.php');
?>
    <div id="corps">
        <?php
        // Modification client
        $num = $_POST["NumC"];
        $nom = addslashes(mysqli_real_escape_string($db, formatUP($_POST["Nom"])));
        $tel = addslashes(mysqli_real_escape_string($db, $_POST["Tel_Fixe"]));
        $port = addslashes(mysqli_real_escape_string($db, $_POST["Portable"]));
        $fax = addslashes(mysqli_real_escape_string($db, $_POST["Fax"]));
        $email = addslashes(mysqli_real_escape_string($db, $_POST["Email"]));
        $add = addslashes(mysqli_real_escape_string($db, formatLOW($_POST["Adresse"])));
        $cp = addslashes($_POST["Code_Postal"]);
        $ville = addslashes(mysqli_real_escape_string($db, formatUP($_POST["Ville"])));

        $query = "UPDATE Fournisseurs SET FOU_Nom = '$nom', FOU_Telephone = '$tel', FOU_Portable = '$port', FOU_Fax = '$fax',
                  FOU_Email = '$email', FOU_Adresse = '$add', FOU_CodePostal = '$cp', FOU_Ville = '$ville'
                  WHERE FOU_NumFournisseur='$num'";

        $sql = mysqli_query($db, $query);
        $errr = mysqli_error($db);

        if ($sql) {
            echo '<div id="good">
            <label>Fournisseur modifie avec succes</label>
            </div>';
            $queryFourn = mysqli_query($db, "SELECT * FROM Fournisseurs WHERE FOU_NumFournisseur='$num'");
            $fourn = mysqli_fetch_assoc($queryFourn);
            ?>
            <div id="labelT">
                <label>Détail du Fournisseur</label>
            </div>
            <br>
            <table id="fullTable" rules="all">
                <tr>
                    <td>
                        <table cellpadding="10" class="detailClients">
                            <tr>
                                <th style="text-align: left; width: 200px; white-space: normal;">Nom :</th>
                                <td style="text-align: left; width: 300px;"><?php echo formatUP($fourn['FOU_Nom']); ?></td>
                            </tr>
                            <tr>
                                <th style="text-align: left; width: 200px; white-space: normal;">Telephone Fixe :
                                </th>
                                <td style="text-align: left; width: 300px;"><?php echo $fourn['FOU_Telephone']; ?></td>
                            </tr>
                            <tr>
                                <th style="text-align: left; width: 200px; white-space: normal;">Telephone Portable
                                    :
                                </th>
                                <td style="text-align: left; width: 300px;"><?php echo $fourn['FOU_Portable']; ?></td>
                            </tr>
                            <tr>
                                <th style="text-align: left; width: 200px; white-space: normal;">Fax :</th>
                                <td style="text-align: left; width: 300px;"><?php echo $fourn['FOU_Fax']; ?></td>
                            </tr>
                        </table>
                    </td>
                    <td>
                        <table cellpadding="10" class="detailClients">
                            <tr>
                                <th style="text-align: left; width: 200px; white-space: normal;">Email :</th>
                                <td style="text-align: left; width: 300px;"><A
                                        HREF="mailto:<?php echo $fourn['FOU_Email']; ?>"> <?php echo $fourn['FOU_Email']; ?></A>
                                </td>
                            </tr>
                            <tr>
                                <th style="text-align: left; width: 200px; white-space: normal;">Adresse :</th>
                                <td style="text-align: left; width: 300px;"><?php echo formatLOW($fourn['FOU_Adresse']); ?></td>
                            </tr>
                            <tr>
                                <th style="text-align: left; width: 200px; white-space: normal;">Ville :</th>
                                <td style="text-align: left; width: 300px;"><?php echo formatUP($fourn['FOU_Ville']); ?></td>
                            </tr>
                            <tr>
                                <th style="text-align: left; width: 200px; white-space: normal;">Code Postal :</th>
                                <td style="text-align: left; width: 300px;"><?php echo $fourn['FOU_CodePostal']; ?></td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
            <!--      Button Line-->
            <table id="downT">
                <tr>
                    <td>
                            <span>
                                <form method="post" action="editFournisseur.php" name="EditFournisseur">
                                    <input type="hidden" name="NumC"
                                           value="<?php echo $fourn['FOU_NumFournisseur']; ?>">
                                    <input name="submit" type="submit" value="Modifier" class="buttonC">
                                </form>
                            </span>
                    </td>
                </tr>
            </table>
        <?php
        } else {
            echo '<div id="bad">
                          <label>Le Fournisseur n a pas pu etre modifie</label>
                          </div>';
        }
        mysqli_free_result($reponse);
        ?>
    </div>
<?php
include('../../footer.php');
?>