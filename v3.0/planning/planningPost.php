<?php
	$pageTitle = "Sauvegarde d'un planning";
	$pwd='../';
	include($pwd.'bandeau.php');
?>
<div id="corps">
<?php
	if(isset($_POST['ENC_Num']) && isset($_POST['ASSOC_Date']) && isset($_POST["PL_id"]) && isset($_POST['DataSalarie']) && isset($_POST['DataLogo'])
		&& isset($_POST['ASSOC_Couleur']) && isset($_POST['ASSOC_AM']) && isset($_POST['ASSOC_PM']) && isset($_POST['Type'])){

		$dataSalarieToStore = json_decode($_POST['DataSalarie']);
		$dataLogoToStore = json_decode($_POST['DataLogo']);

		if(mysqli_query($db, 'SET autocommit=0;') && mysqli_query($db, 'START TRANSACTION;'))
        {
        	if($_POST['Type'] == "new"){
        		if(newPlanning($db, $dataSalarieToStore, $dataLogoToStore)){
        			displaySuccess();
        			mysqli_query($db, 'COMMIT;');
        		}
        		else{
        			displayError();
        			mysqli_query($db, 'ROLLBACK;');
        		}
        	}
        	elseif($_POST['Type'] == "edit"){
				if(editPlanning($db, $dataSalarieToStore, $dataLogoToStore)){
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
	}
	else{
        displayError();
	}
    redirectPage();
?>
</div>
<?php
  	include($pwd.'footer.php');

  	function newPlanning($db, $dataSalarieToStore, $dataLogoToStore){
  		for($x=0; $x<sizeof($dataSalarieToStore); $x++){
			$query = mysqli_query($db, "INSERT INTO pl_association VALUES (".$dataSalarieToStore[$x][0].", ".$_POST['ENC_Num'].", ".$dataSalarieToStore[$x][1].", ".$_POST["PL_id"].", '".$_POST['ASSOC_Date']."', 0)");
  			if(!$query){
				  return false;
  			}
  		}

  		for($x=0; $x<sizeof($dataLogoToStore); $x++){
			$query = mysqli_query($db, "INSERT INTO pl_logo VALUES (".$dataLogoToStore[$x].", ".$_POST['ENC_Num'].", '".$_POST['ASSOC_Date']."', ".$_POST["PL_id"].")");
  			if(!$query){
				  return false;
  			}
  		}

		$query = mysqli_query($db, "INSERT INTO pl_proprietees VALUES (".$_POST['ENC_Num'].", '".$_POST['ASSOC_Date']."', ".$_POST["PL_id"].", '".$_POST['ASSOC_Couleur']."', '".$_POST['ASSOC_AM']."', '".$_POST['ASSOC_PM']."', '".date("Y-m-d")."')");
		if(!$query){
			return false;
		}

		return true;
  	}

  	function editPlanning($db, $dataSalarieToStore, $dataLogoToStore){

        $query = mysqli_query($db, "DELETE FROM pl_logo WHERE ENC_Num = ".$_POST['ENC_Num']." AND ASSOC_Date = '".$_POST['ASSOC_Date']."' AND PL_id = ".$_POST["PL_id"].";");
        if(!$query){
            return false;
        }

        $query = mysqli_query($db, "DELETE FROM pl_proprietees WHERE ENC_Num = ".$_POST['ENC_Num']." AND ASSOC_Date = '".$_POST['ASSOC_Date']."' AND PL_id = ".$_POST["PL_id"].";");
        if(!$query){
            return false;
        }

        $query = mysqli_query($db, "DELETE FROM pl_association WHERE ENC_Num = ".$_POST['ENC_Num']." AND ASSOC_Date = '".$_POST['ASSOC_Date']."' AND PL_id = ".$_POST["PL_id"].";");
        if(!$query){
            return false;
        }

        return newPlanning($db, $dataSalarieToStore, $dataLogoToStore);
  	}

  	function displayError(){
  		echo '<div id="bad"> 
              <label>Une erreur s\'est produite lors de la sauvegarde du planning !</label>
              </div>';
  	}

  	function displaySuccess(){
        echo '<div id="good">
	        <label>Le planning du '.date("d/m/Y", strtotime($_POST['ASSOC_Date'])).' a été sauvegardé avec succès !</label>
	        </div>';
  	}

  	function redirectPage(){
	    echo '<script type="text/javascript">
    			setTimeout(function(){
                    $.redirect("./planningShowcase.php", {"ENC_Num": '.$_POST['ENC_Num'].', "ASSOC_Date": "'.$_POST['ASSOC_Date'].'", "PL_id": '.$_POST['PL_id'].'})
                }, 2500);
			</script>';
  	}
?>

