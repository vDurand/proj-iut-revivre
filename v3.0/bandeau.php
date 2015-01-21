<?php  
	include('assets.php');
	 session_start();
	 date_default_timezone_set('Europe/Paris');
	 if (!isset($_SESSION['user']) && basename($_SERVER["PHP_SELF"]) != "login.php") {
	     header("Location: login.php");
	 }
    if(!isset($pageTitle)){
        $pageTitle = "Intranet association Revivre";
    }
?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link rel="stylesheet" type="text/css" href="css/index.css">
		<link rel="stylesheet" type="text/css" href="css/drop.css">
		<link rel="stylesheet" type="text/css" href="css/table.css">
		<link rel="stylesheet" type="text/css" href="css/alpha.css">
<?php
	$i=rand(1,2);
	if($i==1){
		echo '<link rel="icon" href="images/favicon2.png" sizes="16x16"/>
		<link rel="icon" href="images/favicon2.ico" sizes="16x16"/>';
	}
	else{
		echo '<link rel="icon" href="images/favicon1.png" sizes="16x16"/>
		<link rel="icon" href="images/favicon1.ico" sizes="16x16"/>';
	}
?>
		<link rel="stylesheet" type="text/css" href="css/tooltipster.css" />
    	<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.0.min.js"></script>
    	<script type="text/javascript" src="js/jquery.tooltipster.min.js"></script>
    	<script type="text/javascript" src="js/assets.js"></script>
    	<link rel="stylesheet" href="http://cdn.oesmith.co.uk/morris-0.5.1.css">
    	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
    	<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    	<script src="http://cdn.oesmith.co.uk/morris-0.5.1.min.js"></script>
		<title><?php echo $pageTitle; ?></title>
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
                                    <li><a href="addInsertion.php">Ajouter<br>en Insertion</a></li>
									<li><a href="addContact.php">Ajouter<br>Contact</a></li>
	                       			<li><a href="viewClients.php">Clients<br>&nbsp;</a>
										<ul>
											<li><a href="viewClientPart.php">Particuliers</a></li>
											<li><a href="viewClientEnt.php">Entreprises</a></li>
                                            <li><a href="viewClientEmp.php">Employés</a></li>
										</ul>
									</li>
									<li><a href="viewFourn.php">Fournisseurs<br>&nbsp;</a>
										<ul>
                                            <li><a href="viewFournEnt.php">Entreprises</a></li>
                                            <li><a href="viewFournEmp.php">Employés</a></li>
										</ul>
									</li>
									<li><a href="viewMembers.php">Membres de<br>l'association</a>
										<ul>
<?php
	$db = revivre();
	
	mysqli_query($db, "SET NAMES 'utf8'");
	$reponse = mysqli_query($db, "SELECT * FROM Type");
	
	while ($donnees = mysqli_fetch_assoc($reponse))
	{
?>
											<form method="post" action="viewSal.php" name="viewDetailMember">
												<input type="hidden" name="TypeM" value="<?php echo $donnees['TYP_Id']; ?>">
				        						<li><a onclick="javascript:submitListMember('<?php echo $donnees['TYP_Id']; ?>');"><?php echo $donnees['TYP_Nom']; ?><br>&nbsp;</a></li>
				        					</form>
<?php
	}
	mysqli_free_result($reponse);
?>										
										</ul>
									</li>
                                    <li><a href="viewPartenaires.php">Partenaires<br>&nbsp;</a>
                                        <ul>
                                            <form method="post" action="viewSal.php" name="viewDetailMember">
                                                <input type="hidden" name="TypeM" value="0">
                                                <li><a onclick="javascript:submitListMember('0');">Référent<br>&nbsp;</a></li>
                                            </form>
                                        </ul>
                                    </li>
	                			</ul>
							</li>
							<li id="champs"><a href="homeWork.php">Chantiers</a>
								<ul class="subMenu">
	                       			<li><a href="addWork.php">Ajouter<br>chantier</a></li>
                                    <li><a href="awaitingWorks.php">Chantiers en attente</a></li>
									<li><a href="ongoingWorks.php">Chantiers en cours</a></li>
									<li><a href="oldWorks.php">Archive<br>chantiers</a></li>
                                    <li><a href="suiviEnc.php">Suivi<br>chantiers</a></li>
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
						<?php
						if (isset($_SESSION["user"])) {
                        ?>
						            <form action="login.php" method="post">
						                <input class="deco" id="deco" name="logout" type="submit" value="X">
						            </form>
                            <?php if($_SESSION ["user"] == "admin"){
                            ?>
                            <a class="deco2" id="deco2" href="adminLand.php">Administration</a>
						            <?php
                            }
						}
						?>	
					</nav>
				</div>
			</div>
		</div>
		<div id="debug"><a href="debugger.php">Signaler<br>un Bug</a></div>
		