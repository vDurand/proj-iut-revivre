<?php
$pwd = "../";
if(isset($_POST['ENC_Num']) && isset($_POST['ASSOC_Date']) && isset($_POST["PL_id"]))
{
    include($pwd.'assets.php');
    error_reporting(E_ALL);
    ini_set('display_errors', TRUE);
    ini_set('display_startup_errors', TRUE);
	$db = revivre();
    mysqli_query($db, "SET NAMES 'utf8'");

    $query = mysqli_query($db, "SELECT PL_Libelle FROM typeplanning ORDER BY PL_id");
    $nomTypesPlanning = mysqli_fetch_all($query, MYSQLI_ASSOC);

    $listeJours = array("Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi");
    $query = mysqli_query($db, "SELECT concat(PER_Nom, ' ',PER_Prenom) AS nom, CNV_Couleur, CRE_id FROM pl_association
                                JOIN salaries USING(SAL_NumSalarie)
                                JOIN personnes USING(PER_Num)
                                JOIN insertion USING(SAL_NumSalarie)
                                JOIN convention USING(CNV_id)
                                WHERE ASSOC_date = '".$_POST["ASSOC_Date"]."' AND ENC_Num = ".$_POST["ENC_Num"]." AND PL_id = ".$_POST["PL_id"]." ORDER BY CRE_id, nom");
    $planningContenu = mysqli_fetch_all($query, MYSQLI_ASSOC);

    $query = mysqli_query($db, "SELECT DISTINCT ASSOC_Couleur, ASSOC_AM, ASSOC_PM, ASSOC_LastEdit FROM pl_proprietees 
                                WHERE ENC_Num = ".$_POST["ENC_Num"]." AND ASSOC_Date = '".$_POST["ASSOC_Date"]."' AND PL_id = ".$_POST["PL_id"].";");
    $proprietees = mysqli_fetch_assoc($query);

    $query = mysqli_query($db, "SELECT lo.LOGO_Url FROM pl_logo plo JOIN logo lo ON lo.LOGO_id = plo.LOGO_Id
                                WHERE plo.ENC_Num = ".$_POST["ENC_Num"]." AND plo.ASSOC_Date = '".$_POST["ASSOC_Date"]."' AND PL_id = ".$_POST["PL_id"].";");
    $logos =  mysqli_fetch_all($query, MYSQLI_ASSOC);

    $query = mysqli_query($db, "SELECT concat(PER_Nom,' ',PER_Prenom) AS Nom FROM salaries JOIN personnes USING(PER_Num) WHERE SAL_NumSalarie = ".$_POST["ENC_Num"]);
    $nomEncadrant = mysqli_fetch_assoc($query);
    
    $too_much_people = false;
    ob_start();
?>
<link rel="stylesheet" type="text/css" href="../css/planning.css"/>
<page backtop="20mm" backbottom="5mm" backleft="2mm" backright="8mm">
    <page_header>
        <div class="planning-printer-header">
            <h2>PLANNING <?php echo strtoupper($nomTypesPlanning[$_POST["PL_id"]-1]["PL_Libelle"]); ?> DU <?php echo date('d/m/Y',strtotime($_POST['ASSOC_Date'])) ?> AU <?php echo date('d/m/Y',strtotime($_POST['ASSOC_Date']." + 4 day")) ?></h2>
            <h4>Encadrant : <?php echo $nomEncadrant["Nom"] ?></h4>
        </div>
    </page_header>

    <page_footer>
        <div class="planning-printer-footer">
            <div class="planning-printer-logo">
                <?php
                for($x=0; $x<sizeof($logos); $x++){
                    echo '<img src="'.$logos[$x]["LOGO_Url"].'"/>';
                }
                 ?>
            </div>
            <h4>Affiché le <?php echo date("d/m/Y") ?>, Association Revivre Service CAP, Chemin de Mondeville - 14460 COLOMBELLES</h4>
        </div>
    </page_footer>

    <table id="planning-table">
        <thead>
            <tr style="background-color: <?php echo $proprietees["ASSOC_Couleur"] ?>;">
                <th></th>
                <th>Matin<br/><?php echo $proprietees["ASSOC_AM"] ?></th>
                <th>P</th>
                <th>Après-midi<br/><?php echo $proprietees["ASSOC_PM"] ?></th>
                <th>P</th>
            </tr>
        </thead>
        <tbody>
<?php
    $CRE_id = 1; $z=0;
    for($x=0; $x<5; $x++)
    {
        echo '<tr>';
        $dateJourCourant = strtotime($_POST["ASSOC_Date"].' + '.$x.' day');

        if(isJourFerie(date("d/m/Y", $dateJourCourant))){
            echo '<td class="firstColumn"><b>'.$listeJours[$x].'<br>FÉRIÉ</b></td>';
        }
        else{
            echo '<td class="firstColumn"><b>'.$listeJours[$x].'<br>'.date("d/m", $dateJourCourant).'</b></td>';
        }

        for($y=0; $y<2; $y++)
        {
            $lineCount = 0;
            echo '<td><table>';
            while(isset($planningContenu[$z]) && $planningContenu[$z]["CRE_id"] == $CRE_id){
                if($lineCount+1 == 10){
                    echo '<tr><td style="color: '.$planningContenu[$z]["CNV_Couleur"].';">'.$planningContenu[$z++]["nom"].'</td></tr>';
                }
                elseif($lineCount >= 10){
                    $z++;
                    $too_much_people = true;
                }
                else{
                    echo '<tr><td style="color: '.$planningContenu[$z]["CNV_Couleur"].';" class="separator">'.$planningContenu[$z++]["nom"].'</td></tr>';
                }
                $lineCount++;
            }

            for($w=0; $w<(10-$lineCount); $w++){
                if($w+1 < (10-$lineCount)){
                    echo '<tr><td class="separator"></td></tr>';
                }
                else{
                    echo '<tr><td></td></tr>';
                }
            }
            echo'</table></td><td class="thinColumn"><table>';

            for($w=0; $w<($lineCount+(10-$lineCount)); $w++){
                if($w+1 < ($lineCount+(10-$lineCount))){
                    echo '<tr><td class="separator"></td></tr>';
                }
                else{
                    echo '<tr><td></td></tr>';
                }
            }
            echo '</table></td>';
            $CRE_id++;
        }
        echo '</tr>';
    }
?>
        </tbody>
    </table>
</page>
<?php
    $title = "planning_".$nomTypesPlanning[$_POST["PL_id"]-1]["PL_Libelle"]."_".str_replace(" ", "_", $nomEncadrant["Nom"])."_".date('d-m-Y',strtotime($_POST['ASSOC_Date'])).".pdf";
    $content = ob_get_clean();

    if($too_much_people){
        $content .= '<span style="color:red; font-weight:bold; font-style: italic;">Plus de 10 personnes par jour ! Certaines ne sont pas affichées !</span>';
    }

    require_once('../stuff/html2pdf/html2pdf.class.php');
    $html2pdf = new HTML2PDF('P','A4','fr');
    $html2pdf->pdf->SetAuthor('Association Revivre');
    $html2pdf->pdf->SetTitle('Planning '.strtoupper($nomTypesPlanning[$_POST["PL_id"]-1]["PL_Libelle"]).' - '.date('d/m/Y',strtotime($_POST['ASSOC_Date'])));
    $html2pdf->pdf->SetSubject('Planning hebdomadaire, Association Revivre');
    $html2pdf->WriteHTML($content);
    $html2pdf->Output($title);
    exit;
}
else{
    echo '<script type="text/javascript">
        setTimeout(function(){
            $.redirect("./planningShowcase.php", {"ENC_Num": '.$_POST['ENC_Num'].', "ASSOC_Date": "'.$_POST['ASSOC_Date'].'", "PL_id": '.$_POST['PL_id'].'})
        }, 2500);
    </script>';
}
?>