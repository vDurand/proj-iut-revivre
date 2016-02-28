<?php if ($graphTpsOK == 1) { ?>
Morris.Line({
    element: 'HoursEvolution',
    data: [
        <?php
        $i = 0;
        $hourTable[0] = 0;
        $dateTable[0] = 0;
        $reponse5 = mysqli_query($db, "SELECT * FROM TempsTravail ttps JOIN Salaries sal ON ttps.SAL_NumSalarie=sal.SAL_NumSalarie JOIN Personnes pe ON pe.PER_Num=sal.PER_Num WHERE ttps.CHA_NumDevis='$num' ORDER BY ttps.TRA_Date ASC");
        while ($donnees5 = mysqli_fetch_assoc($reponse5))
        {
            $hourTable[$i] = $donnees5['TRA_Duree'];
            $dateTable[$i] = $donnees5['TRA_Date'];
            $i++;
      }
      mysqli_free_result($reponse5);

      $sommeTable[0] = $hourTable[0];
      $distinctDate[0] = $dateTable[0];
      $k = 0;


      for ($j = 1; $j < $i; $j++) {
          if ($dateTable[$j] == $dateTable[$j-1]) {
              $sommeTable[$k] = $sommeTable[$k] + $hourTable[$j];
          }
          else {
              $k++;
              $sommeTable[$k] = $hourTable[$j];
              $distinctDate[$k] = $dateTable[$j];
          }
      }

      for ($i = 0; $i < $k+1; $i++) {?>
        {
            y: '<?php echo $distinctDate[$i]; ?>',
            a: <?php $croissance = $croissance + $sommeTable[$i]; echo $croissance; ?>
        },
        <?php
        }
        ?>
    ],
    xkey: 'y',
    ykeys: ['a'],
    labels: ['Nombre d\'heures'],
    goals: [<?php echo $Hmax; ?>],
    goalLineColors: ['Red'],
    goalStrokeWidth: 4,
    lineColors: ['green']
});
<?php } ?>

<?php if ($graphMntOK == 1) {?>
    Morris.Line({
        element: '#ProductEvolution',
        data: [
            <?php
            $achats = 0;
            $i = 0;
            $buyTable[0] = 0;
            $calTable[0] = 0;
            $reponse5 = mysqli_query($db, "SELECT * FROM Acheter WHERE CHA_NumDevis='$num' ORDER BY ACH_Date ASC");
            while ($donnees5 = mysqli_fetch_assoc($reponse5))
            {
                $buyTable[$i] = $donnees5['ACH_Montant'];
                    $calTable[$i] = $donnees5['ACH_Date'];
                    $i++;
            }
                mysqli_free_result($reponse5);

                $sumTable[0] = $buyTable[0];
                $distinctCal[0] = $calTable[0];
                $k = 0;

                for ($j = 1; $j < $i; $j++) {
                    if ($calTable[$j] == $calTable[$j-1]) {
                        $sumTable[$k] = $sumTable[$k] + $buyTable[$j];
                    }
                    else {
                        $k++;
                        $sumTable[$k] = $buyTable[$j];
                        $distinctCal[$k] = $calTable[$j];
                    }
                }

                for ($i = 0; $i < $k+1; $i++) {
            ?>
            {y: '<?php echo $distinctCal[$i]; ?>', a: <?php $achats = $achats + $sumTable[$i]; echo $achats; ?>},
            <?php
                }
            ?>
        ],
        xkey: 'y',
        ykeys: ['a'],
        labels: ['Montant'],
        goals: [<?php echo $MontantMax; ?>],
        goalLineColors: ['Red'],
        goalStrokeWidth: 4,
        lineColors: ['#1A89D3']
    });
<?php } ?>