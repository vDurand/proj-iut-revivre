<?php
	$pageTitle = "Archivage d'un planning";
	$pwd='../';
	include($pwd.'bandeau.php');
?>
<div id="corps">
<?php
	if(isset($_POST['ENC_Num']) && isset($_POST['ASSOC_Date']) && isset($_POST["PL_id"])){

        if(mysqli_query($db, 'SET autocommit=0;') && mysqli_query($db, 'START TRANSACTION;')){
            if(archivePlanning($db)){
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

    function archivePlanning($db){
            $query = mysqli_query($db, "UPDATE pl_association SET ASSOC_Archi = 1 WHERE ASSOC_date = '".$_POST['ASSOC_Date']."' AND PL_id = ".$_POST["PL_id"]." AND ENC_Num = ".$_POST['ENC_Num'].";");
            return $query;
    }

  	function displayError($message = null){
        if($message != null){
      		echo '<div id="bad"> 
                  <label>'.$message.'</label>
                  </div>';
        }
        else{
            echo '<div id="bad"> 
                  <label>Une erreur s\'est produite lors de l\'archivage du planning !</label>
                  </div>';
        }
  	}

  	function displaySuccess(){
	    echo '<div id="good">
  			<label>Le planning du '.date("d/m/Y", strtotime($_POST['ASSOC_Date'])).' a été archivé avec succès !</label>
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