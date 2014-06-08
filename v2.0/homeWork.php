		<?php  
		include('bandeau.php');
		?>
		<script src="js/sorttable.js"></script>
		<script language="javascript"> 
			function fsubmit(value_p) 
			{ 
				document.forms['detailClient'].NumC.value = value_p; 
				document.forms['detailClient'].submit(); 
			} 
		</script>
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
							<td style="text-align: center; width: 155px;">
								Debut
							</td>
							<td style="text-align: center; width: 155px;">
								<a>Fin</a>
							</td>
						</tr>
					</thead>
					<tbody>
						<?php

	if($db = MySQLi_connect("localhost","Kepha",'pfudor', 'Revivre', 0, '/media/sds1/home/alx22/private/mysql/socket'))
		echo '';
	else
		echo 'Erreur';

	$sorter = 'CHA_DateDebut';

/*CREATE OR REPLACE VIEW ChantierClient AS SELECT co.CHA_NumDevis, pe.PER_Nom as Client FROM Commanditer co JOIN Clients cl ON co.CLI_NumClient=cl.CLI_NumClient JOIN Personnes pe ON cl.PER_Num=pe.PER_Num;
CREATE OR REPLACE VIEW ChantierResp AS SELECT en.CHA_NumDevis, pe.PER_Nom as Resp FROM Encadrer en JOIN Salaries sa ON en.SAL_NumSalarie=sa.SAL_NumSalarie JOIN Personnes pe ON sa.PER_Num=pe.PER_Num;*/

	//$reponse = mysqli_query($db, "SELECT * FROM Chantiers ch JOIN ChantierClient vcl ON ch.CHA_NumDevis=vcl.CHA_NumDevis JOIN ChantierResp vre ON ch.CHA_NumDevis=vre.CHA_NumDevis ORDER BY ch.CHA_NumDevis DESC");
	$reponse = mysqli_query($db, "SELECT * FROM Chantiers ch JOIN ChantierClient vcl ON ch.CHA_NumDevis=vcl.CHA_NumDevis ORDER BY ch.CHA_NumDevis DESC");
	while ($donnees = mysqli_fetch_assoc($reponse))
	{
		?>				<form method="post" action="detailClient.php" name="detailClient">
							<input type="hidden" name="NumC" value="">
							<tr onclick="javascript:fsubmit('<?php echo $donnees['CLI_NumClient']; ?>');" style="font-size: 14;">
								<td><?php echo $donnees['CHA_Id']; ?></td>
								<td><?php echo $donnees['CHA_Intitule']; ?></td>
								<td><?php echo $donnees['Client']; ?></td>
								<td><?php //echo $donnees['Resp']; ?></td>
								<td><?php echo $donnees['CHA_DateDebut']; ?></td>
								<td><?php echo $donnees['CHA_DateFinReel']; ?></td>
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