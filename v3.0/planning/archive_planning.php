<?php
	$pageTitle = "Archivage de planning";
	$pwd='../';
	include($pwd.'bandeau.php');
?>
<div id="corps">
  <?php
    if(isset($_POST['Date']) && isset($_POST['typePL']))
    {
      $date=DateTime::createFromFormat('d/m/Y', $_POST["Date"])->format('Y-m-d');
      $typePL=$_POST['typePL'];
      $query = mysqli_query($db, "UPDATE pl_association SET ASSOC_Archi=1 WHERE ASSOC_Date='".$date."' AND PL_id='".$typePL."'");
      if($query)
      {
        echo '<div id="good">     
        <label>Le planning de la semaine du lundi '.date("d/m/Y", strtotime($date)).' a été archivé avec succès !</label>
        </div>';
      }
    }
    else
    {
      echo '<div id="bad">     
      <label>Une erreur s\'est produite lors de l\'archivage du planning !</label>
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
