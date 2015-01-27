<?php
$pageTitle = "Exporter chantiers";
$pwd = '../';
include('../bandeau.php');
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
    require_once dirname(__FILE__) . '../Classes/PHPExcel.php';
    // require_once('/Classes/PHPExcel/Cell/DataType.php');
    // require_once('/Classes/PHPExcel/Cell.php');
    require_once('/Classes/PHPExcel.php');
    require_once('/Classes/PHPExcel/Cell/DataType.php');
    require_once('/Classes/PHPExcel/RichText.php');
    require_once '/Classes/PHPExcel/IOFactory.php';

    /** Create a new PHPExcel Object  **/
    $objPHPExcel = new PHPExcel();

    $insertion = "SELECT * FROM Chantiers ch JOIN ChantierClient vcl ON ch.CHA_NumDevis=vcl.CNumDevis 
    LEFT JOIN ChantierResp vre ON ch.CHA_NumDevis=vre.RNumDevis 
    LEFT JOIN ChantierEtat cet ON ch.CHA_NumDevis=NumDevis order by CHA_NumDevis ASC
    ";
    $insertion = mysqli_query($db,$insertion);

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
    foreach($insertion as $r => $RowInsertion) 
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
        $objPHPExcel->getActiveSheet()->setCellValue('c'.$r, $RowInsertion['CHA_NumDevis'])
                                      ->setCellValue('d'.$r, $RowInsertion['CHA_Intitule'])
                                      ->setCellValue('e'.$r, $RowInsertion['CHA_Echeance'])
                                      ->setCellValue('f'.$r, $RowInsertion['CHA_DateFinReel'])
                                      ->setCellValue('g'.$r, $RowInsertion['CHA_MontantPrev'])
                                      ->setCellValue('h'.$r, $RowInsertion['CHA_AchatsPrev'])
                                      ->setCellValue('i'.$r, $RowInsertion['CHA_HeuresPrev'])
                                      ->setCellValue('j'.$r, $RowInsertion['CHA_Adresse'])
                                      ->setCellValue('k'.$r, $RowInsertion['CHA_TVA'])
                                      ->setCellValue('l'.$r, $RowInsertion['CHA_TxHoraire'])
                                      ->setCellValueExplicit('m'.$r, $RowInsertion['Client'],PHPExcel_Cell_DataType::TYPE_STRING)
                                      ->setCellValueExplicit('n'.$r, $RowInsertion['ClientTel'],PHPExcel_Cell_DataType::TYPE_STRING)
                                      ->setCellValueExplicit('o'.$r, $RowInsertion['ClientEmail'],PHPExcel_Cell_DataType::TYPE_STRING)
                                      ->setCellValue('p'.$r, $RowInsertion['ClientAd'])
                                      ->setCellValue('q'.$r, $RowInsertion['ClientCP'])
                                      ->setCellValueExplicit('r'.$r, $RowInsertion['ClienV'],PHPExcel_Cell_DataType::TYPE_STRING)
                                      ->setCellValue('s'.$r, $RowInsertion['Structure'])
                                      ->setCellValue('t'.$r, $RowInsertion['Resp'])
                                      ->setCellValue('u'.$r, $RowInsertion['RespP'])
                                      ->setCellValue('v'.$r, $RowInsertion['Etat']);
                                      /*->setCellValue('w'.$r, $RowInsertion['CNV_Nom'])
                                      ->setCellValue('x'.$r, $RowInsertion['INS_NbHeures'])
                                      ->setCellValue('y'.$r, $RowInsertion['INS_NbJours'])
                                      ->setCellValue('z'.$r, $RowInsertion['INS_RevenuDepuis'])
                                      ->setCellValue('aa'.$r, $RowInsertion['INS_SEDepuis'])
                                      ->setCellValue('ab'.$r, $RowInsertion['INS_PEDupuis'])
                                      ->setCellValue('ac'.$r, $RowInsertion['INS_Repas'])
                                      ->setCellValue('ad'.$r, $RowInsertion['INS_Positionmt'])
                                      ->setCellValue('ae'.$r, $RowInsertion['INS_SituGeo'])
                                      ->setCellValueExplicit('af'.$r, $RowInsertion['PER_TelFixe'],PHPExcel_Cell_DataType::TYPE_STRING)
                                      ->setCellValueExplicit('ag'.$r, $RowInsertion['PER_TelPort'],PHPExcel_Cell_DataType::TYPE_STRING)
                                      ->setCellValueExplicit('ah'.$r, $RowInsertion['PER_Fax'],PHPExcel_Cell_DataType::TYPE_STRING)
                                      ->setCellValueExplicit('ai'.$r, $RowInsertion['PER_Email'],PHPExcel_Cell_DataType::TYPE_STRING)
                                      ->setCellValue('aj'.$r, $RowInsertion['PER_Adresse'])
                                      ->setCellValue('ak'.$r, $RowInsertion['PER_CodePostal'])
                                      ->setCellValue('al'.$r, $RowInsertion['PER_Ville']);*/

                                      
        

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