<?php

$pageTitle = "Exporter chantiers";
$pwd = '../';
include ('../bandeau.php');
?>
	<div id="corps">
		<div id="labelT">
			<label>Export des chantiers réussi</label>
		</div>
		<br>
		<?php
	
	
	/** Error reporting */
	error_reporting(E_ALL);
	ini_set('display_errors', TRUE);
	ini_set('display_startup_errors', TRUE);
	date_default_timezone_set('Europe/London');

	define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');

	/** Include PHPExcel */
	require_once dirname(__FILE__) . ('/Classes/PHPExcel.php');
	// require_once('/Classes/PHPExcel/Cell/DataType.php');
	// require_once('/Classes/PHPExcel/Cell.php');
	// require_once('/Classes/PHPExcel.php');
	require_once dirname(__FILE__) . ('/Classes/PHPExcel/Cell/DataType.php');
	require_once dirname(__FILE__) . ('/Classes/PHPExcel/RichText.php');
	require_once dirname(__FILE__) . ('/Classes/PHPExcel/IOFactory.php');

	/** Create a new PHPExcel Object  **/
	$objPHPExcel = new PHPExcel();

	$chantier = "SELECT * FROM ChantierMax LEFT JOIN ChantierAchat USING (CHA_NumDevis) LEFT JOIN ChantierHeure USING (CHA_NumDevis) WHERE IdMax = 3 ORDER BY CHA_NumDevis";
	$chantier = mysqli_query($db,$chantier);


	$title = array(
		array('titre' => 'Num devis'),
		array('titre' => 'Nom'),
		array('titre' => 'Echeance'),
		array('titre' => 'Debut'),
		array('titre' => 'Montant prévu'),
		array('titre' => 'Achats prévu'),
		array('titre' => 'Heures prévue'),
		array('titre' => 'Adresse'),
		array('titre' => 'TVA'),
		array('titre' => 'Taux horaire'),
		array('titre' => 'Client'),
		array('titre' => 'ClientTel'),
		array('titre' => 'ClientEmail'),
		array('titre' => 'Adresse client'),
		array('titre' => 'Client CP'),
		array('titre' => 'Client ville'),
		array('titre' => 'Structure'),
		array('titre' => 'Resp'),
		array('titre' => 'RespP'),
        array('titre' => 'Nb heures'),
        array('titre' => 'Nb achats')
		);

	$letter = 'A';

    $r = 1;
    while ($Rowchantier = mysqli_fetch_assoc($chantier)){
		$r++;
		foreach($title as $a => $RowTitle) 
		{
			//Autosize des colonnes
			$objPHPExcel->getActiveSheet()->getColumnDimension($letter)->setAutoSize(true);
			//Affichage du titre dans la ligne 1 avec incrémentation auto de la lettre
			$objPHPExcel->getActiveSheet()->setCellValue($letter.'1',$RowTitle['titre']);

			//Couleur titre
			$objPHPExcel->getActiveSheet()->getStyle($letter.'1')->applyFromArray(
				array('fill' => array(
										'type' => PHPExcel_Style_Fill::FILL_SOLID,
										'color' => array('rgb' => 'E7E7E7')
									)
					)
			);
			if($letter <> 'U')
			{
				   if($letter == 'z')
				   {
						$letter = 'A'.++$letter;
				   }
				   else
				   {
						$letter = ++$letter;
				   }
			}
		}
        if(empty($Rowchantier['HeureTot'])){
            $Rowchantier['HeureTot'] = "00:00";
        }
        if(empty($Rowchantier['AchatTot'])){
            $Rowchantier['AchatTot'] = "0";
        }
        if(empty($Rowchantier['CHA_MontantPrev'])){$Rowchantier['CHA_MontantPrev'] = "0";}
        if(empty($Rowchantier['CHA_AchatsPrev'])){$Rowchantier['CHA_AchatsPrev'] = "0";}
        if(empty($Rowchantier['CHA_HeuresPrev'])){$Rowchantier['CHA_HeuresPrev'] = "0";}
        if(empty($Rowchantier['Client'])){
            $numC = $Rowchantier['NumClient'];
            $clientinfo = "select PER_Nom, PER_Prenom, PER_TelFixe, PER_Email, PER_Adresse, PER_CodePostal, PER_Ville
                            from EmployerClient join Personnes
                            using (PER_Num) where CLI_NumClient = $numC;
                            ";
            $clientinfo = mysqli_query($db,$clientinfo);
            $Rowclient = mysqli_fetch_assoc($clientinfo);
            $Rowchantier['Client'] = $Rowclient['PER_Nom']. " ".$Rowclient['PER_Prenom'];
            $Rowchantier['ClientTel'] = $Rowclient['PER_TelFixe'];
            $Rowchantier['ClientEmail'] = $Rowclient['PER_Email'];
            $Rowchantier['ClientAd'] = $Rowclient['PER_Adresse'];
            $Rowchantier['ClientCP'] = $Rowclient['PER_CodePostal'];
            $Rowchantier['ClienV'] = $Rowclient['PER_Ville'];
            $Rowchantier['Structure'] = "Particulier";

            mysqli_free_result($clientinfo);
        }
		//Ajout dans les cellules la valeur correspondantes. Pour les cellules de type nombre on definit la cellue en type "chaine"
		$objPHPExcel->getActiveSheet()->setCellValue('a'.$r, $Rowchantier['CHA_NumDevis'])
									  ->setCellValue('b'.$r, $Rowchantier['CHA_Intitule'])
									  ->setCellValue('c'.$r, $Rowchantier['CHA_Echeance'])
									  ->setCellValue('d'.$r, $Rowchantier['CHA_DateDebut'])
									  ->setCellValue('e'.$r, $Rowchantier['CHA_MontantPrev'].' €')
									  ->setCellValue('f'.$r, $Rowchantier['CHA_AchatsPrev'].' €')
									  ->setCellValue('g'.$r, $Rowchantier['CHA_HeuresPrev'])
									  ->setCellValue('h'.$r, $Rowchantier['CHA_Adresse'])
									  ->setCellValue('i'.$r, $Rowchantier['CHA_TVA'])
									  ->setCellValue('j'.$r, $Rowchantier['CHA_TxHoraire'])
									  ->setCellValueExplicit('k'.$r, $Rowchantier['Client'],PHPExcel_Cell_DataType::TYPE_STRING)
									  ->setCellValueExplicit('l'.$r, $Rowchantier['ClientTel'],PHPExcel_Cell_DataType::TYPE_STRING)
									  ->setCellValueExplicit('m'.$r, $Rowchantier['ClientEmail'],PHPExcel_Cell_DataType::TYPE_STRING)
									  ->setCellValue('n'.$r, $Rowchantier['ClientAd'])
									  ->setCellValue('o'.$r, $Rowchantier['ClientCP'])
									  ->setCellValueExplicit('p'.$r, $Rowchantier['ClienV'],PHPExcel_Cell_DataType::TYPE_STRING)
									  ->setCellValue('q'.$r, $Rowchantier['Structure'])
									  ->setCellValue('r'.$r, $Rowchantier['Resp'])
									  ->setCellValue('s'.$r, $Rowchantier['RespP'])
                                      ->setCellValue('t'.$r, $Rowchantier['HeureTot'].' H')
                                      ->setCellValue('u'.$r, number_format($Rowchantier['AchatTot'], 2).' €');

	}
					  
//Couleur du haut             


	//$objPHPExcel->getActiveSheet()->removeRow($baseRow-1,1);
	$date = date('d-m-y');
	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	$records = 'export_chantiers.xlsx';
	// $objWriter->save('php://output');	
	$objWriter->save($records);


?>
	<script>
		document.location.href="exportC.php";
	</script>
		
	</div>
<?php
include($pwd.'footer.php');
?>