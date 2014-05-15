<!DOCTYPE html>

<html>

	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="css/index.css">
		<link rel="stylesheet" type="text/css" href="css/drop.css">
		<link rel="stylesheet" type="text/css" href="css/table.css">
		<link rel="stylesheet" type="text/css" href="css/alpha.css">
		<?php
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
		<title>Intranet association Revivre</title>
		<!-- V. Durand | A. Freret | P. Friboulet | J. Le Bas | IUT Caen - DUT Info (2013-2015) -->
	</head>

	<body>
		<div id="wrapper" background-color="white">
			<div id="entete">
				<a href="home.php"><img src="images/logo.jpg"></a>
				<div id="navi">
					<nav>
						<ul class="bandeau">
							<li id="champs"><a href="home.php">Accueil</a></li>
							<li id="champs"><a href="homeContact.php">Repertoire</a>
								<ul class="subMenu">
									<li><a href="addContact.php">Ajouter<br>Contact</a></li>
	                       			<li><a href="viewClients.php">Clients<br>&nbsp;</a>
										<ul>
											<li><a href="viewClientCh.php">Chantier<br>&nbsp;</a></li>
											<li><a href="viewClientCo.php">Conditionnement</a></li>
										</ul>
									</li>
									<li><a href="viewFourn.php">Fournisseurs<br>&nbsp;</a>
										<ul>
											<li><a href="viewFournCh.php">Chantier<br>&nbsp;</a></li>
											<li><a href="viewFournFo.php">Fourniture</a></li>
										</ul>
									</li>
									<li><a href="viewMembers.php">Membre de<br>l'association</a>
										<ul>
											<li><a href="viewSal.php">Salarie<br>&nbsp;</a></li>
											<li><a href="viewSal.php">Formateur<br>&nbsp;</a></li>
											<li><a href="viewBene.php">Benevoles<br>&nbsp;</a></li>
											<li><a href="viewStag.php">Stagiaires</a></li>
										</ul>
									</li>
	                			</ul>
							</li>
							<li id="champs"><a href="homeWork.php">Chantiers</a>
								<ul class="subMenu">
	                       			<li><a href="addWork.php">Ajouter<br>chantier</a></li>
									<li><a href="ongoingWorks.php">Chantiers en cours</a></li>
									<li><a href="oldWorks.php">Archive chantiers</a></li>
	                			</ul>
							</li>
							<li id="champs"><a href="homeRent.php">Vehicules</a>
	                			<ul class="subMenu">
	                       			<li><a href="carRent.php">Ajouter<br>Véhicules</a></li>
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
							<li id="champs"><a href="homeMeal.php">Restaurant</a>
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