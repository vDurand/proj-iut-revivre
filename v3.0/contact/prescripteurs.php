<?php
	$pageTitle = "Prescripteurs";
	$pwd='../';
	include($pwd."bandeau.php");
	$arrayElements = Array();
?>
<div id="corps">
    <div id="labelT">     
        <label>Gestion des prescripteurs</label>
   	</div>
    <br/>
    <div style="width:100%; max-width:100%; background-color:white; box-shadow:1px 1px 3px #555; padding:15px 0px;">	
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']?>")>
            <table style="margin:0 auto 0 auto; width:620px;">
                <tr>
                    <td colspan="2">
                        <input name="nouvPres" id="nouvPres" type="button" class="buttonNormal" value="Ajouter un prescripteurs" onclick="addPres()">
                    </td>
                    <td style="text-align:right;">
                        <input name="cancel" id="cancel" type="button" class="buttonNormal" value="Annuler" disabled="disabled" 
                               onclick="if(confirm('Etes-vous sûr de vouloir annuler ?')){window.location.replace('./prescripteurs.php');}">
                        <input id="validPres" name="validPres" type="button" class="buttonNormal" disabled="disabled" value="Sauvegarder" onclick="postData()">
                    </td>
                </tr>
                <tr>
                    <td colspan="3"><hr/></td>
                </tr>
            </table>
        </form>
        <table style="margin:10px auto 0 auto;" id="tablePres">
            <?php
                $x=$max=0;
                $flag = false;
				$query = mysqli_query($db,"SELECT PRE_Id, PRE_Nom AS 'nom' FROM prescripteurs ORDER BY PRE_Id;");
                while($data = mysqli_fetch_assoc($query))
                {
                    $max = ($data["PRE_Id"] > $max) ? $data["PRE_Id"] : $max;
					echo '<tr id="tr'.$data["PRE_Id"].'" style="height: 32px;">
                        <td>
                            <input type="text" id="nom'.$data["PRE_Id"].'" name="nom'.$data["PRE_Id"].'" 
								style="height: 22px; width:500px;" value="'.stripslashes($data["nom"]).'"/>
                        </td>
                        <td>
                            <input name="suppr" type="button" class="delCross" value="x" onclick="delPres('.$data["PRE_Id"].')"/>
                        </td>
							
                    </tr>';
					
                    $arrayElements[$x++] = Array((int)($data["PRE_Id"]),0);
                }
            ?>
        </table>
        <form method="post" action="./prescripteursPost.php" name="valid_pres" id="valid_pres">
            <input type='hidden' id="Tableau" name='Tableau' value=''>
            <input type='hidden' id="typeAction" name='typeAction' value=''>
            <input type='hidden' id="redirectPage" name='redirectPage' value="./prescripteurs.php">
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
        document.getElementById("validPres").disabled = "";
	}
	
	function addPres()
	{
		document.getElementById("cancel").disabled = "";
        document.getElementById("validPres").disabled = "";
		var nom = "nom"+maxi;
		var num = "num"+maxi;
		var suppr = "suppr"+maxi;
		var table = document.getElementById('tablePres');
		var ligne = table.insertRow(tableau.length);
		ligne.id="tr"+maxi;
		ligne.innerHTML = '
			<td>\
				<input type="text" id="'+nom+'" name="'+nom+'" style="color:#000000; width:500px;" placeholder="nom" onchange="changeNom()"/>\
			</td>\
			<td>\
				<input name="'+suppr+'" id="'+suppr+'" type="button" class="" value="Supprimer" onclick="delPres('+maxi+')">\
			</td>';
        ligne.style.height="32px";
		tableau[tableau.length] = Array(maxi++,1);
	}
	
	function delPres(x)
    {
        if(confirm("Êtes-vous sûr de vouloir supprimer ce prescripteur ?"))
        {
            if(x <= idRef)
            {
                document.getElementById('typeAction').value = "delete";
                document.getElementById('Tableau').value = JSON.stringify(Array(x, document.getElementById('nom'+x).value));
                document.getElementById("valid_pres").submit();
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
                    document.getElementById("validPres").disabled = "disabled";
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
            if(inputText.value != ""&&inputNumero!="")
            {
                tableauFinal[x] = new Array(tableau[x][0], inputText.value, tableau[x][1]);
            }
            else
            {
                alert("Veuillez remplir tous les prescripteurs!");
                erreur = true;
                break;   
            }
		}
		if(!erreur && confirm("Etes-vous sûr de vouloir sauvegarder prescripteurs?"))
		{
            document.getElementById('typeAction').value = "edit";
			document.getElementById('Tableau').value = JSON.stringify(tableauFinal);
		   	document.getElementById("valid_pres").submit();
		}
	}
	
</script>	
<?php
	include($pwd."footer.php");
?>