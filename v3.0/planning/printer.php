<?php
$title = "Impression_du_planning.pdf";
    $pwd = "../";
if(isset($_POST['Date']) && isset($_POST['typePL']))
{
    include('../assets.php');

    $content = "";

    $typeplanning = $_POST['typePL'];

    error_reporting(E_ALL);
    ini_set('display_errors', TRUE);
    ini_set('display_startup_errors', TRUE);
	$db = revivre();
    mysqli_query($db, "SET NAMES 'utf8'");

    $date=DateTime::createFromFormat('d/m/Y', $_POST["Date"])->format('Y-m-d');
    $tabDate = Array("Aucune date");
    $tabJour = Array("Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi");

    $reponse = mysqli_query($db, "select distinct concat(concat(upper(PER_nom),' '),PER_prenom) as 'nom', ENC_Num
                    from pl_association join salaries sa on sa.SAL_NumSalarie = ENC_Num 
                    join personnes using(PER_Num) where ASSOC_date='".$date."' AND PL_id = '".$typeplanning."' ORDER BY ENC_Num;");
    
    $x=0;
    while($donnees = mysqli_fetch_assoc($reponse))
    {
        $encadrant[$x] = $donnees["ENC_Num"];
        $encadrantNom[$x++] = $donnees["nom"];
    }
    
    $x=0;
    $query = mysqli_query($db, "SELECT LOGO_Id, LOGO_Url FROM logo
                                JOIN logo_association USING(LOGO_Id)
                                WHERE PL_id=".$typeplanning." AND ASSOC_date = '".$date."';");
    while($data = mysqli_fetch_assoc($query))
    {
        $tableauLogo[$x++] = $data["LOGO_Url"];
    }
    
    mysqli_free_result($reponse);
    $compteur=$w=$m=0;
    $content.="<link rel=\"stylesheet\" type=\"text/css\" href=\"../css/table.css\">";
    
    while ($compteur < sizeof($encadrant)/2)
    {
        $content.="
            <page>
                <h2 style=\"text-align:center; margin:10px 0px;\">PLANNING DU ".date('d/m/Y',strtotime($date))." AU ".date('d/m/Y',strtotime($date." + 4 day"))." </h2>
                <table class=\"planningPrinter\" border=\"1\">
                    <thead>
                        <tr>
                            <th id=\"firstColumn\"></th>";

                for($x=$m; $x<$m+2; $x++)
                {
                    if (isset($encadrant[$x]))
                    {
                        $content.='<th>'.$encadrantNom[$x].'<br/>8h - 12h</th>
                        <th id="emptyColumn">P</th>
                        <th>'.$encadrantNom[$x].'<br/>13h - 17h</th>
                        <th id="emptyColumn">P</th>';
                    }
                    else
                    {
                        $content.='<th></th>
                        <th id="emptyColumn"></th>
                        <th></th>
                        <th id="emptyColumn"></th>';
                    }
                }
                $content.="</tr></thead><tbody>";

                $CreValue=1;
                for($x=0; $x<5; $x++)
                {
                    $content.="<tr><td><b>".$tabJour[$x]."<br>".date("d/m", strtotime($date." + ".$x." day"))."</b></td>";
                    for($y=$w; $y<$w+4; $y++)
                    {
                        if(isset($encadrant[$y/2]))
                        {
                            $query = mysqli_query($db,"select concat(concat(PER_nom,' '),PER_prenom) AS 'nom', CNV_Couleur FROM pl_association
                                                JOIN salaries USING(SAL_NumSalarie)
                                                JOIN personnes USING(PER_Num)
                                                JOIN insertion using(SAL_NumSalarie)
                                                JOIN convention using(CNV_id)
                                                WHERE ASSOC_date = '".$date."' AND CRE_id = ".$CreValue." AND ENC_Num = ".$encadrant[$y/2]." AND PL_id = ".$typeplanning.";");

                            $nbRep = mysqli_num_rows($query);
                            ($nbRep==0) ? $couleur = 'lightgrey' : $couleur = "none";
                            $content.='<td style="text-align:center; vertical-align:middle; background:'.$couleur.';">';

                            while($data = mysqli_fetch_assoc($query))
                            {
                                $content.='<span style="color:'.$data["CNV_Couleur"].';">'.$data["nom"].'</span><br/>';
                            }
                            $content.='</td><td class="emptyCells" style="background:'.$couleur.';"></td>';
                            if($CreValue%2 == 0)
                                $CreValue--;
                            else
                                $CreValue++;
                        }
                        else
                        {
                            $content.='<td style="background:lightgrey;"></td><td style="background:lightgrey;"></td>';
                        }
                    }
                    $content.="</tr>";
                    $CreValue += 2;
                }
        $content.="</tbody></table><div style=\"text-align:center; padding:0; margin:108px 0px 22px 0px;\">";
        
        for($x=0; $x<sizeof($tableauLogo) && $x<6; $x++)
        {
            $content.="<img src=\"".$tableauLogo[$x]."\" style=\"margin:0px 3px;\"/>";
        }
        
        $content.= "</div>
            <h4 style=\"text-align:center; margin:0px; font-weight:normal;\">Association Revivre Service CAP, Chemin de Mondeville - 14460 COLOMBELLES - ".date("Y", strtotime($date))." | Page ".($compteur+1)."/".(ceil(sizeof($encadrant)/2))."</h4></page>";
        $compteur++;
        $w+=4;
        $m+=2;
    }
                //echo $content;
        require_once('../stuff/html2pdf/html2pdf.class.php');
        $html2pdf = new HTML2PDF('L','A4','fr');
        $html2pdf->WriteHTML($content);
        $html2pdf->Output($title);
}
else
{
    include('../bandeau.php');
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

    include('../footer.php');
}
?>