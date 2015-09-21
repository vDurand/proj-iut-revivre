<?php
	$pageTitle = "Envoi des propriétés des conventions";
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
                    if($tableau[$x][3]==1)
                    {
                        $query = mysqli_query($db, "INSERT INTO convention(CNV_Id, CNV_Nom, CNV_Couleur) VALUES (".($tableau[$x][0]).",upper('".addslashes($tableau[$x][1])."'),'".$tableau[$x][2]."');");
                        if(!$query)
                        {
                            $erreur = true;
                        }
                    }
                    else if($tableau[$x][3]==0)
                    {
                        $query = mysqli_query($db, "UPDATE convention SET CNV_Nom=upper('".addslashes($tableau[$x][1])."'), CNV_Couleur='".$tableau[$x][2]."' WHERE CNV_ID='".($tableau[$x][0])."';");
                        if(!$query)
                        {
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
                      <label>Une erreur s\'est produite lors de la sauvegarde des conventions !</label>
                      </div>';
                }
                else
                {
                    mysqli_query($db, 'COMMIT;');
                    echo '<div id="good">
                        <label>La sauvegarde des conventions s\'est déroulée avec succès !</label>
                        </div>';
                }
            }
            elseif($typeAction == "delete")
            {
                $query = mysqli_query($db, "DELETE FROM convention WHERE CNV_Id=".($tableau[0]).";");
                if(!$query)
                {
                    mysqli_query($db, 'ROLLBACK;');
                    echo "<div id=\"bad\">
                        <label>La convention ".$tableau[1]." ne peut pas être suprimée, des salariés y sont associés</label>
                        </div>";
                }
                else
                {
                    mysqli_query($db, 'COMMIT;');
                    echo '<div id="good">
                      <label>La convention '.$tableau[1].' a été supprimée avec succès !</label>
                      </div>';
                }
            }
            else
            {
                echo '<div id="bad">
                  <label>Une erreur s\'est produite lors de la sauvegarde des conventions !</label>
                  </div>';
            }
        }
        else
        {
            echo '<div id="bad">
              <label>Une erreur s\'est produite lors de la sauvegarde des conventions !</label>
              </div>';
        }

    }
    else
    {
        echo '<div id="bad">
          <label>Une erreur s\'est produite lors de la sauvegarde des conventions !</label>
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