<?php
$pwd = "../../";
if(isset($_POST['date_select_hebdo']) && isset($_POST['encadrant_select_hebdo']) && isset($_POST['plid_select_hebdo']) && isset($_POST['plid_select_hebdo']))
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
    $maxCreIdfetch = mysqli_fetch_assoc($query);
    $maxCreId = $maxCreIdfetch["max"];

    $query = mysqli_query($db, "SELECT concat(pe.PER_Nom,' ',pe.PER_Prenom) AS nom FROM salaries sa
                                    JOIN personnes pe ON pe.PER_NUM = sa.PER_NUM
                                    WHERE sa.SAL_NumSalarie = ".$_POST['encadrant_select_hebdo'].";");
    $encNamefetch = mysqli_fetch_assoc($query);
    $encName = $encNamefetch["nom"];

    $query = mysqli_query($db, "SELECT LOGO_Id, LOGO_Url FROM logo
                                JOIN pl_logo USING(LOGO_Id)
                                WHERE PL_id = ".$_POST['plid_select_hebdo']." AND ASSOC_date = '".$date."' AND ENC_Num = '".$_POST['encadrant_select_hebdo']."';");
    $tableauLogo = mysqli_fetch_all($query, MYSQLI_ASSOC);

    ob_start();
?>
<link rel="stylesheet" type="text/css" href="../../css/table.css">
<page backtop="14mm" backbottom="5mm" backleft="2mm" backright="8mm">
    <page_header>
        <h3 class="header-emargement-hebdo">Semaine n°<?php echo $weekNumber ?> : lundi <?php echo $_POST['date_select_hebdo'] ?> au vendredi <?php echo date('d/m/Y', strtotime($date." + 4 day")) ?></h3>
    </page_header>
    <page_footer>
        <div style="margin-bottom:8px; text-align:center; padding:0;">
        <?php
            for($x=0; $x<sizeof($tableauLogo) && $x<6; $x++)
            {
                echo '<img src="'.$pwd.$tableauLogo[$x]["LOGO_Url"].'" style="margin:0px 3px;" />';
            }
        ?>
        </div>
        <h4 style=" text-align:center; margin:0px; font-weight:normal;">
            Association Revivre Service CAP, Chemin de Mondeville - 14460 COLOMBELLES - Imprimée le : <?php echo date('d/m/Y') ?>
        </h4>
    </page_footer>
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
            <tr>
<?php
    $query = mysqli_query($db, "SELECT DISTINCT pl.SAL_NumSalarie, pe.PER_Num, pe.PER_Nom, pe.PER_Prenom, pl.CRE_id FROM pl_association pl
                                JOIN salaries sa ON pl.SAL_NumSalarie = sa.SAL_NumSalarie
                                JOIN personnes pe ON pe.PER_NUM = sa.PER_NUM
                                WHERE pl.PL_id = ".$_POST['plid_select_hebdo']." AND pl.ENC_NUM = ".$_POST['encadrant_select_hebdo']."
                                AND date_format(pl.ASSOC_date,'%d/%m/%Y') = '".$_POST["date_select_hebdo"]."' ORDER BY pe.PER_Nom, pl.CRE_id;");
    $lastPerNum = -1;
    $CreId = 1;
    $maxCreIdBySal = -1;
    $max_line_per_page = 15;
    $live_person_counter = 0;

    while($data = mysqli_fetch_assoc($query))
    {
        if($lastPerNum != $data["PER_Num"])
        {
            if(++$live_person_counter%15 == 0){
                echo '</tr>
                    </tbody>
                </table>
                <h4 class="signature-emargement-hebdo">Encadrant '.$encName.' - signature :</h4>
            </page>
            <page backtop="14mm" backbottom="5mm" backleft="2mm" backright="8mm">
                <page_header>
                    <h3 class="header-emargement-hebdo">Semaine n°'.$weekNumber.' : lundi '.$_POST['date_select_hebdo'].' au vendredi '.date('d/m/Y', strtotime($date." + 4 day")).'</h3>
                </page_header>
                <page_footer>
                    <div style="margin-bottom:8px; text-align:center; padding:0;">';

                        for($x=0; $x<sizeof($tableauLogo) && $x<6; $x++)
                        {
                            echo '<img src="'.$pwd.$tableauLogo[$x]["LOGO_Url"].'" style="margin:0px 3px;" />';
                        }

                echo '</div>
                    <h4 style=" text-align:center; margin:0px; font-weight:normal;">
                        Association Revivre Service CAP, Chemin de Mondeville - 14460 COLOMBELLES - Imprimée le : '.date('d/m/Y').'
                    </h4>
                </page_footer>
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
            }
            else{
                echo '</tr><tr>';
            }

            echo '<td class="sal-name-cell">'.$data["PER_Nom"]." ".$data["PER_Prenom"].'</td>';
            $lastPerNum = $data["PER_Num"];
            $CreId = 1;

            $query2 = mysqli_query($db, "SELECT max(CRE_id) as max FROM pl_association
                                        WHERE PL_id = ".$_POST['plid_select_hebdo']." AND ENC_Num = ".$_POST['encadrant_select_hebdo']."
                                        AND date_format(ASSOC_date,'%d/%m/%Y') = '".$_POST["date_select_hebdo"]."'
                                        AND SAL_NumSalarie = ".$data["SAL_NumSalarie"].";");

            $maxCreIdBySalfetch = mysqli_fetch_assoc($query2);
            $maxCreIdBySal = $maxCreIdBySalfetch["max"];
        }

        while($CreId < $data["CRE_id"])
        {
            echo '<td style="background-color: lightgrey;"></td>';
            $CreId++;
        }

        echo '<td></td>';
        $CreId++;

        while($CreId > $maxCreIdBySal && $CreId <= $maxCreId)
        {
            echo '<td style="background-color: lightgrey;"></td>';
            $CreId++;
        }

        if($data["CRE_id"] >= $maxCreId)
        {
            $CreId = 1;
        }
    }

    echo '</tr>';
    $live_person_counter++;
    while(++$live_person_counter%15 != 0){
        echo '<tr>
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
            </tr>';
    }
?>
            </tbody>
        </table>
        <h4 class="signature-emargement-hebdo">Encadrant <?php echo $encName ?> - signature :</h4>
    </page>

<?php
    $title = "emargement_".str_replace(" ", "_", $encName)."_".str_replace("/", "-", $_POST['date_select_hebdo']).".pdf";
    
    $content = ob_get_clean();
    require_once($pwd.'stuff/html2pdf/html2pdf.class.php');
    $html2pdf = new HTML2PDF('L','A4','fr');
    $html2pdf->pdf->SetAuthor('Association Revivre');
    $html2pdf->pdf->SetTitle('Feuille d\'émargement - '.$_POST['date_select_hebdo']);
    $html2pdf->pdf->SetSubject('Feuille émargement hebdomadaire, Association Revivre');
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