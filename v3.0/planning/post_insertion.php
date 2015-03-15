<?php
$pwd='../';
	include('../bandeau.php');
?>
<div id="corps">
  <?php
  	if(isset($_POST['Date']))
  	{
  		$date=$_POST["Date"];

		$query = mysqli_query($db, "SELECT count(distinct ASSOC_date) as 'result' FROM pl_insertion WHERE ASSOC_date=date('".$date."') ORDER BY ASSOC_date DESC;");
  		$data = mysqli_fetch_assoc($query);
  		if($data["result"] == 0)
  		{
	  		if(isset($_POST['Tableau']))
	  		{
				$tableau=$_POST["Tableau"];
				$array = json_decode($tableau);
				for($x=0; $x<sizeof($array); $x++)
				{
					$query = "INSERT INTO pl_insertion(SAL_NumSalarie, ENC_Num, CRE_id, ASSOC_date) VALUES (".$array[$x][0].",".$array[$x][1].",".$array[$x][2].",date('".$date."'));";
					$sql = mysqli_query($db, $query);
					$errr = mysqli_error($db);
					echo $errr;
				}

				if($sql)
				{
			        echo '<div id="good">     
			            <label>Planning de la semaine du lundi '.date("d/m/Y", strtotime($date)).' ajouté avec succès !</label>
			            </div>';

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
		}
		else
		{
	        echo '<div id="bad">     
	              <label>Un planning existe déjà à la date du '.date("d/m/Y", strtotime($date)).'</label>
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
	window.location.replace("./planning_insertion.php");
	</script>'
  ?>
</div>
<?php  
  include('../footer.php');
?>
