<?php
	$pwd = "../../";
	include($pwd.'bandeau.php');

	if(isset($_POST["request_type"]) && !empty($_POST["request_type"])){

		switch($_POST["request_type"]){
			case "cursus":
				postCursus($db);
				break;
			case "salarie";
				postSalarie($db);
				break;	
		}
	}

	function postSalarie($db){
		$queryPerMax = mysqli_query($db, "SELECT MAX(PER_Num) as maxi FROM Personnes");
        $resultPerMax = mysqli_fetch_assoc($queryPerMax);
        $perMax = $resultPerMax['maxi']+1;

        // !!!! NE PAS OUBLIER DE FAIRE LES TESTS SUR LES CHAMPS  !!!!

        if (isset($_POST["SAL_NumSalarie"]) && !empty($_POST["SAL_NumSalarie"]) && isset($_POST["TYP_Id"]) && !empty($_POST["TYP_Id"]){

        // traitement civils

        	$verif_infos = verification_civile();

        	$specialSalarie = isset($_POST["FCT_Id"]) && !empty($_POST["FCT_Id"]);

        	if (verif_infos){

		        if ($_POST["TYP_Id"] <= 5){

		        	$verif_urgence = isset($_POST["INS_UrgNom"]) && !empty($_POST["INS_UrgNom"])
		        					&& isset($_POST["INS_UrgPrenom"]) && !empty($_POST["INS_UrgPrenom"])
		        					&& isset($_POST["INS_UrgTel"]) && !empty($_POST["INS_UrgTel"]);

		        	$verif_pro = verification_pro();

		        	if (verif_pro && verif_urgence){
			        	// traitement contact d'urgence
			        	// traitement pro
		        	}
		        	else{
						displayError("Veuillez remplir correctement toutes les informations professionelles du salariés !".$_POST["CUR_Date"].mysqli_error($db));
		        	}
		        }
		        else

			}
			else{
				displayError("Veuillez remplir correctement toutes les informations civiles du salariés !".$_POST["CUR_Date"].mysqli_error($db));
			}
        }
        else
			displayError("Une erreur s'est produite pendant l'envoi du formulaire !");
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

	function verification_civile(){

		return isset($_POST["PER_Nom"]) && !empty($_POST["PER_Nom"])
			&& isset($_POST["PER_Prenom"]) && !empty($_POST["PER_Prenom"])
			&& isset($_POST["PER_Sexe"]) && !empty($_POST["PER_Sexe"])
			&& isset($_POST["PER_DateN"]) && !empty($_POST["PER_DateN"])
			&& isset($_POST["PER_LieuN"]) && !empty($_POST["PER_LieuN"])
			&& isset($_POST["PER_Nation"]) && !empty($_POST["PER_Nation"])
			&& isset($_POST["PER_NSecu"]) && !empty($_POST["PER_NSecu"]);
	}

	function 

	function verification_pro(){

		return isset($_POST["REF_NumRef"]) && !empty($_POST["REF_NumRef"])
			&& isset($_POST["INS_DateEntree"]) && !empty($_POST["INS_DateEntree"])
			&& isset($_POST["PRE_Id"]) && !empty($_POST["PRE_Id"])
			&& isset($_POST["INS_NivScol"]) && !empty($_POST["INS_NivScol"])
			&& isset($_POST["INS_Diplome"]) && !empty($_POST["INS_Diplome"])
			&& isset($_POST["INS_SituationF"]) && !empty($_POST["INS_SituationF"])
			&& isset($_POST["INS_RecoTH"])
			&& isset($_POST["INS_Permis"])
			&& isset($_POST["INS_Revenu"]) && !empty($_POST["INS_Revenu"])
			&& isset($_POST["INS_RevenuDepuis"]) && !empty($_POST["INS_RevenuDepuis"])
			&& isset($_POST["INS_PEDepuis"]) && !empty($_POST["INS_PEDepuis"])
			&& isset($_POST["INS_SEDepuis"]) && !empty($_POST["INS_SEDepuis"])
			&& isset($_POST["INS_Positionmt"]) && !empty($_POST["INS_Positionmt"])
			&& isset($_POST["INS_Mutuelle"]) && !empty($_POST["INS_Mutuelle"])
			&& isset($_POST["INS_SituGeo"]) && !empty($_POST["INS_SituGeo"])
			&& isset($_POST["INS_Repas"]) && !empty($_POST["INS_Repas"])
			&& isset($_POST["INS_TRepas"]) && !empty($_POST["INS_TRepas"])
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