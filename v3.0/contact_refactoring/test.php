<?php
	$pageTitle = "Table Adapter";
	$pwd='../';
	include($pwd."bandeau.php");
?>
<div id="corps">
<?php
	$query1 = mysqli_query($db, "SELECT SAL_NumSalarie FROM salaries WHERE FCT_Id = 0 AND SAL_NumSalarie NOT IN (SELECT SAL_NumSalarie FROM insertion)");
	echo mysqli_num_rows($query1);

	while($d = mysqli_fetch_assoc($query1)){
		$query2 = mysqli_query($db, "INSERT INTO insertion (SAL_NumSalarie,
												INS_DateEntretien,
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
												VALUES (".$d["SAL_NumSalarie"].", '0000-00-00', '-', '-', 0, 0, '-', '-', 1, 1,'0000-00-00', 0, 0, '-', '-', '-', 0, 0, '-', '-', 103, 0)");

		if(mysqli_error($db) != ""){
			echo mysqli_error($db)."<br/><br/>";
		}
	}
	
?>
</div>
<?php
	include($pwd."footer.php");
?>