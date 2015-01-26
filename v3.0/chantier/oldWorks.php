<?php
$pageTitle = "Chantiers Archivés";
$pwd='../';
include('../bandeau.php');
?>
    <script src="../js/sorttable.js"></script>
    <script>
        $(document).ready(function () {
            $('.tooltip').tooltipster();
        });
    </script>
    <div id="corps">
    <div id="labelT">
        <label>Liste des Chantiers Archivés</label>
    </div>
    <br>
    <form method="post" action="rangChantierOld.php" name="EditClient">
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
    <form method="post" action="rangChantierOld.php" name="EditClient">
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
    <div class="listeMembers">
        <table class="sortable" cellpadding="5">
            <thead>
            <tr>
                <td class="firstCol" style="text-align: center; width: 40px;">
                    <a>#</a>
                </td>
                <td style="text-align: center; width: 231px;">
                    <a>Chantier</a>
                </td>
                <td style="text-align: center; width: 155px;">
                    <a>Client</a>
                </td>
                <td style="text-align: center; width: 155px;">
                    <a>Responsable</a>
                </td>
                <td style="text-align: center; width: 155px; cursor: help;" class="sorttable_nosort tooltip"
                    title="Classement par défaut.">
                    Debut
                </td>
                <td style="text-align: center; width: 155px; cursor: help;" class="sorttable_nosort tooltip"
                    title="Vous ne pouvez pas classer par date de fin.">
                    <a>Fin</a>
                </td>
            </tr>
            </thead>
            <tbody>
            <?php
            $sorter = 'CHA_DateDebut';

            $reponse = mysqli_query($db, "SELECT * FROM ChantierMax Join TypeEtat ON IdMax=TYE_Id WHERE IdMax>3 ORDER BY CHA_NumDevis DESC");
            while ($donnees = mysqli_fetch_assoc($reponse)) {
                ?>
                <form method="get" action="detailChantier.php" name="detailClient">
                    <input type="hidden" name="NumC" value="">
                    <tr onclick="javascript:submitViewDetail('<?php echo $donnees['CHA_NumDevis']; ?>', 'detailClient');"
                        style="font-size: 14;">
                        <td><?php echo formatUP($donnees['CHA_NumDevis']); ?></td>
                        <td><?php echo formatLOW($donnees['CHA_Intitule']); ?></td>
                        <td><?php
                            if(empty($donnees['Client'])){
                                $cliN=$donnees['NumClient'];
                                $reponse2 = mysqli_query($db, "select PER_Nom, PER_Prenom from EmployerClient join Personnes USING (PER_Num) where CLI_NumClient=$cliN");
                                $donnees2 = mysqli_fetch_assoc($reponse2);
                                echo formatUP($donnees2['PER_Nom'])." ".formatLOW($donnees2['PER_Prenom']);
                            }
                            else{
                                echo formatUP($donnees['Client']);
                            }
                            ?></td>
                        <td><?php echo formatUP($donnees['Resp']); ?> <?php echo formatLOW($donnees['RespP']); ?></td>
                        <td><?php echo dater($donnees['CHA_DateDebut']); ?></td>
                        <td>
                            <?php
                            if ($donnees['IdMax'] == 4) {
                                echo dater($donnees['CHA_DateFinReel']);
                            }
                            else{
                                echo Refusé;
                            }
                            ?>
                        </td>
                    </tr>
                </form>
            <?php
            }
            mysqli_free_result($reponse);
            ?>
            </tbody>
        </table>
    </div>
    </div>
<?php
include('../footer.php');
?>