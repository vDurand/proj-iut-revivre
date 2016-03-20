<?php
    $pageTitle = "Édition d'un salarie";
	$pwd = "../../";
	include($pwd.'bandeau.php');
?>
<div id="corps">
	<div id="labelT">
		<label><?php echo $_POST["Head_Title"]; ?></label>
	</div>
<?php
    $query_type = mysqli_query($db, "SELECT TYP_Id, TYP_Nom FROM type WHERE TYP_Nom IN ('Stagiaire', 'Salarié en Insertion', 'Atelier Occupationnel');");
    $typeSalarie = mysqli_fetch_all($query_type, MYSQLI_ASSOC);
    $specialSalarie = in_assoc_array_by_key($_POST["TYP_Id"], $typeSalarie, "TYP_Id");
    $fonction = false;

    if(isset($_POST["SAL_NumSalarie"]) && !empty($_POST["SAL_NumSalarie"]) && !isset($_POST["Post_Errors"])){
        $num = $_POST["SAL_NumSalarie"];
        
        $query = mysqli_query($db, "SELECT * FROM salaries WHERE SAL_NumSalarie='$num' ORDER BY PER_Num");
        $personne = mysqli_fetch_assoc($query);
        
        if($personne){
            if($personne["FCT_Id"] == 0){ // travailleurs
                $query = mysqli_query($db, "SELECT * FROM personnes
                                                JOIN salaries USING(PER_Num)
                                                JOIN insertion USING(SAL_NumSalarie)
                                                JOIN referents USING(REF_NumRef)
                                                WHERE SAL_NumSalarie='$num'
                                                ORDER BY PER_Nom");
            }
            else{ // salaries
                $query = mysqli_query($db, "SELECT * from personnes
                                                JOIN salaries USING (PER_Num)
                                                JOIN fonction USING (FCT_Id)
                                                WHERE SAL_NumSalarie='$num'
                                                ORDER BY PER_Nom");
            }
            $personne = mysqli_fetch_assoc($query);

            if($personne["PER_Sexe"] == 1){
                $sexe = 'M.';
                $personne["PER_Sexe"] = "true";
            }
            else{
                $sexe = 'Mme';
                $personne["PER_Sexe"] = "false";
            }
            if($personne["FCT_Id"] == 0){
                $personne["INS_Repas"] = ($personne["INS_Repas"] == "1") ? "true" : "false";
                $personne["INS_TRepas"] = ($personne["INS_TRepas"] == "1") ? "true" : "false";
            }
        }
    }
    else if(isset($_POST["Post_Errors"]) && !empty($_POST["Post_Errors"])){
        include_once("includes/form_errors.php");
        foreach ($_POST as $key => $value){
            $personne[$key] = $value;
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

	echo '<input type="hidden" id="request_type" name="request_type" value="'.$_POST["request_type"].'"/>
        <input type="hidden" id="TYP_Id" name="TYP_Id" value="'.$_POST["TYP_Id"].'"/>
        <div class="repertoire-manage-buttons">';

    if(isset($_POST["SAL_NumSalarie"]) && !empty($_POST["SAL_NumSalarie"])){
        echo '<input type="hidden" id="SAL_NumSalarie" name="SAL_NumSalarie" value="'.$_POST["SAL_NumSalarie"].'"/><input type="button" value="Annuler" class="buttonC" onclick="$.redirect(\'./showSalarie.php\', {\'SalNum\':'.$_POST["SAL_NumSalarie"].'}, \'get\');"/>';
    }
    else{
        echo '<input type="button" value="Annuler" class="buttonC" onclick="$.redirect(\''.$pwd.'home.php\');"/>';
    }

	echo '&#32;<input type="submit" value="Valider" class="buttonC"/>
	  	</div>
	</form>';
?>
</div>
<?php
	include($pwd.'footer.php');
?>