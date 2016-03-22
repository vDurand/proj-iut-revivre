<?php
$pwd = "../../";
if(isset($_POST['salarie_select_mensuel']) && isset($_POST['mois_select_mensuel']) && isset($_POST['annee_select_mensuel']))
{
    include($pwd.'assets.php');
    error_reporting(E_ALL);
    ini_set('display_errors', TRUE);
    ini_set('display_startup_errors', TRUE);
	$db = revivre();
    mysqli_query($db, "SET NAMES 'utf8'");

    $tabMois = Array("JANVIER", "FEVRIER", "MARS", "AVRIL", "MAI", "JUIN", "JUILLET", "AOUT", "SEPTEMBRE", "OCTOBRE", "NOVEMBRE", "DECEMBRE");

    $query = mysqli_query($db, "SELECT concat(pe.PER_Nom, ' ', pe.PER_Prenom) AS nom FROM salaries sa
                                    JOIN personnes pe ON pe.PER_NUM = sa.PER_NUM
                                    WHERE sa.SAL_NumSalarie = ".$_POST['salarie_select_mensuel']);
    $salNamefetch = mysqli_fetch_assoc($query);
    $salName = $salNamefetch["nom"];

    $query = mysqli_query($db, "SELECT DISTINCT LOGO_Id, LOGO_Url FROM logo
                                JOIN pl_logo USING(LOGO_Id)
                                WHERE date_format(ASSOC_date, '%m/%Y') = '".$_POST['mois_select_mensuel']."/".$_POST['annee_select_mensuel']."';");
    $tableauLogo = mysqli_fetch_all($query, MYSQLI_ASSOC);

    ob_start();
?>
<link rel="stylesheet" type="text/css" href="../../css/table.css">
<page backtop="14mm" backbottom="5mm" backleft="4mm" backright="6mm">
    <page_header pageset="old">
        <h4 style="text-align: center;">Salarié : <?php echo stripslashes($salName) ?> -  Présence pour <?php echo $tabMois[$_POST['mois_select_mensuel']-1] ?> <?php echo $_POST['annee_select_mensuel'] ?></h4>
    </page_header pageset="old">
    <page_footer>
        <div style="margin-bottom:8px; text-align:center; padding:0;">
        <?php
            for($x=0; $x<sizeof($tableauLogo) && $x<6; $x++)
            {
                echo '<img src="'.$pwd.$tableauLogo[$x]["LOGO_Url"].'" style="margin:0px 3px;" />';
            }
        ?>
        </div>
        <h4 style=" text-align:center; margin:0px; padding:0; font-weight:normal; font-size: 15px;">
            Association Revivre Service CAP, Chemin de Mondeville - 14460 COLOMBELLES - Imprimée le : <?php echo date('d/m/Y') ?>
        </h4>
    </page_footer>
    <table class="emargement-mensuel">
        <thead>
            <tr>
                <th rowspan="2">DATE</th>
                <th colspan="2">HORAIRES (Arrivée et Départ)</th>
                <th rowspan="2">NB<BR>Heures</th>
                <th rowspan="2">Commentaires</th>
            </tr>
            <tr>
                <th class="sub-th">MATIN</th>
                <th class="sub-th">APRÈS-MIDI</th>
            </tr>
        </thead>
        <tbody>
<?php
    for ($i=0; $i<31; $i++){
        $nombre = cal_days_in_month(CAL_GREGORIAN, $_POST["mois_select_mensuel"], $_POST["annee_select_mensuel"]);
        $date = mktime(0,0,0, $_POST["mois_select_mensuel"], $i+1, $_POST["annee_select_mensuel"]);

        if (($i+1) > $nombre || date('w', $date) == 0 || date('w', $date) == 6 || isJourFerie(date('d/m/Y', $date))){
            echo '<tr style="background-color: lightgrey;">
                    <td style="width: 7%;" colspan="5"></td>
                </tr>';
        }
        else{
            echo '<tr>
                    <td style="width: 7%; background-color: lightgrey;">'.($i+1).'/'.date('m', $date).'</td>
                    <td style="width: 22%;"> - </td>
                    <td style="width: 22%;"> - </td>
                    <td style="width: 15%;"></td>
                    <td style="width: 34%;"></td>
                </tr>';
            }
    }
?>

        </tbody>
        <tfoot>
            <tr>
                <td colspan="3"><h4>Total heures travaillées : </h4></td>
                <td></td>
                <td style="border: none;"></td>
            </tr>
        </tfoot>
    </table>
    <h4 class="signature-emargement-hebdo" style="margin:10px 0 0 0; padding:0px;"> Signature du salarié : </h4>
 </page>
<?php
    $title = "pointage_".str_replace(" ", "_", $salName)."_".strtolower($tabMois[$_POST['mois_select_mensuel']-1])."_".$_POST['annee_select_mensuel'].".pdf";

    $content = ob_get_clean();
    require_once($pwd.'stuff/html2pdf/html2pdf.class.php');
    $html2pdf = new HTML2PDF('P','A4','fr');
    $html2pdf->pdf->SetAuthor('Association Revivre');
    $html2pdf->pdf->SetTitle('Feuille de pointage - '.ucwords(strtolower($tabMois[$_POST['mois_select_mensuel']-1])).' '.$_POST['annee_select_mensuel']);
    $html2pdf->pdf->SetSubject('Feuille de pointage mensuelle, Association Revivre');
    $html2pdf->WriteHTML($content);
    $html2pdf->Output($title);
    exit;
}
else
{
    include('../../bandeau.php');

    echo "<div id=\"corps\">
             <div id=\"bad\">
             <label>Une erreur s'est produite lors de la tentative d'impression !</label>
             </div>
        </div>"; 

    echo '<script type="text/javascript">
        window.setTimeout("location=(\''.$pwd.'planning/emargement/homeEmargement.php\');",2500);
        </script>';
    include('../../footer.php');
}
?>