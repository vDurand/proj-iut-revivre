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
			<table align="center">
				<tr id="Contact-Particulier">
					<td style="padding-top: 0px;">
						<input type="radio" checked onclick="javascript:showNewProd();" name="truc"/>
						<label>&nbsp; Existant</label>
					</td>
					<td style="padding-top: 0px;">
						<input type="radio" onclick="javascript:showNewProd();" id="yesCheck" name="truc"/>
						<label>&nbsp; Nouveau</label>
					</td>
				</tr>
			</table>
			<form method="post" action="buyPost.php" name="BuyProd" id="BuyProd">
				<table id="BuyAjout" align="center" cellspacing="0px">
					<tr id="Ajout-Tps">
						<td style="text-align: right; width: 100px; padding-right: 10px;">
							<label>Produit :</label>
						</td>
						<td>
							<div id="ProdSelector" class="selectProd" style="display: ;">
	          					<select form="BuyProd" id="ProduitExistant" name="Produit[]">
<?php
$num=$_POST["NumC"];
$Products = array(" ");
$Ids = array(" ");
$j = 0;
$reponse = mysqli_query($db, "SELECT * FROM Produits JOIN Fournisseurs USING (FOU_NumFournisseur) JOIN Personnes USING (PER_Num) ORDER BY PRO_Nom");
while ($donnees = mysqli_fetch_assoc($reponse))
{
?>
			        				<option value="<?php echo $donnees['PRO_Ref']; ?>"><?php echo formatLOW($donnees['PRO_Nom']); ?> (<?php echo formatUP($donnees['PER_Nom']); ?> <?php echo formatLOW($donnees['PER_Prenom']); ?>)</option>
<?php
$Products[$j] = formatLOW($donnees['PRO_Nom'])." (".formatUP($donnees['PER_Nom'])." ".formatLOW($donnees['PER_Prenom']).")";
$Ids[$j] = $donnees['PRO_Ref'];
$j++;
}
mysqli_free_result($reponse);
?>									
			    				</select>
			    			</div>
			    			<div id="ProdCreator" style="display: none;">
			    				<table>
			    				<tr>
			    				<td>Fournisseur :</td>
			    				<td>
			    				<select form="BuyProd" id="FournProd" name="FournProd[]" style="width: 200px;">
			    					<option value=""></option>
<?php 
$reponse2 = mysqli_query($db, "SELECT * FROM Fournisseurs JOIN Personnes USING (PER_Num) ORDER BY PER_Nom");
while ($donnees2 = mysqli_fetch_assoc($reponse2))
{
?>
									<option value="<?php echo $donnees2['FOU_NumFournisseur']; ?>"><?php echo formatUP($donnees2['PER_Nom'])." ".formatLOW($donnees2['PER_Prenom']); ?></option>
<?php 
} 
?>			    				
			    				</select>
			    				</td>
			    				</tr>
			    				<tr>
			    				<td>
                                    <label>Nom :</label>
			    				</td>
			    				<td>
                                    <input form="BuyProd" id="NomProd" name="NomProd[]" type="text" placeholder="Peinture">
			    				</td>
			    				</tr>
			    				</table>
			    			</div>
			    		</td>
			    		<td style="text-align: right; width: 100px; padding-right: 10px;">
			    			<label>Montant :</label>
			    			<input form="BuyProd" type="hidden" name="NumC" value="<?php echo $num; ?>">
			    		</td>
			    		<td>
			    			<input form="BuyProd" required min="0" style="width: 75px;" name="Montant[]" type="number" step="0.01" class="inputC">
			    		</td>
					</tr>
					<tr id="Ajout-Tpss">
						<td style="text-align: right; width: 100px; padding-right: 10px;">
							<label>Detail :</label>
						</td>
						<td>
							<input form="BuyProd" placeholder="Conditionnement, Quantité, etc..." required maxlength="255" style="width: 297px;" name="Type[]" type="text" class="inputC">
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
	  		NewCell3.innerHTML = "<label>Montant :</label>";
	  		
	  	var NewCell4 = NewRow.insertCell(3);
	  	NewCell4.innerHTML = '<input form="BuyProd" required min="0" step="0.01" style="width: 75px;" name="Montant[]" type="number" class="inputC">';
	  	
	  // next tr
	  	var NewRow2 = table.insertRow(3);
	  	NewRow2.id = "Ajout-Tpss"+buttonCount;
	  	NewRow2.setAttribute("style", "display:;")
	  	
	  	var NewCell5 = NewRow2.insertCell(0);
	  	NewCell5.setAttribute("style","text-align: right; width: 100px; padding-right: 10px;");
	  	NewCell5.innerHTML = "<label>Detail :</label>";
	  	
	  	var NewCell6 = NewRow2.insertCell(1);
	  	NewCell6.innerHTML = '<input form="BuyProd" required placeholder="Conditionnement, Quantité, etc..." maxlength="255" style="width: 297px;" name="Type[]" type="text" class="inputC">';
	  	
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