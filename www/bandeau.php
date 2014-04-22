	<html>
	<head>

		<link rel="stylesheet" type="text/css" href="css/index.css">
		<title>Intranet association Revivre</title>
		
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>

		<script type="text/javascript">
		$(document).ready( function () {
			// On cache les sous-menus :
			$(".bandeau ul.subMenu").hide();
			// On sélectionne tous les items de liste portant la classe "toggleSubMenu"

			// et on remplace l'élément span qu'ils contiennent par un lien :
			$(".bandeau li.toggleSubMenu span").each( function () {
				// On stocke le contenu du span :
				var TexteSpan = $(this).text();
				$(this).replaceWith('<a href="" title="Afficher le sous-menu">' + TexteSpan + '<\/a>') ;
			} ) ;

			// On modifie l'évènement "click" sur les liens dans les items de liste
			// qui portent la classe "toggleSubMenu" :
			$(".bandeau li.toggleSubMenu > a").click( function () {
				// Si le sous-menu était déjà ouvert, on le referme :
				if ($(this).next("ul.subMenu:visible").length != 0) {
					$(this).next("ul.subMenu").slideUp("normal");
				}
				// Si le sous-menu est caché, on ferme les autres et on l'affiche :
				else {
					$(".bandeau ul.subMenu").slideUp("normal");
					$(this).next("ul.subMenu").slideDown("normal");
				}
				// On empêche le navigateur de suivre le lien :
				return false;
			});    


		} ) ;
		</script>
	</head>


	<body>
		<div id="wrapper" background-color="white">
			
			<div id="entete">
				<a href="#"><img src="image/logo.jpg"></a>
				
				<div id="navi">
					<ul class="bandeau">
						<li>
							<a href="#">Accueil </a>
						</li>

						<li>
							<a href="#">Fournisseurs </a>
						</li>

						<li class="toggleSubMenu"><span>Clients</span>
							<ul class="subMenu">
                       			<ul><a href="addClient.php">Ajouter un client</a></li>
									<a href="viewClients.php">Liste des clients</a></li></ul>
                			</ul>
						</li>

						<li class="toggleSubMenu"><span>Chantiers</span>
							<ul class="subMenu">
                       			<ul><a href="#">Ajouter un chantier</a></li>
									<a href="#">Liste des chantiers en cours</a></li>
									<a href="#">Archive des chantiers</a></li></ul>
                			</ul>
						</li>
						<li class="toggleSubMenu"><span>Locations</span>
                			<ul class="subMenu">
                       			<ul><a href="#">Véhicules</a></li>
                        		<li><a href="#">Appartement</a></li></ul>
                			</ul>
        				</li>
						<li>
							<a href="#">Encadrants </a>
						</li>
						<li>
							<a href="#">Outillages </a>
						</li>
					</ul>	
				</div>
			</div>
		</div>
	</body>
</html>