<?php
	$pageTitle = "Supprestion de planning";
	$pwd='../';
	include($pwd.'bandeau.php');
?>
<div id="corps">
  <?php
  	if(isset($_POST['Date']) && isset($_POST['typePL']))
  	{
  		$typePL = $_POST['typePL'];
  		$date=DateTime::createFromFormat('d/m/Y', $_POST["Date"])->format('Y-m-d');
        if(mysqli_query($db, 'SET autocommit=0;') && mysqli_query($db, 'START TRANSACTION;'))
        {
            $query = mysqli_query($db, 'DELETE FROM pl_association WHERE ASSOC_date="'.$date.'" AND PL_id = '.$typePL.';');
            if($query)
            {
              $query = mysqli_query($db, 'DELETE FROM logo_association WHERE ASSOC_date="'.$date.'" AND PL_id = '.$typePL.';');
              if($query)
              {
                $query = mysqli_query($db, 'DELETE FROM pl_proprietees WHERE ASSOC_date="'.$date.'" AND PL_id = '.$typePL.';');
                if($query)
                {
                    mysqli_query($db, 'COMMIT;');
                    echo '<div id="good">     
                        <label>Le planning de la semaine du lundi '.date("d/m/Y", strtotime($date)).' supprimé avec succès !</label>
                        </div>';
                }
                else
                {
                    mysqli_query($db, 'ROLLBACK;');
                    echo '<div id="bad">     
                          <label>Une erreur s\'est produite lors de la suppression du planning !</label>
                          </div>';
                }
              }
              else
              {
                  mysqli_query($db, 'ROLLBACK;');
                  echo '<div id="bad">     
                        <label>Une erreur s\'est produite lors de la suppression du planning !</label>
                        </div>';
              }
            }
            else
            {
                mysqli_query($db, 'ROLLBACK;');
                echo '<div id="bad">     
                      <label>Une erreur s\'est produite lors de la suppression du planning !</label>
                      </div>';
            }
        }
        else
        {
            echo '<div id="bad">     
                  <label>Une erreur s\'est produite lors de la suppression du planning !</label>
                  </div>';
        }
	}
	else
	{
		echo '<div id="bad">     
		      <label>Une erreur s\'est produite lors de la suppression du planning !</label>
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
