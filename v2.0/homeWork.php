<?php  
	include('bandeau.php');
?>
		<script src="js/sorttable.js"></script>
		<script>
        $(document).ready(function() {
            $('.tooltip').tooltipster();
        });
    	</script>
		<div id="corps">
			<div id="labelT">     
				<label>Liste des Chantiers</label>
			</div><br>
			<form method="post" action="rangChantier.php" name="EditClient">
		        <table id="alphaL">
		          <tr>
		          	<td>
		          		<div class="selectDrop">
		          		<select name="trieur">
				        	<option value="0">Client</option>
				        	<option value="1">Responsable</option>
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
							<td class="firstCol" style="text-align: center; width: 40px;">
								<a>#</a>
							</td>
							<td style="text-align: center; width: 231px;">
								<a>Chantier</a>
							</td>
							<td style="text-align: center; width: 155px;">
								<a>Client</a>
							</td>
							<td style="text-align: center; width: 155px;">
								<a>Responsable</a>
							</td>
							<td style="text-align: center; width: 155px; cursor: help;" class="sorttable_nosort tooltip" title="Classement par défaut.">
								Debut
							</td>
							<td style="text-align: center; width: 155px; cursor: help;" class="sorttable_nosort tooltip" title="Vous ne pouvez pas classer par date de fin.">
								<a>Fin</a>
							</td>
						</tr>
					</thead>
					<tbody>
<?php
	$sorter = 'CHA_DateDebut';
	//SELECT * FROM Chantiers ch JOIN ChantierClient vcl ON ch.CHA_NumDevis=vcl.CNumDevis LEFT JOIN ChantierResp vre ON ch.CHA_NumDevis=vre.RNumDevis ORDER BY ch.CHA_NumDevis DESC
	$reponse = mysqli_query($db, "SELECT * FROM ChantierMax Join TypeEtat ON IdMax=TYE_Id ORDER BY CHA_DateDebut DESC");
	while ($donnees = mysqli_fetch_assoc($reponse))
	{
?>
						<form method="post" action="detailChantier.php" name="detailClient">
							<input type="hidden" name="NumC" value="">
							<tr onclick="javascript:submitViewDetail('<?php echo $donnees['CHA_NumDevis']; ?>', 'detailClient');" style="font-size: 14;">
								<td><?php echo $donnees['CHA_Id']; ?></td>
								<td><?php echo ucfirst(strtolower($donnees['CHA_Intitule'])); ?></td>
								<td><?php echo strtoupper($donnees['Client']); ?> <?php echo $donnees['ClientP']; ?></td>
								<td><?php echo strtoupper($donnees['Resp']); ?> <?php echo $donnees['RespP']; ?></td>
								<td><?php echo dater($donnees['CHA_DateDebut']); ?></td>
								<td>
<?php
		if ($donnees['IdMax']==4) {
			echo dater($donnees['CHA_DateFinReel']);
		}
		else {
		  	echo $donnees['TYE_Nom'];
		} 
?>
								</td>
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