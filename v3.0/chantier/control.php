<?php
$pwd='../';
	include('../bandeau.php');
?>
		<head>
			<link rel="stylesheet" type="text/css" href="../css/index.css">
			<link rel="stylesheet" type="text/css" href="../css/control.css" media="print">
			
		</head>
		<div id="corps">
			<div id="formulaire">
				<fieldset id="fld" style="width:70%; margin-left:15%; background-color: #FFFFFF;">
					<legend align="center"><h2>Minute de chantier</h2></legend>
						<div style="overflow:auto;">
							<h5 align="center"><u>Identifiant du chantier :</u></h5>
							<table border="0" align="center">
								<tr align="left">
									<th><label for="code"> Code :</label></th>
									<td><input id="code" name="code" type="text" autofocus="autofocus" /></td>
									
									<th><label for="designation"> Désignation :</label></th>
									<td><input id="designation" name="designation" type="text"/></td>
								</tr>
								
								<tr align="left">
									<th><label for="adresseCh"> Adresse du chantier :</label></th>
									<td><input id="adresse" name="adresse"/></td>
								</tr>
							</table>
							
							<h5 align="center"><u>Information du client</u></h5>
						
							<table border="0" align="center">
								<tr align="left" >
									<th><label for="etablissement"> Etablissement :</label></th>
									<td><input id="etablissement" name="etablissement" type="text"/></td>
									<th><label for="nom"> Nom :</label></th>
									<td><input id="nom" name="nom" type="text"/></td>
									</tr>
								
								<tr align="left">
									<th><label for="adresseCl"> Adresse :</label></th>
									<td><input id="adresseCl" name="adresseCl" type="text"/></td>
								</tr>

								<tr align="left">
									<th><label for="telephone"> Téléphone :</label></th>
									<td><input id="telephone" pattern="^ *[0-9]{2}([ _\-]?)[0-9]{2}\1[0-9]{2}\1[0-9]{2}\1[0-9]{2} *$" name="telephone" type="tel"/></td>
								</tr>
								
								<tr align="left">
									<th><label for="telephoneP"> Téléphone portable:</label></th>
									<td><input id="telephoneP" pattern="^ *[0-9]{2}([ _\-]?)[0-9]{2}\1[0-9]{2}\1[0-9]{2}\1[0-9]{2} *$" name="telephoneP" type="tel"/></td>
								</tr>
								
								<tr align="left">
									<th><label for="fax"> Fax :</label></th>
									<td><input id="fax" name="fax" type="tel"/></td>
								</tr>
								
								<tr align="left">
									<th><label for="mail"> Mail :</label></th>
									<td><input id="mail" name="mail" type="email"/></td>
								</tr>
								
								<th><label for="dateDe"> Date de prévisionnel de début :</label></th>
								<td><input id="dateDe-naissance" name="dateDe" type="datetime-local"/></td>
								
								<tr align="left">
										<th><label for="type"> Type de chantier :</label></th>
										<td><input id="type" name="type" type="text"/></td>
								</tr>
							</table>
							
							<!-- Accès au chantier -->
							<h5 align="center"><u>Accès chantier</u></h5>
						
							<table border="0" align="center">
								<tr align="right">
									<th><label for="clef">Clef :  </label></th>
			
									<td align="center"><label for="oui">Oui :</label>
									<input name="oui1" value="Oui"type="radio"/></td>
									
									<td align="center"><label for="non">Non :</label>
									<input name="oui1" value="Non" type="radio"/></td>
								</tr>
								
								<tr align="right">
									<th><label for="alarme">Alarme :  </label></th>
								

									<td align="center"><label for="oui">Oui :</label>
									<input name="oui2" value="Oui"type="radio"/></td>
									
									<td align="center"><label for="non">Non :</label>
									<input name="oui2" value="Non" type="radio"/></td>
								</tr>
								
								<tr align="left">
									<th><label for="consigne"> Consignes circulation du chantier</label></th>
									<td colspan="2"><textarea name="consigne" id="consigne"  rows="6" cols="30"></textarea></td>
								</tr>
								
								<tr align="left">
										<th><label for="horaire"> Horaire client :</label></th>
										<td align="center"><label for="matin"> Matin </label></td>
										<td align="center"><label for="apresmidi"> Après midi </label></td>
								</tr>
								
								<tr align="left">
										<th><label for="locaux">Locaux occupés :  </label></th>
									

										<td align="center"><label for="oui">Oui :</label>
										<input  name="oui3" value="Oui"type="radio"/></td>
										
										<td align="center"><label for="non">Non :</label>
										<input name="oui3" value="Non" type="radio"/></td>
								</tr>
								
								<tr align="left">
										<th><label for="reunion">Réunion de chantier :  </label></th>
									

										<td align="center"><label for="oui">Oui :</label>
										<input name="oui4" value="Oui"type="radio"/></td>
										
										<td align="center"><label for="non">Non :</label>
										<input  name="oui4" value="Non" type="radio"/></td>
								</tr>
								
								<tr align="left">
										<th><label for="plans">Existence de plans des locaux :  </label></th>
									

										<td align="center"><label for="oui">Oui :</label>
										<input name="oui5" value="Oui"type="radio"/></td>
										
										<td align="center"><label for="non">Non :</label>
										<input name="oui5" value="Non" type="radio"/></td>
								</tr>
								
								<tr align="left">
										<th><label for="parking">Parking :  </label></th>
									

										<td align="center"><label for="oui">Oui :</label>
										<input name="oui6" value="Oui"type="radio"/></td>
										
										<td align="center"><label for="non">Non :</label>
										<input name="oui6" value="Non" type="radio"/></td>
								</tr>
								
								<tr align="left">
										<th><label for="piece">Pièces, vestiaires :  </label></th>
									

										<td align="center"><label for="oui">Oui :</label>
										<input  name="oui7" value="Oui"type="radio"/></td>
										
										<td align="center"><label for="non">Non :</label>
										<input name="oui7" value="Non" type="radio"/></td>
								</tr>
								
								<tr align="left">
										<th><label for="eau">Fourniture de l'eau':  </label></th>
									

										<td align="center"><label for="oui">Oui :</label>
										<input name="oui8" value="Oui"type="radio"/></td>
										
										<td align="center"><label for="non">Non :</label>
										<input name="oui8" value="Non" type="radio"/></td>
								</tr>
								
								<tr align="left">
										<th><label for="electricite">Electricité :  </label></th>
									

										<td align="center"><label for="oui">Oui :</label>
										<input  name="oui9" value="Oui"type="radio"/></td>
										
										<td align="center"><label for="non">Non :</label>
										<input name="oui9" value="Non" type="radio"/></td>
								</tr>
								
								<tr align="left">
										<th><label for="stockage">Stockage :  </label></th>
									

										<td align="center"><label for="oui">Oui :</label>
										<input name="oui10" value="Oui"type="radio"/></td>
										
										<td align="center"><label for="non">Non :</label>
										<input name="oui10" value="Non" type="radio"/></td>
								</tr>
								
								<tr align="left">
										<th><label for="coactivite">Coactivité entreprise :  </label></th>
									

										<td align="center"><label for="oui">Oui :</label>
										<input name="oui11" value="Oui"type="radio"/></td>
										
										<td align="center"><label for="non">Non :</label>
										<input name="oui11" value="Non" type="radio"/></td>
								</tr>
								
								<tr align="left">
										<th><label for="emploi">Emploi outil electro portatif :  </label></th>
									

										<td align="center"><label for="oui">Oui :</label>
										<input name="oui12" value="Oui"type="radio"/></td>
										
										<td align="center"><label for="non">Non :</label>
										<input name="oui12" value="Non" type="radio"/></td>
								</tr>
								
								<tr align="left">
										<th><label for="hauteur">Travail en hauteur :  </label></th>
									

										<td align="center"><label for="oui">Oui :</label>
										<input name="oui13" value="Oui"type="radio"/></td>
										
										<td align="center"><label for="non">Non :</label>
										<input name="oui13" value="Non" type="radio"/></td>
								</tr>
								
								<tr align="left">
										<th><label for="location">Location d'engin' :  </label></th>
									

										<td align="center"><label for="oui">Oui :</label>
										<input name="oui14" value="Oui"type="radio"/></td>
										
										<td align="center"><label for="non">Non :</label>
										<input name="oui14" value="Non" type="radio"/></td>
								</tr>
								
								<tr align="left">
										<th><label for="transport">Transport evacuation gravat:  </label></th>
									

										<td align="center"><label for="oui">Oui :</label>
										<input name="oui15" value="Oui"type="radio"/></td>
										
										<td align="center"><label for="non">Non :</label>
										<input name="oui15" value="Non" type="radio"/></td>
								</tr>
							
								<tr align="left">
									<th><label for="vigilance"> Point de vigilance sécurité</label></th>
									<td colspan="2"><textarea name="consigne" id="consigne"  rows="9" cols="30"></textarea></td>
								</tr>
								
								<tr>
									<td></td>
									<td></td>
									<td align="right"><input type="button" value="Valider"/></td>
								</tr>
															
								<tr>
									<td></td>
									<td></td>
									<td align="right"> Mise a jour le : <?php  $date = date("d-m-Y"); echo $date;?></td>
									
							</table>
						</div>
				</fieldset>
			</div>
		</div>
		<?php  
			include('../footer.php');
		?>