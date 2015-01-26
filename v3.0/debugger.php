<?php
$pwd="";
	include('bandeau.php');
?>
		<div id="corps">
			<div id="labelT">     
				<label>Signaler un Bug</label>
			</div>
			<br>
			<form method="post" action="bugsender.php">
					<table align="center">
						<tr style="height: 50px;">
							<td style="text-align: left; width: 250px;">
							 	<label>Votre Nom :</label>
							 </td>
							 <td>
							 	<input required type="text" name="Name" maxlength="50" size="30">
							 </td>
						</tr>
						<tr style="height: 50px;">
							<td style="text-align: left; width: 250px;">
								<label>Importance du bug :</label>
							</td>
							<td>
	          					<select required name="Severity">
	          						<option value="Faible">Faible</option>
	          						<option value="Moyenne">Moyenne</option>
	          						<option value="Grande">Grande</option>
			    				</select>
				    		</td>
						</tr>
						<tr style="height: 50px;">
							<td style="text-align: left; width: 250px;">
								<label>Fréquence du bug :</label>
							</td>
							<td>
								<select required name="Frequency">
									<option value="Toujours">Toujours</option>
									<option value="Occasionnellement">Occasionnellement</option>
									<option value="Rarement">Rarement</option>
								</select>
							</td>
						</tr>
						<tr style="height: 50px;">
							<td style="text-align: left; width: 250px;">
								<label>Navigateur :</label>
							</td>
							<td>
								<select required name="Nav">
                                    <option value="Chrome">Chrome</option>
									<option value="Firefox">Firefox</option>
									<option value="IE">Internet Explorer</option>
									<option value="Safari">Safari</option>
									<option value="Opera">Opera</option>
									<option value="Autre">Autre...</option>
								</select>
							</td>
						</tr>
						<tr style="height: 50px;">
							<td style="text-align: left; width: 250px;">
							 	<label>Page où s'est produit le bug :</label>
							 </td>
							 <td>
							 	<input required placeholder="http://" type="text" name="Url" maxlength="250" size="50">
							 </td>
						</tr>
						<tr style="height: 50px;">
							<td style="text-align: left; width: 250px;">
								<label>Description du bug :</label>
							</td>
							<td>
								<textarea required name="Description" maxlength="1000" cols="25" rows="6"></textarea>
							</td>
						</tr>
						<tr style="height: 50px;">
							<td style="text-align: left; width: 250px;">
								<label>Etapes pour reproduire le bug :</label>
							</td>
							<td>
								<textarea name="Steps" maxlength="1000" cols="25" rows="6"></textarea>
							</td>
						</tr>
						<tr style="height: 50px;">
							<td style="text-align: left; width: 250px;">
								<label>Informations supplémentaires :</label>
							</td>
							<td>
								<textarea name="Info" maxlength="500" cols="25" rows="4"></textarea>
							</td>
						</tr>
						<tr style="height: 100px;">
							<td colspan="2" style="text-align: center;">
								<span>
									<input name="submit" type="submit" value="Envoyer" class="buttonC">&nbsp;&nbsp; 
									<input name="reset" type="reset" value="Annuler" class="buttonC">
								</span>
							</td>
						</tr>
					</table>
                <input type="hidden" name="reffer" value="<?php echo $_SERVER['HTTP_REFERER']; ?>">
			</form>
		</div>
<?php  
	include('footer.php');
?>