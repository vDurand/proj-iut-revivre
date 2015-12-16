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

    $nomTypesPlanning = ["ACI", "OCCUPATIONNEL", "STAGIAIRE"];
    $listeJours = ["Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi"];
    $query = mysqli_query($db, "SELECT concat(PER_Nom, ' ',PER_Prenom) AS nom, CNV_Couleur, CRE_id FROM pl_association
                                JOIN salaries USING(SAL_NumSalarie)
                                JOIN personnes USING(PER_Num)
                                JOIN insertion USING(SAL_NumSalarie)
                                JOIN convention USING(CNV_id)
                                WHERE ASSOC_date = '".$_POST["ASSOC_Date"]."' AND ENC_Num = ".$_POST["ENC_Num"]." AND PL_id = ".$_POST["PL_id"]." ORDER BY CRE_id, nom");
    $planningContenu = mysqli_fetch_all($query, MYSQLI_ASSOC);

    $query = mysqli_query($db, "SELECT DISTINCT ASSOC_Couleur, ASSOC_AM, ASSOC_PM, ASSOC_LastEdit FROM pl_proprietees 
                                WHERE ENC_Num = ".$_POST["ENC_Num"]." AND ASSOC_Date = '".$_POST["ASSOC_Date"]."'");
    $proprietees = mysqli_fetch_assoc($query);

    $query = mysqli_query($db, "SELECT lo.LOGO_Url FROM pl_logo plo JOIN logo lo ON lo.LOGO_id = plo.LOGO_Id
                                WHERE plo.ENC_Num = ".$_POST["ENC_Num"]." AND plo.ASSOC_Date = '".$_POST["ASSOC_Date"]."';");
    $logos =  mysqli_fetch_all($query, MYSQLI_ASSOC);

    $query = mysqli_query($db, "SELECT concat(PER_Nom,' ',PER_Prenom) AS Nom FROM salaries JOIN personnes USING(PER_Num) WHERE SAL_NumSalarie = ".$_POST["ENC_Num"]);
    $nomEncadrant = mysqli_fetch_assoc($query);

    $content = '<link rel="stylesheet" type="text/css" href="../css/planning.css">
    <page>
        <div class="planning-printer">
            <h2>PLANNING '.$nomTypesPlanning[$_POST["PL_id"]-1].' DU '.date('d/m/Y',strtotime($_POST['ASSOC_Date'])).' AU '.date('d/m/Y',strtotime($_POST['ASSOC_Date']." + 4 day")).'</h2>
            <h4>Encadrant : '.$nomEncadrant["Nom"].'</h4>
            <table>
                <thead>
                    <tr style="background-color: '.$proprietees["ASSOC_Couleur"].';">
                        <th class="firstColumn"></th>
                        <th>Matin<br/>'.$proprietees["ASSOC_AM"].'</th>
                        <th class="thinColumn">P</th>
                        <th>Après-midi<br/>'.$proprietees["ASSOC_PM"].'</th>
                        <th class="thinColumn">P</th>
                    </tr>
                </thead>
                <tbody>';
    $CRE_id = 1;
    $z=0;

    for($x=0; $x<5; $x++)
    {
        $content.='<tr>';

        $dateJourCourant = strtotime($_POST["ASSOC_Date"].' + '.$x.' day');

        if(isJourFerie(date("d/m/Y", $dateJourCourant))){
            $content.='<td><b>'.$listeJours[$x].'<br>FÉRIÉ</b></td>';
        }
        else{
            $content.='<td><b>'.$listeJours[$x].'<br>'.date("d/m", $dateJourCourant).'</b></td>';
        }

        for($y=0; $y<2; $y++)
        {
            $content.='<td>';
            while(isset($planningContenu[$z]) && $planningContenu[$z]["CRE_id"] == $CRE_id){
                $content.='<span style="color: '.$planningContenu[$z]["CNV_Couleur"].';">'.$planningContenu[$z++]["nom"].'</span><br/>';
            }
            $content.='</td><td></td>';
            $CRE_id++;
        }

        $content.='</tr>';
    }
    $content.='</tbody>
            </table>
        </div>
        <page_footer>
            <div class="planning-printer-logo">';

    for($x=0; $x<sizeof($logos); $x++){
        $content.='<img src="'.$logos[$x]["LOGO_Url"].'"/>';
    }

    $content.='</div>
            
            <h4 style="text-align:center; margin:0px; font-weight:normal;">
                Affiché le '.date("d/m/Y").', Association Revivre Service CAP, Chemin de Mondeville - 14460 COLOMBELLES
            </h4>
        </page_footer>
    </page>';

    $title = "planning_".str_replace(" ", "_", $nomEncadrant["Nom"])."_".str_replace("/", "-", $_POST['ASSOC_Date']).".pdf";

    require_once('../stuff/html2pdf/html2pdf.class.php');
    $html2pdf = new HTML2PDF('P','A4','fr');
    $html2pdf->WriteHTML($content);
    $html2pdf->Output($title);
}
else{
    echo '<script type="text/javascript">
        setTimeout(function(){
            $.redirect("./planningShowcase.php", {"ENC_Num": '.$_POST['ENC_Num'].', "ASSOC_Date": "'.$_POST['ASSOC_Date'].'", "PL_id": '.$_POST['PL_id'].'})
        }, 2500);
    </script>';
}
?>