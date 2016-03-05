<?php
	$pageTitle = "Metaquerier";
	$pwd='../';
	include($pwd."bandeau.php");
?>
<div id="corps">
<?php
	$query = mysqli_query($db, "SELECT concat('INSERT INTO `cursus`(`CUR_Date`, `Sal_NumSalarie`, `TYP_Id`, `CUR_Comment`) VALUES (''',INS_DateEntree,''',',SAL_NumSalarie,',',TYP_Id,',''Entrée dans l\\\\''association'');') as query FROM salaries JOIN insertion USING(SAL_NumSalarie) ORDER BY SAL_NumSalarie");

	while($data = mysqli_fetch_assoc($query)){
		echo $data["query"]."<br/>";
	}
?>
</div>
<?php
	include($pwd."footer.php");
?>