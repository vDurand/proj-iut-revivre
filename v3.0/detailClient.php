<?php
$pageTitle = "Detail Client";
include('bandeau.php');
?>
    <div id="corps">
    <?php
    $numC=intval($_GET["NumC"]);
    if (is_numeric($_GET["NumC"])){

        $queryStruc = mysqli_query($db, "SELECT * FROM Clients WHERE CLI_NumClient=$numC");
        $donneesStruc = mysqli_fetch_assoc($queryStruc);
        if ($donneesStruc) {
            if(!empty($donneesStruc['CLI_Nom'])){
                $nom = formatUP($donneesStruc['CLI_Nom']);
                $add = formatLOW($donneesStruc['CLI_Adresse']);
                $cp = $donneesStruc['CLI_CodePostal'];
                $ville = formatUP($donneesStruc['CLI_Ville']);
                $tel = $donneesStruc['CLI_Telephone'];
                $port = $donneesStruc['CLI_Portable'];
                $fax = $donneesStruc['CLI_Fax'];
                $mail = $donneesStruc['CLI_Email'];
                $struc = "Entreprise";
            }
            else{
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
            mysqli_free_result($queryStruc);
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
                            <th style="text-align: left; width: 200px; white-space: normal;">Structure :</th>
                            <td style="text-align: left; width: 300px;"><?php echo $struc; ?></td>
                        </tr>
                    </table>
                </td>
            </table>
            <table id="downT">
                <tr>
                    <form method="post" action="editClient.php" name="EditClient">
                        <input type="hidden" name="NumC" value="<?php echo $numC; ?>">
                        <td>
                            <span>
                                <input name="submit" type="submit" value="Modifier" class="buttonC">
                            </span>
                        </td>
                    </form>
                    <form method="post" action="addEmploye.php" name="AddEmploye">
                        <input type="hidden" name="NumC" value="<?php echo $numC; ?>">
                        <td>
                            <span>
                                <input name="submit" type="submit" value="Ajouter Employé" class="buttonC">
                            </span>
                        </td>
                    </form>
                </tr>
            </table>

            <!-- List Employes -->
            <?php
            if (mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM EmployerClient WHERE CLI_NumClient=$numC"))&&($struc == "Entreprise")) {

                ?>
                <div id="labelCat">
                    Liste des Employés
                </div>
                <div class="listeMembers" style="margin-bottom: 15px;">
                <table>
                <thead>
                <tr>
                    <td class="firstCol" style="text-align: center; width: 30px;">
                        <a>#</a>
                    </td>
                    <td style="text-align: center;">
                        <a>Nom</a>
                    </td>
                    <td style="text-align: center;">
                        <a>Prénom</a>
                    </td>
                    <td style="text-align: center;">
                        <a>Téléphone</a>
                    </td>
                    <td style="text-align: center;">
                        <a>Portable</a>
                    </td>
                    <td style="text-align: center;">
                        <a>Email</a>
                    </td>
                </tr>
                </thead>
                <tbody>
                <?php
                $i = 0;
                $queryEmpl = mysqli_query($db, "SELECT * FROM EmployerClient em JOIN Personnes pe ON em.PER_Num=pe.PER_Num WHERE CLI_NumClient=$numC");
                while ($empl = mysqli_fetch_assoc($queryEmpl))
                {
                    ?>
                    <form method="get" action="detailEmployeC.php" name="detailEmploye">
                        <input type="hidden" name="NumC" value="">
                        <tr onclick="javascript:submitViewDetail('<?php echo $empl['PER_Num']; ?>', 'detailEmploye')" style="font-size: 14;">
                            <td><?php $i++; echo $i; ?></td>
                            <td><?php echo $empl['PER_Nom']; ?></td>
                            <td><?php echo $empl['PER_Prenom']; ?></td>
                            <td><?php echo $empl['PER_TelFixe']; ?></td>
                            <td><?php echo $empl['PER_TelPort']; ?></td>
                            <td><?php echo $empl['PER_Email']; ?></td>
                        </tr>
                    </form>
                <?php
                }
                mysqli_free_result($queryEmpl);
                ?>
                </tbody>
                </table>
                </div>
                <!-- List Chantiers -->
            <?php
            }

            if (mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM Chantiers JOIN Commanditer USING(CHA_NumDevis) WHERE CLI_NumClient=$numC"))) {

                ?>
                <div id="labelCat">
                    Liste des Chantiers
                </div>
                <div class="listeMembers" style="margin-bottom: 15px;">
                <table>
                <thead>
                <tr>
                    <td class="firstCol" style="text-align: center; width: 30px;">
                        <a>#</a>
                    </td>
                    <td style="text-align: center;">
                        <a>Chantier</a>
                    </td>
                    <td style="text-align: center;">
                        <a>Adresse</a>
                    </td>
                    <td style="text-align: center;">
                        <a>Date de Début</a>
                    </td>
                    <td style="text-align: center;">
                        <a>Echeance</a>
                    </td>
                </tr>
                </thead>
                <tbody>
                <?php
                $i = 0;
                $queryChantiers = mysqli_query($db, "SELECT * FROM Chantiers JOIN Commanditer USING(CHA_NumDevis) WHERE CLI_NumClient=$numC");
                while ($chantiers = mysqli_fetch_assoc($queryChantiers))
                {
                    ?>
                    <tr style="font-size: 14;">
                        <td><?php $i++; echo $i; ?></td>
                        <td><?php echo $chantiers['CHA_Intitule']; ?></td>
                        <td><?php echo $chantiers['CHA_Adresse']; ?></td>
                        <td><?php echo dater($chantiers['CHA_DateDebut']); ?></td>
                        <td><?php echo dater($chantiers['CHA_Echeance']); ?></td>
                    </tr>
                <?php
                }
                mysqli_free_result($queryChantiers);
                ?>
                </tbody>
                </table>
                </div>
            <?php
            }

        } else {
            echo "<div id='error'>ERROR : WRONG NUMBER</div>";
        }
    } else {
        echo "<div id='error'>ERROR : NUMBER ONLY</div>";
    }

    ?>
    </div>
<?php
include('footer.php');
?>