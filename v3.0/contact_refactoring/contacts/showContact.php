<?php
    $pageTitle = "Detail Contact";
    $pwd='../../';
    include('../../bandeau.php');
?>
<div id="corps">
<?php
    if(isset($_POST["ConNum"]) && !empty($_POST["ConNum"]) && isset($_POST["TC_ID"]) && !empty($_POST["TC_ID"])){
        $num = $_POST["ConNum"];
        $typeClient = "";
        $postok=true;

        if($_POST["TC_ID"] == "1"){
            $type = "Fournisseur";
            $prep = "FOU";
            $table = "fournisseurs";
        }
        else {
            if($_POST["TC_ID"] == "2"){
                if(isset($_POST["TypeClient"])){
                    $type = "Client";
                    $prep = "CLI";
                    $table = "clients";
                    $typeClient = $_POST["TypeClient"];
                }
                else{
                    $postok=false;
                }
            }
            else{
                $postok=false;
            }            
        }
        if($postok){
            $reponse1 = mysqli_query($db, "SELECT * from ".$table." WHERE ".$prep."_Num".$type." ='$num' ORDER BY ".$prep."_Nom;");
            $contact = mysqli_fetch_assoc($reponse1);
        ?>
            <div id="labelT">
                <label>
                <?php
                    if($type == "Fournisseur"){
                         echo stripslashes($contact[$prep."_Nom"]).', fournisseur de l\'association';
                    }
                    else{
                        echo trim(stripslashes($contact[$prep."_Nom"]).' '.stripslashes($contact[$prep."_Prenom"])).', client ('.($typeClient == "particulier" ? "particulier" : "structure").') de l\'association';
                    }
                ?>
                </label>
            </div>
            <div class="repertoire-bloc">
                <fieldset>
                    <legend>Coordonnées civiles</legend>
                    <table class="showcase_table">
                        <tbody>
                            <tr>
                                <td>Rue, lotissement :</td>
                                <td><?php echo (!empty($contact[$prep."_Adresse"])) ? stripslashes($contact[$prep."_Adresse"]) : '<i class="no-data">Aucune adresse</i>'; ?></td>
                                <td>Ville :</td>
                                <td><?php echo (!empty($contact[$prep."_Ville"])) ? stripslashes($contact[$prep."_Ville"]) : '<i class="no-data">Aucune ville</i>'; ?></td>
                            </tr>
                            <tr>
                                <td>Code postal :</td>
                                <td><?php echo (!empty($contact[$prep."_CodePostal"])) ? $contact[$prep."_CodePostal"] : '<i class="no-data">Aucun code postal</i>'; ?></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr></tr>
                            <tr>
                                <td>Téléphone fixe :</td>
                                <td><?php echo (!empty($contact[$prep."_Telephone"])) ? convertToPhoneNumber($contact[$prep."_Telephone"]) : '<i class="no-data">Aucun numéro</i>'; ?></td>
                                <td>Téléphone Portable :</td>
                                <td><?php echo (!empty($contact[$prep."_Portable"])) ? convertToPhoneNumber($contact[$prep."_Portable"]) : '<i class="no-data">Aucun numéro</i>'; ?></td>
                            </tr>
                            <tr>
                                <td>Fax :</td>
                                <td><?php echo (!empty($contact[$prep."_Fax"])) ? convertToPhoneNumber($contact[$prep."_Fax"]) : '<i class="no-data">Aucun numéro</i>'; ?></td>
                                <td>Adresse @ email :</td>
                                <td><?php echo (!empty($contact[$prep."_Email"])) ? '<a href="mailto:'.$contact[$prep."_Email"].'">'.$contact[$prep."_Email"].'</a>' : '<i class="no-data">Aucun e-mail</i>'; ?></td>
                            </tr>
                        </tbody>
                    </table>
                </fieldset>
            </div>
            <div class="repertoire-manage-buttons">
                <input type="button" class="buttonC" id="goBackward" value="Retour"/>
                <input type="button" class="buttonC" id="goEdit"  value="Modifier"/>
            </div>
            <hr class="hr-stylized"/>
            <?php
                if($type == "Fournisseur" || $typeClient == "structure"){
                    if($type == "Fournisseur"){
                        $query = mysqli_query($db,"SELECT * FROM employerFourn JOIN personnes USING(PER_Num) WHERE FOU_NumFournisseur = ".$num.";");
                    }
                    else{
                        $query = mysqli_query($db,"SELECT * FROM employerclient JOIN personnes USING(PER_Num) WHERE CLI_NumClient = ".$num.";");
                    }
            ?>
                    <div align="center">
                        <input name="submit" type="submit" id="addEmploye" value="Ajouter Employé" class="buttonC">
                    </div>
            <?php
                    if(mysqli_num_rows($query) > 0){
            ?>
                        <div class="repertoire-show-list" id="employe-list">
                            <h4>Liste des employés :</h4>
                            <table cellpadding="5">
                                <thead>
                                    <tr>
                                        <th>Nom</th>
                                        <th>Prenom</th>                    
                                        <th>Tél Fixe</th>
                                        <th>Tél Portable</th>
                                        <th>Email</th>
                                    </tr>
                                </thead>
                                <tbody>
                    <?php
                                while($data = mysqli_fetch_assoc($query)){
                    ?>
                                    <tr data-pernum="<?php echo $data["PER_Num"]; ?>">
                                        <td><?php echo (($data["PER_Nom"] != "") ? $data["PER_Nom"] : '<i class="no-data">Aucun nom</i>') ?></td>
                                        <td><?php echo (($data["PER_Prenom"] != "") ? $data["PER_Prenom"] : '<i class="no-data">Aucun prenom</i>'); ?></td>
                                        <td><?php echo (($data["PER_TelFixe"] != "") ? convertToPhoneNumber($data["PER_TelFixe"]) : '<i class="no-data">Aucun numéro</i>'); ?></td>
                                        <td><?php echo (($data["PER_TelPort"] != "") ? convertToPhoneNumber($data["PER_TelPort"]) : '<i class="no-data">Aucun numéro</i>'); ?></td>
                                        <td><?php echo (($data["PER_Email"] != "") ? $data["PER_Email"] : '<i class="no-data">Aucun e-mail</i>'); ?></td>                       
                                    </tr>
                    <?php
                                }
                    ?>
                                </tbody>
                            </table>
                        </div>
            <?php
                    }
            ?>
                        <div id="per_info" style="display:none;"></div>
            <?php
                }
            ?>

            <?php
                if(isset($_POST["TypeClient"]) && $typeClient == "particulier"){
                    $query = mysqli_query($db,"SELECT * FROM Chantiers JOIN Commanditer USING(CHA_NumDevis) WHERE CLI_NumClient=".$num.";");
                    if(mysqli_num_rows($query) > 0){
            ?>
                        <div class="repertoire-show-list" id="chantier-list">
                            <h4>Liste des chantiers :</h4>
                            <table cellpadding="5">
                                <thead>
                                    <tr>
                                        <th>Chantier</th>
                                        <th>Adresse</th>                    
                                        <th>Date de Début</th>
                                        <th>Echeance</th>
                                    </tr>
                                </thead>
                                <tbody>
                    <?php
                                while($data = mysqli_fetch_assoc($query)){
                    ?>
                                    <tr data-channum="<?php echo $data["CHA_NumDevis"]; ?>">
                                        <td><?php echo (($data["CHA_Intitule"] != "") ? $data["CHA_Intitule"] : '<i class="no-data">Aucun chantier</i>') ?></td>
                                        <td><?php echo (($data["CHA_Adresse"] != "") ? $data["CHA_Adresse"] : '<i class="no-data">Aucune adresse</i>'); ?></td>
                                        <td><?php echo (($data["CHA_DateDebut"] != "") ? $data["CHA_DateDebut"] : '<i class="no-data">Aucune date</i>'); ?></td>  
                                        <td><?php echo (($data["CHA_Echeance"] != "") ? $data["CHA_Echeance"] : '<i class="no-data">Aucune echeance</i>'); ?></td>                       
                                    </tr>
                    <?php
                                }
                    ?>
                                </tbody>
                            </table>
                        </div>
            <?php
                    }
                }
            ?>
            <script type="text/javascript">
                $(document).ready(function(){
                    $("#addEmploye").on("click", function(){
                        $.redirect("./addEmploye.php", {"request_type" : "<?php echo $type; ?>", "ConNum" : "<?php echo $num; ?>" ,"TC_ID": "<?php echo $_POST["TC_ID"]; ?>", "TypeClient": "<?php echo $typeClient; ?>"}, "POST");
                    });

                    $("#goBackward").on("click", function(){
                        $.redirect("./listContacts.php");
                    });

                    $("#goEdit").on("click", function(){
                        $.redirect("./editContact.php", {"request_type" : "<?php echo $type; ?>", "ConNum" : "<?php echo $num; ?>" ,"TC_ID": "<?php echo $_POST["TC_ID"]; ?>"}, "POST");
                    });

                    $("#employe-list table tbody tr").on("click", function(){
                        getDataAjax("./ajax/formulaireDataAdd.php", {"request_type" : "per_info", "PER_Num": $(this).data("pernum"), "Type" : "<?php echo $type; ?>", "TC_ID":"<?php echo $_POST["TC_ID"]; ?>","ConNum":"<?php echo $num; ?>"}, function(data){
                            if(data.length > 0){
                                $("#per_info").html(data);
                                $("#addEmploye").hide();
                                $("#employe-list").hide();
                                $("#per_info").show();

                                $("#cancelInfoEmploye").on("click", function(){
                                    $("#employe-list").show();
                                    $("#per_info").hide();
                                    $("#addEmploye").show();
                                });
                            }
                            else{
                                alert("Une erreur s'est produite, rechargez la page !");
                            }
                        });            
                    });  

                    $("#chantier-list table tbody tr").on("click", function(){
                        $.redirect("../../chantier/detailChantier.php", {"NumC": $(this).data("CHA_NumDevis")}, "POST");        
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
                <label>Une erreur c\'est produite lors de l\'accès à la page !</label>
            </div>';
        }

    }
    else{
        echo '<div id="bad"> 
            <label>Une erreur c\'est produite lors de l\'accès à la page !</label>
        </div>';
    }
?>
</div>
<?php
    include('../../footer.php');
?>