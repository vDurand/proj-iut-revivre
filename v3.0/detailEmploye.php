<?php
/**
 * Created by Valentin Durand
 * IUT Caen - DUT Informatique
 * Date: 29/12/14
 * Time: 01:58
 */
$pageTitle = "Detail Employé Client";
include('bandeau.php');
?>
    <div id="corps">
<?php
    $numC=intval($_GET["NumC"]);
    if (is_numeric($_GET["NumC"])){
        $queryEmploye = mysqli_query($db, "SELECT * FROM EmployerClient em JOIN Personnes pe ON em.PER_Num=pe.PER_Num WHERE em.PER_Num=$numC");
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
            $fct = $donneesEmp['EMC_Fonction'];
            mysqli_free_result($queryPart);
?>
            <div id="labelT">
                <label>Detail de l'employé</label>
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
                            <th style="text-align: left; width: 200px; white-space: normal;">Fonction :</th>
                            <td style="text-align: left; width: 300px;"><?php echo $fct; ?></td>
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