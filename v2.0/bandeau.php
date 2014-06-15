<!DOCTYPE html>

<html>

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<link rel="stylesheet" type="text/css" href="css/index.css">
		<link rel="stylesheet" type="text/css" href="css/drop.css">
		<link rel="stylesheet" type="text/css" href="css/table.css">
		<link rel="stylesheet" type="text/css" href="css/alpha.css">
		<?php
		
		function dater($str){
			$formatDate = "d / m / Y";
			$result = "";
			if($str!="")
				$result = date($formatDate, strtotime($str));
			return $result;
		}
		$i=rand(1,2);
		if($i==1){
			echo '<link rel="icon" href="images/favicon2.png" sizes="16x16" />
   		<link rel="icon" href="images/favicon2.ico" sizes="16x16" />
   		<link rel="icon" href="images/favicon2.icns" sizes="16x16" />';
		}
		else{
			echo '<link rel="icon" href="images/favicon1.png" sizes="16x16" />
   		<link rel="icon" href="images/favicon1.ico" sizes="16x16" />
   		<link rel="icon" href="images/favicon1.icns" sizes="16x16" />';
		}
		?>
		<link rel="stylesheet" type="text/css" href="css/tooltipster.css" />
    	<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.0.min.js"></script>
    	<script type="text/javascript" src="js/jquery.tooltipster.min.js"></script>
    	<script language="javascript"> 
			function fbissubmit(value_p) 
			{ 
				document.forms['viewDetailMember'].TypeM.value = value_p; 
				document.forms['viewDetailMember'].submit(); 
			} 
		</script>
		<title>Intranet association Revivre</title>
		<!-- V. Durand | A. Freret | P. Friboulet | J. Le Bas | IUT Caen - DUT Info (2013-2015) -->
	</head>

	<body>
		<div id="wrapper" background-color="white">
			<div id="entete">
				<a href="home.php"><img id="logoAssos" src="images/logo_small.png"></a>
				<div id="navi">
					<nav>
						<ul class="bandeau">
							<li id="champs"><a href="home.php">Accueil</a></li>
							<li id="champs"><a href="homeContact.php">Répertoire</a>
								<ul class="subMenu">
									<li><a href="addContact.php">Ajouter<br>Contact</a></li>
	                       			<li><a href="viewClients.php">Clients<br>&nbsp;</a>
										<!--<ul>
											<li><a href="viewClientCh.php">Chantier<br>&nbsp;</a></li>
											<li><a href="viewClientCo.php">Conditionnement</a></li>
										</ul>-->
									</li>
									<li><a href="viewFourn.php">Fournisseurs<br>&nbsp;</a>
										<!--<ul>
											<li><a href="viewFournCh.php">Chantier<br>&nbsp;</a></li>
											<li><a href="viewFournFo.php">Fourniture</a></li>
										</ul>-->
									</li>
									<li><a href="viewMembers.php">Membre de<br>l'association</a>
										<ul>
											<?php

	if($db = MySQLi_connect("localhost","Kepha",'pfudor', 'Revivre', 0, '/media/sds1/home/alx22/private/mysql/socket'))
		echo '';
	else
		echo 'Erreur';
	$i = 2;
	$reponse = mysqli_query($db, "SELECT * FROM Type");
	
	while ($donnees = mysqli_fetch_assoc($reponse))
	{
		?>									<form method="post" action="viewSal.php" name="viewDetailMember">
											<input type="hidden" name="TypeM" value="<?php echo $i; ?>">
				        						<li><a onclick="javascript:fbissubmit('<?php echo $i; ?>');"><?php echo $donnees['TYP_Nom']; ?><br>&nbsp;</a></li>
				        					</form>
				        	<?php
	$i++;
	}
	mysqli_free_result($reponse);
	?>										
										</ul>
									</li>
	                			</ul>
							</li>
							<li id="champs"><a href="homeWork.php">Chantiers</a>
								<ul class="subMenu">
	                       			<li><a href="addWork.php">Ajouter<br>chantier</a></li>
									<li><a href="ongoingWorks.php">Chantiers en cours</a></li>
									<li><a href="oldWorks.php">Archive<br>chantiers</a></li>
	                			</ul>
							</li>
							<li id="champs"><a href="homeRent.php">Vehicules</a>
	                			<ul class="subMenu">
	                       			<li><a href="carRent.php">Ajouter<br>Véhicules</a></li>
	                        		<li><a href="flatRent.php">Suivi<br>Vehicules</a></li>
	                			</ul>
	        				</li>
	        				<li id="champs"><a href="homeRent.php">N@vette</a>
	                			<ul class="subMenu">
	                       			<li><a href="carRent.php">Louer<br>Véhicules</a></li>
	                        		<li><a href="flatRent.php">Suivi<br>Vehicules</a></li>
	                			</ul>
	        				</li>
							<li id="champs"><a href="homeSupplier.php">Logements</a>
								<ul class="subMenu">
	                       			<li><a href="addSupplier.php">Ajouter<br>logement</a></li>
									<li><a href="viewSuppliers.php">Liste<br>logements</a></li>
	                			</ul>
	                		</li>
							<li id="champs"><a href="homeTool.php">Outillages </a>
								<ul class="subMenu">
	                       			<li><a href="addTool.php">Ajouter<br>outil</a></li>
									<li><a href="viewTools.php">Liste<br>outils</a></li>
	                			</ul>
							</li>
							<li id="champs"><a href="homeMeal.php">Restauration</a>
								<ul class="subMenu">
	                       			<li><a href="addMeal.php">Ajouter<br>repas</a></li>
									<li><a href="viewMeals.php">Archive<br>commandes</a></li>
	                			</ul>
							</li>
						</ul>	
					</nav>
				</div>
			</div>
		</div>