<?php
	$pageTitle = "Conventions";
	$pwd='../';
	include($pwd."bandeau.php");
	$arrayElements = Array();
?>
<div id="corps">
	<form>
		<table style="margin:10px auto 0 auto;" id="tableConvention">
			<?php
				$x=$max=0;
				$flag = false;
				$query = mysqli_query($db,"SELECT CNV_Id, CNV_Nom AS 'nom', CNV_Couleur as 'couleur' FROM convention WHERE CNV_Actif=true ORDER BY CNV_Id;");
				while($data = mysqli_fetch_assoc($query))
				{
					$max = ($data["CNV_Id"] > $max) ? $data["CNV_Id"] : $max; 
					echo '<tr id="tr'.$x.'">
					<td><input type="text" id="nom'.$x.'" name="nom'.$x.'" style="color:'.$data["couleur"].';text-transform:uppercase;" value="'.$data["nom"].'" onchange="changeNom()"/></td>
					<td><input name="coul'.$x.'" id="coul'.$x.'" type="color" value="'.$data["couleur"].'" onchange="changeCouleur('.$x.')"/></td>
					<td><input name="suppr" type="button" class="delCross" value="x" onclick="delConvention('.$x.')"/></td>
					</tr>';
					
					$arrayElements[$x++] = Array((int)($data["CNV_Id"]),0);
				}
			?>
		</table>
		<table style="margin:10px auto 0 auto;">
			<tr>
				<td>
					<input name="nouvConv" id="NouvConv" type="button" class="buttonC" value="Nouvelle Conv" onclick="addConvention()">
					<input name="cancel" id="cancel" type="button" class="buttonC" value="Annuler" disabled="disabled" onclick="if(confirm('Etes-vous sûr de vouloir annuler ?')){window.location.replace('./convention.php');}">
				</td>
				<td><input name="validConv" type="button" class="buttonC" value="Sauvegarder" onclick="postData()"></td>
			</tr>
		</table>
	</form>
	<form method="post" action="./post_convention.php" name="valid_convention" id="valid_convention">
		<input type='hidden' id="Tableau" name='Tableau' value=''>
		<input type='hidden' id="redirectPage" name='redirectPage' value="./convention.php">
	</form>
</div>

<script type="text/javascript">
	<?php
		$js_array = json_encode($arrayElements);
		echo "var tableau = ".$js_array.";
		var maxi = ".($max+1).";";
		
	?>
	
	function changeNom()
	{
		document.getElementById("cancel").disabled = "";
	}
	
	//Permet de changer la couleur du texte quand la couleur change
	
	function changeCouleur(id)
	{
		document.getElementById("cancel").disabled = "";
		document.getElementById("nom"+id).style.color = document.getElementById("coul"+id).value;
	}
	
	function addConvention()
	{
		document.getElementById("cancel").disabled = "";
		var nom = "nom"+tableau.length;
		var coul = "coul"+tableau.length;
		var suppr = "suppr"+tableau.length;
		var table = document.getElementById('tableConvention');
		var ligne = table.insertRow(tableau.length);
		ligne.id="tr"+tableau.length;
		table.rows[tableau.length].innerHTML = '<td>\
				<input type="text" id="'+nom+'" name="'+nom+'" style="color:#000000; text-transform:uppercase;" placeholder="nom" onchange="changeNom()"/>\
			</td>\
			<td>\
				<input id="'+coul+'" name="'+coul+'" type="color" value="#000000" onchange="changeCouleur('+tableau.length+')"/>\
			</td>\
			<td>\
				<input name="'+suppr+'" id="'+suppr+'" type="button" class="delCross" value="x" onclick="delConvention('+tableau.length+')">\
			</td>';
		tableau[tableau.length] = Array(maxi++,1);
	}
	
	function delConvention(x){
		var tr = document.getElementById('tr'+x);
		tr.style.display = 'none';
		tableau[x][1]=2;
	}
	
	function postData()
	{
		var tableauFinal = new Array;
		for(var x=0; x<tableau.length; x++)
		{
			inputText = document.getElementById("nom"+x);
			inputColor = document.getElementById("coul"+x);
			tableauFinal[x] = new Array(tableau[x][0], inputText.value, inputColor.value, 1, tableau[x][1]);
		}
		if(confirm("Etes-vous sûr de vouloir sauvegarder le planning ?"))
		{
			document.getElementById('Tableau').value = JSON.stringify(tableauFinal);
		   	document.getElementById("valid_convention").submit();
		}
	}
	
</script>
<?php
	include($pwd."footer.php");
?>