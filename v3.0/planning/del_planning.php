<?php
$pwd='../';
	include('../bandeau.php');
?>
<div id="corps">
  <?php
  	if(isset($_POST['Date']) && isset($_POST["tableName"]))
  	{
  		$date=DateTime::createFromFormat('d/m/Y', $_POST["Date"])->format('Y-m-d');
		$tableName=$_POST["tableName"];
		$query = mysqli_query($db, 'DELETE FROM '.$tableName.' WHERE ASSOC_date="'.$date.'";');
  		if($query)
		{
	        echo '<div id="good">     
	            <label>Le planning de la semaine du lundi '.date("d/m/Y", strtotime($date)).' supprimé avec succès !</label>
	            </div>';
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

    echo '<script type="text/javascript">
	window.setTimeout("location=(\'./planning_insertion.php\');",2500);
	</script>';
  ?>
</div>
<?php
	include('../footer.php');
?>