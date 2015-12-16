<?php
$pwd = "../../";
if(isset($_POST['date_select_hebdo']) && isset($_POST['encadrant_select_hebdo']))
{
    include('../../assets.php');
    error_reporting(E_ALL);
    ini_set('display_errors', TRUE);
    ini_set('display_startup_errors', TRUE);
	$db = revivre();
    mysqli_query($db, "SET NAMES 'utf8'");

    $tabJour = Array("Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi");
    $date = DateTime::createFromFormat('d/m/Y', $_POST['date_select_hebdo'])->format('Y-m-d');
    $weekNumber = idate('W', strtotime($date));

    $query = mysqli_query($db, "SELECT max(CRE_id) AS max FROM pl_creneau;");
    $maxCreId = mysqli_fetch_assoc($query)["max"];

    $query = mysqli_query($db, "SELECT concat(pe.PER_Nom,' ',pe.PER_Prenom) AS nom FROM salaries sa
                                    JOIN personnes pe ON pe.PER_NUM = sa.PER_NUM
                                    WHERE sa.SAL_NumSalarie = ".$_POST['encadrant_select_hebdo'].";");
    $encName = mysqli_fetch_assoc($query)["nom"];

    $x=0;
    $query = mysqli_query($db, "SELECT LOGO_Id, LOGO_Url FROM logo
                                JOIN pl_logo USING(LOGO_Id)
                                WHERE PL_id=1 AND ASSOC_date = '".$date."' AND ENC_Num = '".$_POST['encadrant_select_hebdo']."';");
    while($data = mysqli_fetch_assoc($query))
    {
        $tableauLogo[$x++] = $data["LOGO_Url"];
    }

    $content = '<link rel="stylesheet" type="text/css" href="../../css/table.css">
                <page>
                    <h3 class="header-emargement-hebdo">Semaine n°'.$weekNumber.' : lundi '.$_POST['date_select_hebdo'].' au vendredi '.date('d/m/Y', strtotime($date." + 4 day")).'</h3>
                    <table class="emargement-hebdo">
                        <thead>
                            <tr>
                                <th rowspan="2" class="name-col">NOM - Prénom</th>
                                <th colspan="2">Lundi</th>
                                <th colspan="2">Mardi</th>
                                <th colspan="2">Mercredi</th>
                                <th colspan="2">Jeudi</th>
                                <th colspan="2">Vendredi</th>
                            </tr>
                            <tr>
                                <th class="sub-th">MATIN</th>
                                <th class="sub-th">APRÈS-MIDI</th>
                                <th class="sub-th">MATIN</th>
                                <th class="sub-th">APRÈS-MIDI</th>
                                <th class="sub-th">MATIN</th>
                                <th class="sub-th">APRÈS-MIDI</th>
                                <th class="sub-th">MATIN</th>
                                <th class="sub-th">APRÈS-MIDI</th>
                                <th class="sub-th">MATIN</th>
                                <th class="sub-th">APRÈS-MIDI</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>';

    $query = mysqli_query($db, "SELECT DISTINCT pl.SAL_NumSalarie, pe.PER_Num, pe.PER_Nom, pe.PER_Prenom, pl.CRE_id FROM pl_association pl
                                JOIN salaries sa ON pl.SAL_NumSalarie = sa.SAL_NumSalarie
                                JOIN personnes pe ON pe.PER_NUM = sa.PER_NUM
                                WHERE pl.PL_id = 1 AND pl.ENC_NUM = ".$_POST['encadrant_select_hebdo']."
                                AND date_format(pl.ASSOC_date,'%d/%m/%Y') = '".$_POST["date_select_hebdo"]."'
                                ORDER BY pe.PER_Nom, pl.CRE_id;");
    $lastPerNum = -1;
    $CreId = 1;
    $maxCreIdBySal = -1;

    while($data = mysqli_fetch_assoc($query))
    {
        if($lastPerNum != $data["PER_Num"])
        {
            $content .= '</tr><tr><td>'.$data["PER_Nom"]." ".$data["PER_Prenom"].'</td>';
            $lastPerNum = $data["PER_Num"];
            $CreId = 1;

            $query2 = mysqli_query($db, "SELECT max(CRE_id) as max FROM pl_association
                                        WHERE PL_id = 1 AND ENC_Num = ".$_POST['encadrant_select_hebdo']."
                                        AND date_format(ASSOC_date,'%d/%m/%Y') = '".$_POST["date_select_hebdo"]."'
                                        AND SAL_NumSalarie = ".$data["SAL_NumSalarie"].";");

            $maxCreIdBySal = mysqli_fetch_assoc($query2)["max"];
        }

        while($CreId < $data["CRE_id"])
        {
            $content .= '<td style="background-color: lightgrey;"></td>';
            $CreId++;
        }

        $content .= '<td></td>';
        $CreId++;

        while($CreId > $maxCreIdBySal && $CreId <= $maxCreId)
        {
            $content .= '<td style="background-color: lightgrey;"></td>';
            $CreId++;
        }

        if($data["CRE_id"] >= $maxCreId)
        {
            $CreId = 1;
        }
    }

    $content .= '</tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </tbody>
        </table>
        <h4 class="signature-emargement-hebdo">Encadrant '.$encName.' - signature :</h4>
        <page_footer>
            <div style="margin-bottom:8px; text-align:center; padding:0;">';

                for($x=0; $x<sizeof($tableauLogo) && $x<6; $x++)
                {
                    $content.="<img src=\"../".$tableauLogo[$x]."\" style=\"margin:0px 3px;\"/>";
                }

    $content.='</div>
            <h4 style=" text-align:center; margin:0px; font-weight:normal;">
                Association Revivre Service CAP, Chemin de Mondeville - 14460 COLOMBELLES - Imprimée le : '.date('d/m/y').'
            </h4>
        </page_footer>
    </page>';

    $title = "emargement_".str_replace(" ", "_", $encName)."_".str_replace("/", "-", $_POST['date_select_hebdo']).".pdf";

    require_once('../../stuff/html2pdf/html2pdf.class.php');
    $html2pdf = new HTML2PDF('L','A4','fr');
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