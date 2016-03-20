<?php
	include('assets.php');
    session_set_cookie_params(0);
	session_start();
	date_default_timezone_set('Europe/Paris');

	$db = revivre();
	mysqli_query($db, "SET lc_time_names = 'fr_FR'");
	mysqli_query($db, "SET NAMES 'utf8'");

	if (!isset($_SESSION['user']) && basename($_SERVER["PHP_SELF"]) != "login.php" && basename($_SERVER["PHP_SELF"]) != "maintenance.php") {
	    header("Location: ".$pwd."login.php");
        //header("Location: maintenance.php");
	}
    if(!isset($pageTitle)){
        $pageTitle = "Intranet Association Revivre";
    }
?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link rel="stylesheet" type="text/css" href="<?php echo $pwd; ?>css/index.css">
		<link rel="stylesheet" type="text/css" href="<?php echo $pwd; ?>css/drop.css">
		<link rel="stylesheet" type="text/css" href="<?php echo $pwd; ?>css/table.css">
		<link rel="stylesheet" type="text/css" href="<?php echo $pwd; ?>css/alpha.css">
		<link rel="stylesheet" type="text/css" href="<?php echo $pwd; ?>css/planning.css">
		<link rel="stylesheet" type="text/css" href="<?php echo $pwd; ?>css/repertoire.css">
		<link rel="stylesheet" type="text/css" href="<?php echo $pwd; ?>css/jquery-ui.min.css">
		<link rel="stylesheet" type="text/css" href="<?php echo $pwd; ?>css/jquery-ui.structure.min.css">
		<link rel="stylesheet" type="text/css" href="<?php echo $pwd; ?>css/jquery-ui.theme.min.css">
		<link rel="icon" href="<?php echo $pwd; ?>images/favicon1.png" sizes="16x16"/>
		<link rel="icon" href="<?php echo $pwd; ?>images/favicon1.ico" sizes="16x16"/>
		<link rel="stylesheet" type="text/css" href="<?php echo $pwd; ?>css/tooltipster.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo $pwd; ?>css/morris-0.5.1.css">
        <script type="text/javascript" src="<?php echo $pwd; ?>js/jquery.min.js"></script>
    	<script type="text/javascript" src="<?php echo $pwd; ?>js/jquery.tooltipster.min.js"></script>
    	<script type="text/javascript" src="<?php echo $pwd; ?>js/jquery-redirect.min.js"></script>
    	<script type="text/javascript" src="<?php echo $pwd; ?>js/assets.js"></script>
        <script type="text/javascript" src="<?php echo $pwd; ?>js/angular.min.js"></script>
    	<script type="text/javascript" src="<?php echo $pwd; ?>js/raphael-min.js"></script>
