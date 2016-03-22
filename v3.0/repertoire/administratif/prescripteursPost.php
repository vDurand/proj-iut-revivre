<?php
	$pageTitle = "Envoi des propriétés prescripteurs";
	$pwd='../../';
	include($pwd.'bandeau.php');
?>
<div id="corps">
<?php
    if(isset($_POST['Tableau']) && isset($_POST['typeAction']))
    {
        $query =  mysqli_query($db, "SELECT count(*)+1 as dernier from prescripteurs");
        $dernierNum = mysqli_fetch_assoc($query);
        if (!$query)
        {
            echo "ERREUR DE NUMERO";
        }
        else
        {
            $pre_num = $dernierNum['dernier'];
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
                        if($tableau[$x][2]==1)
                        {
                            $query = mysqli_query($db, "INSERT INTO prescripteurs(PRE_ID, PRE_Nom) VALUES (".($tableau[$x][0]).",'".($tableau[$x][1])."');");
                            if(!$query)
                            {
                                echo ("erreur 1");
                                echo "<PRE>";
                                $v=$tableau[$x][0];
                                $w=$tableau[$x][1];
                                echo "$v, $w";
                                echo "</PRE>";
                                $erreur = true;
                            }
                        }
                        else if($tableau[$x][2]==0)
                        {
                            $query = mysqli_query($db, "UPDATE prescripteurs SET PRE_NOM ='".addslashes($tableau[$x][1])."' WHERE PRE_ID=".($tableau[$x][0]).";");
                            if(!$query)
                            {
                                echo ("erreur 2");
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
                          <label>1 : Une erreur s\'est produite lors de la sauvegarde des prescripteurs ! </label>
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
                    $query = mysqli_query($db, "DELETE FROM prescripteurs WHERE PRE_Id=".($tableau[0]).";");
                    if(!$query)
                    {
                        mysqli_query($db, 'ROLLBACK;');
    					mysqli_query($db, 'ROLLBACK;');
    					echo "<div id=\"bad\">
    						<label>2 : Le prescripteur ".$tableau[1]." n'a pas pu être supprimé.</label>
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
                      <label>3: Une erreur s\'est produite lors de la sauvegarde des prescripteurs !</label>
                      </div>';
                }
            }
            else
            {
                echo '<div id="bad">
                    <label>4 : Une erreur s\'est produite lors de la sauvegarde des prescripteurs !</label>
                    </div>';
            }
        }

    }
    else
    {
        echo '<div id="bad">
            <label>5 : Une erreur s\'est produite lors de la sauvegarde des prescripteurs !</label>
            </div>';
    }

	if(isset($_POST['redirectPage']))
	{
	   $locationPath = $_POST['redirectPage'];
	   echo '<script type="text/javascript">
	   window.setTimeout("location=(\''.$locationPath.'\');",2500);
	   </script>';
	}
	else{
	   echo '<script type="text/javascript">
	   window.setTimeout("location=(\''.$pwd.'home.php\');",2500);
	   </script>';
	}
?>
</div>
<?php
  	include($pwd.'footer.php');
?>