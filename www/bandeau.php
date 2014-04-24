<!DOCTYPE html>

<html>

	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="css/index.css">
		<link rel="stylesheet" type="text/css" href="css/drop.css">
		<link rel="stylesheet" type="text/css" href="css/table.css">
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
							<li id="champs"><a href="homeSupplier.php">Fournisseurs</a>
								<ul class="subMenu">
	                       			<li><a href="addSupplier.php">Ajouter<br>fournisseur</a></li>
									<li><a href="viewSuppliers.php">Liste<br>fournisseurs</a></li>
	                			</ul>
	                		</li>
							<li id="champs"><a href="homeClient.php">Contacts</a>
								<ul class="subMenu">
	                       			<li><a href="viewClients.php">Cliens<br>&nbsp;</a>
										<ul>
											<li><a href="addClient.php">Ajouter client<br>&nbsp;</a></li>
											<li><a href="viewClients.php">Liste clients</a></li>
										</ul>
									</li>
									<li><a href="viewMembers.php">Membre de<br>l'association</a>
										<ul>
											<li><a href="addMember.php">Ajouter un membre<br>&nbsp;</a></li>
											<li><a href="viewMembers.php">Ajouter un membre</a></li>
										</ul>
									</li>
	                			</ul>
							</li>

							<li id="champs"><a href="homeWork">Chantiers</a>
								<ul class="subMenu">
	                       			<li><a href="addWork">Ajouter<br>chantier</a></li>
									<li><a href="ongoingWorks">Chantiers en cours</a></li>
									<li><a href="oldWorks">Archive chantiers</a></li>
	                			</ul>
							</li>
							<li id="champs"><a href="homeRent">Locations</a>
	                			<ul class="subMenu">
	                       			<li><a href="carRent">Véhicules<br>&nbsp;</a></li>
	                        		<li><a href="flatRent">Appartement<br>&nbsp;</a></li>
	                			</ul>
	        				</li>
							<li id="champs"><a href="homeTool">Outillages </a>
								<ul class="subMenu">
	                       			<li><a href="addTool.php">Ajouter<br>outil</a></li>
									<li><a href="viewTools.php">Liste<br>outils</a></li>
	                			</ul>
							</li>
							<li id="champs"><a href="homeMeal">Restaurant</a>
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