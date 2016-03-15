<?php
	$pwd = "../../";
	include($pwd.'bandeau.php');
?>
<div id="corps">
	<div id="labelT">
		<label><?php echo $_POST["Head_Title"]; ?></label>
	</div>
<?php

	$num = $_POST["SAL_NumSalarie"];

	$query_type = mysqli_query($db, "SELECT TYP_Id, TYP_Nom FROM type WHERE TYP_Nom IN ('Stagiaire', 'Salarié en Insertion', 'Atelier Occupationnel');");
	$typeSalarie = mysqli_fetch_all($query_type, MYSQLI_ASSOC);
	$specialSalarie = in_assoc_array_by_key($_POST["TYP_Id"], $typeSalarie, "TYP_Id");
	$fonction = false;

	if(isset($_POST["Post_Errors"]) && !empty($_POST["Post_Errors"])){
		include_once("includes/form_errors.php");
	}

	$reponse1 = mysqli_query($db, "SELECT * FROM salaries WHERE SAL_NumSalarie='$num' ORDER BY PER_Num");
    $personne = mysqli_fetch_assoc($reponse1);
    
    if($personne){
    // différence entre salaries et travailleurs
        if($personne["FCT_Id"] == 0){ // travailleurs
            $reponse1 = mysqli_query($db, "SELECT * from personnes
                                            JOIN salaries using (PER_Num)
                                            JOIN insertion using (SAL_NumSalarie)
                                            WHERE SAL_NumSalarie='$num'
                                            ORDER BY PER_Nom");
        }
        else{ // salaries
            $reponse1 = mysqli_query($db, "SELECT * from personnes
                                            JOIN salaries using (PER_Num)
                                            JOIN fonction using (FCT_Id)
                                            WHERE SAL_NumSalarie='$num'
                                            ORDER BY PER_Nom");
        }
        $personne = mysqli_fetch_assoc($reponse1);

        $travailleur = mysqli_num_rows(mysqli_query($db, "SELECT * from Insertion where SAL_NumSalarie = ".$personne["SAL_NumSalarie"]));
        
        if($travailleur > 0){
            // récupération du nom du type de sortie
            $numSortie = $personne['TYS_ID'];
            $reponse0 = mysqli_query($db, "SELECT * FROM TypeSortie WHERE TYS_ID='$numSortie' ORDER BY TYS_Libelle");
            $typeSortie = mysqli_fetch_assoc($reponse0);

            // récupération du nom de convention
            $numConv = $personne['CNV_Id'];
            $reponse2 = mysqli_query($db, "SELECT * FROM Convention WHERE CNV_Id='$numConv' ORDER BY CNV_Nom");
            $convention = mysqli_fetch_assoc($reponse2);

            //récupération du nom de contrat
            $numContrat = $personne['CNT_Id'];
            $reponse3 = mysqli_query($db, "SELECT CNT_Nom FROM Contrat WHERE CNT_Id='$numContrat' ORDER BY CNT_Nom");
            $contrat = mysqli_fetch_assoc($reponse3);

            // récupération du nom de référent et du prescripteur
            $numRef = $personne['REF_NumRef'];
            $reponse4 = mysqli_query($db, "SELECT * FROM Personnes JOIN Referents USING (PER_Num) JOIN Prescripteurs USING (PRE_Id) WHERE PER_Num in (SELECT PER_Num FROM Referents WHERE REF_NumRef='$numRef')");
            $referent = mysqli_fetch_assoc($reponse4);

            // récupération du nom de type de salarie
            $numType = $personne['TYP_Id'];
            $reponse5 = mysqli_query($db, "SELECT * FROM Type WHERE TYP_Id='$numType'");
            $type = mysqli_fetch_assoc($reponse5);

            $query_contrat = mysqli_query($db, "SELECT TYP_Id, TYP_Nom FROM type WHERE TYP_Id NOT IN (SELECT TYP_Id FROM salaries WHERE SAL_NumSalarie = ".$num.") 
                                            AND TYP_Nom <> 'Salarié' ORDER BY TYP_Id;");
        }

        // récupération du numéro de fonction (si existe)
        $numfonction = $personne["FCT_Id"];
        $reponse6 = mysqli_query($db, "SELECT FCT_Nom from fonction where FCT_Id in (SELECT FCT_ID from salaries where PER_num = ".$num.")");
        $fonction = mysqli_fetch_assoc($reponse6);

        // pré-traitement pour affichage

        // Monsieur, Madame
        if ($personne["PER_Sexe"] == 1){
            $sexe = 'M.';
        }
        else{
            $sexe = 'Mme';
        }
    }

	echo '<form method="POST" action="postSalarie.php">';

	if($specialSalarie){
		include_once("includes/form_date.php");
	}
	else{
		$fonction = true;
	}

	include_once("includes/form_civil.php");

	if($specialSalarie){
		include_once("includes/form_emergency.php");
		include_once("includes/form_additional.php");
	}

	echo '<div align="center">
            <input type="hidden" id="request_type" name="request_type" value="edit"/>
            <input type="hidden" id="TYP_Id" name="TYP_Id" value="'.$_POST["TYP_Id"].'"/>
            <input type="hidden" id="SAL_NumSalarie" name="SAL_NumSalarie" value="'.$num.'"/>
			<input type="button" value="Annuler" class="buttonC" onclick="$.redirect(\''.$pwd.'home.php\')";>
			<input type="submit" value="Valider" class="buttonC">
	  	</div>
	</form>';
?>
</div>
<?php
	include($pwd.'footer.php');
?>