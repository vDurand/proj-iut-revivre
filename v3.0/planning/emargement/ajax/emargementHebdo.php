<?php
    session_set_cookie_params(0);
	session_start();
	include('../../../assets.php');
	$db = revivre();
	mysqli_query($db, "SET NAMES 'utf8'");
?>
<option value="0" disabled="disabled" selected="selected">Chosissez un encadrant</option>
<?php
	if(isset($_POST["date"]) && !empty($_POST["date"]) && isset($_POST["PL_id"]) && !empty($_POST["PL_id"]))
	{
		$query = mysqli_query($db, "SELECT DISTINCT pl.ENC_Num, pe.PER_Nom, pe.PER_Prenom FROM pl_association pl
									JOIN salaries sa ON pl.ENC_Num = sa.SAL_NumSalarie
									JOIN personnes pe ON pe.PER_NUM = sa.PER_NUM
									WHERE pl.PL_id = ".$_POST["PL_id"]." AND date_format(pl.ASSOC_date,'%d/%m/%Y') = '".$_POST["date"]."' ORDER BY pe.PER_Nom;");
		while($data = mysqli_fetch_assoc($query))
		{
			echo '<option value="'.$data["ENC_Num"].'">'.$data["PER_Nom"]." ".$data["PER_Prenom"].'</option>';
		}
	}
?>