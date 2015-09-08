<?php  
	include('../assets.php');
    session_set_cookie_params(0);
	session_start();
	date_default_timezone_set('Europe/Paris');
	$db = revivre();
	mysqli_query($db, "SET NAMES 'utf8'");
	$pwd = "../";
	$tabJour = Array("Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi");
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<meta http-equiv="refresh" content="52" >
	<link rel="stylesheet" type="text/css" href="<?php echo $pwd; ?>css/affichage_planning.css">
	<link rel="stylesheet" type="text/css" href="<?php echo $pwd; ?>css/owl.carousel.css">
	<link rel="stylesheet" type="text/css" href="<?php echo $pwd; ?>css/owl.theme.css">
	<script type="text/javascript" src="<?php echo $pwd; ?>js/jquery.min.js"></script>
	<script type="text/javascript" src="<?php echo $pwd; ?>js/owl.carousel.min.js"></script>
	<title>Affichage des plannings</title>
</head>
<body>
	<div class="carouselwrapper">
		<div class="owl-carousel">
		  <div id="plInsertion" class="planning">
			<?php
				$reponse = mysqli_query($db, "SELECT DISTINCT ASSOC_date FROM pl_association WHERE ASSOC_date='".date("Y-m-d",strtotime("monday this week"))."' AND PL_id=1 AND ASSOC_Archi = 0;");
				if(mysqli_num_rows($reponse) == 1)
				{
					$currentDate = date("Y-m-d",strtotime("monday this week"));
				}
				else
				{
					$reponse = mysqli_query($db, "SELECT DISTINCT ASSOC_date FROM pl_association WHERE PL_id=1 AND ASSOC_Archi = 0 ORDER BY ASSOC_date DESC LIMIT 1;");
					$currentDate = mysqli_fetch_assoc($reponse)["ASSOC_date"];
				}
				$reponse = mysqli_query($db, "select distinct concat(concat(upper(PER_nom),' '),PER_prenom) as 'nom', ENC_Num
									from pl_association join salaries sa on sa.SAL_NumSalarie = ENC_Num 
									join personnes using(PER_Num) where ASSOC_date='".$currentDate."' AND PL_id = 1 ORDER BY ENC_Num;");
				$x=0;
				while($donnees = mysqli_fetch_assoc($reponse))
				{
					$encadrant[$x] = $donnees["ENC_Num"];
					$encadrantNom[$x++] = $donnees["nom"];
				}
				mysqli_free_result($reponse);
			?>
		  	<table>
		  		<caption>Planning insertion du lundi <?php echo date("d/m/Y",strtotime($currentDate));?> au vendredi <?php echo date("d/m/Y",strtotime($currentDate." + 4 day"));?></caption>
				<thead>
					<th id="firstColumn"></th>
					<?php 
						for($x=0; $x<sizeof($encadrant); $x++)
						{
							echo '<th>'.$encadrantNom[$x].'<br/>8h - 12h</th>
							<th>'.$encadrantNom[$x].'<br/>13h - 17h</th>';
						}
						if(sizeof($encadrant)==1)
						{
							echo '<th></th><th></th>';
						}
					?>
				</thead>
				<tbody>
				<?php
					$CreValue=1;
					for($x=0; $x<5; $x++)
					{
				?>
						<tr>
	                        <?php 
	                            if(isJourFerie(date("d/m/Y", strtotime($currentDate.' + '.$x.' day'))))
	                            {
	                                echo '<td><b>'.$tabJour[$x].'<br>FÉRIÉ</td></b>';
	                            }
	                            else
	                            {
	                                echo '<td><b>'.$tabJour[$x].'<br>'.date("d/m", strtotime($currentDate.' + '.$x.' day')).'</td></b>'; 
	                            }
	                    
	                            for($y=0; $y<(sizeof($encadrant)*2); $y++)
	                            {
	                                $query = mysqli_query($db,"SELECT concat(concat(PER_nom,' '),PER_prenom) AS 'nom', CNV_Couleur FROM pl_association
	                                                    JOIN salaries USING(SAL_NumSalarie)
	                                                    JOIN personnes USING(PER_Num)
	                                                    JOIN insertion using(SAL_NumSalarie)
	                                                    JOIN convention using(CNV_id)
	                                                    WHERE ASSOC_date= '".$currentDate."' AND CRE_id = ".$CreValue." AND ENC_Num = ".$encadrant[$y/2]." AND PL_id = 1;");

	                                $nbRep = mysqli_num_rows($query);
	                                ($nbRep==0) ? $couleur = 'url(\'../images/hachure-planning.png\') repeat' : $couleur = "none";
	                                echo '<td style="text-align:center; vertical-align:middle; background:'.$couleur.';">';

	                                while($data = mysqli_fetch_assoc($query))
	                                {
	                                    echo "<span style='color:".$data["CNV_Couleur"].";'>".$data["nom"].'</span><br/>';
	                                }
	                                echo '</td>';
	                                if($CreValue%2 == 0)
	                                    $CreValue--;
	                                else
	                                    $CreValue++;
	                            }
	                            if(sizeof($encadrant)==1)
	                            {
	                                echo '<td style="background:url(\'../images/hachure-planning.png\') repeat;"></td><td style="background:url(\'../images/hachure-planning.png\') repeat;"></td>';
	                            }
	                        ?>
	                    </tr>
				<?php
					$CreValue += 2;
					}
					mysqli_free_result($query);
				?>
				</tbody>
			</table>
		  </div>
		  <div id="plOccupationnel" class="planning">
			<?php
				$encadrant = Array();
				$encadrantNom = Array();

				$reponse = mysqli_query($db, "SELECT DISTINCT ASSOC_date FROM pl_association WHERE ASSOC_date='".date("Y-m-d",strtotime("monday this week"))."' AND PL_id=2 AND ASSOC_Archi = 0;");
				if(mysqli_num_rows($reponse) == 1)
				{
					$currentDate = date("Y-m-d",strtotime("monday this week"));
				}
				else
				{
					$reponse = mysqli_query($db, "SELECT DISTINCT ASSOC_date FROM pl_association WHERE PL_id=2 AND ASSOC_Archi = 0 ORDER BY ASSOC_date DESC LIMIT 1;");
					$currentDate = mysqli_fetch_assoc($reponse)["ASSOC_date"];
				}
				$reponse = mysqli_query($db, "select distinct concat(concat(upper(PER_nom),' '),PER_prenom) as 'nom', ENC_Num
									from pl_association join salaries sa on sa.SAL_NumSalarie = ENC_Num 
									join personnes using(PER_Num) where ASSOC_date='".$currentDate."' AND PL_id = 2 ORDER BY ENC_Num;");
				$x=0;
				while($donnees = mysqli_fetch_assoc($reponse))
				{
					$encadrant[$x] = $donnees["ENC_Num"];
					$encadrantNom[$x++] = $donnees["nom"];
				}
				mysqli_free_result($reponse);
			?>
		  	<table>
		  		<caption>Planning occupationnel du lundi <?php echo date("d/m/Y",strtotime($currentDate));?> au vendredi <?php echo date("d/m/Y",strtotime($currentDate." + 4 day"));?></caption>
				<thead>
					<th id="firstColumn"></th>
					<?php 
						for($x=0; $x<sizeof($encadrant); $x++)
						{
							echo '<th>'.$encadrantNom[$x].'<br/>8h - 12h</th>
							<th>'.$encadrantNom[$x].'<br/>13h - 17h</th>';
						}
						if(sizeof($encadrant)==1)
						{
							echo '<th></th><th></th>';
						}
					?>
				</thead>
				<tbody>
				<?php
					$CreValue=1;
					for($x=0; $x<5; $x++)
					{
				?>
						<tr>
	                        <?php 
	                            if(isJourFerie(date("d/m/Y", strtotime($currentDate.' + '.$x.' day'))))
	                            {
	                                echo '<td><b>'.$tabJour[$x].'<br>FÉRIÉ</td></b>';
	                            }
	                            else
	                            {
	                                echo '<td><b>'.$tabJour[$x].'<br>'.date("d/m", strtotime($currentDate.' + '.$x.' day')).'</td></b>'; 
	                            }
	                    
	                            for($y=0; $y<(sizeof($encadrant)*2); $y++)
	                            {
	                                $query = mysqli_query($db,"SELECT concat(concat(PER_nom,' '),PER_prenom) AS 'nom', CNV_Couleur FROM pl_association
	                                                    JOIN salaries USING(SAL_NumSalarie)
	                                                    JOIN personnes USING(PER_Num)
	                                                    JOIN insertion using(SAL_NumSalarie)
	                                                    JOIN convention using(CNV_id)
	                                                    WHERE ASSOC_date= '".$currentDate."' AND CRE_id = ".$CreValue." AND ENC_Num = ".$encadrant[$y/2]." AND PL_id = 2;");

	                                $nbRep = mysqli_num_rows($query);
	                                ($nbRep==0) ? $couleur = 'url(\'../images/hachure-planning.png\') repeat' : $couleur = "none";
	                                echo '<td style="text-align:center; vertical-align:middle; background:'.$couleur.';">';

	                                while($data = mysqli_fetch_assoc($query))
	                                {
	                                    echo "<span style='color:".$data["CNV_Couleur"].";'>".$data["nom"].'</span><br/>';
	                                }
	                                echo '</td>';
	                                if($CreValue%2 == 0)
	                                    $CreValue--;
	                                else
	                                    $CreValue++;
	                            }
	                            if(sizeof($encadrant)==1)
	                            {
	                                echo '<td style="background:url(\'../images/hachure-planning.png\') repeat;"></td><td style="background:url(\'../images/hachure-planning.png\') repeat;"></td>';
	                            }
	                        ?>
	                    </tr>
				<?php
					$CreValue += 2;
					}
					mysqli_free_result($query);
				?>
				</tbody>
			</table>
		  </div>
		  <div id="plStagiaire" class="planning">
			<?php
				$encadrant = Array();
				$encadrantNom = Array();

				$reponse = mysqli_query($db, "SELECT DISTINCT ASSOC_date FROM pl_association WHERE ASSOC_date='".date("Y-m-d",strtotime("monday this week"))."' AND PL_id=3 AND ASSOC_Archi = 0;");
				if(mysqli_num_rows($reponse) == 1)
				{
					$currentDate = date("Y-m-d",strtotime("monday this week"));
				}
				else
				{
					$reponse = mysqli_query($db, "SELECT DISTINCT ASSOC_date FROM pl_association WHERE PL_id=3 AND ASSOC_Archi = 0 ORDER BY ASSOC_date DESC LIMIT 1;");
					$currentDate = mysqli_fetch_assoc($reponse)["ASSOC_date"];
				}
				$reponse = mysqli_query($db, "select distinct concat(concat(upper(PER_nom),' '),PER_prenom) as 'nom', ENC_Num
									from pl_association join salaries sa on sa.SAL_NumSalarie = ENC_Num 
									join personnes using(PER_Num) where ASSOC_date='".$currentDate."' AND PL_id = 3 ORDER BY ENC_Num;");
				$x=0;
				while($donnees = mysqli_fetch_assoc($reponse))
				{
					$encadrant[$x] = $donnees["ENC_Num"];
					$encadrantNom[$x++] = $donnees["nom"];
				}
				mysqli_free_result($reponse);
			?>
		  	<table>
		  		<caption>Planning stagiaire du lundi <?php echo date("d/m/Y",strtotime($currentDate));?> au vendredi <?php echo date("d/m/Y",strtotime($currentDate." + 4 day"));?></caption>
				<thead>
					<th id="firstColumn"></th>
					<?php 
						for($x=0; $x<sizeof($encadrant); $x++)
						{
							echo '<th>'.$encadrantNom[$x].'<br/>8h - 12h</th>
							<th>'.$encadrantNom[$x].'<br/>13h - 17h</th>';
						}
						if(sizeof($encadrant)==1)
						{
							echo '<th></th><th></th>';
						}
					?>
				</thead>
				<tbody>
				<?php
					$CreValue=1;
					for($x=0; $x<5; $x++)
					{
				?>
						<tr>
	                        <?php 
	                            if(isJourFerie(date("d/m/Y", strtotime($currentDate.' + '.$x.' day'))))
	                            {
	                                echo '<td><b>'.$tabJour[$x].'<br>FÉRIÉ</td></b>';
	                            }
	                            else
	                            {
	                                echo '<td><b>'.$tabJour[$x].'<br>'.date("d/m", strtotime($currentDate.' + '.$x.' day')).'</td></b>'; 
	                            }
	                    
	                            for($y=0; $y<(sizeof($encadrant)*2); $y++)
	                            {
	                                $query = mysqli_query($db,"SELECT concat(concat(PER_nom,' '),PER_prenom) AS 'nom', CNV_Couleur FROM pl_association
	                                                    JOIN salaries USING(SAL_NumSalarie)
	                                                    JOIN personnes USING(PER_Num)
	                                                    JOIN insertion using(SAL_NumSalarie)
	                                                    JOIN convention using(CNV_id)
	                                                    WHERE ASSOC_date= '".$currentDate."' AND CRE_id = ".$CreValue." AND ENC_Num = ".$encadrant[$y/2]." AND PL_id = 3;");

	                                $nbRep = mysqli_num_rows($query);
	                                ($nbRep==0) ? $couleur = 'url(\'../images/hachure-planning.png\') repeat' : $couleur = "none";
	                                echo '<td style="text-align:center; vertical-align:middle; background:'.$couleur.';">';

	                                while($data = mysqli_fetch_assoc($query))
	                                {
	                                    echo "<span style='color:".$data["CNV_Couleur"].";'>".$data["nom"].'</span><br/>';
	                                }
	                                echo '</td>';
	                                if($CreValue%2 == 0)
	                                    $CreValue--;
	                                else
	                                    $CreValue++;
	                            }
	                            if(sizeof($encadrant)==1)
	                            {
	                                echo '<td style="background:url(\'../images/hachure-planning.png\') repeat;"></td><td style="background:url(\'../images/hachure-planning.png\') repeat;"></td>';
	                            }
	                        ?>
	                    </tr>
				<?php
					$CreValue += 2;
					}
					mysqli_free_result($query);
				?>
				</tbody>
			</table>
		  </div>
		</div>
	</div>
<script type="text/javascript">
	$(document).ready(function() {
	  var owl = $(".owl-carousel");
	  owl.owlCarousel({
	      items : 1,
	      singleItem : true,
	      autoPlay : 8000
	  });
	});
</script>
</body>
</html>