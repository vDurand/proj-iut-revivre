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
			document.getElementById('Contact-Fax').style.display = "none";
			document.getElementById('Contact-Particulier').style.display = "none";
			document.getElementById('Contact-Prenom').style.display = "";
		}
		if(elem.value < 2){
			document.getElementById('Contact-Fonction').style.display = "none";
			document.getElementById('Struct').value = ""; 
			document.getElementById('Contact-Fax').style.display = "";
			document.getElementById('Contact-Particulier').style.display = "";
			document.getElementById('Contact-Prenom').style.display = "none";
			document.getElementById('Prenom').value = ""; 
		}
	}
	
// Affiche/Masque formulaire prenom si Structure/Particulier (addContact)
	function showStruct()
	{
	    if (document.getElementById('yesCheck').checked) {
	        document.getElementById('Contact-Prenom').style.display = "";
	    } else {
	        document.getElementById('Contact-Prenom').style.display = "none";
	     	document.getElementById('Prenom').value = "";   
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
	function changeEtat()
	{
		if(document.getElementById('Chang-Etat').style.display == "none")
		  document.getElementById('Chang-Etat').style.display = "";
		else
		  document.getElementById('Chang-Etat').style.display = "none";
	}
	
// A/M form ajout date fin si etat fini (detailChantier)
	function showFin(elem)
	{
		if(elem.value == 4){
			document.getElementById('Chang-Etat2').style.display = "";
		}
		else {
			document.getElementById('Chang-Etat2').style.display = "none";
			document.getElementById('DateFin').value = "";
		}
	}