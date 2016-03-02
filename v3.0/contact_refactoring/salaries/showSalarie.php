<?php
    $pageTitle = "Detail Salarié";
    $pwd='../../';
    include('../../bandeau.php');
?>
    <div id="corps">
    <?php
            $num = $_GET["NumC"];

            // récupération de la fonction de la personne (travailleur ou salaries internes)
            $reponse1 = mysqli_query($db,
                "SELECT * FROM Salaries WHERE SAL_NumSalarie='$num' ORDER BY PER_Num");
            $personne = mysqli_fetch_assoc($reponse1);

            // différence entre salaries et travailleurs
            if ($personne["FCT_Id"] == 0){ // travailleurs
                $reponse1 = mysqli_query($db, "SELECT * from Personnes
                                                JOIN Salaries using (PER_Num)
                                                JOIN Insertion using (SAL_NumSalarie)
                                                WHERE SAL_NumSalarie='$num'
                                                ORDER BY PER_Nom");
            }
            else{ // salaries
                $reponse1 = mysqli_query($db, "SELECT * from Personnes
                                                JOIN Salaries using (PER_Num)
                                                JOIN Fonction using (FCT_Id)
                                                WHERE SAL_NumSalarie='$num'
                                                ORDER BY PER_Nom");
            }
            $personne = mysqli_fetch_assoc($reponse1);

            $travailleur = mysqli_num_rows(mysqli_query($db, "SELECT * from Insertion where SAL_NumSalarie = ".$personne["SAL_NumSalarie"]));

            if ($travailleur){
                // récupération du nom du type de sortie
                $numSortie = $personne['TYS_ID'];
                $reponse0 = mysqli_query($db, "SELECT * FROM TypeSortie WHERE TYS_ID='$numSortie' ORDER BY TYS_Libelle");
                $typeSortie = mysqli_fetch_assoc($reponse0);

                // récupération du nom de convention
                $numConv = $personne['CNV_Id'];
                $reponse2 = mysqli_query($db, "SELECT * FROM Convention WHERE CNV_Id='$numConv' ORDER BY CNV_Nom");
                $convention = mysqli_fetch_assoc($reponse2);

                //récupération du nom de contrat
                $numContrat = $personne['CNT_Id'];
                $reponse3 = mysqli_query($db, "SELECT CNT_Nom FROM Contrat WHERE CNT_Id='$numContrat' ORDER BY CNT_Nom");
                $contrat = mysqli_fetch_assoc($reponse3);

                // récupération du nom de référent et du prescripteur
                $numRef = $personne['REF_NumRef'];
                $reponse4 = mysqli_query($db, "SELECT * FROM Personnes JOIN Referents USING (PER_Num) JOIN Prescripteurs USING (PRE_Id) WHERE PER_Num in (SELECT PER_Num FROM Referents WHERE REF_NumRef='$numRef')");
                $referent = mysqli_fetch_assoc($reponse4);

                // récupération du nom de type de salarie
                $numType = $personne['TYP_Id'];
                $reponse5 = mysqli_query($db, "SELECT * FROM Type WHERE TYP_Id='$numType'");
                $type = mysqli_fetch_assoc($reponse5);
            }

            // récupération du numéro de fonction (si existe)
            $numfonction = $personne["FCT_Id"];
            $reponse6 = mysqli_query($db, "SELECT FCT_Nom from fonction where FCT_Id in (SELECT FCT_ID from salaries where PER_num = ".$num.")");
            $fonction = mysqli_fetch_assoc($reponse6);

            // pré-traitement pour affichage

            // Monsieur, Madame
            if ($personne["PER_Sexe"] == 1)
                $sexe = 'M.';
            else
                $sexe = 'Mme.';
            
            // nom de la personne en cas d'urgence
            if(!$travailleur || $personne["INS_UrgNom"] == null || $personne["INS_UrgPrenom"] == null || $personne["INS_UrgTel"] == null){
                $urgPers = "Aucun contact d'urgence";
                $urgTele = "Aucun numéro de telephone";
            }
            else{
                $urgPers = $personne["INS_UrgNom"].' '.$personne["INS_UrgPrenom"];
                $urgTele = $personne["INS_UrgTel"];
            }

            if ($personne) {
    ?>
            <!-- ------------------------- -->
            <!--    COORDONNEES CIVILES    -->
            <!-- ------------------------- -->

            <div class="form-repertoire">
                <fieldset>
                    <legend>Coordonnées civiles</legend>
                    <table class="form_table">
                        <tr>
                            <th colspan="4" style="text-align:center; text-decoration:underline">
                                <?php
                                    if ($personne["FCT_Id"] == 0)
                                        echo $sexe.' '.$personne["PER_Nom"].' '.$personne["PER_Prenom"].' - '.$type["TYP_Nom"];
                                    else
                                        echo $sexe.' '.$personne["PER_Nom"].' '.$personne["PER_Prenom"].' - '.$fonction["FCT_Nom"];
                                ?>
                            </th>
                        </tr>
                        <tr></tr>
                        <tr>
                            <th><label for="PER_DateN">Date de Naissance :</label></th>
                            <td><?php echo dater($personne["PER_DateN"]); ?></td>
                            <th><label for="PER_LieuN">Lieu de Naissance :</label></th>
                            <td><?php echo $personne["PER_LieuN"]; ?></td>
                        </tr>
                        <tr>
                            <th><label for="PER_Nation">Nationalité :</label></th> 
                            <td><?php echo $personne["PER_Nation"]; ?></td>
                        </tr>
                        <tr>
                            <th><label for="PER_Adresse">Adresse :</label></th>
                            <td><?php echo $personne["PER_Adresse"]; ?></td>
                            <th><label for="PER_Ville">Ville :</label></th>
                            <td><?php echo $personne["PER_Ville"]; ?></td>
                        </tr>
                        <tr>
                            <th><label for="PER_CodePostal">Code postal :</label></th>
                            <td><?php echo $personne["PER_CodePostal"]; ?></td>
                        </tr>
                        <tr></tr>
                        <tr>
                            <th><label for="PER_NCaf">Numéro de CAF :</label></th>
                            <td><?php echo $personne["PER_NCaf"]; ?></td>
                            <th><label for="PER_NPoleEmp">Numéro Pôle Emploi :</label></th>
                            <td><?php echo $personne["PER_NPoleEmp"]; ?></td>
                        </tr>
                        <tr>
                            <th><label for="PER_NSecu">Numéro de Sécurité Sociale :</label></th>
                            <td><?php echo $personne["PER_NSecu"]; ?></td>
                        </tr>
                        <tr></tr>
                        <tr>
                            <th><label for="PER_TelFixe">Téléphone Fixe :</label></th>
                            <td><?php echo $personne["PER_TelFixe"]; ?></td>
                            <th><label for="PER_TelPort">Téléphone Portable :</label></th>
                            <td><?php echo $personne["PER_TelPort"]; ?></td>
                        </tr>
                        <tr>
                            <th><label for="PER_Fax">Fax :</label></th>
                            <td><?php echo $personne["PER_Fax"]; ?></td>
                            <th><label for="PER_Email">Adresse @ email :</label></th>
                            <td><?php echo $personne["PER_Email"]; ?></td>
                        </tr>
                    </table>
                </fieldset>
            </div>

            <!-- ---------------------------------- -->
            <!--    A CONTACTER EN CAS D'URGENCE    -->
            <!-- ---------------------------------- -->

            <div class="form-repertoire">
                <fieldset>
                    <legend>Personne à contacter en cas d'urgence</legend>
                    <table>
                        <tr>
                            <td colspan="3"><div align="center" ><?php echo $urgPers.' - '.$urgTele ?></div></td>
                        </tr>
                    </table>
                </fieldset>
            </div>

            <?php
                if ($travailleur){
            ?>

            <!-- --------------------------------- -->
            <!--    COORDONNEES PROFESSIONELLES    -->
            <!-- --------------------------------- -->

            <div class="form-repertoire">
                <fieldset>
                    <legend>Coordonnées Professionelles</legend>
                    <table class="form_table">
                        <tr>
                            <th colspan="4" style="text-align:center; text-decoration:underline"><label><u>Date d'entrée dans l'association :</u></label>
                                <?php echo dater($personne['INS_DateEntree']); ?></td>
                        </tr>
                        <tr></tr>
                        <tr>
                            <th><label> Référent identifié : </label></th>
                            <td><?php echo $referent["PER_Nom"].' '.$referent["PER_Prenom"] ?></td>
                            <th>Type de contrat : </th>
                            <td><?php echo $contrat["CNT_Nom"] ?></td>

                        </tr>
                        <tr>
                            <th>Nombre d'heures :</th>
                            <td><?php echo $personne["INS_NbHeures"] ?></td>
                            <th><label> Convention : </label></th>
                            <td><?php echo $convention["CNV_Nom"] ?></td>
                        </tr>
                        <tr>
                            <th><label> Prescripteurs : </label></th>
                            <td><?php echo $referent["PRE_Nom"] ?></td>
                        </tr>
                        <tr>
                            <th>Niveau Scolaire :</th>
                            <td><?php echo $personne["INS_NivScol"] ?></td>
                            <th>Diplôme :</th>
                            <td><?php echo $personne["INS_Diplome"] ?></td>
                        </tr>
                        <tr>
                            <th>Reconnaissance TH : </th>
                            <td>
                                <?php
                                if ($personne['INS_RecoTH'] == 0) {
                                    echo "Non";
                                } else {
                                    echo "Oui";
                                }
                                ?>
                            </td>
                            <th>Permis :</th>
                            <td>
                                <?php
                                if ($personne['INS_Permis'] == 0) {
                                    echo "Non";
                                } else {
                                    echo "Oui";
                                }
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Revenus :</th>
                            <td><?php echo $personne["INS_RevenuDepuis"] ?></td>
                        </tr>
                        <tr>
                            <th>Inscris à Pôle Emploi depuis : </th>
                            <td><?php echo $personne["INS_PEDepuis"] ?></td>
                            <th>Sans emploi depuis depuis :</th>
                            <td><?php echo $personne["INS_SEDepuis"] ?></td>
                        </tr>
                        <tr>
                            <th>Position Atelier CAP :</th>
                            <td><?php echo $personne["INS_Positionmt"] ?></td>
                            <th> Mutuelle : </th>
                            <td><?php echo $personne["INS_Mutuelle"] ?></td>
                        </tr>
                        <tr>
                            <th> Situation Géographique : </th>
                            <td><?php echo $personne["INS_SituGeo"] ?></td>
                        </tr>
                        <!--
                        <tr>
                            Içi, normalement une case avec les repas, mais à définir en fonction de la suite.
                        </tr>s
                        -->  
                        <tr>
                            <th><label> Informations complémentaires : </label></th>
                            <td><?php echo $personne["INS_PlusDetails"] ?></td>
                        </tr>
                    </table>
                </fieldset>
            </div>

            <!-- ---------------------------- -->
            <!--    CURSUS PROFESSIONELLES    -->
            <!-- ---------------------------- -->

            <div class="form-repertoire">
                <fieldset>
                    <legend> Cursus Professionnel </legend>
                    <?php
                        if ($personne){
                    ?>
                    <div>
                        <table rules="all" align="center" width="80%" cellpadding="10px" name="tableCursus" class="emargement-hebdo">
                            <tr style="background-color:lightgrey">
                                <th id="date">Date de Changement</th>
                                <th id="type">Nouveau Type</th>
                                <th id="com">Commentaire</th>
                            </tr>
                            <tr>
                            <?php
                                $donnees = mysqli_query($db, "SELECT * from cursus where SAL_NumSalarie = ".$personne['SAL_NumSalarie']." ORDER BY CUR_Date desc");
                                if(mysqli_num_rows($donnees) == 0){
                                    echo "<tr>
                                            <th style=\"text-align:center; colspan=\"4\"><i> Aucun cursus disponible pour ce salarié </i></th>
                                          </tr>";
                                }
                                else{
                                while ($reponse = mysqli_fetch_assoc($donnees)){
                                        $rep = mysqli_query($db, "SELECT TYP_Nom, TYP_ID from type where TYP_ID = ".$reponse['TYP_Id']);
                                        $type = mysqli_fetch_assoc($rep);
                                        echo "<tr>
                                                <td style=\"text-align: center\">".dater($reponse['CUR_Date'])."</td>
                                                <td style=\"text-align: center\">".$type['TYP_Nom']."</td>
                                                <td style=\"text-align: center\">".$reponse['CUR_Comment']."</td>
                                              </tr>";
                                        }
                                }
                            ?>
                        </table>
                    </div>
                    <?php
                    }
                    else
                         echo "<div id='error'>Une erreur est survenue dans l'affichage du cursus</div>";
                    ?>
                    <table>
                        <tr>
                            <td>
                                <form method="post" action="addCursus.php" name="ajouterEtape" align="center">
                                    <input type="hidden" name="NumC" value="<?php echo $num ?>">
                                    <input align="center"type="submit" name="addChange" class="buttonC" value="Ajouter" style="font-size: 14;">
                                </form>
                            </td>
                        </tr>
                    </table>
                </fieldset>
            </div>
        <?php
            }
        }
        else
        {
            echo "Aucune fiche disponible";
        }
        if ($travailleur){
            mysqli_free_result($reponse1);
            mysqli_free_result($reponse2);
            mysqli_free_result($reponse3);
            mysqli_free_result($reponse4);
            mysqli_free_result($reponse5);
        }
    ?>
    </div>
<?php
    include('../../footer.php');
?>


<?php
    function in_assoc_array_by_key($value, $array, $key){
        for($x=0; $x<sizeof($array); $x++){
            if($array[$x][$key] == $value){
                return true;
            }
        }
        return false;
    }
?>