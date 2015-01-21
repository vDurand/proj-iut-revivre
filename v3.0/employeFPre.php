<?php
$pageTitle = "Detail Employé Fournisseur";
include('bandeau.php');
?>
    <div id="corps">
        <?php
        // Modification client
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
        $fonction = addslashes(mysqli_real_escape_string($db, formatLOW($_POST["Fonction"])));


        $query = "UPDATE Personnes SET PER_Nom = '$nom', PER_Prenom = '$prenom', PER_TelFixe = '$tel',
            PER_TelPort = '$port', PER_Fax = '$fax', PER_Email = '$email', PER_Adresse = '$add', PER_CodePostal = '$cp',
            PER_Ville = '$ville' WHERE Personnes.PER_Num = '$num'";
        $sql = mysqli_query($db, $query);
        $errr = mysqli_error($db);

        if ($sql) {

            $query = "UPDATE EmployerFourn SET EMF_Fonction = '$fonction' WHERE PER_Num = '$num'";
            $sql2 = mysqli_query($db, $query);

            if ($sql2) {
                echo '<div id="good">
            <label>Employé modifié avec succes</label>
            </div>';

                $queryEmploye = mysqli_query($db, "SELECT * FROM Fournisseurs fo JOIN EmployerFourn em ON fo.FOU_NumFournisseur=em.FOU_NumFournisseur JOIN Personnes pe ON em.PER_Num=pe.PER_Num WHERE em.PER_Num=$num");
                $donneesEmp = mysqli_fetch_assoc($queryEmploye);
                $nom = formatUP($donneesEmp['PER_Nom']);
                $prenom = formatLow($donneesEmp['PER_Prenom']);
                $add = formatLOW($donneesEmp['PER_Adresse']);
                $cp = $donneesEmp['PER_CodePostal'];
                $ville = formatUP($donneesEmp['PER_Ville']);
                $tel = $donneesEmp['PER_TelFixe'];
                $port = $donneesEmp['PER_TelPort'];
                $fax = $donneesEmp['PER_Fax'];
                $mail = $donneesEmp['PER_Email'];
                $fct = formatLOW($donneesEmp['EMF_Fonction']);
                $struc = $donneesEmp['FOU_Nom'];
                mysqli_free_result($queryPart);

                ?>
                <div id="labelT">
                <label><?php echo $struc; ?> : Détail de l'employé</label>
                </div>
                <br>
                <table id="fullTable" rules="all">
                    <td>
                        <table cellpadding="10" class="detailClients">
                            <tr>
                                <th style="text-align: left; width: 200px; white-space: normal;">Nom :</th>
                                <td style="text-align: left; width: 300px;"><?php echo $nom; ?></td>
                            </tr>
                            <tr>
                                <th style="text-align: left; width: 200px; white-space: normal;">Prenom :</th>
                                <td style="text-align: left; width: 300px;"><?php echo $prenom; ?></td>
                            </tr>
                            <tr>
                                <th style="text-align: left; width: 200px; white-space: normal;">Telephone Fixe :</th>
                                <td style="text-align: left; width: 300px;"><?php echo $tel; ?></td>
                            </tr>
                            <tr>
                                <th style="text-align: left; width: 200px; white-space: normal;">Telephone Portable :</th>
                                <td style="text-align: left; width: 300px;"><?php echo $port; ?></td>
                            </tr>
                            <tr>
                                <th style="text-align: left; width: 200px; white-space: normal;">Fax :</th>
                                <td style="text-align: left; width: 300px;"><?php echo $fax; ?></td>
                            </tr>
                        </table>
                    </td>
                    <td>
                        <table cellpadding="10" class="detailClients">
                            <tr>
                                <th style="text-align: left; width: 200px; white-space: normal;">Email :</th>
                                <td style="text-align: left; width: 300px;"> 	<A HREF="mailto:<?php echo $mail;?>"> <?php echo $mail; ?></A></td>
                            </tr>
                            <tr>
                                <th style="text-align: left; width: 200px; white-space: normal;">Adresse :</th>
                                <td style="text-align: left; width: 300px;"><?php echo $add; ?></td>
                            </tr>
                            <tr>
                                <th style="text-align: left; width: 200px; white-space: normal;">Ville :</th>
                                <td style="text-align: left; width: 300px;"><?php echo $ville; ?></td>
                            </tr>
                            <tr>
                                <th style="text-align: left; width: 200px; white-space: normal;">Code Postal :</th>
                                <td style="text-align: left; width: 300px;"><?php echo $cp; ?></td>
                            </tr>
                            <tr>
                                <th style="text-align: left; width: 200px; white-space: normal;">Fonction :</th>
                                <td style="text-align: left; width: 300px;"><?php echo $fct; ?></td>
                            </tr>
                        </table>
                    </td>
                </table>
                <form method="post" action="editEmployeF.php" name="EditEmp">
                    <input type="hidden" name="NumC" value="<?php echo $num; ?>">
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
              <label>L\'employé n a pas pu etre modifie</label>
              </div>';
            }
        }
        mysqli_free_result($sql1);
        mysqli_free_result($sql2);
        ?>
    </div>
<?php
include('footer.php');
?>