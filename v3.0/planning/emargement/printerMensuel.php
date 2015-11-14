<?php
$pwd = "../../";
if(isset($_POST['type_select_mensuel']) && isset($_POST['salarie_select_mensuel']) && isset($_POST['mois_select_mensuel']))
{
    include('../../assets.php');
    error_reporting(E_ALL);
    ini_set('display_errors', TRUE);
    ini_set('display_startup_errors', TRUE);
	$db = revivre();
    mysqli_query($db, "SET NAMES 'utf8'");

    $tabMois = Array("JANVIER", "FEVRIER", "MARS", "AVRIL", "MAI", "JUIN", "JUILLET", "AOUT", "SEPTEMBRE", "OCTOBRE", "NOVEMBRE", "DECEMBRE");
    $nbJours = Array(31, 29, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);

    /*for ($i=0; $i < 12; $i++){
        $calendrier['N_Mois'][$i] = $i+1;
        $calendrier['Mois'][$i] = $tabMois[$i];
        $calendrier['NB_Jours'][$i] = $nbJours[$i];
    }*/

    //$query = mysqli_query($db, "SELECT max(CRE_id) AS max FROM pl_creneau;");
    //$maxCreId = mysqli_fetch_assoc($query)["max"];*/

    $query = mysqli_query($db, "SELECT pe.PER_Nom, pe.PER_Prenom FROM pl_association pl
                                    JOIN salaries sa ON pl.SAL_NumSalarie = sa.SAL_NumSalarie
                                    JOIN personnes pe ON pe.PER_NUM = sa.PER_NUM
                                    WHERE pl.SAL_NumSalarie = ".$_POST['salarie_select_mensuel']);
    $SalName = mysqli_fetch_assoc($query)["PER_Nom"]." ".mysqli_fetch_assoc($query)["PER_Prenom"];

    $x=0;
    $tableauLogo[$x]="";
    $query = mysqli_query($db, "SELECT DISTINCT LOGO_Id, LOGO_Url FROM logo
                                JOIN logo_association USING(LOGO_Id)
                                WHERE PL_id=1 AND date_format(ASSOC_date, '%m') = '".$_POST['mois_select_mensuel']."';");
    while($data = mysqli_fetch_assoc($query))
    {
        $tableauLogo[$x++] = $data["LOGO_Url"];
    }

    $content = '<link rel="stylesheet" type="text/css" href="../../css/table.css">
                <page>
                    <h4 align="right">Présence pour '.$tabMois[$_POST['mois_select_mensuel']-1].' '.$_POST['annee_select_mensuel'].'</h4>
                    <h4 align="left">Salarié : '.$SalName.'</h4>

                    <table class="emargement-hebdo" HEIGHT=10>
                        <thead>
                            <tr>
                                <th rowspan="2">DATE</th>
                                <th colspan="2"style="width:280px"> HORAIRES (Arrivée et Départ)</th>
                                <th rowspan="2">NB<BR>Heures</th>
                                <th rowspan="2" style="width:300px">Commentaires</th>
                            </tr>
                            <tr>
                                <th class="sub-th">MATIN</th>
                                <th class="sub-th">APRÈS-MIDI</th>
                            </tr>
                        </thead>
                        <tbody>';

    for ($i=0; $i<31; $i++){
        if (($i+1) > $nbJours[$_POST['mois_select_mensuel']-1]){
            $content.= '<tr bgcolor="lightgrey"> <td></td><td></td><td></td><td></td><td></td> </tr>';
        }
        else{
        $content.='<tr>
                        <td align="center" bgcolor="lightgrey">'.($i+1).'/'.$_POST['mois_select_mensuel'].'</td>
                        <td align="center"> - </td>
                        <td align="center"> - </td>
                        <td></td>
                        <td></td>
                    </tr>';
            }
    }

    $content .= '
            </tbody>
        </table>
        <page_footer>
            <div style="margin-bottom:8px; text-align:center; padding:0;">';

        for($x=0; $x<sizeof($tableauLogo) && $x<6; $x++)
        {
            $content.="<img src=\"../".$tableauLogo[$x]."\" style=\"margin:0px 3px;\"/>";
        }

    $content.='</div>
            <h4 style=" text-align:center; margin:0px; font-weight:normal;">
                Association Revivre Service CAP, Chemin de Mondeville - 14460 COLOMBELLES
            </h4>
        </page_footer>
    </page>';

    //$title = "emargement_".str_replace(" ", "_", $encName)."_".str_replace("/", "-", $_POST['date_select_hebdo']).".pdf";
    $title = "emargement_mensuel_".$_POST['salarie_select_mensuel'].".pdf";

    require_once('../../stuff/html2pdf/html2pdf.class.php');
    $html2pdf = new HTML2PDF('P','A4','fr');
    $html2pdf->WriteHTML($content);
    $html2pdf->Output($title);
}
else
{
    include('../../bandeau.php');
    echo "<div id=\"corps\">
             <div id=\"bad\">
             <label>Une erreur s'est produite lors de la tentative d'impression !</label>
             </div>
        </div>"; 

    if(isset($_POST['redirectPage']))
    {
        $locationPath = $_POST['redirectPage'];
        echo '<script type="text/javascript">
        window.setTimeout("location=(\''.$locationPath.'\');",2500);
        </script>';
    }
    else
    {
        echo '<script type="text/javascript">
        window.setTimeout("location=(\''.$pwd.'home.php\');",2500);
        </script>';
    }  

    include('../../footer.php');
}
?>