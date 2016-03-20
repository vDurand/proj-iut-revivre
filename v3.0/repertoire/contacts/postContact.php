<?php
	$pwd = "../../";
	include($pwd.'bandeau.php');

	$error_handler = "";

	if(isset($_POST["request_type"]) && !empty($_POST["request_type"])){
		switch($_POST["request_type"]){
			case "add";
				addContact($db, $error_handler);
				break;
			case "edit";
				editContact($db, $error_handler);
				break;
			case "employe";
				addEmploye($db, $error_handler);
				break;	
			case "editEmploye";
				editEmploye($db, $error_handler);
				break;
		}
	}
	else{
		displayError("Une erreur s'est produite pendant l'envoi du formulaire !");
	}

	function editEmploye($db, &$error_handler){
		if(isset($_POST["PER_Num"]) && !empty($_POST["PER_Num"]) && isset($_POST["Type"]) && !empty($_POST["Type"]) && isset($_POST["TC_ID"]) && !empty($_POST["TC_ID"]) && isset($_POST["ConNum"]) && !empty($_POST["ConNum"])){

			$prep="PER";
			$table="personnes";
			$verif_infos = verification_civile($error_handler, $prep);

			$querying = true;

			if($verif_infos){
	        	if(mysqli_query($db, 'SET autocommit=0;') && mysqli_query($db, 'START TRANSACTION;')){
					if($querying){
						$querying = mysqli_query($db,  "UPDATE ".$table." SET ".$prep."_Nom = '".$_POST[$prep."_Nom"]."',
																			 ".$prep."_Prenom = '".$_POST[$prep."_Prenom"]."',
																			 ".$prep."_Adresse = '".$_POST[$prep."_Adresse"]."',
																			 ".$prep."_CodePostal = ".$_POST[$prep."_CodePostal"].",
																			 ".$prep."_Ville = '".$_POST[$prep."_Ville"]."',
																			 ".$prep."_TelFixe = '".$_POST[$prep."_TelFixe"]."',
																			 ".$prep."_TelPort = '".$_POST[$prep."_TelPort"]."',
																			 ".$prep."_Fax = '".$_POST[$prep."_Fax"]."',
																			 ".$prep."_Email = '".$_POST[$prep."_Email"]."'
														WHERE ".$prep."_Num=".$_POST["PER_Num"].";");

						if($querying && $_POST["TC_ID"] == 1){		
							$querying = mysqli_query($db,"UPDATE employerfourn SET EMF_Fonction='".addslashes($_POST["Fonction"])."' WHERE FOU_NumFournisseur = ".$_POST["ConNum"]." AND PER_Num = ".$_POST["PER_Num"]);	

							if($querying){
								displaySuccess("L'employé a bien été modifié !");
								mysqli_query($db, 'COMMIT;');
								redirectPage($_POST["ConNum"],$_POST["TC_ID"]);
							}
							else{
								echo mysqli_error($db);
								displayError("Une erreur s'est produite pendant l'envoi du formulaire, réessayez !");
								mysqli_query($db, 'ROLLBACK;');
								redirectPageFormErrors($error_handler, "Employe",$_POST["TC_ID"]);
							}		
						}
						else{
							if($querying && $_POST["TC_ID"] == 2){
								$querying = mysqli_query($db,"UPDATE employerclient SET EMC_Fonction='".addslashes($_POST["Fonction"])."' WHERE CLI_NumClient = ".$_POST["ConNum"]." AND PER_Num = ".$_POST["PER_Num"]);	
							}
							else{
								displayError("Une erreur s'est produite pendant l'envoi du formulaire, réessayez !");
								mysqli_query($db, 'ROLLBACK;');
								redirectPageFormErrors($error_handler, "Employe",$_POST["TC_ID"]);
							}
						}
					}
					else{
						displayError("Une erreur s'est produite pendant l'envoi du formulaire, réessayez !");
						mysqli_query($db, 'ROLLBACK;');
						redirectPageFormErrors($error_handler, "Employe",$_POST["TC_ID"]);
					}
				}
				else{
					displayError("Une erreur s'est produite pendant l'envoi du formulaire !");
				}
			}
			else{
				displayError("Veuillez remplir correctement tous les champs du formulaire, réessayez !");
				redirectPageFormErrors($error_handler, "Employe",$_POST["TC_ID"]);	
			}
		}
		else{
			displayError("Une erreur s'est produite pendant l'envoi du formulaire !");
		}
	}

	function addContact($db, &$error_handler){
        if(isset($_POST["TC_ID"]) && !empty($_POST["TC_ID"])){
			
			if($_POST["TC_ID"] == 1){
				$type = "Fournisseur";
	            $prep = "FOU";
	            $table = "fournisseurs";
	        }
	        else {
	            $type = "Client";
	            $prep = "CLI";
	            $table = "clients";
	        }

			$querying = true;
			$verif_infos = verification_civile($error_handler, $prep);

			if($verif_infos){
	        	if(mysqli_query($db, 'SET autocommit=0;') && mysqli_query($db, 'START TRANSACTION;')){
	        		
					if($querying){
						$querying = mysqli_query($db, "INSERT INTO ".$table." (".$prep."_Nom, ".$prep."_Telephone, ".$prep."_Portable, ".$prep."_Fax, ".$prep."_Email, ".$prep."_Adresse, ".$prep."_CodePostal, ".$prep."_Ville) 
							VALUES (
							'".addslashes($_POST[$prep."_Nom"])."', 
							'".addslashes($_POST[$prep."_TelFixe"])."',
							'".addslashes($_POST[$prep."_TelPort"])."', 
							'".addslashes($_POST[$prep."_Fax"])."',
							'".addslashes($_POST[$prep."_Email"])."',
							'".addslashes($_POST[$prep."_Adresse"])."',
							            ".$_POST[$prep."_CodePostal"].", 
							'".addslashes($_POST[$prep."_Ville"])."');");

						if($querying && $type == "Client" && isset($_POST["CLI_Prenom"])){	
							$querynum = mysqli_query($db,"SELECT MAX(CLI_NumClient) as num from clients;");	
							$numclient = mysqli_fetch_assoc($querynum);			
							$querying = mysqli_query($db,"UPDATE clients SET CLI_Prenom='".addslashes($_POST["CLI_Prenom"])."' WHERE CLI_NumClient = ".$numclient["num"]);

							if($querying){
								displaySuccess("Le ".strtolower($type)." a bien été enregistré !");
								$query = mysqli_query($db, "SELECT max(CLI_NumClient) as ConNum FROM clients;");
								$TC_ID = 2;
								$data = mysqli_fetch_assoc($query);
								mysqli_query($db, 'COMMIT;');
								redirectPage($data["ConNum"],$TC_ID,"particulier");
							}
							else{
								displayError("Une erreur s'est produite pendant l'envoi du formulaire, réessayez !");
								mysqli_query($db, 'ROLLBACK;');
								redirectPageFormErrors($error_handler,$type,$_POST["TC_ID"]);
							}				
						}
						else{
							if($querying){
								displaySuccess("Le ".strtolower($type)." a bien été enregistré !");
								if($type == "Fournisseur"){
									$query = mysqli_query($db, "SELECT max(FOU_NumFournisseur) as ConNum FROM fournisseurs;");
									$TC_ID = 1;
								}
								else{
									$query = mysqli_query($db, "SELECT max(CLI_NumClient) as ConNum FROM clients;");
									$TC_ID = 2;
								}
								$data = mysqli_fetch_assoc($query);
								mysqli_query($db, 'COMMIT;');
								redirectPage($data["ConNum"],$TC_ID);
							}
							else{
								displayError("Une erreur s'est produite pendant l'envoi du formulaire, réessayez !");
								mysqli_query($db, 'ROLLBACK;');
								redirectPageFormErrors($error_handler, $type,$_POST["TC_ID"]);
							}
						}
					}
					else{
						displayError("Une erreur s'est produite pendant l'envoi du formulaire, réessayez !");
						mysqli_query($db, 'ROLLBACK;');
						redirectPageFormErrors($error_handler, $type,$_POST["TC_ID"]);
					}
		        }
		        else{
					displayError("Une erreur s'est produite pendant l'envoi du formulaire !");
				}
			}
			else{
				displayError("Veuillez remplir correctement tous les champs du formulaire, réessayez !");
				redirectPageFormErrors($error_handler, $type,$_POST["TC_ID"]);	
			}
        }
        else{
			displayError("Une erreur s'est produite pendant l'envoi du formulaire !");
		}
	}

	function editContact($db, &$error_handler){
		$typeClient = "";
		if(isset($_POST["ConNum"]) && !empty($_POST["ConNum"]) && isset($_POST["TC_ID"]) && !empty($_POST["TC_ID"])){
			if($_POST["TC_ID"] == 1){
				$prep = "FOU";
				$table = "fournisseurs";
				$type = "Fournisseur";				
			}
			else{
				if($_POST["TC_ID"] == 2){
					$prep = "CLI";
					$table = "clients";
					$type = "Client";

					if(isset($_POST["TypeClient"]) && $_POST["TypeClient"]=="particulier"){
						$typeClient = "particulier";
					}				
				}
				else{
					displayError("Une erreur s'est produite pendant l'envoi du formulaire !");
				}
			}

			$querying = true;
			$verif_infos = verification_civile($error_handler, $prep, $typeClient);

			if($verif_infos){
	        	if(mysqli_query($db, 'SET autocommit=0;') && mysqli_query($db, 'START TRANSACTION;')){
					if($querying){
						$querying = mysqli_query($db,  "UPDATE ".$table." SET ".$prep."_Nom = '".$_POST[$prep."_Nom"]."',
																			 ".$prep."_Adresse = '".$_POST[$prep."_Adresse"]."',
																			 ".$prep."_CodePostal = ".$_POST[$prep."_CodePostal"].",
																			 ".$prep."_Ville = '".$_POST[$prep."_Ville"]."',
																			 ".$prep."_Telephone = '".$_POST[$prep."_TelFixe"]."',
																			 ".$prep."_Portable = '".$_POST[$prep."_TelPort"]."',
																			 ".$prep."_Fax = '".$_POST[$prep."_Fax"]."',
																			 ".$prep."_Email = '".$_POST[$prep."_Email"]."'
														WHERE ".$prep."_Num".$type."=".$_POST["ConNum"].";");

						if($querying && $type == "Client" && $typeClient == "particulier"){		
							$querying = mysqli_query($db,"UPDATE clients SET CLI_Prenom='".addslashes($_POST[$prep."_Prenom"])."' WHERE CLI_NumClient = ".$_POST["ConNum"]);
							if($querying){
								displaySuccess("Le ".strtolower($type)." a bien été modifié !");
								mysqli_query($db, 'COMMIT;');
								redirectPage($_POST["ConNum"],$_POST["TC_ID"]);
							}
							else{
								displayError("Une erreur s'est produite pendant l'envoi du formulaire, réessayez !");
								mysqli_query($db, 'ROLLBACK;');
								redirectPageFormErrors($error_handler,$type,$_POST["TC_ID"]);
							}				
						}
						else{
							if($querying){
								displaySuccess("Le ".strtolower($type)." a bien été modifié !");
								mysqli_query($db, 'COMMIT;');
								redirectPage($_POST["ConNum"],$_POST["TC_ID"]);
							}
							else{
								displayError("Une erreur s'est produite pendant l'envoi du formulaire, réessayez !");
								mysqli_query($db, 'ROLLBACK;');
								redirectPageFormErrors($error_handler, $type,$_POST["TC_ID"]);
							}
						}
					}
					else{
						displayError("Une erreur s'est produite pendant l'envoi du formulaire, réessayez !");
						mysqli_query($db, 'ROLLBACK;');
						redirectPageFormErrors($error_handler, $type,$_POST["TC_ID"]);
					}
				}
				else{
					displayError("Une erreur s'est produite pendant l'envoi du formulaire !");
				}
			}
			else{
				displayError("Veuillez remplir correctement tous les champs du formulaire, réessayez !");
				redirectPageFormErrors($error_handler,$type,$_POST["TC_ID"]);	
			}

		}
		else{
			displayError("Une erreur s'est produite pendant l'envoi du formulaire !");
		}
	}

	function addEmploye($db){
		if(isset($_POST["TypeClient"]) && !empty($_POST["TypeClient"]) && isset($_POST["connum"]) && !empty($_POST["connum"])){
			if($_POST["TypeClient"] == "Fournisseur"){								
				$type = "fournisseur";
				$TC_ID = 1;
			}
			else{
				if($_POST["TypeClient"] == "structure"){										
					$type = "client";
					$TC_ID = 2;
				}
				else{
					displayError("Une erreur s'est produite pendant l'envoi du formulaire !");
				}
			}

			if(!empty($_POST["Fonction"])){
				$_POST["Fonction"] = FirstToUpper(suppr_carac_spe($_POST["Fonction"]));
			}
			else{
				$_POST["Fonction"] = null;
			}
			
			$verif_infos = verification_civile($error_handler, "PER");

			if($verif_infos){
				if(mysqli_query($db, 'SET autocommit=0;') && mysqli_query($db, 'START TRANSACTION;')){
					$query1 = mysqli_query($db, "INSERT INTO personnes (PER_Nom, PER_Prenom, PER_Adresse, PER_CodePostal, PER_Ville, PER_TelFixe, PER_TelPort, PER_Fax, PER_Email)
												 VALUES ('".$_POST["PER_Nom"]."',
												 '".$_POST["PER_Prenom"]."',
												 '".$_POST["PER_Adresse"]."',
												  ".$_POST["PER_CodePostal"].",
												 '".$_POST["PER_Ville"]."',
												 '".$_POST["PER_TelFixe"]."',
												 '".$_POST["PER_TelPort"]."',
												 '".$_POST["PER_Fax"]."',
												 '".$_POST["PER_Email"]."')");
					if($query1){

						$query2 = mysqli_query($db,"SELECT MAX(PER_Num) as EmpNum FROM personnes");
						$empnum = mysqli_fetch_assoc($query2);

						if($type=="fournisseur"){
							$req="INSERT INTO employerfourn VALUES (".$_POST["connum"].", ".$empnum["EmpNum"].", '".$_POST["Fonction"]."');";
						} 
						else{
							$req="INSERT INTO employerclient VALUES (".$_POST["connum"].", ".$empnum["EmpNum"].", '".$_POST["Fonction"]."');";
						}

						$query3 = mysqli_query($db,$req);

						if($query2 && $query3){
							displaySuccess("L'employé a bien été enregistré !");
							mysqli_query($db, 'COMMIT;');
							redirectPage($_POST["connum"],$TC_ID);
						}
						else{
							displayError("Une erreur s'est produite pendant l'envoi du formulaire, réessayez !");
							echo mysqli_error($db);
							mysqli_query($db, 'ROLLBACK;');
						}
					}
					else{
						displayError("Une erreur s'est produite pendant l'envoi du formulaire, réessayez !");
						mysqli_query($db, 'ROLLBACK;');
					}
				}
				else{
					displayError("Une erreur s'est produite pendant l'envoi du formulaire !");
				}
			}
			else{
				displayError("Veuillez remplir correctement tous les champs du formulaire, réessayez !");
				redirectPageFormErrors($error_handler, "Employe",$_POST["TC_ID"]);	
			}
		}
		else{
			displayError("Une erreur s'est produite pendant l'envoi du formulaire !");
		}
	}

	function verification_civile(&$error_handler, $prep, $type=""){
		
		$fieldOk = isset($_POST[$prep."_Nom"]) && !empty($_POST[$prep."_Nom"])
				&& isset($_POST[$prep."_Adresse"]) 
				&& isset($_POST[$prep."_Ville"])
				&& isset($_POST[$prep."_CodePostal"])
				&& isset($_POST[$prep."_TelFixe"]);

		if(($prep == "CLI" && $type == "particulier") || $prep == "PER"){
			if(isset($_POST[$prep."_Prenom"]) && !empty($_POST[$prep."_Prenom"])){
				$_POST[$prep."_Prenom"] = FirstToUpper(deleteSpecialChars(suppr_carac_spe($_POST[$prep."_Prenom"])));
			}
			else{
				$error_handler .= $prep."_Prenom|Le prénom n'est pas conforme;";
				$fieldOk = false;
			}
		}

		if(isset($_POST["Fonction"]) && !empty($_POST["Fonction"])){
			$_POST["Fonction"] = FirstToUpper(deleteSpecialChars(suppr_carac_spe($_POST["Fonction"])));
		}

		$_POST[$prep."_Nom"] = strtoupper(deleteSpecialChars(suppr_carac_spe($_POST[$prep."_Nom"])));
		$_POST[$prep."_Adresse"] = (!empty($_POST[$prep."_Adresse"])) ? FirstToUpper(deleteSpecialChars(suppr_carac_spe($_POST[$prep."_Adresse"]))) : null;
		$_POST[$prep."_Ville"] = (!empty($_POST[$prep."_Ville"])) ? strtoupper(deleteSpecialChars(suppr_carac_spe($_POST[$prep."_Ville"]))) : null;

		if(!empty($_POST[$prep."_CodePostal"])){
			if(isPostalCode($_POST[$prep."_CodePostal"])){
				$_POST[$prep."_CodePostal"] = str_replace(array(" ", ".", "-"), "", $_POST[$prep."_CodePostal"]);
			}
			else{
				$error_handler .= $prep."_CodePostal|Le code postal n'est pas conforme;";
				$fieldOk = false;
			}
		}
		else{
			$_POST[$prep."_CodePostal"] = null;
		}
		
		if(!empty($_POST[$prep."_TelFixe"])){
			if(isPhoneNumber($_POST[$prep."_TelFixe"])){
				$_POST[$prep."_TelFixe"] = str_replace(array(" ", ".", "-"), "", $_POST[$prep."_TelFixe"]);
			}
			else{
				$error_handler .= $prep."_TelFixe|Le numéro de téléphone fixe n'est pas conforme;";
				$fieldOk = false;
			}
		}
		else{
			$_POST[$prep."_TelFixe"] = null;
		}

		if(!empty($_POST[$prep."_TelPort"])){
			if(isPhoneNumber($_POST[$prep."_TelPort"])){
				$_POST[$prep."_TelPort"] = str_replace(array(" ", ".", "-"), "", $_POST[$prep."_TelPort"]);
			}
			else{
				$error_handler .= $prep."_TelPort|Le numéro de téléphone portable n'est pas conforme;";
				$fieldOk = false;
			}
		}
		else{
			$_POST[$prep."_TelPort"] = null;
		}

		if(!empty($_POST[$prep."_Fax"])){
			if(isPhoneNumber($_POST[$prep."_Fax"])){
				$_POST[$prep."_Fax"] = str_replace(array(" ", ".", "-"), "", $_POST[$prep."_Fax"]);
			}
			else{
				$error_handler .= $prep."_Fax|Le numéro de fax n'est pas conforme;";
				$fieldOk = false;
			}
		}
		else{
			$_POST[$prep."_Fax"] = null;
		}

		if(!empty($_POST[$prep."_Email"])){
			if(!isEmail($_POST[$prep."_Email"])){
				$error_handler .= $prep."_Email|L'email n'est pas conforme (adresse@site.extension);";
				$fieldOk = false;
			}
		}
		else{
			$_POST[$prep."_Email"] = null;
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

	function redirectPage($ConNum,$TC_ID,$typeClient=""){
		if($TC_ID == 1){
		    echo '<script type="text/javascript">
	    			setTimeout(function(){
	                    $.redirect("./showContact.php", {"ConNum": '.$ConNum.',"TC_ID": '.$TC_ID.'}, "POST");
	                }, 2500);
				</script>';
		}
		else{
			if($typeClient=="particulier"){
				echo '<script type="text/javascript">
	    			setTimeout(function(){
	                    $.redirect("./showContact.php", {"ConNum": '.$ConNum.',"TC_ID": '.$TC_ID.',"TypeClient": "particulier"}, "POST");
	                }, 2500);
				</script>';
			}
			else{
				echo '<script type="text/javascript">
	    			setTimeout(function(){
	                    $.redirect("./showContact.php", {"ConNum": '.$ConNum.',"TC_ID": '.$TC_ID.',"TypeClient": "structure"}, "POST");
	                }, 2500);
				</script>';
			}
		}
	}

	function redirectPageFormErrors(&$error_handler, $type, $TC_ID, $typeClient=false, $connum=0){
		echo '<form action="editContact.php" method="POST" id="tempForm">';
		foreach ($_POST as $key => $value) {
			echo '<input type="hidden" name="'.htmlentities($key).'" value="'.htmlentities($value).'">';
		}

		if($typeClient!=false && $connum!=0){
			echo '<input type="hidden" name="TypeClient" value="'.$typeClient.'">
				<input type="hidden" name="connum" value="'.$connum.'">';
		}

	    echo '<input type="hidden" name="Post_Errors" value="'.$error_handler.'">
	    	<input type="hidden" name="Head_Title" value="Ajout d\'un contact">
	    	<input type="hidden" name="TC_ID" value="'.$TC_ID.'">
	    	<input type="hidden" id="request_type" name="request_type" value="'.$type.'"/>
	    	</form>
	    	<script type="text/javascript">
    			setTimeout(function(){
                   $("#tempForm").submit();
                }, 2500);
			</script>';
	}

	include($pwd.'footer.php');
?>