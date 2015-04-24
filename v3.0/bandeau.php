<?php  
	include('assets.php');
    session_set_cookie_params(0);
	 session_start();
	 date_default_timezone_set('Europe/Paris');
	 if (!isset($_SESSION['user']) && basename($_SERVER["PHP_SELF"]) != "login.php" && basename($_SERVER["PHP_SELF"]) != "maintenance.php") {
	     header("Location: ".$pwd."login.php");
         //header("Location: maintenance.php");
	 }
    if(!isset($pageTitle)){
        $pageTitle = "Intranet association Revivre";
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
<?php
	$i=rand(1,2);
	if($i==1){
		echo '<link rel="icon" href="'.$pwd.'images/favicon2.png" sizes="16x16"/>
		<link rel="icon" href="'.$pwd.'images/favicon2.ico" sizes="16x16"/>';
	}
	else{
		echo '<link rel="icon" href="'.$pwd.'images/favicon1.png" sizes="16x16"/>
		<link rel="icon" href="'.$pwd.'images/favicon1.ico" sizes="16x16"/>';
	}
?>
		<link rel="stylesheet" type="text/css" href="<?php echo $pwd; ?>css/tooltipster.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo $pwd; ?>css/morris-0.5.1.css">
        <script type="text/javascript" src="<?php echo $pwd; ?>js/jquery.min.js"></script>
    	<script type="text/javascript" src="<?php echo $pwd; ?>js/jquery.tooltipster.min.js"></script>
    	<script type="text/javascript" src="<?php echo $pwd; ?>js/assets.js"></script>
        <script type="text/javascript" src="<?php echo $pwd; ?>js/angular.min.js"></script>
    	<script type="text/javascript" src="<?php echo $pwd; ?>js/raphael-min.js"></script>
    	<script type="text/javascript" src="<?php echo $pwd; ?>js/morris-0.5.1.min.js"></script>
		<title><?php echo $pageTitle; ?></title>
		<!-- V. Durand | A. Freret | P. Friboulet | J. Le Bas | IUT Caen - DUT Info (2013-2015) -->
	</head>

	<body>
		<div id="wrapper" background-color="white">
			<div id="entete">
				<a href="<?php echo $pwd; ?>home.php"><img id="logoAssos" src="<?php echo $pwd; ?>images/logo_small.png"></a>
				<div id="navi">
					<nav>
						<ul class="bandeau">
							<li id="champs"><a href="<?php echo $pwd; ?>home.php">Accueil</a></li>
							<li id="champs"><a href="<?php echo $pwd; ?>contact/homeContact.php">Répertoire</a>
								<ul class="subMenu">
                                    <li><a href="<?php echo $pwd; ?>contact/addInsertion.php">Ajouter<br>en Insertion</a></li>
									<li><a href="<?php echo $pwd; ?>contact/addContact.php">Ajouter<br>Contact</a></li>
	                       			<li><a href="<?php echo $pwd; ?>contact/client/viewClients.php">Clients<br>&nbsp;</a>
										<ul>
											<li><a href="<?php echo $pwd; ?>contact/client/viewClientPart.php">Particuliers</a></li>
											<li><a href="<?php echo $pwd; ?>contact/client/viewClientEnt.php">Structures</a></li>
                                            <li><a href="<?php echo $pwd; ?>contact/client/viewClientEmp.php">Contacts</a></li>
										</ul>
									</li>
									<li><a href="<?php echo $pwd; ?>contact/fournisseur/viewFourn.php">Fournisseurs<br>&nbsp;</a>
										<ul>
                                            <li><a href="<?php echo $pwd; ?>contact/fournisseur/viewFournEnt.php">Structures</a></li>
                                            <li><a href="<?php echo $pwd; ?>contact/fournisseur/viewFournEmp.php">Contacts</a></li>
										</ul>
									</li>
									<li><a href="<?php echo $pwd; ?>contact/membre/viewMembers.php">Membres de<br>l'association</a>
										<ul>
<?php
	$db = revivre();
	
	mysqli_query($db, "SET NAMES 'utf8'");
	$reponse = mysqli_query($db, "SELECT * FROM Type");
	
	while ($donnees = mysqli_fetch_assoc($reponse))
	{
?>
											<form method="post" action="<?php echo $pwd; ?>contact/membre/viewSal.php" name="viewDetailMember">
												<input type="hidden" name="TypeM" value="<?php echo $donnees['TYP_Id']; ?>">
				        						<li><a onclick="javascript:submitListMember('<?php echo $donnees['TYP_Id']; ?>');"><?php echo $donnees['TYP_Nom']; ?><br>&nbsp;</a></li>
				        					</form>
<?php
	}
	mysqli_free_result($reponse);
?>										
										</ul>
									</li>
                                    <li><a href="<?php echo $pwd; ?>contact/partenaire/viewPartenaires.php">Partenaires<br>&nbsp;</a>
                                        <ul>
                                            <li><a href="<?php echo $pwd; ?>contact/partenaire/viewRef.php">Référent<br>&nbsp;</a></li>
                                        </ul>
                                    </li>
	                			</ul>
							</li>
							<li id="champs"><a href="#">Plannings</a>
								<ul class="subMenu">
	                       			<li><a href="<?php echo $pwd; ?>planning/insertion/planning_insertion.php">Planning<br>ACI</a></li>
									<li><a href="<?php echo $pwd; ?>planning/occupationnel/planning_occupationnel.php">Planning<br>occupationnel</a></li>
									<li><a href="#">Planning<br>stagiaire</a></li>
	                			</ul>
							</li>
							<li id="champs"><a href="<?php echo $pwd; ?>chantier/homeWork.php">Chantiers</a>
								<ul class="subMenu">
	                       			<li><a href="<?php echo $pwd; ?>chantier/addWork.php">Ajouter<br>chantier</a></li>
                                    <li><a href="<?php echo $pwd; ?>chantier/awaitingWorks.php">Chantiers en attente</a></li>
									<li><a href="<?php echo $pwd; ?>chantier/ongoingWorks.php">Chantiers en cours</a></li>
									<li><a href="<?php echo $pwd; ?>chantier/oldWorks.php">Archive<br>chantiers</a></li>
                                    <li><a href="<?php echo $pwd; ?>chantier/suiviEnc.php">Suivi<br>chantiers</a></li>
	                			</ul>
							</li>
							<li id="champs"><a href="<?php echo $pwd; ?>homeRent.php">Vehicules</a>
	                			<ul class="subMenu">
	                       			<li><a href="<?php echo $pwd; ?>carRent.php">Ajouter<br>Véhicules</a></li>
	                        		<li><a href="<?php echo $pwd; ?>flatRent.php">Suivi<br>Vehicules</a></li>
	                			</ul>
	        				</li>
	        				<li id="champs"><a href="<?php echo $pwd; ?>homeRent.php">N@vette</a>
	                			<ul class="subMenu">
	                       			<li><a href="<?php echo $pwd; ?>carRent.php">Louer<br>Véhicules</a></li>
	                        		<li><a href="<?php echo $pwd; ?>flatRent.php">Suivi<br>Vehicules</a></li>
	                			</ul>
	        				</li>
							<li id="champs"><a href="<?php echo $pwd; ?>homeSupplier.php">Logements</a>
								<ul class="subMenu">
	                       			<li><a href="<?php echo $pwd; ?>addSupplier.php">Ajouter<br>logement</a></li>
									<li><a href="<?php echo $pwd; ?>viewSuppliers.php">Liste<br>logements</a></li>
	                			</ul>
	                		</li>
							<li id="champs"><a href="<?php echo $pwd; ?>homeTool.php">Outillages </a>
								<ul class="subMenu">
	                       			<li><a href="<?php echo $pwd; ?>addTool.php">Ajouter<br>outil</a></li>
									<li><a href="<?php echo $pwd; ?>viewTools.php">Liste<br>outils</a></li>
	                			</ul>
							</li>
							<!--<li id="champs"><a href="<?php echo $pwd; ?>homeMeal.php">Restauration</a>
								<ul class="subMenu">
	                       			<li><a href="<?php echo $pwd; ?>addMeal.php">Ajouter<br>repas</a></li>
									<li><a href="<?php echo $pwd; ?>viewMeals.php">Archive<br>commandes</a></li>
	                			</ul>
							</li>-->
						</ul>
						<?php
						if (isset($_SESSION["user"])) {
                        ?>
						            <form action="<?php echo $pwd; ?>login.php" method="post">
						                <input class="deco" id="deco" name="logout" type="submit" value="X">
						            </form>
                            <?php if($_SESSION ["user"] == "admin"){
                            ?>
                            <a class="deco2" id="deco2" href="<?php echo $pwd; ?>adminLand.php">Administration</a>
						            <?php
                            }
						}
						?>	
					</nav>
				</div>
			</div>
		</div>
		<div id="debug"><a href="<?php echo $pwd; ?>debugger.php">Signaler<br>un Bug</a></div>
		<?php //echo session_cache_expire(); ?>