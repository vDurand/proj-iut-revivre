// Liste detaillee par type de membre (bandeau)
	function submitListMember(value_p) 
	{ 
		document.forms['viewDetailMember'].TypeM.value = value_p; 
		document.forms['viewDetailMember'].submit(); 
	}

// Detail sur clic list (all table)
	function submitViewDetail(value_p, type) 
	{ 
		document.forms[type].NumC.value = value_p; 
		document.forms[type].submit(); 
	}
	
// Affiche/Masque formulaire specifique aux membres (addContact)
	function showMemberInput(elem)
	{
		if(elem.value > 1){
			document.getElementById('Contact-Fonction').style.display = "";
			document.getElementById('Contact-Particulier').style.display = "none";
            document.getElementById('Contact-Structure').style.display = "none";
            document.getElementById('Structure').value = "";
			document.getElementById('Contact-Prenom').style.display = "";
			document.getElementById("Prenom").setAttribute("required", "");
            document.getElementById("Nom").setAttribute("required", "");
		}
        if(elem.value == 1){
            document.getElementById('Contact-Fonction').style.display = "none";
            document.getElementById('Contact-Particulier').style.display = "none";
            document.getElementById('Contact-Structure').style.display = "none";
            document.getElementById('Structure').value = "";
            document.getElementById('Contact-Prenom').style.display = "none";
            document.getElementById('Contact-Prenom').value = "";
            document.getElementById('Prenom').value = "";
            document.getElementById("Prenom").removeAttribute("required");
        }
		if(elem.value == 0){
			document.getElementById('Contact-Fonction').style.display = "none";
			document.getElementById('Contact-Particulier').style.display = "";
            document.getElementById('Contact-Structure').style.display = "";
			document.getElementById('Contact-Prenom').style.display = "";
			document.getElementById('Prenom').value = ""; 
			document.getElementById("Prenom").removeAttribute("required");
            document.getElementById("Nom").removeAttribute("required");
		}
	}
	
// Affiche/Masque formulaire prenom si Structure/Particulier (addContact)
	function showStruct()
	{
	    if (document.getElementById('yesCheck').checked) {
	        document.getElementById('Contact-Prenom').style.display = "";
	        document.getElementById("Prenom").setAttribute("required", "");
            document.getElementById("Nom").setAttribute("required", "");
            document.getElementById('Contact-Structure').style.display = "none";
            document.getElementById('Structure').value = "";
	    } else {
	        document.getElementById('Contact-Prenom').style.display = "none";
            document.getElementById('Prenom').value = "";
	     	document.getElementById("Prenom").removeAttribute("required");
            document.getElementById("Nom").setAttribute("required", "");
            document.getElementById('Contact-Structure').style.display = "";
	    }
	}
	
// A/M form ajout responsable (detailChantier)
	function addResp()
	{
	  if(document.getElementById('Ajout-Resp').style.display == "none")
	    document.getElementById('Ajout-Resp').style.display = "";
	  else
	    document.getElementById('Ajout-Resp').style.display = "none";
	}

// A/M form ajout produit (detailFournisseur)
function addProd()
{
    if(document.getElementById('Ajout-Prod').style.display == "none")
        document.getElementById('Ajout-Prod').style.display = "";
    else
        document.getElementById('Ajout-Prod').style.display = "none";
}

// A/M form ajout tps travail (detailChantier)
	function addTps()
	{
	  var i = 1;
	  if(document.getElementById('Ajout-Tps').style.display == "none"){
	    document.getElementById('Ajout-Tps').style.display = "";
	    document.getElementById('Ajout-Tpss').style.display = "";
	  }
	  else{
	    document.getElementById('Ajout-Tps').style.display = "none";
	    document.getElementById('Ajout-Tpss').style.display = "none";
	  }
	  while (document.getElementById('Ajout-Tps'+i) != "") {
	  	if(document.getElementById('Ajout-Tps'+i).style.display == "none"){
	  	  document.getElementById('Ajout-Tps'+i).style.display = "";
	  	  document.getElementById('Ajout-Tpss'+i).style.display = "";
	  	}
	  	else{
	  	  document.getElementById('Ajout-Tps'+i).style.display = "none";
	  	  document.getElementById('Ajout-Tpss'+i).style.display = "none";
	  	}
	  	i++;
	  }
	  
	}
	
// A/M form changement etat (detailChantier)
	function changeEtat(elem)
	{
		if(document.getElementById('Chang-Etat').style.display == "none"){
		  document.getElementById('Chang-Etat').style.display = "";
		  if (elem == 3) {
		  	document.getElementById('Chang-Etat2').style.display = "";
		  	document.getElementById("DateFin").setAttribute("required", "");
		  }
		}
		else{
		  document.getElementById('Chang-Etat').style.display = "none";
		  if (elem == 3) {
		  	document.getElementById('Chang-Etat2').style.display = "none";
		  	document.getElementById("DateFin").removeAttribute("required");
		  }
		}
	}
	
// A/M form ajout date fin si etat fini (detailChantier)
	function showFin(elem)
	{
		if(elem.value == 4){
			document.getElementById('Chang-Etat2').style.display = "";
			document.getElementById("DateFin").setAttribute("required", "");
		}
		else {
			document.getElementById('Chang-Etat2').style.display = "none";
			document.getElementById('DateFin').value = "";
			document.getElementById("DateFin").removeAttribute("required");
		}
	}
// A/M creation nouveau produit
	function showNewProd()
	{
	    if (document.getElementById('yesCheck').checked) {
	        document.getElementById('ProdCreator').style.display = "";
	        document.getElementById('ProdSelector').style.display = "none";
	        document.getElementById('ProduitExistant').value = ""; 
	        document.getElementById("RefProd").setAttribute("required", "");
	        document.getElementById("FournProd").setAttribute("required", "");
	        document.getElementById("NomProd").setAttribute("required", "");
	        document.getElementById("PriceProd").setAttribute("required", "");
	        document.getElementById("CondProd").setAttribute("required", "");
	    } else {
	        document.getElementById('ProdCreator').style.display = "none";
	        document.getElementById('ProdSelector').style.display = "";
	     	document.getElementById('NomProd').value = "";  
	     	document.getElementById('RefProd').value = "";  
	     	document.getElementById('CondProd').value = "";  
	     	document.getElementById('PriceProd').value = ""; 
	     	document.getElementById("RefProd").removeAttribute("required");
	     	document.getElementById("NomProd").removeAttribute("required");
	     	document.getElementById("FournProd").removeAttribute("required");
	     	document.getElementById("PriceProd").removeAttribute("required");
	     	document.getElementById("CondProd").removeAttribute("required");
	    }
	}