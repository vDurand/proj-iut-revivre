<?php
	$pwd = "../../";
	include($pwd.'bandeau.php');

	if(isset($_POST["request_type"]) && !empty($_POST["request_type"])){

		switch($_POST["request_type"]){
			case "cursus":
				postCursus($db);
				break;
		}
	}

	function postCursus($db){
		if(isset($_POST["SAL_NumSalarie"]) && !empty($_POST["SAL_NumSalarie"]) && isset($_POST["CUR_Date"]) && !empty($_POST["CUR_Date"]) 
			&& isset($_POST["TYP_Id"]) && !empty($_POST["TYP_Id"]) && isset($_POST["CUR_Comment"])){

			if($_POST["TYP_Id"] > 0){
				$query = mysqli_query($db, "INSERT INTO cursus VALUES ('".$_POST["CUR_Date"]."', ".$_POST["SAL_NumSalarie"].", ".$_POST["TYP_Id"].", '".addslashes(suppr_carac($_POST["CUR_Comment"]))."');");
				
				if($query){
					$query2 = mysqli_query($db, "UPDATE salaries SET TYP_Id = ".$_POST["TYP_Id"]." WHERE SAL_NumSalarie = ".$_POST["SAL_NumSalarie"].";");
					
					if($query2){
						displaySuccess("Le cursus a bien été enregistré !");
					}
					else{
						displayError("Une erreur s'est produite pendant la sauvegarde du cursus !".$_POST["CUR_Date"].mysqli_error($db));
					}
				}
				else{
					displayError("Une erreur s'est produite pendant la sauvegarde du cursus !".$_POST["CUR_Date"].mysqli_error($db));
				}
			}
			else{
				displayError("Le type de contrat est invalide !");
			}
		}
		else{
			displayError("Une erreur s'est produite pendant l'envoi du formulaire !");
		}

		redirectPage();
	}

	function displayError($message){
		echo '<div id="corps">
				<div id="bad"> 
	            	<label>'.$message.'</label>
	            </div>
	          </div>';
	}

	function displaySuccess($message){
		echo '<div id="corps">
				<div id="good"> 
	            	<label>'.$message.'</label>
	            </div>
	          </div>';
	}

	function redirectPage(){
	    echo '<script type="text/javascript">
    			setTimeout(function(){
                    $.redirect("./showSalarie.php", {"SalNum": '.$_POST['SAL_NumSalarie'].'}, "get");
                }, 2500);
			</script>';
	}

	include($pwd.'footer.php');
?>