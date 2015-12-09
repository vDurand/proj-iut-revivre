﻿<?php
	$pageTitle = "Envoi des propriétés prescripteurs";
	$pwd='../';
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
					$tableau[$x][1]=preg_replace("/[\"@;]/","",$tableau[$x][1]);
                    if($tableau[$x][3]==1)
                    {
                        $query = mysqli_query($db, "INSERT INTO prescripteurs(PRE_ID, PRE_Nom) VALUES (".($tableau[$x][0]).",'".($tableau[$x][2]).");");
                        if(!$query)
                        {
                            $erreur = true;
                        }
                    }
                    else if($tableau[$x][3]==0)
                    {
                        $query = mysqli_query($db, "UPDATE typesortie SET TYS_Libelle='".addslashes($tableau[$x][1])."', TYS_Numero=".($tableau[$x][2])." WHERE TYS_ID=".($tableau[$x][0]).";");
                        if(!$query)
                        {
							echo "<PRE>";
							$v=$tableau[$x][0];
							$w=$tableau[$x][1];
							echo "$v, $w";
							echo "</PRE>";
                            $erreur = true;
                        }
                    }
                    else
                    {
                        $erreur = true;
                    }
                }
                
                if($erreur)
                {
                    mysqli_query($db, 'ROLLBACK;');
                    echo '<div id="bad">
                      <label>Une erreur s\'est produite lors de la sauvegarde des prescripteurs ! </label>
                      </div>';
                }
                else
                {
                    mysqli_query($db, 'COMMIT;');
                    echo '<div id="good">
                        <label>La sauvegarde des prescripteurs s\'est déroulée avec succès !</label>
                        </div>';
                }
            }
            elseif($typeAction == "delete")
            {
                $query = mysqli_query($db, "DELETE FROM typesortie WHERE TYS_ID=".($tableau[0]).";");
                if(!$query)
                {
                    mysqli_query($db, 'ROLLBACK;');
					mysqli_query($db, 'ROLLBACK;');
					echo "<div id=\"bad\">
						<label>Le prescripteur ".$tableau[1]." n'a pas pu être supprimé.</label>
						</div>";
                }
                else
                {
                    mysqli_query($db, 'COMMIT;');
                    echo '<div id="good">
                      <label>Le prescripteur '.$tableau[1].' a été supprimé avec succès !</label>
                      </div>';
                }
            }
            else
            {
                echo '<div id="bad">
                  <label>Une erreur s\'est produite lors de la sauvegarde des prescripteurs !</label>
                  </div>';
            }
        }
        else
        {
            echo '<div id="bad">
                <label>Une erreur s\'est produite lors de la sauvegarde des prescripteurs !</label>
                </div>';
        }

    }
    else
    {
        echo '<div id="bad">
            <label>Une erreur s\'est produite lors de la sauvegarde des prescripteurs !</label>
            </div>';
    }

	if(isset($_POST['redirectPage']))
	{
		$locationPath = $_POST['redirectPage'];
	    echo '<script type="text/javascript">
		window.setTimeout("location=(\''.$locationPath.'\');",2500);
		</script>';
	}
	else
	{
		echo '<script type="text/javascript">
		window.setTimeout("location=(\''.$pwd.'home.php\');",2500);
		</script>';
	}
?>
</div>
<?php
  	include($pwd.'footer.php');
?>