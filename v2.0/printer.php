<?php
	$content = "
<page>
	<h1><img src=\"images/logoBW.jpg\"> Bordereau de livraison</h1>
	<br>
		<h3>Client</h3>
		<fieldset>
	<table>
		<tr>
			<th>Nom : </th>
			<td>???</td>
		</tr>
		<tr>
			<th>Prénom : </th>
			<td>???</td>
		</tr>
		<tr>
			<th>Adresse : </th>
			<td>???</td>
		</tr>
		<tr>
			<th>Ville : </th>
			<td>???</td>
		</tr>
		<tr>
			<th>Code Postal : </th>
			<td>???</td>
		</tr>
	</table>
	</fieldset>
	<br>
		<h3>Chantier</h3>
		<fieldset>
	<table>
		<tr>
			<th>Intitulé : </th>
			<td>???</td>
		</tr>
		<tr>
			<th>Adresse : </th>
			<td>???</td>
		</tr>
		<tr>
			<th>Date de début : </th>
			<td>???</td>
		</tr>
		<tr>
			<th>Date de fin : </th>
			<td>???</td>
		</tr>
		<tr>
			<th>Montant : </th>
			<td>???</td>
		</tr>
		<tr>
			<th>TVA : </th>
			<td>???</td>
		</tr>
		<tr>
			<th>Achats prévus : </th>
			<td>???</td>
		</tr>
		<tr>
			<th>Achats effectués : </th>
			<td>???</td>
		</tr>
		<tr>
			<th>Ecart achats : </th>
			<td>???</td>
		</tr>
		<tr>
			<th>Heures prévues : </th>
			<td>???</td>
		</tr>
		<tr>
			<th>Heures effectuées : </th>
			<td>???</td>
		</tr>
		<tr>
			<th>Ecart MO : </th>
			<td>???</td>
		</tr>
	</table>
	</fieldset>
	<br>
		<h3>Responsable</h3>
		<fieldset>
	<table>
		<tr>
			<th>Nom : </th>
			<td>???</td>
		</tr>
		<tr>
			<th>Prénom : </th>
			<td>???</td>
		</tr>
	</table>
	</fieldset>
</page>";

	require_once('/media/fd0b1/alx22/stuff/html2pdf/html2pdf.class.php');
	$html2pdf = new HTML2PDF('P','A4','fr');
	$html2pdf->WriteHTML($content);
	$html2pdf->Output('exemple.pdf');
?>