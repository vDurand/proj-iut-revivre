<?php
$pageTitle = "Exporter salariés en insertion";
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

    $insertion = "SELECT * from salaries 
    JOIN insertion using (SAL_NumSalarie) 
    join Convention using (CNV_Id)
    join Contrat using (CNT_Id)
    join personnes using (PER_Num)
    join Fonction using (FCT_Id)
    join type using (TYP_Id)
    join referents using(REF_NumRef)
    ";
    $insertion = mysqli_query($db,$insertion);

    $title = array(
        array('titre' => 'Num salarie'),
        array('titre' => 'Nom'),
        array('titre' => 'Prenom'),
        array('titre' => 'Fonction'),
        array('titre' => 'Type'),
        array('titre' => 'Date Entretien'),
        array('titre' => 'Date naissance'),
        array('titre' => 'Lieu naissance'),
        array('titre' => 'Nationalité'),
        array('titre' => 'Situation'),
        array('titre' => 'Num Pole Emploi'),
        array('titre' => 'Num Sécu'),
        array('titre' => 'Num CAF'),
        array('titre' => 'Niv scolaire'),
        array('titre' => 'Diplome'),
        array('titre' => 'Num permis'),
        array('titre' => 'Reconnaissance TH'),
        array('titre' => 'Revenu'),
        array('titre' => 'Mutuelle'),
        array('titre' => 'Contrat'),
        array('titre' => 'Convention'),
        array('titre' => 'Nb heures'),
        array('titre' => 'Nb jours'),
        array('titre' => 'Revenu depuis'),
        array('titre' => 'Sans emploi'),
        array('titre' => 'Pole emploi depuis'),
        array('titre' => 'Repas'),
        array('titre' => 'Positionnement CAP'),
        array('titre' => 'Situation géo'),
        array('titre' => 'tel fixe'),
        array('titre' => 'Tel port'),
        array('titre' => 'Fax'),
        array('titre' => 'Email'),
        array('titre' => 'Adresse'),
        array('titre' => 'Code postal'),
        array('titre' => 'Ville'),
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
            if($letter <> 'AL')
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
        $objPHPExcel->getActiveSheet()->setCellValue('c'.$r, $RowInsertion['SAL_NumSalarie'])
                                      ->setCellValue('d'.$r, $RowInsertion['PER_Prenom'])
                                      ->setCellValue('e'.$r, $RowInsertion['PER_Nom'])
                                      ->setCellValue('f'.$r, $RowInsertion['FCT_Nom'])
                                      ->setCellValue('g'.$r, $RowInsertion['TYP_Nom'])
                                      ->setCellValue('h'.$r, $RowInsertion['INS_DateEntretien'])
                                      ->setCellValue('i'.$r, $RowInsertion['INS_DateN'])
                                      ->setCellValue('j'.$r, $RowInsertion['INS_LieuN'])
                                      ->setCellValue('k'.$r, $RowInsertion['INS_Nation'])
                                      ->setCellValue('l'.$r, $RowInsertion['INS_SituationF'])
                                      ->setCellValueExplicit('m'.$r, $RowInsertion['INS_NPoleEmp'],PHPExcel_Cell_DataType::TYPE_STRING)
                                      ->setCellValueExplicit('n'.$r, $RowInsertion['INS_NSecu'],PHPExcel_Cell_DataType::TYPE_STRING)
                                      ->setCellValueExplicit('o'.$r, $RowInsertion['INS_NCaf'],PHPExcel_Cell_DataType::TYPE_STRING)
                                      ->setCellValue('p'.$r, $RowInsertion['INS_NivScol'])
                                      ->setCellValue('q'.$r, $RowInsertion['INS_Diplome'])
                                      ->setCellValueExplicit('r'.$r, $RowInsertion['INS_Permis'],PHPExcel_Cell_DataType::TYPE_STRING)
                                      ->setCellValue('s'.$r, $RowInsertion['INS_RecoTH'])
                                      ->setCellValue('t'.$r, $RowInsertion['INS_Revenu'])
                                      ->setCellValue('u'.$r, $RowInsertion['INS_Mutuelle'])
                                      ->setCellValue('v'.$r, $RowInsertion['CNT_Nom'])
                                      ->setCellValue('w'.$r, $RowInsertion['CNV_Nom'])
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
                                      ->setCellValue('al'.$r, $RowInsertion['PER_Ville']);

                                      
        

    }
                      
//Couleur du haut             


    //$objPHPExcel->getActiveSheet()->removeRow($baseRow-1,1);
    $date = date('d-m-y');
    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
    $records = 'export_insertion_'.$date.'.xlsx';
    $objWriter->save($records);
    echo 'réussi';
?>
        
    </div>
<?php
include('footer.php');
?>