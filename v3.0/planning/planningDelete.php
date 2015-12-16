<?php
	$pageTitle = "Suppression d'un planning";
	$pwd='../';
	include($pwd.'bandeau.php');
?>
<div id="corps">
<?php
	if(isset($_POST['ENC_Num']) && isset($_POST['ASSOC_Date']) && isset($_POST["PL_id"])){

        if(mysqli_query($db, 'SET autocommit=0;') && mysqli_query($db, 'START TRANSACTION;')){
            if(deletePlanning($db)){
                displaySuccess();
                mysqli_query($db, 'COMMIT;');
            }
            else{
                displayError();
                mysqli_query($db, 'ROLLBACK;');
            }
        }
        else{
            displayError();
        }
	}
	else{
        displayError();
	}

    redirectPage();
?>
</div>
<?php
  	include($pwd.'footer.php');

    function deletePlanning($db){
            $query1 = mysqli_query($db, "DELETE FROM pl_association WHERE ASSOC_date = '".$_POST['ASSOC_Date']."' AND PL_id = ".$_POST["PL_id"]." AND ENC_Num = ".$_POST['ENC_Num'].";");

            $query2 = mysqli_query($db, "DELETE FROM pl_proprietees WHERE ASSOC_date = '".$_POST['ASSOC_Date']."' AND PL_id = ".$_POST["PL_id"]." AND ENC_Num = ".$_POST['ENC_Num'].";");

            $query3 = mysqli_query($db, "DELETE FROM pl_logo WHERE ASSOC_date = '".$_POST['ASSOC_Date']."' AND PL_id = ".$_POST["PL_id"]." AND ENC_Num = ".$_POST['ENC_Num'].";");

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
                  <label>Une erreur s\'est produite lors de la suppression du planning !</label>
                  </div>';
        }
  	}

  	function displaySuccess(){
	    echo '<div id="good">
  			<label>Le planning du '.date("d/m/Y", strtotime($_POST['ASSOC_Date'])).' a été supprimé avec succès !</label>
  			</div>';
  	}

  	function redirectPage(){
	    echo '<script type="text/javascript">
    			setTimeout(function(){
                    $.redirect("./planningShowcase.php")
                }, 2500);
			</script>';
  	}
?>