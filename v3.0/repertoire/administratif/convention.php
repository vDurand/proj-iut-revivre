<?php
	$pageTitle = "Conventions";
	$pwd='../../';
	include($pwd."bandeau.php");
	$arrayElements = Array();
?>
<div id="corps">
    <div id="labelT">     
        <label>Gestion des conventions administratives</label>
   	</div>
    <br/>
    <div style="width:100%; max-width:100%; background-color:white; box-shadow:1px 1px 3px #555; padding:15px 0px;">
        <form>
            <table style="margin:0 auto 0 auto; width:400px;">
                <tr>
                    <td colspan="2">
                        <input name="nouvConv" id="nouvConv" type="button" class="buttonNormal" value="Ajouter une convention" onclick="addConvention()">
                    </td>
                    <td style="text-align:right;">
                        <input name="cancel" id="cancel" type="button" class="buttonNormal" value="Annuler" disabled="disabled" 
                               onclick="if(confirm('Etes-vous sûr de vouloir annuler ?')){window.location.replace('./convention.php');}">
                        <input id="validConv" name="validConv" type="button" class="buttonNormal" disabled="disabled" value="Sauvegarder" onclick="postData()">
                    </td>
                </tr>
                <tr>
                    <td colspan="3"><hr/></td>
                </tr>
            </table>
        </form>
        <table style="margin:10px auto 0 auto;" id="tableConvention">
            <?php
                $x=$max=0;
                $flag = false;
                $query = mysqli_query($db,"SELECT CNV_Id, CNV_Nom AS 'nom', CNV_Couleur as 'couleur' FROM convention ORDER BY CNV_Id;");
                while($data = mysqli_fetch_assoc($query))
                {
                    $max = ($data["CNV_Id"] > $max) ? $data["CNV_Id"] : $max;
                    echo '<tr id="tr'.$data["CNV_Id"].'" style="height: 32px;">
                            <td>
                                <input type="text" id="nom'.$data["CNV_Id"].'" name="nom'.$data["CNV_Id"].'" style="color:'.$data["couleur"].'; 
                                        text-transform:uppercase; height: 22px;" value="'.$data["nom"].'" onkeyup="changeNom()"/>
                            </td>
                            <td>
                                <input name="coul'.$data["CNV_Id"].'" id="coul'.$data["CNV_Id"].'" type="color" style="margin: 0 5px;" value="'.$data["couleur"].'" onchange="changeCouleur('.$data["CNV_Id"].')"/>
                            </td>
                            <td>
                                <input name="suppr" type="button" class="delCross" value="x" onclick="delConvention('.$data["CNV_Id"].')"/>
                            </td>
                        </tr>';
                    $arrayElements[$x++] = Array((int)($data["CNV_Id"]),0);
                }
            ?>
        </table>
        <form method="post" action="./conventionPost.php" name="valid_convention" id="valid_convention">
            <input type='hidden' id="Tableau" name='Tableau' value=''>
            <input type='hidden' id="typeAction" name='typeAction' value=''>
            <input type='hidden' id="redirectPage" name='redirectPage' value="./convention.php">
        </form>
    </div>
</div>

<script type="text/javascript">
	<?php
		$js_array = json_encode($arrayElements);
		echo "var tableau = ".$js_array.";
		var maxi = ".($max+1).";
        var idRef = ".($max).";";
	?>
    var changement = false;
    
	function changeNom()
	{
        changement = true;
		document.getElementById("cancel").disabled = "";
        document.getElementById("validConv").disabled = "";
	}
    
	function changeCouleur(id)
	{
        changement = true;
		document.getElementById("cancel").disabled = "";
        document.getElementById("validConv").disabled = "";
		document.getElementById("nom"+id).style.color = document.getElementById("coul"+id).value;
	}
	
	function addConvention()
	{
		document.getElementById("cancel").disabled = "";
        document.getElementById("validConv").disabled = "";
		var nom = "nom"+maxi;
		var coul = "coul"+maxi;
		var suppr = "suppr"+maxi;
		var table = document.getElementById('tableConvention');
		var ligne = table.insertRow(tableau.length);
		ligne.id="tr"+maxi;
		ligne.innerHTML = '<td>\
				<input type="text" id="'+nom+'" name="'+nom+'" style="color:#000000; text-transform:uppercase;" placeholder="nom" onchange="changeNom()"/>\
			</td>\
			<td>\
				<input id="'+coul+'" name="'+coul+'" type="color" style="margin: 0 5px;" value="#000000" onchange="changeCouleur('+maxi+')"/>\
			</td>\
			<td>\
				<input name="'+suppr+'" id="'+suppr+'" type="button" class="delCross" value="x" onclick="delConvention('+maxi+')">\
			</td>';
        ligne.style.height="32px";
		tableau[tableau.length] = Array(maxi++,1);
	}
	
	function delConvention(x)
    {
        if(confirm("Êtes-vous sûr de vouloir supprimer cette convention ?"))
        {
            if(x <= idRef)
            {
                document.getElementById('typeAction').value = "delete";
                document.getElementById('Tableau').value = JSON.stringify(Array(x, document.getElementById('nom'+x).value));
                document.getElementById("valid_convention").submit();
            }
            else
            {
                element = document.getElementById('tr'+x);
                element.parentNode.removeChild(element);
                for(var y=0; y<tableau.length; y++)
                {
                    if(tableau[y][0] == x)
                    {
                        tableau.splice(y,1);
                        break;
                    }
                }
                if(idRef == tableau.length && changement == false)
                {
                    document.getElementById("cancel").disabled = "disabled";
                    document.getElementById("validConv").disabled = "disabled";
                }
            }
        }
	}
	
	function postData()
	{
        erreur = true;
		var tableauFinal = new Array;
		for(var x=0; x<tableau.length; x++)
		{
			inputText = document.getElementById("nom"+tableau[x][0]);
			inputColor = document.getElementById("coul"+tableau[x][0]);
            if(inputText.value != "")
            {
                tableauFinal[x] = new Array(tableau[x][0], inputText.value, inputColor.value, tableau[x][1]);
                erreur = false;
            }
            else
            {
                alert("Veuillez remplir tous les noms de convention !");
                erreur = true;
                break;   
            }
		}
		if(!erreur && confirm("Etes-vous sûr de vouloir sauvegarder le planning ?"))
		{
            document.getElementById('typeAction').value = "edit";
			document.getElementById('Tableau').value = JSON.stringify(tableauFinal);
		   	document.getElementById("valid_convention").submit();
		}
	}
	
</script>
<?php
	include($pwd."footer.php");
?>