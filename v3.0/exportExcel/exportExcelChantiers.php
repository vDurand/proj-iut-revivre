<?php
$pageTitle = "Exporter chantiers";
$pwd = '../';
include('/bandeau.php');
?>
	<div id="corps">
		<div id="labelT">
			<label>Exporter les données sur excel</label>
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
	require_once dirname(__FILE__) . '/Classes/PHPExcel.php';
	// require_once('/Classes/PHPExcel/Cell/DataType.php');
	// require_once('/Classes/PHPExcel/Cell.php');
	require_once('/Classes/PHPExcel.php');
	require_once('/Classes/PHPExcel/Cell/DataType.php');
	require_once('/Classes/PHPExcel/RichText.php');
	require_once '/Classes/PHPExcel/IOFactory.php';

	/** Create a new PHPExcel Object  **/
	$objPHPExcel = new PHPExcel();

	/***** SOMME DES ACHATS ****/
	$achats = "SELECT sum(ACH_Montant) as sommeAchats from acheter group by cha_numdevis";
	$achats = mysqli_query($db,$achats);

	$letter = 'X';

	$title = array(
		array('titre' => 'Nb achats'),
		);
	foreach ($achats as $i => $RowAchats) {
	 $i = $i + 2;
	 foreach ($title as $t => $RowTitle) {
		

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
			if($letter <> 'X')
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
	  $objPHPExcel->getActiveSheet()->setCellValue('x'.$i, $RowAchats['sommeAchats'].' €');
	}
	mysqli_free_result($achats);
	

	/**** SOMME DES HEURES ****/
	$heure = "SELECT SUM(TRA_Duree) as total FROM TempsTravail ttps WHERE ttps.CHA_NumDevis = CHA_NumDevis GROUP BY CHA_NumDevis";
	$heure = mysqli_query($db,$heure);
	$letter = 'W';

	$title = array(
		array('titre' => 'Nb heures'),
		);
	foreach ($heure as $h => $RowHeure) {
	 $h = $h + 2;
	 foreach ($title as $t => $RowTitle) {
		

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
			if($letter <> 'W')
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
	  $objPHPExcel->getActiveSheet()->setCellValue('w'.$h, $RowHeure['total'].' H');
	}
	mysqli_free_result($heure);
	


	$chantier = "SELECT * FROM Chantiers ch 
	JOIN ChantierClient vcl ON ch.CHA_NumDevis=vcl.CNumDevis 
	LEFT JOIN ChantierResp vre ON ch.CHA_NumDevis=vre.RNumDevis 
	LEFT JOIN ChantierEtat cet ON ch.CHA_NumDevis=NumDevis join etat using(cha_numdevis) 
	where cet.Id = 3
    and tye_id = 3
	";
	$chantier = mysqli_query($db,$chantier);


	$title = array(
		array('titre' => 'Num devis'),
		array('titre' => 'Nom'),
		array('titre' => 'Echeance'),
		array('titre' => 'Fin réelle'),
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
		array('titre' => 'Etat'),
		);

		//var_dump($title);
	//$baseRow = 5;
	$letter = 'C';

	// $i = 0;
	foreach($chantier as $r => $Rowchantier) 
	{
		$r = $r + 2;
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
			if($letter <> 'V')
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
		//Ajout dans les cellules la valeur correspondantes. Pour les cellules de type nombre on definit la cellue en type "chaine"
		$objPHPExcel->getActiveSheet()->setCellValue('c'.$r, $Rowchantier['CHA_NumDevis'])
									  ->setCellValue('d'.$r, $Rowchantier['CHA_Intitule'])
									  ->setCellValue('e'.$r, $Rowchantier['CHA_Echeance'])
									  ->setCellValue('f'.$r, $Rowchantier['CHA_DateFinReel'])
									  ->setCellValue('g'.$r, $Rowchantier['CHA_MontantPrev'])
									  ->setCellValue('h'.$r, $Rowchantier['CHA_AchatsPrev'])
									  ->setCellValue('i'.$r, $Rowchantier['CHA_HeuresPrev'])
									  ->setCellValue('j'.$r, $Rowchantier['CHA_Adresse'])
									  ->setCellValue('k'.$r, $Rowchantier['CHA_TVA'])
									  ->setCellValue('l'.$r, $Rowchantier['CHA_TxHoraire'])
									  ->setCellValueExplicit('m'.$r, $Rowchantier['Client'],PHPExcel_Cell_DataType::TYPE_STRING)
									  ->setCellValueExplicit('n'.$r, $Rowchantier['ClientTel'],PHPExcel_Cell_DataType::TYPE_STRING)
									  ->setCellValueExplicit('o'.$r, $Rowchantier['ClientEmail'],PHPExcel_Cell_DataType::TYPE_STRING)
									  ->setCellValue('p'.$r, $Rowchantier['ClientAd'])
									  ->setCellValue('q'.$r, $Rowchantier['ClientCP'])
									  ->setCellValueExplicit('r'.$r, $Rowchantier['ClienV'],PHPExcel_Cell_DataType::TYPE_STRING)
									  ->setCellValue('s'.$r, $Rowchantier['Structure'])
									  ->setCellValue('t'.$r, $Rowchantier['Resp'])
									  ->setCellValue('u'.$r, $Rowchantier['RespP'])
									  ->setCellValue('v'.$r, $Rowchantier['Etat']);

									  /*->setCellValue('w'.$r, $Rowchantier['CNV_Nom'])
									  ->setCellValue('x'.$r, $Rowchantier['INS_NbHeures'])
									  ->setCellValue('y'.$r, $Rowchantier['INS_NbJours'])
									  ->setCellValue('z'.$r, $Rowchantier['INS_RevenuDepuis'])
									  ->setCellValue('aa'.$r, $Rowchantier['INS_SEDepuis'])
									  ->setCellValue('ab'.$r, $Rowchantier['INS_PEDupuis'])
									  ->setCellValue('ac'.$r, $Rowchantier['INS_Repas'])
									  ->setCellValue('ad'.$r, $Rowchantier['INS_Positionmt'])
									  ->setCellValue('ae'.$r, $Rowchantier['INS_SituGeo'])
									  ->setCellValueExplicit('af'.$r, $Rowchantier['PER_TelFixe'],PHPExcel_Cell_DataType::TYPE_STRING)
									  ->setCellValueExplicit('ag'.$r, $Rowchantier['PER_TelPort'],PHPExcel_Cell_DataType::TYPE_STRING)
									  ->setCellValueExplicit('ah'.$r, $Rowchantier['PER_Fax'],PHPExcel_Cell_DataType::TYPE_STRING)
									  ->setCellValueExplicit('ai'.$r, $Rowchantier['PER_Email'],PHPExcel_Cell_DataType::TYPE_STRING)
									  ->setCellValue('aj'.$r, $Rowchantier['PER_Adresse'])
									  ->setCellValue('ak'.$r, $Rowchantier['PER_CodePostal'])
									  ->setCellValue('al'.$r, $Rowchantier['PER_Ville']);*/

									  
		

	}
					  
//Couleur du haut             


	//$objPHPExcel->getActiveSheet()->removeRow($baseRow-1,1);
	$date = date('d-m-y');
	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	$records = 'export_chantiers_'.$date.'.xlsx';
	$objWriter->save($records);
	echo 'réussi';
?>
		
	</div>
<?php
include('footer.php');
?>