<?php
	$pageTitle = "Envoi des propriétés logos";
	$pwd='../../';
	include($pwd.'bandeau.php');
?>
<div id="corps">
    <?php
        if(isset($_POST['Tableau']) && isset($_POST['typeAction']) && !empty($_POST['typeAction']))
        {
            $typeAction = $_POST['typeAction'];
            $tableau = json_decode($_POST["Tableau"]);
            switch($typeAction)
            {
                case "add":
                    if(uploadLogo($tableau))
                    {
                        if(!addData(getFinalUrl($tableau), $tableau, $db))
                        {
                            unlink(getFinalUrl($tableau));
                        }
                    }
                    break;
                
                case "edit":
                    if($tableau[3])
                    {
                        if(uploadLogo($tableau))
                        {
                            editData(getFinalUrl($tableau),$tableau, $db);
                        }
                    }
                    else
                    {
                        editData($tableau[1],$tableau,$db);
                    }
                    break;
                
                case "delete":
                    deleteData($db);
                    break;
                
                default:
                    echo '<div id="bad">
                    <label>Une erreur s\'est produite lors de la sauvegarde du logo !</label>
                    </div>';
                    break;
            }
            
            if(file_exists($pwd.'images/logo_upload/'.strtolower(addslashes(preg_replace('/-|\s|\/|\.|\'|/i','',wd_remove_accents($tableau[0])))).strrchr($_FILES['fileInput']['name'], '.')))
            {
                unlink($pwd.'images/logo_upload/'.strtolower(addslashes(preg_replace('/-|\s|\/|\.|\'|/i','',wd_remove_accents($tableau[0])))).strrchr($_FILES['fileInput']['name'], '.'));
            }
        }
        else
        {
            echo '<div id="bad">
            <label>Une erreur s\'est produite lors de la sauvegarde du logo !</label>
            </div>';  
        }

		echo '<script type="text/javascript">
		window.setTimeout("location=(\'./logoProperties.php\');",2500);
		</script>';

        function uploadLogo($tableau)
        {
            if(isset($_FILES['fileInput']) && filesize($_FILES['fileInput']['tmp_name']) > 0)
            {
                
                if(isset($tableau[3]) && $tableau[3] && file_exists($tableau[1]))
                {
                    unlink($tableau[1]);
                }
                $taille_maxi = 150000;
                $taille = filesize($_FILES['fileInput']['tmp_name']);
                
                $extensions = array('.png','.jpg', '.jpeg');
                $extension = strrchr($_FILES['fileInput']['name'], '.');


                if(in_array($extension, $extensions)) 
                {
                    if($taille<=$taille_maxi)
                    {
                        if(move_uploaded_file($_FILES['fileInput']['tmp_name'], getFinalUrl($tableau)))
                        {
                            return true;
                        }
                        else
                        {
                            echo '<div id="bad">
                                <label>Une erreur s\'est produite lors de l\'envoi du fichier logo !</label>
                                </div>';
                        }
                    }
                    else
                    {
                        echo '<div id="bad">
                            <label>Une erreur s\'est produite lors de l\'envoi du logo ! La taille du fichier dépasse 150ko</label>
                            </div>';
                    }   
                }
                else
                {
                    echo '<div id="bad">
                        <label>Une erreur s\'est produite lors de l\'envoi du logo ! L\'extension est incorrecte !</label>
                        </div>';
                }
            }
            else
            {
                echo '<div id="bad">
                <label>Une erreur s\'est produite lors de l\'envoi du logo !</label>
                </div>';
            }
            return false;

        }

        function addData($urlToChange, $tableau, $db)
        {
            $query = mysqli_query($db, 'INSERT INTO logo(LOGO_Libelle, LOGO_Url) VALUES ("'.preg_replace('/\'/i',' ',$tableau[0]).'","'.$urlToChange.'");');
            if($query)
            {
                echo '<div id="good">
                    <label>Le logo a été sauvegardé avec succès !</label>
                    </div>';
                return true;
            }
            else
            {
                echo '<div id="bad">
                    <label>Une erreur s\'est produite lors de la sauvegarde du logo !</label>
                    </div>';
                return false;
            }
        }

        function editData($urlToChange, $tableau, $db)
        {
            $query = mysqli_query($db, 'UPDATE logo SET LOGO_Libelle = "'.preg_replace('/\'/i',' ',$tableau[0]).'", LOGO_Url = "'.$urlToChange.'" WHERE LOGO_Id = '.$tableau[2].';');
            if($query)
            {
                echo '<div id="good">
                    <label>Le logo a été modifié avec succès !</label>
                    </div>';
            }
            else
            {
                echo '<div id="bad">
                    <label>Une erreur s\'est produite lors de la modification du logo !</label>
                    </div>';
            }
        }

        function deleteData($db)
        {
            if(isset($_POST["idLogo"]) && !empty($_POST["idLogo"]))
            {
                $idLogo = $_POST["idLogo"];
                $lienLogo = mysqli_fetch_assoc(mysqli_query($db, 'SELECT LOGO_Url FROM logo WHERE LOGO_Id = '.$idLogo.';'));
                $query = mysqli_query($db, 'DELETE FROM logo WHERE LOGO_Id = '.$idLogo.';');
                if($query)
                {
                    if(unlink($lienLogo["LOGO_Url"]))
                    {
                        echo '<div id="good">
                            <label>Le logo a été supprimé avec succès !</label>
                            </div>';
                    }
                    else
                    {
                        echo '<div id="bad">
                            <label>Une erreur s\'est produite lors de la suppression du logo !</label>
                            </div>';
                    }
                }
                else
                {
                    echo '<div id="bad">
                        <label>Une erreur s\'est produite lors de la suppression du logo !</label>
                        </div>';
                }
            }
        }

        function getFinalUrl($tableau)
        {
            if(isset($_FILES['fileInput']) && filesize($_FILES['fileInput']['tmp_name']) > 0)
            {
                $fichier = strtolower(addslashes(preg_replace('/-|\s|\/|\.|\'|/i','',wd_remove_accents($tableau[0]))));
                $extension = strrchr($_FILES['fileInput']['name'], '.');
                return "images/logo_upload/".$fichier.$extension;
            }
            else
            {
                return "images/logo_upload/nologo.png";
            }
        }
    ?>
</div>
<?php
  	include($pwd.'footer.php');
?>