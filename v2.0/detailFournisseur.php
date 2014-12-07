<?php
$pageTitle = "Detail Fournisseur";
include('bandeau.php');
?>
    <div id="corps">
        <?php
        $num = intval($_GET["NumC"]);

        if (is_numeric($num)) {

            $reponse = mysqli_query($db, "SELECT * FROM Fournisseurs cl JOIN Personnes pe ON cl.PER_Num=pe.PER_Num WHERE FOU_NumFournisseur='$num'");
            $donnees = mysqli_fetch_assoc($reponse);
            if ($donnees) {
                ?>
                <div id="labelT">
                    <label>Detail du Fournisseur</label>
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
                                <?php if ($donnees['FOU_Structure'] != "Structure") { ?>
                                    <tr>
                                        <th style="text-align: left; width: 200px; white-space: normal;">Prenom :</th>
                                        <td style="text-align: left; width: 300px;"><?php echo formatLOW($donnees['PER_Prenom']); ?></td>
                                    </tr>
                                <?php } ?>
                                <tr>
                                    <th style="text-align: left; width: 200px; white-space: normal;">Telephone Fixe :
                                    </th>
                                    <td style="text-align: left; width: 300px;"><?php echo $donnees['PER_TelFixe']; ?></td>
                                </tr>
                                <tr>
                                    <th style="text-align: left; width: 200px; white-space: normal;">Telephone Portable
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
                                    <th style="text-align: left; width: 200px; white-space: normal;">Code Postal :</th>
                                    <td style="text-align: left; width: 300px;"><?php echo $donnees['PER_CodePostal']; ?></td>
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
                      <input type="hidden" name="NumC" value="<?php echo $donnees['FOU_NumFournisseur']; ?>">
                      <input name="submit" type="submit" value="Modifier" class="buttonC">
                  </form>
              </span>
                        </td>
                        <td>
                <span>
                  <input name="submit" type="submit" onclick="addProd()" value="Ajouter Produit" class="buttonC">
                </span>
                        </td>
                    </tr>
                </table>
                <!-- List Produits -->
                <?php
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
                    $reponse5 = mysqli_query($db, "SELECT * FROM Acheter JOIN Chantiers USING (CHA_NumDevis) WHERE FOU_NumFournisseur='$num'");
                    while ($donnees5 = mysqli_fetch_assoc($reponse5)) {
                        ?>
                        <tr style="font-size: 14;">
                            <td><?php echo $donnees5['ACH_TypeAchat']; ?></td>
                            <td><?php echo dater($donnees5['ACH_Date']); ?></td>
                            <td><?php echo $donnees5['ACH_Montant']; ?> €</td>
                            <td><?php echo $donnees5['CHA_Intitule']; ?></td>
                        </tr>
                    <?php
                    }
                    mysqli_free_result($reponse5);
                }
                ?>
                </tbody>
                </table>
                </div>


            <?php
            } else {
                echo "<div id='error'>ERROR : WRONG NUMBER</div>";
            }
        } else {
            echo "<div id='error'>ERROR : NUMBER ONLY</div>";
        }
        mysqli_free_result($reponse);
        ?>
    </div>
<?php
include('footer.php');
?>