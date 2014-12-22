<?php
$pageTitle = "Bordereau de Livraison";
	include('assets.php');
	$db = revivre();
	$id=$_POST["NumC"];
	$totAchat=0;
	$reponse5 = mysqli_query($db, "SELECT ROUND(SUM(ACH_MONTANT), 2) as totAchat FROM Acheter WHERE CHA_NumDevis='$id' GROUP BY CHA_NumDevis");
	$donnees5 = mysqli_fetch_assoc($reponse5);
	$reponse4 = mysqli_query($db, "SELECT SUM(TRA_Duree) as total FROM TempsTravail ttps WHERE ttps.CHA_NumDevis='$id' GROUP BY CHA_NumDevis");
    $donnees4 = mysqli_fetch_assoc($reponse4);
	$reponse = mysqli_query($db, "SELECT * FROM ChantierMax WHERE CHA_NumDevis='$id' limit 1");
	$donnees = mysqli_fetch_assoc($reponse);
	$resteHeure = $donnees['CHA_HeuresPrev']-$donnees4['total'];
	$resteAchat = $donnees['CHA_AchatsPrev']-$donnees5['totAchat'];
	$content = "
<page>
    <table  style=\"width:100%;\">
        <tr>
            <td style=\"width:13%;\">
            <img src=\"images/logoBW.jpg\">
            </td>
            <td style=\"text-align:center;width:86%;\">
            <h1>Bordereau de livraison</h1>
            </td>
        </tr>
	</table>
	<br>
		<h3 style=\"background-color=gray;\">Client</h3>
		<fieldset>
	<table style=\"padding-left:10px;padding-top:5px;padding-bottom:5px;\">
	    <tr>
			<th style=\"width=150px;\">Structure : </th>
			<td>".formatUP($donnees['Struct'])."</td>
		</tr>
		<tr>
			<th>Nom : </th>
			<td>".formatUP($donnees['Client'])."</td>
		</tr>
		<tr>
			<th>Prénom : </th>
			<td>".formatLOW($donnees['ClientP'])."</td>
		</tr>
		<tr>
			<th>Adresse : </th>
			<td>".formatLOW($donnees['ClientAd'])."</td>
		</tr>
		<tr>
			<th>Ville : </th>
			<td>".formatUP($donnees['ClientV'])."</td>
		</tr>
		<tr>
			<th>Code Postal : </th>
			<td>".$donnees['ClientCP']."</td>
		</tr>
	</table>
	</fieldset>
	<br>
		<h3>Chantier</h3>
		<fieldset>
	<table style=\"padding-left:10px;padding-top:5px;padding-bottom:5px;\">
		<tr>
			<th style=\"width=150px;\">Intitulé : </th>
			<td>".formatLOW($donnees['CHA_Intitule'])."</td>
		</tr>
		<tr>
			<th>Adresse : </th>
			<td>".formatLOW($donnees['CHA_Adresse'])."</td>
		</tr>
		<tr>
			<th>Date de début : </th>
			<td>".dater($donnees['CHA_DateDebut'])."</td>
		</tr>
		<tr>
			<th>Date de fin : </th>
			<td>".dater($donnees['CHA_DateFinReel'])."</td>
		</tr>
		<tr>
			<th>Montant : </th>
			<td>".$donnees['CHA_MontantPrev']." €</td>
		</tr>
		<tr>
			<th>TVA : </th>
			<td>".$donnees['CHA_TVA']." %</td>
		</tr>
		<tr>
			<th>Achats prévus : </th>
			<td>".$donnees['CHA_AchatsPrev']." €</td>
		</tr>
		<tr>
			<th>Achats effectués : </th>
			<td>".$donnees5['totAchat']." €</td>
		</tr>
		<tr>
			<th>Ecart achats : </th>
			<td>".$resteAchat." €</td>
		</tr>
		<tr>
			<th>Heures prévues : </th>
			<td>".$donnees['CHA_HeuresPrev']."</td>
		</tr>
		<tr>
			<th>Heures effectuées : </th>
			<td>".$donnees4['total']."</td>
		</tr>
		<tr>
			<th>Ecart heures : </th>
			<td>".$resteHeure."</td>
		</tr>
	</table>
	</fieldset>
	<br>
		<h3>Responsable</h3>
		<fieldset>
	<table style=\"padding-left:10px;padding-top:5px;padding-bottom:5px;\">
		<tr>
			<th style=\"width=150px;\">Nom : </th>
			<td>".formatUP($donnees['Resp'])."</td>
		</tr>
		<tr>
			<th>Prénom : </th>
			<td>".formatLOW($donnees['RespP'])."</td>
		</tr>
	</table>
	</fieldset>
	<div style=\"text-align:center;padding-top:370px\">".date("d/m/Y")."</div>
</page>";
    if(!empty($donnees['Struct']))
        $title = formatUP($donnees['Struct'])."-".formatLOW($donnees['CHA_Intitule']).".pdf";
    else
        $title = formatUP($donnees['Client'])."_".formatLOW($donnees['ClientP'])."-".formatLOW($donnees['CHA_Intitule']).".pdf";
	require_once('/media/fd0b1/alx22/stuff/html2pdf/html2pdf.class.php');
	$html2pdf = new HTML2PDF('P','A4','fr');
	$html2pdf->WriteHTML($content);
	$html2pdf->Output($title);
?>