<?php  
	include('bandeau.php');
?>
		<div id="corps">
			<div id="labelT">     
				<label>Ajouter un Achat</label>
			</div>
			<br>
			<div align="center">
			<input name="plus" type="button" value="+" class="buttonSmll" onclick="AddBuy()">&nbsp;&nbsp;
			<input name="plus" type="button" value="-" class="buttonSmll" onclick="RmBuy()">
			</div>
			<br>
			<form method="post" action="buyPost.php" name="BuyProd" id="BuyProd">
				<table id="BuyAjout" align="center" cellspacing="0px">
					<tr id="Ajout-Tps">
						<td style="text-align: right; width: 100px; padding-right: 10px;">
							<label>Produit :</label>
						</td>
						<td>
							<div class="selectProd">
	          					<select form="BuyProd" required name="Produit[]">
<?php
$num=$_POST["NumC"];
$Products = array(" ");
$Ids = array(" ");
$j = 0;
$reponse = mysqli_query($db, "SELECT * FROM Produits ORDER BY PRO_Nom");
while ($donnees = mysqli_fetch_assoc($reponse))
{
?>
			        				<option value="<?php echo $donnees['PRO_Ref']; ?>"><?php echo $donnees['PRO_Ref']; ?> | <?php echo strtoupper($donnees['PRO_Nom']); ?> (<?php echo $donnees['PRO_Conditionnement']; ?>) | <?php echo $donnees['PRO_Tarif']; ?> € </option>
<?php
$Products[$j] = $donnees['PRO_Ref']." | ".$donnees['PRO_Nom']." (".$donnees['PRO_Conditionnement'].") | ".$donnees['PRO_Tarif']." € ";
$Ids[$j] = $donnees['PRO_Ref'];
$j++;
}
mysqli_free_result($reponse);
?>									
			    				</select>
			    			</div>
			    		</td>
			    		<td style="text-align: right; width: 100px; padding-right: 10px;">
			    			<label>Quantité :</label>
			    			<input form="BuyProd" type="hidden" name="NumC" value="<?php echo $num; ?>">
			    		</td>
			    		<td>
			    			<input form="BuyProd" required maxlength="100" style="width: 75px;" name="Quantite[]" type="number" class="inputC"> 
			    		</td>
					</tr>
					<tr id="Ajout-Tpss">
						<td style="text-align: right; width: 100px; padding-right: 10px;">
							<label>Type d'achat :</label>
						</td>
						<td>
							<input form="BuyProd" required maxlength="255" style="width: 297px;" name="Type[]" type="text" class="inputC"> 
						</td>
						<td style="text-align: right; width: 100px; padding-right: 10px;">
							<label>Date d'achat :</label>
						</td>
						<td style="padding-bottom: 10px;">
							<input form="BuyProd" required maxlength="100" style="width: 150px;" name="Date[]" type="date" class="inputC"> 
						</td>
					</tr>
					<tr id="placeholder_row_bottom"></tr>
				</table>
				<br/>
				<table id="downT">
					<tr>
						<td>
							<span>
								<input form="BuyProd" name="submit" type="submit" value="Ajouter" class="buttonC">&nbsp;&nbsp; 
								<input form="BuyProd" name="reset" type="reset" value="Annuler" class="buttonC">
							</span>
						</td>
					</tr>
				</table>
			</form>
		</div>
<?php  
	include('footer.php');
?>
<script type="text/javascript">
	var buttonCount = 1;
// Add tps travail form ++ (detailChantier)
	function AddBuy()
	{
	  // conversion php array to js array
	  	var jProducts= <?php echo json_encode($Products); ?>;
	  	var jIds= <?php echo json_encode($Ids); ?>;
	  
	  // structure html tr/td/div
	  	var table = document.getElementById("BuyAjout");
	  	var NewRow = table.insertRow(2);
	  		NewRow.id = "Ajout-Tps"+buttonCount;
	  		NewRow.setAttribute("style", "display:;")
	  	
	  	var NewCell1 = NewRow.insertCell(0);
	  		NewCell1.setAttribute("style","text-align: right; width: 100px; padding-right: 10px;");
	  		NewCell1.innerHTML = "<label>Produit :</label>";
	  	
	  	var NewCell2 = NewRow.insertCell(1);
	  		NewCell2.setAttribute("style","padding-top: 20px;");
	  	
	  	var NewDiv = document.createElement("div");
	  		NewDiv.setAttribute("class","selectProd");
	  
	  // insertion array in select option via tmp
		  	tmp = '<select required form="BuyProd" name="Produit[]">';
				for (var i in jProducts) {
					tmp += '<option value="'+jIds[i]+'">'+jProducts[i]+"</option>\n";
				}
				tmp += "</select>";
		
			NewDiv.innerHTML = tmp;
	
	  		NewCell2.appendChild(NewDiv);
	  	
	  	var NewCell3 = NewRow.insertCell(2);
	  		NewCell3.setAttribute("style","text-align: right; width: 100px; padding-right: 10px;");
	  		NewCell3.innerHTML = "<label>Quantité :</label>";
	  		
	  	var NewCell4 = NewRow.insertCell(3);
	  	NewCell4.innerHTML = '<input form="BuyProd" required maxlength="100" style="width: 75px;" name="Quantite[]" type="number" class="inputC">';
	  	
	  // next tr
	  	var NewRow2 = table.insertRow(3);
	  	NewRow2.id = "Ajout-Tpss"+buttonCount;
	  	NewRow2.setAttribute("style", "display:;")
	  	
	  	var NewCell5 = NewRow2.insertCell(0);
	  	NewCell5.setAttribute("style","text-align: right; width: 100px; padding-right: 10px;");
	  	NewCell5.innerHTML = "<label>Type d'achat :</label>";
	  	
	  	var NewCell6 = NewRow2.insertCell(1);
	  	NewCell6.innerHTML = '<input form="BuyProd" required maxlength="255" style="width: 297px;" name="Type[]" type="text" class="inputC">';
	  	
	  	var NewCell7 = NewRow2.insertCell(2);
	  	NewCell7.setAttribute("style","text-align: right; width: 100px; padding-right: 10px;");
	  	NewCell7.innerHTML = "<label>Date d'achat :</label>";
	  	
	  	var NewCell8 = NewRow2.insertCell(3);
	  	NewCell8.setAttribute("style","padding-bottom: 10px;");
	  	NewCell8.innerHTML = '<input form="BuyProd" required maxlength="100" style="width: 150px;" name="Date[]" type="date" class="inputC">';
	  	
	  	
	  	buttonCount++;
	}
// Remove tps travail form -- (detailChantier)
	function RmBuy()
	{
		if (buttonCount > 1) {
			$("#placeholder_row_bottom").prev().remove();
			buttonCount--;
			$("#placeholder_row_bottom").prev().remove();
		}
	}	
</script>