<?php
	$pwd = "../../../";
	include($pwd.'bandeau.php');
	$error_handler = "";
	editReferent($db, $error_handler);

	function editReferent($db, &$error_handler){
		if(isset($_POST["REF_NumRef"]) && !empty($_POST["REF_NumRef"])){
			
			if(verification_civile($error_handler)){
				if(mysqli_query($db, 'SET autocommit=0;') && mysqli_query($db, 'START TRANSACTION;')){
					$querying = mysqli_query($db, "UPDATE referents SET PRE_Id = ".$_POST["PRE_Id"]." WHERE REF_NumRef = ".$_POST["REF_NumRef"].";");

					if($querying){
						$querying = mysqli_query($db, "UPDATE personnes SET PER_Nom = '".addslashes($_POST["PER_Nom"])."', PER_Prenom = '".addslashes($_POST["PER_Prenom"])."', 
							PER_TelFixe = '".addslashes($_POST["PER_TelFixe"])."', PER_TelPort = '".addslashes($_POST["PER_TelPort"])."', PER_Fax = '".addslashes($_POST["PER_Fax"])."',
							PER_Email = '".addslashes($_POST["PER_Email"])."', PER_Adresse = '".addslashes($_POST["PER_Adresse"])."', PER_CodePostal = '".$_POST["PER_CodePostal"]."',
							PER_Ville = '".addslashes($_POST["PER_Ville"])."', PER_DateN = '".$_POST["PER_DateN"]."', PER_LieuN = '".addslashes($_POST["PER_LieuN"])."',
							PER_Nation = '".addslashes($_POST["PER_Nation"])."', PER_NSecu = 0, PER_Sexe = ".$_POST["PER_Sexe"]." WHERE PER_Num = ".$_POST["PER_Num"].";");

						if($querying){
							displaySuccess((($_POST["PER_Sexe"] == "true") ? "M. " : "Mme ").$_POST["PER_Nom"]." ".$_POST["PER_Prenom"]." a bien été modifié".(($_POST["PER_Sexe"] == "true") ? "" : "(e)")." !");
							mysqli_query($db, 'COMMIT;');
							redirectPage($_POST["REF_NumRef"]);
						}
						else{
							displayError("Une erreur s'est produite pendant l'envoi du formulaire, réessayez !<br/>".mysqli_error($db));
							mysqli_query($db, 'ROLLBACK;');
							redirectPageFormErrors($error_handler, "edit");
						}
					}
					else{
						displayError("Une erreur s'est produite pendant l'envoi du formulaire, réessayez !<br/>".mysqli_error($db));
						mysqli_query($db, 'ROLLBACK;');
						redirectPageFormErrors($error_handler, "edit");
					}
				}
				else{
					displayError("Une erreur s'est produite pendant l'envoi du formulaire, réessayez !<br/>".mysqli_error($db));
					redirectPageFormErrors($error_handler, "edit");
				}
			}
			else{
				displayError("Veuillez remplir correctement tous les champs du formulaire, réessayez !");
				redirectPageFormErrors($error_handler, "edit");
			}
		}
		else{
			displayError("Une erreur s'est produite pendant l'envoi du formulaire, réessayez !");
			redirectPageFormErrors($error_handler, "edit");
		}
	}

	function verification_civile(&$error_handler){
		$fieldOk = isset($_POST["PER_Nom"]) && !empty($_POST["PER_Nom"])
			&& isset($_POST["PER_Prenom"]) && !empty($_POST["PER_Prenom"])
			&& isset($_POST["PER_Sexe"]) && !empty($_POST["PER_Sexe"])
			&& isset($_POST["PER_DateN"]) && !empty($_POST["PER_DateN"])
			&& isset($_POST["PER_LieuN"]) && !empty($_POST["PER_LieuN"])
			&& isset($_POST["PER_Nation"]) && !empty($_POST["PER_Nation"])
			&& isset($_POST["PER_Adresse"]) && isset($_POST["PER_Ville"])
			&& isset($_POST["PER_CodePostal"]) && isset($_POST["PER_TelFixe"])
			&& isset($_POST["PER_TelPort"]) && isset($_POST["PER_Fax"])
			&& isset($_POST["PER_Email"]);

		$_POST["PER_Nom"] = strtoupper(deleteSpecialChars(suppr_carac_spe($_POST["PER_Nom"])));
		$_POST["PER_Prenom"] = FirstToUpper(deleteSpecialChars(suppr_carac_spe($_POST["PER_Prenom"])));
		$_POST["PER_LieuN"] = strtoupper(suppr_carac_spe($_POST["PER_LieuN"]));
		$_POST["PER_Nation"] = strtoupper(deleteSpecialChars(suppr_carac_spe($_POST["PER_Nation"])));
		$_POST["PER_Adresse"] = (!empty($_POST["PER_Adresse"])) ? FirstToUpper(deleteSpecialChars(suppr_carac_spe($_POST["PER_Adresse"]))) : null;
		$_POST["PER_Ville"] = (!empty($_POST["PER_Ville"])) ? strtoupper(deleteSpecialChars(suppr_carac_spe($_POST["PER_Ville"]))) : null;

		if(!empty($_POST["PER_CodePostal"])){
			if(isPostalCode($_POST["PER_CodePostal"])){
				$_POST["PER_CodePostal"] = str_replace(array(" ", ".", "-"), "", $_POST["PER_CodePostal"]);
			}
			else{
				$error_handler .= "PER_CodePostal|Le code postal n'est pas conforme (Ex : 14000);";
				$fieldOk = false;
			}
		}
		else{
			$_POST["PER_CodePostal"] = null;
		}
		
		if(!empty($_POST["PER_TelFixe"])){
			if(isPhoneNumber($_POST["PER_TelFixe"])){
				$_POST["PER_TelFixe"] = str_replace(array(" ", ".", "-"), "", $_POST["PER_TelFixe"]);
			}
			else{
				$error_handler .= "PER_TelFixe|Le numéro de téléphone fixe n'est pas conforme (Ex : 0100000000);";
				$fieldOk = false;
			}
		}
		else{
			$_POST["PER_TelFixe"] = null;
		}

		if(!empty($_POST["PER_TelPort"])){
			if(isPhoneNumber($_POST["PER_TelPort"])){
				$_POST["PER_TelPort"] = str_replace(array(" ", ".", "-"), "", $_POST["PER_TelPort"]);
			}
			else{
				$error_handler .= "PER_TelPort|Le numéro de téléphone portable n'est pas conforme (Ex : 0600000000);";
				$fieldOk = false;
			}
		}
		else{
			$_POST["PER_TelPort"] = null;
		}

		if(!empty($_POST["PER_Fax"])){
			if(isPhoneNumber($_POST["PER_Fax"])){
				$_POST["PER_Fax"] = str_replace(array(" ", ".", "-"), "", $_POST["PER_Fax"]);
			}
			else{
				$error_handler .= "PER_Fax|Le numéro de fax n'est pas conforme (Ex : 0100000000);";
				$fieldOk = false;
			}
		}
		else{
			$_POST["PER_Fax"] = null;
		}

		if(!empty($_POST["PER_Email"])){
			if(!isEmail($_POST["PER_Email"])){
				$error_handler .= "PER_Email|L'email n'est pas conforme (Ex : adresse@site.extension);";
				$fieldOk = false;
			}
		}
		else{
			$_POST["PER_Email"] = null;
		}

		if(!isset($_POST["PRE_Id"])){
			$error_handler .= "PRE_Id|Le prescripteur n'est pas conforme;";
			$fieldOk = false;
		}

		return $fieldOk;
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

	function redirectPage($RefNum){
		if(isset($RefNum) && !empty($RefNum)){
		    echo '<script type="text/javascript">
	    			setTimeout(function(){
	                    $.redirect("./showReferent.php", {"RefNum": '.$RefNum.'}, "get");
	                }, 2500);
				</script>';
		}
		else{
			echo '<script type="text/javascript">
	    			setTimeout(function(){
	                    $.redirect("'.$pwd.'home.php");
	                }, 2500);
				</script>';
		}
	}

	function redirectPageFormErrors(&$error_handler, $type){
		echo '<form action="editReferent.php" method="POST" id="tempForm">';

		foreach ($_POST as $key => $value) {
			echo '<input type="hidden" name="'.htmlentities($key).'" value="'.htmlentities($value).'">';
		}
	    echo '<input type="hidden" name="Post_Errors" value="'.$error_handler.'">';

	    echo '</form>
	    	<script type="text/javascript">
    			setTimeout(function(){
                	$("#tempForm").submit();
                }, 2500);.
			</script>';
	}

	include($pwd.'footer.php');
?>