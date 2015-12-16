<?php
	$pageTitle = "Copie d'un planning";
	$pwd='../';
	include($pwd.'bandeau.php');
?>
<div id="corps">
<?php
	if(isset($_POST['ENC_Num']) && isset($_POST['ASSOC_Date']) && isset($_POST["PL_id"]) && isset($_POST['ASSOC_Date_new'])){
        if(mysqli_query($db, 'SET autocommit=0;') && mysqli_query($db, 'START TRANSACTION;')){

            $no_error = false;
            $prequery = mysqli_query($db, "SELECT * FROM pl_proprietees WHERE ASSOC_date = '".$_POST['ASSOC_Date_new']."' AND PL_id = ".$_POST["PL_id"]." AND ENC_Num = ".$_POST['ENC_Num'].";");
            if($prequery){
                if(mysqli_num_rows($prequery) == 0){
                    if(copyPlanning($db)){
                        displaySuccess();
                        $no_error = true;
                        mysqli_query($db, 'COMMIT;');
                    }
                    else{
                        displayError();
                        mysqli_query($db, 'ROLLBACK;');
                    }
                }
                else{
                    displayError("Un planning pour cet encadrant existe déjà le ".date("d/m/Y", strtotime($_POST['ASSOC_Date_new']))." !");
                }
            }
            else{
                displayError();
            }
        }
        else{
            displayError();
        }
	}
	else{
        displayError();
	}

    redirectPage($no_error);
?>
</div>
<?php
  	include($pwd.'footer.php');

    function copyPlanning($db){
            $query1 = mysqli_query($db, "INSERT INTO pl_association(SAL_NumSalarie, ENC_Num, CRE_id, PL_id, ASSOC_date)
                                        SELECT SAL_NumSalarie, ENC_Num, CRE_id, PL_id, '".$_POST['ASSOC_Date_new']."'
                                        FROM pl_association WHERE ASSOC_date = '".$_POST['ASSOC_Date']."' AND PL_id = ".$_POST["PL_id"]." AND ENC_Num = ".$_POST['ENC_Num'].";");

            $query2 = mysqli_query($db, "INSERT INTO pl_proprietees(ENC_Num, ASSOC_date, PL_id, ASSOC_Couleur, ASSOC_AM, ASSOC_PM, ASSOC_LastEdit)
                                        SELECT ENC_Num, '".$_POST['ASSOC_Date_new']."', PL_id, ASSOC_Couleur, ASSOC_AM, ASSOC_PM, '".date("Y-m-d")."'
                                        FROM pl_proprietees WHERE ASSOC_date = '".$_POST['ASSOC_Date']."' AND PL_id = ".$_POST["PL_id"]." AND ENC_Num = ".$_POST['ENC_Num'].";");

            $query3 = mysqli_query($db, "INSERT INTO pl_logo(LOGO_id, ENC_Num, ASSOC_date, PL_id)
                                        SELECT LOGO_id, ENC_Num, '".$_POST['ASSOC_Date_new']."', PL_id
                                        FROM pl_logo WHERE ASSOC_date = '".$_POST['ASSOC_Date']."' AND PL_id = ".$_POST["PL_id"]." AND ENC_Num = ".$_POST['ENC_Num'].";");

            return $query1 && $query2 && $query3;
    }

  	function displayError($message = null){
        if($message != null){
      		echo '<div id="bad"> 
                  <label>'.$message.'</label>
                  </div>';
        }
        else{
            echo '<div id="bad"> 
                  <label>Une erreur s\'est produite lors de la copie du planning !</label>
                  </div>';
        }
  	}

  	function displaySuccess(){
	    echo '<div id="good">
  			<label>Le planning du '.date("d/m/Y", strtotime($_POST['ASSOC_Date'])).' a été copié au '.date("d/m/Y", strtotime($_POST['ASSOC_Date_new'])).' avec succès !</label>
  			</div>';
  	}

  	function redirectPage($successCopy){
        if($successCopy){
    	    echo '<script type="text/javascript">
        			setTimeout(function(){
                        $.redirect("./planningShowcase.php", {"ENC_Num": '.$_POST['ENC_Num'].', "ASSOC_Date": "'.$_POST['ASSOC_Date_new'].'", "PL_id": '.$_POST['PL_id'].'})
                    }, 2500);
    			</script>';
        }
        else{
            echo '<script type="text/javascript">
                setTimeout(function(){
                    $.redirect("./planningShowcase.php", {"ENC_Num": '.$_POST['ENC_Num'].', "ASSOC_Date": "'.$_POST['ASSOC_Date'].'", "PL_id": '.$_POST['PL_id'].'})
                }, 2500);
            </script>'; 
        }
  	}
?>