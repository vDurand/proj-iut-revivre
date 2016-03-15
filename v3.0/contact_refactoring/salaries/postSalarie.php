<?php
	$pwd = "../../";
	include($pwd.'bandeau.php');

	$error_handler = "";	

	if(isset($_POST["request_type"]) && !empty($_POST["request_type"])){
		switch($_POST["request_type"]){
			case "cursus":
				postCursus($db);
				break;
			case "add";
				addSalarie($db, $error_handler);
				break;
			case "edit":
				editSalarie($db, $error_handler);
				break;

			default:
		        echo '<div id="bad"> 
		              <label>Une erreur s\'est produite lors de l\'envoi du formulaire !</label>
		              </div>'; 
		        break;	
		}
	}

	function editSalarie($db, &$error_handler){
        if(isset($_POST["TYP_Id"]) && !empty($_POST["TYP_Id"])){
			
			$querying = true;
			$verif_infos = verification_civile(($_POST["TYP_Id"] <= 5), $error_handler);

			if($_POST["TYP_Id"] > 5){
				$verif_infos = verification_urgent($error_handler);
				$verif_infos =  verification_pro($error_handler);
			}

			if($verif_infos){
	        	if(mysqli_query($db, 'SET autocommit=0;') && mysqli_query($db, 'START TRANSACTION;')){
	        		$requete = ("UPDATE personnes set 
										PER_Nom = '".addslashes($_POST["PER_Nom"])."',
										PER_Prenom = '".addslashes($_POST["PER_Prenom"])."',
										PER_TelFixe = '".addslashes($_POST["PER_TelFixe"])."',
										PER_TelPort = '".addslashes($_POST["PER_TelPort"])."',
										PER_Fax = '".addslashes($_POST["PER_Fax"])."',
										PER_Email = '".addslashes($_POST["PER_Email"])."',
										PER_Adresse = '".addslashes($_POST["PER_Adresse"])."',
										PER_CodePostal = ".$_POST["PER_CodePostal"].",
										PER_Ville = '".addslashes($_POST["PER_Ville"])."',
										PER_DateN = '".$_POST["PER_DateN"]."',
										PER_LieuN = '".addslashes($_POST["PER_LieuN"])."',
										PER_Nation = '".addslashes($_POST["PER_Nation"])."',
										PER_NPoleEmp = '".$_POST["PER_NPoleEmp"]."', 
										PER_NSecu = ".$_POST["PER_NSecu"].",
										PER_NCaf = '".$_POST["PER_NCaf"]."',
										PER_Sexe = ".$_POST["PER_Sexe"]."
								WHERE PER_Num in (
									SELECT PER_Num from salaries WHERE
									SAL_NumSalarie = ".$_POST["SAL_NumSalarie"].")");

					//echo $requete;

					$querying = mysqli_query($db, $requete);

					if($querying){
						if(isset($_POST["SAL_DateSortie"]) && !empty($_POST["SAL_DateSortie"])){
							$querying = mysqli_query($db, "UPDATE salaries set SAL_DateSortie = ".$_POST["SAL_DateSortie"]);
						}

						if($querying){
							if($_POST["TYP_Id"] > 5){

								if(isset($_POST["new_PRE_Id"])){ // si le champs du prescripteurs est rempli, on ajoute le nouveau prescripteur ...
									$requete = "INSERT INTO prescripteurs (PRE_Nom) VALUES ('".addslashes($_POST["new_PRE_Id"])."')";
									echo $requete;
									$querying = mysqli_query($db, $requete);
									// ... et on met à jour la fiche en remplacant le PRE_Id par le numéro du nouveau prescripteur rentré
									$requete = "UPDATE referents set PRE_Id = max(PRE_Id) where PER_Num = (select PER_Num from salaries where SAL_NumSalarie = ".$_POST["SAL_NumSalarie"].")";
									echo $requete;
									$querying = mysqli_query($db, $requete);
								}
								// sinon on remplace le numéro par celui du nouveau
								$requete = "UPDATE referents set PRE_Id = ".$_POST["PRE_Id"]." where PER_Num = (select PER_Num from salaries where SAL_NumSalarie = ".$_POST["SAL_NumSalarie"].")";
								echo $requete;
								$querying = mysqli_query($db, $requete);

								if(isset($_POST["new_REF_NumRef"])){ // si un nouveau referents est rentré, on l'ajoute dans les personnes
									$referentName = explode(" ", $_POST["new_REF_NumRef"]);
									$requete = "INSERT INTO personnes (PER_Nom, PER_Prenom)
										VALUES ('".strtoupper(suppr_carac_spe($referentName[0]))."', '".FirstToUpper(suppr_carac_spe($referentName[1]))."');";
									$querying = mysqli_query($db, $requete);

									// on ajoute ce referents dans la table des referents en y associant le numéro de la personne réferente et celle de la personne reférencée
									// sinon le numéro d'un nouveau prescripteurs déjà existants
									$querying = mysqli_query($db, "INSERT INTO referents VALUES ((SELECT max(REF_NumRef)+1 FROM (SELECT * FROM referents) AS rtable), (SELECT max(PER_Num) FROM personnes),
									".(isset($_POST["new_REF_NumRef"]) ? "(SELECT max(REF_NumRef) FROM prescripteurs)" : $_POST["REF_NumRef"]).");");
								}

								if($querying){
									$requete = "UPDATE insertion set
													INS_DateEntretien = '".$_POST["INS_DateEntretien"]."',
													INS_SituationF = '".addslashes($_POST["INS_SituationF"])."',
													INS_NivScol = '".$_POST["INS_NivScol"]."',
													INS_Diplome = '".$_POST["INS_Diplome"]."',
													INS_Permis = '".$_POST["INS_Permis"]."',
													INS_RecoTH = '".$_POST["INS_RecoTH"]."',
													INS_Revenu = '".$_POST["INS_Revenu"]."',
													INS_Mutuelle = '".$_POST["INS_Mutuelle"]."',
													CNV_Id = '".$_POST["CNV_Id"]."',
													CNT_Id = '".$_POST["CNT_Id"]."',
													INS_NbHeures = '".$_POST["INS_NbHeures"]."',
													INS_RevenuDepuis = '".$_POST["INS_RevenuDepuis"]."',
													INS_SEDepuis = '".$_POST["INS_SEDepuis"]."',
													INS_PEDepuis = '".$_POST["INS_PEDepuis"]."',
													INS_Repas = '".$_POST["INS_Repas"]."',
													INS_TRepas = '".$_POST["INS_TRepas"]."',
													INS_Positionmt = '".$_POST["INS_Positionmt"]."',
													INS_SituGeo = '".$_POST["INS_SituGeo"]."',
													INS_PlusDetails = '".addslashes($_POST["INS_PlusDetails"])."'
												WHERE SAL_NumSalarie = ".$_POST["SAL_NumSalarie"];

									$querying = mysql_query($db, $requete);

									if ($querying){
										if (isset($_POST["INS_UrgNom"]) && isset($_POST["INS_UrgPrenom"]) && isset($_POST["INS_UrgTel"])
											&& !empty($_POST["INS_UrgNom"]) && !empty($_POST["INS_UrgNom"]) && !empty($_POST["INS_UrgNom"]));
									}

									if($querying){
										displaySuccess((($_POST["PER_Sexe"]) ? "M. " : "Mme ").$_POST["PER_Nom"]." ".$_POST["PER_Prenom"]." a bien été enregistré".(($_POST["PER_Sexe"]) ? "" : "(e)")." !");
										mysqli_query($db, 'COMMIT;');
										redirectPage($_POST["SAL_NumSalarie"]);
									}
									else{
										displayError("Une erreur s'est produite pendant l'envoi du formulaire, réessayez 1 !");
										mysqli_query($db, 'ROLLBACK;');
										//redirectPageFormErrors($error_handler, "edit");
									}
								}
								else{
									displayError("Une erreur s'est produite pendant l'envoi du formulaire, réessayez 2 !");
									mysqli_query($db, 'ROLLBACK;');
									//redirectPageFormErrors($error_handler, "edit");
								}
							}
							else{
								displaySuccess((($_POST["PER_Sexe"]) ? "M. " : "Mme ").$_POST["PER_Nom"]." ".$_POST["PER_Prenom"]." a bien été enregistré".(($_POST["PER_Sexe"]) ? "" : "(e)")." !");
								mysqli_query($db, 'COMMIT;');
								redirectPage($_POST["SAL_NumSalarie"]);
							}
						}
						else{
							displayError("Une erreur s'est produite pendant l'envoi du formulaire, réessayez 3 !");
							mysqli_query($db, 'ROLLBACK;');
							//redirectPageFormErrors($error_handler, "edit");
						}
					}
					else{
						displayError("Une erreur s'est produite pendant l'envoi du formulaire, réessayez 4 ! ");
						mysqli_query($db, 'ROLLBACK;');
						//redirectPageFormErrors($error_handler, "edit");
					}
				}
				else{
					displayError("Une erreur s'est produite pendant l'envoi du formulaire, réessayez 5 ! ");
					mysqli_query($db, 'ROLLBACK;');
					//redirectPageFormErrors($error_handler, "edit");
				}
			}
			else{
				displayError("Veuillez remplir correctement tous les champs du formulaire, réessayez 6 !");
				//redirectPageFormErrors($error_handler, "edit");	
			}
        }
        else{
			displayError("Une erreur s'est produite pendant l'envoi du formulaire ! 7 ");
		}

	}

	function addSalarie($db, &$error_handler){
        if(isset($_POST["TYP_Id"]) && !empty($_POST["TYP_Id"])){
			
			$querying = true;
			$verif_infos = verification_civile(($_POST["TYP_Id"] <= 5), $error_handler);

			if($_POST["TYP_Id"] > 5){
				$verif_infos = verification_urgent($error_handler);
				$verif_infos =  verification_pro($error_handler);
			}

			if($verif_infos){
	        	if(mysqli_query($db, 'SET autocommit=0;') && mysqli_query($db, 'START TRANSACTION;')){
	        		if(isset($_POST["new_FCT_Id"])){
	        			$querying = mysqli_query($db, "INSERT INTO fonction VALUES ((SELECT max(FCT_Id)+1 FROM (SELECT * FROM fonction) AS ftable), '".addslashes($_POST["new_FCT_Id"])."');");
	        		}

					if($querying){
						$querying = mysqli_query($db, "INSERT INTO personnes (PER_Nom, PER_Prenom, PER_TelFixe, PER_TelPort, PER_Fax, PER_Email, PER_Adresse, PER_CodePostal, PER_Ville, PER_DateN, PER_LieuN, PER_Nation, PER_NPoleEmp, PER_NSecu, PER_NCaf, PER_Sexe) 
							VALUES ('".addslashes($_POST["PER_Nom"])."', '".addslashes($_POST["PER_Prenom"])."', '".addslashes($_POST["PER_TelFixe"])."', '".addslashes($_POST["PER_TelPort"])."', 
							'".addslashes($_POST["PER_Fax"])."','".addslashes($_POST["PER_Email"])."', '".addslashes($_POST["PER_Adresse"])."', '".$_POST["PER_CodePostal"]."', 
							'".addslashes($_POST["PER_Ville"])."', '".$_POST["PER_DateN"]."', '".addslashes($_POST["PER_LieuN"])."', '".addslashes($_POST["PER_Nation"])."', '".$_POST["PER_NPoleEmp"]."', 
							'".$_POST["PER_NSecu"]."', '".$_POST["PER_NCaf"]."', ".$_POST["PER_Sexe"].");");

						if($querying){
							if($_POST["TYP_Id"] < 5){
								$querying = mysqli_query($db, "INSERT INTO salaries (PER_Num, TYP_Id, SAL_Actif, FCT_Id, SAL_DateSortie)
									VALUES ((SELECT max(PER_Num) FROM personnes), ".$_POST["TYP_Id"].", 1, ".((isset($_POST["new_FCT_Id"])) ? "(SELECT max(FCT_Id) FROM fonction)" : $_POST["FCT_Id"]).", NULL);");
							}
							else{
								$querying = mysqli_query($db, "INSERT INTO salaries (PER_Num, TYP_Id, SAL_Actif, FCT_Id, SAL_DateSortie) VALUES ((SELECT max(PER_Num) FROM personnes), ".$_POST["TYP_Id"].", 1, 0, NULL);");
							}

							if($querying){
								if($_POST["TYP_Id"] > 5){

									if(isset($_POST["new_PRE_Id"])){
										$querying = mysqli_query($db, "INSERT INTO prescripteurs (PRE_Nom) VALUES ('".addslashes($_POST["new_PRE_Id"])."');");
									}

									if(isset($_POST["new_REF_NumRef"])){
										$referentName = explode(" ", $_POST["new_REF_NumRef"]);
										$querying = mysqli_query($db, "INSERT INTO personnes (PER_Nom, PER_Prenom)
											VALUES ('".strtoupper(suppr_carac_spe($referentName[0]))."', '".FirstToUpper(suppr_carac_spe($referentName[1]))."');");

										$querying = mysqli_query($db, "INSERT INTO referents VALUES ((SELECT max(REF_NumRef)+1 FROM (SELECT * FROM referents) AS rtable), (SELECT max(PER_Num) FROM personnes),
										".(isset($_POST["new_PRE_Id"]) ? "(SELECT max(PRE_Id) FROM prescripteurs)" : $_POST["PRE_Id"]).");");
									}

									if($querying){
										$querying = mysqli_query($db, "INSERT INTO insertion (SAL_NumSalarie, INS_DateEntretien, INS_SituationF, INS_NivScol, INS_Diplome, INS_Permis, INS_RecoTH, INS_Revenu, INS_Mutuelle, CNV_Id, CNT_Id, INS_DateEntree, INS_NbHeures, INS_NbJours, INS_RevenuDepuis, INS_SEDepuis, INS_PEDepuis, INS_Repas, INS_TRepas, INS_Positionmt, INS_SituGeo, REF_NumRef, TYS_ID, INS_PlusDetails, INS_UrgNom, INS_UrgPrenom, INS_UrgTel) 
											VALUES ((SELECT max(SAL_NumSalarie) FROM salaries), '".$_POST["INS_DateEntretien"]."', '".addslashes($_POST["INS_SituationF"])."', '".$_POST["INS_NivScol"]."', 
											'".$_POST["INS_Diplome"]."',".(isset($_POST["INS_Permis"]) ? 1 : 0).", ".(isset($_POST["INS_RecoTH"]) ? 1 : 0).", '".$_POST["INS_Revenu"]."', '".$_POST["INS_Mutuelle"]."', 
											".$_POST["CNV_Id"].", ".$_POST["CNT_Id"].", '".$_POST["INS_DateEntree"]."', ".$_POST["INS_NbHeures"].", 0, '".$_POST["INS_RevenuDepuis"]."', '".$_POST["INS_SEDepuis"]."', 
											'".$_POST["INS_PEDepuis"]."', ".$_POST["INS_Repas"].", ".$_POST["INS_TRepas"].", '".$_POST["INS_Positionmt"]."', '".$_POST["INS_SituGeo"]."', 
											".(isset($_POST["new_REF_NumRef"]) ? "(SELECT max(REF_NumRef) FROM referents)" : $_POST["REF_NumRef"]).", 0, '".addslashes($_POST["INS_PlusDetails"])."', 
											'".addslashes($_POST["INS_UrgNom"])."', '".addslashes($_POST["INS_UrgPrenom"])."', '".$_POST["INS_UrgTel"]."');");

										$querying = $querying && mysqli_query($db, "INSERT INTO cursus 
											VALUES ('".$_POST["INS_DateEntree"]."', (SELECT max(SAL_NumSalarie) FROM salaries), ".$_POST["TYP_Id"].",'Entrée dans l\\'association');");

										if($querying){
											displaySuccess((($_POST["PER_Sexe"]) ? "M. " : "Mme ").$_POST["PER_Nom"]." ".$_POST["PER_Prenom"]." a bien été enregistré".(($_POST["PER_Sexe"]) ? "" : "(e)")." !");
											$query = mysqli_query($db, "SELECT max(SAL_NumSalarie) as SalNum FROM salaries;");
											$data = mysqli_fetch_assoc($query);
											mysqli_query($db, 'COMMIT;');
											redirectPage($data["SalNum"]);
										}
										else{
											displayError("Une erreur s'est produite pendant l'envoi du formulaire, réessayez !");
											mysqli_query($db, 'ROLLBACK;');
											redirectPageFormErrors($error_handler, "add");
										}
									}
									else{
										displayError("Une erreur s'est produite pendant l'envoi du formulaire, réessayez !");
										mysqli_query($db, 'ROLLBACK;');
										redirectPageFormErrors($error_handler, "add");
									}
								}
								else{
									displaySuccess((($_POST["PER_Sexe"]) ? "M. " : "Mme ").$_POST["PER_Nom"]." ".$_POST["PER_Prenom"]." a bien été enregistré".(($_POST["PER_Sexe"]) ? "" : "(e)")." !");
									$query = mysqli_query($db, "SELECT max(SAL_NumSalarie) as SalNum FROM salaries;");
									$data = mysqli_fetch_assoc($query);
									mysqli_query($db, 'COMMIT;');
									redirectPage($data["SalNum"]);
								}
							}
							else{
								displayError("Une erreur s'est produite pendant l'envoi du formulaire, réessayez !");
								mysqli_query($db, 'ROLLBACK;');
								redirectPageFormErrors($error_handler, "add");
							}
						}
						else{
							displayError("Une erreur s'est produite pendant l'envoi du formulaire, réessayez !");
							mysqli_query($db, 'ROLLBACK;');
							redirectPageFormErrors($error_handler, "add");
						}
					}
					else{
						displayError("Une erreur s'est produite pendant l'envoi du formulaire, réessayez !");
						mysqli_query($db, 'ROLLBACK;');
						redirectPageFormErrors($error_handler, "add");
					}
		        }
		        else{
					displayError("Une erreur s'est produite pendant l'envoi du formulaire !");
				}
			}
			else{
				displayError("Veuillez remplir correctement tous les champs du formulaire, réessayez !");
				redirectPageFormErrors($error_handler, "add");	
			}
        }
        else{
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
						displayError("Une erreur s'est produite pendant la sauvegarde du cursus !");
					}
				}
				else{
					displayError("Une erreur s'est produite pendant la sauvegarde du cursus !");
				}
			}
			else{
				displayError("Le type de contrat est invalide !");
			}
		}
		else{
			displayError("Une erreur s'est produite pendant l'envoi du formulaire !");
		}

		redirectPage($_POST['SAL_NumSalarie']);
	}

	function verification_civile($specialSalarie, &$error_handler){
		$fieldOk = isset($_POST["PER_Nom"]) && !empty($_POST["PER_Nom"])
			&& isset($_POST["PER_Prenom"]) && !empty($_POST["PER_Prenom"])
			&& isset($_POST["PER_Sexe"]) && !empty($_POST["PER_Sexe"])
			&& isset($_POST["PER_DateN"]) && !empty($_POST["PER_DateN"])
			&& isset($_POST["PER_LieuN"]) && !empty($_POST["PER_LieuN"])
			&& isset($_POST["PER_Nation"]) && !empty($_POST["PER_Nation"])
			&& isset($_POST["PER_NSecu"]) && !empty($_POST["PER_NSecu"])
			&& isset($_POST["PER_Adresse"]) && isset($_POST["PER_Ville"])
			&& isset($_POST["PER_CodePostal"]) && isset($_POST["PER_NCaf"])
			&& isset($_POST["PER_NPoleEmp"]) && isset($_POST["PER_TelFixe"])
			&& isset($_POST["PER_TelPort"]) && isset($_POST["PER_Fax"])
			&& isset($_POST["PER_Email"]);

		if($specialSalarie){
			if((isset($_POST["FCT_Id"]) && !empty($_POST["FCT_Id"]) && !isset($_POST["new_FCT_Id"])) || ((isset($_POST["new_FCT_Id"]) && !empty($_POST["new_FCT_Id"])))){
				if(isset($_POST["new_FCT_Id"]) && !empty($_POST["new_FCT_Id"])){
					if(!empty($_POST["new_FCT_Id"])){
						$_POST["new_FCT_Id"] = FirstToUpper(suppr_carac_spe($_POST["new_FCT_Id"]));
					}
					else{
						$fieldOk = false;
						$error_handler .= "new_FCT_Id|La nouvelle fonction n'est pas conforme;";
					}
				}
			}
			else{
				$fieldOk = false;
				$error_handler .= "FCT_Id|La fonction n'est pas conforme;";
			}
		}

		$_POST["PER_Nom"] = strtoupper(suppr_carac_spe($_POST["PER_Nom"]));
		$_POST["PER_Prenom"] = FirstToUpper(suppr_carac_spe($_POST["PER_Prenom"]));
		$_POST["PER_LieuN"] = strtoupper(suppr_carac_spe($_POST["PER_LieuN"]));
		$_POST["PER_Nation"] = strtoupper(suppr_carac_spe($_POST["PER_Nation"]));
		$_POST["PER_NSecu"] = str_replace(array(" ", ".", "-"), "",$_POST["PER_NSecu"]);
		$_POST["PER_Adresse"] = (!empty($_POST["PER_Adresse"])) ? FirstToUpper(suppr_carac_spe($_POST["PER_Adresse"])) : null;
		$_POST["PER_Ville"] = (!empty($_POST["PER_Ville"])) ? strtoupper(suppr_carac_spe($_POST["PER_Ville"])) : null;
		$_POST["PER_NCaf"] = (!empty($_POST["PER_NCaf"])) ? str_replace(array(" ", ".", "-"), "",$_POST["PER_NSecu"]) : null;
		$_POST["PER_NPoleEmp"] = (!empty($_POST["PER_NPoleEmp"])) ? str_replace(array(" ", ".", "-"), "",$_POST["PER_NPoleEmp"]) : null;

		if(!empty($_POST["PER_CodePostal"])){
			if(isPostalCode($_POST["PER_CodePostal"])){
				$_POST["PER_CodePostal"] = str_replace(array(" ", ".", "-"), "", $_POST["PER_CodePostal"]);
			}
			else{
				$error_handler .= "PER_CodePostal|Le code postal n'est pas conforme;";
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
				$error_handler .= "PER_TelFixe|Le numéro de téléphone fixe n'est pas conforme;";
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
				$error_handler .= "PER_TelPort|Le numéro de téléphone portable n'est pas conforme;";
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
				$error_handler .= "PER_Fax|Le numéro de fax n'est pas conforme;";
				$fieldOk = false;
			}
		}
		else{
			$_POST["PER_Fax"] = null;
		}

		if(!empty($_POST["PER_Email"])){
			if(!isEmail($_POST["PER_Email"])){
				$error_handler .= "PER_Email|L'email n'est pas conforme (adresse@site.extension);";
				$fieldOk = false;
			}
		}
		else{
			$_POST["PER_Email"] = null;
		}

		return $fieldOk;
	}

	function verification_urgent(&$error_handler){
		$fieldOk = isset($_POST["INS_UrgNom"]) && isset($_POST["INS_UrgPrenom"]) && isset($_POST["INS_UrgTel"]);

		if(!empty($_POST["INS_UrgNom"])){
			$_POST["INS_UrgNom"] = strtoupper(suppr_carac_spe($_POST["INS_UrgNom"]));
		}

		if(!empty($_POST["INS_UrgPrenom"])){
			$_POST["INS_UrgPrenom"] = FirstToUpper(suppr_carac_spe($_POST["INS_UrgPrenom"]));
		}

		if(!empty($_POST["INS_UrgTel"])){
			if(isPhoneNumber($_POST["INS_UrgTel"])){
				$_POST["INS_UrgTel"] = str_replace(array(" ", ".", "-"), "",$_POST["INS_UrgTel"]);
			}
			else{
				$error_handler .= "INS_UrgTel|Le téléphone du contact d'urgence n'est pas conforme;";
				$fieldOk = false;
			}
		}
		return $fieldOk;
	}

	function verification_pro(&$error_handler){
		$fieldOk = isset($_POST["INS_DateEntretien"]) && !empty($_POST["INS_DateEntretien"]) 
			&& isset($_POST["INS_DateEntree"]) && !empty($_POST["INS_DateEntree"])
			&& isset($_POST["INS_Repas"]) && !empty($_POST["INS_Repas"])
			&& isset($_POST["INS_TRepas"]) && !empty($_POST["INS_TRepas"])
			&& isset($_POST["INS_PlusDetails"]) && isset($_POST["INS_NbHeures"]) && isset($_POST["INS_SituationF"]);

		if(!isset($_POST["INS_NivScol"])){
			$error_handler .= "INS_NivScol|Le niveau scolaire n'est pas conforme;";
			$fieldOk = false;
		}
		if(!isset($_POST["INS_Diplome"])){
			$error_handler .= "INS_Diplome|Le diplôme n'est pas conforme;";
			$fieldOk = false;
		}
		if(!isset($_POST["INS_Revenu"])){
			$error_handler .= "INS_Revenu|Le revenu n'est pas conforme;";
			$fieldOk = false;
		}
		if(!isset($_POST["INS_RevenuDepuis"])){
			$error_handler .= "INS_RevenuDepuis|Le temps écoulé depuis le dernier revenu n'est pas conforme;";
			$fieldOk = false;
		}
		if(!isset($_POST["INS_PEDepuis"])){
			$error_handler .= "INS_PEDepuis|Le temps écoulé depuis l'inscription à Pôle Emploi n'est pas conforme;";
			$fieldOk = false;
		}
		if(!isset($_POST["INS_SEDepuis"])){
			$error_handler .= "INS_SEDepuis|Le temps écoulé depuis la perte d'emploi n'est pas conforme;";
			$fieldOk = false;
		}
		if(!isset($_POST["INS_Positionmt"])){
			$error_handler .= "INS_Positionmt|La position CAP n'est pas conforme;";
			$fieldOk = false;
		}
		if(!isset($_POST["INS_Mutuelle"])){
			$error_handler .= "INS_Mutuelle|La mutuelle n'est pas conforme;";
			$fieldOk = false;
		}
		if(!isset($_POST["INS_SituGeo"])){
			$error_handler .= "INS_SituGeo|La situation géographique n'est pas conforme;";
			$fieldOk = false;
		}
		if(!isset($_POST["CNV_Id"])){
			$error_handler .= "CNV_Id|La convention n'est pas conforme;";
			$fieldOk = false;
		}
		if(!isset($_POST["CNT_Id"])){
			$error_handler .= "CNT_Id|Le contrat n'est pas conforme;";
			$fieldOk = false;
		}

		if((isset($_POST["REF_NumRef"]) && !empty($_POST["REF_NumRef"]) && !isset($_POST["new_REF_NumRef"])) || ((isset($_POST["new_REF_NumRef"]) && !empty($_POST["new_REF_NumRef"])))){
			if(isset($_POST["new_REF_NumRef"])){
				if(!empty($_POST["new_REF_NumRef"])){
					$_POST["new_REF_NumRef"] = FirstToUpper(suppr_carac_spe($_POST["new_REF_NumRef"]));
				}
				else{
					$fieldOk = false;
					$error_handler .= "new_REF_NumRef|Le nouveau référent n'est pas conforme;";
				}
			}
		}
		else{
			$fieldOk = false;
			$error_handler .= "REF_NumRef|La référent n'est pas conforme;";
		}

		if((isset($_POST["PRE_Id"]) && !empty($_POST["PRE_Id"]) && !isset($_POST["new_PRE_Id"])) || ((isset($_POST["new_PRE_Id"]) && !empty($_POST["new_PRE_Id"])))){
			if(isset($_POST["new_PRE_Id"]) && !empty($_POST["new_PRE_Id"])){
				if(!empty($_POST["new_PRE_Id"])){
					$_POST["new_PRE_Id"] = FirstToUpper(suppr_carac_spe($_POST["new_PRE_Id"]));
				}
				else{
					$fieldOk = false;
					$error_handler .= "new_PRE_Id|Le nouveau prescripteur n'est pas conforme;";
				}
			}
		}
		else{
			$fieldOk = false;
			$error_handler .= "PRE_Id|La prescripteur n'est pas conforme;";
		}

		$_POST["INS_NbHeures"] = (!empty($_POST["INS_NbHeures"])) ? $_POST["INS_NbHeures"] : 0;
		$_POST["INS_SituationF"] = (!empty($_POST["INS_SituationF"])) ? $_POST["INS_SituationF"] : null;

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

	function redirectPage($SalNum){
	    echo '<script type="text/javascript">
    			setTimeout(function(){
                    $.redirect("./showSalarie.php", {"SalNum": '.$SalNum.'}, "get");
                }, 2500);
			</script>';
	}

	function redirectPageFormErrors(&$error_handler, $type){
		echo '<form action="editSalarie.php" method="POST" id="tempForm">';
		foreach ($_POST as $key => $value) {
			echo '<input type="hidden" name="'.htmlentities($key).'" value="'.htmlentities($value).'">';
		}
	    echo '<input type="hidden" name="Post_Errors" value="'.$error_handler.'">
	    	<input type="hidden" name="Head_Title" value="Ajout d\'un salarié">
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