<?php  
    include('bandeau.php');
    ?>
    <div id="corps">
<?php
	if($db = MySQLi_connect("localhost","Kepha",'pfudor', 'Revivre', 0, '/media/sds1/home/alx22/private/mysql/socket'))
		echo '';
	else
		echo 'Erreur';

  $client=addslashes($_POST["Client"]);
  $chantier=addslashes($_POST["Chantier"]);
  $memb=addslashes($_POST["Memb"]);
  $fourn=addslashes($_POST["Fourn"]);

  if($chantier!=0){
   $query1 = "DELETE FROM Commanditer WHERE CHA_NumDevis = $chantier";
   $query2 = "DELETE FROM Chantiers WHERE CHA_NumDevis = $chantier";
   $query9 = "DELETE FROM Etat WHERE CHA_NumDevis = $chantier";
   $sql1 = mysqli_query($db, $query1);
   $errr1=mysqli_error($db);

    if($sql1){
      $sql9 = mysqli_query($db, $query9);
      $errr9 = mysqli_error($db);

      if($sql9){
      	$sql2 = mysqli_query($db, $query2);
      	$errr2 = mysqli_error($db);
      	
      	if($sql2){
	        echo '<div id="good">     
	            <label>Supression Chantier OK</label>
	            </div>';
	    }
	    else{
	      echo '<div id="bad">     
	            <label>Le chantier n\'a pas pu être supprimé</label>
	            </div>';
	    }
      }
      else{
        echo '<div id="bad">     
              <label>Le chantier n\'a pas pu être supprimé</label>
              </div>';
      }
    }
    else{
        echo '<div id="bad">     
              <label>Le chantier n\'a pas pu être supprimé</label>
              </div>';
      }
  }
  if($client!=0){
   $query4 = "DELETE FROM Personnes WHERE PER_Num = $client";
   $query3 = "DELETE FROM Clients WHERE PER_Num = $client";
   $sql3 = mysqli_query($db, $query3);
   $errr3=mysqli_error($db);

    if($sql3){
      $sql4 = mysqli_query($db, $query4);
      $errr4 = mysqli_error($db);

      if($sql4){
        echo '<div id="good">     
            <label>Supression Client OK</label>
            </div>';
      }
      else{
        echo '<div id="bad">     
              <label>Le client n\'a pas pu être supprimé</label>
              </div>';
      }
    }
    else{
        echo '<div id="bad">     
              <label>Le client n\'a pas pu être supprimé</label>
              </div>';
      }
  }
  if($memb!=0){
   $query5 = "DELETE FROM Personnes WHERE PER_Num = $memb";
   $query6 = "DELETE FROM Salaries WHERE PER_Num = $memb";
   $sql5 = mysqli_query($db, $query5);
   $errr5=mysqli_error($db);

    if($sql5){
      $sql6 = mysqli_query($db, $query6);
      $errr6 = mysqli_error($db);

      if($sql6){
        echo '<div id="good">     
            <label>Supression Membre OK</label>
            </div>';
      }
      else{
        echo '<div id="bad">     
              <label>Le membre n\'a pas pu être supprimé</label>
              </div>';
      }
    }
    else{
        echo '<div id="bad">     
              <label>Le membre n\'a pas pu être supprimé</label>
              </div>';
      }
  }
  if($fourn!=0){
   $query7 = "DELETE FROM Personnes WHERE PER_Num = $fourn";
   $query8 = "DELETE FROM Fournisseurs WHERE PER_Num = $fourn";
   $sql7 = mysqli_query($db, $query7);
   $errr7=mysqli_error($db);

    if($sql7){
      $sql8 = mysqli_query($db, $query8);
      $errr8 = mysqli_error($db);

      if($sql8){
        echo '<div id="good">     
            <label>Supression Fournisseur OK</label>
            </div>';
      }
      else{
        echo '<div id="bad">     
              <label>Le fournisseur n\'a pas pu être supprimé</label>
              </div>';
      }
    }
    else{
        echo '<div id="bad">     
              <label>Le fournisseur n\'a pas pu être supprimé</label>
              </div>';
      }
  }
  ?>
  </div>
  <?php  
    include('footer.php');
    ?>