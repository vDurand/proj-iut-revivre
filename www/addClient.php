		<?php  
		include('bandeau.php');
		?>
		<div id="corps">
			<div id="labelT" style="background-color:cde5f7; ">     
				<label>Ajouter un Client</label>
			</div><br>
			<form method="post" action="clientpst.php" name="Client" formtype="1" colvalue="2">
				<div style="overflow:auto;">
					<table align="left">
					<td style="vertical-align:top;">
					<table id="leftT" colcount="0" cellpadding="10">
						<tr id="Client-Nom">
							<td style="text-align: left; width: 150px; white-space: normal;">
								<label>Nom :</label>
							</td>
							<td>
								<input id="Nom" maxlength="255" name="Nom" type="text" fieldtype="1" style="width:200px;background-color:cde5f7;" delugetype="STRING"> 
							</td>
						</tr>
						<tr id="Client-Prenom">
							<td style="text-align: left; width: 150px; white-space: normal;">
								<label>Prenom :</label>
							</td>
							<td>
								<input id="Prenom" maxlength="255" name="Prenom" type="text" fieldtype="1" style="width:200px;background-color:cde5f7;" delugetype="STRING"> 
							</td>

						</tr>
						<tr id="Client-Tel_Fixe">
							<td style="text-align: left; width: 150px; white-space: normal;">
								<label>Telephone Fixe :</label>
							</td>
							<td>
								<input id="Tel_Fixe" maxlength="255" name="Tel_Fixe" type="text" fieldtype="1" style="width:200px;background-color:cde5f7;" delugetype="STRING"> 
							</td>
						</tr>
						<tr id="Client-Portable">
							<td style="text-align: left; width: 150px; white-space: normal;">
								<label>Telephone Portable :</label>
							</td>
							<td>
								<input id="Portable" maxlength="255" name="Portable" type="text" fieldtype="1" style="width:200px;background-color:cde5f7;" delugetype="STRING"> 
							</td>
						</tr>
						<tr id="Client-Fax">
							<td style="text-align: left; width: 150px; white-space: normal;">
								<label>Fax :</label>
							</td>
							<td>
								<input id="Fax" maxlength="255" name="Fax" type="text" fieldtype="1" style="width:200px;background-color:cde5f7;" delugetype="STRING"> 
							</td>
						</tr>
					</table>
				</td>
				<td style="vertical-align:top;">
					<table id="rightT" colcount="1" cellpadding="10">
						<tr id="Client-Email">
							<td style="text-align: left; width: 150px; white-space: normal;">
								<label>Email :</label>
							</td>
							<td>
								<input id="Email" maxlength="255" name="Email" type="text" fieldtype="4" style="width:200px;background-color:cde5f7;" delugetype="STRING"> 
							</td>
						</tr>
						<tr id="Client-Adresse">
							<td style="text-align: left; width: 150px; white-space: normal;">
								<label>Adresse :</label>
							</td>
							<td>
								<input id="Adresse" maxlength="255" name="Adresse" type="text" fieldtype="1" style="width:200px;background-color:cde5f7;" delugetype="STRING">
							</td>
						</tr>
						<tr id="Client-Code_Postal">
							<td style="text-align: left; width: 150px; white-space: normal;">
								<label>Code Postal :</label>
							</td>
							<td>
								<input id="Code_Postal" name="Code_Postal" type="text" title="" fieldtype="5" style="width:100px;background-color:cde5f7;" delugetype="BIGINT" maxlength="5">
							</td>
						</tr>
						<tr id="Client-Ville">
							<td style="text-align: left; width: 150px; white-space: normal;">
								<label>Ville :</label>
							</td>
							<td>
								<input id="Ville" maxlength="255" name="Ville" type="text" fieldtype="1" style="width:200px;background-color:cde5f7;" delugetype="STRING">
							</td>
						</tr>
					</table>
				</td>
			</table>
				</div>
				<table id="downT">
					<tr>
						<td style="background-color:f5f2f5;">
							<span>
								<input name="submit" type="submit" value="Submit">&nbsp;&nbsp; 
								<input name="reset" type="reset" value="Reset">&nbsp;&nbsp; 
							</span>
						</td>
					</tr>
				</table>
			</form>
		</div>
	</body>
	<footer>
		<div>
			&copy; Association Revivre <?php echo date('Y');?><br>
		</div>
	</footer>
</html>