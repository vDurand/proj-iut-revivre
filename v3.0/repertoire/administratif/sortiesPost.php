<?php
	$pageTitle = "Envoi des propriétés des types de sortie";
	$pwd='../../';
	include($pwd.'bandeau.php');
?>
<div id="corps">
<?php
    if(isset($_POST['Tableau']) && isset($_POST['typeAction']))
    {
        $typeAction = $_POST['typeAction'];
        $tableau = json_decode($_POST["Tableau"]);
        if(mysqli_query($db, 'SET autocommit=0;') && mysqli_query($db, 'START TRANSACTION;'))
        {
            if($typeAction == "edit")
            {
                $erreur = false;	
                for($x=0; $x<sizeof($tableau); $x++)
                {
					$tableau[$x][1] = preg_replace("/[\"@;]/","",$tableau[$x][1]);
                    $query = mysqli_query($db, "SELECT TYS_ID FROM typesortie WHERE TYS_Active = 0  AND TYS_Libelle = '".addslashes($tableau[$x][1])."';");
                    if(mysqli_num_rows($query) == 1){
                        $query = mysqli_query($db, "UPDATE typesortie SET TYS_Active = 1, TYS_Numero = ".($tableau[$x][2])." WHERE TYS_Libelle = '".addslashes($tableau[$x][1])."';");
                        if(!$query)
                        {
                            $erreur = true;
                            break;
                        }
                    }
                    elseif($tableau[$x][3]==1)
                    {
                        $query = mysqli_query($db, "INSERT INTO typesortie(TYS_ID, TYS_Libelle, TYS_Numero) VALUES (".($tableau[$x][0]).",'".addslashes($tableau[$x][1])."',".($tableau[$x][2]).");");
                        if(!$query)
                        {
                            $erreur = true;
                            break;
                        }
                    }
                    else if($tableau[$x][3]==0){
                        $query = mysqli_query($db, "UPDATE typesortie SET TYS_Libelle='".addslashes($tableau[$x][1])."', TYS_Numero=".($tableau[$x][2])." WHERE TYS_ID = ".($tableau[$x][0]).";");
                        if(!$query)
                        {
                            $erreur = true;
                            break;
                        }
                    }
                    else
                    {
                        $erreur = true;
                        break;
                    }
                }
                
                if($erreur)
                {
                    mysqli_query($db, 'ROLLBACK;');
                    echo '<div id="bad">
                      <label>Une erreur s\'est produite lors de la sauvegarde des types de sortie !</label>
                      </div>';
                }
                else
                {
                    mysqli_query($db, 'COMMIT;');
                    echo '<div id="good">
                        <label>La sauvegarde des types de sortie s\'est déroulée avec succès !</label>
                        </div>';
                }
            }
            elseif($typeAction == "delete")
            {
                $query = mysqli_query($db, "DELETE FROM typesortie WHERE TYS_ID=".($tableau[0]).";");
                if(!$query)
                {
                    mysqli_query($db, 'ROLLBACK;');
                    $query = mysqli_query($db, "UPDATE typesortie SET TYS_Active=false WHERE TYS_ID=".($tableau[0]).";");
					if(!$query)
					{
						mysqli_query($db, 'ROLLBACK;');
						echo "<div id=\"bad\">
							<label>Le type de sortie n'a pas pu être désactivé.</label>
							</div>";
					}
					else
					{
						mysqli_query($db, 'COMMIT;');
						echo '<div id="good">
						<label>Le type de sortie ne peut pas être supprimé, il va être désactivé !</label>
						</div>';
					}
                }
                else
                {
                    mysqli_query($db, 'COMMIT;');
                    echo '<div id="good">
                      <label>Le type de sortie a été supprimé avec succès !</label>
                      </div>';
                }
            }
            elseif($typeAction == "réactiver")
			{
				$query = mysqli_query($db, "UPDATE typesortie SET TYS_Active=true WHERE TYS_ID=".($tableau[0]).";");
                if(!$query)
                {
                    mysqli_query($db, 'ROLLBACK;');
                    echo "<div id=\"bad\">
                        <label>Le type de sortie n'a pas pu être réactivé.</label>
                        </div>";
                }
                else
                {
                    mysqli_query($db, 'COMMIT;');
                    echo '<div id="good">
                      <label>Le type de sortie a été réactivé avec succès !</label>
                      </div>';
                }
			}
            else
            {
                echo '<div id="bad">
                  <label>Une erreur s\'est produite lors de la sauvegarde des types de sortie !</label>
                  </div>';
            }
        }
        else
        {
            echo '<div id="bad">
              <label>Une erreur s\'est produite lors de la sauvegarde des types de sortie !</label>
              </div>';
        }

    }
    else
    {
        echo '<div id="bad">
          <label>Une erreur s\'est produite lors de la sauvegarde des types de sortie !</label>
          </div>';
    }

	if(isset($_POST['redirectPage']))
	{
		$locationPath = $_POST['redirectPage'];
	    echo '<script type="text/javascript">
		window.setTimeout("location=(\''.$locationPath.'\');",3000);
		</script>';
	}
	else
	{
		echo '<script type="text/javascript">
		window.setTimeout("location=(\''.$pwd.'home.php\');",3000);
		</script>';
	}
?>
</div>
<?php
  	include($pwd.'footer.php');
?>