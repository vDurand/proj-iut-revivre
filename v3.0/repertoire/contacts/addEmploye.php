<?php
    $pageTitle = "Ajout d'un employé";
    $pwd='../../';
    include($pwd."bandeau.php");
?>
<div id="corps">
<?php
    if(isset($_POST["request_type"]) && !empty($_POST["request_type"]) && isset($_POST["ConNum"]) && !empty($_POST["ConNum"]) && isset($_POST["TC_ID"]) && !empty($_POST["TC_ID"])){
        $typeClient = "";
        $postok = true;

        if($_POST["TC_ID"] == "1"){
            $type = "Fournisseur";
        }
        else {
            if($_POST["TC_ID"] == "2"){
                if(isset($_POST["TypeClient"])){
                    $type = "Client";
                    $typeClient = $_POST["TypeClient"];
                }
                else{
                    $postok = false;
                }
            }
            else{
                $postok = false;
            }            
        }
        if($postok){
?>
            <div id="labelT">
                <label>Ajout d'un employé</label>
            </div>
            <div>
                <form method="POST" action="postContact.php">
                    <?php 
                    include_once("includes/form_employe.php");
                    if($typeClient!=""){
                        echo "<input type=\"hidden\" name=\"TypeClient\" value=\"".$typeClient."\">";
                    }
                    else{
                        echo "<input type=\"hidden\" name=\"TypeClient\" value=\"".$type."\">";
                    }
                    ?> 
                    <div class="align-center">
                        <input type="hidden" name="request_type" value="employe" >
                        <input type="hidden" name="connum" value="<?php echo $_POST["ConNum"]; ?>">
                        <input type="hidden" name="TC_ID" value="<?php echo $_POST["TC_ID"]; ?>">
                        <input name="cancelAddEmploye" type="button" id="cancelAddEmploye" value="Annuler" class="buttonC">
                        <input name="validAddEmploye" type="submit" id="validAddEmploye" value="Valider" class="buttonC">
                    </div>
                </form>               
            </div>
        
<?php
        }
        else{
            echo '<div id="bad"> 
                <label>Une erreur c\'est produite lors de l\'accès à la page</label>
            </div>';
        }
    }
    else{
        echo '<div id="bad"> 
                <label>Une erreur c\'est produite lors de l\'accès à la page</label>
            </div>';
    }
?>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        $("#cancelAddEmploye").on("click", function(){
            $.redirect("./showContact.php", {"ConNum": <?php echo $_POST["ConNum"]; ?>, "TC_ID": <?php echo $_POST["TC_ID"]; ?>}, "POST");
        });
    });
</script>
<?php
    include($pwd."footer.php");
?>

