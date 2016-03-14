<?php
    $pageTitle = "Detail Salarié";
    $pwd='../../';
    include('../../bandeau.php');
?>
<div id="corps">
<?php
    if(isset($_GET["SalNum"])){
        $num = $_GET["SalNum"];

        // récupération de la fonction de la personne (travailleur ou salaries internes)
        $reponse1 = mysqli_query($db, "SELECT * FROM salaries WHERE SAL_NumSalarie='$num' ORDER BY PER_Num");
        $personne = mysqli_fetch_assoc($reponse1);
        
        if($personne){
        // différence entre salaries et travailleurs
            if($personne["FCT_Id"] == 0){ // travailleurs
                $reponse1 = mysqli_query($db, "SELECT * from personnes
                                                JOIN salaries using (PER_Num)
                                                JOIN insertion using (SAL_NumSalarie)
                                                WHERE SAL_NumSalarie='$num'
                                                ORDER BY PER_Nom");
            }
            else{ // salaries
                $reponse1 = mysqli_query($db, "SELECT * from personnes
                                                JOIN salaries using (PER_Num)
                                                JOIN fonction using (FCT_Id)
                                                WHERE SAL_NumSalarie='$num'
                                                ORDER BY PER_Nom");
            }
            $personne = mysqli_fetch_assoc($reponse1);

            $travailleur = mysqli_num_rows(mysqli_query($db, "SELECT * from Insertion where SAL_NumSalarie = ".$personne["SAL_NumSalarie"]));
            
            if($travailleur > 0){
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

                $query_contrat = mysqli_query($db, "SELECT TYP_Id, TYP_Nom FROM type WHERE TYP_Id NOT IN (SELECT TYP_Id FROM salaries WHERE SAL_NumSalarie = ".$num.") 
                                                AND TYP_Nom <> 'Salarié' ORDER BY TYP_Id;");
            }

            // récupération du numéro de fonction (si existe)
            $numfonction = $personne["FCT_Id"];
            $reponse6 = mysqli_query($db, "SELECT FCT_Nom from fonction where FCT_Id in (SELECT FCT_ID from salaries where PER_num = ".$num.")");
            $fonction = mysqli_fetch_assoc($reponse6);

            // pré-traitement pour affichage

            // Monsieur, Madame
            if ($personne["PER_Sexe"] == 1){
                $sexe = 'M.';
            }
            else{
                $sexe = 'Mme';
            }
            
            // nom de la personne en cas d'urgence
            if(!$travailleur || $personne["INS_UrgNom"] == null || $personne["INS_UrgPrenom"] == null || $personne["INS_UrgTel"] == null){
                $urgPers = "Aucun contact d'urgence";
                $urgTele = "Aucun numéro de téléphone";
            }
            else{
                $urgPers = $personne["INS_UrgNom"].' '.$personne["INS_UrgPrenom"];
                $urgTele = $personne["INS_UrgTel"];
            }
    ?>
<!-- ------------------------- -->
<!--    COORDONNEES CIVILES    -->
<!-- ------------------------- -->
<div id="labelT">
    <label>
    <?php
        if ($personne["FCT_Id"] == 0){
            echo $sexe.' '.stripslashes($personne["PER_Nom"]).' '.stripslashes($personne["PER_Prenom"]).', '.stripslashes(mb_strtolower($type["TYP_Nom"], 'UTF-8')).' à l\'association';
        }
        else{
            echo $sexe.' '.stripslashes($personne["PER_Nom"]).' '.stripslashes($personne["PER_Prenom"]).', '.stripslashes(mb_strtolower($fonction["FCT_Nom"], 'UTF-8')).' à l\'association';
        }
    ?>
    </label>
    <input type="button" class="printButton" id="goBackward" style="float: left; margin-top: 15px; margin-left: 5px;" value="Retour"/>
    <input type="button" class="printButton" id="goEdit" style="float: right; margin-top: 15px; margin-left: 5px;" value="Modifier"/>
</div>
<div class="repertoire-bloc">
    <fieldset>
        <legend>Coordonnées civiles</legend>
        <table class="showcase_table">
            <tbody>
                <tr>
                    <td>Date de naissance :</td>
                    <td><?php echo (!empty($personne["PER_DateN"])) ? dater($personne["PER_DateN"]) : '<i class="no-data">Aucune date</i>'; ?></td>
                    <td>Lieu de naissance :</td>
                    <td><?php echo (!empty($personne["PER_LieuN"])) ? stripslashes($personne["PER_LieuN"]) : '<i class="no-data">Aucune lieu</i>'; ?></td>
                </tr>
                <tr>
                    <td>Sexe :</td>
                    <td>
                        <?php 
                            if($sexe == "M."){
                                echo "Homme";
                            }
                            else{
                                echo "Femme"; 
                            }
                        ?>
                    </td>
                    <td>Nationalité :</td> 
                    <td><?php echo (!empty($personne["PER_Nation"])) ? stripslashes($personne["PER_Nation"]) : '<i class="no-data">Aucune nationalité</i>'; ?></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>Rue, lotissement :</td>
                    <td><?php echo (!empty($personne["PER_Adresse"])) ? stripslashes($personne["PER_Adresse"]) : '<i class="no-data">Aucune adresse</i>'; ?></td>
                    <td>Ville :</td>
                    <td><?php echo (!empty($personne["PER_Ville"])) ? stripslashes($personne["PER_Ville"]) : '<i class="no-data">Aucune ville</i>'; ?></td>
                </tr>
                <tr>
                    <td>Code postal :</td>
                    <td><?php echo (!empty($personne["PER_CodePostal"])) ? $personne["PER_CodePostal"] : '<i class="no-data">Aucun code postal</i>'; ?></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>Numéro de CAF :</td>
                    <td><?php echo (!empty($personne["PER_NCaf"])) ? chunk_split($personne["PER_NCaf"], 2, " ") : '<i class="no-data">Aucun numéro</i>'; ?></td>
                    <td>Numéro Pôle Emploi :</td>
                    <td><?php echo (!empty($personne["PER_NPoleEmp"])) ? chunk_split($personne["PER_NPoleEmp"], 2, " ") : '<i class="no-data">Aucun numéro</i>'; ?></td>
                </tr>
                <tr>
                    <td>Numéro de Sécurité Sociale :</td>
                    <td><?php echo (!empty($personne["PER_NSecu"])) ? chunk_split($personne["PER_NSecu"], 2, " ") : '<i class="no-data">Aucun numéro</i>'; ?></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>Téléphone fixe :</td>
                    <td><?php echo (!empty($personne["PER_TelFixe"])) ? convertToPhoneNumber($personne["PER_TelFixe"]) : '<i class="no-data">Aucun numéro</i>'; ?></td>
                    <td>Téléphone Portable :</td>
                    <td><?php echo (!empty($personne["PER_TelPort"])) ? convertToPhoneNumber($personne["PER_TelPort"]) : '<i class="no-data">Aucun numéro</i>'; ?></td>
                </tr>
                <tr>
                    <td>Fax :</td>
                    <td><?php echo (!empty($personne["PER_Fax"])) ? convertToPhoneNumber($personne["PER_Fax"]) : '<i class="no-data">Aucun numéro</i>'; ?></td>
                    <td>Adresse @ email :</td>
                    <td><?php echo (!empty($personne["PER_Email"])) ? '<a href="mailto:'.$personne["PER_Email"].'">'.$personne["PER_Email"].'</a>' : '<i class="no-data">Aucun e-mail</i>'; ?></td>
                </tr>
            </tbody>
        </table>
    </fieldset>
</div>

<!-- ---------------------------------- -->
<!--    A CONTACTER EN CAS D'URGENCE    -->
<!-- ---------------------------------- -->
<?php
    if ($travailleur){
?>
<div class="repertoire-bloc">
    <fieldset>
        <legend>Personne à contacter en cas d'urgence</legend>
        <table class="showcase_table">
            <tbody>
                <tr>
                    <td colspan="3"><div align="center" ><?php echo stripslashes($urgPers).' - '.$urgTele ?></div></td>
                </tr>
            </tbody>
        </table>
    </fieldset>
</div>

<!-- --------------------------------- -->
<!--   INFORMATIONS COMPLEMENTAIRES    -->
<!-- --------------------------------- -->

<div class="repertoire-bloc">
    <fieldset>
        <legend>Informations complémentaires</legend>
        <table class="showcase_table">
            <tbody>
                <tr>
                    <td colspan="2">Date d'entrée dans l'association :</td>
                    <td colspan="2"><?php echo (!empty($personne['INS_DateEntree'])) ? dater($personne['INS_DateEntree']) : '<i class="no-data">Aucune date</i>'; ?></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>Référent identifié :</td>
                    <td><?php echo (!empty($referent["PER_Nom"]) && !empty($referent["PER_Prenom"])) ? stripslashes($referent["PER_Nom"]).' '.stripslashes($referent["PER_Prenom"]) : '<i class="no-data">Aucun référent</i>'; ?></td>
                    <td>Type de contrat : </td>
                    <td><?php echo (!empty($contrat["CNT_Nom"])) ? $contrat["CNT_Nom"] : '<i class="no-data">Aucun contrat</i>'; ?></td>

                </tr>
                <tr>
                    <td>Nombre d'heures :</td>
                    <td><?php echo (!empty($personne["INS_NbHeures"])) ? $personne["INS_NbHeures"] : '<i class="no-data">Aucune heure</i>'; ?></td>
                    <td> Convention : </td>
                    <td><?php echo (!empty($convention["CNV_Nom"])) ? $convention["CNV_Nom"] : '<i class="no-data">Aucune convention</i>'; ?></td>
                </tr>
                <tr>
                    <td>Prescripteurs :</td>
                    <td><?php echo (!empty($referent["PRE_Nom"])) ? stripslashes($referent["PRE_Nom"]) : '<i class="no-data">Aucune prescripteur</i>'; ?></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>Niveau Scolaire :</td>
                    <td><?php echo (!empty($personne["INS_NivScol"])) ? $personne["INS_NivScol"] : '<i class="no-data">Aucun niveau scolaire</i>'; ?></td>
                    <td>Diplôme :</td>
                    <td><?php echo (!empty($personne["INS_Diplome"])) ? $personne["INS_Diplome"] : '<i class="no-data">Aucun diplôme</i>'; ?></td>
                </tr>
                <tr>
                    <td>Reconnaissance td : </td>
                    <td>
                        <?php
                        if ($personne['INS_RecoTH'] == 0) {
                            echo "Non";
                        } else {
                            echo "Oui";
                        }
                        ?>
                    </td>
                    <td>Permis :</td>
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
                    <td>Revenus :</td>
                    <td><?php echo (!empty($personne["INS_RevenuDepuis"])) ? $personne["INS_RevenuDepuis"] : '<i class="no-data">Aucun revenu</i>'; ?></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>Inscris à Pôle Emploi depuis :</td>
                    <td><?php echo (!empty($personne["INS_PEDepuis"])) ? $personne["INS_PEDepuis"] : '<i class="no-data">Aucune durée</i>'; ?></td>
                    <td>Sans emploi depuis depuis :</td>
                    <td><?php echo (!empty($personne["INS_SEDepuis"])) ? $personne["INS_SEDepuis"] : '<i class="no-data">Aucun durée</i>'; ?></td>
                </tr>
                <tr>
                    <td>Position atelier CAP :</td>
                    <td><?php echo (!empty($personne["INS_Positionmt"])) ? $personne["INS_Positionmt"] : '<i class="no-data">Aucune position</i>'; ?></td>
                    <td>Mutuelle :</td>
                    <td><?php echo (!empty($personne["INS_Mutuelle"])) ? $personne["INS_Mutuelle"] : '<i class="no-data">Aucune mutuelle</i>'; ?></td>
                </tr>
                <tr>
                    <td>Situation Géographique :</td>
                    <td><?php echo (!empty($personne["INS_SituGeo"])) ? $personne["INS_SituGeo"] : '<i class="no-data">Aucune situation géographique</i>'; ?></td>
                    <td></td>
                    <td></td>
                </tr>
                <!--
                <tr>
                    Ici, normalement une case avec les repas, mais à définir en fonction de la suite.
                    Ici, type de sortie et date de sortie
                </tr>s
                -->  
                <tr>
                    <td>Autre détails :</td>
                    <td colspan="3"><?php echo (!empty($personne["INS_PlusDetails"])) ? stripslashes($personne["INS_PlusDetails"]) : '<i class="no-data">Aucun autres détails</i>'; ?></td>
                </tr>
            </tbody>
        </table>
    </fieldset>
</div>

<!-- ---------------------------- -->
<!--    CURSUS PROFESSIONELLES    -->
<!-- ---------------------------- -->

<div id="cursus-bloc" class="repertoire-bloc">
    <fieldset>
        <legend>Cursus professionnel</legend>
        <div>
            <table class="cursus-table">
                <tbody>
                <?php
                    $donnees = mysqli_query($db, "SELECT * FROM cursus JOIN type USING(TYP_Id) WHERE SAL_NumSalarie = ".$personne['SAL_NumSalarie']." ORDER BY CUR_Date asc");
                    if(mysqli_num_rows($donnees) > 0){
                        $x = 1;
                        while($reponse = mysqli_fetch_assoc($donnees)){
                            if(isset($oldTypeSalarie)){
                                echo '<tr></tr>';
                            }

                            echo '<tr>
                                    <td rowspan="2" class="cursus-number">'.$x++.'</td>
                                    <td colspan="3" class="cursus-title">Changement le '.dater($reponse['CUR_Date']).'</td>
                                    <td class="cursus-title">Commentaire</td>
                                </tr>
                                <tr>
                                    <td class="cursus-contrat"><div>'.((isset($oldTypeSalarie)) ? $oldTypeSalarie : 'Aucun contrat').'</div></td>
                                    <td class="cursus-arrow"><img src="'.$pwd.'images/right-arrow.png"/></td>
                                    <td class="cursus-contrat"><div>'.stripslashes($reponse['TYP_Nom']).'</div></td>
                                    <td class="cursus-details">'.((!empty($reponse['CUR_Comment'])) ? stripslashes($reponse['CUR_Comment']) : 'Aucun commentaire').'</td>
                                </tr>';
                           
                            $oldTypeSalarie = stripslashes($reponse['TYP_Nom']);
                        }
                    }
                    if(mysqli_num_rows($donnees) > 0){
                        echo '<tr></tr>';
                    }
                    echo '<tr id="awaiting-cursus">
                            <td class="cursus-number">?</td>
                            <td class="cursus-contrat"><div>'.((isset($oldTypeSalarie)) ? $oldTypeSalarie : 'Aucun contrat').'</div></td>
                            <td class="cursus-arrow"><img src="'.$pwd.'images/right-arrow.png"/></td>
                            <td class="cursus-contrat"><div>???</div></td>
                            <td class="cursus-details"><input type="button" id="addCursus" class="buttonC" value="Ajouter" style="margin: 5px 0px;"/></td>
                        </tr>';
                ?>
                    <tr id="awaiting-form-cursus" style="display: none;">
                        <td class="cursus-number"></td>
                        <td colspan="4">
                            <form method="POST" action="./postSalarie.php">
                                <table class="form-cursus-wrapper">
                                    <tbody>
                                        <tr>
                                            <td><label for="CUR_Date">Date du changement* :</label></td>
                                            <td><input type="date" id="CUR_Date" name="CUR_Date" class="inputC" required="required" min="<?php echo $personne['INS_DateEntree']; ?>"/></td>
                                            <td colspan="2" style="text-align: left;"><label for="CUR_Comment">Commentaire <i>(50 caractères maximum)</i> :</label></td>
                                        </tr>
                                        <tr>
                                            <td><label for="CUR_Comment">Type de contrat* :</label></td>
                                            <td>
                                                <div class="selectType">
                                                    <select required="required" id="TYP_Id" name="TYP_Id">
                                                        <option value="0" selected="selected" disabled="disabled">Choisir..</option>
                                                    <?php
                                                        while($data = mysqli_fetch_assoc($query_contrat)){
                                                            echo '<option value="'.$data["TYP_Id"].'">'.$data["TYP_Nom"].'</option>';
                                                        }
                                                    ?>
                                                    </select>
                                                </div>
                                            </td>
                                            <td colspan="2"><input type="text" id="CUR_Comment" name="CUR_Comment" class="inputC" maxlength="50"/></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2"><input type="button" id="cancelAddCursus" class="buttonC" value="Annuler"/></td>
                                            <td colspan="2"><input type="submit" id="validAddCursus" class="buttonC" value="Valider"/></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <input type="hidden" id="SAL_NumSalarie" name="SAL_NumSalarie" value="<?php echo $num; ?>"/>
                                <input type="hidden" id="request_type" name="request_type" value="cursus"/>
                            </form>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <?php
        }
        ?>
    </fieldset>
</div>
<?php
    }
    else
    {
        echo '<div id="info"> 
            <label>Aucune fiche disponible pour le numéro de salarié '.$num.'</label>
        </div>';
    }
?>
<script type="text/javascript">
    $(document).ready(function(){
        $("#addCursus").on("click", function(){
            $("#cursus-bloc legend").append('<span class="required-fields-info">Champs obligatoires*</span>');
            $("#awaiting-cursus").hide();
            $("#awaiting-form-cursus").show();
        });

        $("#cancelAddCursus").on("click", function(){
            $("#cursus-bloc legend .required-fields-info").remove();
            $("#awaiting-cursus").show();
            $("#awaiting-form-cursus").hide();
        });

        $("#goBackward").on("click", function(){
            $.redirect("./listSalaries.php");
        });
    });

    function getDataAjax(url, params, callback){
        $.post(url, params, callback);
    }
</script>
<?php
    }
    else{
        echo '<div id="bad"> 
            <label>Une erreur c\'est produite lors de l\'accès à la page</label>
        </div>';
    }
?>
</div>
<?php
    include('../../footer.php');
?>