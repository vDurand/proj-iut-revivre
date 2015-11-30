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

    $query = mysqli_query($db, "SELECT pe.PER_Nom, pe.PER_Prenom FROM pl_association pl
                                    JOIN salaries sa ON pl.SAL_NumSalarie = sa.SAL_NumSalarie
                                    JOIN personnes pe ON pe.PER_NUM = sa.PER_NUM
                                    WHERE pl.SAL_NumSalarie = ".$_POST['salarie_select_mensuel']);
    $SalName = mysqli_fetch_assoc($query)["PER_Nom"]." ".mysqli_fetch_assoc($query)["PER_Prenom"];

    $x=0;
    $tableauLogo[$x]="";
    $query = mysqli_query($db, "SELECT DISTINCT LOGO_Id, LOGO_Url FROM logo
                                JOIN logo_association USING(LOGO_Id)
                                WHERE PL_id=1 AND date_format(ASSOC_date, '%m/%Y') = '".$_POST['mois_select_mensuel']."/".$_POST['annee_select_mensuel']."';");

    /*echo "SELECT DISTINCT LOGO_Id, LOGO_Url FROM logo
                                JOIN logo_association USING(LOGO_Id)
                                WHERE PL_id=1 AND date_format(ASSOC_date, '%m/%Y') = '".$_POST['mois_select_mensuel']."/".$_POST['annee_select_mensuel']."';";

    echo mysqli_num_rows($query);*/

    // -------------------------
    // -------------------------
    // -------------------------
    // -------------------------
    // /!\ INTEGRER L'ANNEEE !!!
    // -------------------------
    // -------------------------
    // -------------------------
    // -------------------------

    while($data = mysqli_fetch_assoc($query))
    {
        $tableauLogo[$x++] = $data["LOGO_Url"];
    }

    $content = '<link rel="stylesheet" type="text/css" href="../../css/table.css">
                <page>
                    <table align="center">
                        <tr>
                            <td><h4 text-align="right"> Salarié : '.$SalName.' (INSERTION) -  Présence pour '.$tabMois[$_POST['mois_select_mensuel']-1].' '.$_POST['annee_select_mensuel'].'  </h4></td>
                        </tr>
                    </table>

                    <table class="emargement-mensuel" HEIGHT=10>
                        <thead>
                            <tr>
                                <th rowspan="2">DATE</th>
                                <th colspan="2"style="width:240px"> HORAIRES (Arrivée et Départ)</th>
                                <th rowspan="2" style="width:100px">NB<BR>Heures</th>
                                <th rowspan="2" style="width:240px">Commentaires</th>
                            </tr>
                            <tr>
                                <th class="sub-th">MATIN</th>
                                <th class="sub-th">APRÈS-MIDI</th>
                            </tr>
                        </thead>
                        <tbody>';

    for ($i=0; $i<31; $i++){
        $nombre = cal_days_in_month(CAL_GREGORIAN, $_POST["mois_select_mensuel"], $_POST["annee_select_mensuel"]);
        $date = mktime(0,0,0, $_POST["mois_select_mensuel"], $i+1, $_POST["annee_select_mensuel"]);

        if (($i+1) > $nombre || date('w', $date) == 0 || date('w', $date) == 6 || isJourFerie(date('d/m/Y', $date))){
            $content.= '
                            <tr bgcolor="lightgrey">
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>';
        }
        else{
            $content.='     <tr>
                                <td align="center" bgcolor="lightgrey">'.($i+1).'/'.date('m', $date).'</td>
                                <td align="center"> - </td>
                                <td align="center"> - </td>
                                <td></td>
                                <td></td>
                            </tr>';
            }
    }

    $content .= '
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="3"><h3> Total Heures travaillées : </h3></td>
                                <td> </td>
                                <td border="0px"> </td>
                            </tr>
                        </tfoot>
                    </table>
                    <h4 class="signature-emargement-hebdo"> Signature du salarié : </h4>
                    <page_footer>
                        <div style="margin-bottom:8px; text-align:center; padding:0;">';

                            for($x=0; $x<sizeof($tableauLogo) && $x<6; $x++)
                            {
                                $content.="<img src=\"../".$tableauLogo[$x]."\" style=\"margin:0px 3px;\">";
                            } 

    $content.='
                        </div>
                        <h5 style="text-align:center; margin:0px; font-weight:normal;">
                            Association Revivre Service CAP, Chemin de Mondeville - 14460 COLOMBELLES - Imprimée le : '.date('d/m/y').'
                        </h5>
                    </page_footer>
                </page>';

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