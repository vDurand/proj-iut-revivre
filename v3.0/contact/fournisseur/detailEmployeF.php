<?php
$pageTitle = "Detail Employé Fournisseur";
$pwd='../../';
include('../../bandeau.php');
?>
    <div id="corps">
        <?php
        $numC=intval($_GET["NumC"]);
        if (is_numeric($_GET["NumC"])){
            $queryEmploye = mysqli_query($db, "SELECT * FROM Fournisseurs fo JOIN EmployerFourn em ON fo.FOU_NumFournisseur=em.FOU_NumFournisseur JOIN Personnes pe ON em.PER_Num=pe.PER_Num WHERE em.PER_Num=$numC");
            $donneesEmp = mysqli_fetch_assoc($queryEmploye);
            if ($donneesEmp) {
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
                mysqli_free_result($queryEmploye);
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
                    <input type="hidden" name="NumC" value="<?php echo $numC; ?>">
                    <table id="downT">
                        <tr>
                            <td>
              <span>
                <input name="submit" type="submit" value="Modifier" class="buttonC">
                <input name="retour" type="button" value="Retour"   class="buttonC" onclick="window.location.replace('<?php echo $pwd; ?>contact/fournisseur/viewFournEmp.php');">

              </span>
                            </td>
                        </tr>
                    </table>
                </form>
            <?php
            } else {
                echo "<div id='error'>ERROR : WRONG NUMBER</div>";
            }
        } else {
            echo "<div id='error'>ERROR : NUMBER ONLY</div>";
        }

        ?>
    </div>
<?php
include('../../footer.php');
?>