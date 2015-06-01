<?php
	$pageTitle = "Envoi de planning ACI/Insertion";
	$pwd='../';
	include($pwd.'bandeau.php');
?>
<div id="corps">
	<?php
		if(isset($_POST['Tableau']))
		{
			$tableau = json_decode($_POST["Tableau"]);
			if(mysqli_query($db, 'SET autocommit=0;') && mysqli_query($db, 'START TRANSACTION;'))
            {
				$erreur = false;	
				for($x=0; $x<sizeof($tableau); $x++)
                {
					if($tableau[$x][4]==1)
					{
						$query = mysqli_query($db, "INSERT INTO convention(CNV_Id, CNV_Nom, CNV_Couleur, CNV_Actif) VALUES (".($tableau[$x][0]).",upper('".$tableau[$x][1]."'),'".$tableau[$x][2]."', ".$tableau[$x][3].")");
						if(!$query)
						{
							$erreur = true;
						}
					}
					else if($tableau[$x][4]==0)
					{
						$query = mysqli_query($db, "UPDATE convention SET CNV_Nom='".$tableau[$x][1]."', CNV_Couleur='".$tableau[$x][2]."', CNV_Actif=".$tableau[$x][3]." WHERE CNV_ID='".($tableau[$x][0])."'");
						if(!$query)
						{
							echo "Erruer update";
							$erreur = true;
						}
					}
					else{
					$query = mysqli_query($db, "DELETE from convention WHERE CNV_ID='".($tableau[$x][0])."'");
						if(!$query)
						{
							echo "<div id=\"bad\"><label>La convention ".$tableau[$x][1]." ne peut pas être suprimée, des salariés y sont associé</label></div><br/>";
							//$erreur = true;
						}
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
			else
			{
				echo '<div id="bad">
				  <label>Une erreur s\'est produite lors de la sauvegarde des conventions !</label>
				  </div>';
			}
			
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