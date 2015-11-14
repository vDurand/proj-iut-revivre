
<?php
    session_set_cookie_params(0);
	session_start();
	include('../../../assets.php');
	$db = revivre();
	 mysqli_query($db, "SET NAMES 'utf8'");
?>
<option value="0" disabled="disabled" selected="selected">Choisissez un salarié</option>
<?php
	if(isset($_POST["mois"]) && !empty($_POST["mois"]) && isset($_POST["type"]) && !empty($_POST["type"]) && isset($_POST["annee"]) && !empty($_POST["annee"]))
	{
		$req = "SELECT DISTINCT sa.SAL_NumSalarie, PER_Nom, PER_Prenom FROM pl_association pl
									JOIN salaries sa ON sa.SAL_NumSalarie = pl.SAL_NumSalarie
									JOIN personnes USING (PER_Num)
									JOIN type USING (TYP_Id)
									WHERE date_format(pl.ASSOC_date,'%m/%Y') = '".$_POST["mois"]."/".$_POST["annee"]."' AND TYP_Id = ".$_POST["type"]." ORDER BY PER_Nom;";

		echo $req;

		$query = mysqli_query($db, $req);
		while($data = mysqli_fetch_assoc($query))
		{
			echo '<option value="'.$data["SAL_NumSalarie"].'">'.$data["PER_Nom"]." ".$data["PER_Prenom"].'</option>';
		}
	}
?>