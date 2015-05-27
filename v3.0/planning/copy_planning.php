<?php
	$pageTitle = "Copie de planning";
	$pwd='../';
	include($pwd.'bandeau.php');
?>
<div id="corps">
  <?php
  	if(isset($_POST['Date']) && isset($_POST['dateToCopy']) && isset($_POST['typePL']))
  	{
  		$oldDate=DateTime::createFromFormat('d/m/Y', $_POST["Date"])->format('Y-m-d');
  		$typePL=$_POST['typePL'];
  		$newDate=$_POST['dateToCopy'];
  		$query = mysqli_query($db, "SELECT count(distinct ASSOC_date) as 'result' FROM pl_association WHERE ASSOC_date='$newDate' AND PL_id = $typePL ORDER BY ASSOC_date DESC;");
  		$data = mysqli_fetch_assoc($query);
  		mysqli_free_result($query);
  		if($data['result'] == 0)
  		{
            if(mysqli_query($db, 'SET autocommit=0;') && mysqli_query($db, 'START TRANSACTION;'))
            {
                $queryStr="INSERT INTO pl_association(SAL_NumSalarie, ENC_Num, CRE_id, PL_id, ASSOC_date) 
                    SELECT SAL_NumSalarie, ENC_Num, CRE_id, PL_id, '".$newDate."' FROM pl_association WHERE ASSOC_date = '".$oldDate."' AND PL_id = ".$typePL.";";
                $query = mysqli_query($db,$queryStr);

                if($query)
                {
                    $query = mysqli_query($db,"INSERT INTO logo_association(LOGO_Id, PL_id, ASSOC_Date) SELECT LOGO_Id, PL_id, '".$newDate."' FROM logo_association WHERE ASSOC_date = '".$oldDate."' AND PL_id = ".$typePL.";");
                    if($query)
                    {
                        mysqli_query($db, "COMMIT;");
                        echo '<div id="good">     
                        <label>Le planning de la semaine du lundi '.date("d/m/Y", strtotime($oldDate)).' copié avec succès au '.date("d/m/Y", strtotime($newDate)).' !</label>
                        </div>';
                    }
                    else
                    {
                        mysqli_query($db, "ROLLBACK;");
                        echo '<div id="bad">     
                        <label>Une erreur s\'est produite lors de la copie du planning !</label>
                        </div>';
                    }
                }
                else
                {
                    mysqli_query($db, "ROLLBACK;");
                    echo '<div id="bad">     
                    <label>Une erreur s\'est produite lors de la copie du planning !</label>
                    </div>';
                }
	        }
			else
			{
				echo '<div id="bad">     
			    <label>Une erreur s\'est produite lors de la copie du planning !</label>
			    </div>';
			}
  		}
		else
		{
			echo '<div id="bad">     
		    <label>Impossible de copier, un planning existe déjà à la date du '.date("d/m/Y", strtotime($newDate)).' !</label>
		    </div>';
		}
	}
	else
	{
		echo '<div id="bad">     
	    <label>Une erreur s\'est produite lors de la copie du planning !</label>
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
