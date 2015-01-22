<?php
$pageTitle = "Detail Fournisseur";
include('bandeau.php');
?>
    <div id="corps">
        <?php
        $num = intval($_GET["NumC"]);

        if (is_numeric($num)) {

            $queryFourn = mysqli_query($db, "SELECT * FROM Fournisseurs WHERE FOU_NumFournisseur='$num'");
            $fourn = mysqli_fetch_assoc($queryFourn);
            if ($fourn) {
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
                                    <input type="hidden" name="NumC" value="<?php echo $fourn['FOU_NumFournisseur']; ?>">
                                    <input name="submit" type="submit" value="Modifier" class="buttonC">
                                </form>
                            </span>
                        </td>
                        <form method="post" action="addEmploye.php" name="AddEmploye">
                            <input type="hidden" name="NumF" value="<?php echo $fourn['FOU_NumFournisseur']; ?>">
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
                if (mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM EmployerFourn WHERE FOU_NumFournisseur=$num"))) {

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
                    $queryEmpl = mysqli_query($db, "SELECT * FROM EmployerFourn em JOIN Personnes pe ON em.PER_Num=pe.PER_Num WHERE FOU_NumFournisseur=$num");
                    while ($empl = mysqli_fetch_assoc($queryEmpl))
                    {
                        ?>
                        <form method="get" action="detailEmployeF.php" name="detailEmploye">
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
                    <!-- List Produits -->
                <?php
                }
                if (mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM Acheter WHERE FOU_NumFournisseur='$num'"))) {

                    ?>
                    <div id="labelCat">
                        Liste des Achats
                    </div>
                    <div class="listeMembers" style="margin-bottom: 15px;">
                    <table>
                    <thead>
                    <tr>
                        <td class="firstCol" style="text-align: center;">
                            <a>Achat</a>
                        </td>
                        <td style="text-align: center;">
                            <a>Date</a>
                        </td>
                        <td style="text-align: center;">
                            <a>Montant</a>
                        </td>
                        <td style="text-align: center;">
                            <a>Chantier</a>
                        </td>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $queryAchat = mysqli_query($db, "SELECT * FROM Acheter JOIN Chantiers USING (CHA_NumDevis) WHERE FOU_NumFournisseur='$num'");
                    while ($achat = mysqli_fetch_assoc($queryAchat)) {
                        ?>
                        <tr style="font-size: 14;">
                            <td><?php echo $achat['ACH_TypeAchat']; ?></td>
                            <td><?php echo dater($achat['ACH_Date']); ?></td>
                            <td><?php echo $achat['ACH_Montant']; ?> €</td>
                            <td><?php echo $achat['CHA_Intitule']; ?></td>
                        </tr>
                    <?php
                    }
                    mysqli_free_result($queryAchat);
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
        mysqli_free_result($queryFourn);
        ?>
    </div>
<?php
include('footer.php');
?>