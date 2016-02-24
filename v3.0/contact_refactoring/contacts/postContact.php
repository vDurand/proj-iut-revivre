<?php
	$pageTitle = "Ajout d'un contact";
	$pwd='../../';
	include($pwd.'bandeau.php');
?>
<div id="corps">
<?php

	if(isset($_POST["Num_form"]) && !empty($_POST["Num_form"])){
		switch($_POST["Num_form"]){

			case 1: // ajout d'un fournisseur
				ajoutFournisseur($db);
				break;

			case 2: // ajout d'un client
				ajoutClient($db);
				break;

      default:
        echo '<div id="bad"> 
              <label>Une erreur s\'est produite lors de l\'envoi du formulaire !</label>
              </div>'; 
        break;		
		}
	}
?>
</div>
<?php
  	include($pwd.'footer.php');

  	function ajoutFournisseur($db){

  		if(isset($_POST["FOU_Nom"]) && isset($_POST["FOU_Adresse"]) && isset($_POST["FOU_TelFixe"]) && isset($_POST["FOU_CodePostal"]) && isset($_POST["FOU_TelPort"]) && isset($_POST["FOU_Ville"]) && 
  			isset($_POST["FOU_Fax"]) && isset($_POST["FOU_Mail"])){

            // met au bon format pour le nom et la ville
            $nom = suppr_lig_nom($_POST["FOU_Nom"]);
            $ville = suppr_lig_nom($_POST["FOU_Ville"]);

            $nom = suppr_carac_spe($_POST["FOU_Nom"]);
            $ville = suppr_carac_spe($_POST["FOU_Ville"]);



            if(Test_ponctuation_Nom($_POST["FOU_Nom"]) == 1){
                echo '<div id="bad"> 
                      <label>Le nom du fournisseur contient des caractères non autorisé</label>
                      </div>';  
            }
            else{
                if(Test_nombre($_POST["FOU_Nom"]) == 1){
                    echo '<div id="bad"> 
                          <label>Le nom du fournisseur contient des nombres</label>
                          </div>'; 
                }
                else{
                    if(Test_ponctuation_Nom($_POST["FOU_Ville"]) == 1){
                        echo '<div id="bad"> 
                              <label>La ville du fournisseur contient des caractères non autorisé</label>
                              </div>';  
                    }
                    else{
                        if(Test_nombre($_POST["FOU_Ville"]) == 1){
                            echo '<div id="bad"> 
                                  <label>La ville du fournisseur contient des nombres</label>
                                  </div>'; 
                        }
                        else{

                            $nom = strtoupper($nom);
                            $ville = strtoupper($ville);

                            $query = mysqli_query($db,"INSERT INTO fournisseurs (FOU_Nom, FOU_Adresse, FOU_CodePostal, FOU_Ville, FOU_Telephone, FOU_Portable, FOU_Fax, FOU_Email) 
                                VALUES ('".$nom."',
                                '".$_POST['FOU_Adresse']."',
                                ".$_POST['FOU_CodePostal'].",
                                '".$ville."',
                                '".$_POST['FOU_TelFixe']."',
                                '".$_POST['FOU_TelPort']."',
                                '".$_POST['FOU_Fax']."',
                                '".$_POST['FOU_Mail']."');") ;

                            if(!$query){
                                displayError("fournisseur");
                                echo mysqli_error($db);
                                mysqli_query($db, 'ROLLBACK;');
                            }
                            else{
                                displaySuccess("fournisseur");
                                mysqli_query($db, 'COMMIT;');
                            }
                        }
                    }
                }
            }
  		}
  		else{
  			displayError("fournisseur");
  		}
  	}

  	function ajoutClient($db){

  		if(isset($_POST["CLI_Nom"]) && isset($_POST["CLI_Adresse"]) && isset($_POST["CLI_TelFixe"]) && isset($_POST["CLI_CodePostal"]) && isset($_POST["CLI_TelPort"]) && isset($_POST["CLI_Ville"]) && 
  			isset($_POST["CLI_Fax"]) && isset($_POST["CLI_Mail"])){

             // met au bon format pour le nom et la ville
            $nom = suppr_lig_nom($_POST["CLI_Nom"]);
            $ville = suppr_lig_nom($_POST["CLI_Ville"]);

            $nom = suppr_carac_spe($_POST["CLI_Nom"]);
            $ville = suppr_carac_spe($_POST["CLI_Ville"]);

            if(Test_ponctuation_Nom($_POST["CLI_Nom"]) == 1){
                echo '<div id="bad"> 
                      <label>Le nom du client contient des caractères non autorisé</label>
                      </div>';  
            }
            else{
                if(Test_nombre($_POST["CLI_Nom"]) == 1){
                    echo '<div id="bad"> 
                          <label>Le nom du client contient des nombres</label>
                          </div>'; 
                }
                else{
                    if(Test_ponctuation_Nom($_POST["CLI_Ville"]) == 1){
                        echo '<div id="bad"> 
                              <label>La ville du client contient des caractères non autorisé</label>
                              </div>';  
                    }
                    else{
                        if(Test_nombre($_POST["CLI_Ville"]) == 1){
                            echo '<div id="bad"> 
                                  <label>La ville du client contient des nombres</label>
                                  </div>'; 
                        }
                        else{

                            $nom = strtoupper($nom);
                            $ville = strtoupper($ville);

                  			if(isset($_POST["CLI_Prenom"]) && !empty($_POST["CLI_Prenom"])){ // cas particulier

                                //mettre caps au debut pour les prenoms
                                if(Test_ponctuation_Nom($_POST["CLI_Prenom"]) == 1){
                                    echo '<div id="bad"> 
                                          <label>Le prenom du client contient des caractères non autorisé</label>
                                          </div>';  
                                }
                                else{
                                    if(Test_nombre($_POST["CLI_Prenom"]) == 1){
                                        echo '<div id="bad"> 
                                              <label>Le prenom du client contient des nombres</label>
                                              </div>'; 
                                    }
                                    else{
                                        $prenom = ucwords($_POST["CLI_Prenom"]);

                          				$query = mysqli_query($db,"INSERT INTO clients (CLI_Nom, CLI_Prenom, CLI_Adresse, CLI_CodePostal, CLI_Ville, CLI_Telephone, CLI_Portable, CLI_Fax, CLI_Email) VALUES ('".$nom."','".$_POST["CLI_Prenom"]."','".$_POST["CLI_Adresse"]."',".$_POST["CLI_CodePostal"].",'".$ville."','".$_POST["CLI_TelFixe"]."','".$_POST["CLI_TelPort"]."','".$_POST["CLI_Fax"]."','".$_POST["CLI_Mail"]."')") ;

                        	  			if(!$query){
                        					displayError("client");
                        					mysqli_query($db, 'ROLLBACK;');
                        	  			}
                        				else{
                        					displaySuccess("client");
                        					mysqli_query($db, 'COMMIT;');
                        				}
                          			}
                                }
                            }
                            else{ // cas structure
                                $query = mysqli_query($db,"INSERT INTO clients (CLI_Nom, CLI_Adresse, CLI_CodePostal, CLI_Ville, CLI_Telephone, CLI_Portable, CLI_Fax, CLI_Email) VALUES ('".$_POST["CLI_Nom"]."','".$_POST["CLI_Adresse"]."',".$_POST["CLI_CodePostal"].",'".$_POST["CLI_Ville"]."','".$_POST["CLI_TelFixe"]."','".$_POST["CLI_TelPort"]."','".$_POST["CLI_Fax"]."','".$_POST["CLI_Mail"]."')") ;

                                if(!$query){
                                    displayError("client");
                                    mysqli_query($db, 'ROLLBACK;');
                                }
                                else{
                                    displaySuccess("client");
                                    mysqli_query($db, 'COMMIT;');
                                }
                            }
                        }  
                    }
                }
            }
  		}
  		else{
  			displayError("client");
  		}
  	}

  	function displayError($txt){
  		echo '<div id="bad"> 
              <label>Une erreur s\'est produite lors de l\'ajout d\'un '.$txt.' !</label>
              </div>';        
  	}

  	function displaySuccess($txt){
        echo '<div id="good">
	        <label> Le '.$txt.' a été sauvegardé avec succès !</label>
	        </div>';	    
  	}
?>