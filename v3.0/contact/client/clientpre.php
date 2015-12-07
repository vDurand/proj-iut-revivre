<?php
$pageTitle = "Detail Client";
$pwd='../../';
include('../../bandeau.php');
?>
    <div id="corps">
        <?php
        // Modification client
        $num = $_POST["NumC"];
        $nom = addslashes(mysqli_real_escape_string($db, formatUP($_POST["Nom"])));
        if (!empty ($_POST["Prenom"])) {
            $prenom = addslashes(mysqli_real_escape_string($db, formatLOW($_POST["Prenom"])));
        }
        $tel = addslashes(mysqli_real_escape_string($db, $_POST["Tel_Fixe"]));
        $port = addslashes(mysqli_real_escape_string($db, $_POST["Portable"]));
        $fax = addslashes(mysqli_real_escape_string($db, $_POST["Fax"]));
        $email = addslashes(mysqli_real_escape_string($db, $_POST["Email"]));
        $add = addslashes(mysqli_real_escape_string($db, formatLOW($_POST["Adresse"])));
        $cp = addslashes($_POST["Code_Postal"]);
        $ville = addslashes(mysqli_real_escape_string($db, formatUP($_POST["Ville"])));
        $struct = addslashes($_POST["Struct"]);
		$sql = false;
		$sql2=false;
        if ($struct == "Particulier") {
            $query = "UPDATE Personnes SET PER_Nom = '$nom', PER_Prenom = '$prenom', PER_TelFixe = '$tel',
            PER_TelPort = '$port', PER_Fax = '$fax', PER_Email = '$email', PER_Adresse = '$add', PER_CodePostal = '$cp',
            PER_Ville = '$ville' WHERE Personnes.PER_Num = '$num'";

            $sql = mysqli_query($db, $query);
            $errr = mysqli_error($db);

            $queryNum = mysqli_query($db, "SELECT CLI_NumClient FROM EmployerClient WHERE PER_Num=$num");
            $donneesNum = mysqli_fetch_assoc($queryNum);
            $numC = $donneesNum['CLI_NumClient'];
        }

        if ($struct == "Entreprise") {
            $query = "UPDATE Clients SET CLI_Nom = '$nom', CLI_Telephone = '$tel', CLI_Portable = '$port', CLI_Fax = '$fax',
            CLI_Email = '$email', CLI_Adresse = '$add', CLI_CodePostal = '$cp', CLI_Ville = '$ville' WHERE Clients.CLI_NumClient = '$num'";

            $sql2 = mysqli_query($db, $query);
            $errr = mysqli_error($db);
            $numC = $num;

        }

        if ($sql || $sql2) {
            echo '<div id="good">
            <label>Client modifie avec succes</label>
            </div>';

            $queryStruc = mysqli_query($db, "SELECT * FROM Clients WHERE CLI_NumClient=$numC");
            $donneesStruc = mysqli_fetch_assoc($queryStruc);
            if (!empty($donneesStruc['CLI_Nom'])) {
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
                <label>Détail du Client</label>
            </div>
            <br>
            <table id="fullTable" rules="all">
                <td>
                    <table cellpadding="10" class="detailClients">
                        <tr>
                            <th style="text-align: left; width: 200px; white-space: normal;">Nom :</th>
                            <td style="text-align: left; width: 300px;"><?php echo $nom; ?></td>
                        </tr>
                        <?php if (!empty($prenom)) { ?>
                            <tr>
                                <th style="text-align: left; width: 200px; white-space: normal;">Prenom :</th>
                                <td style="text-align: left; width: 300px;"><?php echo $prenom; ?></td>
                            </tr>
                        <?php } ?>
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
                        <?php if (empty($prenom)) { ?>
                            <tr>
                                <th style="text-align: left; width: 200px; white-space: normal;">&nbsp;</th>
                                <td style="text-align: left; width: 300px;">&nbsp;</td>
                            </tr>
                        <?php } ?>
                    </table>
                </td>
                <td>
                    <table cellpadding="10" class="detailClients">
                        <tr>
                            <th style="text-align: left; width: 200px; white-space: normal;">Email :</th>
                            <td style="text-align: left; width: 300px;"><A
                                    HREF="mailto:<?php echo $mail; ?>"> <?php echo $mail; ?></A></td>
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
                            <th style="text-align: left; width: 200px; white-space: normal;">Structure :</th>
                            <td style="text-align: left; width: 300px;"><?php echo $struc; ?></td>
                        </tr>
                    </table>
                </td>
            </table>
            <form method="post" action="editClient.php" name="EditClient">
                <input type="hidden" name="NumC" value="<?php echo $numC; ?>">
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
              <label>Le client n a pas pu etre modifie</label>
              </div>';
        }
        ?>
    </div>
<?php
include('../../footer.php');
?>