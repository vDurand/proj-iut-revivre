		<?php  
		include('bandeau.php');
		?>
		<script src="js/sorttable.js"></script>
		<script language="javascript"> 
			function fsubmit(value_p, type) 
			{ 
				document.forms[type].NumC.value = value_p; 
				document.forms[type].submit(); 
			} 
		</script>
		<script>
        $(document).ready(function() {
            $('.tooltip').tooltipster();
        });
    	</script>
		<div id="corps">
			<div id="labelT">     
				<label>Liste des Contacts</label>
			</div><br>
			<form method="post" action="rangContact.php" name="EditClient">
		        <table id="alphaL">
		          <tr>
		          	<td>
		          		<div class="selectDrop">
		          		<select name="trieur">
				        	<option value="0">Nom</option>
				        	<option value="1">Prénom</option>
				    	</select>
				    </div>
		          	</td>
		            <td>
		              <span>
		                <input name="submit" type="submit" value="A" class="alphaButton">
		              </span>
		            </td>
		            <td>
		              <span>
		                <input name="submit" type="submit" value="B" class="alphaButton">
		              </span>
		            </td>
		            <td>
		              <span>
		                <input name="submit" type="submit" value="C" class="alphaButton">
		              </span>
		            </td>
		            <td>
		              <span>
		                <input name="submit" type="submit" value="D" class="alphaButton">
		              </span>
		            </td>
		            <td>
		              <span>
		                <input name="submit" type="submit" value="E" class="alphaButton">
		              </span>
		            </td>
		            <td>
		              <span>
		                <input name="submit" type="submit" value="F" class="alphaButton">
		              </span>
		            </td>
		            <td>
		              <span>
		                <input name="submit" type="submit" value="G" class="alphaButton">
		              </span>
		            </td>
		            <td>
		              <span>
		                <input name="submit" type="submit" value="H" class="alphaButton">
		              </span>
		            </td>
		            <td>
		              <span>
		                <input name="submit" type="submit" value="I" class="alphaButton">
		              </span>
		            </td>
		            <td>
		              <span>
		                <input name="submit" type="submit" value="J" class="alphaButton">
		              </span>
		            </td>
		            <td>
		              <span>
		                <input name="submit" type="submit" value="K" class="alphaButton">
		              </span>
		            </td>
		            <td>
		              <span>
		                <input name="submit" type="submit" value="L" class="alphaButton">
		              </span>
		            </td>
		            <td>
		              <span>
		                <input name="submit" type="submit" value="M" class="alphaButton">
		              </span>
		            </td>
		            <td>
		              <span>
		                <input name="submit" type="submit" value="N" class="alphaButton">
		              </span>
		            </td>
		            <td>
		              <span>
		                <input name="submit" type="submit" value="O" class="alphaButton">
		              </span>
		            </td>
		            <td>
		              <span>
		                <input name="submit" type="submit" value="P" class="alphaButton">
		              </span>
		            </td>
		            <td>
		              <span>
		                <input name="submit" type="submit" value="Q" class="alphaButton">
		              </span>
		            </td>
		            <td>
		              <span>
		                <input name="submit" type="submit" value="R" class="alphaButton">
		              </span>
		            </td>
		            <td>
		              <span>
		                <input name="submit" type="submit" value="S" class="alphaButton">
		              </span>
		            </td>
		            <td>
		              <span>
		                <input name="submit" type="submit" value="T" class="alphaButton">
		              </span>
		            </td>
		            <td>
		              <span>
		                <input name="submit" type="submit" value="U" class="alphaButton">
		              </span>
		            </td>
		            <td>
		              <span>
		                <input name="submit" type="submit" value="V" class="alphaButton">
		              </span>
		            </td>
		            <td>
		              <span>
		                <input name="submit" type="submit" value="W" class="alphaButton">
		              </span>
		            </td>
		            <td>
		              <span>
		                <input name="submit" type="submit" value="X" class="alphaButton">
		              </span>
		            </td>
		            <td>
		              <span>
		                <input name="submit" type="submit" value="Y" class="alphaButton">
		              </span>
		            </td>
		            <td>
		              <span>
		                <input name="submit" type="submit" value="Z" class="alphaButton">
		              </span>
		            </td>
		          </tr>
		        </table>
		    </form>
					<table class="tableContact" cellpadding="5">
						<thead>
						<tr>
							<td class="firstCol" style="text-align: center; width: 155px;">
								<a>Nom</a>
							</td>
							<td style="text-align: center; width: 155px;">
								<a>Prénom</a>
							</td>
							<td class="sorttable_nosort tooltip" style="text-align: center; width: 155px; cursor: help;" title="Vous ne pouvez pas classer par adresse.">
								<a>Adresse</a>
							</td>
							<td style="text-align: center; width: 155px;">
								<a>Ville</a>
							</td>
							<td class="sorttable_nosort tooltip" style="text-align: center; width: 155px; cursor: help;" title="Vous ne pouvez pas classer par numero de portable.">
								Portable
							</td>
							<td style="text-align: center; width: 155px;">
								<a>Type</a>
							</td>
						</tr>
					</thead>
					<tbody>
						<?php

	if($db = MySQLi_connect("localhost","Kepha",'pfudor', 'Revivre', 0, '/media/sds1/home/alx22/private/mysql/socket'))
		echo '';
	else
		echo 'Erreur';

	$sorter = 'PER_Nom';

	$reponse = mysqli_query($db, "SELECT * FROM Clients cl JOIN Personnes pe ON cl.PER_Num=pe.PER_Num ORDER BY PER_Nom");
	while ($donnees = mysqli_fetch_assoc($reponse))
	{
		?>				<form method="post" action="detailClient.php" name="detailClient">
							<input type="hidden" name="NumC" value="">
							<tr onclick="javascript:fsubmit('<?php echo $donnees['CLI_NumClient']; ?>', 'detailClient');" style="font-size: 14;">
								<td><?php echo $donnees['PER_Nom']; ?></td>
								<td><?php echo $donnees['PER_Prenom']; ?></td>
								<td><?php echo $donnees['PER_Adresse']; ?></td>
								<td><?php echo $donnees['PER_Ville']; ?></td>
								<td><?php echo $donnees['PER_TelPort']; ?></td>
								<td>Client</td>
							</tr>
						</form>
						<?php
	}
	mysqli_free_result($reponse);

	$reponse = mysqli_query($db, 'SELECT * FROM Fournisseurs cl JOIN Personnes pe ON cl.PER_Num=pe.PER_Num ORDER BY PER_Nom');
	while ($donnees = mysqli_fetch_assoc($reponse))
	{
	?>					<form method="post" action="detailFournisseur.php" name="detailFour">
							<input type="hidden" name="NumC" value="">
							<tr onclick="javascript:fsubmit('<?php echo $donnees['FOU_NumFournisseur']; ?>', 'detailFour');" style="font-size: 14;">
								<td><?php echo $donnees['PER_Nom']; ?></td>
								<td><?php echo $donnees['PER_Prenom']; ?></td>
								<td><?php echo $donnees['PER_Adresse']; ?></td>
								<td><?php echo $donnees['PER_Ville']; ?></td>
								<td><?php echo $donnees['PER_TelPort']; ?></td>
								<td>Fournisseur</td>
							</tr>
						</form>	
						<?php
	}
	mysqli_free_result($reponse);

	$reponse = mysqli_query($db, 'SELECT * FROM Salaries cl JOIN Personnes pe ON cl.PER_Num=pe.PER_Num JOIN Type ty ON cl.TYP_Id=ty.TYP_Id ORDER BY PER_Nom');
	while ($donnees = mysqli_fetch_assoc($reponse))
	{
	?>					<form method="post" action="detailSal.php" name="detailSal">
							<input type="hidden" name="NumC" value="">
							<tr onclick="javascript:fsubmit('<?php echo $donnees['SAL_NumSalarie']; ?>', 'detailSal');" style="font-size: 14;">
								<td><?php echo $donnees['PER_Nom']; ?></td>
								<td><?php echo $donnees['PER_Prenom']; ?></td>
								<td><?php echo $donnees['PER_Adresse']; ?></td>
								<td><?php echo $donnees['PER_Ville']; ?></td>
								<td><?php echo $donnees['PER_TelPort']; ?></td>
								<td><?php echo $donnees['TYP_Nom']; ?></td>
							</tr>
						</form>
						<?php
	}
	mysqli_free_result($reponse);
	?>
					</tbody>
					</table>
		</div>
	<?php  
		include('footer.php');
		?>