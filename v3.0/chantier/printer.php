<?php
$pageTitle = "Bordereau de Livraison";
	include('../assets.php');
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
	$db = revivre();
    mysqli_query($db, "SET NAMES 'utf8'");
	$id=$_POST["NumC"];
	$totAchat=0;
	$reponse = mysqli_query($db, "SELECT * FROM ChantierMax LEFT JOIN ChantierAchat USING (CHA_NumDevis) LEFT JOIN ChantierHeure USING (CHA_NumDevis) WHERE CHA_NumDevis='$id' limit 1");
	$donnees = mysqli_fetch_assoc($reponse);
    if(!empty($donnees['Client'])){
        $content = "
            <page>
                <table  style=\"width:100%;\">
                    <tr>
                        <td style=\"width:13%;\">
                        <img src=\"../images/logoBW.jpg\">
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
                        <th>Nom : </th>
                        <td>".formatUP($donnees['Client'])."</td>
                    </tr>
                    <tr>
                        <th>Adresse : </th>
                        <td>".formatLOW($donnees['ClientAd'])."</td>
                    </tr>
                    <tr>
                        <th>Ville : </th>
                        <td>".formatUP($donnees['ClienV'])."</td>
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
                        <th>Numero : </th>
                        <td>".formatUP($donnees['CHA_NumDevis'])."</td>
                    </tr>
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
                        <td>".number_format($donnees['AchatTot'], 2)." €</td>
                    </tr>
                    <tr>
                        <th>Ecart achats : </th>
                        <td>".$donnees['EcartAch']." €</td>
                    </tr>
                    <tr>
                        <th>Heures prévues : </th>
                        <td>".$donnees['CHA_HeuresPrev'].":00</td>
                    </tr>
                    <tr>
                        <th>Heures effectuées : </th>
                        <td>".$donnees['HeureTot']."</td>
                    </tr>
                    <tr>
                        <th>Ecart heures : </th>
                        <td>".$donnees['EcartHeure']."</td>
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
    }
    else{
        $nCli = $donnees['NumClient'];
        $queryParticulier = "SELECT * FROM EmployerClient JOIN Personnes USING (PER_Num) WHERE CLI_NumClient=$nCli";
        $repParticulier = mysqli_query($db, $queryParticulier);
        $dataParticulier = mysqli_fetch_assoc($repParticulier);
        $nom = formatUP($dataParticulier['PER_Nom']);
        $prenom = formatLOW($dataParticulier['PER_Prenom']);
        $tel = $dataParticulier['PER_TelFixe'];
        $address = formatLOW($dataParticulier['PER_Adresse']);
        $ville = formatLOW($dataParticulier['PER_Ville']);
        $cp = $dataParticulier['PER_CodePostal'];
        $content = "
            <page>
                <table  style=\"width:100%;\">
                    <tr>
                        <td style=\"width:13%;\">
                        <img src=\"../images/logoBW.jpg\">
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
                        <th>Nom : </th>
                        <td>".$nom."</td>
                    </tr>
                    <tr>
                        <th>Prénom : </th>
                        <td>".$prenom."</td>
                    </tr>
                    <tr>
                        <th>Adresse : </th>
                        <td>".$address."</td>
                    </tr>
                    <tr>
                        <th>Ville : </th>
                        <td>".$ville."</td>
                    </tr>
                    <tr>
                        <th>Code Postal : </th>
                        <td>".$cp."</td>
                    </tr>
                </table>
                </fieldset>
                <br>
                    <h3>Chantier</h3>
                    <fieldset>
                <table style=\"padding-left:10px;padding-top:5px;padding-bottom:5px;\">
                    <tr>
                        <th>Numero : </th>
                        <td>".formatUP($donnees['CHA_NumDevis'])."</td>
                    </tr>
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
                        <td>".number_format($donnees['AchatTot'], 2)." €</td>
                    </tr>
                    <tr>
                        <th>Ecart achats : </th>
                        <td>".$donnees['EcartAch']." €</td>
                    </tr>
                    <tr>
                        <th>Heures prévues : </th>
                        <td>".$donnees['CHA_HeuresPrev'].":00</td>
                    </tr>
                    <tr>
                        <th>Heures effectuées : </th>
                        <td>".$donnees['HeureTot']."</td>
                    </tr>
                    <tr>
                        <th>Ecart heures : </th>
                        <td>".$donnees['EcartHeure']."</td>
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
    }

    if(!empty($donnees['Struct']))
        $title = formatUP($donnees['Struct'])."-".formatLOW($donnees['CHA_Intitule']).".pdf";
    else
        $title = formatUP($donnees['Client'])."_".formatLOW($donnees['ClientP'])."-".formatLOW($donnees['CHA_Intitule']).".pdf";
	require_once('../stuff/html2pdf/html2pdf.class.php');
	$html2pdf = new HTML2PDF('P','A4','fr');
	$html2pdf->WriteHTML($content);
	$html2pdf->Output($title);
?>