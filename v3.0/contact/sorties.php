<?php
	$pageTitle = "Types de sortie";
	$pwd='../';
	include($pwd."bandeau.php");
	$arrayElements = Array();
?>
<div id="corps">
    <div id="labelT">     
        <label>Gestion des Types de sortie</label>
   	</div>
    <br/>
    <div style="width:100%; max-width:100%; background-color:white; box-shadow:1px 1px 3px #555; padding:15px 0px;">
        <form>
            <table style="margin:0 auto 0 auto; width:400px;">
                <tr>
                    <td colspan="2">
                        <input name="nouvSortie" id="nouvSortie" type="button" class="buttonNormal" value="Ajouter un type de sortie" onclick="addSortie()">
                    </td>
                    <td style="text-align:right;">
                        <input name="cancel" id="cancel" type="button" class="buttonNormal" value="Annuler" disabled="disabled" 
                               onclick="if(confirm('Etes-vous sûr de vouloir annuler ?')){window.location.replace('./sorties.php');}">
                        <input id="validSortie" name="validSortie" type="button" class="buttonNormal" disabled="disabled" value="Sauvegarder" onclick="postData()">
                    </td>
                </tr>
                <tr>
                    <td colspan="3"><hr/></td>
                </tr>
            </table>
        </form>
        <table style="margin:10px auto 0 auto;" id="tableSortie">
            <?php
                $x=$max=0;
                $flag = false;
                $query = mysqli_query($db,"SELECT TYS_ID, TYS_Libelle AS 'nom',TYS_Numero as 'num' FROM typesortie ORDER BY TYS_Numero;");
                while($data = mysqli_fetch_assoc($query))
                {
                    $max = ($data["TYS_ID"] > $max) ? $data["TYS_ID"] : $max;
                    echo '<tr id="tr'.$data["TYS_ID"].'" style="height: 32px;">
							<td>
                                <input type="text" id="num'.$data["TYS_ID"].'" name="num'.$data["TYS_ID"].'" 
									style="height: 22px; width:20px;" value="'.stripslashes($data["num"]).'" onkeyup="changeNum()"/>
							</td>
                            <td>
                                <input type="text" id="nom'.$data["TYS_ID"].'" name="nom'.$data["TYS_ID"].'" 
									style="height: 22px; width:500px;" value="'.stripslashes($data["nom"]).'" onkeyup="changeNom()"/>
                            </td>
                            <td>
                                <input name="suppr" type="button" class="delCross" value="x" onclick="delSortie('.$data["TYS_ID"].')"/>
                            </td>
                        </tr>';
                    $arrayElements[$x++] = Array((int)($data["TYS_ID"]),0);
                }
            ?>
        </table>
        <form method="post" action="./sortiesPost.php" name="valid_sortie" id="valid_sortie">
            <input type='hidden' id="Tableau" name='Tableau' value=''>
            <input type='hidden' id="typeAction" name='typeAction' value=''>
            <input type='hidden' id="redirectPage" name='redirectPage' value="./sorties.php">
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
        document.getElementById("validSortie").disabled = "";
	}
	
	function changeNum()
	{
        changement = true;
		document.getElementById("cancel").disabled = "";
        document.getElementById("validSortie").disabled = "";
	}
	
	function addSortie()
	{
		document.getElementById("cancel").disabled = "";
        document.getElementById("validSortie").disabled = "";
		var nom = "nom"+maxi;
		var num = "num"+maxi;
		var suppr = "suppr"+maxi;
		var table = document.getElementById('tableSortie');
		var ligne = table.insertRow(tableau.length);
		ligne.id="tr"+maxi;
		ligne.innerHTML = '<td>\
				<input type="text" id="'+num+'" name="'+num+'" style="color:#000000; width:20px;" placeholder="00" onchange="changeNum()"/>\
			</td/>\
			<td>\
				<input type="text" id="'+nom+'" name="'+nom+'" style="color:#000000; width:500px;" placeholder="nom" onchange="changeNom()"/>\
			</td>\
			<td>\
				<input name="'+suppr+'" id="'+suppr+'" type="button" class="delCross" value="x" onclick="delSortie('+maxi+')">\
			</td>';
        ligne.style.height="32px";
		tableau[tableau.length] = Array(maxi++,1);
	}
	
	function delSortie(x)
    {
        if(confirm("Êtes-vous sûr de vouloir supprimer ce type de sortie ?"))
        {
            if(x <= idRef)
            {
                document.getElementById('typeAction').value = "delete";
                document.getElementById('Tableau').value = JSON.stringify(Array(x, document.getElementById('nom'+x).value));
                document.getElementById("valid_sortie").submit();
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
                    document.getElementById("validSortie").disabled = "disabled";
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
			erreur = false;
			inputText = document.getElementById("nom"+tableau[x][0]);
			inputNumero= document.getElementById("num"+tableau[x][0]);
            if(inputText.value != ""&&inputNumero!="")
            {
                tableauFinal[x] = new Array(tableau[x][0], inputText.value, inputNumero.value, tableau[x][1]);
            }
            else
            {
                alert("Veuillez remplir tous les types de sortie et leur numéro!");
                erreur = true;
                break;   
            }
		}
		if(!erreur && confirm("Etes-vous sûr de vouloir sauvegarder les types de sorties?"))
		{
            document.getElementById('typeAction').value = "edit";
			document.getElementById('Tableau').value = JSON.stringify(tableauFinal);
		   	document.getElementById("valid_sortie").submit();
		}
	}
	
</script>
<?php
	include($pwd."footer.php");
?>