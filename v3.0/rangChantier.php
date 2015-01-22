<?php
$pageTitle = "Chantiers";
include('bandeau.php');
?>
    <script src="js/sorttable.js"></script>
    <script>
        $(document).ready(function () {
            $('.tooltip').tooltipster();
        });
    </script>
    <div id="corps">
    <div id="labelT">
        <label>Liste des Chantiers</label>
    </div>
    <br>

    <form method="post" action="rangChantier.php" name="EditClient">
        <table>
            <tr>
                <td style="text-align: left; white-space: normal;">
                    <label for="Nom">Nom :</label>
                </td>
                <td>
                    <input id="Nom" maxlength="255" name="Nom" type="text"
                           class="inputC" autofocus="autofocus">
                    <input name="submit" type="submit" value="Rechercher">
                </td>
            </tr>
        </table>
    </form>
    <form method="post" action="rangChantier.php" name="EditClient">
        <table id="alphaL">
            <tr>
                <td>
                    <div class="selectDrop">
                        <select name="trieur">
                            <option value="0">Client</option>
                            <option value="1">Responsable</option>
                        </select>
                    </div>
                </td>
                <td>
		              <span>
		                <input name="submit" type="submit" value="#" class="alphaButton">
		              </span>
                </td>
                <td>
		              <span>
		                <input name="submit" type="submit" value="A" class="alphaButton">
		              </span>
                </td>
                <td>
		              <span>
		                <input name="submit" type="submit" value="B" class="alphaButton">
		              </span>
                </td>
                <td>
		              <span>
		                <input name="submit" type="submit" value="C" class="alphaButton">
		              </span>
                </td>
                <td>
		              <span>
		                <input name="submit" type="submit" value="D" class="alphaButton">
		              </span>
                </td>
                <td>
		              <span>
		                <input name="submit" type="submit" value="E" class="alphaButton">
		              </span>
                </td>
                <td>
		              <span>
		                <input name="submit" type="submit" value="F" class="alphaButton">
		              </span>
                </td>
                <td>
		              <span>
		                <input name="submit" type="submit" value="G" class="alphaButton">
		              </span>
                </td>
                <td>
		              <span>
		                <input name="submit" type="submit" value="H" class="alphaButton">
		              </span>
                </td>
                <td>
		              <span>
		                <input name="submit" type="submit" value="I" class="alphaButton">
		              </span>
                </td>
                <td>
		              <span>
		                <input name="submit" type="submit" value="J" class="alphaButton">
		              </span>
                </td>
                <td>
		              <span>
		                <input name="submit" type="submit" value="K" class="alphaButton">
		              </span>
                </td>
                <td>
		              <span>
		                <input name="submit" type="submit" value="L" class="alphaButton">
		              </span>
                </td>
                <td>
		              <span>
		                <input name="submit" type="submit" value="M" class="alphaButton">
		              </span>
                </td>
                <td>
		              <span>
		                <input name="submit" type="submit" value="N" class="alphaButton">
		              </span>
                </td>
                <td>
		              <span>
		                <input name="submit" type="submit" value="O" class="alphaButton">
		              </span>
                </td>
                <td>
		              <span>
		                <input name="submit" type="submit" value="P" class="alphaButton">
		              </span>
                </td>
                <td>
		              <span>
		                <input name="submit" type="submit" value="Q" class="alphaButton">
		              </span>
                </td>
                <td>
		              <span>
		                <input name="submit" type="submit" value="R" class="alphaButton">
		              </span>
                </td>
                <td>
		              <span>
		                <input name="submit" type="submit" value="S" class="alphaButton">
		              </span>
                </td>
                <td>
		              <span>
		                <input name="submit" type="submit" value="T" class="alphaButton">
		              </span>
                </td>
                <td>
		              <span>
		                <input name="submit" type="submit" value="U" class="alphaButton">
		              </span>
                </td>
                <td>
		              <span>
		                <input name="submit" type="submit" value="V" class="alphaButton">
		              </span>
                </td>
                <td>
		              <span>
		                <input name="submit" type="submit" value="W" class="alphaButton">
		              </span>
                </td>
                <td>
		              <span>
		                <input name="submit" type="submit" value="X" class="alphaButton">
		              </span>
                </td>
                <td>
		              <span>
		                <input name="submit" type="submit" value="Y" class="alphaButton">
		              </span>
                </td>
                <td>
		              <span>
		                <input name="submit" type="submit" value="Z" class="alphaButton">
		              </span>
                </td>
            </tr>
        </table>
    </form>
    <table class="tableContact" cellpadding="5">
        <thead>
        <tr>
            <td class="firstCol" style="text-align: center; width: 41px;">
                <a>#</a>
            </td>
            <td style="text-align: center; width: 236px;">
                <a>Chantier</a>
            </td>
            <td style="text-align: center; width: 158px;">
                <a>Client</a>
            </td>
            <td style="text-align: center; width: 159px;">
                <a>Responsable</a>
            </td>
            <td style="text-align: center; width: 159px;">
                Debut
            </td>
            <td style="text-align: center; width: 158px;">
                <a>Fin</a>
            </td>
        </tr>
        </thead>
        <tbody>
        <?php
        $sorter = 'CHA_DateDebut';
        $alpha = $_POST["submit"] . '%';
        if ($_POST["trieur"] == 0) {
            $sorter = 'Client';
        }
        if ($_POST["trieur"] == 1) {
            $sorter = 'Resp';
        }
        if ($_POST["submit"] == '#') {
            $reponse = mysqli_query($db, "SELECT * FROM ChantierMax Join TypeEtat ON IdMax=TYE_Id ORDER BY CHA_DateDebut DESC");
        } else {
            if ($_POST["submit"] == 'Rechercher') {
                $nom = $_POST["Nom"] . '%';
                $reponse = mysqli_query($db, "SELECT * FROM ChantierMax Join TypeEtat ON IdMax=TYE_Id WHERE upper(CHA_Intitule) like upper('$nom') ORDER BY CHA_DateDebut DESC");
            } else {
                $reponse = mysqli_query($db, "SELECT * FROM ChantierMax Join TypeEtat ON IdMax=TYE_Id WHERE $sorter like '$alpha' ORDER BY $sorter");
            }
        }
        while ($donnees = mysqli_fetch_assoc($reponse)) {
            ?>
            <form method="get" action="detailChantier.php" name="detailClient">
                <input type="hidden" name="NumC" value="">
                <tr onclick="javascript:submitViewDetail('<?php echo $donnees['CHA_NumDevis']; ?>', 'detailClient');"
                    style="font-size: 14;">
                    <td><?php echo formatUP($donnees['CHA_NumDevis']); ?></td>
                    <td><?php echo formatLOW($donnees['CHA_Intitule']); ?></td>
                    <td><?php echo formatUP($donnees['Client']); ?></td>
                    <td><?php echo formatUP($donnees['Resp']); ?> <?php echo formatLOW($donnees['RespP']); ?></td>
                    <td><?php echo dater($donnees['CHA_DateDebut']); ?></td>
                    <td>
                        <?php
                        if ($donnees['IdMax'] == 4) {
                            echo dater($donnees['CHA_DateFinReel']);
                        } else {
                            echo $donnees['TYE_Nom'];
                        }
                        ?>
                    </td>
                </tr>
            </form>
        <?php
        }
        mysqli_free_result($reponse);
        if($_POST["submit"] != '#' && $_POST["submit"] != 'Rechercher'){
            $reponse = mysqli_query($db, "SELECT * FROM ChantierMax Join TypeEtat ON IdMax=TYE_Id JOIN EmployerClient ON NumClient=CLI_NumClient JOIN Personnes USING(PER_Num) WHERE PER_Nom like '$alpha' ORDER BY PER_Nom");
            while ($donnees = mysqli_fetch_assoc($reponse)) {
                ?>
                <form method="get" action="detailChantier.php" name="detailClient">
                    <input type="hidden" name="NumC" value="">
                    <tr onclick="javascript:submitViewDetail('<?php echo $donnees['CHA_NumDevis']; ?>', 'detailClient');"
                        style="font-size: 14;">
                        <td><?php echo formatUP($donnees['CHA_NumDevis']); ?></td>
                        <td><?php echo formatLOW($donnees['CHA_Intitule']); ?></td>
                        <td><?php echo formatUP($donnees['PER_Nom'])." ".formatLOW($donnees['PER_Prenom']); ?></td>
                        <td><?php echo formatUP($donnees['Resp']); ?> <?php echo formatLOW($donnees['RespP']); ?></td>
                        <td><?php echo dater($donnees['CHA_DateDebut']); ?></td>
                        <td>
                            <?php
                            if ($donnees['IdMax'] == 4) {
                                echo dater($donnees['CHA_DateFinReel']);
                            } else {
                                echo $donnees['TYE_Nom'];
                            }
                            ?>
                        </td>
                    </tr>
                </form>
            <?php
            }
            mysqli_free_result($reponse);
        }
        ?>
        </tbody>
    </table>
    </div>
<?php
include('footer.php');
?>