<?php
$pageTitle = "Detail Salarié";
$pwd='../../';
include('../../bandeau.php');
?>
    <div id="corps">
    <?php
    $num = intval($_GET["NumC"]);
    if (is_numeric($_GET["NumC"])) {

        $reponse1 = mysqli_query($db,
            "SELECT * FROM Personnes JOIN Salaries USING (PER_Num) JOIN Insertion USING (SAL_NumSalarie)
                WHERE SAL_NumSalarie='$num' ORDER BY PER_Nom");
        $personne = mysqli_fetch_assoc($reponse1);

        $numSortie = $personne['TYS_ID'];
        $reponse0 = mysqli_query($db, "SELECT * FROM TypeSortie WHERE TYS_ID='$numSortie' ORDER BY TYS_Libelle");
        $typeSortie = mysqli_fetch_assoc($reponse0);

        $numConv = $personne['CNV_Id'];
        $reponse2 = mysqli_query($db, "SELECT * FROM Convention WHERE CNV_Id='$numConv' ORDER BY CNV_Nom");
        $convention = mysqli_fetch_assoc($reponse2);

        $numContrat = $personne['CNT_Id'];
        $reponse3 = mysqli_query($db, "SELECT * FROM Contrat WHERE CNT_Id='$numContrat' ORDER BY CNT_Nom");
        $contrat = mysqli_fetch_assoc($reponse3);

        $numRef = $personne['REF_NumRef'];
        $reponse4 = mysqli_query($db, "SELECT * FROM Personnes JOIN Referents USING (PER_Num) JOIN Prescripteurs USING (PRE_Id) WHERE PER_Num in (SELECT PER_Num FROM Referents WHERE REF_NumRef='$numRef')");
        $referent = mysqli_fetch_assoc($reponse4);

        $numType = $personne['TYP_Id'];
        $reponse5 = mysqli_query($db, "SELECT * FROM Type WHERE TYP_Id='$numType'");
        $type = mysqli_fetch_assoc($reponse5);

        if ($personne) {
                ?>

            <fieldset class="civilian_infos">
                <legend align="center"><h2> Coordonnées Professionelles  </h2></legend>
                <div align="center">
                    <label for="PRO_DateEntrée"><u>Date d'entrée dans l'association :</u></label>
                    <td><!-- date entrée --></td>
                </div>
                <table>
                    <tr>
                        <td><label> Référent identifié : </label></td>
                        <td><!-- referent --></td>
                        <td colspan="2" rowspan="3">
                            <!-- Tableau d'infos du contrat -->
                            <table class="tab_contrat">
                                <tr>
                                    <td>Type de contrat : </td>
                                    <td><!-- type contrat --></td>

                                </tr>
                                <tr>
                                    <td>Nombre d'heures :</td>
                                    <td><!-- nb heures --></td>
                                </tr>
                                <tr>
                                    <td>Nombre de jours :</td>
                                    <td><!-- nb jours --></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td><label> Convention : </label></td>
                        <td>
                            <!-- convention -->
                        </td>
                    </tr>
                    <tr>
                        <td><label> Prescripteurs : </label></td>
                        <td>
                            <!-- prescripteurs -->
                        </td>
                    </tr>
                    <tr>
                        <td>Niveau Scolaire :</td>
                        <td>
                            <!-- niveau scolaire -->
                        </td>
                        <td>Diplôme :</td>
                        <td>
                            <!-- diplome -->
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            Reconnaissance TH : <!-- reconnaissance -->
                        </td>
                        <td colspan="2">
                            Permis : <!-- permis -->
                        </td>
                    </tr>
                    <tr>
                        <td>Revenus :</td>
                        <td> <!-- autre --></td>
                    </tr>
                    <tr>
                        <td>Inscris à Pôle Emploi depuis : </td>
                        <td><!-- inscription à pole emploi --></td>

                        <td>Sans emploi depuis depuis :</td>
                        <td><!-- sans emploi --></td>
                    </tr>
                    <tr>
                        <td>Position Atelier CAP :</td>
                        <td><!-- atelier CAP --></td>
                    </tr>
                    <tr>
                        <td> Mutuelle : </td>
                        <td><!-- mutuelle --></td>
                    </tr>
                    <tr>
                        <td> Situation Géographique : </td>
                        <td><!-- geographique --></td>
                    </tr>
                    <!--
                    <tr>
                        Içi, normalement une case avec les repas, mais à définir en fonction de la suite.
                    </tr>
                    -->  
                    <tr>
                        <td colspan="2"><label> Remarques / Commentaires : </label></td>
                        <td><!-- commentaires --></td>
                    </tr>
                </table>
            </fieldset>
        ?>
    <?php
    } else {
        echo "<div id='error'>ERROR : NUMBER ONLY</div>";
    }
    mysqli_free_result($reponse1);
    mysqli_free_result($reponse2);
    mysqli_free_result($reponse3);
    mysqli_free_result($reponse4);
    mysqli_free_result($reponse5);
    ?>
    </div>
<?php
include('../../footer.php');
?>