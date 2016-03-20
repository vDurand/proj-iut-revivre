<?php
    $pageTitle = "Detail Référent";
    $pwd='../../../';
    include($pwd.'bandeau.php');
?>
<div id="corps">
<?php
    if(isset($_GET["RefNum"])){
        $num = $_GET["RefNum"];

        $reponse1 = mysqli_query($db, "SELECT * FROM referents JOIN personnes USING(PER_Num) JOIN prescripteurs PRE_Id WHERE REF_NumRef = '$num'");
        $personne = mysqli_fetch_assoc($reponse1);
        
        if($personne){
            if($personne["PER_Sexe"] == 1){
                $sexe = 'M.';
            }
            else{
                $sexe = 'Mme';
            }
    ?>

<div id="labelT">
    <label>
    <?php
        echo $sexe.' '.stripslashes($personne["PER_Nom"]).' '.stripslashes($personne["PER_Prenom"]).', référent pour l\'association';
    ?>
    </label>
</div>
<div class="repertoire-bloc">
    <fieldset>
        <legend>Coordonnées civiles</legend>
        <table class="showcase_table">
            <tbody>
                <tr>
                    <td>Date de naissance :</td>
                    <td><?php echo (!empty($personne["PER_DateN"]) && $personne["PER_DateN"] != "0000-00-00") ? dater($personne["PER_DateN"]) : '<i class="no-data">Aucune date</i>'; ?></td>
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
                    <td>Prescripteur :</td>
                    <td><?php echo (!empty($personne["PRE_Nom"])) ? stripslashes($personne["PRE_Nom"]) : '<i class="no-data">Aucune prescripteur</i>'; ?></td>
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
<div class="repertoire-manage-buttons">
    <input type="button" class="buttonC" id="goBackward" value="Retour"/>
    <input type="submit" class="buttonC" id="goEdit" value="Modifier"/>
</div>
<?php
    }
    else
    {
        echo '<div id="info"> 
            <label>Aucune fiche disponible pour le numéro de référent '.$num.'</label>
            </div>';
    }
?>
<script type="text/javascript">
    $(document).ready(function(){
        $("#goBackward").on("click", function(){
            $.redirect("./listReferents.php");
        });

        $("#goEdit").on("click", function(){
            $.redirect("./editReferent.php", {"REF_NumRef":<?php echo $personne["REF_NumRef"]?>}, "post");
        });
    });
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
    include($pwd.'footer.php');
?>