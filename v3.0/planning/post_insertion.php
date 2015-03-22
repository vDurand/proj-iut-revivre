<?php
$pwd='../';
	include('../bandeau.php');
?>
<div id="corps">
  <?php
  	if(isset($_POST['Date']) && isset($_POST['Tableau']) && isset($_POST["Modify"]))
  	{
  		$date=$_POST["Date"];
		$query = mysqli_query($db, "SELECT count(distinct ASSOC_date) as 'result' FROM pl_insertion WHERE ASSOC_date=date('".$date."') ORDER BY ASSOC_date DESC;");
  		$data = mysqli_fetch_assoc($query);
  		$tableau=$_POST["Tableau"];
		$array = json_decode($tableau);

		if($_POST["Modify"] == 'true')
		{
		  	$query = mysqli_query($db, 'DELETE FROM pl_insertion WHERE ASSOC_date=date("'.$date.'");');
	  		if($query)
			{
					$queryString = "INSERT INTO pl_insertion(SAL_NumSalarie, ENC_Num, CRE_id, ASSOC_date) VALUES ";
					for($x=0; $x<sizeof($array); $x++)
					{
						$queryString = ($x==0) ? $queryString."(".$array[$x][0].",".$array[$x][1].",".$array[$x][2].",date('".$date."'))" : $queryString.",(".$array[$x][0].",".$array[$x][1].",".$array[$x][2].",date('".$date."'))";

					}
					echo $queryString.";";
					$query = mysqli_query($db, $queryString.";");
					if(!$query)
	        		{
	        			echo '<div id="bad">
					      <label>Une erreur s\'est produite lors de la modification du planning !</label>
					      </div>';
	        		}
	        		else
	        		{
		        		echo '<div id="good">
			            <label>Le planning de la semaine du lundi '.date("d/m/Y", strtotime($date)).' a été modifié avec succès !</label>
			            </div>';
	        		}
	        }
		}
		elseif($data["result"] == 0)
		{
			$queryString = "INSERT INTO pl_insertion(SAL_NumSalarie, ENC_Num, CRE_id, ASSOC_date) VALUES ";
			for($x=0; $x<sizeof($array); $x++)
			{
				$queryString = ($x==0) ? $queryString."(".$array[$x][0].",".$array[$x][1].",".$array[$x][2].",date('".$date."'))" : $queryString.",(".$array[$x][0].",".$array[$x][1].",".$array[$x][2].",date('".$date."'))";

			}
			$query = mysqli_query($db, $queryString.";");
			if(!$query)
    		{
    			echo '<div id="bad">
		              <label>Une erreur s\'est produite lors de la sauvegarde du planning !</label>
		              </div>';
    		}
    		else
    		{
				echo '<div id="good">
		            <label>Planning de la semaine du lundi '.date("d/m/Y", strtotime($date)).' ajouté avec succès !</label>
		            </div>';
    		}	        
		}
		else
		{
	        echo '<div id="bad">
	              <label>Une erreur s\'est produite lors de la sauvegarde du planning !</label>
	              </div>';
		}
	}
	else
	{	        
		echo '<div id="bad"> 
	              <label>Une erreur s\'est produite lors de la sauvegarde du planning !</label>
	              </div>';
	}
	
    echo '<script type="text/javascript">
	window.setTimeout("location=(\'./planning_insertion.php\');",2500);
	</script>';
  ?>
</div>
<?php
  	include('../footer.php');
?>