<!--     	<script type="text/javascript" src="<?php echo $pwd; ?>js/morris-0.5.1.min.js"></script> -->
    	<script type="text/javascript" src="<?php echo $pwd; ?>js/jquery-ui.min.js"></script>
    	<script type="text/javascript" src="<?php echo $pwd; ?>js/sorttable.js"></script>
		<title><?php echo $pageTitle; ?></title>
		<!-- 
			V. Durand | A. Freret | P. Friboulet | J. Le Bas | IUT Caen - DUT Info (2013-2015)
			P. Jourdain | F. Duval | C. Cosseron | B. Lemaitre | IUT Caen - DUT Info (2015-2016)
		-->
	</head>
	<body>
		<div id="wrapper">
			<div id="entete">
				<a href="<?php echo $pwd; ?>home.php"><img id="logoAssos" src="<?php echo $pwd; ?>images/logo_small.png"></a>
				<nav id="header-menu">
					<ul>
						<li id="champs"><a href="<?php echo $pwd; ?>home.php">Accueil</a></li>
						<li id="champs">
							<span class="item-title">Répertoire<span>&#9662;</span></span>
							<ul class="sub-menu">
								<li><a href="#">Salariés<span>&#9656;</span></a>
									<ul class="sub-menu">
                                        <li><a href="<?php echo $pwd; ?>repertoire/salaries/addSalarie.php">Ajouter un salarié</a></li>
                                        <li><a href="<?php echo $pwd; ?>repertoire/salaries/listSalaries.php">Liste des salariés</a></li>
									</ul>
								</li>
								<li><a href="#">Contacts<span>&#9656;</span></a>
									<ul class="sub-menu">
                                        <li><a href="<?php echo $pwd; ?>repertoire/contacts/addContact.php">Ajouter un contact</a></li>
                                        <li><a href="<?php echo $pwd; ?>repertoire/contacts/listContacts.php">Liste des contacts</a></li>
									</ul>
								</li>
								<li><a href="<?php echo $pwd; ?>repertoire/salaries/referents/listReferents.php">Référents</a></li>
                                <li>
                                	<a href="#">Administratif<span>&#9656;</span></a>
                                    <ul class="sub-menu">
                                        <li><a href="<?php echo $pwd; ?>repertoire/administratif/convention.php">Conventions</a></li>
                                        <li><a href="<?php echo $pwd; ?>repertoire/administratif/logoProperties.php">Logos</a></li>
                                        <li><a href="<?php echo $pwd; ?>repertoire/administratif/sorties.php">Type de sorties</a></li>
                                        <li><a href="<?php echo $pwd; ?>repertoire/administratif/prescripteurs.php">Prescripteurs</a></li>
                                    </ul>
                                </li>
                			</ul>
						</li>
						<li id="champs">
							<span class="item-title">Plannings<span>&#9662;</span></span>
							<ul class="sub-menu">
                       			<li><a href="<?php echo $pwd; ?>planning/planningShowcase.php">Gestion des plannings</a></li>
								<li><a href="<?php echo $pwd; ?>planning/emargement/homeEmargement.php">Gestion de l'émargement</a></li>
                			</ul>
						</li>
						<li id="champs"><a href="<?php echo $pwd; ?>chantier/homeWork.php">Chantiers<span>&#9662;</span></a>
							<ul class="sub-menu">
                       			<li><a href="<?php echo $pwd; ?>chantier/addWork.php">Ajouter chantier</a></li>
                                <li><a href="<?php echo $pwd; ?>chantier/awaitingWorks.php">Chantiers en attente</a></li>
								<li><a href="<?php echo $pwd; ?>chantier/ongoingWorks.php">Chantiers en cours</a></li>
                                <li><a href="<?php echo $pwd; ?>chantier/suiviEnc.php">Suivi chantiers</a></li>
                			</ul>
						</li>
						<li id="champs"><a href="<?php echo $pwd; ?>homeRent.php">Vehicules<span>&#9662;</span></a>
							<ul class="sub-menu">
                       			<li><a href="<?php echo $pwd; ?>carRent.php">Ajouter véhicules</a></li>
                        		<li><a href="<?php echo $pwd; ?>flatRent.php">Suivi vehicules</a></li>
							</ul>
        				</li>
        				<li id="champs"><a href="<?php echo $pwd; ?>homeRent.php">N@vette<span>&#9662;</span></a>
							<ul class="sub-menu">
                       			<li><a href="<?php echo $pwd; ?>carRent.php">Louer véhicules</a></li>
                        		<li><a href="<?php echo $pwd; ?>flatRent.php">Suivi vehicules</a></li>
							</ul>
        				</li>
						<li id="champs"><a href="<?php echo $pwd; ?>homeSupplier.php">Logements<span>&#9662;</span></a>
							<ul class="sub-menu">
                       			<li><a href="<?php echo $pwd; ?>addSupplier.php">Ajouter logement</a></li>
								<li><a href="<?php echo $pwd; ?>viewSuppliers.php">Liste logements</a></li>
                			</ul> 
                		</li>
						<li id="champs"><a href="<?php echo $pwd; ?>homeTool.php">Outillages<span>&#9662;</span></a>
							<ul class="sub-menu">
                       			<li><a href="<?php echo $pwd; ?>addTool.php">Ajouter outil</a></li>
								<li><a href="<?php echo $pwd; ?>viewTools.php">Liste outils</a></li>
                			</ul>
						</li>
					</ul>
				</nav>
				<?php
				if (isset($_SESSION["user"])) {
                ?>
		            <form action="<?php echo $pwd; ?>login.php" method="post" id="form-deco">
					    <input class="deco" id="deco" name="logout" type="submit" value="X">
					</form> 
				<?php
				}
				?>	
			</div>
		</div>
		<div id="debug"><a href="<?php echo $pwd; ?>debugger.php">Signaler<br>un Bug</a></div>