<?php
	$pageTitle = "Table Adapter";
	$pwd='../';
	include($pwd."bandeau.php");
?>
<div id="corps">
<?php
	//mysqli_query($db, 'SET autocommit=0;');
	//mysqli_query($db, 'START TRANSACTION;');

	$query1 = mysqli_query($db, "SELECT *, '1' AS typePer FROM personnes 
								WHERE PER_Num IN (SELECT PER_Num FROM personnes JOIN salaries USING(PER_Num) JOIN insertion USING(SAL_NumSalarie)) 
								UNION
								SELECT *, '2' AS typePer FROM personnes 
								WHERE PER_Num NOT IN (SELECT PER_Num FROM personnes JOIN salaries USING(PER_Num) JOIN insertion USING(SAL_NumSalarie)) AND PER_Num IN (SELECT PER_Num FROM personnes JOIN salaries USING(PER_Num))
								UNION
								SELECT *, '3' AS typePer FROM personnes 
								WHERE PER_Num NOT IN (SELECT PER_Num FROM personnes JOIN salaries USING(PER_Num))
								ORDER BY PER_NUM");
	echo mysqli_num_rows($query1)." Lignes au total<br/>";

	while($d = mysqli_fetch_assoc($query1)){
		if($d["typePer"] == "1"){
			$query2 = mysqli_query($db, "SELECT * FROM personnes JOIN salaries USING(PER_Num) JOIN insertion USING(SAL_NumSalarie) WHERE PER_Num = ".$d["PER_Num"]);
			$da = mysqli_fetch_array($query2, MYSQLI_ASSOC);
		}
		else if($d["typePer"] == "2"){
			$query2 = mysqli_query($db, "SELECT * FROM personnes JOIN salaries USING(PER_Num) WHERE PER_Num = ".$d["PER_Num"]);
			$da = mysqli_fetch_array($query2, MYSQLI_ASSOC);
		}

		$query3 = mysqli_query($db, "INSERT INTO personnes2 
											(PER_Num,
											PER_Nom,
											PER_Prenom,
											PER_TelFixe,
											PER_TelPort,
											PER_Fax,
											PER_Email,
											PER_Adresse,
											PER_CodePostal,
											PER_Ville,
											PER_DateN,
											PER_LieuN,
											PER_Nation,
											PER_NPoleEmp,
											PER_NSecu,
											PER_NCaf) 
									VALUES ('".$d["PER_Num"]."',
											'".addslashes($d["PER_Nom"])."',
											'".addslashes($d["PER_Prenom"])."',
											'".$d["PER_TelFixe"]."',
											'".$d["PER_TelPort"]."',
											'".$d["PER_Fax"]."',
											'".$d["PER_Email"]."',
											'".addslashes($d["PER_Adresse"])."',
											'".$d["PER_CodePostal"]."',
											'".addslashes($d["PER_Ville"])."',
											'".((isset($da["INS_DateN"])) ? $da["INS_DateN"] : NULL)."',
											'".((isset($da["INS_LieuN"])) ? addslashes($da["INS_LieuN"]) : NULL)."',
											'".((isset($da["INS_Nation"])) ? addslashes($da["INS_Nation"]) : NULL)."',
											'".((isset($da["INS_NPoleEmp"])) ? $da["INS_NPoleEmp"] : NULL)."',
											'".((isset($da["INS_NSecu"])) ? $da["INS_NSecu"] : NULL)."',
											'".((isset($da["INS_NCaf"])) ? $da["INS_NCaf"] : NULL)."');"
								);

		if($d["typePer"] == "1" || $d["typePer"] == "2"){
			$query4 = mysqli_query($db, "INSERT INTO salaries2 
												(SAL_NumSalarie,
												PER_Num,
												TYP_Id,
												SAL_Actif,
												FCT_Id,
												SAL_DateSortie)
										VALUES ('".$da["SAL_NumSalarie"]."',
												'".$d["PER_Num"]."',
												'".$da["TYP_Id"]."',
												'".((isset($da["INS_DateSortie"]) && (!empty($da["INS_DateSortie"]) && $da["INS_DateSortie"] != "0000-00-00")) ? 0 : 1)."',
												'".$da["FCT_Id"]."',
												'".((isset($da["INS_DateSortie"])) ? $da["INS_DateSortie"] : "")."');"
									);
		}

		if($d["typePer"] == "1"){
			$query5 = mysqli_query($db, "INSERT INTO insertion2 
												(SAL_NumSalarie,
												INS_DateEntretien,
												INS_SituationF,
												INS_NivScol,
												INS_Diplome,
												INS_Permis,
												INS_RecoTH,
												INS_Revenu,
												INS_Mutuelle,
												CNV_Id,
												CNT_Id,
												INS_DateEntree,
												INS_NbHeures,
												INS_NbJours,
												INS_RevenuDepuis,
												INS_SEDepuis,
												INS_PEDepuis,
												INS_Repas,
												INS_TRepas,
												INS_Positionmt,
												INS_SituGeo,
												REF_NumRef,
												TYS_ID) 
										VALUES (".$da["SAL_NumSalarie"].",
												'".$da["INS_DateEntretien"]."',
												'".addslashes($da["INS_SituationF"])."',
												'".addslashes($da["INS_NivScol"])."',
												'".addslashes($da["INS_Diplome"])."',
												".(($da["INS_Permis"] == "") ? 0 : 1).",
												".(($da["INS_RecoTH"] == "") ? 0 : 1).",
												'".addslashes($da["INS_Revenu"])."',
												'".addslashes($da["INS_Mutuelle"])."',
												".$da["CNV_Id"].",
												".$da["CNT_Id"].",
												'".(($da["INS_DateEntree"] == "") ? '2015-01-01' : $da["INS_DateEntree"])."',
												".(($da["INS_NbHeures"] == "") ? 0 : $da["INS_NbHeures"]).",
												".(($da["INS_NbJours"] == "") ? 0 : $da["INS_NbJours"]).",
												'".addslashes($da["INS_RevenuDepuis"])."',
												'".addslashes($da["INS_SEDepuis"])."',
												'".addslashes($da["INS_PEDupuis"])."',
												0,
												1,
												'".addslashes($da["INS_Positionmt"])."',
												'".addslashes($da["INS_SituGeo"])."',
												".$da["REF_NumRef"].",
												".$da["TYS_ID"].");"
									);
		}
		if(mysqli_error($db) != ""){
			echo mysqli_error($db)."<br/><br/>";
		}
	}
	echo mysqli_num_rows($query1)." Lignes au total<br/>";

	$query1 = mysqli_query($db, "SELECT SAL_NumSalarie FROM salaries2 WHERE FCT_Id = 0 AND SAL_NumSalarie NOT IN (SELECT SAL_NumSalarie FROM insertion2)");
	while($d = mysqli_fetch_assoc($query1)){
		$query2 = mysqli_query($db, "INSERT INTO insertion2 (SAL_NumSalarie,
												INS_DateEntretien,
												INS_SituationF,
												INS_NivScol,
												INS_Diplome,
												INS_Permis,
												INS_RecoTH,
												INS_Revenu,
												INS_Mutuelle,
												CNV_Id,
												CNT_Id,
												INS_DateEntree,
												INS_NbHeures,
												INS_NbJours,
												INS_RevenuDepuis,
												INS_SEDepuis,
												INS_PEDepuis,
												INS_Repas,
												INS_TRepas,
												INS_Positionmt,
												INS_SituGeo,
												REF_NumRef,
												TYS_ID)
												VALUES (".$d["SAL_NumSalarie"].", '0000-00-00', '-', '-', 0, 0, '-', '-', 1, 1,'0000-00-00', 0, 0, '-', '-', '-', 0, 0, '-', '-', 1, 0)");
	}
	
?>
</div>
<?php
	include($pwd."footer.php");
?>